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
            <a href="<?php echo site_url('employee')?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
          </div>
					<h1>View Employee</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?php echo site_url('employee')?>">Employees</a></div>
            <div class="breadcrumb-item">View Employee</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">View Employee Details</div>
          <p class="section-lead">You can view details and documents related to a chosen employee here</p>
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
                      <button onclick="location.href='<?php echo site_url('update_employee').'/'.$employee->employee_id;?>'" type="button" class="btn btn-icon icon-left btn-primary"><i class="fa fa-edit"></i> Update Employee</button>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <form enctype="multipart/form-data">
                    <div class="tab-content">
                      <div class="tab-pane active p-3" id="personal-information" role="tabpanel">
                        <div class="modal-body">
                          <div class="chocolat-parent">
                            <a href="<?php echo base_url()."/uploads/employee_passports/".$employee->employee_passport; ?>" class="chocolat-image" title="Passport Photo">
                              <figure class="figure">
                                <img src="<?php echo base_url()."/uploads/employee_passports/".$employee->employee_passport; ?>" alt="" width="100" height="100" class="figure-img img-fluid rounded mx-auto d-block w-80 img-thumbnail">
                                <figcaption class="figure-caption">Most Recent Passport Photograph</figcaption>
                              </figure>
                            </a>
                          </div>
                          <div class="form-group">
                            <label>Employee ID</label>
                            <input type="text" class="form-control" disabled  name="employee_unique_id" value="<?php echo $employee->employee_unique_id; ?>"/>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>First Name</label>
                              <input type="text" class="form-control" disabled  name="employee_first_name" value="<?php echo $employee->employee_first_name; ?>"/>
                            </div>
                            <div class="col-sm-4">
                              <label>Last Name</label>
                              <input type="text" class="form-control"  disabled name="employee_last_name" value="<?php echo $employee->employee_last_name; ?>"/>
                            </div>
                            <div class="col-sm-4">
                              <label>Other Name</label>
                              <input type="text" class="form-control" disabled name="employee_other_name"   value="<?php echo $employee->employee_other_name; ?>"/>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>Personal Email</label>
                              <input type="email" class="form-control" disabled  name="employee_personal_mail" value="<?php echo $employee->employee_personal_email; ?>"/>
                            </div>
                            <div class="col-sm-4">
                              <label>Official Email</label>
                              <input type="email" class="form-control" disabled name="employee_official_email"  value="<?php echo $employee->employee_official_email; ?>"/>
                            </div>
                            <div class="col-sm-4">
                              <label>Date of Birth</label>
                              <div class="input-group">
                                <input type="date" name="employee_dob" disabled value="<?php echo $employee->employee_dob; ?>" class="form-control">
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>Phone Number</label>
                              <input type="text" name="employee_phone_number" disabled value="<?php echo $employee->employee_phone_number ?>" class="form-control">
                            </div>
                            <div class="col-sm-8">
                              <label>Employee Address</label>
                              <textarea id="textarea" class="form-control" disabled name="employee_address" maxlength="225" rows="3"><?php echo $employee->employee_address ?></textarea>
                            </div>
                          </div>
							<div class="form-group row">
								<div class="col-sm-6">
									<label >State of Origin</label>
									<select  class="select2 form-control" disabled name="employee_state_of_origin" style="width: 100%; height: 42px !important;">
										<option value="">Select</option>
										<option value="FCT-Abuja" <?php if($employee->employee_state == "FCT-Abuja" ): echo "selected"; endif; ?>> FCT-Abuja </option>
										<option value="Abia State" <?php if($employee->employee_state == "Abia State" ): echo "selected"; endif; ?>> Abia State </option>
										<option value="Adamawa State" <?php if($employee->employee_state == "Adamawa State" ): echo "selected"; endif; ?>> Adamawa State </option>
										<option value="Akwa Ibom State" <?php if($employee->employee_state == "Akwa Ibom State" ): echo "selected"; endif; ?>> Akwa Ibom State </option>
										<option value="Anambra State" <?php if($employee->employee_state == "Anambra State" ): echo "selected"; endif; ?>> Anambra State </option>
										<option value="Bauchi State" <?php if($employee->employee_state == "Bauchi State" ): echo "selected"; endif; ?>> Bauchi State </option>
										<option value="Bayelsa State" <?php if($employee->employee_state == "Bayelsa State" ): echo "selected"; endif; ?>> Bayelsa State </option>
										<option value="Benue State" <?php if($employee->employee_state == "Benue State" ): echo "selected"; endif; ?>> Benue State </option>
										<option value="Borno State" <?php if($employee->employee_state == "Borno State" ): echo "selected"; endif; ?>> Borno State </option>
										<option value="Cross River State" <?php if($employee->employee_state == "Cross River State" ): echo "selected"; endif; ?>> Cross River State </option>
										<option value="Delta State" <?php if($employee->employee_state == "Delta State"  ): echo "selected"; endif; ?>> Delta State </option>
										<option value="Ebonyi State" <?php if($employee->employee_state == "Ebonyi State" ): echo "selected"; endif; ?>> Ebonyi State </option>
										<option value="Edo State" <?php if($employee->employee_state == "Edo State" ): echo "selected"; endif; ?>> Edo State </option>
										<option value="Ekiti State" <?php if($employee->employee_state == "Ekiti State" ): echo "selected"; endif; ?>> Ekiti State </option>
										<option value="Enugu State" <?php if($employee->employee_state == "Enugu State" ): echo "selected"; endif; ?>> Enugu State </option>
										<option value="Gombe State" <?php if($employee->employee_state == "Gombe State" ): echo "selected"; endif; ?>> Gombe State </option>
										<option value="Imo State" <?php if($employee->employee_state == "Imo State" ): echo "selected"; endif; ?>> Imo State </option>
										<option value="Jigawa State" <?php if($employee->employee_state == "Jigawa State" ): echo "selected"; endif; ?>> Jigawa State </option>
										<option value="Kaduna State" <?php if($employee->employee_state == "Kaduna State" ): echo "selected"; endif; ?>> Kaduna State </option>
										<option value="Kano State" <?php if($employee->employee_state == "Kano State" ): echo "selected"; endif; ?>> Kano State </option>
										<option value="Katsina State" <?php if($employee->employee_state == "Katsina State" ): echo "selected"; endif; ?>> Katsina State </option>
										<option value="Kebbi State" <?php if($employee->employee_state == "Kebbi State" ): echo "selected"; endif; ?>> Kebbi State </option>
										<option value="Kogi State" <?php if($employee->employee_state == "Kogi State" ): echo "selected"; endif; ?>> Kogi State </option>
										<option value="Kwara State" <?php if($employee->employee_state == "Kwara State" ): echo "selected"; endif; ?>> Kwara State </option>
										<option value="Lagos State" <?php if($employee->employee_state == "Lagos State" ): echo "selected"; endif; ?>> Lagos State </option>
										<option value="Nasarawa State" <?php if($employee->employee_state == "Nasarawa State" ): echo "selected"; endif; ?>> Nasarawa State </option>
										<option value="Niger State" <?php if($employee->employee_state == "Niger State" ): echo "selected"; endif; ?>> Niger State </option>
										<option value="Ogun State" <?php if($employee->employee_state == "Ogun State" ): echo "selected"; endif; ?>> Ogun State </option>
										<option value="Ondo State" <?php if($employee->employee_state == "Ondo State" ): echo "selected"; endif; ?>> Ondo State </option>
										<option value="Osun State" <?php if($employee->employee_state == "Osun State" ): echo "selected"; endif; ?>> Osun State </option>
										<option value="Oyo State" <?php if($employee->employee_state == "Oyo State" ): echo "selected"; endif; ?>> Oyo State </option>
										<option value="Plateau State" <?php if($employee->employee_state == "Plateau State" ): echo "selected"; endif; ?>> Plateau State </option>
										<option value="Rivers State" <?php if($employee->employee_state == "Rivers State" ): echo "selected"; endif; ?>> Rivers State </option>
										<option value="Sokoto State" <?php if($employee->employee_state == "Sokoto State" ): echo "selected"; endif; ?>> Sokoto State </option>
										<option value="Taraba State" <?php if($employee->employee_state == "Taraba State" ): echo "selected"; endif; ?>> Taraba State </option>
										<option value="Yobe State" <?php if($employee->employee_state == "Yobe State" ): echo "selected"; endif; ?>> Yobe State </option>
										<option value="Zamfara State" <?php if($employee->employee_state == "Zamfara State" ): echo "selected"; endif; ?>> Zamfara State </option>

									</select>
								</div>
								<div class="col-sm-6">
									<label>LGA</label>
									<input type="text" disabled name="employee_lga" value="<?php echo $employee->employee_lga; ?>" class="form-control">
								</div>

							</div>
							<div class="form-group row">
								<div class="col-sm-4">
									<label ">Marital Status</label>
									<input  type="text" name="employee_marital" disabled value="<?php echo $employee->employee_marital_status; ?>" class="form-control">
								</div>
								<div class="col-sm-4">
									<label>Spouse Name</label>
									<input  type="text" name="employee_spouse_name" disabled value="<?php echo  $employee->employee_spouse_name; ?>" class="form-control">
								</div>
								<div class="col-sm-4">
									<label>Spouse Phone Number</label>
									<input  type="text" name="employee_spouse_phone_number" disabled value="<?php echo $employee->employee_spouse_phone_number; ?>" class="form-control cleave-number">


								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-4">
									<label ">Known Ailments</label>
									<input  type="text" name="employee_ailments" disabled  value="<?php echo $employee->employee_ailments; ?>" class="form-control">
								</div>
								<div class="col-sm-4">
									<label>Blood Group</label>
									<input  type="text" name="employee_blood" disabled  value="<?php echo $employee->employee_blood; ?>" class="form-control">
								</div>
								<div class="col-sm-4">
									<label>Genotype</label>
									<input  type="text" name="employee_genotype" disabled value="<?php echo $employee->employee_genotype; ?>" class="form-control ">

								</div>
							</div>

							<div class="form-group row">
								<div class="col-sm-4">
									<label for="phone-number">Next of Kin's Name</label>
									<input  type="text" name="employee_next_of_kin_name" disabled value="<?php echo $employee->employee_next_of_kin_name; ?>" class="form-control">
								</div>
								<div class="col-sm-4">
									<label>Next of Kin's Phone Number</label>
									<input  type="text" name="employee_next_of_kin_phone_number" disabled value="<?php echo $employee->employee_next_of_kin_phone_number; ?>" class="form-control cleave-number">
								</div>
								<div class="col-sm-4">
									<label>Next of Kin'sResidential Address</label>
									<textarea id="textarea" class="form-control" disabled   name="employee_next_of_kin_address"  maxlength="225" rows="3"> <?php echo $employee->employee_next_of_kin_address; ?> </textarea>

								</div>
							</div>

							<div class="form-group row">
								<div class="col-sm-6">
									<label for="phone-number">Emergency Contact Name</label>
									<input  type="text" name="employee_emergency_name" disabled value="<?php echo $employee->employee_emergency_name; ?>" class="form-control">
								</div>
								<div class="col-sm-6">
									<label>Emergency Contact's Phone Number</label>
									<input type="text" name="employee_emergency_phone" disabled value="<?php echo $employee->employee_emergency_contact; ?>" class="form-control cleave-number">
								</div>

							</div>
                          <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
                        </div>
                        <div class="text-center">
                          <span class="prv" style="cursor: not-allowed" id="prv">previous</span>
                          <div class="bullet"></div>
                          <span class="text-primary nxt" style="cursor: pointer" id="nxt">next</span>
                        </div>
                      </div>
                      <div class="tab-pane p-3" id="job-information" role="tabpanel">
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label>Current Grade</label>
                            <select class="selectric form-control mb-3 custom-select" name="employee_grade" style="width: 100%; height:36px;">
                              <?php foreach ($grades as $grade): ?>
                                <option disabled value="<?php echo $grade->grade_id; ?>" <?php if($grade->grade_id == $employee->employee_grade_id) { echo "selected"; } ?>> <?php echo $grade->grade_name; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="col-sm-6">
                            <label>Job Role</label>
                            <select class="selectric form-control mb-3 custom-select" name="employee_job_role" style="width: 100%; height:56px;">
                              <?php foreach ($roles as $role): ?>
                                <option disabled value="<?php echo $role->job_role_id; ?>" <?php if($role->job_role_id == $employee->employee_job_role_id) { echo "selected"; } ?>> <?php echo $role->job_name." (".$role->department_name.")"; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-4">
                            <label>Employee Qualification</label>
                            <select class="selectric form-control mb-3 custom-select" name="employee_qualification[]" style="width: 100%" multiple="multiple">
                              <?php foreach ($qualifications as $qualification): ?>
                                <?php $employee_qualifications = json_decode($employee->employee_qualification); ?>
                                <option disabled value="<?php echo $qualification->qualification_id; ?>"
                                <?php foreach ($employee_qualifications as $employee_qualification){
                                  if($employee_qualification == $qualification->qualification_id){
                                    echo "selected";
                                  }
                                }
                                ?>> <?php echo $qualification->qualification_name; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="col-sm-4">
                            <label>SBU (Location)</label>
                            <select class="selectric form-control mb-3 custom-select" name="location" style="width: 100%; height:56px;">
                              <?php foreach ($locations as $location): ?>
                                <option disabled value="<?php echo $location->location_id; ?>" <?php if($location->location_id == $employee->employee_location_id){ echo "selected"; } ?>> <?php echo $location->location_name; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="col-sm-4">
                            <label>Subsidiary</label>
                            <select class="selectric form-control mb-3 custom-select" required name="location" style="width: 100%; height:56px;">
                              <?php foreach ($subsidiarys as $subsidiary): ?>
                                <option disabled value="<?php echo $subsidiary->subsidiary_id; ?>" <?php if($subsidiary->subsidiary_id == $employee->employee_subsidiary_id){ echo "selected"; } ?>> <?php echo $subsidiary->subsidiary_name; ?></option>
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
                                  <input type="text" class="form-control" name="company_name[]"   value="<?php echo $work_experience->company_name;  ?>" disabled/>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label> Job Description:</label>
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
                        <div class="text-center">
                          <span class="text-primary prv" style="cursor: pointer" id="prv">previous</span>
                          <div class="bullet"></div>
                          <span class="text-primary nxt" style="cursor: pointer" id="nxt">next</span>
                        </div>
                      </div>
                      <div class="tab-pane p-3" id="bank-information" role="tabpanel">
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label> Account Number</label>
                            <input name="employee_account_number" disabled value="<?php echo $employee->employee_account_number; ?>" type="number" class="form-control"/>
                          </div>
                          <div class="col-sm-6">
                            <label>Bank</label>
                            <select class="selectric form-control mb-3 custom-select" required name="employee_bank" style="width: 100%; height:56px;">
                              <?php foreach ($banks as $bank): ?>
                                <option disabled value="<?php echo $bank->bank_id; ?>"<?php if($bank->bank_id == $employee->employee_bank_id){
                                  echo "Selected";
                                } ?>> <?php echo $bank->bank_name; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label>HMO ID</label>
                            <input name="employee_hmo_number" disabled value="<?php echo $employee->employee_hmo_number; ?>" type="text" class="form-control"/>
                          </div>
                          <div class="col-sm-6">
                            <label>HMO Provider</label>
                            <select class="selectric form-control mb-3 custom-select"  name="employee_hmo_id" style="width: 100%; height:56px;">
                              <?php foreach ($health_insurances as $health_insurance): ?>
                                <option disbaled value="<?php echo $health_insurance->health_insurance_id; ?>" <?php if($health_insurance->health_insurance_id == $employee->employee_hmo_id){
                                  echo "Selected";
                                } ?>> <?php echo $health_insurance->health_insurance_hmo; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label> Employee PAYE Number</label>
                            <input name="employee_paye_number" disabled type="text" class="form-control" value="<?php echo $employee->employee_paye_number; ?>"/>
                          </div>
                          <div class="col-sm-6">
                            <label>Pensionable?</label>
                            <select class="selectric form-control mb-3 custom-select" name="employee_pensionable" id="employee_pensionable" style="width: 100%; height:56px;">
                              <option disabled value="0" <?php if($employee->employee_pensionable == 0){ echo "selected"; } ?>> No </option>
                              <option disabled value="1" <?php if($employee->employee_pensionable == 1){ echo "selected"; } ?>> Yes </option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <?php if($employee->employee_pensionable == 1): ?>
                            <div class="col-sm-6">
                              <label> Pension Number</label>
                              <input name="employee_pension_number" disabled value="<?php echo $employee->employee_pension_number ?>" type="text" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label>Pension Administrator</label>
                              <select class="selectric form-control mb-3 custom-select" name="employee_pension_id" style="width: 100%; height:56px;">
                                <?php foreach ($pensions as $pension): ?>
                                  <option disabled value="<?php echo $pension->pension_id; ?>" <?php if($pension->pension_id == $employee->employee_pension_id){
                                    echo "Selected";
                                  } ?>> <?php echo $pension->pension_provider; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          <?php
                          endif; ?>
                        </div>
                        <div class="text-center">
                          <span class="text-primary prv" style="cursor: pointer" id="prv">previous</span>
                          <div class="bullet"></div>
                          <span class="text-primary nxt" style="cursor: pointer" id="nxt">next</span>
                        </div>
                      </div>
                      <div class="tab-pane p-3" id="other-information" role="tabpanel">
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label>NYSC Pass Out Number</label>
                            <input name="nysc_pass_out" disabled type="number" class="form-control" value="<?php echo $employee->employee_nysc_details; ?>"/>
                          </div>
                          <div class="col-sm-6">
                            <label>Employment Status</label>
                            <select class="selectric form-control mb-3 custom-select" required name="employment_status" style="width: 100%; height:56px;">
                              <option disabled value="0" <?php if($employee->employee_status == 0){echo "selected" ;} ?>> Fired </option>
                              <option disabled value="1" <?php if($employee->employee_status == 1){echo "selected" ;} ?>> Probationary </option>
                              <option disabled value="2" <?php if($employee->employee_status == 2){echo "selected" ;} ?>> Confirmed </option>
                              <option disabled value="3" <?php if($employee->employee_status == 3){echo "selected" ;} ?>> Retired</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label> Employment Start Date</label>
                            <input type="date" name="employment_start_date" value="<?php echo $employee->employee_employment_date; ?>" disabled class="form-control">
                          </div>
                          <div class="col-sm-6">
                            <label>Employment Stop Date</label> <br>
                            <input type="date" name="employment_stop_date" value="<?php echo $employee->employee_stop_date; ?>" disabled class="form-control">
                          </div>
                        </div>
                        <div class="text-center">
                          <span class="text-primary prv" style="cursor: pointer" id="prv">previous</span>
                          <div class="bullet"></div>
                          <span class="nxt" style="cursor: not-allowed" id="nxt">next</span>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-right bg-whitesmoke">
                  <button onclick="location.href='<?php echo site_url('employee');?>'" class="btn btn-danger" type="button">Go Back</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
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
	</div>
</div>
<?php include(APPPATH.'/views/footer.php'); ?>
<?php include(APPPATH.'/views/js.php'); ?>
<script>
  $('title').html('View Employee - IHUMANE')

  $('.nxt').on('click', function () {
    moveTab('next');
  });
  $('.prv').on('click', function () {
    moveTab('previous');
  })

  function moveTab(nextOrPrev){
    var currentTab = "";
    $('.nav-pills li a').each(function () {
      if($(this).hasClass('active')) {
        currentTab = $(this);
      }
    });
    if(nextOrPrev == 'next'){
      if(currentTab.parent().next().length){
        currentTab.parent().next().children().trigger('click');
      }
    } else {
      if(currentTab.parent().prev().length){
        currentTab.parent().prev().children().trigger('click');
      }
    }
  }
</script>
</body>
</html>
