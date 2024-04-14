$("#all_authority").on("change", function () {
    if ($(this).is(":checked")) {
        $("input[type='checkbox']").prop('checked', true);
    } else {
        $("input[type='checkbox']").prop('checked', false);
    }
})
$("#authorityArea").on("change", "input[name='role_authority[]']", function () {
    var value = $(this).val();
    if ($(this).is(":checked")) {
        $(`#authorityArea input[type='checkbox'][role='${value}']`).prop("checked", true);
    } else {
        $(`#authorityArea input[type='checkbox'][role='${value}']`).prop("checked", false);
    }
})
$("#authorityArea").on("change", "input[name='systemLinks[]']", function () {
    var value = $(this).val();
    console.log(value);
    if ($(this).is(":checked")) {
        $(`#authorityArea input[type='checkbox'][link_id='${value}']`).prop("checked", true);
    } else {
        $(`#authorityArea input[type='checkbox'][link_id='${value}']`).prop("checked", false);
    }
})

$("#userId").on("change", function () {
    var id = $(this).val();
    displayUserPermissions(id);
})

loadData();
displayUsers();

function loadData() {
    var sendData = {
        action: "getSystemAuthorties",
    };
    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/authorities.php",
        data: sendData,
        success: (data) => {
            var status = data.status;
            var response = data.data;
            var html = "";
            var role = "";
            var systemLinks = "";
            var systemActions = "";
            if (status) {
                response.forEach((res) => {
                    if (res['categoryRole'] !== role) {
                        html += `
                            </fieldset></div></div>
                            <div class="col-sm-4">
                                    <fieldset class="border border-1 border-dark rounded-1 px-3">
                                    <legend  class="float-none w-auto px-3 text-dark fw-bold">
                                        <input type="checkbox" name="role_authority[]" id="" value="${res['categoryRole']}"/>
                                        ${res['categoryRole']}
                                    </legend>
                                    

                        `;
                        role = res['categoryRole'];
                        // console.log(role)
                    }
                    if (res['linkName'] !== systemLinks) {
                        html += `
                        <div class="control-label">
                        <label class="control-label input-label">
                         <input type="checkbox" name="systemLinks[]" role="${res['categoryRole']}" id="" value="${res['id']}" category_id="${res['category_id']}" link_id="${res['id']}" style="margin-left:45px !important;"> 
                         ${res['linkName']}
                        </label>
                        <div>
                        `;
                        systemLinks = res['linkName']
                    }
                    

                });

                $("#authorityArea").append(html);
            }
        },
    });
}
function displayUsers() {
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
            var html = "";
            if (status) {
                html += `<option value="0">Select Option</option>`;
                response.forEach((res) => {
                    html += `<option value="${res["user_id"]}">${res["username"]}</option>`;
                });
                $("#userId").append(html);
            }
        },
    });
}
function displayUserPermissions(id) {
    var sendData = {
        action: "getUserAuthorties",
        "userId": id
    };
    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/authorities.php",
        data: sendData,
        success: (data) => {
            var status = data.status;
            var response = data.data;
            if (status) {
                if (response.length >= 1) {
                    response.forEach(users => {
                        $(`input[type='checkbox'][name='role_authority[]'][value='${users['categoryRole']}']`).prop("checked", true);

                        $(`input[type='checkbox'][name='systemLinks[]'][value='${users['id']}']`).prop("checked", true);
                       
                    })
                }else{
                    $("input [type='checkbox']").prop("checked", false);   
                }
            } else {
                displayMessage("Error", response);
            }
        },
    });
}

$("#authorizeForm").submit(function (event) {
    event.preventDefault();
    var userId = $("#userId").val();
    var actions = [];
    $("input[name='systemLinks[]']").each(function () {
        if ($(this).is(":checked")) {
            actions.push($(this).val())
        }
    })
    if (userId == 0) {
        $(".alert-success").addClass("d-none");
        $(".alert-danger").removeClass("d-none");
        $(".alert-danger").html("Please Select a user❌");
        setTimeout(function () {
            $(".alert-danger").addClass("d-none");
        }, 3000)
        return;
    }
    console.log(actions);
    var sendData = {
        "userId": userId,
        "action_id": actions,
        "action": "authorizeUser"
    };
    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "../api/authorities.php",
        data: sendData,
        success: (data) => {
            var status = data.status;
            var response = data.data;
            if (status) {
                response.forEach(res => {
                    $(".alert-success").removeClass("d-none");
                    $(".alert-danger").addClass("d-none");
                    $(".alert-success").html(res['data']);
                    setTimeout(function () {
                        $(".alert-success").addClass("d-none");
                        $("#authorizeForm")[0].reset();
                    }, 5000)
                    console.log(res['data'])
                })
            } else {
                var error = "<ul>";
                $(".alert-danger").removeClass("d-none");
                response.forEach(res => {
                    error += `<li>${res['data']}</li>`
                })
                error += "</ul>";
                $(".alert-danger").html(error);
                console.log(error)
            }
        },
        error: (data) => {

        }
    })
})