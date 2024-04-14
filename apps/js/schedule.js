$("#addNew").click(function () {
    $("#scheduleForm")[0].reset();
    // $("#showImage").attr("src", "");
    $("#scheduleModal").modal("show");
    $(".modal-title").html("Add new schedule 😍");
});
loadData();
displayFicilities();
var btnAction = "Insert";

//load ficilites
function displayFicilities() {
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
            var html = "";
            if (status) {
                html += `<option value="0">Select Option</option>`;
                response.forEach((res) => {
                    html += `<option value="${res["ficility_id"]}">${res["ficility_name"]}</option>`;
                });
                $("#ficility_id").append(html);
            }
        },
    });
}
function loadData() {
    $("#scheduleTable tbody").html("");
    var sendData = {
        action: "readAllschedule",
    };
    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/schedule.php",
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
                        <a class="update_info" delete_id=${res["schedule_id"]}><i class="fa fa-edit fs-4 bg-primary text-light p-2 rounded m-1"></i></a>
                        <a class="delete_info" delete_id=${res["schedule_id"]}><i class="fa fa-trash bg-danger fs-4 p-2 text-light  m-1"></i></a>
                        </td>`;
                    tr += "</tr>";
                });

                $("#scheduleTable tbody").append(tr);
                $("#scheduleTable").DataTable();
            }
        },
    });
}

$("#scheduleForm").submit(function (e) {
    e.preventDefault();
    var scheduleId = $("#schedule_id").val();
    var ficility_id = $("#ficility_id").val();
    var days_of_week = $("#days_of_week").val();
    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();
    if (ficility_id == 0) {
        displayMessage("error", "Ficility is Empry! | Please Select a ficility Id");
    }else if(days_of_week == "") {
        displayMessage("error", "Days Of Week  Are Empry! | Please enter days of week");
    }else if(start_date == "") {
        displayMessage("error", "Start date Is Empry! | Please Select a Start date");
    }
    else if(end_date == "") {
        displayMessage("error", "End Date Is Empry! | Please Select an End Date");
    } 
    else if(end_date < 0) {
        displayMessage("error", "Invalid End_date | Please enter a End_date");
    } 
    else {
        var sendData = {};
        if (btnAction == "Insert") {
            sendData = {
                ficility_id,days_of_week, start_date,end_date,
                "action": "registerschedule"
            }
        } else {
            sendData = {
                "schedule_id": scheduleId,
                ficility_id,days_of_week,start_date,end_date,
                "action": "updateschedule"
            }
        }

        $.ajax({
            method: "POST",
            dataType: "json",
            url: "../api/schedule.php",
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
function fetchscheduleInfo(id) {
    var SendingData = {
        action: "readscheduleInfo",
        "schedule_id": id,
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/schedule.php",
        data: SendingData,
        success: (data) => {
            var status = data.status;
            var response = data.data;

            if (status) {
                btnAction = "Updated";
                $("#scheduleModal").modal("show");
                $(".modal-title").html("Update schedule Info! 😍");
                $("#schedule_id").val(response[0].schedule_id);
                $("#ficility_id").val(response[0].ficility_id);
                $("#days_of_week").val(response[0].days_of_week);
                $("#start_date").val(response[0].start_date);
                $("#end_date").val(response[0].end_date);
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
            $("#scheduleForm")[0].reset();
            $("#showImage").attr("src", "");
            $("#scheduleModal").modal("hide");
        }, 3000);
    } else {
        error.classList = "alert alert-danger p-2";
        error.innerHTML = message;
        setTimeout(function () {
            error.classList = "alert alert-danger d-none";
        }, 5000);
    }
};
function deletescheduleInfo(id) {
    let SendingData = {
        action: "deleteschedule",
        "schedule_id": id,
    };
    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/schedule.php",
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
                    text: "You cannot delete this schedule its connection another table as a foreign key ❌",
                    icon: "error",
                });
            }
        },
        error: (data) => {
            Swal.fire({
                title: "Not Deleted!",
                text: "You cannot delete this schedule its connection another table as a foreign key ❌",
                icon: "error",
            });
        },
    });
}

$("#scheduleTable tbody").on("click", "a.update_info  ", function () {
    var id = $(this).attr("delete_id");
    fetchscheduleInfo(id);
});
$("#scheduleTable tbody").on("click", "a.delete_info  ", function () {
    var id = $(this).attr("delete_id");
    Swal.fire({
        title: "Are you?",
        text: "Sure to deletet this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((location) => {
        if (location.isConfirmed) {
            deletescheduleInfo(id);
        }
    });
});
