@extends('layouts.baseLayout')

@section('html.head.styles')
	@parent
	<link rel="stylesheet" href="{{url('css/app.css')}}">
	<style>
		@media only screen and (max-width: 600px) {
			img.brand {width: 6em; padding: 0;margin: 0;top:0;position:relative; vertical-align:top; }
			.brand-title {font-family:gotham-medium; font-size:1.6em; font-weight:bold; line-height:1.2; color:#f0f0f0; }
			.brand-subtitle {line-height:1; font-size:1em; color:#fefefe;}
			.w3-display-middle{position:relative;transform: none;left:0;}
			.w3-container{background:transparent !important;}
			.w3-card.boxContainer{box-shadow: none !important;}
			.w3-input {color:#fefefe}
			.info {color: #fefefe;}
		}
		
		@media only screen and (min-width: 600px), 			/* Small devices (portrait tablets and large phones, 600px and up) */
		@media only screen and (min-width: 768px),			/* Medium devices (landscape tablets, 768px and up) */
		@media only screen and (min-width: 992px),			/* Large devices (laptops/desktops, 992px and up) */
		@media only screen and (min-width: 1200px) {		/* Extra large devices (large laptops and desktops, 1200px and up) */
		
			img.brand {width: 6em; padding: 0;margin: 0;top:0;position:relative; vertical-align:top;}
			.brand-title {font-family:gotham-medium; font-size:1.6em; font-weight:bold; line-height:1.2;}
			.brand-subtitle {line-height:1; font-size:1em;}
			.w3-card.boxContainer{padding: 16px 32px 16px 32px;box-shadow: 0 2px 5px 0 rgba(200,200,200,0.26),0 2px 10px 0 rgba(200,200,200,0.22)}
		}
		
		html, body {height: 100%;}
		.w3-panel.info{padding: 16px 0 16px 0;}
	</style>
@endSection

@section('body.attributes')
	class="w3-theme"
@endSection

@section('html.body.content')
	<div class="w3-row">
		<div class="w3-col s12 m7 l4 w3-container w3-card w3-display-middle w3-light-grey w3-round-small boxContainer">
			<div class="w3-section w3-center">
				<img class="brand" src="{{url('media/img/brand.png')}}">
				<h1 class="brand-title">{{config('app.name')}}</h1>
				<div class="brand-subtitle">Learn . Explore . Lead</div>
			</div>
			<div class="info" style="margin-top:32px">
				<p>@lang('service/auth/reset.hints.info')</hp>
			</div>
			<form method="POST" action="{{route('service.auth.reset', $token)}}">
				@csrf
				<input name="token" value="{{$token}}" type="hidden" />
				<input name="email" value="{{$user->email}}" type="hidden" />
				@if ($errors->has('failed'))
					<div class="w3-panel w3-border-red w3-round-small w3-red w3-center info" style="margin-top:32px">
						<p>@lang('service/auth/reset.failed')</p>	
					</div>
				@endif
				<div class="w3-padding-16">
					<label>@lang('service/auth/reset.label.username')</label>
					<input name="username" 
						value="{{$user->name}}"
						class="w3-input
						type="text" 
						readonly="readonly"/>
				</div>
				<div class="w3-padding-16">
					<input name="password" 
						value="{{old('password')}}"
						class="w3-input
						@if ($errors->any())
							error
						@endif"
						type="password" 
						placeholder="@lang('service/auth/reset.hints.password')"/>
					@if ($errors->has('password'))
					<label class="w3-text-red">{{$errors->first('password')}}</label>
					@endif
				</div>
				<div class="w3-padding-16">
					<!--<label>@lang('service/auth/reset.label.confirm')</label>-->
					<input name="password_confirmation" 
						value="{{old('password_confirmation')}}"
						class="w3-input
						@if ($errors->any())
							error
						@endif"
						type="password" 
						placeholder="@lang('service/auth/reset.hints.confirm')"/>
					@if ($errors->has('password_confirmation'))
					<label class="w3-text-red">{{$errors->first('password_confirmation')}}</label>
					@endif
				</div>
				<div class="w3-padding-16">
					<button class="w3-block w3-button w3-blue w3-hover-indigo">
						@lang('service/auth/reset.hints.button')
					</button>
				</div>
			</form>
		</div>
	</div>
@endSection