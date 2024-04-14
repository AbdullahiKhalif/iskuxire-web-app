loadData();

$("#addNew").click(function () {
  $("#reportForm")[0].reset();
  $("#showImage").attr("src", "");
  $("#reportModal").modal("show");
  $(".modal-title").html("Add new report 😍");

  const reader = new FileReader();
  const fileImage = document.querySelector("#image");
  const showImage = document.querySelector("#showImage");

  fileImage.addEventListener("change", (e) => {
    const selectedFile = e.target.files[0];
    reader.readAsDataURL(selectedFile);
  });

  reader.onload = (e) => {
    showImage.src = e.target.result;
  };
});

let btnAction = "Insert";

$("#reportForm").submit(function (e) {
  e.preventDefault();

  const report_id = $("#report_id").val();
  const user_id = $("#user_id").val();
  const description = $("#description").val();
  const image = $("#image").val();

  if (description === "") {
    displayMessage("error", "Description Is Empty! Please enter a description");
  } else {
    const sendData = new FormData($("#reportForm")[0]);
    sendData.append("image", $("input[type=file]")[0].files[0]);

    if (btnAction === "Insert") {
      sendData.append("action", "registerReport");
    } else {
      sendData.append("action", "updateReport");
    }

    $.ajax({
      method: "POST",
      dataType: "json",
      url: "../api/reportPosts.php",
      data: sendData,
      processData: false,
      contentType: false,
      success: (data) => {
        const status = data.status;
        const response = data.data;

        if (status) {
          displayMessage("success", response);
          loadData();
          btnAction = "Insert";
        } else {
          displayMessage("error", response);
        }
      },
    });
  }
});

function fetchreportInfo(id) {
  const SendingData = {
    action: "readReportInfo",
    report_id: id,
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../api/reportPosts.php",
    data: SendingData,
    success: (data) => {
      const status = data.status;
      const response = data.data;

      if (status) {
        btnAction = "Update";
        $("#reportModal").modal("show");
        $(".modal-title").html("Update report Info! 😍");
        $("#report_id").val(response[0].report_id);
        $("#user_id").val(response[0].user_id);
        $("#description").val(response[0].description);
        $("#showImage").attr("src", `../uploads/report posts/${response[0].image}`);
      }
    },
  });
}

function deletereportInfo(id) {
  const SendingData = {
    action: "deleteReport",
    report_id: id,
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../api/reportPosts.php",
    data: SendingData,
    success: (data) => {
      const status = data.status;
      const response = data.data;

      if (status) {
        Swal.fire({
          title: "Deleted!",
          text: response,
          icon: "success",
        });
        loadData();
      } else {
        Swal.fire({
          title: "Not Deleted!",
          text: "You cannot delete this report as it's connected to another table as a foreign key ❌",
          icon: "error",
        });
      }
    },
    error: (data) => {
      Swal.fire({
        title: "Not Deleted!",
        text: "You cannot delete this report as it's connected to another table as a foreign key ❌",
        icon: "error",
      });
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
      $("#reportForm")[0].reset();
      $("#showImage").attr("src", "");
      $("#reportModal").modal("hide");
    }, 3000);
  } else {
    error.classList = "alert alert-danger p-2";
    error.innerHTML = message;
    setTimeout(function () {
      error.classList = "alert alert-danger d-none";
    }, 5000);
  }
};

$("#reportTable tbody").on("click", "a.update_info", function () {
  const id = $(this).attr("update_id"); // Corrected attribute name
  fetchreportInfo(id);
});

function loadData() {
  $("#uploadPosts").html("");
  var sendData = {
    action: "readAllUserReport",
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../api/reportPosts.php",
    data: sendData,
    success: function (data) {
      var status = data.status;
      var response = data.data;
      var html = "";

      if (status) {
        response.forEach((item) => {
          html += `
            <div class="row justify-content-center mb-4">
              <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                      <img src="../uploads/users/${item['user_id']}.png" alt="img" class="img-fluid rounded-circle" style="width:40px;height:40px;">
                      <h3 class="fs-5 fw-bold ms-3">${item['username']}</h3>
                      <span class="ms-auto">${item['report_date']}</span>
                    </div>
                    <hr>
                    <div class="mb-3">
                      ${item['description']}
                    </div>
                    <img src="../uploads/report posts/${item['image']}" alt="img" class="img-fluid" style="object-fit: cover;">
                    <div class="d-flex justify-content-end mt-3">
                      <a class="btn btn-primary update_info me-2" update_id="${item['report_id']}"><i class="fa fa-edit"></i> Update</a>
                      <a class="btn btn-danger delete_info" delete_id="${item['report_id']}"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          `;
        });
        $("#uploadPosts").append(html);
      }
    },
  });
}

$("#reportTable tbody").on("click", "a.delete_info", function () {
  const id = $(this).attr("delete_id"); // Corrected attribute name
  Swal.fire({
    title: "Are you sure?",
    text: "Do you want to delete this report?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      deletereportInfo(id);
    }
  });
});
