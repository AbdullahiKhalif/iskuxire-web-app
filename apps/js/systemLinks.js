$("#addNew").click(function () {
    $("#linkForm")[0].reset();
    // $("#showImage").attr("src", "");
    $("#linkModal").modal("show");
    $(".modal-title").html("Add new link 😍");
});
loadData();
displayLinks()
displayCategory()
var btnAction = "Insert";

function loadData() {
    $("#linkTable tbody").html("");
    var sendData = {
        action: "getAllLink",
    };
    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/link.php",
        data: sendData,
        success: (data) => {
            var status = data.status;
            var response = data.data;
            var tr = "";
            if (status) {
                response.forEach((res) => {
                    tr += "<tr>";
                    for (let r in res) {
                        tr += `<td>${res[r]}</td>`;
                    }
                    tr += `<td>
                        <a class="update_info" delete_id=${res["id"]}><i class="fa fa-edit fs-4 bg-primary text-light p-2 rounded"></i></a>
                        <a class="delete_info" delete_id=${res["id"]}><i class="fa fa-trash bg-danger fs-4 p-2 text-light rounded"></i></a>
                        </td>`;
                    tr += "</tr>";
                });

                $("#linkTable tbody").append(tr);
                $("#linkTable").DataTable();
            }
        },
    });
}
function displayLinks() {
    $("#linkTable tbody").html("");
    var sendData = {
        action: "getAllLinkFile",
    };
    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/link.php",
        data: sendData,
        success: (data) => {
            var status = data.status;
            var response = data.data;
            var html = "";
            if (status) {
                html += `<option value="0">Select Option</option>`;
                response.forEach((res) => {
                    html += `<option value="${res}">${res}</option>`;
                });
                $("#link").append(html);
            }
        },
    });
}
function displayCategory() {
    $("#teamTable tbody").html("");
    var sendData = {
      action: "getAllCategory",
    };
    $.ajax({
      method: "POST",
      dataType: "json",
      url: "../api/systemCategories.php",
      data: sendData,
      success: (data) => {
        var status = data.status;
        var response = data.data;
        var html = "";
        if (status) {
          html += `<option value="0">Select Option</option>`;
          response.forEach((res) => {
            html += `<option value="${res["id"]}">${res["categoryName"]}</option>`;
          });
          $("#categoryId").append(html);
        }
      },
    });
  }
$("#linkForm").submit(function (e) {
    e.preventDefault();
    var linkId = $("#linkId").val();
    var linkName = $("#linkName").val();
    var link = $("#link").val();
    var categoryId = $("#categoryId").val();
    var ties = $("#ties").val();
    if (linkName == "") {
        displayMessage("error", "LinkName Empry! | Please enter a LinkName");
    }else if(link == 0) {
        displayMessage("error", "link Is Empry! | Please select a link");
    }else if(categoryId == 0) {
        displayMessage("error", "CategoryId Is Empry! | Please Select a categoryId");
    } 
    else {
        var sendData = {};
        if (btnAction == "Insert") {
            sendData = {
                linkName, link, categoryId,
                "action": "registerLink"
            };
        } else {
            sendData = {
                "id": linkId,
                linkName, link, categoryId,
                "action": "registerLink"
            };
        }

        $.ajax({
            method: "POST",
            dataType: "json",
            url: "../api/link.php",
            data: sendData,
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
function fetchLinkInfo(id) {
    var SendingData = {
        action: "getLinkInfo",
        "id": id,
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/link.php",
        data: SendingData,
        success: (data) => {
            var status = data.status;
            var response = data.data;

            if (status) {
                btnAction = "Updated";
                $("#linkModal").modal("show");
                $(".modal-title").html("Update Link Info! 😍");
                $("#linkId").val(response[0].id);
                $("#linkName").val(response[0].linkName);
                $("#link").val(response[0].link);
                $("#categoryId").val(response[0].categoryId);
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
            $("#linkForm")[0].reset();
            $("#showImage").attr("src", "");
            $("#linkModal").modal("hide");
        }, 1000);
    } else {
        error.classList = "alert alert-danger p-2";
        error.innerHTML = message;
        setTimeout(function () {
            error.classList = "alert alert-danger d-none";
        }, 5000);
    }
};
function deleteLinkInfo(id) {
    let SendingData = {
        action: "deleteLink",
        "id": id,
    };
    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/link.php",
        data: SendingData,
        success: (data) => {
            var foundedYear = data.status;
            var response = data.data;

            if (foundedYear) {
                Swal.fire({
                    title: "Deleted!",
                    text: response,
                    icon: "success",
                });
                loadData();
            } else {
                Swal.fire({
                    title: "Not Deleted!",
                    text: "You cannot delete this link its connection another table as a foreign key ❌",
                    icon: "error",
                });
            }
        },
        error: (data) => {
            Swal.fire({
                title: "Not Deleted!",
                text: "You cannot delete this link its connection another table as a foreign key ❌",
                icon: "error",
            });
        },
    });
}

$("#linkTable tbody").on("click", "a.update_info  ", function () {
    var id = $(this).attr("delete_id");
    fetchLinkInfo(id);
});
$("#linkTable tbody").on("click", "a.delete_info  ", function () {
    var id = $(this).attr("delete_id");
    Swal.fire({
        title: "Are you?",
        text: "Sure to able to deletet this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((location) => {
        if (location.isConfirmed) {
            deleteLinkInfo(id);
        }
    });
});
