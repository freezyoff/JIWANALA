<div id="attendanceProgress" class="w3-col s12 m7 l7 w3-light-grey">
	<div class="w3-card">
		<header class="w3-container padding-top-8 padding-bottom-8 w3-indigo">
			<h4>Progres Rekaman Finger Kehadiran</h4>
		</header>
		<div class="w3-row w3-indigo padding-left-8 padding-right-8 padding-bottom-8">
			<div class="w3-col s12 m6 l6">
				<div class="input-group">
					<label><i class="fas fa-calendar fa-fw"></i></label>
					<input id="attendanceProgress-month" 
						value="{{ $month }}"
						type="text" 
						class="w3-input" 
						role="select"
						select-dropdown="#attendanceProgress-month-dropdown"
						select-modal="#attendanceProgress-month-modal"
						select-modal-container="#attendanceProgress-month-modal-container" />
				</div>
				@include('my.bauk.landing_attendanceProgress_month_dropdown')
				@include('my.bauk.landing_attendanceProgress_month_modal')
			</div>
			<div class="w3-col s12 m6 l6 padding-left-8 padding-none-small">
				<div class="input-group">
					<label><i class="fas fa-calendar fa-fw"></i></label>
					<input id="attendanceProgress-year" 
						value="{{ $year }}"
						type="text" 
						class="w3-input" 
						role="select"
						select-dropdown="#attendanceProgress-year-dropdown"
						select-modal="#attendanceProgress-year-modal"
						select-modal-container="#attendanceProgress-year-modal-container" />
				</div>
				@include('my.bauk.landing_attendanceProgress_year_dropdown')
				@include('my.bauk.landing_attendanceProgress_year_modal')
			</div>
		</div>
		<div class="w3-container padding-top-16 padding-bottom-16">
			<div class="w3-col s12 m12 l5 margin-bottom-8 margin-none-large padding-top-8" style="min-width:135px">
				<div style="display:flex; flex-direction:column;align-items:center;">
					<div id="progressbar-radial" 
						class="progressbar radial xlarge" 
						style="font-size:9em;box-shadow:2px 1px 10px .1px #898383 inset; ">
						<span id="progressbar-radial-label"><i class="button-icon-loader"></i></span>
						<div class="slice">
							<div class="bar"></div>
							<div class="fill"></div>
						</div>
					</div>
					<span id="progressbar-title"
						class="padding-top-8" 
						style="font-size:.7em; text-align:center">
						Progres rekaman karyawan fulltime
					</span>
				</div>
			</div>
			<div class="w3-col s12 m12 l7">
				<table class="w3-table w3-bordered">
					<tbody>
						<tr>
							<td>Cuti / Izin</td>
							<td>:</td>
							<td style="text-align:right" id="empoyee-consents"><i class="button-icon-loader"></i></td>
						</tr>
						<tr>
							<td>Terlambat / Pulang Awal</td>
							<td>:</td>
							<td style="text-align:right" id="empoyee-lateArrivalOrEarlyDeparture"><i class="button-icon-loader"></i></td>
						</tr>
						<tr>
							<td colspan="3">Tanpa dokumen Cuti / Izin</td>
						</tr>
						<tr>
							<td><span class="padding-left-16">Terlambat / Pulang Awal</span></td>
							<td>:</td>
							<td style="text-align:right" id="employee-noLateOrEarlyDocs"><i class="button-icon-loader"></i></td>
						</tr>
						<tr>
							<td><span class="padding-left-16">Cuti / Izin</span></td>
							<td>:</td>
							<td style="text-align:right" id="employee-noConsentDocs"><i class="button-icon-loader"></i></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<style>
.input-group{
	border:none;
	text-shadow:none;
}
.input-group:hover{
	border:none;
	text-shadow:1px 1px #253534;
}

.progressbar.radial *{box-sizing:content-box;}

.progressbar.radial{
	position: relative;
	font-size: 120px;
	width: 1em;
	height: 1em;
	border-radius: 50%;
	background-color: #cccccc;
}

