$("#addNew").click(function () {
    $("#transactionForm")[0].reset();
    // $("#showImage").attr("src", "");
    $("#transactionModal").modal("show");
    $(".modal-title").html("Add new transaction 😍");
});
loadData();
displayFicilities();
displayWaste();
var btnAction = "Insert";

//load categories
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

//load waste
function displayWaste() {
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
            var html = "";
            if (status) {
                html += `<option value="0">Select Option</option>`;
                response.forEach((res) => {
                    html += `<option value="${res["waste_id"]}">${res["description"]}</option>`;
                });
                $("#waste_id").append(html);
            }
        },
    });
}
function loadData() {
    $("#transactionTable tbody").html("");
    var sendData = {
        action: "readAlltransactions",
    };
    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/transaction.php",
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
                        <a class="update_info" delete_id=${res["transaction_id"]}><i class="fa fa-edit fs-4 bg-primary text-light p-2 rounded"></i></a>
                        <a class="delete_info" delete_id=${res["transaction_id"]}><i class="fa fa-trash bg-danger fs-4 p-2 text-light"></i></a>
                        </td>`;
                    tr += "</tr>";
                });

                $("#transactionTable tbody").append(tr);
                $("#transactionTable").DataTable();
            }
        },
    });
}

$("#transactionForm").submit(function (e) {
    e.preventDefault();
    var transactionId = $("#transaction_id").val();
    var ficility_id = $("#ficility_id").val();
    var waste_id = $("#waste_id").val();
    var weight = $("#weight").val();
    var quantity = $("#quantity").val();
    var transaction_method = $("#transaction_method").val();
    if(ficility_id == 0) {
        displayMessage("error", "Ficility Id Is Empry! | Please Select a ficility id");
    }else if(waste_id == 0) {
        displayMessage("error", "Waste Is Empry! | Please Select a  Waste id");
    }
    else if(quantity == 0) {
        displayMessage("error", "quantity Is Empry! | Please enter a quantity");
    } 
    else if(quantity < 0) {
        displayMessage("error", "Invalid quantity | Please enter a valid quantity");
    } 
    else if(transaction_method == 0) {
        displayMessage("error", "Transaction Method Is Empry! | Please Select a transaction Method");
    }
    else {
        var sendData = {};
        if (btnAction == "Insert") {
            sendData = {
               ficility_id, waste_id,quantity, transaction_method,
                "action": "registertransaction"
            }
        } else {
            sendData = {
                "transaction_id": transactionId,
               ficility_id,waste_id,quantity,transaction_method,
                "action": "updatetransaction"
            }
        }

        $.ajax({
            method: "POST",
            dataType: "json",
            url: "../api/transaction.php",
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
function fetchtransactionInfo(id) {
    var SendingData = {
        action: "readtransactionInfo",
        "transaction_id": id,
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/transaction.php",
        data: SendingData,
        success: (data) => {
            var status = data.status;
            var response = data.data;

            if (status) {
                btnAction = "Updated";
                $("#transactionModal").modal("show");
                $(".modal-title").html("Update transaction Info! 😍");
                $("#transaction_id").val(response[0].transaction_id);
                $("#ficility_id").val(response[0].ficility_id);
                $("#waste_id").val(response[0].waste_id);
                $("#quantity").val(response[0].quantity);
                $("#transaction_method").val(response[0].transaction_method);
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
            $("#transactionForm")[0].reset();
            $("#showImage").attr("src", "");
            $("#transactionModal").modal("hide");
        }, 3000);
    } else {
        error.classList = "alert alert-danger p-2";
        error.innerHTML = message;
        setTimeout(function () {
            error.classList = "alert alert-danger d-none";
        }, 5000);
    }
};
function deletetransactionInfo(id) {
    let SendingData = {
        action: "deletetransaction",
        "transaction_id": id,
    };
    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/transaction.php",
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
                    text: "You cannot delete this transaction its connection another table as a foreign key ❌",
                    icon: "error",
                });
            }
        },
        error: (data) => {
            Swal.fire({
                title: "Not Deleted!",
                text: "You cannot delete this transaction its connection another table as a foreign key ❌",
                icon: "error",
            });
        },
    });
}

$("#transactionTable tbody").on("click", "a.update_info  ", function () {
    var id = $(this).attr("delete_id");
    fetchtransactionInfo(id);
});
$("#transactionTable tbody").on("click", "a.delete_info  ", function () {
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
            deletetransactionInfo(id);
        }
    });
});
