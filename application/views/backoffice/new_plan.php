<?php include(APPPATH . '/views/stylesheet.php'); ?>

<body>
<div id="app">
	<div class="main-wrapper">
		<div class="navbar-bg"></div>
		<?php include(APPPATH.'/views/backoffice/topbar.php'); ?>
		<?php include(APPPATH.'/views/backoffice/sidebar.php'); ?>
		<div class="main-content">
			<section class="section">
				<div class="section-header">
					<h1>New Employee</h1>
					<div class="section-header-breadcrumb">
						<div class="breadcrumb-item active"><a href="<?php echo base_url('backoffice'); ?>">Dashboard</a></div>
						<div class="breadcrumb-item">New Plan</div>
					</div>
				</div>
				<div class="section-body">
					<div class="section-title">All About Creating Plans</div>
					<p class="section-lead">You can complete the form to create a new plan here</p>

					<div class="row mt-4">
						<div class="col-12">
							<form method="post" action="<?php echo site_url('add_plan'); ?>" data-persist="garlic" enctype="multipart/form-data" class="needs-validation" novalidate>
								<div class="card card-primary">
									<div class="card-header">
										<h4>New Plan Form</h4>
									</div>
									<div class="card-body">
										<div class="tab-content">
											<div class="tab-pane active p-3" id="new_plan" role="tabpanel">

												<div class="modal-body">
													<div class="form-group">
														<label for="employee-id">Plan Name</label><span style="color: red"> *</span>
														<input id="employee-id" type="text" class="form-control" name="plan_name" required  />
														<p class="form-text text-muted">Enter a new Plan Name</p>
													</div>
													<div class="form-group">
														<label>Currency</label><span style="color: red"> *</span>
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																	<span> &#8358; </span>
																</div>
															</div>
															<input type="text" class="form-control currency format_number" name="plan_price" required>
														</div>
													</div>


													<div class="form-group row">
														<div class="col-sm-12">
															<label>Plan Description</label><span style="color: red"> *</span>
															<textarea class="summernote form-control"  name="plan_description" placeholder="Type a Description ..."></textarea>

															<p class="form-text text-muted">Enter Plan Description</p>
														</div>

													</div>
													<div class="form-group">
														<label for="employee-id">Plan Duration</label><span style="color: red"> *</span>
														<input id="employee-id" type="text" class="form-control" name="plan_duration" required  />
														<p class="form-text text-muted">Enter Plan Duration in Day(s)</p>
													</div>

													<input type="hidden" name="<?php echo $csrf_name; ?>" value="<?php echo $csrf_hash; ?>" />
												</div>

											</div>

										</div>
									</div>
									<div class="card-footer text-right bg-whitesmoke">
										<button type="submit" class="btn btn-primary">Submit</button>
										<input type="reset" class="btn btn-secondary">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>

<?php include(APPPATH . '/views/footer.php'); ?>
<?php include(APPPATH . '/views/js.php'); ?>

<script>
	$('title').html('New Plan - IHUMANE');

</script>
</body>

</html>
