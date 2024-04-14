$("#addNew").click(function () {
    $("#recyclingForm")[0].reset();
    $("#showImage").attr("src", "");
    $("#recyclingModal").modal("show");
    $(".modal-title").html("Add new recycling 😍");
  });
  loadData();
  displayLocation();
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
    $("#recyclingTable tbody").html("");
    var sendData = {
      action: "readAllRecycle",
    };
    $.ajax({
      method: "POST",
      dataType: "json",
      url: "../api/recyclingFicilities.php",
      data: sendData,
      success: (data) => {
        var status = data.status;
        var response = data.data;
        var tr = "";
        if (status) {
          response.forEach((res) => {
            tr += "<tr>";
            for (let r in res) {
              if (r == "logo") {
                tr += `<td> <img src="../uploads/logoes/${res[r]}" style="width:140px;height:40px;border:1px solid #f44547; border-radius:1px; padding:4px;"></td>`;
              } else {
                tr += `<td>${res[r]}</td>`;
              }
            }
            tr += `<td>
                      <a class="update_info" id=${res["ficility_id"]}><i class="fa fa-edit fs-4 bg-primary text-light p-2 rounded m-1"></i></a>
                      <a class="delete_info" id=${res["ficility_id"]}><i class="fa fa-trash bg-danger fs-4 p-2 text-light rounded m-1"></i></a>
                      </td>`;
            tr += "</tr>";
          });
  
          $("#recyclingTable tbody").append(tr);
          $("#recyclingTable").DataTable();
        }
      },
    });
  }

  //load location
function displayLocation() {
  var sendData = {
      action: "readAllLocation",
  };
  $.ajax({
      method: "POST",
      dataType: "json",
      url: "../api/location.php",
      data: sendData,
      success: (data) => {
          var status = data.status;
          var response = data.data;
          var html = "";
          if (status) {
              html += `<option value="0">Select Option</option>`;
              response.forEach((res) => {
                  html += `<option value="${res["location_id"]}">${res["district"]}</option>`;
              });
              $("#location_id").append(html);
          }
      },
  });
}
  
  $("#recyclingForm").submit(function (e) {
    e.preventDefault();
    var ficility_id = $("#ficility_id").val();
    var ficility_name = $("#ficility_name").val();
    var description = $("#description").val();
    var location_id = $("#location_id").val();
    var email = $("#email").val();
    var phone_no = $("#phone_no").val();
    var image = $("#image").val();
  
    if (ficility_name == "") {
      displayMessage("error", "ficility_name Is Empry! | Please enter a Ficility Name");
    } else if (description == "") {
      displayMessage("error", "Description Is Empry! |Please enter a description");
    } else if (location_id == 0) {
      displayMessage("error", "Location Is Empry! | Please Select a location id");
    } else if (email == "") {
      displayMessage("error", "Email Is Empry! | Please enter an email");
    } else if (phone_no == 0) {
      displayMessage("error", "Phone Number Is Empry! | Please enter a Phone Number");
    } else {
      var sendData = new FormData($("#recyclingForm")[0]);
      sendData.append("image", $("input[type=file]")[0].files[0]);
      if (btnAction == "Insert") {
        sendData.append("action", "registerRecycle");
      } else {
        sendData.append("action", "updateRecycle");
      }
  
      $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/recyclingFicilities.php",
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
  function fetchrecyclingInfo(id) {
    var SendingData = {
      action: "readRecycleInfo",
      ficility_id: id,
    };
  
    $.ajax({
      method: "POST",
      dataType: "json",
      url: "../api/recyclingFicilities.php",
      data: SendingData,
      success: (data) => {
        var status = data.status;
        var response = data.data;
  
        if (status) {
          btnAction = "Updated";
          $("#recyclingModal").modal("show");
          $(".modal-title").html("Update recycling Info! 😍");
          $("#ficility_id").val(response[0].ficility_id);
          $("#ficility_name").val(response[0].ficility_name);
          $("#description").val(response[0].description);
          $("#location_id").val(response[0].location_id);
          $("#email").val(response[0].email);
          $("#phone_no").val(response[0].phone_no);
          $("#showImage").attr("src", `../uploads/logoes/${response[0].logo}`);
         
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
        $("#recyclingForm")[0].reset();
        $("#showImage").attr("src", "");
        $("#recyclingModal").modal("hide");
      }, 3000);
    } else {
      error.classList = "alert alert-danger p-2";
      error.innerHTML = message;
      setTimeout(function () {
        error.classList = "alert alert-danger d-none";
      }, 5000);
    }
  };
  function deleterecyclingInfo(id){
      let SendingData = {
          "action": "deleteRecycle",
          "ficility_id": id
      };
      $.ajax({
          method: "POST",
          dataType: "json",
          url: "../api/recyclingFicilities.php",
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
                      text: "You cannot delete this recycling its connection another table as a foreign key ❌",
                      icon: "error"
                    });
              }
          },
          error: (data) => {
              Swal.fire({
                  title: "Not Deleted!",
                  text: "You cannot delete this recycling its connection another table as a foreign key ❌",
                  icon: "error"
                });
          }
      })
  }
  
  $("#recyclingTable tbody").on("click", "a.update_info  ", function () {
    var id = $(this).attr("id");
    fetchrecyclingInfo(id);
  });
  $("#recyclingTable tbody").on("click", "a.delete_info  ", function () {
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
          deleterecyclingInfo(id);
       
      }
    });
  });
  