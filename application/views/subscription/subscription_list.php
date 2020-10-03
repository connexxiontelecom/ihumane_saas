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
					<h1>Manage subscriptions</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Manage subscriptions</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">All About Managing Your Subscription</div>
          <p class="section-lead">You can manage your subscription here</p>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>All subscriptions</h4>
                  <div class="card-header-action">
                    <button onclick="location.href='<?php echo site_url('new_subscription');?>'" type="button" class="btn btn-icon icon-left btn-primary"><i class="fa fa-plus"></i> Add subscription</button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-bordered table-striped table-md">
                      <thead>
                      <tr>
                        <th>S/N</th>
						  <th> Plan </th>
                        <th>Start Date</th>
                        <th>End Date</th>
						  <th> Reference </th>
                        <th>Plan Status</th>

                      </tr>
                      </thead>
                      <tbody>
                      <?php if(!empty($subscriptions)):
						  $sn = 1;
                        foreach($subscriptions as $subscription):
                          ?>
                          <tr>
							  <td><?php echo $sn; ?></td>
                            <td><?php echo $subscription->plan_name; ?></td>
                             <td><?php echo $subscription->subscription_start_date; ?> </td>
                            <td><?php echo $subscription->subscription_end_date; ?></td>
                            <td><?php echo $subscription->subscription_reference_code; ?></td>
							 <td><?php if ($subscription->subscription_status == 1): echo "Active"; endif;
								 if ($subscription->subscription_status == 0): echo "Expired"; endif;
								 if ($subscription->subscription_status == 2): echo "Pending"; endif;
							 ?></td>

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
<?php include(APPPATH.'/views/footer.php'); ?>
<?php include(APPPATH.'/views/js.php'); ?>
</body>
</html>

<script>
  $('title').html('Manage Subscriptions - IHUMANE');
</script>
