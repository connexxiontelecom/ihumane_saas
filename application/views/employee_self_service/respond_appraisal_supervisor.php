
<?php include(APPPATH.'/views/stylesheet.php');
$CI =& get_instance();
$CI->load->model('hr_configurations');
$CI->load->model('payroll_configurations');
$CI->load->model('employees');
$username = $this->session->userdata('user_username');
$tenant_id = $this->users->get_user($username)->tenant_id;

?>

<body class="layout-3">
<div id="app">
	<div class="main-wrapper container">
		<div class="navbar-bg"></div>
		<?php include('header.php'); ?>

		<?php include('menu.php'); ?>

		<!-- Main Content -->

		<div class="main-content">
			<section class="section">
				<div class="section-header">
					<h1>Appraise <?php echo $CI->employees->get_appraisal($appraisal_id, $tenant_id)->employee_last_name." ". $CI->employees->get_appraisal($appraisal_id, $tenant_id)->employee_first_name ?> </h1>
					<div class="section-header-breadcrumb">
						<div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
						<div class="breadcrumb-item">Appraise Employees</div>
					</div>
				</div>
				<div class="section-body">
					<div class="section-title">All About Responding to Appraisal Questions</div>
					<p class="section-lead">You can answer the questions to complete the form</p>
					<div class="row">
						<div class="col-12">
							<div class="card mb-0">
								<div class="card-body">
									<ul class="nav nav-pills" role="tablist">
										<li class="nav-item waves-effect waves-light">
											<a class="nav-link active" data-toggle="tab" href="#quantitative" role="tab"> <i class="fas fa-user"></i> Quantitative (20%)</a>
										</li>
										<li class="nav-item waves-effect waves-light">
											<a class="nav-link" data-toggle="tab" href="#qualitative" role="tab"><i class="fas fa-id-card-alt"></i> Qualitative (80%)</a>
										</li>
										<li class="nav-item waves-effect waves-light">
											<a class="nav-link" data-toggle="tab" href="#supervisor" role="tab"><i class="fas fa-university"></i> Supervisor Comments </a>
										</li>

									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-12">
							<form method="post" data-persist="garlic" action="<?php echo site_url('answer_questions_supervisor'); ?>" enctype="multipart/form-data" class="needs-validation" novalidate>
								<div class="card card-primary">
									<div class="card-header">
										<h4>Appraisal Form</h4>
									</div>
									<div class="card-body">
										<div class="tab-content">
											<div class="tab-pane active p-3" id="quantitative" role="tabpanel">
												<div class="row">
													<div class="col-lg-5 col-md-12 col-12 col-sm-12">
														<div class="card-header">
															<h4>Grading Rubric</h4>
														</div>
															<div class="card-body">
																<div class="mb-4">
																	<div class="text-small float-right font-weight-bold text-muted">0</div>
																	<div class="font-weight-bold mb-1">Non Existent Competence</div>
																	<div class="progress" data-height="3">
																		<div class="progress-bar" role="progressbar" data-width=0% aria-valuenow="0" aria-valuemin="0" aria-valuemax="5"></div>
																	</div>
																</div>
																<div class="mb-4">
																	<div class="text-small float-right font-weight-bold text-muted">1</div>
																	<div class="font-weight-bold mb-1">Unsatisfactory Performance</div>
																	<div class="progress" data-height="3">
																		<div class="progress-bar" role="progressbar" data-width=20% aria-valuenow="1" aria-valuemin="0" aria-valuemax="5"></div>
																	</div>
																</div>
																<div class="mb-4">
																	<div class="text-small float-right font-weight-bold text-muted">2</div>
																	<div class="font-weight-bold mb-1">Fair Performance</div>
																	<div class="progress" data-height="3">
																		<div class="progress-bar" role="progressbar" data-width=40% aria-valuenow="2" aria-valuemin="0" aria-valuemax="5"></div>
																	</div>
																</div>
																<div class="mb-4">
																	<div class="text-small float-right font-weight-bold text-muted">3</div>
																	<div class="font-weight-bold mb-1">Satisfactory Performance</div>
																	<div class="progress" data-height="3">
																		<div class="progress-bar" role="progressbar" data-width=60% aria-valuenow="3" aria-valuemin="0" aria-valuemax="5"></div>
																	</div>
																</div>
																<div class="mb-4">
																	<div class="text-small float-right font-weight-bold text-muted">4</div>
																	<div class="font-weight-bold mb-1">Good Performance</div>
																	<div class="progress" data-height="3">
																		<div class="progress-bar" role="progressbar" data-width=80% aria-valuenow="4" aria-valuemin="0" aria-valuemax="5"></div>
																	</div>
																</div>
																<div class="mb-4">
                                  <div class="text-small float-right font-weight-bold text-muted">5</div>
                                  <div class="font-weight-bold mb-1">Excellent/Outstanding Performance</div>
                                  <div class="progress" data-height="3">
                                    <div class="progress-bar" role="progressbar" data-width=100% aria-valuenow="5" aria-valuemin="0" aria-valuemax="5"></div>
                                  </div>
															  </div>
													    </div>
												    </div>
                            <div class="col-lg-7 col-md-12 col-12 col-sm-12">
                              <?php foreach ($questions as $question):
                                if($question->employee_appraisal_result_type == 2):
                                  ?>
                                  <div class="form-group">
                                    <label class="form-label"><?php echo $question->employee_appraisal_result_question; ?></label>
                                    <div class="selectgroup w-100">
                                      <label class="selectgroup-item">
                                        <input type="radio" class="selectgroup-input" value="0" name="<?php echo $question->employee_appraisal_result_id ?>" required>
                                        <span class="selectgroup-button">0</span>
                                      </label>
                                      <label class="selectgroup-item">
                                        <input type="radio" class="selectgroup-input" value="1" name="<?php echo $question->employee_appraisal_result_id ?>">
                                        <span class="selectgroup-button">1</span>
                                      </label>
                                      <label class="selectgroup-item">
                                        <input type="radio" class="selectgroup-input" value="2" name="<?php echo $question->employee_appraisal_result_id ?>">
                                        <span class="selectgroup-button">2</span>
                                      </label>
                                      <label class="selectgroup-item">
                                        <input type="radio" class="selectgroup-input" value="3" name="<?php echo $question->employee_appraisal_result_id ?>">
                                        <span class="selectgroup-button">3</span>
                                      </label>
                                      <label class="selectgroup-item">
                                        <input type="radio" class="selectgroup-input" value="4" name="<?php echo $question->employee_appraisal_result_id ?>">
                                        <span class="selectgroup-button">4</span>
                                      </label>
                                      <label class="selectgroup-item">
                                        <input type="radio" class="selectgroup-input" value="5" name="<?php echo $question->employee_appraisal_result_id ?>">
                                        <span class="selectgroup-button">5</span>
                                      </label>
                                    </div>
