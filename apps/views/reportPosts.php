<?php
include '../layouts/protectedPage.php';
include '../layouts/sidebar.php';
include '../layouts/header.php';
?>
<style>
    #showImage {
        height: 50vh;
        width: 100%;
        border: 1px solid #000;
        border-radius: 1px;
        padding: 5px;
        object-fit: cover;
    }
</style>
<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="card bg-muted">
                    <div class="card-header">
                        <i class="fa fa-users fs-4 text-primary"></i> <span class="card-title fs-4">Report DataTables</span>
                        <h6 class="card-subtitle text-muted">You can add new report, update and delete also. Feel free to use our system 😍.</h6>
                        <hr style="border: 1px solid #000;">
                        <button type="button" class="btn btn-primary my-1 float-end" id="addNew">
                            Add New Report Post
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2" id="uploadPosts">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-4">Default modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-1">
                    <div class="alert alert-success p-2 d-none" role="alert">
                        Successfully
                    </div>
                    <div class="alert alert-danger p-2 d-none" role="alert">
                        Error
                    </div>
                    <form id="reportForm" enctype="multipart/form-data">
                        <div class="row">
                            <input type="hidden" name="report_id" id="report_id" class="form-control">
                            <input type="hidden" name="user_id" id="user_id" class="form-control">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="description" class="fw-bold text-dark">Description <span class="text-muted">*</span></label>
                                    <textarea type="text" name="description" id="description" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="image" class="fw-bold text-dark">Image <span class="text-muted">*</span></label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12 text-center mt-2 mb-2">
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
<script src="../js/reportPosts.js"></script>
