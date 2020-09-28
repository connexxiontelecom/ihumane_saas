
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
		<?php include('header.php'); ?>
		<?php include('menu.php'); ?>
		<div class="main-content">
			<section class="section">
				<div class="section-header">
					<div class="section-header-back">
						<a href="<?php echo site_url('appraise_employee')?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
					</div>
					<h1>Appraisal Result</h1>
					<div class="section-header-breadcrumb">
						<div class="breadcrumb-item active"><a href="<?php echo base_url('employee_main') ?>">Dashboard</a></div>
						<div class="breadcrumb-item active"><a href="<?php echo base_url('appraise_employee') ?>">Appraise Employee</a></div>
						<div class="breadcrumb-item">Appraisal Result</div>
					</div>
				</div>
				<?php $appraisal = $CI->employees->_get_appraisal($appraisal_id); ?>
				<div class="section-body">
					<div class="section-title">All About Appraisal Results</div>
					<p class="section-lead">You can view and print appraisal results here</p>
					<div class="invoice">
						<div class="invoice-print" id="results">
							<div class="row">
								<div class="col-lg-12">
									<div class="invoice-title">
										<h5>Appraisal Result Sheet</h5>
									</div>
								</div>
							</div>
							<div class="row mt-4">
								<div class="col-md-12">
									<div class="section-title">Supervisor: <?php echo $appraisal->employee_last_name." ".$appraisal->employee_first_name ?></div>
									<div class="section-title">Employee: <?php echo $user_data->user_name; ?></div>
									<p class="section-lead">Period: <?php echo date("M Y", strtotime($appraisal->employee_appraisal_period_from))." - ".date("M Y", strtotime($appraisal->employee_appraisal_period_to)) ; ?></p>
									<hr>
									<div class="section-title">Self-Performance Assessment</div>
									<div class="table-responsive">
										<table class="table table-striped table-hover table-md">
											<tr>
												<th>Questions</th>
												<th>Response</th>
											</tr>
											<?php foreach ($questions as $question):
														if($question->employee_appraisal_result_type == 1):
												?>
												<tr>
													<td style="width: 70%;"><?php echo $question-> 	employee_appraisal_result_question  ?></td>
													<td><?php echo $question-> 	employee_appraisal_result_answer;  ?></td>
												</tr>
											<?php
											endif;
											endforeach; ?>
										</table>
									</div>
								</div>
							</div>
							<div class="row mt-4">
								<div class="col-md-12">
									<div class="section-title">Quantitative (20%)</div>
									<div class="table-responsive">
										<table class="table table-striped table-hover table-md">
											<tr>
												<th>Questions</th>
												<th>Response</th>
												<th> Score </th>
											</tr>
											<?php
											$count_quantitative = 0;
											$quantitative_score = 0;
											foreach ($questions as $question):
												if($question->employee_appraisal_result_type == 2):
													?>
													<tr>
														<td style="width: 70%"><?php echo $question-> 	employee_appraisal_result_question  ?></td>
														<td>
															<?php  $answer = $question-> employee_appraisal_result_answer;
																if($answer == 0): echo "Nonexistent Competence"; endif;
																if($answer == 1): echo "Unsatisfactory Performance"; endif;
																if($answer == 2): echo "Fair Performance"; endif;
																if($answer == 3): echo "Satisfactory Performance"; endif;
																if($answer == 4): echo "Good Performance"; endif;
																if($answer == 5): echo "Excellent/Outstanding Performance"; endif;
															?>
														</td>
														<td style="width: 9px;"><?php echo $answer; ?>/5</td>
													</tr>
												<?php
												$count_quantitative++;
												$quantitative_score = $quantitative_score + $answer;
												endif;
											endforeach; ?>
										</table>
									</div>
								</div>
							</div>
							<div class="row mt-4">
								<div class="col-md-12">
									<div class="section-title">Qualitative (80%)</div>
									<div class="table-responsive">
										<table class="table table-striped table-hover table-md">
											<tr>
												<th>Questions</th>
												<th>Response</th>
												<th>Score</th>
											</tr>
											<?php
											$count_qualitative = 0;
											$qualitative_score = 0;
											foreach ($questions as $question):
												if($question->employee_appraisal_result_type == 3):
													?>
													<tr>
														<td style="width: 70%"><?php echo $question-> 	employee_appraisal_result_question  ?></td>
														<td>
															<?php $answer = $question-> employee_appraisal_result_answer;
															if($answer == 0): echo "Nonexistent Competence"; endif;
															if($answer == 1): echo "Unsatisfactory Performance"; endif;
															if($answer == 2): echo "Fair Performance"; endif;
															if($answer == 3): echo "Satisfactory Performance"; endif;
															if($answer == 4): echo "Good Performance"; endif;
															if($answer == 5): echo "Excellent/Outstanding Performance"; endif;
															?>
														</td>
														<td style="width: 9px"> <?php echo $answer; ?>/5</td>
													</tr>
												<?php
													$count_qualitative++;
													$qualitative_score = $qualitative_score + $answer;
												endif;
											endforeach; ?>
										</table>
									</div>
								</div>
							</div>
							<div class="row mt-4">
								<div class="col-md-12">
									<div class="section-title">Supervisor's Comments</div>
									<div class="table-responsive">
										<table class="table table-striped table-hover table-md">
											<tr>
												<th>Questions</th>
												<th>Response</th>
											</tr>
											<?php foreach ($questions as $question):
												if($question->employee_appraisal_result_type == 4):
													?>
													<tr>
														<td style="width: 70%;"><?php echo $question-> 	employee_appraisal_result_question  ?></td>
														<td><?php echo $question-> 	employee_appraisal_result_answer;  ?></td>
													</tr>
												<?php
												endif;
											endforeach; ?>
										</table>
									</div>
								</div>
							</div>
							<div class="row mt-4">
								<div class="col-md-12">
									<div class="section-title">Summary</div>
									<div class="table-responsive">
										<table class="table table-striped table-hover table-md">
											<tr>
												<th>Detail</th>
												<th>Total</th>
												<th>Score</th>
											</tr>
											<tr>
												<td style="width: 70%">Total Score for Quantitative (20%) + Qualitative (80%) </td>
												<td>100</td>
												<td style="width: 9px;"><?php
													$score = ((($quantitative_score/($count_quantitative * 5)) * (20/100)) + (($qualitative_score/($count_qualitative * 5)) * (80/100)));
													echo number_format($score * 100);  ?></td>
											</tr>

											<tr>
												<td style="width: 70%">Overall Comments</td>
												<td>	<?php

													$overall_score = $score * 100;

													if($overall_score > 0 && $overall_score <= 39):
														echo "Unsatisfactory";
													endif;

													if($overall_score > 39 && $overall_score <= 59):
														echo "Satisfactory";
													endif;

													if($overall_score > 59 && $overall_score <= 89):
														echo "Good";
													endif;

													if($overall_score > 89 && $overall_score <= 100):
														echo "Excellent";
													endif;


													?></td>
												<td style="width: 9px;">
												</td>

											</tr>
										</table>
									</div>
								</div>
							</div>
<!--							<div class="text-md-right">-->
<!--								<div class="float-lg-left mb-lg-0 mb-3">-->
<!--									<h3>Total Score:</h3>-->
<!--									<h4> --><?php
//										$score = ((($quantitative_score/($count_quantitative * 5)) * (20/100)) + (($qualitative_score/($count_qualitative * 5)) * (80/100)));
//										echo number_format($score * 100)."%";
//										?><!--</h4>-->
<!--								</div>-->
<!--								<button class="btn btn-warning btn-icon icon-left" onclick="printDiv()"><i class="fas fa-print"></i> Print</button>-->
<!--							</div>-->
						</div>
						<hr>
						<div class="text-md-right">
							<div class="float-lg-left mb-lg-0 mb-3">
								<button class="btn btn-danger btn-icon icon-left" onclick="location.href='<?php echo site_url('appraise_employee');?>'"><i class="fas fa-times"></i> Cancel</button>
							</div>
							<button class="btn btn-warning btn-icon icon-left" onclick="printDiv()"><i class="fas fa-print"></i> Print</button>
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
	$('title').html('Appraisal Result - IHUMANE');

	function printDiv() {

		$("#results").printThis({

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









