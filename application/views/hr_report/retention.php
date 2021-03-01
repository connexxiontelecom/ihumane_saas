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
						<a href="<?php echo site_url('retention')?>"  class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
					</div>
					<h1>Retention Rate</h1>
					<div class="section-header-breadcrumb">
						<div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
						<div class="breadcrumb-item">Retention rate</div>
					</div>
				</div>
				<div class="section-body">
					<div class="section-title">Retention Rate for <?php echo $year; ?> </div>
					<p class="section-lead">Retention Rate</p>
					<div class="row">
						<div class="col-md-7">
							<div class="card">
								<div class="card-header">
									<h4>Retention Rate</h4>
								</div>
								<div class="card-body">
									
											<div class="empty-state" data-height="400">
												<div class="empty-state-icon">
													<i class="fas fa-chart-bar"></i>
												
												</div>
												<p class="lead">
													Retention Rate for <?php echo $year; ?> is:
												</p>
												<h2>  <?php echo number_format(($before/$after)*100, 2) ?>%</h2>
												
											
											</div>
									
											
								
								</div>
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
