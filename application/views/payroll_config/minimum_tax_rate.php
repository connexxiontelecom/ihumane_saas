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
          <h1>Minimum Tax Rate</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Minimum Tax Rate</div>
          </div>
        </div>
        <div class="section-body">
          <div class="section-title">All About Minimum Tax Rate</div>
          <p class="section-lead">You can manage the minimum tax rate here</p>
					<?php if(empty($minimum_tax_rates)): ?>
            <div class="row">
              <div class="col-md-7">
                <div class="alert alert-warning alert-has-icon">
                  <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                  <div class="alert-body">
                    <div class="alert-title">Minimum Tax Rate Unset</div>
                    Add minimum tax rate below.
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7">
                <form class="needs-validation" novalidate method="post" action="<?php echo site_url('add_min_tax_rate'); ?>">
                  <div class="card">
                    <div class="card-header">
                      <h4>Add Minimum Tax Rate</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Minimum Tax Rate (%)</label><span style="color: red"> *</span>
                        <input  name="minimum_tax_rate" required type="number"	class="form-control"/>
                        <div class="invalid-feedback">
                          please fill in a minimum tax rate
                        </div>
                      </div>
                      <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
                    </div>
                    <div class="card-footer text-right bg-whitesmoke">
                      <button type="submit" class="btn btn-primary">Add Tax Rate</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
					<?php else: foreach($minimum_tax_rates as $minimum_tax_rate):?>
            <div class="row">
              <div class="col-md-7">
                <div class="alert alert-success alert-has-icon">
                  <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                  <div class="alert-body">
                    <div class="alert-title">Minimum Tax Rate: <?php echo $minimum_tax_rate->minimum_tax_rate; ?>%</div>
                    Minimum tax rate is set. Edit it below.
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7">
                <form class="needs-validation" novalidate method="post" action="<?php echo site_url('update_min_tax_rate'); ?>">
                  <div class="card">
                    <div class="card-header">
                      <h4>Edit Tax Rate</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Minimum Tax Rate (%)</label><span style="color: red"> *</span>
                        <input  name="minimum_tax_rate" required type="number" class="form-control" value="<?php echo $minimum_tax_rate->minimum_tax_rate; ?>"/>
                        <div class="invalid-feedback">
                          please fill in a minimum tax rate
                        </div>
                      </div>
                      <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
                      <input type="hidden" name="minimum_tax_rate_id" value="<?php echo $minimum_tax_rate->minimum_tax_rate_id; ?>">
                    </div>
                    <div class="card-footer text-right bg-whitesmoke">
                      <button type="submit" class="btn btn-primary">Edit Tax Rate</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
					<?php endforeach; endif?>
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
  $('title').html('Minimum Tax Rate - IHUMANE')
</script>
