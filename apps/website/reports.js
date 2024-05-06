loadData();
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
              <div class="row justify-content-center mb-4" style="cursor: pointer;">
                <div class="col-lg-6 col-md-10 col-sm-12">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-3">
                        <img src="../uploads/users/${item['user_id']}.png" alt="img" class="img-fluid rounded-circle" style="width:40px;height:40px; border: 1px solid #ddd;">
                        <h3 class="fs-6 fw-bold ms-3">${item['username']}</h3>
                        <span class="ms-auto fs-6">${item['report_date']}</span>
                      </div>
                      <hr>
                      <div class="mb-3">
                        ${item['description']}
                      </div>
                      <img src="../uploads/report posts/${item['image']}" alt="img" class="w-100 img-fluid img-report" style="object-fit: cover;">
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
  
  $("#uploadPosts").on("click","a.update_info", function(){
      var id = $(this).attr("update_id");
      fetchreportInfo(id);
  });