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
								<i class="fa fa-broken fs-4 text-primary"></i> <span class="card-title fs-4">Link DataTables</span>
									<h6 class="card-subtitle text-muted">You can add new link, update and delete also. fill free to use our system😍.</h6>
									<hr style="border: 1px solid #000;">
									<button type="button" class="btn btn-primary my-1 float-end" id="addNew">
									Add New Link
									</button>
									
								</div>
								<div class="card-body">
									<table id="linkTable" class="table table-striped DataTableResponsive" style="width:100%">
										<thead class="table">
											<tr>
												<th>#</th>
												<th>Link Name</th>
												<th>Link</th>
												<th>Category ID</th>
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
				
									<div class="modal fade" id="linkModal" tabindex="-1" role="dialog" aria-hidden="true">
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
													<form id="linkForm">
														<div class="row">
															
															<div class="form-group">
																<!-- <label for="injuryId" class="fw-bold text-dark">GameId <span class="text-muted">*</span></label> -->
																<input type="hidden" name="linkId" id="linkId" class="form-control">
															</div>
															
															
															<div class="form-group">
																<label for="linkName" class="fw-bold text-dark">Link Name <span class="text-muted">*</span></label>
																<input type="text" name="linkName" id="linkName" class="form-control">
																	
															</div>
                                                            <div class="form-group">
																<label for="link" class="fw-bold text-dark">Link <span class="text-muted">*</span></label>
																<select name="link" id="link" class="form-control">
                                                                   
                                                                </select>	
															</div>
															
															<div class="form-group">
																<label for="categoryId" class="fw-bold text-dark">CategoryId <span class="text-muted">*</span></label>
																<select name="categoryId" id="categoryId" class="form-control">
                                                                   
                                                                </select>	
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
<script src="../js/systemLinks.js"></script>
