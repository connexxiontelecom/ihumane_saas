<?php include(APPPATH.'/views/stylesheet.php'); ?>
<?php
	$CI =& get_instance();
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
					<h1>Manage Employees</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Manage Employees</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">All About Managing Employees</div>
          <p class="section-lead">You can manage employee information here</p>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>All Employees</h4>
                  <div class="card-header-action">
                    <button onclick="location.href='<?php echo site_url('new_employee');?>'" type="button" class="btn btn-icon icon-left btn-primary"><i class="fa fa-plus"></i> Add Employee</button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-bordered table-striped table-md">
                      <thead>
                      <tr>
                        <th>Employee Name</th>
						  <th> Employee ID</th>
                        <th>Department</th>
                        <th>Job Role</th>
                        <th>Employment Status</th>
                        <th class="text-center">Actions</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php if(!empty($employees)):
						  
						  
                        foreach($employees as $employee):
							
							if(empty($employee->employee_job_role_id)): ?>
								
								<tr>
									<td><?php echo $employee->employee_last_name." ".$employee->employee_first_name." ".$employee->employee_other_name; ?></td>
									<td><?php echo $employee->employee_unique_id; ?> </td>
									<td><?php echo 'update employee department' ?></td>
									<td><?php echo 'update employee job role'; ?></td>
									<td>
										<?php
											$status = $employee->employee_status;
											if($status == 0):?>
												<div class="badge badge-danger">Employment Terminated</div>
												<div> <i>Since: <?php echo $employee->employee_stop_date; ?></i></div>
											<?php elseif($status == 1):?>
												<div class="badge badge-info">Probationary</div>
											<?php elseif($status == 2):?>
												<div class="badge badge-success">Confirmed</div>
											<?php else:?>
												<div class="badge badge-dark">Retired</div>
											<?php endif;?>
									</td>
									<td class="text-center" style="width: 9px">
										<div class="dropdown">
											<a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
											<div class="dropdown-menu">
												<a class="dropdown-item has-icon" href="<?php echo site_url('view_employee').'/'.$employee->employee_id; ?>"><i class="fas fa-eye"></i>View Employee</a>
												<?php if($status == 1 || $status == 2): ?>
													<a class="dropdown-item has-icon" href="<?php echo site_url('update_employee').'/'.$employee->employee_id; ?>"><i class="fas fa-edit"></i>Update Employee</a>
													<a class="dropdown-item has-icon" href="<?php echo site_url('query_employee').'/'.$employee->employee_id; ?>"><i class="fas fa-question"></i>Employee Queries</a>
													<div class="dropdown-divider"></div>
													<a class="dropdown-item has-icon text-danger" href="<?php echo site_url('terminate_employee').'/'.$employee->employee_id; ?>"><i class="fas fa-times"></i>Terminate Employee</a>
												<?php endif; ?>
											</div>
										</div>
									</td>
								</tr>
								
								
								
					<?php
								else:
									
									$emp = $CI->employees->get_employee($employee->employee_id, $tenant_id)
                          ?>
							
							
                          <tr>
                            <td><?php echo $emp->employee_last_name." ".$employee->employee_first_name." ".$employee->employee_other_name; ?></td>
                             <td><?php echo $emp->employee_unique_id; ?> </td>
                            <td><?php echo $emp->department_name; ?></td>
                            <td><?php echo $emp->job_name; ?></td>
                            <td>
                              <?php
                              $status = $emp->employee_status;
                              if($status == 0):?>
                                <div class="badge badge-danger">Employment Terminated</div>
							  	              <div> <i>Since: <?php echo $emp->employee_stop_date; ?></i></div>
                              <?php endif;
                              
                              if($status == 1):?>
                                <div class="badge badge-info">Probationary</div>
                              <?php endif;
                              
                              if($status == 2):?>
                                <div class="badge badge-success">Confirmed</div>
                              <?php endif; if($status == 3):?>
                                <div class="badge badge-dark">Retired</div>
                              <?php endif;?>
                            </td>
                            <td class="text-center" style="width: 9px">
                              <div class="dropdown">
                                <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item has-icon" href="<?php echo site_url('view_employee').'/'.$emp->employee_id; ?>"><i class="fas fa-eye"></i>View Employee</a>
                                  <?php if($status == 1 || $status == 2): ?>
                                    <a class="dropdown-item has-icon" href="<?php echo site_url('update_employee').'/'.$emp->employee_id; ?>"><i class="fas fa-edit"></i>Update Employee</a>
                                    <a class="dropdown-item has-icon" href="<?php echo site_url('query_employee').'/'.$emp->employee_id; ?>"><i class="fas fa-question"></i>Employee Queries</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item has-icon text-danger" href="<?php echo site_url('terminate_employee').'/'.$emp->employee_id; ?>"><i class="fas fa-times"></i>Terminate Employee</a>
                                  <?php endif; ?>
                                </div>
                              </div>
                            </td>
                          </tr>
                        <?php
                      	endif;
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
  $('title').html('Manage Employees - IHUMANE');
</script>
