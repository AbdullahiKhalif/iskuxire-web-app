<?php
include '../layouts/protectedPage.php';
include '../layouts/sidebar.php';
include '../layouts/header.php';
?>
</style>
	<main class="content">
				<div class="container-fluid p-0">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
								<i class="fa fa-broken fs-4 text-primary"></i> <span class="card-title fs-4">Category DataTables</span>
									<h6 class="card-subtitle text-muted">You can add new category, update and delete also. fill free to use our system😍.</h6>
									<hr style="border: 1px solid #000;">
									<button type="button" class="btn btn-primary my-1 float-end" id="addNew">
									Add New Category
									</button>
									
								</div>
								<div class="card-body">
									<table id="categoryTable" class="table table-striped DataTableResponsive" style="width:100%">
										<thead class="table">
											<tr>
												<th>#</th>
												<th>Category Name</th>
												<th>Category Status</th>
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
				
									<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-hidden="true">
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
													<form id="categoryForm">
														<div class="row">
															
															<div class="form-group">
																<!-- <label for="injuryId" class="fw-bold text-dark">GameId <span class="text-muted">*</span></label> -->
																<input type="hidden" name="id" id="id" class="form-control">
															</div>
															
															
															<div class="form-group">
																<label for="categoryName" class="fw-bold text-dark">Category Name <span class="text-muted">*</span></label>
																<input type="text" name="category_name" id="category_name" class="form-control">
																	
															</div>
															<div class="form-group">
																<label for="status" class="fw-bold text-dark">Category Status <span class="text-muted">*</span></label>
																<select name="status" id="status" class="form-control">
                                                                    <option value="0">Selct Option</option>
                                                                    <option value="Available">Available</option>
                                                                    <option value="Not Available">Not Available</option>
                                                                    
                                                                </select>	
																	
															</div>
															<div class="form-group">
																<label for="date" class="fw-bold text-dark">Date <span class="text-muted">*</span></label>
																<input type="date" name="date" id="date" class="form-control">	
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
<script src="../js/category.js"></script>
