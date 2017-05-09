<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/style.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/login.style.css');?>">
	<title>Login</title>
</head>
<body>
<div class="login">    
<form class="form-group" action="<?=base_url('download/downRequest');?>" method="post">
        <h3><?php echo $filename;?></h3>
        <p>Silahkan masukkan Nama dan alamat Email anda. Link download akan dikirimkan melalui email.</p>
        <div class="hrzn-group">
            <div class="hrzn-title login-title-input">Name</div>
            <div class="hrzn-input">
                <input class="form-style login-form" type="text" name="nama" placeholder="Enter your name" required/>
            </div>
	</div>	
	<div class="hrzn-group">
            <div class="hrzn-title login-title-input">Email</div>
            <div class="hrzn-input">
                <input class="form-style login-form" type="text" name="emailDownload" placeholder="Enter your email address" required/>
            </div>
	</div>	
	<div class="hrzn-group">
		<button class="btn-submit" type="submit">Send</button>
	</div>
</form>
</div>
</body>
</html>