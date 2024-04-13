<?php
session_start();
session_destroy();
session_unset();
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from appstack.bootlab.io/pages-sign-in by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Dec 2023 06:47:39 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Bootstrap 5 Admin &amp; Dashboard Template">
	<meta name="author" content="Bootlab">

	<title>Log In | Basketball &amp;</title>

	<link rel="canonical" href="pages-sign-in-2.html" />
	<link rel="shortcut icon" href="../..//assets/img/favicon.ico">

	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">

	<!-- Choose your prefered color scheme -->
	<!-- <link href="css/light.css" rel="stylesheet"> -->
	<!-- <link href="css/dark.css" rel="stylesheet"> -->

	<!-- BEGIN SETTINGS -->
	<!-- Remove this after purchasing -->
	<link class="js-stylesheet" href="../../assets/css/light.css" rel="stylesheet">
	<script src="js/settings.js"></script>
	<!-- END SETTINGS -->
<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
	<div class="main d-flex justify-content-center w-100">
		<main class="content d-flex p-0">
			<div class="container d-flex flex-column">
				<div class="row h-100">
					<div class="col-sm-8 col-md-8 col-lg-8 col-xl-4 mx-auto d-table h-100">
						<div class="d-table-cell align-middle">


							<div class="card">
								<div class="card-body">
									<div class="m-sm-3">
										
										<div class="row">
											
											<div class="text-center">
											<i class="fa fa-unlock display-6 text-primary mb-4" aria-hidden="true"></i>
											<h1>Login</h1>
											</div>
											<form id="loginForm">
											<div class="mb-3">
												<label class="form-label">Email</label>
												<input class="form-control form-control-lg" type="text" name="email" placeholder="Enter Your username" id="username"/>
											</div>
											<div class="mb-3">
												<label class="form-label">Password</label>
												<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" id="password"/>
												<small>
												<a href='#'>Forgot password?</a>
											</small>
											</div>
											<div>
												<div class="form-check align-items-center">
													<input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me" checked>
													<label class="form-check-label text-small" for="customControlInline">Remember me</label>
												</div>
											</div>
											<div class="d-grid gap-2 mt-3">
												<button type="submit" class='btn btn-lg btn-primary'>Sign in</button>
											</div>
										</form>
										</div>
										
									</div>
								</div>
							</div>
							<!-- <div class="text-center mb-3">
								Don't have an account? <a href='pages-sign-up.html'>Sign up</a>
							</div> -->
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>

	<script src="../../assets/js/app.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="../js/login.js"></script>

</body>


<!-- Mirrored from appstack.bootlab.io/pages-sign-in by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Dec 2023 06:47:40 GMT -->
</html>