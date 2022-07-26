<!DOCTYPE html>
<html lang="en">
<head>
  <title>Failed Delivery Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!--<script src="{{ asset('js/jquery.min.js')}}"></script>-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>


a:hover{text-decoration:none;}

  .btn,
a.btn,
button,
[type=button],
[type=reset],
[type=submit]{
	padding-left:50px;
	padding-right:50px;
	text-transform: capitalize;
	border-radius: 4px;
	background-color: #2366B5;
	border: 0;
	color: #fff;
}

.btn:hover,
a.btn:hover,
.btn.focus,
.btn:focus,
button:hover,
[type=button]:hover,
[type=reset]:hover,
[type=submit]:hover{
	background-color: #2366B5;
	box-shadow:unset;
}
h3{font-size:25px;}

.form-control:focus, textarea:focus, input[type=text]:focus, input[type=email]:focus, input[type=url]:focus, input[type=tel]:focus, input[type=password]:focus, input[type=number]:focus, select:focus {
    border-color: #ccc;
	box-shadow:unset;
}


body{background:#F7F8FA; color:#444;}

.auth-container{text-align:center;}
.login-box{background:#fff; box-shadow: rgba(0, 0, 0, 0.05) 0px 2px 5px 0px; border-radius:8px; overflow:hidden; max-width:420px; margin:100px auto 20px auto;}


.heading{background:#F5F5F5; margin:0; padding:15px; text-align:center;}
.content{background:#fff; text-align:center; padding:50px 40px 70px 40px;}

.login_error {color:orange; text-transform: capitalize;}

.auth-container input:focus{outline:none;}
.auth-container input::-webkit-inner-spin-button {-webkit-appearance: none; margin:0; -moz-appearance: textfield;}

a.btn[disabled=disabled] {background:#F5F5F5 !important;}


</style>

<script>
$(document).ready(function() {
	$('#auth-form input').keydown(function(event){
		if (event.keyCode == 13) {
			event.preventDefault();
			$('.verify-login').click();
			return false;
		}
	});
});
</script>


</head>
<body>


<div class="container auth-container">
	<form id="auth-form" method="post" action="{{url('/auth/verify')}}">
	{{ csrf_field() }}
	<div class="login-box">
		<div class="content">
			<p class="login_error">@if ($message = Session::get('error')) {{$message}} @endif</p>
			<div class="input-group" style="height:43px; margin-bottom:10px;">
				<input type="test" class="form-control" id="login_id" name="login_id" style="height:100%;" placeholder="Username">
			</div>
			<div class="input-group" style="height:43px;">
				<input type="password" class="form-control" id="password" name="password" style="height:100%;" placeholder="password">
			</div>
			<div class="input-group" style="margin-top:15px;">
				<button type="submit" class="btn verify-login" style="width:100%; padding:10px;">Login</button>
			</div>
		</div>
	</div>
	</form>
</div>

</body>
</html>







