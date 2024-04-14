<?php
include '../layouts/protectedPage.php';
include '../layouts/sidebar.php';
include '../layouts/header.php';
?>

<style>
    fieldset.authority-border{
    border:1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em !important;
    -webkit-box-shodow: 0px 0px 0px 0px #ea0707;
            /* box-shodow: 0px 0px 0px 0px #000; */
     }

    legend.authority-border{
        width: inherit;
        padding: 0 10px;
        border-bottom: none;

    }
  
    input[type=checkbox]{
        transform:scale(1.5);
        margin: 5px;
    }
    
    #all_authority{
        transform: scale(2);
        margin: 10px;
    }
</style>
	<main class="content">
   
	<div class="container-fluid p-0">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
								<i class="fa fa-bars fs-4 text-primary"></i> <span class="card-title fs-4">System authority</span>
									<h6 class="card-subtitle text-muted">You can permit the users what we allow 😍.</h6>
									<hr style="border: 1px solid #000;">
                                    <div class="alert alert-success p-2 d-none" role="alert">
                                        Successfully
                                    </div>
                                    <div class="alert alert-danger p-2 d-none" role="alert">
                                        Error
									</div>
                                    <form id="authorizeForm">
                                    <div class="row">
                                    
                                    
                                        <div class="form-group">
                                            <select name="userId" id="userId" class="form-control">
                                               
                                            </select>
                                        </div>
                                    </div>
                                   
                                        <div class="row mt-2">
                                            <div class="col-sm-12">
                                            <fieldset class="border border-1 border-dark rounded-1 px-3">
                                    <legend class="float-none w-auto px-3 text-dark fw-bold">
                                        <input type="checkbox" id="all_authority" name="all_authority" class="me-3">
                                        All Authorities
                                    </legend>
                                    <div class="row" id="authorityArea">
                                    </div>
                                    <div>
                                        <button class="btn btn-primary float-right mt-3" type="submit" id="btn_add_user_authority">Authorize user</button>
                                    </div>
                                </fieldset>
                                            </div>

                                        </div>
                                        </form>
                                    
									
									
								</div>
								<div class="card-body">
                                
								</div>
							</div>
						</div>
					</div>

				</div>			
									
	</main>
		
			


	
<?php
include '../layouts/footer.php';
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/systemAuthorities.js"></script>
