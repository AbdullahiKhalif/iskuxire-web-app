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
								<i class="fa fa-broken fs-4 text-primary"></i> <span class="card-title fs-4">Waste DataTables</span>
									<h6 class="card-subtitle text-muted">You can add new Waste, update and delete also. fill free to use our system😍.</h6>
									<hr style="border: 1px solid #000;">
									<button type="button" class="btn btn-primary my-1 float-end" id="addNew">
									Add New Waste
									</button>
									
								</div>
								<div class="card-body">
									<table id="wasteTable" class="table table-striped DataTableResponsive" style="width:100%">
										<thead class="table">
											<tr>
												<th>#</th>
												<th>Description</th>
												<th>CatId</th>
												<th>Date</th>
												<th>Weight</th>
												<th>UserId</th>
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
				
									<div class="modal fade" id="wasteModal" tabindex="-1" role="dialog" aria-hidden="true">
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
													<form id="wasteForm">
														<div class="row">
															
															<div class="form-group">
																<!-- <label for="injuryId" class="fw-bold text-dark">GameId <span class="text-muted">*</span></label> -->
																<input type="hidden" name="waste_id" id="waste_id" class="form-control">
															</div>
															
															
															<div class="form-group">
																<label for="description" class="fw-bold text-dark">Description <span class="text-muted">*</span></label>
																<textArea type="text" name="description" id="description" class="form-control" rows="5"> </textArea>
																	
															</div>
															<div class="form-group">
																<label for="category_id" class="fw-bold text-dark">Category Id <span class="text-muted">*</span></label>
																<select name="category_id" id="category_id" class="form-control">
            
                                                                    
                                                                </select>	
																	
															</div>

                                                            <div class="form-group">
																<label for="address" class="fw-bold text-dark">Address <span class="text-muted">*</span></label>
																<input type="text" name="address" id="address" class="form-control">	
															</div>

															<div class="form-group">
																<label for="weight" class="fw-bold text-dark">Weight <span class="text-muted">*</span></label>
																<input type="number" name="weight" id="weight" class="form-control">	
															</div>

                                                            <div class="form-group">
																<label for="user_id" class="fw-bold text-dark">User Id <span class="text-muted">*</span></label>
																<select name="user_id" id="user_id" class="form-control">
            
                                                                    
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
<script src="../js/waste.js"></script>
