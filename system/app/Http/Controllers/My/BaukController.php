<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\Bauk\EmployeeAttendance;
use App\Libraries\Bauk\Employee;
use App\Libraries\Bauk\EmployeeSchedule;
use App\Libraries\Bauk\Holiday;
use \Carbon\Carbon;

class BaukController extends Controller
{
    public function landing(){
		$now = now();
		return view("my.bauk.landing",[
			'year'=>$now->format('Y'),
			'month'=>$now->format('m'),
			'day'=>$now->format('d'),
		]);
	}
	
	public function nextHolidays(){
		//next 5 holidays
		$count = 0;
		$date = now();
		$offset = 4;
		$result = [];
		do{
			$holidays = Holiday::getHolidaysByMonth($date->format('Y'), $date->format('m'));
			foreach($holidays as $h){
				if (count($result)<$offset) $result[] = $h;
			}
			$count = count($result);
			$date->addMonthNoOverflow();
		}while($count<$offset);
		return $this->nextHolidays_toTableBody($result);
	}
	
	protected function nextHolidays_toTableBody($rows){
		$tbody = '';
		foreach($rows as $row){
			$range = $row->getDateRange();
			$tbody .='<tr>';
			$tbody .='<td>'.$range[0]->format('d').'&nbsp;'.trans('calendar.months.long.'.$range[0]->format('n'));
			if ($range[0] != $range[1]){
				$tbody .='<span>-</span>'.$range[1]->format('d').'&nbsp;'.trans('calendar.months.long.'.$range[1]->format('n'));
			}
			$tbody .='</td>'.
					'<td>'.$row->name.'</td>'.
				'</tr>';
		}
		return $tbody;
	}
	
	public function employeesCount(){
		return response()->json([
			'count'=> Employee::where('active','=',1)->count(),
			'fulltime'=> Employee::where('active','=',1)->where('work_time','=','f')->count(),
			'contract1'=> Employee::where('active','=',1)->where('work_time','=','f')
							->whereRaw('TIMESTAMPDIFF(YEAR,`registered_at`,"'.now()->format('Y-m-d').'") < 1')->count(),
			'contract2'=> Employee::where('active','=',1)->where('work_time','=','f')
							->whereRaw('TIMESTAMPDIFF(YEAR,`registered_at`,"'.now()->format('Y-m-d').'") >= 1')
							->whereRaw('TIMESTAMPDIFF(YEAR,`registered_at`,"'.now()->format('Y-m-d').'") < 2')->count(),
		]);
	}
	
	public function fingerConsent(){
		$now = now();
		$year = $now->format('Y');
		$month = $now->format('m');
		
		//late arrival
		//'employeeList'=>EmployeeAttendance::getLateArrival($year, $month, "Count("*")")->all(),
		return [
			'lateArrival'=>EmployeeAttendance::getLateArrivalCount($year, $month),
			'earlyDeparture'=>EmployeeAttendance::getLateArrivalCount($year, $month)
		];
	}
	
	//	data finger kehadiran untuk karyawan aktif pada periode bulan ini. 
	//	Hanya data kehadiran saja. Izin tidak dihitung.
	public function attendanceProgress(){
		$now = now();
		
		//get the periode
		$month = \Request::input('month', $now->format('m'));
		$year = \Request::input('year', $now->format('Y'));
		
		//determine the date property
		$startDate = Carbon::parse($year.'-'.$month.'-01');
		$endDate = false;
		
		//selected date == now
		if ($startDate->month == $now->month && $startDate->year == $now->year){
			$endDate = $now;
		}
		else{
			$endDate = $startDate->copy();
			$endDate->day = $startDate->daysInMonth;
		}
		
		//get the employee registered at $startDate & $endDate periode
		$employeeList = Employee::getActiveEmployee(true, $startDate->year, $startDate->month);
		
		$allPercents = 0;
		$allPercentsDevider = 0;
		foreach($employeeList as $employee){
			//count attendance record
			$daysWorkArray = EmployeeSchedule::getScheduleDaysOfWeekIso($employee->id);		//hari kerja 
			$attendsCount = $employee->attendances()->where(function($q) use($startDate, $endDate, $daysWorkArray){
					$q->whereRaw('`date` BETWEEN "'.$startDate->format('Y-m-d').'" AND "'.$endDate->format('Y-m-d').'"');				
					if (count($daysWorkArray)>0){
						$q->whereRaw('DAYOFWEEK(`date`) IN ('. implode(',', $daysWorkArray) .')');
					}
				})->count();
			
			$offScheduleDaysCount = 0;	//jadwal libur 
			$holidayCount = 0;		//libur kalender
			$loop = $startDate->copy();
			while($loop->lessThanOrEqualTo($endDate)){
				$holidayCount += Holiday::isHoliday($loop)? 1 : 0;
				$offScheduleDaysCount += EmployeeSchedule::hasSchedule($employee->id, $loop->dayOfWeek)? 0 : 1;
				$loop->addDay();
			}
			
			$workDaysCount = $startDate->diffInDays($endDate) - $offScheduleDaysCount - $holidayCount;
			$allPercents += floor($attendsCount/($workDaysCount));
			$allPercentsDevider++;
		}
		
		return [
			'percent'=>floor($allPercents/$allPercentsDevider),
			'start'=>[
				'year'=>$startDate->year,
				'month'=>$startDate->month,
				'day'=>$startDate->day
			],
			'end'=>[
				'year'=>$endDate->year,
				'month'=>$endDate->month,
				'day'=>$endDate->day
			]
		];
	}
	
	/**
	 *	Employee without schedule
	 *
	 */
	public function scheduleInfo(){
		
	}
}
