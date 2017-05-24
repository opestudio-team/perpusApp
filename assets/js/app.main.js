/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

document.addEventListener("DOMContentLoaded", function(){
  // alert("DOMContentLoaded!");
});

getJSON = function(url, next){
  var request = new XMLHttpRequest();
  request.open("GET",url,true);
  request.send();

  request.addEventListener("load", function(){
    if (request.status < 200 && request.status >= 400) {
      return next(new Error("return error from target server"));
    }
    next(null, JSON.parse(request.responseText));
  });

  request.addEventListener("error", function(){
    next(new Error("Error connection"));
  });
}

post = function(url, data){
  var post = new XMLHttpRequest();
  post.open("POST", url, true);
  post.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
  post.onreadystatechange = function () {
    if (post.readyState != 4 || post.status != 200) return;
    alert("Success: " + post.responseText);
  };
  post.send(data);
}
