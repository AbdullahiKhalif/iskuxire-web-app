<?php
include '../layouts/protectedPage.php';
include '../layouts/sidebar.php';
include '../layouts/header.php';
?>
  <main class="content">
          <div class="container-fluid p-0">
            <div class="row mb-2 mb-xl-3">
              <div class="col-auto d-none d-sm-block">
                <h3>Dashboard</h3>
              </div>

              <div class="col-auto ms-auto text-end mt-n1">
                <div class="dropdown me-2 d-inline-block position-relative">
                  <a
                    class="btn btn-light bg-white shadow-sm dropdown-toggle"
                    href="#"
                    data-bs-toggle="dropdown"
                    data-bs-display="static"
                  >
                    <i class="align-middle mt-n1" data-feather="calendar"></i>
                    Today
                  </a>

                  <div class="dropdown-menu dropdown-menu-end">
                    <h6 class="dropdown-header">Settings</h6>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                  </div>
                </div>

                <button class="btn btn-primary shadow-sm">
                  <i class="align-middle" data-feather="filter">&nbsp;</i>
                </button>
                <button class="btn btn-primary shadow-sm">
                  <i class="align-middle" data-feather="refresh-cw">&nbsp;</i>
                </button>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-sm-4 col-xxl-3 d-flex">
                <div class="card illustration flex-fill">
                  <div class="card-body p-0 d-flex flex-fill">
                    <div class="row g-0 w-100">
                      <div class="col-6">
                        <div class="illustration-text p-3 m-1">
                          <h4 class="illustration-text">
                            Welcome Back, <?php echo $_SESSION['username']?>!
                          </h4>
                          <p class="mb-0">Iskuxire Dashboard</p>
                        </div>
                      </div>
                      <div class="col-6 align-self-end text-end">
                        <img
                          src="../../assets/img/illustrations/customer-support.png"
                          alt="Customer Support"
                          class="img-fluid illustration-img"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-4 col-xxl-3 d-flex">
                <div class="card flex-fill">
                  <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                      <div class="flex-grow-1">
                        <h3 class="mb-2" id="totalUsers">0</h3>
                        <p class="mb-2">Total Users</p>
                        
                      </div>
                      <div class="d-inline-block ms-3">
                        <div class="stat">
                          <i
                            class="fa fa-users fs-3"
                          ></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-12 col-sm-4 col-xxl-3 d-flex">
                <div class="card flex-fill">
                  <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                      <div class="flex-grow-1">
                        <h3 class="mb-2" id="totalCategory">0</h3>
                        <p class="mb-2">Total Categories</p>
                        
                      </div>
                      <div class="d-inline-block ms-3">
                        <div class="stat">
                          <i
                            class="fa fa-users fs-3"
                          ></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-4 col-xxl-3 d-flex">
                <div class="card flex-fill">
                  <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                      <div class="flex-grow-1">
                        <h3 class="mb-2" id="totalWaste">0</h3>
                        <p class="mb-2">Total Waste</p>
                        
                      </div>
                      <div class="d-inline-block ms-3">
                        <div class="stat">
                          <i
                            class="fa fa-users fs-3"
                          ></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 col-sm-4 col-xxl-3 d-flex">
                <div class="card flex-fill">
                  <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                      <div class="flex-grow-1">
                        <h3 class="mb-2" id="totalLocation">0</h3>
                        <p class="mb-2">Total Locations</p>
                        
                      </div>
                      <div class="d-inline-block ms-3">
                        <div class="stat">
                          <i
                            class="fa fa-users fs-3"
                          ></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 col-sm-4 col-xxl-3 d-flex">
                <div class="card flex-fill">
                  <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                      <div class="flex-grow-1">
                        <h3 class="mb-2" id="totalRecycle">0</h3>
                        <p class="mb-2">Total Recycles</p>
                        
                      </div>
                      <div class="d-inline-block ms-3">
                        <div class="stat">
                          <i
                            class="fa fa-users fs-3"
                          ></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-12 col-sm-4 col-xxl-3 d-flex">
                <div class="card flex-fill">
                  <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                      <div class="flex-grow-1">
                        <h3 class="mb-2" id="totalTransactions">0</h3>
                        <p class="mb-2">Total Transactions</p>
                        
                      </div>
                      <div class="d-inline-block ms-3">
                        <div class="stat">
                          <i
                            class="fa fa-users fs-3"
                          ></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 col-sm-4 col-xxl-3 d-flex">
                <div class="card flex-fill">
                  <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                      <div class="flex-grow-1">
                        <h3 class="mb-2" id="totalReport">0</h3>
                        <p class="mb-2">Total Post Reports</p>
                        
                      </div>
                      <div class="d-inline-block ms-3">
                        <div class="stat">
                          <i
                            class="fa fa-users fs-3"
                          ></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-12 col-sm-4 col-xxl-3 d-flex">
                <div class="card flex-fill">
                  <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                      <div class="flex-grow-1">
                        <h3 class="mb-2" id="totalSchedule">0</h3>
                        <p class="mb-2">Total Schedule</p>
                        
                      </div>
                      <div class="d-inline-block ms-3">
                        <div class="stat">
                          <i
                            class="fa fa-users fs-3"
                          ></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>



            <div class="card flex-fill">
              <div class="card-header">
                <div class="card-actions float-end">
                  <div class="dropdown position-relative">
                    <a
                      href="#"
                      data-bs-toggle="dropdown"
                      data-bs-display="static"
                    >
                      <i
                        class="align-middle"
                        data-feather="more-horizontal"
                      ></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <h5 class="card-title mb-0">Schedule Recycle Ficilities!</h5>
              </div>
              <table
                id="scheduleStatsReportTable"
                class="table table-striped my-0"
              >
                <thead>
                  <tr>
                    <th>Schedule Id</th>
                    <th class="d-none d-xl-table-cell">Recycle Ficility Name</th>
                    <th class="d-none d-xl-table-cell">Days Of Week</th>
                    <th class="d-none d-xl-table-cell">Start Date</th>
                    <th class="d-none d-md-table-cell">End Date</th>
                   
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </main>


<?php
include '../layouts/footer.php';
?>

<script src="../js/dashboard.js"></script>