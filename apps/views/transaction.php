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
								<i class="fa fa-broken fs-4 text-primary"></i> <span class="card-title fs-4">Transactions DataTables</span>
									<h6 class="card-subtitle text-muted">You can add new transaction, update and delete also. fill free to use our system😍.</h6>
									<hr style="border: 1px solid #000;">
									<button type="button" class="btn btn-primary my-1 float-end" id="addNew">
									Add New transaction
									</button>
									
								</div>
								<div class="card-body">
									<table id="transactionTable" class="table table-striped DataTableResponsive" style="width:100%">
										<thead class="table">
											<tr>
												<th>#</th>
												<th>UserId</th>
												<th>FicilityId</th>
												<th>WasteId</th>
												<th>Transaction Date</th>
												<th>Quantity</th>
												<th>Transaction Method</th>
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
				
									<div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-hidden="true">
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
													<form id="transactionForm">
														<div class="row">
															
															<div class="form-group">
																<!-- <label for="injuryId" class="fw-bold text-dark">GameId <span class="text-muted">*</span></label> -->
																<input type="hidden" name="transaction_id" id="transaction_id" class="form-control">
															</div>
															
															
															<!-- <div class="form-group">
																<label for="description" class="fw-bold text-dark">User Id <span class="text-muted">*</span></label>
																<select name="user_id" id="user_id" class="form-control">

                                                                </select>
																	
															</div> -->
															<div class="form-group">
																<label for="ficility_id" class="fw-bold text-dark">Category Id <span class="text-muted">*</span></label>
																<select name="ficility_id" id="ficility_id" class="form-control">
            
                                                                    
                                                                </select>	
																	
															</div>

                                                            <div class="form-group">
																<label for="waste_id" class="fw-bold text-dark">Waste Id <span class="text-muted">*</span></label>
																<select name="waste_id" id="waste_id" class="form-control">
            
                                                                    
                                                                </select>	
																	
															</div>

                                                            <div class="form-group">
																<label for="quantity" class="fw-bold text-dark">Quantity <span class="text-muted">*</span></label>
																<input type="number" name="quantity" id="quantity" class="form-control">	
															</div>


                                                            <div class="form-group">
																<label for="transaction_method" class="fw-bold text-dark">Transaction Method <span class="text-muted">*</span></label>
																<select name="transaction_method" id="transaction_method" class="form-control">
                                                                <option value="0">Select Option</option>
                                                                <option value="Evcplus">Evcplus</option>
                                                                <option value="e-Dahab">e-Dahab</option>
                                                                    
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
<script src="../js/transaction.js"></script>
