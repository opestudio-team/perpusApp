/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    //Hash string
    $("#btnHash").click(function(){
        var str = $("#edtHashStr").val();
        var data = {str:str};
        if(str != "" || str != null){
             alert("No string");
        } else {
             $.ajax({
                 type: "POST",
                 url: base_url+"hash/hashStart",
                 data: data,
                 success: function(data) { 
                     $("#mmHashResult").val(data);
                 }
             });
        }       
    });
    
    $("#btnLogin").click(function(){
        
    });
});
