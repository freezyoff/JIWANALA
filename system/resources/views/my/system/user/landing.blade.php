@extends('layouts.dashboard.dashboard', ['sidebar'=>'system', 'title'=>trans('my/system/user.titles.landing')])

@section('dashboard.main')
<div class="w3-card">
	<header class="w3-container w3-theme padding-top-bottom-8">
		<h4>{{trans('my/system/user.subtitles.landing')}}</h4>
	</header>
	<div class="padding-top-bottom-8">
		<div class="w3-row w3-container">
			<form name="search" action="{{route('my.system.user.index')}}" method="get">
				@csrf
				<div class="w3-col s12 m4 l4">
					<div class="input-group">
						<label><i class="fas fa-keyboard"></i></label>
						<input id="keywords" 
							name="keywords" 
							type="text" 
							class="w3-input" 
							placeholder="{{trans('my/system/user.hints.keywords')}}"
							value="{{old('keywords', '')}}" />
					</div>
				</div>
				<div class="w3-col s12 m4 l4">
					<div class="input-group padding-left-8 padding-none-small">
						<label><i class="fas fa-lightbulb fa-fw"></i></label>
						<input id="employeeActive" 
							name="active_status" 
							type="text"
							class="w3-input" 
							value="{{ old('active_status', '-1') }}" 
							select-role="dropdown"
							select-dropdown="#employeeActive-dropdown" 
							select-modal="#employeeActive-modal"
							select-modal-container="#employeeActive-modal-container" />
					</div>
					@include('my.system.user.landing_employeeActive_dropdown_modal')
				</div>
				<div class="w3-col s12 m4 l4">
					<div class="input-group padding-left-8 padding-none-small">
						<label><i class="fas fa-lightbulb fa-fw"></i></label>
						<input id="employeeActive" 
							name="employeeActive" 
							type="text"
							class="w3-input" 
							value="{{ old('employeeActive', '-1') }}" 
							select-role="dropdown"
							select-dropdown="#employeeActive-dropdown" 
							select-modal="#employeeActive-modal"
							select-modal-container="#employeeActive-modal-container" />
					</div>
					@include('my.system.user.landing_employeeActive_dropdown_modal')
				</div>
			</form>
		</div>
		<div class="w3-row w3-container margin-top-16">
			<div class="w3-col s12 m12 l12">
				<div class="w3-container">
					{{$employees->links('layouts.dashboard.pagination')}}
				</div>
				<table class="w3-table w3-table-all">
					<thead>
						<tr class="w3-theme-l1">
							<td class="w3-hide-large"></td>
							<td>NIP</td>
							<td>Nama</td>
							<td></td>
							<td class="w3-hide-small w3-hide-medium"></td>
						</tr>
					</thead>
					<tbody>
						@forelse ($employees as $empl)
							<tr>
								<td class="w3-hide-large"></td>
								<td>{{ $empl->nip }}</td>
								<td>{{ $empl->getFullName() }}</td>
								<td>
									@if ($empl->asUser)
										<i class="fas fa-link fa-fw" title="asdasdasdsa"></i>
									@else
										<i class="fas fa-unlink fa-fw"  title="asdasdasdsa"></i>
									@endif
								</td>
								<td class="w3-hide-small w3-hide-medium"></td>
							</tr>
						@empty
							<tr>
								<td colspan="5">Belum ada data</td>
							</tr>
						@endforelse
					</tbody>
				</table>
				<div class="w3-container">
					{{$employees->links('layouts.dashboard.pagination')}}
				</div>
			</div>
		</div>
	</div>
</div>
@endSection

@section('html.body.scripts')
@parent
<script>
$(document).ready(function(){
	$('[select-role="dropdown"]').select().on('select.pick', function(){
		$('form[name="search"]').submit();
	});
});
</script>
@endSection