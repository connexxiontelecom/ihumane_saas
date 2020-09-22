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
            <a href="<?php echo site_url('new_variational_payment')?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
          </div>
					<h1>Recall Variational Payment</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?php echo site_url('variational_payment')?>">Variational Payments</a></div>
            <div class="breadcrumb-item active"><a href="<?php echo site_url('new_variational_payment')?>">New Variational Payment</a></div>
            <div class="breadcrumb-item">Recall Variational Payment</div>
          </div>
				</div>

        <div class="section-body">
			<?php if (!empty($variational_payments)): ?>
          <div class="section-title">Recall Variational Payment</div>
          <p class="section-lead">You can submit the previous month's variational payment as a new variational payment here</p>
          <div class="row">

            <div class="col-12">
              <form method="post" action="<?php echo site_url('add_variational_payment'); ?>" class="needs-validation" novalidate>
                <div class="card card-primary">
                  <div class="card-header">
                    <h4>New Variational Payment Form</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>Payment Definition</label>
                        <select id="payment_type" class="select2 form-control" required name="payment_definition_id" style="width: 100%; height:42px !important;">
                          <option value="null"> -- Select -- </option>
				                  <?php foreach ($payment_definitions as $payment_definition):
					                  if($payment_definition->payment_definition_variant == 1): ?>
                              <option value="<?php echo $payment_definition->payment_definition_id ?>"  <?php if($variational_payments[0]->payment_definition_id == $payment_definition->payment_definition_id){ echo "selected"; } ?> > <?php echo $payment_definition->payment_definition_payment_name; ?> </option>
					                  <?php
					                  endif;
				                  endforeach;?>
                        </select>
                      </div>
                      <div class="col-sm-6">
                        <input type="hidden" value="0" name="category">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6" >
                        <label> Employees</label>
                        <select class="select2 mb-3 select2-multiple" style="width: 100%" multiple data-placeholder="Choose" name="employee_ids[]">
                          <option> -- Select -- </option>
				                  <?php
				                  $temps[0] = 0;
				                  foreach ($variational_payments as $variational_payment): ?>
                            <option value="<?php echo $variational_payment->employee_id ?>" selected> <?php echo $variational_payment->employee_first_name." ".$variational_payment->employee_last_name." (".$variational_payment->department_name.")" ; ?> </option>
					                  <?php
					                  $temps[] = $variational_payment->employee_id;
				                  endforeach;
				                  foreach ($employees as $employee):
					                  if(($employee->employee_status == 0) or ($employee->employee_status == 3)):
					                  else:
						                  if((array_search($employee->employee_id, $temps, true))):
						                  else:
							                  ?>
                                <option value="<?php echo $employee->employee_id ?>"> <?php echo $employee->employee_first_name." ".$employee->employee_last_name." (".$employee->department_name.")" ; ?> </option>
						                  <?php
						                  endif;
					                  endif;
				                  endforeach; ?>
                        </select>
                      </div>
                      <div class="col-sm-6">
                        <label> Amount</label><span style="color: red"> *</span>
                        <input name="payment_amount" type="text" class="form-control" required value="<?php echo $variational_payments[0]->variational_amount; ?>"/>
                        <div class="invalid-feedback">
                          please fill in an amount
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>Payroll Month</label>
                        <input name="payroll_month" type="text" class="form-control" disabled value="<?php echo date("F", mktime(0, 0, 0, $payroll->payroll_month_year_month, 10)) ?>"/>
                      </div>
                      <div class="col-sm-6">
                        <label>Payroll Year</label>
                        <input name="payroll_year" type="text" class="form-control" disabled value="<?php echo $payroll->payroll_month_year_year; ?>"/>
                      </div>
                    </div>
                    <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
                  </div>
                  <div class="card-footer text-right bg-whitesmoke">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button onclick="location.href='<?php echo site_url('new_variational_payment');?>'" class="btn btn-danger" type="button">Go Back</button>
                  </div>
                </div>
              </form>
            </div>

          </div>


			<?php else: ?>

				<div class="section-title">No Previous Variational Payment</div>
		<?php endif;
			?>
        </div>
      </section>
		</div>
	</div>
</div>
<?php include(APPPATH.'/views/footer.php'); ?>
<?php include(APPPATH.'/views/js.php'); ?>
<script>
  $('title').html('Recall Variational Payment - IHUMANE')

  window.onload = function(){
    document.getElementById("employees").style.display='none';
    document.getElementById("departments").style.display='none';
  };

  function toogle_employee_department() {
    var value = document.getElementById('category').value;
    if(value == 1){
      document.getElementById("employees").style.display='none';
      document.getElementById("departments").style.display='block';
    } else if(value == 0){
      document.getElementById("employees").style.display='block';
      document.getElementById("departments").style.display='none';
    }
  }
</script>
</body>
</html>





