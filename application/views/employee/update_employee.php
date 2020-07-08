<?php include(APPPATH.'\views\stylesheet.php'); ?>

<body>
<div id="app">
	<div class="main-wrapper">
		<div class="navbar-bg"></div>
		<?php include(APPPATH.'\views\topbar.php'); ?>
		<?php include(APPPATH.'\views\sidebar.php'); ?>
		<div class="main-content">
			<section class="section">
				<div class="section-header">
          <div class="section-header-back">
            <a href="<?php echo site_url('employee')?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
          </div>
					<h1>Update Employee</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?php echo site_url('employee')?>">Employees</a></div>
            <div class="breadcrumb-item">Update Employee</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">Update Employee Details</div>
          <p class="section-lead">You can update an employee's details here</p>
          <div class="row">
            <div class="col-12">
              <div class="card mb-0">
                <div class="card-body">
                  <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item waves-effect waves-light">
                      <a class="nav-link active" data-toggle="tab" href="#personal-information" role="tab"><i class="fas fa-user"></i> Personal Information</a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                      <a class="nav-link" data-toggle="tab" href="#job-information" role="tab"><i class="fas fa-id-card-alt"></i> Work Information</a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                      <a class="nav-link" data-toggle="tab" href="#bank-information" role="tab"><i class="fas fa-university"></i> Bank Information </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                      <a class="nav-link" data-toggle="tab" href="#other-information" role="tab"><i class="fas fa-ellipsis-h"></i> Other Information</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h4>Employee Details</h4>
                  <div class="card-header-action">
                    <div class="btn-group">
                      <button type="button" class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target=".bd-example-modal-form"><i class="fa fa-file"></i> View Documents</button>
                      <button onclick="location.href='<?php echo site_url('view_employee').'/'.$employee->employee_id;?>'" type="button" class="btn btn-icon icon-left btn-primary"><i class="fa fa-eye"></i> View Employee</button>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <form class="needs-validation" novalidate method="post" action="<?php echo site_url('edit_employee'); ?>" enctype="multipart/form-data">
                    <div class="tab-content">
                      <div class="tab-pane active p-3" id="personal-information" role="tabpanel">
                        <?php if($error != ' '): ?>
                          <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            <i class="mdi mdi-close-circle font-32"></i><strong class="pr-1">Error !</strong> <?php echo $error; ?>.
                          </div>
                        <?php endif; ?>
                        <div class="modal-body">
                          <figure class="figure">
                            <img src="<?php echo base_url()."/uploads/employee_passports/".$employee->employee_passport; ?>" alt="" class="figure-img img-fluid rounded mx-auto d-block w-80 img-thumbnail">
                            <figcaption class="figure-caption">Most Recent Passport Photograph</figcaption>
                          </figure>
