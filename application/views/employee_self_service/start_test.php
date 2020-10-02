
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
		<!-- Main Content -->
		<div class="main-content">
			<section class="section">
				<div class="section-header">
					<h1><?php echo ucwords($training->training_name); ?> Assessment </h1>
				</div>
				<div class="section-body">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h4>Questions</h4>
								</div>
								<div class="card-body">
									<div class="alert alert-warning alert-has-icon">
										<div class="alert-icon"><i class="far fa-lightbulb"></i></div>
										<div class="alert-body">
											<div id="countdown-a" class="alert-title">Warning</div>
											<p> Do not Attempt to Reload the Page. </p>
											<p> Do not Attempt to Leave this Screen during the Test Time. </p>
											<p> If the timer times out before you submit, you test would be submitted.</p>
											<p>Should you violate any of the first 2 conditions, your test would be submitted.</p>
											<p>Note if the company deems you failed this test, you will retake the test</p>
										</div>
									</div>
									<div class="row">
											<div class="col-4 col-sm-4 col-md-4">
												<ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
													<?php $count = 1; foreach ($questions as $question): ?>
													<li class="nav-item">
														<a class="nav-link <?php if($count == 1){ echo "active"; } ?>"  id="question-tab<?php echo $count; ?>" data-toggle="tab" href="#question<?php echo $count; ?>" role="tab" aria-controls="home" aria-selected="true">QUESTION <?php echo $count; ?></a>
													</li>
													<?php $count++; endforeach; ?>
												</ul>
											</div>
											<div class="col-8 col-sm-8 col-md-8">
												<div class="tab-content no-padding" id="myTab2Content">
													<form action="<?php echo site_url('score_test'); ?>" data-persist="garlic" id="assessment_form" method="post">

													<?php $count = 1; $count_questions = count($questions); foreach ($questions as $question): ?>
													<div class="tab-pane fade <?php if($count == 1){ echo "fade show active"; } ?>" id="question<?php echo $count; ?>" role="tabpanel" aria-labelledby="question-tab<?php echo $count; ?>">
														<?php echo $question->training_question_question; ?>
														<hr>
														<div class="form-group">
															<label class="d-block">Select One Option</label>
															<div class="form-check">
																<input class="form-check-input" type="radio" name="<?php echo $question->training_question_id ?>" value="A" required >
																<label class="form-check-label" >
																	<?php echo $question->training_question_option_a; ?>
																</label>
															</div>
															<div class="form-check">
																<input class="form-check-input" type="radio" name="<?php echo $question->training_question_id ?>" value="B" >
																<label class="form-check-label">
																	<?php echo $question->training_question_option_b; ?>
																</label>
															</div>
															<div class="form-check">
																<input class="form-check-input" type="radio" name="<?php echo $question->training_question_id ?>" value="C" >
																<label class="form-check-label" >
																	<?php  echo $question->training_question_option_c; ?>
																</label>
															</div>
															<div class="form-check">
																<input class="form-check-input" type="radio" name="<?php echo $question->training_question_id ?>" value="D" >
																<label class="form-check-label" >
																<?php  echo  $question->training_question_option_d; ?>
																</label>
															</div>
														</div>
														<div style="display: <?php if($count == count($questions)){ echo "block";} else{ echo "none"; } ?>; float: right; ">
															<input type="hidden" value="<?php echo $employee_training_id; ?>" name="employee_training_id">
															<input type="hidden" value="<?php echo $training->training_id; ?>" name="training_id">
															<button type="button" id="submit_test" onclick="check()"  class="btn btn-primary">Submit</button>
														</div>
													</div>
													<?php $count++; endforeach; ?>
												</div>
											</div>
											<input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>

<?php include(APPPATH.'/views/js.php'); ?>
</body>
</html>

<script>

	$('title').html('<?php echo ucwords($training->training_name); ?> Assessment - IHUMANE')

	function check(){
		swal({
			title: 'Are you sure you want to submit?',
			text: 'Kindly Check to confirm you have answered all questions. All Unanswered Questions would be Scored 0',
			icon: 'warning',
			buttons: true,
			dangerMode: true,
		}).then((willDelete) => {
			if (willDelete) {
				$('#assessment_form').submit()
			} else {
				swal('Submit Test Canceled!', { icon: 'error' });
			}
		});

	}

	var countDownDate = <?php echo $exam_time; ?>;
	var seconds = countDownDate * 60;
	var x = setInterval(function() {
		seconds = seconds - 1;

		document.getElementById("countdown-a").innerHTML =  seconds + "s ";

		var minutes = seconds/60;

		$.ajax({
			type: "GET",
			url: '<?php echo site_url('update_time'); ?>',
			data: {minutes:minutes},
			success:function(data)
			{

			},
			error:function()
			{

			}
		});
		if(seconds === 0){

			clearInterval(x);


			$('#assessment_form').submit();

		}


	}, 1000);

</script>





