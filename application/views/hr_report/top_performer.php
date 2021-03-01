<?php include(APPPATH.'/views/stylesheet.php');
	$CI =& get_instance();
	$CI->load->model('biometric');

?>

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
					<h1>Performance Report</h1>
					<div class="section-header-breadcrumb">
						<div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
						<div class="breadcrumb-item">Performance Report</div>
					</div>
				</div>
				<div class="section-body">
					<div class="section-title">Employee Performance Report Between <?php echo $from_date ?> to <?php echo $to_date ?> </div>
					<p class="section-lead">Performance Report</p>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h4>Performance Report</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="datatable-buttons-2" class="table table-bordered table-striped table-md">
											<thead>
											<tr>
												<th>Employee Name</th>
												<th>Job Role (Department)</th>
												<th>Subsidiary</th>
												<th>Score</th>
											</tr>
											</thead>
											<tbody>
											<?php
												
												if(!empty($f_results)):
													foreach($f_results as $f_result):
														
																	?>
																	<tr>
																		<td><?php echo $f_result->employee_last_name." ".$f_result->employee_first_name." ".$f_result->employee_other_name; ?></td>
																		<td><?php echo $f_result->job_name . " (" . $f_result->department_name . ")"; ?></td>
																		<td><?php echo $f_result->subsidiary_name; ?>						</td>
																		<td><?php echo $f_result->a_score; ?>%						</td>
																	</tr>
																<?php
															
														
													endforeach;
												endif; ?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="card-footer bg-whitesmoke"></div>
							</div>
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

<script type="text/javascript">
	
	$('title').html(' <?php echo $from_date ?> to <?php echo $to_date ?> - IHUMANE');


</script>
