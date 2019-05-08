<div id="month-modal" class="w3-modal w3-display-container w3-hide-large" onclick="$(this).hide()">
	<div class="w3-modal-content w3-animate-top w3-card-4">
		<header class="w3-container w3-theme">
			<h4 class="w3-button w3-display-topright w3-hover-none w3-hover-text-light-grey"
				onclick="$('#month-modal').hide()" >
				×
			</h4>
			<h4 class="padding-top-8 padding-bottom-8">
				<i class="fas fa-calendar-alt"></i>
				<span style="padding-left:12px;">{{ucfirst(trans('my/bauk/attendance/pages.subtitles.month'))}}</span>
			</h4>
		</header>
		<div id="month-modal-container" class="datepicker-inline-container">
			<div class="w3-bar-block" style="width:100%">
				<ul class="w3-ul w3-hoverable">
					@for($i=1;$i<13;$i++)
					<li style="cursor:pointer;">
						<a class="w3-text-theme w3-mobile" 
							select-role="item" 
							select-value="{{$i<10? '0'.$i : $i}}">
							{{ trans('calendar.months.long.'.($i-1)) }}
						</a>
					</li>
					@endfor
				</ul>
			</div>
		</div>
	</div>
</div>