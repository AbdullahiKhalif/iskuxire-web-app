<?php
include '../layouts/protectedPage.php';
include '../layouts/sidebar.php';
include '../layouts/header.php';
?>
<style>
	#showImage{
		height: 150px;
		width: 150px;
		border: 1px solid #000;
		border-radius : 50%;
		object-fit: cover;
	}
</style>
	<main class="content">
				<div class="container-fluid p-0">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
								<i class="fa fa-user fs-4 text-primary"></i> <span class="card-title fs-4">Users DataTables</span>
									<h6 class="card-subtitle text-muted">You can add new user, update and delete also. fill free to use our system😍.</h6>
									<hr style="border: 1px solid #000;">
									<button type="button" class="btn btn-primary my-1 float-end" id="addNew">
									Add New User
									</button>
									
								</div>
								<div class="card-body">
									<table id="userTable" class="table table-striped DataTableResponsive" style="width:100%">
										<thead class="table">
											<tr>
												<th>#</th>
												<th>Username</th>
												<th>Email</th>
												<th>Password</th>
												<th>Phone</th>
												<th>Role</th>
												<th>Image</th>
												<th>Status</th>
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
				
									<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title fs-4">Default modal</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body m-1">
												<div class="alert alert-success p-2 d-none"role="alert">
																Successfully
															</div>
															<div class="alert alert-danger p-2 d-none"role="alert">
																Error
															</div>
													<form id="userForm" enctype="multipart/form-data">
														<div class="row">
															
															<div class="form-group">
																<!-- <label for="userid" class="fw-bold text-dark">UserId <span class="text-muted">*</span></label> -->
																<input type="hidden" name="userId" id="userId" class="form-control">
															</div>
															<div class="form-group">
																<label for="userid" class="fw-bold text-dark">Username <span class="text-muted">*</span></label>
																<input type="text" name="username" id="username" class="form-control">
															</div>
															<div class="form-group">
																<label for="email" class="fw-bold text-dark">Email <span class="text-muted">*</span></label>
																<input type="email" name="email" id="email" class="form-control">
															</div>
															<div class="form-group">
																<label for="password" class="fw-bold text-dark">Password <span class="text-muted">*</span></label>
																<input type="password" name="password" id="password" class="form-control">
															</div>
															<div class="form-group">
																<label for="phone" class="fw-bold text-dark">Phone <span class="text-muted">*</span></label>
																<input type="number" name="phone" id="phone" class="form-control">
															</div>
															<div class="form-group">
																<label for="role" class="fw-bold text-dark">Role <span class="text-muted">*</span></label>
																<select name="role" id="role" class="form-control">
																	<option value="0">Select Options</option>
																	<option value="Super Admin">Super Admin</option>
																	<option value="User">User</option>
																	<option value="Coach">Coach</option>
																	<option value="Admin">Admin</option>
																</select>
															</div>
															<div class="form-group">
																<label for="status" class="fw-bold text-dark">Status <span class="text-muted">*</span></label>
																<select name="status" id="status" class="form-control">
																	<option value="0">Select Options</option>
																	<option value="Active">Active</option>
																	<option value="Block">Block</option>
																	
																</select>
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
												</form
											</div>
										</div>
									</div>
			</main>
		
			


	
<?php
include '../layouts/footer.php';
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/users.js"></script>
