@extends('layouts.app')

@section('content')




<style>

.admin-menu{margin:0; padding:0;}
.admin-menu li{list-style:none; display:inline-block; margin-right:5px;}
.admin-menu li a{}
.admin-menu li.active a{background:#E49494;}

</style>

<div>
	<ul class="admin-menu">
		<li class="@if (Request::path()=='admin/bin-config') active @endif"><a class="fdms-btn" href="{{ url('/admin/bin-config') }}">Bin / Case Config</a></li>
		<li class="@if (Request::path()=='admin/dop-mapping') active @endif"><a class="fdms-btn"  href="{{ url('/admin/dop-mapping') }}">DOP Mapping</a></li>
		@if (Auth::user()->type == 'superadmin')
		<li class="@if (Request::path()=='admin/user-management') active @endif"><a class="fdms-btn"  href="{{ url('/admin/user-management') }}">User Management</a></li>
		<li class="@if (Request::path()=='admin/scarp-config') active @endif"><a class="fdms-btn"  href="{{ url('/admin/scarp-config') }}">Scrap Config</a></li>
        <li class="@if (Request::path()=='admin/mail-ageing') active @endif"><a class="fdms-btn"  href="{{ url('/admin/mail-ageing') }}">Mail Ageing</a></li>
	    <li class="@if (Request::path()=='admin/calendar') active @endif"><a class="fdms-btn"  href="{{ url('/admin/calendar') }}">Calendar</a></li>
		@endif
	</ul>
	
</div>

<div style="margin-top:50px;">
	@yield('subcontent')
</div>


@endsection
