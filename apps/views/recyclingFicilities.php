<?php
include '../layouts/protectedPage.php';
include '../layouts/sidebar.php';
include '../layouts/header.php';
?>

<style>
    #showImage {
        height: 200px;
        width: 950px;
        border: 1px solid #000;
        border-radius: 1px;
        padding: 4px;
    }
</style>

<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-recycling fs-4 text-primary"></i>
                        <span class="card-title fs-4">Recycle Facilities DataTables</span>
                        <h6 class="card-subtitle text-muted">You can add new recycling, update and delete also. Feel free to use our system 😍.</h6>
                        <hr style="border: 1px solid #000;">
                        <button type="button" class="btn btn-primary my-1 float-end" id="addNew">
                            Add New recycling
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="recyclingTable" class="table table-striped DataTableResponsive" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Logo</th>
                                        <th>Description</th>
                                        <th>LocId</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 12px;"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="recyclingModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-4">Recycling Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-1">
                    <div class="alert alert-success p-2 d-none" role="alert">
                        Successfully
                    </div>
                    <div class="alert alert-danger p-2 d-none" role="alert">
                        Error
                    </div>
                    <form id="recyclingForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group">
                                <input type="hidden" name="ficility_id" id="ficility_id" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="ficility_name" class="fw-bold text-dark">Facility Name <span class="text-muted">*</span></label>
                                <input type="text" name="ficility_name" id="ficility_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="description" class="fw-bold text-dark">Description <span class="text-muted">*</span></label>
                                <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="location_id" class="fw-bold text-dark">Location Id <span class="text-muted">*</span></label>
                                <select name="location_id" id="location_id" class="form-control"></select>
                            </div>
                            <div class="form-group">
                                <label for="email" class="fw-bold text-dark">Email <span class="text-muted">*</span></label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="phone_no" class="fw-bold text-dark">Phone <span class="text-muted">*</span></label>
                                <input type="number" name="phone_no" id="phone_no" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="image" class="fw-bold text-dark">Image <span class="text-muted">*</span></label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <div class="text-center mt-2 mb-2">
                                <img class="img-fluid" id="showImage">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
include '../layouts/footer.php';
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/recycling.js"></script>
