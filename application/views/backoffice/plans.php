<?php include(APPPATH.'/views/stylesheet.php'); ?>

<body>
<div id="app">
	<div class="main-wrapper">
		<div class="navbar-bg"></div>
		<?php include(APPPATH.'/views/backoffice/topbar.php'); ?>
		<?php include(APPPATH.'/views/backoffice/sidebar.php'); ?>
		<div class="main-content">
			<section class="section">
				<div class="section-header">
					<h1>Manage Plans</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url('backoffice'); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Manage Plans</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">All About Managing Plans</div>
          <p class="section-lead">You can manage plan information here</p>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>All Plans</h4>
                  <div class="card-header-action">
                    <button onclick="location.href='<?php echo site_url('new_plan');?>'" type="button" class="btn btn-icon icon-left btn-primary"><i class="fa fa-plus"></i> Add Plan</button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-bordered table-striped table-md">
                      <thead>
                      <tr>
                        <th>Plan Name</th>
						  <th> Plan Price</th>
                        <th>Plan Duration (Days)</th>
                        <th>Plan Description</th>

                        <th class="text-center">Actions</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php if(!empty($plans)):
                        foreach($plans as $plan):
                          ?>
                          <tr>
                            <td><?php echo $plan->plan_name; ?></td>
                             <td><span> &#8358; </span><?php echo number_format($plan->plan_price); ?> </td>
                            <td><?php echo $plan->plan_duration; ?> Day(s)</td>
                            <td><?php echo $plan->plan_description; ?></td>

                            <td class="text-center" style="width: 9px">
                              <div class="dropdown">
                                <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                <div class="dropdown-menu">
									<a class="dropdown-item has-icon" href="#" data-toggle="modal" data-target="#edit_plan<?php echo $plan->plan_id ?>"><i class="fas fa-edit"></i>Update plan</a>
									
                                </div>
                              </div>
                            </td>
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


<?php foreach($plans as $plan): ?>
	<div class="modal fade" id="edit_plan<?php echo $plan->plan_id ?>" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle2">Edit plan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="text-dark">&times;</span>
					</button>
				</div>

				<form method="post" action="<?php echo site_url('update_plan'); ?>" data-persist="garlic" enctype="multipart/form-data" class="needs-validation" novalidate>
					<div class="modal-body">
						<div class="form-group">
							<label for="employee-id">Plan Name</label><span style="color: red"> *</span>
							<input id="employee-id" type="text" class="form-control" name="plan_name" value="<?php echo $plan->plan_name; ?>" required  />
							<p class="form-text text-muted">Enter a new Plan Name</p>
						</div>
						<div class="form-group">
							<label>Currency</label><span style="color: red"> *</span>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<span> &#8358; </span>
									</div>
								</div>
								<input type="text" class="form-control currency format_number" name="plan_price" value="<?php echo number_format($plan->plan_price); ?>" required>
							</div>
						</div>


						<div class="form-group row">
							<div class="col-sm-12">
								<label>Plan Description</label><span style="color: red"> *</span>
								<textarea class="summernote form-control"  name="plan_description" placeholder="Type a Description ..."> <?php echo $plan->plan_description; ?></textarea>

								<p class="form-text text-muted">Enter Plan Description</p>
							</div>

						</div>
						<div class="form-group">
							<label for="plan-duration">Plan Duration</label><span style="color: red"> *</span>
							<input id="plan-duration" type="number" class="form-control" name="plan_duration" value="<?php echo $plan->plan_duration; ?>" required  />
							<p class="form-text text-muted">Enter Plan Duration in Day(s)</p>
						</div>

						<input type="hidden" name="plan_id" value="<?php echo $plan->plan_id; ?>">

						<input type="hidden" name="<?php echo $csrf_name; ?>" value="<?php echo $csrf_hash; ?>" />
					</div>
					<div class="card card-primary">

						<div class="card-footer text-right bg-whitesmoke">
							<button type="submit" class="btn btn-primary">Submit</button>
							<input type="reset" class="btn btn-secondary">
						</div>
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
  $('title').html('Manage Plans - IHUMANE');
</script>
