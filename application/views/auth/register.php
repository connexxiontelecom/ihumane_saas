<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<meta content="IHUMANE" name="description" />
	<meta content="Connexxion Group" name="author" />

	<title>IHUMANE</title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/fontawesome/css/all.min.css">

	<!-- Template CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">

</head>
<body>
<div id="app">
	<section class="section">
		<div class="container mt-5">
			<div class="row">
				<div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
					<div class="login-brand">
						<img src="<?php echo base_url() ?>/assets/img/ihumane-logo-1.png" alt="logo" width="100" class="shadow-light">
					</div>

					<div class="card card-primary">
						<div class="card-header"><h4>Register</h4></div>

						<div class="card-body">
							<form method="POST">
								<div class="row">
									<div class="form-group col-6">
										<label for="frist_name">First Name</label>
										<input id="frist_name" type="text" class="form-control" name="frist_name" autofocus>
									</div>
									<div class="form-group col-6">
										<label for="last_name">Last Name</label>
										<input id="last_name" type="text" class="form-control" name="last_name">
									</div>
								</div>

								<div class="form-group">
									<label for="email">Email</label>
									<input id="email" type="email" class="form-control" name="email">
									<div class="invalid-feedback">
									</div>
								</div>

								<div class="row">
									<div class="form-group col-6">
										<label for="password" class="d-block">Password</label>
										<input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
										<div id="pwindicator" class="pwindicator">
											<div class="bar"></div>
											<div class="label"></div>
										</div>
									</div>
									<div class="form-group col-6">
										<label for="password2" class="d-block">Password Confirmation</label>
										<input id="password2" type="password" class="form-control" name="password-confirm">
									</div>
								</div>

								<div class="form-divider">
									Your Home
								</div>
								<div class="row">
									<div class="form-group col-6">
										<label>Country</label>
										<select class="form-control selectric">
											<?php foreach ($countries as $country): ?>
											<option value="<?php echo $country; ?>"><?php echo $country; ?></option>
											<?php endforeach; ?>

										</select>
									</div>
									<div class="form-group col-6">
										<label>Province</label>
										<select class="form-control selectric">
											<option>West Java</option>
											<option>East Java</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-6">
										<label>City</label>
										<input type="text" class="form-control">
									</div>
									<div class="form-group col-6">
										<label>Postal Code</label>
										<input type="text" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" name="agree" class="custom-control-input" id="agree">
										<label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
									</div>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-lg btn-block">
										Register
									</button>
								</div>
							</form>
						</div>
					</div>
					<div class="simple-footer">
						Copyright &copy; Stisla 2018
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="../assets/js/stisla.js"></script>

<!-- JS Libraies -->
<script src="../node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
<script src="../node_modules/selectric/public/jquery.selectric.min.js"></script>

<!-- Template JS File -->
<script src="../assets/js/scripts.js"></script>
<script src="../assets/js/custom.js"></script>

<!-- Page Specific JS File -->
<script src="../assets/js/page/auth-register.js"></script>
</body>
<body>
	<div id="app">
		<section class="section">
			<div class="d-flex flex-wrap align-items-stretch">
				<div class="col-lg-4 col-md-6 col-12 order-lg-1 order-2 bg-white" style="height: 100vh; overflow: auto">
					<div class="p-4 m-3">
						<img src="<?php echo base_url() ?>/assets/img/ihumane-logo-1.png" alt="logo" width="120" class="shadow-light mb-5 mt-2">
						<h4 class="text-dark font-weight-normal">Welcome to <span class="font-weight-bold">IHUMANE</span></h4>
						<p class="text-muted">Before you get started, please login with your credentials.</p>
						<form method="POST" action="<?php echo site_url('login') ?>" class="needs-validation" novalidate="">
							<div class="form-group">
								<label for="username">Username</label>
								<input class="form-control" name="username" type="text" required="" autocomplete="username" placeholder="Username" id="username">
								<div class="invalid-feedback">
									Please fill in your username
								</div>
							</div>

							<div class="form-group">
								<div class="d-block">
									<label for="password-field" class="control-label">Password</label>
								</div>
								<input class="form-control" name="password" type="password" required="" id="password-field" autocomplete="current-password" placeholder="Password">

								<div class="invalid-feedback">
									please fill in your password
								</div>
							</div>

							<input type="hidden" name="<?php echo $csrf_name; ?>" value="<?php echo $csrf_hash; ?>" />

							<?php if ($error != ' ') : ?>
								<div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<i class="mdi mdi-close-circle font-32"></i><strong class="pr-1">Error !</strong> <?php echo $error; ?>.
								</div>
							<?php endif; ?>
							<div class="form-group">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
									<label class="custom-control-label" for="remember-me">Remember Me</label>
								</div>
							</div>

							<div class="form-group text-right">
								<a href="#" class="float-left mt-3">
									Forgot Password?
								</a>
								<button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
									Login
								</button>
							</div>
							<div class="text-center mt-5 text-small">
								Copyright &copy; Connexxion Telecom
								<div class="mt-2">
									<a href="#">Privacy Policy</a>
									<div class="bullet"></div>
									<a href="#">Terms of Service</a>

									<div class="bullet"></div>
									<a href="<?php echo site_url('clock_attendance');?>" target="_blank">Clock In</a>

									<div class="bullet"></div>
									<a href="<?php echo site_url('clockout_attendance');?>" target="_blank">Clock Out</a>
								</div>
							</div>
					</div>
				</div>
				<div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="<?php echo base_url() ?>assets/img/unsplash/login-bg-4-1.jpg">
					<div class="absolute-bottom-left index-2">
						<div class="text-light p-5 pb-2">
							<div class="mb-5 pb-3">
								<h1 class="mb-2 display-4 font-weight-bold greeting">Good Morning</h1>
								<h4 class="font-weight-normal text-muted-transparent">Abuja, Nigeria</h4>
								<h6 id="timestamp"></h6>
							</div>

						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<!-- General JS Scripts -->
	<script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
	<script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>

	<!-- Template JS File -->
	<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
	<script>
		$('title').html('Welcome - IHUMANE');

		$(document).ready(function() {
			setInterval(timestamp, 1000);
			let today = new Date();
			let curHr = today.getHours();
			if (curHr < 12) {
				$('.greeting').html('Good Morning')
			} else if (curHr < 18) {
				$('.greeting').html('Good Afternoon')
			} else {
				$('.greeting').html('Good Evening')
			}
		});

		function timestamp() {
			$.ajax({
				url: '<?php echo site_url('timestamp') ?>',
				success: function(data) {
					$('#timestamp').html(data);
				}
			})
		}
	</script>

</body>

</html>
