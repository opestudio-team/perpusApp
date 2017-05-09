<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/style.min.css');?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/login.style.css');?>">
    <script type="text/javascript" src="<?=base_url('assets/js/app.main.js');?>"></script>
    <title><?php echo $page_name;?></title>
    
    <script type="text/javascript">        
        var base_url = "<?php echo base_url();?>/",
            assets_url = "<?php echo base_url();?>assets/";
    </script>
</head>
<body>
<div class="login">    
<form class="form-group" action="" method="post">        
        <div class="hrzn-group">
            <div class="hrzn-title login-title-input">Your Word</div>
            <div class="hrzn-input">
                <input id="edtHashStr" class="form-style login-form" type="text" name="nama" placeholder="Enter your word" required/>
            </div>
	</div>	
        <div class="hrzn-group">
            <button class="btn-submit" type="button" id="btnHash">Hash</button>
	</div>
	<div class="hrzn-group">
            <div class="hrzn-title">Result</div>
            <div class="hrzn-input">                
                <textarea id="mmHashResult" class="form-style" placeholder="Result" rows="30" style="height:70px"></textarea>
            </div>
	</div>		
</form>
</div>
</body>
</html>