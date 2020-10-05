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
					<h1>Salary Allowances</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Salary Allowances</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">All About Salary Allowances</div>
          <p class="section-lead">You can manage salary allowances here</p>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>All Allowances</h4>
                  <div class="card-header-action">
                    <button onclick="location.href='<?php echo site_url('new_salary_allowance');?>'" type="button" class="btn btn-icon icon-left btn-primary"><i class="fa fa-plus"></i> Add Salary Allowance</button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered table-md">
                      <thead>
                        <tr>
                          <th>S/N</th>
                          <th>Payment Name</th>
                          <th>Category </th>
                          <th>Pay Code</th>
                          <th>Amount</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
		                  <?php if(!empty($allowances)):
			                  $i = 1;
			                  foreach($allowances as $allowance):
				                  ?>
                          <tr>
                            <td class="text-center" style="width: 9px;"><?php echo $i; ?></td>
                            <td><?php echo $allowance->payment_definition_payment_name; ?></td>
                            <td><?php echo $allowance->salary_structure_category_name; ?></td>
                            <td><?php echo $allowance->payment_definition_payment_code; ?></td>
                            <td><?php echo number_format($allowance->salary_structure_allowance_amount); ?></td>
                            <td class="text-center" style="width: 9px">
                              <div class="dropdown">
                                <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item has-icon" href="<?php echo site_url('edit_salary_allowance')."/".$allowance->salary_structure_allowance_id;?>"><i class="fas fa-edit"></i>Edit Allowance</a>
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
<?php include(APPPATH.'/views/footer.php'); ?>
<?php include(APPPATH.'/views/js.php'); ?>
</body>
</html>
<script>
	$('title').html('Salary Allowances - IHUMANE')
</script>
