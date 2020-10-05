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
          <h1>Pension Rate</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Pension Rate</div>
          </div>
        </div>
        <div class="section-body">
          <div class="section-title">All About Pension Rate</div>
          <p class="section-lead">You can manage the pension rate here</p>
					<?php if(empty($pension_rates)):?>
            <div class="row">
              <div class="col-md-7">
                <div class="alert alert-warning alert-has-icon">
                  <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                  <div class="alert-body">
                    <div class="alert-title">Pension Rate Unset</div>
                    Add pension rate below.
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7">
                <form class="needs-validation" novalidate method="post" action="<?php echo site_url('add_pension_rate'); ?>">
                  <div class="card">
                    <div class="card-header">
                      <h4>Add Pension Rate</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Pension Rate (%)</label><span style="color: red"> *</span>
                        <input name="pension_rate" type="number" required class="form-control"/>
                        <div class="invalid-feedback">
                          please fill in a pension rate
                        </div>
                      </div>
                      <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
                    </div>
                    <div class="card-footer text-right bg-whitesmoke">
                      <button type="submit" class="btn btn-primary">Add Pension Rate</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
					<?php else: foreach($pension_rates as $pension_rate): ?>
            <div class="row">
              <div class="col-md-7">
                <div class="alert alert-success alert-has-icon">
                  <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                  <div class="alert-body">
                    <div class="alert-title">Current Pension Rate: <?php echo $pension_rate->pension_rate; ?>%</div>
                    Pension rate is set. Edit it below.
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7">
                <form class="needs-validate" novalidate method="post" action="<?php echo site_url('update_pension_rate'); ?>">
                  <div class="card">
                    <div class="card-header">
                      <h4>Edit Pension Rate</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Pension Rate (%)</label><span style="color: red"> *</span>
                        <input name="pension_rate" type="number" class="form-control" required value="<?php echo $pension_rate->pension_rate; ?>"/>
                        <div class="invalid-feedback">
                          please fill in a pension rate
                        </div>
                      </div>
                      <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
                      <input type="hidden" name="pension_rate_id" value="<?php echo $pension_rate->pension_rate_id; ?>">
                    </div>
                    <div class="card-footer text-right bg-whitesmoke">
                      <button type="submit" class="btn btn-primary">Update Pension Rate</button>
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
  $('title').html('Pension Rate - IHUMANE')
</script>