<!--                          <img src="--><?php //echo base_url()."/uploads/employee_passports/".$employee->employee_passport; ?><!--" alt="" class="rounded-circle  mx-auto d-block w-80">-->
                          <div class="form-group">
                            <label>Employee ID</label>
                            <input type="text" class="form-control" readonly name="employee_unique_id" value="<?php echo $employee->employee_unique_id; ?>"/>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>First Name</label><span style="color: red"> *</span>
                              <input type="text" class="form-control" name="employee_first_name" required  value="<?php echo $employee->employee_first_name; ?>"/>
                              <div class="invalid-feedback">
                                please fill in the employee's first name
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <label>Last Name</label><span style="color: red"> *</span>
                              <input type="text" class="form-control" name="employee_last_name" required  value="<?php echo $employee->employee_last_name; ?>"/>
                              <div class="invalid-feedback">
                                please fill in the employee's last name
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <label>Other Name</label>
                              <input type="text" class="form-control"  name="employee_other_name"   value="<?php echo $employee->employee_other_name; ?>"/>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>Personal Email</label><span style="color: red"> *</span>
                              <input type="email" class="form-control" name="employee_personal_email" required value="<?php echo $employee->employee_personal_email; ?>"/>
                              <div class="invalid-feedback">
                                please fill in the employee's personal email
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <label>Official Email</label>
                              <input type="email" class="form-control"  name="employee_official_email"  value="<?php echo $employee->employee_official_email; ?>"/>
                            </div>
                            <div class="col-sm-4">
                              <label>Date of Birth</label>
                              <input type="date" name="employee_dob" value="<?php echo $employee->employee_dob; ?>" class="form-control">
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>Phone Number</label>
                              <input type="text" name="employee_phone_number" value="<?php echo $employee->employee_phone_number ?>" class="form-control cleave-number">
                            </div>
                            <div class="col-sm-8">
                              <label>Residential Address</label><span style="color: red"> *</span>
                              <textarea id="textarea" class="form-control"  required name="employee_address" maxlength="225" rows="3"><?php echo $employee->employee_address ?></textarea>
                              <div class="invalid-feedback">
                                please fill in the employee's residential address
                              </div>
                            </div>
                          </div>
                          <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
                          <input type="hidden" name="employee_id" value="<?php echo $employee->employee_id;?>"/>
                        </div>
                      </div>
                      <div class="tab-pane p-3" id="job-information" role="tabpanel">
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label>Current Grade</label>
                            <select class="selectric form-control mb-3 custom-select" required name="employee_grade" style="width: 100%; height:36px;" >
                              <?php foreach ($grades as $grade): ?>
                                <option value="<?php echo $grade->grade_id; ?>" <?php if($grade->grade_id == $employee->employee_grade_id) { echo "selected"; } ?>> <?php echo $grade->grade_name; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="col-sm-6">
                            <label>Job Role</label><span style="color: red"> *</span>
                            <select class="selectric form-control mb-3 custom-select" required  name="employee_job_role" style="width: 100%; height:56px;" >
                              <?php foreach ($roles as $role): ?>
                                <option value="<?php echo $role->job_role_id; ?>" <?php if($role->job_role_id == $employee->employee_job_role_id) { echo "selected"; } ?>> <?php echo $role->job_name." (".$role->department_name.")"; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-4">
                            <label>Academic Qualification</label><span style="color: red"> *</span>
                            <select class="selectric form-control mb-3 custom-select"  required name="employee_qualification[]" style="width: 100%" multiple="multiple" data-placeholder="Choose" >
                              <option disabled>Select</option>
                              <?php foreach ($qualifications as $qualification): ?>
                                <?php $employee_qualifications = json_decode($employee->employee_qualification); ?>
                                <option value="<?php echo $qualification->qualification_id; ?>" <?php foreach ($employee_qualifications as $employee_qualification){
                                  if($employee_qualification == $qualification->qualification_id){
                                    echo "selected";
                                  }
                                } ?>> <?php echo $qualification->qualification_name; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="col-sm-4">
                            <label>SBU (Location)</label>
                            <select class="selectric form-control mb-3 custom-select" required name="location" style="width: 100%; height:56px;" >
                              <?php foreach ($locations as $location): ?>
                                <option value="<?php echo $location->location_id; ?>" <?php if($location->location_id == $employee->employee_location_id){ echo "selected"; } ?>> <?php echo $location->location_name; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="col-sm-4">
                            <label>Subsidiary</label>
                            <select class="selectric form-control mb-3 custom-select" required name="subsidiary" style="width: 100%; height:56px;">
                              <?php foreach ($subsidiarys as $subsidiary): ?>
                                <option value="<?php echo $subsidiary->subsidiary_id; ?>" <?php if($subsidiary->subsidiary_id == $employee->employee_subsidiary_id){ echo "selected"; } ?>> <?php echo $subsidiary->subsidiary_name; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div id="work_experiences">
                          <label>Work Experiences </label><br>
                          <?php if(empty($work_experiences)){ ?>
                            <p class="form-text text-muted">No Work Experience Found For Employee</p>
                          <?php } else { foreach ($work_experiences as $work_experience){ ?>
                            <div id="work_experience1">
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label>Company Name</label>
                                  <input type="text" class="form-control" name="company_name[]"   value="<?php echo $work_experience->company_name;?>"/>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label> Job Description</label>
                                  <textarea id="textarea" class="form-control" name="job_description[]" disabled maxlength="225" rows="3"><?php echo $work_experience->job_description;  ?></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-6">
                                  <label> Start Date</label>
                                  <input type="date" name="experience_start_date[]" disabled value="<?php echo $work_experience->start_date;  ?>" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                  <label> End Date</label>
                                  <input type="date" name="experience_end_date[]" disabled value="<?php echo $work_experience->end_date;  ?>" class="form-control">
                                </div>
                              </div>
                            </div>
                            <hr>
                          <?php		}
                          } ?>
                        </div>
                      </div>
                      <div class="tab-pane p-3" id="bank-information" role="tabpanel">
                        <div class="form-group row">

                          <div class="col-sm-6">
                            <label> Account Number</label><span style="color: red"> *</span>
                            <input name="employee_account_number" value="<?php echo $employee->employee_account_number; ?>" type="number"
                                   class="form-control"
                                   oninput="this.value = this.value.slice(0, this.maxLength)"
                                   required/>
                            <div class="invalid-feedback">
                              please fill in an account number
                            </div>
                            <p class="form-text text-muted">Please fill in a 10 digit account number</p>
                          </div>
                          <div class="col-sm-6">
                            <label>Bank</label><span style="color: red"> *</span>
                            <select class="selectric form-control mb-3 custom-select" required  name="employee_bank" style="width: 100%; height:56px;">
                              <option>Select</option>
                              <?php foreach ($banks as $bank): ?>
                                <option value="<?php echo $bank->bank_id; ?>"<?php if($bank->bank_id == $employee->employee_bank_id){
                                  echo "Selected";
                                } ?>> <?php echo $bank->bank_name; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label> HMO ID</label>
                            <input name="employee_hmo_number" value="<?php echo $employee->employee_hmo_number; ?>" type="text" class="form-control"/>
                          </div>
                          <div class="col-sm-6">
                            <label>HMO Provider</label><span style="color: red"> *</span>
                            <select class="selectric form-control mb-3 custom-select" required name="employee_hmo_id" style="width: 100%; height:56px;">
                              <option value="0" selected> N/A </option>
                              <?php foreach ($health_insurances as $health_insurance): ?>
                                <option value="<?php echo $health_insurance->health_insurance_id; ?>" <?php if($health_insurance->health_insurance_id == $employee->employee_hmo_id){
                                  echo "Selected";
                                } ?>> <?php echo $health_insurance->health_insurance_hmo; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label> PAYE Number</label>
                            <input  name="employee_paye_number" type="text" class="form-control" value="<?php echo $employee->employee_paye_number; ?>"/>
                          </div>
                          <div class="col-sm-6">
                            <label>Pensionable? </label>
                            <select class="selectric form-control mb-3 custom-select" required name="employee_pensionable" onchange="pensionable()" id="employee_pensionable" style="width: 100%; height:56px;">
                              <option value="0" <?php if($employee->employee_pensionable == 0){ echo "selected"; } ?>> No </option>
                              <option value="1" <?php if($employee->employee_pensionable == 1){ echo "selected"; } ?>> Yes </option>
                            </select>
                          </div>
                        </div>
                        <div id="pensiondiv">
                          <div class="form-group row">
                            <div class="col-sm-6">
                              <label> Pension Number</label>
                              <input  name="employee_pension_number" id="employee_pension_number" value="<?php echo $employee->employee_pension_number ?>" type="text" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label>Pension Administrator</label>
                              <select class="selectric form-control mb-3 custom-select"  id="employee_pension_id" name="employee_pension_id" style="width: 100%; height:56px;">
                                <option value="0" selected> N/A </option>
                                <?php foreach ($pensions as $pension): ?>
                                  <option value="<?php echo $pension->pension_id; ?>" <?php if($pension->pension_id == $employee->employee_pension_id){
                                    echo "Selected";
                                  } ?>> <?php echo $pension->pension_provider; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane p-3" id="other-information" role="tabpanel">
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label> NYSC Pass Out Number:</label>
                            <input name="nysc_pass_out" type="text" class="form-control" required value="<?php echo $employee->employee_nysc_details; ?>"/>
                          </div>
                          <div class="col-sm-6">
                            <label>Employment Status</label>
                            <select class="selectric form-control mb-3 custom-select" required  name="employment_status" style="width: 100%; height:56px;">

                              <option value="1"  <?php if($employee->employee_status == 1){echo "selected" ;} ?>> Probationary </option>
                              <option value="2"  <?php if($employee->employee_status == 2){echo "selected" ;} ?>> Confirmed  </option>

                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label> Employment Start Date:</label>
                            <input type="date" name="employment_start_date" value="<?php echo $employee->employee_employment_date; ?>"  required class="form-control" placeholder="mm/dd/yyyy">
                          </div>
                          <div class="col-sm-6">
                            <label>Employment Stop Date</label> <br>
                            <input type="date" name="employment_stop_date" value="<?php echo $employee->employee_stop_date; ?>"  class="form-control" placeholder="mm/dd/yyyy">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-warning">Save Changes</button>
                        </div>
                      </div>
                    </div>
                  </form>
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

