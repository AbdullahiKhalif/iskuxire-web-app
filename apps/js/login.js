$("#loginForm").on("submit", function(event) {
    event.preventDefault();
    var username = $("#username").val();
    var password = $("#password").val();

    var sendData = {
        "username": username, 
        "password": password,
        "action": "loginUser"
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/login.php",
        data: sendData,
        success: (data) =>{
            var status = data.status;
            var response = data.data;
            if(status){
                window.location.href = "../views/dashboard.php";
            }else{
              $("#password").html("")
               displayMessage("error", response); 
            }
        }
    })
})


function displayMessage(type, message){
    if(type == "success"){
        const Toast = Swal.mixin({
            toast: true,
            position: "top-right",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
            }
          });
          Toast.fire({
            icon: "success",
            title: message
          });
    }else if(type == "warning"){
        const Toast = Swal.mixin({
            toast: true,
            position: "top-right",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
            }
          });
          Toast.fire({
            icon: "warning",
            title: message
          });
    }else if(type == "error"){
   
        const Toast = Swal.mixin({
            toast: true,
            position: "top-right",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
            }
          });
          Toast.fire({
            icon: "error",
            title: message
          });
          $("#password").html("");
    }
}