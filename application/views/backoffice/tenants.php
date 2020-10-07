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
					<h1>Manage tenants</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url('backoffice'); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Manage tenants</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">All About Managing tenants</div>
          <p class="section-lead">You can manage tenant information here</p>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>All Tenants</h4>

                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-bordered table-striped table-md">
                      <thead>
                      <tr>
                        <th>S/N</th>
						  <th>Company Name</th>
						  <th>Contact Person</th>
                        	<th>Contact Email</th>
						  <th>Contact Phone
						  <th> Website </th>
						  <th> Registration Date</th>
						   <th>Actions</th>


                      </tr>
                      </thead>
                      <tbody>
                      <?php if(!empty($tenants)):
						  $sn = 1;
                        foreach($tenants as $tenant):

//
                          ?>
                          <tr>
							  <td><?php echo $sn; ?></td>
                            <td><?php echo $tenant->tenant_business_name; ?></td>
							  <td><?php echo $tenant->tenant_contact_name; ?> </td>
							  <td> <a href="<?php echo "mailto:".$tenant->tenant_contact_email; ?>"> <?php echo $tenant->tenant_contact_email; ?></a>  </td>

							  <td> <?php echo $tenant->tenant_contact_phone; ?></td>
							  <td> <a href="<?php echo $tenant->tenant_business_website; ?>" target="_blank"> <?php echo $tenant->tenant_business_website; ?></a> </td>
								<td><?php echo $tenant->tenant_date; ?></td>

                            <td class="text-center" style="width: 9px">
                              <div class="dropdown">
                                <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                <div class="dropdown-menu">
									<a class="dropdown-item has-icon" href="<?php echo base_url('tenant_subscriptions')."/".$tenant->tenant_id; ?>" >View Tenant Subscriptions</a>
									
                                </div>
                              </div>
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





<?php include(APPPATH.'/views/footer.php'); ?>
<?php include(APPPATH.'/views/js.php'); ?>
</body>
</html>

<script>
  $('title').html('Manage tenants - IHUMANE');
</script>