<!--                                    <label for="employee-id">--><?php //echo $question->employee_appraisal_result_question; ?><!--</label>-->
<!--                                    <input  type="number" class="form-control"  name="--><?php //echo $question->employee_appraisal_result_id ?><!--" required />-->
                                    <p class="form-text text-muted">Select response</p>
                                  </div>
                                <?php
                                endif;
                              endforeach; ?>
                              <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
                            </div>
												  </div>
												<!--												--><?php //if($error != ' '): ?>
<!--													<div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">-->
<!--														<button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
<!--															<span aria-hidden="true">&times;</span>-->
<!--														</button>-->
<!--														<i class="mdi mdi-close-circle font-32"></i><strong class="pr-1">Error !</strong> --><?php //echo $error; ?><!--.-->
<!--													</div>-->
<!--												--><?php //endif; ?>
											</div>
											<div class="tab-pane p-3" id="qualitative" role="tabpanel">
												<div class="row">
													<div class="col-lg-5 col-md-12 col-12 col-sm-12">
														<div class="card-header">
															<h4>Grading Rubric</h4>
														</div>
														<div class="card-body">
															<div class="mb-4">
																<div class="text-small float-right font-weight-bold text-muted">0</div>
																<div class="font-weight-bold mb-1">Non Existent Competence</div>
																<div class="progress" data-height="3">
																	<div class="progress-bar" role="progressbar" data-width=0% aria-valuenow="0" aria-valuemin="0" aria-valuemax="5"></div>
																</div>
															</div>
															<div class="mb-4">
																<div class="text-small float-right font-weight-bold text-muted">1</div>
																<div class="font-weight-bold mb-1">Unsatisfactory Performance</div>
																<div class="progress" data-height="3">
																	<div class="progress-bar" role="progressbar" data-width=20% aria-valuenow="1" aria-valuemin="0" aria-valuemax="5"></div>
																</div>
															</div>
															<div class="mb-4">
																<div class="text-small float-right font-weight-bold text-muted">2</div>
																<div class="font-weight-bold mb-1">Fair Performance</div>
																<div class="progress" data-height="3">
																	<div class="progress-bar" role="progressbar" data-width=40% aria-valuenow="2" aria-valuemin="0" aria-valuemax="5"></div>
																</div>
															</div>
															<div class="mb-4">
																<div class="text-small float-right font-weight-bold text-muted">3</div>
																<div class="font-weight-bold mb-1">Satisfactory Performance</div>
																<div class="progress" data-height="3">
																	<div class="progress-bar" role="progressbar" data-width=60% aria-valuenow="3" aria-valuemin="0" aria-valuemax="5"></div>
																</div>
															</div>
															<div class="mb-4">
																<div class="text-small float-right font-weight-bold text-muted">4</div>
																<div class="font-weight-bold mb-1">Good Performance</div>
																<div class="progress" data-height="3">
																	<div class="progress-bar" role="progressbar" data-width=80% aria-valuenow="4" aria-valuemin="0" aria-valuemax="5"></div>
																</div>
															</div>
															<div class="mb-4">
																<div class="text-small float-right font-weight-bold text-muted">5</div>
																<div class="font-weight-bold mb-1">Excellent/Outstanding Performance</div>
																<div class="progress" data-height="3">
																	<div class="progress-bar" role="progressbar" data-width=100% aria-valuenow="5" aria-valuemin="0" aria-valuemax="5"></div>
																</div>
															</div>
														</div>
													</div>
                          <div class="col-lg-7 col-md-12 col-12 col-sm-12">
	                          <?php foreach ($questions as $question):
		                          if($question->employee_appraisal_result_type == 3):
			                          ?>
                                <div class="form-group">
                                  <label class="form-label"><?php echo $question->employee_appraisal_result_question; ?></label>
                                  <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                      <input type="radio" class="selectgroup-input" value="0" name="<?php echo $question->employee_appraisal_result_id ?>" required>
                                      <span class="selectgroup-button">0</span>
                                    </label>
                                    <label class="selectgroup-item">
                                      <input type="radio" class="selectgroup-input" value="1" name="<?php echo $question->employee_appraisal_result_id ?>">
                                      <span class="selectgroup-button">1</span>
                                    </label>
                                    <label class="selectgroup-item">
                                      <input type="radio" class="selectgroup-input" value="2" name="<?php echo $question->employee_appraisal_result_id ?>">
                                      <span class="selectgroup-button">2</span>
                                    </label>
                                    <label class="selectgroup-item">
                                      <input type="radio" class="selectgroup-input" value="3" name="<?php echo $question->employee_appraisal_result_id ?>">
                                      <span class="selectgroup-button">3</span>
                                    </label>
                                    <label class="selectgroup-item">
                                      <input type="radio" class="selectgroup-input" value="4" name="<?php echo $question->employee_appraisal_result_id ?>">
                                      <span class="selectgroup-button">4</span>
                                    </label>
                                    <label class="selectgroup-item">
                                      <input type="radio" class="selectgroup-input" value="5" name="<?php echo $question->employee_appraisal_result_id ?>">
                                      <span class="selectgroup-button">5</span>
                                    </label>
                                  </div>
<!--                                  <input  type="number" class="form-control"  name="--><?php //echo $question->employee_appraisal_result_id ?><!--" required />-->
                                  <p class="form-text text-muted">Select response</p>
                                </div>
		                          <?php
		                          endif;
	                          endforeach; ?>
                          </div>
												</div>
											</div>
											<div class="tab-pane p-3" id="supervisor" role="tabpanel">
												<?php foreach ($questions as $question):
													if($question->employee_appraisal_result_type == 4):
														?>
														<div class="form-group mb-0">
															<label><?php echo $question->employee_appraisal_result_question; ?></label>
															<textarea class="form-control" style="resize: vertical" cols="10" rows="5" name="<?php echo $question->employee_appraisal_result_id ?>" required=""></textarea>
															<p class="form-text text-muted">Enter response</p>
														</div>
													<?php
													endif;
												endforeach; ?>
												<input type="hidden" name="appraisal_id" value="<?php echo $appraisal_id;?>" />
												<div class="card-footer text-right">
													<button type="submit" class="btn btn-primary">Submit</button>
													<input type="reset" class="btn btn-secondary">
												</div>
											</div>

										</div>
									</div>

								</div>
							</form>
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











