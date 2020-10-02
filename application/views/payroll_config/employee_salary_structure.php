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
					<h1>Salary Structures</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Salary Structures</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">All About Employee Salary Structures</div>
          <p class="section-lead">You can manage employee salary structures here</p>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Employee Salary Structures</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-bordered table-striped table-md">
                      <thead>
                        <tr>
                          <th class="text-center">S/N</th>
                          <th>Employee ID</th>
                          <th>Employee Name</th>
                          <th>Department</th>
                          <th>Salary Structure</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(!empty($employees)):
                          $i = 1;
                          foreach($employees as $employee):
                            ?>
                            <tr>
                              <td class="text-center" style="width: 9px"><?php echo $i; ?></td>
                              <td> <?php echo $employee->employee_unique_id; ?></td>
                              <td><?php echo $employee->employee_last_name." ".$employee->employee_first_name." ".$employee->employee_other_name; ?></td>
                              <td><?php echo $employee->job_name." (".$employee->department_name.")"; ?></td>
                              <td>
                                <?php if($employee->employee_salary_structure_setup == 0 ):?>
                                  <div class="badge badge-danger">No Salary Structure</div>
                                <?php elseif ($employee->employee_salary_structure_category == 0):?>
                                  <div class="badge badge-info">Personalized Salary Structure</div>
                                <?php else:?>
                                  <div class="badge badge-primary">Categorised Salary Structure</div>
                                <?php endif;?>
                              </td>
                              <td class="text-center" style="width: 9px">
                                <div class="dropdown">
                                  <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                  <div class="dropdown-menu">
                                    <?php if($employee->employee_salary_structure_setup != 0 ):?>
                                      <a class="dropdown-item has-icon" href="<?php echo site_url('view_employee_salary_structure').'/'.$employee->employee_id; ?>"><i class="fas fa-eye"></i>View Structure</a>
                                      <a class="dropdown-item has-icon" href="<?php echo site_url('edit_employee_salary_structure').'/'.$employee->employee_id; ?>"><i class="fas fa-edit"></i>Edit Structure</a>
                                    <?php endif;?>
                                    <?php if($employee->employee_salary_structure_setup == 0 ):?>
                                      <a class="dropdown-item has-icon text-warning" href="<?php echo site_url('setup_salary_structure').'/'.$employee->employee_id; ?>"><i class="fas fa-cog"></i>Setup Structure</a>
                                    <?php endif;?>
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
  $('title').html('Salary Structures - IHUMANE')
</script>
