<!DOCTYPE html>
<html>
<head>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	  <title><?php echo $title;?></title>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/libs/css/custom.style.css');?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/bootstrap/css/bootstrap.min.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/DataTables/datatables.min.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/libs/css/style.min.css');?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/libs/css/login.style.css');?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/font-awesome/css/font-awesome.css');?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/normalize/normalize.css');?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/pure/pure-min.css');?>" crossorigin="anonymous">
    <style>
      .row {
        margin-right: 0 !important;
        margin-left: 0 !important;
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
            <div class="profile-pict">
              <img class="avatar-pict" src="<?php echo base_url('assets/img/profil/profil.png');?>"/>
            </div>
            <section class="sidebar-menu">
            <ul class="sidebar-list-menu" id="accordion">
                <!--<li class="list-head">Head</li>-->
                <li><a href='#'><i class="fa fa-university"></i> Dashboard</a></li>
                <li><a id="collapse-menu" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-bookmark"></i> Master <i class="fa fa-angle-right pull-right"></i></a>
                    <ul id="collapseOne" class="panel-collapse collapse">
                        <li><a href='#'><i class="fa fa-bar-chart"></i> Buku</a></li>
                        <li><a href='#'><i class="fa fa-wpforms"></i> Pengarang</a></li>
                        <li><a href='#'><i class="fa fa-wpforms"></i> Penerbit</a></li>
                        <li><a href='#'><i class="fa fa-wpforms"></i> Kategori</a></li>
                        <li><a href='#'><i class="fa fa-wpforms"></i> Siswa</a></li>
                    </ul>
                </li>
                <li><a id="collapse-menu" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-code"></i> Transaksi <i class="fa fa-angle-right pull-right"></i></a>
                    <ul id="collapseTwo" class="panel-collapse collapse">
                        <li><a href='#'><i class="fa fa-area-chart"></i> Peminjaman Buku</a></li>
                        <li><a href='#'><i class="fa fa-calendar"></i> Pengembalian Buku</a></li>
                    </ul>
                </li>
                <!-- <li><a id="collapse-menu" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3"><i class="fa fa-copy"></i> Pages <i class="fa fa-angle-right pull-right"></i></a>
                    <ul id="collapse3" class="panel-collapse collapse">
                        <li><a href='#'><i class="fa fa-warning"></i> Error (404)</a></li>
                    </ul>
                </li>
                <li><a href='#'><i class="fa fa-envelope-o"></i> Pesan <span class="label label-primary pull-right bg-red">4</span></a></li> -->
            </ul>
            </section>

        </aside>
        <div class="main">
            <div class="content-top">
                <div class="content-top-left">
                  <div class="menu-wrapper">
                    <div class="menu-content">
                      <ul>
                          <a href="#"><li>Panel</li></a>
                          <a href="#"><li>Form</li></a>
                      </ul>
                    </div>
                    <div class="parent">Components</div>
                  </div>
                  <div class="menu-wrapper">
                    <div class="menu-content">
                      <ul>
                          <a href="#"><li>Chart</li></a>
                          <a href="#"><li>Calendar</li></a>
                          <a href="#"><li>Maps</li></a>
                      </ul>
                    </div>
                    <div class="parent">Plugins</div>
                  </div>
                  <div class="menu-wrapper">
                    <div class="menu-content">
                      <ul>
                          <a href="#"><li>Error</li></a>
                      </ul>
                    </div>
                    <div class="parent">Pages</div>
                  </div>
                </div>
                <div class="content-top-right">

                </div>
            </div>
            <div class="content">
                <!-- <div class="o-row">
                    <div class="box box-3">
                      <div class="box box__count box--blue">
                        2
                      </div>
                      <div class="box box__desc">
                        box
                      </div>
                    </div>
                    <div class="box box-3">
                      <div class="box box__count box--red">
                        2
                      </div>
                      <div class="box box__desc">
                        box
                      </div>
                    </div>
                    <div class="box box-3">
                      <div class="box box__count box--green">
                        2
                      </div>
                      <div class="box box__desc">
                        box
                      </div>
                    </div>
                </div> -->
                <?php if(isset($breadcrumb)){?>
                  <div class="o-row breadcrumb"><?= $breadcrumb?></div>
                <?php } ?>
                <?php echo $contents; ?>
            </div>
        </div>
    </div>

<!-- Javascript -->
<script src="<?=base_url('assets/js/logger.js');?>"></script>
<script src="<?=base_url('assets/plugins/jquery/jquery-3.2.0.min.js');?>"></script>
<script src="<?=base_url('assets/plugins/DataTables/jQueryUI-1.11.4/jquery-ui.min.js');?>"></script>
<script src="<?=base_url('assets/plugins/DataTables/datatables.min.js');?>"></script>
<script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.min.js');?>"></script>
<!-- <script src="https://cdn.ravenjs.com/3.14.0/raven.min.js"></script> -->
<script>
$(function(){
    // Raven.config('https://826c61a473584e0ab32b1c839f54acda@sentry.io/156175').install();
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
        url: "<?php echo base_url();?>/export/dataStok",
        type: 'post',
        dataType: 'json',
        data: {data:1},
        success: function(data){
          console.log(data);
          $("#tableList tbody").html(data.dataTable);
          /*DataTables instantiation.*/
          $('#tableList').dataTable({
              "bPaginate": true,
              "bLengthChange": false,
              "iDisplayLength": 7,
              "bFilter": false,
              "bSort": false,
              "bInfo": true,
              "pagingType": "full_numbers",
              "bAutoWidth": false,
          });
        }
    });
    console.log("test");
}
</script>
</body>
</html>
