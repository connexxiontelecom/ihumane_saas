
<?php
	include(APPPATH.'/views/stylesheet.php');
	$CI =& get_instance();
	$CI->load->model('hr_configurations');
	$CI->load->model('payroll_configurations');
	$CI->load->model('employees');
?>

<body class="layout-3">
<div id="app">
	<div class="main-wrapper container">
		<div class="navbar-bg"></div>
<!--		--><?php //include('header.php'); ?>
<!--		--><?php //include('menu.php'); ?>
		<div class="main-content">
			<section class="section">
				<div class="section-header">
					<div class="section-header-back">
					
					</div>
					<h1>Your Pay Slip</h1>
					<div class="section-header-breadcrumb">
						
						<div class="breadcrumb-item">Your Pay Slip</div>
					</div>
				</div>
				<div class="section-body">
					<div class="section-title">Your Pay Slip For <?php echo date("F", mktime(0, 0, 0, $payroll_month, 10))." ".$payroll_year; ?> </div>
					<p class="section-lead">You can view and export your pay slip here</p>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h4>Your Payslip</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive" id="pay-slip">
										<table class="table table-striped table-bordered table-md">
											<?php
											$sn = 1;
											foreach($emoluments as $emolument):
												?>
												<?php
												$sn++;
											endforeach; ?>
											<thead>
												<tr>
													<th>Income</th>
													<th>Deduction </th>
												</tr>
											</thead>
											<tbody>
											<?php $emolument_fields = $CI->salaries->view_emolument_fields();
											
											$tenant_id = $this->users->get_user($username)->tenant_id;
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
										<div class="section-title">
											<h5> <b>Net Pay:</b> &#8358; <?php echo number_format($gross_pay - $total_deduction); ?> </h5>
										</div>
									</div>
								</div>
								<div class="card-footer bg-whitesmoke">
									<div class="text-md-right">
										<div class="float-lg-left mb-lg-0 mb-3">
											<button class="btn btn-danger btn-icon icon-left" onclick="location.href='<?php echo site_url('pay_slip');?>'"><i class="fas fa-times"></i> Cancel</button>
										</div>
										<button class="btn btn-warning btn-icon icon-left" onclick="printDiv()"><i class="fas fa-print"></i> Print</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php include(APPPATH.'/views/footer.php'); ?>
	</div>
</div>
<?php include(APPPATH.'/views/js.php'); ?>
</body>
</html>

<script>
	$('title').html('Your Pay Slip For <?php echo date("F", mktime(0, 0, 0, $payroll_month, 10))." ".$payroll_year; ?> - IHUMANE');

	window.onbeforeunload = confirmExit;
	function confirmExit() {
		$.ajax({
			url:'<?php echo site_url('emolument_report_clear'); ?>',
		});
		return "You have attempted to leave this page.  If you have made any changes to the fields without clicking the Save button, your changes will be lost.  Are you sure you want to exit this page?";
	}
	function printDiv() {

		$("#pay-slip").printThis({

			header: null,               // prefix to html
			footer: null,               // postfix to html

		});
		// var divContents = document.getElementById("results").innerHTML;
		// var a = window.open('', '', 'height=500, width=500');
		// a.document.write('<html>');
		// a.document.write('<body > <h1>Appraisal Results <br>');
		// a.document.write(divContents);
		// a.document.write('</body></html>');
		// a.document.close();
		// a.print();
	}

</script>









