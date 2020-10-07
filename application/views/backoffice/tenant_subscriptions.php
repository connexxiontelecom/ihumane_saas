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
					<h1>Manage <?php echo $tenant_details->tenant_business_name; ?> subscriptions</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url('backoffice'); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Manage subscriptions</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">All About Managing <?php echo $tenant_details->tenant_business_name; ?> subscriptions</div>
          <p class="section-lead">You can manage <?php echo $tenant_details->tenant_business_name; ?> subscription information here</p>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4><?php echo $tenant_details->tenant_business_name; ?> subscriptions</h4>

                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-bordered table-striped table-md">
                      <thead>
                      <tr>
                        <th>S/N</th>

						  <th>Plan</th>
						  <th>Start Date</th>
						  <th>End Date
						  <th> Reference Code
						  <th>Days Left</th>


						  <th>Actions</th>


                      </tr>
                      </thead>
                      <tbody>
                      <?php if(!empty($subscriptions)):
						  $sn = 1;
                        foreach($subscriptions as $subscription):



						  	$days_left = floor((strtotime($subscription->subscription_end_date) - strtotime(date('Y-m-d')))/(60 * 60 * 24));


                          ?>
                          <tr>
							  <td><?php echo $sn; ?></td>

							  <td> <?php echo $subscription->plan_name; ?></td>
                            <td><?php echo $subscription->subscription_start_date; ?> </td>
                            <td><?php echo $subscription->subscription_end_date; ?></td>
							  <td> <?php echo $subscription->subscription_reference_code; ?></td>
							  <th><?php if($days_left <= 0): echo "Subscription Expired"; else: echo $days_left." day(s)"; endif; ?></th>


                            <td class="text-center" style="width: 9px">
								<?php if($days_left <= 0):

								echo "No Actions";

								else:
								?>
                              <div class="dropdown">
                                <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                <div class="dropdown-menu">
									<a class="dropdown-item has-icon" href="#" data-toggle="modal" data-target="#extend_subscription<?php echo $subscription->subscription_id ?>"><i class="fas fa-edit"></i>Extend Subscription</a>
									
                                </div>
                              </div>

								<?php endif; ?>


                            </td>
                          </tr>
                        <?php
						$sn++;

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


<?php foreach($subscriptions as $subscription): ?>
	<div class="modal fade" id="extend_subscription<?php echo $subscription->subscription_id ?>" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle2">Extend Subscription</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="text-dark">&times;</span>
					</button>
				</div>

				<form method="post" action="<?php echo site_url('update_subscription'); ?>" data-persist="garlic" enctype="multipart/form-data" class="needs-validation" novalidate>
					<div class="modal-body">
						<div class="form-group">
							<label for="employee-id">New End Date</label><span style="color: red"> *</span>
							<input id="employee-start-date" type="text" name="subscription_end_date" required class="form-control datepicker" value="<?php echo $subscription->subscription_end_date; ?>">

						</div>

						<input type="hidden" name="subscription_id" value="<?php echo $subscription->subscription_id; ?>">

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
  $('title').html('Manage subscriptions - IHUMANE');
</script>
