$(document).ready(function () {
    $('#api-key-btn').click(function (event) {
        //Let user confirm that they want to generate the key
     var confirm_key = confirm("You are about to generate a new API key");
     if (!confirm_key) {
      return;
     }
     $.ajax({
      url: "ApiKey.php",
      dataType: "json",
      success: function (data) {
       if (data['success'] == 1) {
        $('#api-key').val(data['message']);
       } else {
        alert("Something went wrong. Please try again");
       }
      }
     });
    });
   });