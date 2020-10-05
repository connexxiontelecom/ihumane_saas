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
          <div class="section-header-back">
            <a href="<?php echo site_url('employee_salary_structure')?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
          </div>
          <h1> View Salary Structure</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?php echo site_url('employee_salary_structure')?>">Salary Structures</a></div>
            <div class="breadcrumb-item">View Salary Structure</div>
          </div>
        </div>
        <div class="section-body">
          <div class="section-title">View Employee Salary Structure</div>
          <p class="section-lead">You can view details and breakdown of an employee's salary structure here</p>
          <div class="row">
            <div class="col-md-7">
              <div class="card card-primary">
                <div class="card-header">
                  <h4>Salary Structure Details</h4>
                  <div class="card-header-action">
                    <button onclick="location.href='<?php echo site_url('edit_employee_salary_structure').'/'.$employee->employee_id;?>'" type="button" class="btn btn-icon icon-left btn-primary"><i class="fa fa-edit"></i> Edit Salary Structure</button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label>Employee ID</label>
                    <input type="text" class="form-control"  name="employee_unique_id" disabled value="<?php echo $employee->employee_unique_id; ?>"/>
                  </div>
                  <div class="form-group">
                    <label>Employee Name</label>
                    <input type="text" class="form-control"  name="employee_unique_id" disabled value="<?php echo $employee->employee_last_name." ".$employee->employee_first_name." ".$employee->employee_other_name; ?>"/>
                  </div>
									<?php $total_amount = 0; ?>
									<?php if($employee->employee_salary_structure_category > 0) : ?>
                  <p class="text-muted">Categorized Salary Structure for <?php echo $employee->salary_structure_category_name; ?></p>
									<?php foreach ($allowances as $allowance):  ?>
                  <div href="javascript:void(0)" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1"><?php echo ucwords($allowance->payment_definition_payment_name); ?></h5>
											<?php if($allowance->payment_definition_type):?>
                      <p>Amount: &#8358; <?php echo number_format($allowance->salary_structure_allowance_amount);  $total_amount += $allowance->salary_structure_allowance_amount; ?></p>
                    </div>
                    <small>Note, this is an <em class="text-success">income</em> definition</small>
										<?php else:?>
                    <p>Amount: (&#8358; <?php echo number_format($allowance->salary_structure_allowance_amount);  $total_amount -= $allowance->salary_structure_allowance_amount; ?>)</p>
                  </div>
                  <small>Note, this is an <em class="text-danger">deduction</em> definition</small>
								<?php endif;?>
                </div>
								<?php endforeach; ?>
								<?php elseif($employee->employee_salary_structure_category == 0) : ?>
                <p class="text-muted">Personalized Salary Structure</p>
								<?php foreach ($personalized_allowances as $personalized_allowance): ?>
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><?php echo ucwords($personalized_allowance->payment_definition_payment_name); ?></h5>
										<?php if($personalized_allowance->payment_definition_type):?>
                    <p>Amount: &#8358; <?php echo number_format($personalized_allowance->personalized_amount); $total_amount += $personalized_allowance->personalized_amount; ?></p>
                  </div>
                  <small>Note, this is an <em class="text-success">income</em> definition</small>
									<?php else:?>
                  <p>Amount: (&#8358; <?php echo number_format($personalized_allowance->personalized_amount); $total_amount -= $personalized_allowance->personalized_amount; ?>)</p>
                </div>
                <small>Note, this is an <em class="text-danger">deduction</em> definition</small>
							<?php endif;?>
              </div>
							<?php endforeach; ?>
							<?php endif; ?>
              <div class="list-group-item list-group-item-action flex-column align-items-start active">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">Total</h5>
                  <p>Amount: &#8358; <?php echo number_format($total_amount);?></p>
                </div>
                <small>Note, this information is sensitive</small>
              </div>
            </div>
            <div class="card-footer text-right bg-whitesmoke">
              <button type="button" onclick="location.href='<?php echo site_url('employee_salary_structure');?>'" class="btn btn-danger" data-dismiss="modal">Go Back</button>
            </div>
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
  $('title').html('View Salary Structure - IHUMANE')
</script>
