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
								<div class="form-divider">
									Your Business Details
								</div>
								<div class="row">
									<div class="form-group col-12">
										<label for="business_name">Business Name</label>
										<input id="business_name" type="text" class="form-control" name="tenant_business_name" autofocus>
									</div>

								</div>

								<div class="form-group">
									<label>Business Website</label>
									<div>
										<input parsley-type="url" type="url" value="https://" class="form-control"
											   required placeholder="URL"/>
									</div>
								</div>


								<div class="row">
									<div class="form-group col-6">
										<label for="business_type">Business Type </label>
										<input id="business_type" type="text" class="form-control" name="tenant_business_type" autofocus>
									</div>

									<div class="form-group col-6">
										<label>Use Case</label>
										<select class="select2 form-control" name="tenant_usage">
											<option value="0" selected></option>

											<option value="academic">Academic</option>
											<option value="business">Business</option>


										</select>	</div>

								</div>
								<div class="row">
									<div class="form-group col-6">
										<label>Country</label>
										<select class="select2 form-control" name="tenant_country">
											<option value="0" selected></option>
											<?php foreach ($countries as $country): ?>
												<option value="<?php echo $country; ?>"><?php echo $country; ?></option>
											<?php endforeach; ?>

										</select>
									</div>
									<div class="form-group col-6">
										<label for="city">City</label>
										<input id="city" name="tenant_city" type="text" class="form-control">
									</div>
								</div>


								<div class="form-divider">
									Your Business Contact Person
								</div>

								<div class="row">

									<div class="form-group col-12">
										<label for="contact_name">Contact Name</label>
										<input id="contact_name" type="text" class="form-control" name="tenant_contact_name">
									</div>
								</div>

								<div class="row">

									<div class="form-group col-12">
										<label for="contact_email">Contact E-Mail</label>
										<input id="contact_email" type="email" class="form-control" name="tenant_contact_email">
									</div>


								</div>

								<div class="row">

									<div class="form-group col-6">
										<label for="contact_phone">Contact Phone Number</label>
										<input id="contact_phone" type="tel" class="form-control" name="tenant_contact_phone">
									</div>

									<div class="form-group col-6">
										<label for="contact_username">Contact Username</label>
										<input id="contact_username" type="text" class="form-control" name="tenant_username">
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
									Plan Details
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
<?php include(APPPATH.'/views/js.php'); ?>
