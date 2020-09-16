<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>


<?php include(APPPATH.'/views/stylesheet.php'); ?>
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
									<div class="form-group col-12">
										<label for="business_name">Business Name</label>
										<input id="business_name" type="text" class="form-control" name="tenant_business_name" autofocus>
									</div>

								</div>

								<div class="form-group">
									<label>Business URL</label>
									<div>
										<input parsley-type="url" type="url" class="form-control"
											   required placeholder="URL"/>
									</div>
								</div>

								<div class="row">
									<div class="form-group col-6">
										<label for="business_website">Business Website</label>
										<input id="frist_name" type="text" class="form-control" name="tenant_business_name" autofocus>
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
										<select class="select2 form-control">
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


</body>


</html>
