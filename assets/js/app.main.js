/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
   $("#btnHash").click(function(){
       var str = $("#edtHashStr").val();
       var data = {str:str};
       $.ajax({
            type: "POST",
            url: base_url+"hash/hashStart",
            data: data,
            success: function(data) {
                console.log(data); 
                $("#mmHashResult").val(data);
            }
        });
   });
});