$(document).ready(function(){
    // localStorage.setItem("name", $("#chatText").val());
  $("#sendBtn").click(function() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const reciver_id_new = urlParams.get('user')
    const sender_id_new = $("#sender_id").val()
    $.ajax({  
        url: 'chat.php',  
        type: 'POST',
        data:{conversion: $("#chatText").val(),reciver_id:$("#sendBtn").val()},  
          success: function(data) {
          loaddata(sender_id_new, reciver_id_new);
            // $(document).append("<div class='alert alert-warning alert-dismissible fade show success-msg' role='alert'><strong>Something Wrong Please Try Again !</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");                               
          }  
      });
  });
  $('.user-profile').click(function (event) { 
    event.preventDefault(); 
    var url = $(this).attr('href');
    var Userchat = $(this).attr("data-href");
    $.get(url, function(data) {
       window.history.pushState('stateObject', 'New Title', Userchat)
       document.getElementsByClassName("homepage").innerHTML = data
     });
  });
});
function loaddata(sender, reciver){
  $.ajax({  
      url: 'bhagyesh.php',  
      type: 'POST',
      data:{sender_id : sender ,reciver_id:reciver},  
        success: function(data) {
        alert(data);
          // $(document).append("<div class='alert alert-warning alert-dismissible fade show success-msg' role='alert'><strong>Something Wrong Please Try Again !</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");                               
        }  
    }); 
}