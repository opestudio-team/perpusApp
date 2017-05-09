<!DOCTYPE html>
<html>
<head>
	<?php
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Methods', 'GET,PUT,POST');
        header('Access-Control-Allow-Headers', 'Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept');
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header('Cache-Control: no-store, no-cache, must-revalidate'); 
        header('Cache-Control: post-check=0, pre-check=0', FALSE); 
        header('Pragma: no-cache'); 
    ?>
	<title>Login</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<title><?php echo $tab_name;?></title>
    <!-- CSS -->
    <link href="<?=base_url('assets/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet"/>  
    <link href="<?=base_url('assets/plugins/DataTables/DataTables-1.10.13/css/jquery.dataTables.min.css');?>" rel="stylesheet"/>      
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/libs/css/style.min.css');?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/libs/css/login.style.css');?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/font-awesome/css/font-awesome.css');?>">
</head>
<body>

</body>
</html>