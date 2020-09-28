
<?php
  include(APPPATH.'/views/stylesheet.php');
  $CI =& get_instance();
  $CI->load->model('hr_configurations');
  $CI->load->model('payroll_configurations');
?>

<body class="layout-3">
<div id="app">
	<div class="main-wrapper container">
		<div class="navbar-bg"></div>
			<?php include('header.php'); ?>
			<?php include('menu.php'); ?>
				<div class="main-content">
					<section class="section">
						<div class="section-header">
							<h1>My Information</h1>
							<div class="section-header-breadcrumb">
								<div class="breadcrumb-item active"><a href="<?php echo site_url('employee_main'); ?>">Dashboard</a></div>
                <div class="breadcrumb-item">My Information</div>
							</div>
						</div>
						<div class="section-body">
							<div class="row">
								<div class="col-12 col-sm-12 col-lg-12">
									<div class="card">
										<div class="card-header">
											<h4>Personal Information </h4>
										</div>
										<div class="card-body">
											<ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
												<li class="media">
													<img alt="image" class="mr-3 rounded" width="50" height="50" src="<?php echo base_url() ?>/uploads/employee_passports/<?php echo $employee->employee_passport; ?>">
                          <div class="media-body">
                            <p class="media-title mt-2 font-italic">@<?php echo $employee->employee_unique_id; ?></p>
                          </div>
												</li>
												<li class="media">

													<div class="media-body">
														<div class="media-title"><?php echo $employee->employee_last_name." ".$employee->employee_first_name." ".$employee->employee_other_name; ?></div>
														<div class="text-job text-muted">Name</div>

													</div>

													<div class="media-body">
														<div class="media-title"><?php echo $employee->employee_dob; ?></div>
														<div class="text-job text-muted">Date of Birth</div>
													</div>
												</li>
												<li class="media">

													<div class="media-body">
														<div class="media-title"><?php echo $employee->employee_personal_email; ?></div>
														<div class="text-job text-muted">Personal Email </div>
													</div>
													<div class="media-body">
														<div class="media-title"><?php echo $employee->employee_official_email; ?></div>
														<div class="text-job text-muted">Official Email </div>
													</div>

												</li>
												<li class="media">
													<div class="media-body">
														<div class="media-title"><?php echo $employee->employee_address; ?></div>
														<div class="text-job text-muted">Address </div>
													</div>
													<div class="media-body">
														<div class="media-title"><?php echo $employee->employee_phone_number; ?></div>
														<div class="text-job text-muted">Phone Number </div>
													</div>


												</li>

											</ul>
										</div>
									</div>
								</div>


							</div>
							<div class="row">
								<div class="col-12 col-sm-12 col-lg-6">
									<div class="card">
										<div class="card-header">
											<h4>Work Information</h4>
										</div>
										<div class="card-body">
											<ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">

												<li class="media">

													<div class="media-body">
														<div class="media-title"><?php echo $employee->subsidiary_name; ?></div>
														<div class="text-job text-muted">Subsidiary</div>

													</div>

													<div class="media-body">
														<div class="media-title"><?php echo $employee->location_name; ?></div>
														<div class="text-job text-muted">Branch</div>
													</div>
												</li>
												<li class="media">

													<div class="media-body">
														<div class="media-title"><?php echo $employee->department_name; ?></div>
														<div class="text-job text-muted">Department </div>
													</div>
													<div class="media-body">
														<div class="media-title"><?php echo $employee->job_name; ?></div>
														<div class="text-job text-muted">Job Role </div>
													</div>

												</li>
												<li class="media">
													<div class="media-body">
														<div class="media-title"><?php echo $employee->employee_address; ?></div>
														<div class="text-job text-muted">Address </div>
													</div>
													<div class="media-body">
														<div class="media-title"><?php echo $employee->employee_phone_number; ?></div>
														<div class="text-job text-muted">Phone Number </div>
													</div>


												</li>

												<li class="media">
													<div class="media-body">
														<div class="media-title"><?php
															if($employee->employee_status == 0){
																echo "fired";
															}
															if($employee->employee_status == 1){
																echo "Probationary";
															}
															if($employee->employee_status == 2){
																echo "Confirmed";
															}
															if($employee->employee_status == 3){
																echo "Retired";
															}
															?></div>
														<div class="text-job text-muted">Employment Status </div>
													</div>

													<div class="media-body">
														<div class="media-title"><?php
															echo $employee->employee_employment_date;

															?></div>
														<div class="text-job text-muted">Date of Employment </div>
													</div>

												</li>


											</ul>
										</div>
									</div>


								</div>
								<div class="col-12 col-sm-12 col-lg-6">
									<div class="card">
										<div class="card-header">
											<h4>Financial Information</h4>
										</div>
										<div class="card-body">
											<ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
												<li class="media">

													<div class="media-body">
														<div class="media-title"><?php echo $employee->bank_name; ?></div>
														<div class="text-job text-muted">Bank</div>

													</div>

													<div class="media-body">
														<div class="media-title"><?php echo $employee->employee_account_number; ?></div>
														<div class="text-job text-muted">Account Number</div>
													</div>
												</li>
												<li class="media">

													<div class="media-body">
														<div class="media-title"><?php if($employee->employee_hmo_id == 0){
																echo "N/A";
															} else{
																echo $CI->hr_configurations->view_health_insurance($employee->employee_hmo_id)->health_insurance_hmo;

															} ?></div>
														<div class="text-job text-muted">HMO Provider </div>
													</div>
													<div class="media-body">
														<div class="media-title"><?php if($employee->employee_hmo_id == 0){
																echo "N/A";
															} else{
																echo $employee->employee_hmo_number;

															} ?></div>
														<div class="text-job text-muted">HMO Number </div>
													</div>

												</li>
												<li class="media">
													<div class="media-body">
														<div class="media-title"><?php if($employee->employee_pensionable == 0){
																echo "N/A";
															} else{
																echo $CI->hr_configurations->view_pension($employee->employee_pension_id)->pension_provider;

															} ?></div>
														<div class="text-job text-muted">Pension Administrator </div>
													</div>
													<div class="media-body">
														<div class="media-title"><?php if($employee->employee_pensionable == 0){
																echo "N/A";
															} else{
																echo $employee->employee_pension_number;

															} ?></div>
														<div class="text-job text-muted">Pension Number </div>
													</div>




												</li>
												<li class="media">
													<div class="media-body">
														<div class="media-title"><?php if($employee->employee_paye_number == 0){
																echo "N/A";
															} else{
																echo $employee->employee_paye_number;

															} ?></div>
														<div class="text-job text-muted">PAYE Number </div>
													</div>



												</li>

											</ul>
										</div>
									</div>
								</div>

							</div>


					</section>
				</div>

		<?php include(APPPATH.'/views/footer.php'); ?>
	</div>
</div>

<?php include(APPPATH.'/views/js.php'); ?>
</body>
</html>
<script>
	$('title').html('My Information - IHUMANE');
</script>
