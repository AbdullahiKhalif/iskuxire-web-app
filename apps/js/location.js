$("#addNew").click(function () {
    $("#locationForm")[0].reset();
    // $("#showImage").attr("src", "");
    $("#locationModal").modal("show");
    $(".modal-title").html("Add new location 😍");
});
loadData();
var btnAction = "Insert";

function loadData() {
    $("#locationTable tbody").html("");
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
            var tr = "";
            if (status) {
                response.forEach((res) => {
                    tr += "<tr>";
                    for (let r in res) {
                        tr += `<td>${res[r]}</td>`;
                    }
                    tr += `<td>
                        <a class="update_info" delete_id=${res["location_id"]}><i class="fa fa-edit fs-4 bg-primary text-light p-2 rounded"></i></a>
                        <a class="delete_info" delete_id=${res["location_id"]}><i class="fa fa-trash bg-danger fs-4 p-2 text-light rounded"></i></a>
                        </td>`;
                    tr += "</tr>";
                });

                $("#locationTable tbody").append(tr);
                $("#locationTable").DataTable();
            }
        },
    });
}

$("#locationForm").submit(function (e) {
    e.preventDefault();
    var locationId = $("#location_id").val();
    var district = $("#district").val();
    var village = $("#village").val();
    var zone = $("#zone").val();
    if (district == "") {
        displayMessage("error", "district Empry! | Please enter a ditrict Name");
    }else if(village == 0) {
        displayMessage("error", "location Village Is Empry! | Please Select a Village");
    }else if(zone == "") {
        displayMessage("error", "Zone Is Empry! | Please Select a Zone");
    } 
    else {
        var sendData = {};
        if (btnAction == "Insert") {
            sendData = {
                district,village,zone,
                "action": "registerlocation"
            }
        } else {
            sendData = {
                "location_id": locationId,
                district,village,zone,
                "action": "updatelocation"
            }
        }

        $.ajax({
            method: "POST",
            dataType: "json",
            url: "../api/location.php",
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
function fetchlocationInfo(id) {
    var SendingData = {
        action: "readlocationInfo",
        "location_id": id,
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/location.php",
        data: SendingData,
        success: (data) => {
            var status = data.status;
            var response = data.data;

            if (status) {
                btnAction = "Updated";
                $("#locationModal").modal("show");
                $(".modal-title").html("Update location Info! 😍");
                $("#location_id").val(response[0].location_id);
                $("#district").val(response[0].district);
                $("#village").val(response[0].village);
                $("#zone").val(response[0].zone);
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
            $("#locationForm")[0].reset();
            $("#showImage").attr("src", "");
            $("#locationModal").modal("hide");
        }, 3000);
    } else {
        error.classList = "alert alert-danger p-2";
        error.innerHTML = message;
        setTimeout(function () {
            error.classList = "alert alert-danger d-none";
        }, 5000);
    }
};
function deletelocationInfo(id) {
    let SendingData = {
        action: "deletelocation",
        "waste_id": id,
    };
    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/location.php",
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
                    text: "You cannot delete this location its connection another table as a foreign key ❌",
                    icon: "error",
                });
            }
        },
        error: (data) => {
            Swal.fire({
                title: "Not Deleted!",
                text: "You cannot delete this location its connection another table as a foreign key ❌",
                icon: "error",
            });
        },
    });
}

$("#locationTable tbody").on("click", "a.update_info  ", function () {
    var id = $(this).attr("delete_id");
    fetchlocationInfo(id);
});
$("#locationTable tbody").on("click", "a.delete_info  ", function () {
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
            deletelocationInfo(id);
        }
    });
});
