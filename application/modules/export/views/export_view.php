<html>
<head>
    <title>Export to excel</title>
    <style>
        body{
            padding: 20px;
            margin: 0;
        }
        .dropdown-content {
            margin-top: 32px;
            display: none;
            position: absolute;
            background-color: #5ba8d4;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {background-color: #5ca0c5; color: #fff}
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        a#btnExport {
            float: right;
            margin-bottom: 5px;
            margin-right: 20px;
            color: white;
            padding: 5px;
            background-color: #3c8dbc;
            border: 1px solid #3c8dbc;
        }
    </style>
    <!--<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
    <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">-->
    <link href="<?=base_url('assets/plugins/DataTables/DataTables-1.10.13/css/jquery.dataTables.min.css');?>" rel="stylesheet"/>
    <link href="<?=base_url('assets/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet"/>    
</head>
<body>
<h1 style="font-size:24px;margin-top:-5px;text-align: center;" id="reportTitle">
    Ini Contoh Judul Laporan
</h1>
<div class="row" style="padding: 10px">            
    <div class="dropdown">
        <a href="#export" id="btnExport">Export to:</a>
        <div class="dropdown-content">
            <a href="#Export2Excel" id="btnExport2Excel">Excel</a>
        </div>
    </div>  
    <form id="formLaporan">
        <div id="acts-table">
            <table id="tableList" class="table table-bordered table-hover table-striped" style="margin-top: 10px;border: 1px;">
              <thead>
                <tr class="success">
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Warna</th>
                  <th>Qty</th>
                </tr>
              </thead>
              <tbody>            
              </tbody>
            </table>
        </div>
    </form>    
</div>

<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<script src="<?=base_url('assets/plugins/jquery/jquery-3.2.0.min.js');?>"></script>
<script src="<?=base_url('assets/plugins/DataTables/jQueryUI-1.11.4/jquery-ui.min.js');?>"></script>
<script src="<?=base_url('assets/plugins/DataTables/DataTables-1.10.13/js/jquery.dataTables.min.js');?>"></script> 
<!-- Latest compiled and minified JavaScript -->
<script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.min.js');?>"></script>

<script>
$(function(){
    get();    
});
    
$("#btnExport2Excel").click(function(){		
    var filter = $('input[type="search"]').val();
    var reportTitle = $('#reportTitle').text();
    reportTitle = reportTitle.trim();
    var idField = [];
    var fieldCaption = [];

    $('#tableList > thead > tr').each(function(){
        var $tds = $(this).find('th');
        for (var i = 0; i < $tds.length; i++) {
            fieldCaption.push($tds.eq(i).text());
        }	    	
    });		 
    var data = {filter:filter, fieldCaption:fieldCaption, title:reportTitle};		
    
    $.ajax({
        type: "POST",
        url: "<?php echo site_url();?>/Export/excel",
        data: data,
        success: function(data){ 
            data = JSON.parse(data); 
            window.open(data.file);				
        }
    });		
});
    
function get(){ 
    $("#tableList").dataTable().fnDestroy(); /* destroy old table */
    $.ajax({
        url: "<?php echo site_url();?>/Export/dataStok",
        type: 'post',
        dataType: 'json',
        data: {data:1},
        success: function(data){ 
            $("#tableList tbody").html(data.dataTable);
            /*DataTables instantiation.*/
            $('#tableList').dataTable({
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bSort": false,
                "bInfo": true,
                "pagingType": "full_numbers",
                "bAutoWidth": false,
            });
        }
    });	
}
</script>
    
</body>
</html>