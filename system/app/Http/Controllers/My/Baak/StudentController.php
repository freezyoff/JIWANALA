<?php 
namespace App\Http\Controllers\My\Baak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller{
	
	public function index(){
		return view('my.baak.student.landing');
	}
	
}