<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<title><?php echo $tab_name;?></title>
    <!-- CSS -->
    <link href="<?=base_url('assets/plugins/DataTables/DataTables-1.10.13/css/jquery.dataTables.min.css');?>" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/font-awesome/css/font-awesome.css');?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/libs/css/bem.kit.css');?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/normalize/normalize.css');?>">
		<style>
		.login {
			width: 300px;
			margin: 10% auto;
			border: 1px solid #ececec;
			border-radius: 4px;
			box-shadow: 2px 2px #ececec;
		}
		.login__header{
			height: 45px;
			padding-left: 10px;
			/*padding-top: 10px;*/
			line-height: 46px;
			border-bottom: 1px solid #ececec;
		}
		.login__title {
			font-size: 20px;
			margin: 0;
			font-family: sans-serif;
			color: #757575;
		}
		</style>
</head>
<body>
	<div class="login">
		<div class="login__header">
			<h2 class="login__title">Login</h2>
		</div>
	<form class="form" action="#" method="post">
		<div class="form__default">
			<div class="form__default label form__label">Username</div>
			<div class="form__input">
				<input class="input input__text" type="text" name="username" placeholder="Enter your username"/>
			</div>
		</div>
		<div class="form__default">
			<div class="form__default label form__label">Password</div>
			<div class="form__input">
				<input class="input input__text" type="password" name="password" placeholder="Enter your password"/>
			</div>
		</div>
		<div class="form__default">
			<div class="form__default label form__label"></div>
			<div class="form__input">
				<button class="btn btn__normal fill--blue " type="submit">Login</button>
			</div>
		</div>
	</form>
	</div>
</body>
</html>
