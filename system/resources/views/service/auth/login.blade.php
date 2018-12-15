@extends('layouts.baseLayout')

@section('html.head.styles')
	@parent
	<link rel="stylesheet" href="{{url('css/app.css')}}">
	<style>
		@media only screen and (max-width: 600px) {
			.w3-display-middle{position:relative;transform: none;left:0; min-width:300px}
			
			img.brand {width: 6em; padding: 0;margin: 0;top:0;position:relative; vertical-align:top; }
			.brand-title {font-family:gotham; font-size:1.6em; font-weight:bold; line-height:1.2; }
			.brand-subtitle {line-height:1; font-size:1em;}
			.w3-container{background:transparent !important;}
			.w3-card.boxContainer{box-shadow: none !important;}
			
			.w3-theme {background-color:#f1f1f1 !important; color:#333 !important;}
		}
		
		@media only screen and (min-width: 600px), 			/* Small devices (portrait tablets and large phones, 600px and up) */
		@media only screen and (min-width: 768px),			/* Medium devices (landscape tablets, 768px and up) */
		@media only screen and (min-width: 992px),			/* Large devices (laptops/desktops, 992px and up) */
		@media only screen and (min-width: 1200px) {		/* Extra large devices (large laptops and desktops, 1200px and up) */
			.w3-display-middle{min-width:400px;}
		
			img.brand {width: 6em; padding: 0;margin: 0;top:0;position:relative; vertical-align:top;}
			.brand-title {font-family:gotham; font-size:1.6em; font-weight:bold; line-height:1.2;}
			.brand-subtitle {line-height:1; font-size:1em;}
			.w3-card.boxContainer{padding: 16px 32px 16px 32px;box-shadow: 0 2px 5px 0 rgba(200,200,200,0.26),0 2px 10px 0 rgba(200,200,200,0.22)}
			.w3-panel.error{padding: 16px 0 16px 0;}
		}
	</style>
@endSection

@section('body.attributes')
	class="w3-theme"
@endSection

@section('html.body.content')
<div class="w3-display-middle">
	<div class="w3-row">
		<div class="w3-col s12 m12 l12 w3-container w3-card w3-light-grey w3-round-small boxContainer">
			<div class="w3-section w3-center">
				<img class="brand" src="{{url('media/img/brand.png')}}">
				<h1 class="brand-title">JIWANALA</h1>
				<div class="brand-subtitle">Learn . Explore . Lead</div>
			</div>
			@if ($errors->any())
			<div class="w3-panel w3-border-red w3-round-small w3-red w3-center error" style="margin-top:32px">
				<p>@lang('service/auth/login.error.login')</p>	
			</div>
			@endif
			<form method="POST" action="{{route('service.auth.login')}}">
				@csrf
				<div class="w3-padding-16">
					<input name="name" 
						value="{{Request::old('name')}}"
						class="w3-input
						@if ($errors->any())
							error
						@endif"
						type="text" 
						placeholder="@lang('service/auth/login.hints.name')" />
				</div>
				<div class="w3-padding-16">
					<input name="password" 
						class="w3-input
						@if ($errors->any())
							error
						@endif" 
						type="password" 
						placeholder="@lang('service/auth/login.hints.password')" />
				</div>
				<div>
					<a class="w3-text-red" style="text-decoration:none;"
						href="{{route('service.auth.forgot')}}" 
						target="_blank"
						>Lupa sandi?</a>
				</div>
				<div class="w3-padding-16">
					<button class="w3-block w3-button w3-blue w3-hover-indigo">Masuk</button>
				</div>
			</form>
		</div>
	</div>
	<div class="w3-row padding-top-16 w3-center" style="">
		<footer class="w3-container w3-display-bottom padding-right-32 padding-left-32">
			<div>&copy; <a href="{{url('')}}" style="font-weight:600;text-decoration:none;">JIWANALA</a> {{date('Y')}}</div>
			<div style="font-size:.85em">
				<span>Managed by </span>
				<a href="mailto:akhmad.musa.hadi@gmail.com" 
					target="_blank" 
					style="text-decoration:none;font-weight:bold">
					<span style="color:#ff5100cc;">Freezy</span><span style="color:#59B5FF;">Bits</span>
				</a>
			</div>
		</footer>
	</div>
</div>
	
@endSection