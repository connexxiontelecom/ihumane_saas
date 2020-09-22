<?php
  $CI =& get_instance();
  $CI->load->model('salaries');
  $CI->load->model('payroll_configurations');
  include(APPPATH.'/views/stylesheet.php');
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
          <div class="section-header-back">
            <a href="<?php echo site_url('emolument')?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
          </div>
					<h1>Emolument Sheet</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?php echo site_url('payroll_report')?>">Payroll Reports</a></div>
            <div class="breadcrumb-item active"><a href="<?php echo site_url('emolument')?>">Emolument Report</a></div>
            <div class="breadcrumb-item">Emolument Sheet</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">All About Emoluments For <?php echo date("F", mktime(0, 0, 0, $payroll_month, 10))." ".$payroll_year; ?> </div>
          <p class="section-lead">You can view and export emolument details here</p>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Employee Emoluments</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="datatable-buttons-2" class="table table-striped table-bordered table-md">
                      <thead>
                        <tr>
                          <th class="text-center">S/N</th>
                          <th>Employee Name</th>
                          <th>Department</th>
                          <th>Breakdown</th>
                          <th>Net Pay</th>
                        </tr>
                      </thead>
                      <tbody>
		                  <?php
		                    $sn = 1;
		                    foreach($emoluments as $emolument):
                      ?>
                        <tr>
                          <td class="text-center" style="width: 9px"><?php echo $sn; ?></td>
                          <td> <?php echo $emolument->employee_first_name." ".$emolument->employee_last_name." ".$emolument->employee_other_name; ?></td>
                          <td> <?php echo $emolument->department_name; ?></td>
                          <td>
                            <table class="table table-striped table-bordered dt-responsive nowrap">
                              <thead>
                                <tr>
                                  <th>Income</th>
                                  <th>Deduction </th>
                                </tr>
                              </thead>
                              <tbody>
						                  <?php $emolument_fields = $CI->salaries->view_emolument_fields();
						                  foreach($emolument_fields as $emolument_field):
							                  $payment_definition_field = stristr($emolument_field,"payment_definition_");
							                  if(!empty($payment_definition_field)):
								                  $payment_definition_id =  str_replace("payment_definition_","",$payment_definition_field);
                              ?>
                                <tr>
                                  <?php $payment_definition_check = $CI->payroll_configurations->view_payment_definition($payment_definition_id, $tenant_id);
									                  $emolument_detail = $CI->salaries->get_employee_income_pay($emolument->employee_id, $payment_definition_id, $payroll_month, $payroll_year, $tenant_id); ?>
                                    <td>
                                      <?php
										                    if($payment_definition_check->payment_definition_type == 1):
											                    if(empty($emolument_detail)):
												                    echo $payment_definition_check->payment_definition_payment_name.": ".number_format(0);
											                    else:
												                    echo $emolument_detail->payment_definition_payment_name.": ".number_format($emolument_detail->salary_amount);
											                  endif;
										                  endif;
                                    ?>
                                    </td>
                                    <td>
                                      <?php
										                  if($payment_definition_check->payment_definition_type == 0):
											                  if(empty($emolument_detail)):
												                  echo $payment_definition_check->payment_definition_payment_name.": ".number_format(0);
											                  else:
												                  echo $emolument_detail->payment_definition_payment_name.": ".number_format($emolument_detail->salary_amount);
											                  endif;
										                  endif;
										                  ?>
                                    </td>
                                  </tr>
							                  <?php
							                  endif;
						                  endforeach; ?>
                              <tr>
                                <td>
                                  <b style="color: green;">
									                  <?php
									                  $gross_pay = 0;
									                  $salaries = $CI->salaries->get_employee_income($emolument->employee_id, $payroll_month, $payroll_year, 1, $tenant_id);
									                  foreach ($salaries as $salary):
										                  $_gross_pay = $salary->salary_amount;
										                  $gross_pay = $gross_pay + $_gross_pay;
									                  endforeach;
									                  echo  "Total Income: ".number_format($gross_pay);
									                  ?>
                                  </b>
                                </td>
                                <td>
                                  <b style="color: red;">
									                  <?php
									                  $total_deduction = 0;
									                  $salaries = $CI->salaries->get_employee_income($emolument->employee_id, $payroll_month, $payroll_year, 0, $tenant_id);
									                  foreach ($salaries as $salary):
										                  $_total_deduction = $salary->salary_amount;
										                  $total_deduction = $total_deduction + $_total_deduction;
									                  endforeach;
									                  echo "Total Deduction: ". number_format($total_deduction);
									                  ?>
                                  </b>
                                </td>
                              </tr>
                              </tbody>
                            </table>
                          </td>
                          <td>&#8358; <?php echo number_format($gross_pay - $total_deduction); ?></td>
                        </tr>
			                  <?php
			                  $sn++;
		                  endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-footer text-right bg-whitesmoke">
                  <button onclick="location.href='<?php echo site_url('emolument');?>'" class="btn btn-danger" type="button">Go Back</button>
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
<script>
  $('title').html('Emolument Sheet - IHUMANE')

  window.onbeforeunload = confirmExit;
  function confirmExit() {
    $.ajax({
      url:'<?php echo site_url('emolument_report_clear'); ?>',
    });
    return "You have attempted to leave this page.  If you have made any changes to the fields without clicking the Save button, your changes will be lost.  Are you sure you want to exit this page?";
  }
</script>
</body>
</html>
