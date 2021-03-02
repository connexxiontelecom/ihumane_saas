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
					<h1> Turn Over Rate</h1>
					<div class="section-header-breadcrumb">
						<div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
						<div class="breadcrumb-item active"><a href="<?php echo site_url('hr_report')?>">HR Reports</a></div>
						<div class="breadcrumb-item">Turn Over Rate</div>
					</div>
				</div>
				<div class="section-body">
					<div class="section-title">Turn Over Rates</div>
					<p class="section-lead">You can generate a report of Turn Over rate</p>
					<div class="row">
						<div class="col-md-7">
							<form method="post"  data-persist="garlic" action="" class="needs-validation" novalidate>
								<div class="card card-primary">
									<div class="card-header">
										<h4>Turn Over Rate Form</h4>
									</div>
									<div class="card-body">
										
										<div class="form-group">
											<label for="role">Year</label><span style="color: red"> *</span>
											<select id="role" class="select2 form-control" required name="year" style="width: 100%; height: 42px !important;">
												
												<?php foreach ($years as $year) :
													$date = DateTime::createFromFormat("Y-m-d", $year->employee_employment_date);
													$y = $date->format("Y");
													?>
													<option value="<?php echo $y; ?>" <?php if($y == date('Y')): echo 'selected'; endif; ?>> <?php echo $y; ?></option>
												<?php endforeach; ?>
											</select>
										
											<div class="invalid-feedback">
												please select a year
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
