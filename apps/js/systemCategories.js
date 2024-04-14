$("#addNew").click(function () {
    $("#categoryForm")[0].reset();
    $("#categoryModal").modal("show");
    $(".modal-title").html("Add new category 😍");
});
loadData();
var btnAction = "Insert";

function loadData() {
    $("#categoryTable tbody").html("");
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

                $("#categoryTable tbody").append(tr);
                $("#categoryTable").DataTable();
            }
        },
    });
}

$("#categoryForm").submit(function (e) {
    e.preventDefault();
    var categoryId = $("#categoryId").val();
    var categoryName = $("#categoryName").val();
    var categoryIcon = $("#categoryIcon").val();
    var categoryRole = $("#categoryRole").val();
    var ties = $("#ties").val();
    if (categoryName == "") {
        displayMessage("error", "Category Name Empry! | Please enter a CategoryName");
    }else if(categoryIcon == 0) {
        displayMessage("error", "category Icon Is Empry! | Please enter a CategoryIcon");
    }else if(categoryRole == 0) {
        displayMessage("error", "Category Role Is Empry! | Please Select a CategoryRole");
    } 
    else {
        var sendData = {};
        if (btnAction == "Insert") {
            sendData = {
                categoryName,categoryIcon,categoryRole,
                "action": "registerCategory"
            }
        } else {
            sendData = {
                "id": categoryId,
                categoryName,categoryIcon,categoryRole,
                "action": "updateCategory"
            }
        }

        $.ajax({
            method: "POST",
            dataType: "json",
            url: "../api/systemCategories.php",
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
function fetchCategoryInfo(id) {
    var SendingData = {
        action: "getCategoryInfo",
        "id": id,
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/systemCategories.php",
        data: SendingData,
        success: (data) => {
            var status = data.status;
            var response = data.data;

            if (status) {
                btnAction = "Updated";
                $("#categoryModal").modal("show");
                $(".modal-title").html("Update Category Info! 😍");
                $("#categoryId").val(response[0].id);
                $("#categoryName").val(response[0].categoryName);
                $("#categoryIcon").val(response[0].categoryIcon);
                $("#categoryRole").val(response[0].categoryRole);
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
            $("#categoryForm")[0].reset();
            $("#showImage").attr("src", "");
            $("#categoryModal").modal("hide");
        }, 3000);
    } else {
        error.classList = "alert alert-danger p-2";
        error.innerHTML = message;
        setTimeout(function () {
            error.classList = "alert alert-danger d-none";
        }, 5000);
    }
};
function deleteCategoryInfo(id) {
    let SendingData = {
        action: "deleteCategory",
        "id": id,
    };
    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/systemCategories.php",
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
                    text: "You cannot delete this category its connection another table as a foreign key ❌",
                    icon: "error",
                });
            }
        },
        error: (data) => {
            Swal.fire({
                title: "Not Deleted!",
                text: "You cannot delete this category its connection another table as a foreign key ❌",
                icon: "error",
            });
        },
    });
}

$("#categoryTable tbody").on("click", "a.update_info  ", function () {
    var id = $(this).attr("delete_id");
    fetchCategoryInfo(id);
});
$("#categoryTable tbody").on("click", "a.delete_info  ", function () {
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
            deleteCategoryInfo(id);
        }
    });
});
