loadTotalUsers();
loadScheduleTable();
loadTotalCategory();
loadTotalLocation();
loadTotalReports();
loadTotalSchedule();
loadTotalWaste();
loadTotalTransactions();
loadTotalRecycle();
function loadTotalUsers() {
    var sendData = {
        "action": "getTotalUsers"
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/dashboard.php",
        data: sendData,
        success: (data) => {
            var status = data.status;
            var response = data.data;
            if (status) {
                $("#totalUsers").html(response[0].total);
            } else {
                console.log(response);
            }
        }
    })
}
function loadTotalRecycle() {
    var sendData = {
        "action": "getTotalRecycle",
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/dashboard.php",
        data: sendData,
        success: (data) => {
            var status = data.status;
            var response = data.data;
            if (status) {
                $("#totalRecycle").html(response[0].total);
            } else {
                console.log(response);
            }
        }
    })
}
function loadTotalSchedule() {
    var sendData = {
        "action": "getTotalSchedule"
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/dashboard.php",
        data: sendData,
        success: (data) => {
            var status = data.status;
            var response = data.data;
            if (status) {
                $("#totalSchedule").html(response[0].total);
            } else {
                console.log(response);
            }
        }
    })
}
function loadTotalCategory() {
    var sendData = {
        "action": "getTotalCategories"
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/dashboard.php",
        data: sendData,
        success: (data) => {
            var status = data.status;
            var response = data.data;
            if (status) {
                $("#totalCategory").html(response[0].total);
            } else {
                console.log(response);
            }
        }
    })
}
function loadTotalWaste() {
    var sendData = {
        "action": "getTotalWaste"
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/dashboard.php",
        data: sendData,
        success: (data) => {
            var status = data.status;
            var response = data.data;
            if (status) {
                $("#totalWaste").html(response[0].total);
            } else {
                console.log(response);
            }
        }
    })
}
function loadTotalLocation() {
    var sendData = {
        "action": "getTotalLocation"
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/dashboard.php",
        data: sendData,
        success: (data) => {
            var status = data.status;
            var response = data.data;
            if (status) {
                $("#totalLocation").html(response[0].total);
            } else {
                console.log(response);
            }
        }
    })
}

function loadTotalTransactions() {
    var sendData = {
        "action": "getTotalTransactions",
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/dashboard.php",
        data: sendData,
        success: (data) => {
            var status = data.status;
            var response = data.data;
            if (status) {
                $("#totalTransactions").html(response[0].total);
            } else {
                console.log(response);
            }
        }
    })
}

function loadTotalReports() {
    var sendData = {
        "action": "getTotalReport"
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/dashboard.php",
        data: sendData,
        success: (data) => {
            var status = data.status;
            var response = data.data;
            if (status) {
                $("#totalReport").html(response[0].total);
            } else {
                console.log(response);
            }
        }
    })
}
function loadScheduleTable() {
    $("#scheduleStatsReportTable tbody").html("");
    var SendingData = {
        "action": "getScheduleTable",
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/dashboard.php",
        data: SendingData,

        success: (data) => {
            var status = data.status;
            var response = data.data;
            var tr = '';
            var th = '';

            if (status) {
                response.forEach(item => {

                    tr += "<tr>";
                    for (let i in item) {
                        tr += `<td>${item[i]}</td>`;

                    }


                    tr += "</tr>";
                })
                $("#scheduleStatsReportTable tbody").append(tr);
            }
        }
    })
}