$("#addNew").click(function () {
    $("#wasteForm")[0].reset();
    // $("#showImage").attr("src", "");
    $("#wasteModal").modal("show");
    $(".modal-title").html("Add new waste 😍");
});
loadData();
displayCategory();
displayUsers();
var btnAction = "Insert";

//load categories
function displayCategory() {
    var sendData = {
        action: "readCategoryAvailable",
    };
    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/category.php",
        data: sendData,
        success: (data) => {
            var status = data.status;
            var response = data.data;
            var html = "";
            if (status) {
                html += `<option value="0">Select Option</option>`;
                response.forEach((res) => {
                    html += `<option value="${res["id"]}">${res["category_name"]}</option>`;
                });
                $("#category_id").append(html);
            }
        },
    });
}
//load users
function displayUsers() {
    var sendData = {
        action: "readUserActiveStatus",
    };
    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/users.php",
        data: sendData,
        success: (data) => {
            var status = data.status;
            var response = data.data;
            var html = "";
            if (status) {
                html += `<option value="0">Select Option</option>`;
                response.forEach((res) => {
                    html += `<option value="${res["user_id"]}">${res["username"]}</option>`;
                });
                $("#user_id").append(html);
            }
        },
    });
}
function loadData() {
    $("#wasteTable tbody").html("");
    var sendData = {
        action: "readAllWaste",
    };
    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/waste.php",
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
                        <a class="update_info" delete_id=${res["waste_id"]}><i class="fa fa-edit fs-4 bg-primary text-light p-2 rounded m-1"></i></a>
                        <a class="delete_info" delete_id=${res["waste_id"]}><i class="fa fa-trash bg-danger fs-4 p-2 text-light  m-1"></i></a>
                        </td>`;
                    tr += "</tr>";
                });

                $("#wasteTable tbody").append(tr);
                $("#wasteTable").DataTable();
            }
        },
    });
}

$("#wasteForm").submit(function (e) {
    e.preventDefault();
    var wasteId = $("#waste_id").val();
    var description = $("#description").val();
    var category_id = $("#category_id").val();
    var address = $("#address").val();
    var weight = $("#weight").val();
    var user_id = $("#user_id").val();
    if (description == "") {
        displayMessage("error", "Description Empry! | Please enter a Waste Name");
    }else if(category_id == 0) {
        displayMessage("error", "Category Id Is Empry! | Please Select a Waste Category id");
    }else if(address == "") {
        displayMessage("error", "Adress Is Empry! | Please Select a Waste Address id");
    }
    else if(weight == 0) {
        displayMessage("error", "Weight Is Empry! | Please enter a Weight");
    } 
    else if(weight < 0) {
        displayMessage("error", "Invalid Weight | Please enter a Weight");
    } 
    else if(category_id == 0) {
        displayMessage("error", "User Is Empry! | Please Select a Waste User id");
    }
    else {
        var sendData = {};
        if (btnAction == "Insert") {
            sendData = {
                "description": description,category_id, address,weight, user_id,
                "action": "registerWaste"
            }
        } else {
            sendData = {
                "waste_id": wasteId,
                "description":description,category_id,address,weight,user_id,
                "action": "updateWaste"
            }
        }

        $.ajax({
            method: "POST",
            dataType: "json",
            url: "../api/waste.php",
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
function fetchWasteInfo(id) {
    var SendingData = {
        action: "readWasteInfo",
        "waste_id": id,
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/waste.php",
        data: SendingData,
        success: (data) => {
            var status = data.status;
            var response = data.data;

            if (status) {
                btnAction = "Updated";
                $("#wasteModal").modal("show");
                $(".modal-title").html("Update Waste Info! 😍");
                $("#waste_id").val(response[0].waste_id);
                $("#description").val(response[0].description);
                $("#category_id").val(response[0].category_id);
                $("#address").val(response[0].address);
                $("#weight").val(response[0].weight);
                $("#user_id").val(response[0].user_id);
                $("#date").val(response[0].date);
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
            $("#wasteForm")[0].reset();
            $("#showImage").attr("src", "");
            $("#wasteModal").modal("hide");
        }, 3000);
    } else {
        error.classList = "alert alert-danger p-2";
        error.innerHTML = message;
        setTimeout(function () {
            error.classList = "alert alert-danger d-none";
        }, 5000);
    }
};
function deleteWasteInfo(id) {
    let SendingData = {
        action: "deleteWaste",
        "waste_id": id,
    };
    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/waste.php",
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
                    text: "You cannot delete this waste its connection another table as a foreign key ❌",
                    icon: "error",
                });
            }
        },
        error: (data) => {
            Swal.fire({
                title: "Not Deleted!",
                text: "You cannot delete this waste its connection another table as a foreign key ❌",
                icon: "error",
            });
        },
    });
}

$("#wasteTable tbody").on("click", "a.update_info  ", function () {
    var id = $(this).attr("delete_id");
    fetchWasteInfo(id);
});
$("#wasteTable tbody").on("click", "a.delete_info  ", function () {
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
            deleteWasteInfo(id);
        }
    });
});
