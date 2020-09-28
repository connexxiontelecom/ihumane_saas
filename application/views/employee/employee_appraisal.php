<?php
  include(APPPATH.'/views/stylesheet.php');
  $CI =& get_instance();
  $CI->load->model('hr_configurations');
  $CI->load->model('employees');
?>

<body>
<div id="app">
	<div class="main-wrapper">
		<div class="navbar-bg"></div>
		<?php include(APPPATH.'/views/topbar.php'); ?>
		<?php include(APPPATH.'/views/sidebar.php'); ?>
		<div class="main-content">
			<section class="section">
				<div class="section-header">
					<h1>Employee Appraisal</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Employee Appraisal</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">All About Employee Appraisals</div>
          <p class="section-lead">You can manage employee appraisals here</p>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>All Appraisals</h4>
                  <div class="card-header-action">
                    <button onclick="location.href='<?php echo site_url('new_employee_appraisal')?>'" type="button" class="btn btn-icon icon-left btn-primary"><i class="fa fa-plus"></i> Initiate Appraisal</button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-bordered table-striped table-md">
                      <thead>
                      <tr>
                        <th>Employee Name</th>
                        <th>Appraisal Period</th>
                        <th>Supervisor Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php if(!empty($appraisals)):
	                      $username = $this->session->userdata('user_username');
	                      $tenant_id = $this->users->get_user($username)->tenant_id;

	                      foreach($appraisals as $appraisal):
                          ?>
                          <tr>
                            <td><?php echo $appraisal->employee_last_name." ".$appraisal->employee_first_name; ?></td>
                            <td><?php echo date("M Y", strtotime($appraisal->employee_appraisal_period_from))." - ".date("M Y", strtotime($appraisal->employee_appraisal_period_to)) ; ?></td>
                            <td>
                              <?php
                                $supervisor = $CI->employees->get_employee($appraisal->employee_appraisal_supervisor_id, $tenant_id);
                                echo $supervisor->employee_last_name." ".$supervisor->employee_first_name;
                              ?>
                            </td>
                            <td>
                              <?php if($appraisal->employee_appraisal_status == 0): ?>
                                <div class="badge badge-warning">Running</div>
                              <?php else:?>
                                <div class="badge badge-dark">Finished</div>
                              <?php endif;?>
                            </td>
                            <td class="text-center" style="width: 9px">
                              <?php if($appraisal->employee_appraisal_status == 0):
                                echo "No Actions";
                              else:?>
                                <div class="dropdown">
                                  <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item has-icon" href="<?php echo site_url('check_appraisal_result').'/'.$appraisal->employee_appraisal_id; ?>"><i class="fa fa-eye"></i>View Appraisal Result</a>
                                  </div>
                                </div>
                              <?php endif; ?>
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
<?php include(APPPATH.'/views/footer.php'); ?>
<?php include(APPPATH.'/views/js.php'); ?>
</body>
</html>
<script>
  $('title').html('Employee Appraisal - IHUMANE')
</script>
