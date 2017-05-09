<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/style.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/login.style.css');?>">
	<title>Login</title>
</head>
<body>
<div class="login">
<form class="form-group" action="<?=base_url('access/doLogin');?>" method="post">
	<div class="hrzn-group">
		<div class="hrzn-title login-title-input">Username</div>
		<div class="hrzn-input">
			<input class="form-style login-form" type="text" name="username" placeholder="Enter your username"/>
		</div>
	</div>
	<div class="hrzn-group">
		<div class="hrzn-title login-title-input">Password</div>
		<div class="hrzn-input">
			<input class="form-style login-form" type="Password" name="password" placeholder="Enter your password"/>
		</div>
	</div>
	<div class="hrzn-group">
		<button class="btn-submit" type="submit">Login</button>
	</div>
</form>
</div>
</body>
</html>