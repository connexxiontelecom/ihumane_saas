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
					<h1>Payroll Routine </h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Payroll Routine</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">All About Payroll Routines</div>
          <p class="section-lead">You can run payroll routines here</p>
          <div class="row">
            <div class="col-md-7">
              <div class="card">
                <div class="card-header">
                  <h4>Payroll Routine</h4>
                </div>
                <div class="card-body">
	                <?php if(!empty($payroll_year)):
                    if($payroll_year->payroll_month_year_month): ?>
                    <div class="empty-state" data-height="400">
                      <div class="empty-state-icon">
                        <i class="fas fa-coins"></i>
                      </div>
                      <h2><?php echo date("F", mktime(0, 0, 0, $payroll_year->payroll_month_year_month, 10))." ".$payroll_year->payroll_month_year_year; ?></h2>
                      <p class="lead">
                        The current payroll month & year is <?php echo date("F", mktime(0, 0, 0, $payroll_year->payroll_month_year_month, 10))." ".$payroll_year->payroll_month_year_year; ?>.
                        <br> Run the Payroll Routine below or set the current payroll month & year.
                      </p>
                      <a href="<?php echo site_url('run_payroll_routine')?>" class="btn btn-primary mt-4">Run Payroll Routine</a>
                      <a href="<?php echo site_url('payroll_month_year') ?>" class="mt-4 bb">Set Payroll Month/Year</a>
                    </div>
                  <?php else: ?>
                    <div class="empty-state" data-height="400">
                      <div class="empty-state-icon">
                        <i class="fas fa-question"></i>
                      </div>
                      <h2>No Payroll Month</h2>
                      <p class="lead">
                        Sorry we can't find any data, to get rid of this message, make at least 1 entry.
                      </p>
                      <a href="#" class="btn btn-primary mt-4">Create new One</a>
                      <a href="#" class="mt-4 bb">Need Help?</a>
                    </div>
	                <?php endif;
	                endif;?>
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
  $('title').html('Payroll Routine - IHUMANE')

</script>
