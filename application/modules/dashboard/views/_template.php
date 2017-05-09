<?php $tab_name = 'template CI'?>
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
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<title><?php echo $tab_name;?></title>
    <!-- CSS -->
    <link href="<?=base_url('assets/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet"/>  
    <link href="<?=base_url('assets/plugins/DataTables/DataTables-1.10.13/css/jquery.dataTables.min.css');?>" rel="stylesheet"/>      
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/libs/css/style.min.css');?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/libs/css/login.style.css');?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/font-awesome/css/font-awesome.css');?>">
    <!-- <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/Hover/css/hover.css');?>"> -->            
    <style>
		.dataTables_filter input[type="search"] {
			border: 1px solid #ddd;
			border-radius: 3px;
			height: 30px;
		}
		.dataTables_filter input[type="search"]:focus {
			background-color: #fff;
			-webkit-transition: all 0.30s ease-in-out;
			-moz-transition: all 0.30s ease-in-out;
			-ms-transition: all 0.30s ease-in-out;
			-o-transition: all 0.30s ease-in-out;
			border: 1px solid rgb(133, 182, 255);
		}
        .row {
            margin-right: 0;
            margin-left: 0;
        }
        .breadcrumb{
            padding: 5px 10px;
            font-size: 11px;
        }
	</style>
    <script type="text/javascript">
        /* variabel global untuk penggunaan base_url dan assets*/
        var base_url = "<?php echo site_url();?>/",
            assets_url = "<?php echo site_url();?>assets/";
    </script>
</head>
<body>
    <div class="o-container">
        <aside class="sidebar">
            <div class="sidebar-head">                
                    AdminPanel                
            </div>
            <section class="sidebar-menu">
            <ul class="sidebar-list-menu" id="accordion">
                <!--<li class="list-head">Head</li>-->
                <li><a href='#'><i class="fa fa-university"></i> Dashboard</a></li>                
                <li><a id="collapse-menu" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-bar-chart"></i> Collapse Menu <i class="fa fa-angle-right pull-right"></i></a>
                    <ul id="collapseOne" class="panel-collapse collapse">
                        <li><a href='#'><i class="fa fa-bar-chart"></i> Child</a>
                        <li><a href='#'><i class="fa fa-bar-chart"></i> Child</a>
                    </ul>
                </li>
                <li><a id="collapse-menu" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-bar-chart"></i> Collapse Menu <i class="fa fa-angle-right pull-right"></i></a>
                    <ul id="collapseTwo" class="panel-collapse collapse">
                        <li><a href='#'><i class="fa fa-bar-chart"></i> Child</a>
                        <li><a href='#'><i class="fa fa-bar-chart"></i> Child</a>
                    </ul>
                </li>
                <li><a href='#'><i class="fa fa-envelope-o"></i> Pesan <span class="label label-primary pull-right bg-red">4</span></a></li>                               
            </ul>
            </section>

        </aside>
        <div class="main">              
            <div class="content-top">
                <div class="content-top-left">
                    <h1>Dashboard</h1> 
                </div>
                <div class="content-top-right">
                    <ul>
                        <li class="parent-menu"><a href="#">Inbox</a></li>
                        <li class="parent-menu"><a href="#">Username</a></li>                        
                    </ul>
                </div>
            </div>
            <div class="content">
                <div class="o-row breadcrumb">Dashboard > Setting</div>
                <div class="o-row">
                    <div class="box-3 box-blue">
                        box
                    </div>
                    <div class="box-3 box-red">
                        box
                    </div>
                    <div class="box-3 box-green">
                        box
                    </div>
                </div> 
                
                <div class="o-row"> 
                    <div class="o-column md-width">
                        <div class="o-panel colored-blue non-bordered">
                            <div class="o-panel-header">
                                Header Colored Blue
                                <div class="header-btn">
                                    <button class="btn btn-sm btn-header-bg" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="o-panel-body">
                                <div class="table-responsive table-full">
                                    <table id="tableList" class="otable-full table table-stripped table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Kode Barang</th>
                                                <th class="text-center">NamaKode Barang</th>
                                                <th class="text-center">Warna Barang</th>
                                                <th class="text-center text-nowrap">Qty</th>											
                                            </tr>
                                        </thead>
                                        <tbody>										                             
                                        </tbody>
                                    </table>
                                </div>
                            </div>   
                            <div class="o-panel-footer">
                                footer
                            </div>                     
                        </div>
                    </div>
                    <div class="o-column sm-width"> 
                        <div class="o-panel colored-red non-bordered">
                            <div class="o-panel-header">
                                Header Colored Red
                                <div class="header-btn"></div>
                            </div>
                            <div class="o-panel-body">
                                body
                            </div>   
                            <div class="o-panel-footer">
                                footer
                            </div>                     
                        </div> 
                        <div class="o-panel">
                            <div class="o-panel-header">
                                Default
                                <div class="header-btn"></div>
                            </div>
                            <div class="o-panel-body">
                                body
                            </div>   
                            <div class="o-panel-footer">
                                footer
                            </div>                     
                        </div> 
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Bootstrap Panel</h3>
                            </div>
                            <div class="panel-body">
                                Panel content
                            </div>
                        </div>
                    </div>                     
                </div>  
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Bootstrap Panel</h3>
                        </div>
                        <div class="panel-body">
                            Panel content
                        </div>
                    </div>
                </div>
            </div>                              
        </div>
    </div>

<!-- Javascript -->
<script src="<?=base_url('assets/plugins/jquery/jquery-3.2.0.min.js');?>"></script>
<script src="<?=base_url('assets/plugins/DataTables/jQueryUI-1.11.4/jquery-ui.min.js');?>"></script>
<script src="<?=base_url('assets/plugins/DataTables/DataTables-1.10.13/js/jquery.dataTables.min.js');?>"></script> 
<script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.min.js');?>"></script>
<script>
   $(function(){
	   get(); 
       $('body').on('click', '#collapse-menu', function() {
			if(!$(this).hasClass('active')){
				$('.collapse').collapse('hide');
				$("a",$(this).parents("ul:first")).removeClass(' active');           
				
				$(this).next('ul').collapse('show');
				$(this).addClass(' active');  
			} else {
				$(this).removeClass(' active');
				$(this).next('ul').collapse('hide');
			}                     
       });                
   });   

function get(){ 
    $("#tableList").dataTable().fnDestroy(); /* destroy old table */
    $.ajax({
        url: "<?php echo site_url();?>/export/dataStok",
        type: 'post',
        dataType: 'json',
        data: {data:1},
        success: function(data){ 
            //console.log(data);
            $("#tableList tbody").html(data.dataTable);
            /*DataTables instantiation.*/
            $('#tableList').dataTable({
                "bPaginate": true,
                "bLengthChange": true,
                "iDisplayLength": 7,
                "bFilter": true,
                "bSort": false,
                "bInfo": true,
                "pagingType": "simple",
                "bAutoWidth": false,
            });
        }
    });	
}
</script>
</body>
</html>
