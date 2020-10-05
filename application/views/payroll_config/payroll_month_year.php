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
          <h1>Payroll Month & Year</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Payroll Month & Year</div>
          </div>
        </div>
        <div class="section-body">
          <div class="section-title">All About Payroll Month & Year</div>
          <p class="section-lead">You can manage payroll month & year here</p>
					<?php if(empty($payroll_years)): ?>
            <div class="row">
              <div class="col-md-7">
                <div class="alert alert-warning alert-has-icon">
                  <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                  <div class="alert-body">
                    <div class="alert-title">Payroll Month & Year Unset</div>
                    Add payroll month & year below.
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7">
                <form class="needs-validation" novalidate method="post" action="<?php echo site_url('add_payroll_month_year'); ?>">
                  <div class="card">
                    <div class="card-header">
                      <h4>Add New Month & Year</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Payroll Year</label><span style="color: red"> *</span>
                        <select class="select2 form-control" id="payment_definition" required name="payroll_month_year_year" style="width: 100%; height:42px !important;">
                          <option value=""> -- Select -- </option>
                          <option value="<?php echo date("Y"); ?>"> <?php echo date("Y"); ?> </option>
                        </select>
                        <div class="invalid-feedback">
                          please select a payroll year
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Payroll Month</label><span style="color: red"> *</span>
                        <select class="select2 form-control" id="payment_definition" required name="payroll_month_year_month" style="width: 100%; height:42px !important;">
                          <option value=""> -- Select -- </option>
                          <option value="<?php echo date('n', strtotime('-1 day', strtotime(date('Y-m-01'))));  ?>"> <?php echo date('F', strtotime('-1 day', strtotime(date('Y-m-01'))));  ?> </option>
                          <option value="<?php echo date("n"); ?>"> <?php echo date("F"); ?> </option>
                        </select>
                        <div class="invalid-feedback">
                          please select a payroll month
                        </div>
                      </div>
                      <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
                    </div>
                    <div class="card-footer text-right bg-whitesmoke">
                      <button type="submit" class="btn btn-primary">Add Month & Year</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
					<?php else: foreach ($payroll_years as $payroll_year):?>
            <div class="row">
              <div class="col-md-7">
                <div class="alert alert-success alert-has-icon">
                  <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                  <div class="alert-body">
                    <div class="alert-title">Current Payroll Month & Year: <?php echo date("F", mktime(0, 0, 0, $payroll_year->payroll_month_year_month, 10))." ".$payroll_year->payroll_month_year_year; ?> </div>
                    Payroll month & year are set. Edit it below.
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7">
                <form class="needs-validation" novalidate method="post" action="<?php echo site_url('update_payroll_month_year'); ?>">
                  <div class="card">
                    <div class="card-header">
                      <h4>Edit Month & Year</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Payroll Year</label><span style="color: red"> *</span>
                        <select class="select2 form-control" id="payment_definition" required name="payroll_month_year_year" style="width: 100%; height:42px !important;">
                          <option value=""> -- Select -- </option>
                          <option value="<?php echo date("Y"); ?>"> <?php echo date("Y"); ?> </option>
                        </select>
                        <div class="invalid-feedback">
                          please select a payroll year
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Payroll Month</label><span style="color: red"> *</span>
                        <select class="select2 form-control" id="payment_definition" required name="payroll_month_year_month" style="width: 100%; height:42px !important;">
                          <option value=""> -- Select -- </option>
                          <option value="<?php echo date('n', strtotime('-1 day', strtotime(date('Y-m-01'))));  ?>"> <?php echo date('F', strtotime('-1 day', strtotime(date('Y-m-01'))));  ?> </option>
                          <option value="<?php echo date("n"); ?>"> <?php echo date("F"); ?> </option>
                        </select>
                        <div class="invalid-feedback">
                          please select a payroll month
                        </div>
                      </div>
                      <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
                      <input type="hidden" name="payroll_month_year_id" value="<?php echo $payroll_year->payroll_month_year_id; ?>">
                    </div>
                    <div class="card-footer text-right bg-whitesmoke">
                      <button type="submit" class="btn btn-primary">Edit Month & Year</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
					<?php endforeach; endif;?>
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
  $('title').html('Payroll Month & Year - IHUMANE')
</script>

