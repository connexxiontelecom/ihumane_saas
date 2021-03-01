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
					<h1>Human Resource Reports</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Human Resource Reports</div>
          </div>
				</div>
				<div class="section-body">
          <div class="section-title">All About Human Resource Reports</div>
          <p class="section-lead">You can select the Human Resource report you want to generate here</p>
					<div class="row">
						<div class="col-lg-6">
							<div class="card card-large-icons">
								<div class="card-icon bg-primary text-white">
									<i class="fas fa-chart-bar"></i>
								</div>
								<div class="card-body">
									<h4>Summary Report</h4>
                  <p>Generate a summary of your employees</p>
									<a href="<?php echo base_url('summary_report') ?>" class="card-cta">View Report <i class="fas fa-chevron-right"></i></a>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="card card-large-icons">
								<div class="card-icon bg-primary text-white">
									<i class="fas fa-chart-line"></i>
								</div>
								<div class="card-body">
									<h4>Top Performers</h4>
                  <p>Performance Reports based on Appraisal</p>
									<a href="<?php echo base_url('top_performer'); ?>" class="card-cta">View Report <i class="fas fa-chevron-right"></i></a>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="card card-large-icons">
								<div class="card-icon bg-primary text-white">
									<i class="fas fa-file-signature"></i>
								</div>
								<div class="card-body">
									<h4>Turn Over Rate</h4>
                  <p>Generate Turn Over rate</p>
									<a href="<?php echo base_url('turn_over'); ?>" class="card-cta">View Report <i class="fas fa-chevron-right"></i></a>
								</div>
							</div>
						</div>
						
						<div class="col-lg-6">
							<div class="card card-large-icons">
								<div class="card-icon bg-primary text-white">
									<i class="fas fa-file-signature"></i>
								</div>
								<div class="card-body">
									<h4>Retention Rate</h4>
									<p>Generate Turn Over rate</p>
									<a href="<?php echo base_url('retention'); ?>" class="card-cta">View Report <i class="fas fa-chevron-right"></i></a>
								</div>
							</div>
						</div>
						
						<div class="col-lg-6">
							<div class="card card-large-icons">
								<div class="card-icon bg-primary text-white">
									<i class="fas fa-file-signature"></i>
								</div>
								<div class="card-body">
									<h4>New Hires</h4>
									<p>Generate New Hires</p>
									<a href="<?php echo base_url('new_hire'); ?>" class="card-cta">View Report <i class="fas fa-chevron-right"></i></a>
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
<script>
  $('title').html('Human Resource Reports - IHUMANE')
</script>
