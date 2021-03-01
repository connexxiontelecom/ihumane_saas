<?php include(APPPATH.'/views/stylesheet.php'); ?>

<body>
<div id="app">
	<div class="main-wrapper">
		<div class="navbar-bg"></div>
		<?php include(APPPATH.'/views/topbar.php'); ?>
		<?php include(APPPATH.'/views/sidebar.php'); ?>
		<div class="main-content">
			<section class="section">
				<div class="section-header">
					<div class="section-header-back">
						<a href="<?php echo site_url('hr_report')?>"  class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
					</div>
					<h1> Top Performing Employees</h1>
					<div class="section-header-breadcrumb">
						<div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
						<div class="breadcrumb-item active"><a href="<?php echo site_url('hr_report')?>">HR Reports</a></div>
						<div class="breadcrumb-item">Top Performing Employees</div>
					</div>
				</div>
				<div class="section-body">
					<div class="section-title">All About Top Performing Employees</div>
					<p class="section-lead">You can generate a report of the all top performing employees in a department, subsidiary or your company at large</p>
					<div class="row">
						<div class="col-md-7">
							<form method="post"  data-persist="garlic" action="" class="needs-validation" novalidate>
								<div class="card card-primary">
									<div class="card-header">
										<h4>Top Performing Employees Form</h4>
									</div>
									<div class="card-body">
										<div class="form-group">
											<label>From:</label><span style="color: red"> *</span>
											<input type="text" name="from_date" class="form-control datepicker" required>
											<div class="invalid-feedback">
												please select a date
											</div>
										</div>
										
										<div class="form-group">
											<label>To:</label><span style="color: red"> *</span>
											<input type="text" name="to_date" class="form-control datepicker" required>
											<div class="invalid-feedback">
												please select a date
											</div>
										</div>
										
										<div class="form-group">
											<label for="role">Job Role</label><span style="color: red"> *</span>
											<select id="role" class="select2 form-control" required name="job_role" style="width: 100%; height: 42px !important;">
												
												<option value="all"> All</option>
												<?php foreach ($roles as $role) : ?>
													<option value="<?php echo $role->job_role_id; ?>"> <?php echo $role->job_name . " (" . $role->department_name . ")"; ?></option>
												<?php endforeach; ?>
											</select>
											<div class="invalid-feedback">
												please select a job role
											</div>
										</div>
										
										<div class="form-group">
											<label for="subsidiary">Subsidiary</label><span style="color: red"> *</span>
											<select id="subsidiary" class="select2 form-control" required name="subsidiary" style="width: 100%; height: 42px !important;">
												<option value="all"> All</option>
												<?php foreach ($subsidiarys as $subsidiary) : ?>
													<option value="<?php echo $subsidiary->subsidiary_id; ?>"> <?php echo $subsidiary->subsidiary_name; ?></option>
												<?php endforeach; ?>
											</select>
											<div class="invalid-feedback">
												please select a subsidiary
											</div>
										</div>
										<input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
									</div>
									<div class="card-footer text-right bg-whitesmoke">
										<button type="submit" class="btn btn-primary">Generate Sheet</button>
										<button type="button" onclick="location.reload();" class="btn btn-secondary">Reset</button>
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
<?php include(APPPATH.'/views/footer.php'); ?>
<?php include(APPPATH.'/views/js.php'); ?>
</body>
</html>
<script>
	$('title').html('Top Performing Employees - IHUMANE');
</script>