.progressbar.radial:after{
	position: absolute;
	top: 0.08em;
	left: 0.08em;
	display: block;
	content: " ";
	border-radius: 50%;
	background-color: #f5f5f5;
	width: 0.84em;
	height: 0.84em;
	-webkit-transition-property: all;
	-moz-transition-property: all;
	-o-transition-property: all;
	transition-property: all;
	-webkit-transition-duration: 0.2s;
	-moz-transition-duration: 0.2s;
	-o-transition-duration: 0.2s;
	transition-duration: 0.2s;
	-webkit-transition-timing-function: ease-in;
	-moz-transition-timing-function: ease-in;
	-o-transition-timing-function: ease-in;
	transition-timing-function: ease-in;
}

.progressbar.radial span{
	position: absolute;
	width: 100%;
	z-index: 1;
	left: 0;
	top: 0;
	width: 5em;
	line-height: 5em;
	font-size: 0.2em;
	color: #307bbb;
	display: block;
	text-align: center;
	white-space: nowrap;
	-webkit-transition-property: all;
	-moz-transition-property: all;
	-o-transition-property: all;
	transition-property: all;
	-webkit-transition-duration: 0.2s;
	-moz-transition-duration: 0.2s;
	-o-transition-duration: 0.2s;
	transition-duration: 0.2s;
	-webkit-transition-timing-function: ease-out;
	-moz-transition-timing-function: ease-out;
	-o-transition-timing-function: ease-out;
	transition-timing-function: ease-out;
}


.progressbar.radial .slice .bar,
.progressbar.radial .slice .fill{
	position: absolute;
	border: 0.08em solid #307bbb;
	width: 0.84em;
	height: 0.84em;
	clip: rect(0em, 0.5em, 1em, 0em);
	border-radius: 50%;
	-webkit-transform: rotate(0deg);
	-moz-transform: rotate(0deg);
	-ms-transform: rotate(0deg);
	-o-transform: rotate(0deg);
	transform: rotate(0deg);
}

.progressbar.radial .slice{position: absolute;width: 1em;height: 1em;clip: rect(0em, 1em, 1em, 0.5em);}
.progressbar.radial .slice.full{clip: rect(auto, auto, auto, auto) !important;}

</style>
<script>
var attendanceProgress = {
	init: function(){
		$('#attendanceProgress-year, #attendanceProgress-month').on('select.pick', function(event, oldValue, newValue){
			if (oldValue != newValue){
				attendanceProgress.send();
			}
		});
		attendanceProgress.send();
	},
	send: function(){
		$.ajax({
			method: "POST",
			url: '{{route('my.bauk.landing.info.attendanceProgress')}}',
			data: { 
				'_token': '{{csrf_token()}}',
				'year': $('#attendanceProgress-year').val(),
				'month': $('#attendanceProgress-month').val(),
			},
			dataType: "json",
			beforeSend: function() {
				$('#progressbar-radial-label').html($('<i class="button-icon-loader"></i>'));
			},
			success: function(response){
				attendanceProgress.setProgressbar(response.percent);
				$('#progressbar-title').html(response.title);
				$('#empoyee-consents').html(response.consents);
				$('#empoyee-lateArrivalOrEarlyDeparture').html(response.lateArrivalOrEarlyDeparture);
				$("#employee-noLateOrEarlyDocs").html(response.noLateOrEarlyDocs);
				$("#employee-noConsentDocs").html(response.noConsentDocs);
			}
		});
	},
	setProgressbar: function(percent){
		var duration =  1000,
			percent = percent,
			angel = (percent/100)*360,
			pbar = $('#progressbar-radial'),
			span = $('#progressbar-radial-label'),
			slice = pbar.find('.slice'),
			startAngel = parseInt(pbar.attr('angel')),
			startCount = parseInt(pbar.attr('percent'));
			
		$({countNum: isNaN(startAngel)? 0 : startAngel, deg: isNaN(startCount)? 0 : startCount}).animate({countNum: percent, deg: angel}, {
			duration: duration,
			easing:'linear',
			step: function() {
				span.html(Math.floor(this.countNum)+'%');
				slice.find('.bar').css('transform','rotate('+ this.deg +'deg)');
				
				if (this.deg>180){
					slice.addClass('full');
					slice.find('.fill').css('transform','rotate(180deg)');
				} 
				else{
					slice.removeClass('full');
					slice.find('.fill').css('transform','rotate('+ this.deg +'deg)');
				}
				pbar.attr('angel',angel);
				pbar.attr('percent',this.countNum);
			}
		});
	}
};

$(document).ready(function(){
	attendanceProgress.init();
	$('[role="select"]').select();
});
</script>