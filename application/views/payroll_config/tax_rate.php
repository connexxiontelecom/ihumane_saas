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
					<h1>Tax Rates</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Tax Rates</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">All About Tax Rates</div>
          <p class="section-lead">You can manage tax rates here</p>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>All Tax Rates</h4>
                  <div class="card-header-action">
                    <button data-toggle="modal" data-target="#add_tax_rate" type="button" class="btn btn-icon icon-left btn-primary"><i class="fa fa-plus"></i> Add Tax Rate</button>
                  </div>
                </div>
                <div class="card-body">

                  <div class="table-responsive">
                    <table  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr>
                          <th>Tax Band</th>
                          <th>Tax Rate (%)</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
		                  <?php if(!empty($tax_rates)):
			                  $band = array('First', 'Next', 'Next', 'Next', 'Next', 'Above');
			                  $i = 0;
			                  foreach($tax_rates as $tax_rate):
				                  ?>
                          <tr>
                            <td><?php echo $band[$i]." ".number_format($tax_rate->tax_rate_band); ?></td>
                            <td><?php echo $tax_rate->tax_rate_rate; ?></td>
                            <td class="text-center" style="width: 9px">
                              <div class="dropdown">
                                <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item has-icon" href="#" data-toggle="modal" data-target="#edit_tax_rate<?php echo $tax_rate->tax_rate_id ?>"><i class="fas fa-edit"></i>Edit Tax Rate</a>
                                </div>
                              </div>
                            </td>
                          </tr>
				                  <?php
				                  $i++;
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
<div class="modal fade" id="add_tax_rate" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle2">Add New Tax Rate</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-dark">&times;</span>
				</button>
			</div>
			<form class="needs-validation" novalidate method="post" action="<?php echo site_url('add_tax_rate'); ?>">
				<div class="modal-body">
					<div class="form-group">
						<label>Tax Band</label><span style="color: red"> *</span>
						<input type="number"  step="any" class="form-control"  name="tax_rate_band" required/>
            <div class="invalid-feedback">
              please fill in a tax band
            </div>
					</div>
					<div class="form-group">
						<label>Tax Rate (%)</label><span style="color: red"> *</span>
						<input type="number" step="any" class="form-control"  name="tax_rate_rate" required/>
            <div class="invalid-feedback">
              please fill in a tax rate
            </div>
					</div>
					<input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
				</div>
        <div class="modal-footer bg-whitesmoke">
          <button type="submit" class="btn btn-primary">Add Tax Rate</button>
          <input type="reset" class="btn btn-secondary">
          <button type="reset" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
			</form>
		</div>
	</div>
</div>

<?php foreach($tax_rates as $tax_rate): ?>
	<div class="modal fade" id="edit_tax_rate<?php echo $tax_rate->tax_rate_id ?>" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle2">Edit Tax Rate</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="text-dark">&times;</span>
					</button>
				</div>
				<form class="needs-validation" novalidate method="post" action="<?php echo site_url('update_tax_rate'); ?>">
					<div class="modal-body">
						<div class="form-group">
							<label>Tax Band</label><span style="color: red"> *</span>
							<input type="number" class="form-control"  name="tax_rate_band" value="<?php echo $tax_rate->tax_rate_band; ?>" required/>
              <div class="invalid-feedback">
                please fill in a tax band
              </div>
						</div>
						<div class="form-group">
							<label>Tax Rate (%)</label><span style="color: red"> *</span>
							<input type="number" class="form-control"  name="tax_rate_rate" value="<?php echo $tax_rate->tax_rate_rate; ?>" required/>
              <div class="invalid-feedback">
                please fill in a tax rate
              </div>
						</div>
						<input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
						<input type="hidden" name="tax_rate_id" value="<?php echo $tax_rate->tax_rate_id;?>" />
					</div>
          <div class="modal-footer bg-whitesmoke">
            <button type="submit" class="btn btn-primary">Edit Tax Rate</button>
            <input type="reset" class="btn btn-secondary">
            <button type="reset" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<?php include(APPPATH.'/views/footer.php'); ?>
<?php include(APPPATH.'/views/js.php'); ?>
</body>
</html>
<script>
	$('title').html('Tax Rates - IHUMANE')
</script>
