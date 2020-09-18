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
							<form method="post" action="<?php echo site_url('register_a') ?>" id="register-form" enctype="multipart/form-data" class="needs-validation" novalidate>
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
										<input parsley-type="url" type="url" value="https://" name="tenant_business_website" class="form-control"
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

								<div class="row">
									<div class="form-group col-6">
										<label for="payroll_start_year">Payroll Start Year</label>
										<input id="payroll_start_year" name="payroll_start_year" type="number" onkeypress="return isNumber(event)" value="<?php echo date("Y"); ?>" class="form-control">
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

								<input type="hidden" name="<?php echo $csrf_name; ?>" value="<?php echo $csrf_hash; ?>" />


								<div class="row">
									<div class="form-group col-6">
										<label for="password" class="d-block">Password</label>
										<input id="password" type="password" class="form-control pwstrength" onkeyup="check_password()" data-indicator="pwindicator" name="tenant_password">
										<div id="pwindicator" class="pwindicator">
											<div class="bar"></div>
											<div class="label"></div>
										</div>
									</div>
									<div class="form-group col-6">
										<label for="password_confirm" class="d-block">Password Confirmation</label>
										<input id="password_confirm" type="password" onkeyup="check_password()" class="form-control" name="password-confirm">
									</div>
								</div>
								<div id="password_alert">
									<div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert" >
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<i class="mdi mdi-close-circle font-32"></i><strong class="pr-1">Error !</strong> Password Do Not Match.
									</div>
								</div>
								<div class="form-divider">
									Plan Details
								</div>
								<div class="row">
									<div class="form-group col-12">
										<label>Plan</label>
										<select class="select2 form-control" id="plan" name="tenant_plan" onchange="check()">
											<option value="0" selected></option>
											<?php foreach ($plans as $plan): ?>
											<option value="<?php echo $plan->plan_id; ?>" <?php if(!empty($plan_id)): if($plan_id == $plan->plan_id ): echo 'selected'; endif; endif; ?>> <span> &#8358; </span> <?php echo number_format($plan->plan_price)." ".$plan->plan_name." - ".$plan->plan_duration."Day(s)"; ?></option>
											<?php endforeach; ?>

										</select>
									</div>

								</div>

								<input type="hidden" id="price" value="<?php if(!empty($pla)): echo $pla->plan_price * 100; endif; ?>">


								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" name="agree" class="custom-control-input" id="agree">
										<label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
									</div>
								</div>


								<div class="form-group" <?php if (empty($plan_id) || $plan_id == 1): ?>style="display: none" <?php endif; ?> id="paid" >
									<button type="button" onclick="payWithPaystack()" id="paybutton" class="btn btn-primary btn-lg btn-block">
										Pay the Sum of   <span> &#8358; </span> <?php echo number_format($pla->plan_price)." ".$pla->plan_name." - ".$pla->plan_duration."Day(s)"; ?> To Register
									</button>
								</div>

								<div class="form-group"   <?php if (@empty($plan_id) || @$plan_id > 1): ?>style="display: none" <?php endif; ?>  <?php if (!@empty($plan_id) || @$plan_id == 1): ?>style="display: block" <?php endif; ?>
									<button  class="btn btn-primary btn-lg btn-block">
										Register For Free Trial
									</button>
								</div>

						<div class="form-group" id="free" style="display: none" >
						<button  class="btn btn-primary btn-lg btn-block">
							Register For Free Trial
						</button>
					</div>
							</form>
						</div>
					</div>
					<div class="simple-footer">
						Copyright &copy; Connexxion Telecom
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


</body>


</html>
<?php include(APPPATH.'/views/js.php'); ?>

<script>

	document.getElementById('password_alert').style.display = 'none';

	function check_password() {
		var password = document.getElementById('password').value;
		var password_confirm = document.getElementById('password_confirm').value;

		if(password === password_confirm){
			document.getElementById('password_alert').style.display = 'none';
			document.getElementById('password_success').style.display = 'block';
		}else{
			document.getElementById('password_alert').style.display = 'block';
			document.getElementById('password_success').style.display = 'none';

		}
	}

	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		else{
				var year = document.getElementById('payroll_start_year').value;
				var length = year.length;
				if(length < 4){
					return  true
				}
			return false;
		}
	}


	function check(){
		var sel = document.getElementById('plan');
		var toggle = document.getElementById('plan').value;
		toggle = parseInt(toggle);
		if(toggle === 0){
			document.getElementById("free").style.display = 'none';
			document.getElementById("paid").style.display = 'none';
		}
		if(toggle === 1){
			document.getElementById("free").style.display = 'block';
			document.getElementById("paid").style.display = 'none';
		}
		if(toggle > 1 ){
			document.getElementById("free").style.display = 'none';
			document.getElementById("paid").style.display = 'block';
			document.getElementById("paybutton").textContent = 'Pay the Sum of ' + sel.options[sel.selectedIndex].text + 'To Register';
			$.ajax({
				type: "POST",
				url: '<?php echo site_url('get_plan'); ?>',
				data: {plan_id: toggle},
				success: function (data) {
					data = JSON.parse(data);
					document.getElementById('price').value = data.plan_price * 100;
					console.log(document.getElementById('price').value);

				},
				error: function () {
					console.log(this.error);
				}
			});
		}
	}
</script>
