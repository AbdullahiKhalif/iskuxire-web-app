$("#addNew").click(function () {
    $("#userForm")[0].reset();
    $("#showImage").attr("src", "");
    $("#userModal").modal("show");
    $(".modal-title").html("Add new user 😍");
  });
  loadData();
  var btnAction = "Insert";
  var fileImage = document.querySelector("#image");
  var showImage = document.querySelector("#showImage");
  const reader = new FileReader();
  fileImage.addEventListener("change", (e) => {
    var selectedFile = e.target.files[0];
    reader.readAsDataURL(selectedFile);
  });
  reader.onload = (e) => {
    showImage.src = e.target.result;
  };
  
  function loadData() {
    $("#userTable tbody").html("");
    var sendData = {
      action: "readAllUsers",
    };
    $.ajax({
      method: "POST",
      dataType: "json",
      url: "../api/users.php",
      data: sendData,
      success: (data) => {
        var status = data.status;
        var response = data.data;
        var tr = "";
        if (status) {
          response.forEach((res) => {
            tr += "<tr>";
            for (let r in res) {
              if (r == "image") {
                tr += `<td> <img src="../uploads/users/${res[r]}" style="width:40px;height:40px;border:1px solid #f44547; border-radius:50%; object-fit:cover;"></td>`;
              } else {
                tr += `<td>${res[r]}</td>`;
              }
            }
            tr += `<td>
                      <a class="update_info" id=${res["user_id"]}><i class="fa fa-edit fs-4 bg-primary text-light p-2 rounded"></i></a>
                      <a class="delete_info" id=${res["user_id"]}><i class="fa fa-trash bg-danger fs-4 p-2 text-light rounded"></i></a>
                      </td>`;
            tr += "</tr>";
          });
  
          $("#userTable tbody").append(tr);
          $("#userTable").DataTable();
        }
      },
    });
  }
  
  $("#userForm").submit(function (e) {
    e.preventDefault();
    var user_id = $("#user_id").val();
    var username = $("#username").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var phone = $("#phone").val();
    var role = $("#role").val();
    var status = $("#status").val();
    var image = $("#image").val();
  
    if (username == "") {
      displayMessage("error", "Username Is Empry! | Please enter a username");
    } else if (email == "") {
      displayMessage("error", "Email Is Empry! |Please enter an email address");
    } else if (password == "") {
      displayMessage("error", "Password Is Empry! | Please enter a password");
    } else if (phone == "") {
      displayMessage("error", "Phone Is Empry! | Please enter a phone number");
    } else if (role == 0) {
      displayMessage("error", "Role Is Empry! | Please Select a Role");
    } else if (status == 0) {
      displayMessage("error", "Status Is Empry! | Please Select a Status");
    } else {
      var sendData = new FormData($("#userForm")[0]);
      sendData.append("image", $("input[type=file]")[0].files[0]);
      if (btnAction == "Insert") {
        sendData.append("action", "registerUser");
      } else {
        sendData.append("action", "updateUser");
      }
  
      $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/users.php",
        data: sendData,
        processData: false,
        contentType: false,
        success: (data) => {
          var status = data.status;
          var reponse = data.data;
  
          if (status) {
            displayMessage("success", reponse);
            loadData();
            btnAction = "Insert";
          } else {
            displayMessage("error", reponse);
          }
        },
      });
    }
  });
  function fetchUserInfo(id) {
    var SendingData = {
      action: "readUserInfo",
      user_id: id,
    };
  
    $.ajax({
      method: "POST",
      dataType: "json",
      url: "../api/users.php",
      data: SendingData,
      success: (data) => {
        var status = data.status;
        var response = data.data;
  
        if (status) {
          btnAction = "Updated";
          $("#userModal").modal("show");
          $(".modal-title").html("Update User Info! 😍");
          $("#user_id").val(response[0].user_id);
          $("#username").val(response[0].username);
          $("#email").val(response[0].email);
          $("#password").val(response[0].password);
          $("#phone").val(response[0].phone);
          $("#role").val(response[0].role);
          $("#status").val(response[0].status);
          $("#showImage").attr("src", `../uploads/users/${response[0].image}`);
         
        }
      },
    });
  }
  
  const displayMessage = (type, message) => {
    var success = document.querySelector(".alert-success");
    var error = document.querySelector(".alert-danger");
  
    if (type == "success") {
      error.classList = "alert alert-danger d-none";
      success.classList = "alert alert-success p-2";
      success.innerHTML = message;
  
      setTimeout(() => {
        success.classList = "alert alert-success d-none";
        $("#userForm")[0].reset();
        $("#showImage").attr("src", "");
        $("#userModal").modal("hide");
      }, 3000);
    } else {
      error.classList = "alert alert-danger p-2";
      error.innerHTML = message;
      setTimeout(function () {
        error.classList = "alert alert-danger d-none";
      }, 5000);
    }
  };
  function deleteUserInfo(id){
      let SendingData = {
          "action": "deleteUser",
          "user_id": id
      };
      $.ajax({
          method: "POST",
          dataType: "json",
          url: "../api/users.php",
          data: SendingData,
          success: (data) =>{
              var status = data.status;
              var response = data.data;
  
              if(status){
                  Swal.fire({
                      title: "Deleted!",
                      text: response,
                      icon: "success"
                    });
                  loadData();
              }else{
                  Swal.fire({
                      title: "Not Deleted!",
                      text: "You cannot delete this user its connection another table as a foreign key ❌",
                      icon: "error"
                    });
              }
          },
          error: (data) => {
              Swal.fire({
                  title: "Not Deleted!",
                  text: "You cannot delete this user its connection another table as a foreign key ❌",
                  icon: "error"
                });
          }
      })
  }
  
  $("#userTable tbody").on("click", "a.update_info  ", function () {
    var id = $(this).attr("id");
    fetchUserInfo(id);
  });
  $("#userTable tbody").on("click", "a.delete_info  ", function () {
    var id = $(this).attr("id");
    Swal.fire({
      title: "Are you?",
      text: "Sure to able to deletet this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
          deleteUserInfo(id);
       
      }
    });
  });
  