<div class="modal fade bd-example-modal-form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
      <div class="modal-header">
        <h5>Uploaded Documents</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
			<div class="modal-body">
				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner" role="listbox">
						<div class="carousel-item active">
							<iframe
									src="<?php echo base_url()."/uploads/employee_passports/".$employee->employee_passport; ?>" scrolling="no" frameborder="no" height="700px" onload="resizeIframe(this)" width="100%">
							</iframe>
						</div>
						<div class="carousel-item">
							<iframe
									src="<?php echo base_url()."/uploads/employee_nysc/".$employee->employee_nysc_document; ?>" scrolling="no" frameborder="no" height="700px" width="100%">
							</iframe>
						</div>
						<?php if(empty($other_documents)){
						} else{ foreach ($other_documents as $other_document){ ?>
							<div class="carousel-item">
								<iframe
										src="<?php echo base_url()."/uploads/employee_others/".$other_document->other_document_name; ?>" height="700px" width="100%">
								</iframe>
							</div>
						<?php	} } ?>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
      <div class="modal-footer bg-whitesmoke">
        <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
      </div>
		</div>
	</div>
</div>
<?php include(APPPATH.'\views\footer.php'); ?>
<?php include(APPPATH.'\views\js.php'); ?>
<script>
  window.onload = function(){
    let pensionable = document.getElementById('employee_pensionable').value

    if(pensionable == 0){
      document.getElementById("pensiondiv").style.display='none';
    }

    if(pensionable == 1){
      document.getElementById("pensiondiv").style.display='block';
    }
  }

  function pensionable(){
    let pensionable = document.getElementById('employee_pensionable').value

    if(pensionable == 0){
      document.getElementById("pensiondiv").style.display='none';
    }

    if(pensionable == 1){
      document.getElementById("pensiondiv").style.display='block';
    }
  }
</script>
</body>
</html>

