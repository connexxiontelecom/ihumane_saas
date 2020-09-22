<?php include(APPPATH . '/views/stylesheet.php'); ?>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <?php include(APPPATH . '/views/topbar.php'); ?>
      <?php include(APPPATH . '/views/sidebar.php'); ?>
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>New Employee</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
              <div class="breadcrumb-item">New Employee</div>
            </div>
          </div>
          <div class="section-body">
            <div class="section-title">All About Creating Employees</div>
            <p class="section-lead">You can complete the form to create an employee here</p>
            <div class="row">
              <div class="col-12">
                <div class="card mb-0">
                  <div class="card-body">
                    <ul class="nav nav-pills" role="tablist">
                      <li class="nav-item waves-effect waves-light">
                        <a class="nav-link active" data-toggle="tab" href="#personal-information" role="tab"> <i class="fas fa-user"></i> Personal Information</a>
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
                <form method="post" action="<?php echo site_url('add_employee'); ?>" data-persist="garlic" enctype="multipart/form-data" class="needs-validation" novalidate>
                  <div class="card card-primary">
                    <div class="card-header">
                      <h4>New Employee Form</h4>
                    </div>
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="tab-pane active p-3" id="personal-information" role="tabpanel">
                          <?php if ($error != ' ') : ?>
                            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <i class="mdi mdi-close-circle font-32"></i><strong class="pr-1">Error !</strong> <?php echo $error; ?>.
                            </div>
                          <?php endif; ?>
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="employee-id">Employee ID</label>
                              <input id="employee-id" type="text" class="form-control" name="employee_unique_id" required readonly value="<?php echo $unique_id; ?>" />
                              <p class="form-text text-muted">A unique id will be generated for each new employee</p>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-4">
                                <label for="first-name">First Name</label><span style="color: red"> *</span>
                                <input id="first-name" type="text" class="form-control" name="employee_first_name" required />
                                <div class="invalid-feedback">
                                  please fill in the employee's first name
                                </div>
                              </div>
                              <div class="col-sm-4">
                                <label for="last-name">Last Name</label><span style="color: red"> *</span>
                                <input id="last-name" type="text" class="form-control" name="employee_last_name" required />
                                <div class="invalid-feedback">
                                  please fill in the employee's last name
                                </div>
                              </div>
                              <div class="col-sm-4">
                                <label for="other-name">Other Name</label>
                                <input id="other-name" type="text" class="form-control" name="employee_other_name" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-4">
                                <label for="personal-email">Personal Email</label><span style="color: red"> *</span>
                                <input id="personal-email" type="email" class="form-control" name="employee_personal_email" required />
                                <div class="invalid-feedback">
                                  please fill in the employee's personal email
                                </div>
                              </div>
                              <div class="col-sm-4">
                                <label for="official-email">Official Email</label>
                                <input id="official-email" type="email" class="form-control" name="employee_official_email" />
                              </div>
                              <div class="col-sm-4">
                                <label for="dob">Date of Birth</label>
                                <div class="input-group">
                                  <input id="dob" type="text" name="employee_dob" class="form-control datepicker">
                                </div>
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-4">
                                <label for="phone-number">Phone Number</label>
                                <input id="phone-number" type="text" name="employee_phone_number" class="form-control cleave-number">
                              </div>
                              <div class="col-sm-8">
                                <label>Residential Address</label><span style="color: red"> *</span>
                                <textarea id="textarea" class="form-control" required name="employee_address" maxlength="225" rows="3"></textarea>
                                <div class="invalid-feedback">
                                  please fill in the employee's residential address
                                </div>
                              </div>
                            </div>
							  <div class="form-group row">
								  <div class="col-sm-6">
									  <label >State of Origin</label>
									  <select  class="select2 form-control" required name="employee_state_of_origin" style="width: 100%; height: 42px !important;">
										  <option value="">Select</option>
										  <option value="FCT-Abuja"> FCT-Abuja </option>
										  <option value="Abia State"> Abia State </option>
										  <option value="Adamawa State"> Adamawa State </option>
										  <option value="Akwa Ibom State"> Akwa Ibom State </option>
										  <option value="Anambra State"> Anambra State </option>
										  <option value="Bauchi State"> Bauchi State </option>
										  <option value="Bayelsa State"> Bayelsa State </option>
										  <option value="Benue State"> Benue State </option>
										  <option value="Borno State"> Borno State </option>
										  <option value="Cross River State"> Cross River State </option>
										  <option value="Delta State"> Delta State </option>
										  <option value="Ebonyi State"> Ebonyi State </option>
										  <option value="Edo State"> Edo State </option>
										  <option value="Ekiti State"> Ekiti State </option>
										  <option value="Enugu State"> Enugu State </option>
										  <option value="Gombe State"> Gombe State </option>
										  <option value="Imo State"> Imo State </option>
										  <option value="Jigawa State"> Jigawa State </option>
										  <option value="Kaduna State"> Kaduna State </option>
										  <option value="Kano State"> Kano State </option>
										  <option value="Katsina State"> Katsina State </option>
										  <option value="Kebbi State"> Kebbi State </option>
										  <option value="Kogi State"> Kogi State </option>
										  <option value="Kwara State"> Kwara State </option>
										  <option value="Lagos State"> Lagos State </option>
										  <option value="Nasarawa State"> Nasarawa State </option>
										  <option value="Niger State"> Niger State </option>
										  <option value="Ogun State"> Ogun State </option>
										  <option value="Ondo State"> Ondo State </option>
										  <option value="Osun State"> Osun State </option>
										  <option value="Oyo State"> Oyo State </option>
										  <option value="Plateau State"> Plateau State </option>
										  <option value="Rivers State"> Rivers State </option>
										  <option value="Sokoto State"> Sokoto State </option>
										  <option value="Taraba State"> Taraba State </option>
										  <option value="Yobe State"> Yobe State </option>
										  <option value="Zamfara State"> Zamfara State </option>

									  </select>
								  </div>
								  <div class="col-sm-6">
									  <label>LGA</label>
									  <input type="text" name="employee_lga" class="form-control">
								  </div>

							  </div>
							  <div class="form-group row">
								  <div class="col-sm-4">
									  <label ">Marital Status</label>
									  <input  type="text" name="employee_marital" class="form-control">
								  </div>
								  <div class="col-sm-4">
									  <label>Spouse Name</label>
									  <input  type="text" name="employee_spouse_name" class="form-control">
								  </div>
								  <div class="col-sm-4">
									  <label>Spouse Phone Number</label>
									  <input  type="text" name="employee_spouse_phone_number" class="form-control cleave-number">


								  </div>
							  </div>
							  <div class="form-group row">
								  <div class="col-sm-4">
									  <label ">Known Ailments</label>
									  <input  type="text" name="employee_ailments" class="form-control">
								  </div>
								  <div class="col-sm-4">
									  <label>Blood Group</label>
									  <input  type="text" name="employee_blood" class="form-control">
								  </div>
								  <div class="col-sm-4">
									  <label>Genotype</label>
									  <input  type="text" name="employee_genotype" class="form-control ">

								  </div>
							  </div>

							  <div class="form-group row">
								  <div class="col-sm-4">
									  <label for="phone-number">Next of Kin's Name</label>
									  <input  type="text" name="employee_next_of_kin_name" class="form-control">
								  </div>
								  <div class="col-sm-4">
									  <label>Next of Kin's Phone Number</label>
									  <input  type="text" name="employee_next_of_kin_phone_number" class="form-control cleave-number">
								  </div>
								  <div class="col-sm-4">
									  <label>Next of Kin'sResidential Address</label>
									  <textarea id="textarea" class="form-control" required name="employee_next_of_kin_address" maxlength="225" rows="3"></textarea>
									  <div class="invalid-feedback">
										  please fill in the employee's residential address
									  </div>
								  </div>
							  </div>

							  <div class="form-group row">
								  <div class="col-sm-6">
									  <label for="phone-number">Emergency Contact Name</label>
									  <input  type="text" name="employee_emergency_name" class="form-control">
								  </div>
								  <div class="col-sm-6">
									  <label>Emergency Contact's Phone Number</label>
									  <input type="text" name="employee_emergency_phone" class="form-control cleave-number">
								  </div>

							  </div>
                            <input type="hidden" name="<?php echo $csrf_name; ?>" value="<?php echo $csrf_hash; ?>" />
                          </div>
                          <div class="text-center">
                            <span class="prv" style="cursor: not-allowed">previous </span>
                            <div class="bullet"></div>
                            <span class="text-primary nxt" style="cursor: pointer"> next</span>
                            <p class="form-text text-muted">Please click next to ensure all required fields are complete to submit the form</p>
                          </div>
                        </div>







                        <div class="tab-pane p-3" id="job-information" role="tabpanel">
                          <div class="form-group row">
                            <div class="col-sm-6">
                              <label for="grade">Current Grade</label><span style="color: red"> *</span>
                              <select id="grade" class="select2 form-control" required name="employee_grade" style="width: 100%; height: 42px !important;">
                                <option value="">Select</option>
                                <?php foreach ($grades as $grade) : ?>
                                  <option value="<?php echo $grade->grade_id; ?>"> <?php echo $grade->grade_name; ?></option>
                                <?php endforeach; ?>
                              </select>
                              <div class="invalid-feedback">
                                please select a current grade
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <label for="role">Job Role</label><span style="color: red"> *</span>
                              <select id="role" class="select2 form-control" required name="employee_job_role" style="width: 100%; height: 42px !important;">
                                <option value="">Select</option>
                                <?php foreach ($roles as $role) : ?>
                                  <option value="<?php echo $role->job_role_id; ?>"> <?php echo $role->job_name . " (" . $role->department_name . ")"; ?></option>
                                <?php endforeach; ?>
                              </select>
                              <div class="invalid-feedback">
                                please select a job role
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-6">
                              <label for="qualification">Academic Qualifications</label><span style="color: red"> *</span>
                              <select id="qualification" class="select2 form-control" required name="employee_qualification[]" style="width: 100%; height: 42px !important;" multiple data-placeholder="Choose">
                                <option value="" disabled>Select</option>
                                <?php foreach ($qualifications as $qualification) : ?>
                                  <option value="<?php echo $qualification->qualification_id; ?>"> <?php echo $qualification->qualification_name; ?></option>
                                <?php endforeach; ?>
                              </select>
                              <div class="invalid-feedback">
                                please select an academic qualification
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <label for="sbu">SBU (Location)</label><span style="color: red"> *</span>
                              <select id="sbu" class="select2 form-control" required name="location" style="width: 100%; height: 42px !important;">
                                <option value="">Select</option>
                                <?php foreach ($locations as $location) : ?>
                                  <option value="<?php echo $location->location_id; ?>"> <?php echo $location->location_name; ?></option>
                                <?php endforeach; ?>
                              </select>
                              <div class="invalid-feedback">
                                please select a location
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-6">
                              <label for="subsidiary">Subsidiary</label><span style="color: red"> *</span>
                              <select id="subsidiary" class="select2 form-control" required name="subsidiary" style="width: 100%; height: 42px !important;">
                                <option value="">Select</option>
                                <?php foreach ($subsidiarys as $subsidiary) : ?>
                                  <option value="<?php echo $subsidiary->subsidiary_id; ?>"> <?php echo $subsidiary->subsidiary_name; ?></option>
                                <?php endforeach; ?>
                              </select>
                              <div class="invalid-feedback">
                                please select a subsidiary
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <label for="check_experience">Work Experience</label><span style="color: red"> *</span>
                              <select class="select2 form-control" id="check_experience" name="check_experience" style="width: 100%; height: 42px !important;" onchange="work_experience()" required>
                                <option value="">Select</option>
                                <option value="0"> Entry Level</option>
                                <option value="1"> Experienced</option>
                              </select>
                              <div class="invalid-feedback">
                                please select a work experience
                              </div>
                            </div>
                          </div>
                          <div id="work_experiences">
                            <div id="work_experience1">
                              <button type="button" onclick="delete_div(this)" class="btn btn-danger" style="margin-bottom: 12px">
                                <i class="fas fa-minus"></i>
                              </button>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="company-name">Company Name</label>
                                  <input id="company-name" type="text" class="form-control" name="company_name[]" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label>Job Description</label>
                                  <textarea id="textarea" class="form-control" name="job_description[]" maxlength="225" rows="3"></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-6">
                                  <label for="start-date">Start Date</label>
                                  <input id="start-date" type="text" name="experience_start_date[]" class="form-control datepicker" placeholder="mm/dd/yyyy">
                                </div>
                                <div class="col-sm-6">
                                  <label for="end-date"> End Date:</label>
                                  <input id="end-date" type="text" name="experience_end_date[]" class="form-control datepicker" placeholder="mm/dd/yyyy">
                                </div>
                              </div>
                            </div>
                            <button id="work_experience_button" type="button" onclick="clone_div()" class="btn btn-primary">
                              <i class="fas fa-plus"></i>
                            </button>
                          </div>
                          <div class="text-center">
                            <span class="text-primary prv" style="cursor: pointer" id="prv">previous</span>
                            <div class="bullet"></div>
                            <span class="text-primary nxt" style="cursor: pointer" id="nxt">next</span>
                            <p class="form-text text-muted">Please click next or previous to ensure all required fields are complete to submit the form</p>
                          </div>
                        </div>
                        <div class="tab-pane p-3" id="bank-information" role="tabpanel">
                          <div class="form-group row">
                            <div class="col-sm-6">
                              <label for="account-number">Account Number</label><span style="color: red"> *</span>
                              <input id="account-number" name="employee_account_number" type="number" class="form-control" oninput="this.value = this.value.slice(0, this.maxLength)" maxlength="10" required />
                              <div class="invalid-feedback">
                                please fill in an account number
                              </div>
                              <p class="form-text text-muted">Please fill in a 10 digit account number</p>
                            </div>
                            <div class="col-sm-6">
                              <label for="bank">Bank</label><span style="color: red"> *</span>
                              <select id="bank" class="select2 form-control" required name="employee_bank" style="width: 100%; height:42px !important;">
                                <option value="">Select</option>
                                <?php foreach ($banks as $bank) : ?>
                                  <option value="<?php echo $bank->bank_id; ?>"> <?php echo $bank->bank_name; ?></option>
                                <?php endforeach; ?>
                              </select>
                              <div class="invalid-feedback">
                                please select a bank
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-6">
                              <label for="hmo-id">HMO ID</label>
                              <input id="hmo-id" name="employee_hmo_number" type="text" class="form-control" />
                            </div>
                            <div class="col-sm-6">
                              <label for="hmo-provider">HMO Provider</label><span style="color: red"> *</span>
                              <select id="hmo-provider" class="select2 form-control" required name="employee_hmo_id" style="width: 100%; height:42px !important;">
                                <option value="0"> N/A </option>
                                <?php foreach ($health_insurances as $health_insurance) : ?>
                                  <option value="<?php echo $health_insurance->health_insurance_id; ?>"> <?php echo $health_insurance->health_insurance_hmo; ?></option>
                                <?php endforeach; ?>
                              </select>
                              <div class="invalid-feedback">
                                please select a hmo provider
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-6">
                              <label for="paye-number">PAYE Number</label>
                              <input id="paye-number" name="employee_paye_number" type="text" class="form-control" />
                            </div>
                            <div class="col-sm-6">
                              <label for="employee_pensionable">Pensionable?</label><span style="color: red"> *</span>
                              <select class="select2 form-control" required name="employee_pensionable" onchange="pensionable()" id="employee_pensionable" style="width: 100%; height:42px !important;">
                                <option value="">Select</option>
                                <option value="0"> No </option>
                                <option value="1"> Yes </option>
                              </select>
                              <div class="invalid-feedback">
                                please select a pensionable option
                              </div>
                            </div>
                          </div>
                          <div id="pension_div">
                            <div class="form-group row">
                              <div class="col-sm-6">
                                <label for="pension-number">Pension Number</label>
                                <input id="pension-number" name="employee_pension_number" type="text" class="form-control" />
                              </div>
                              <div class="col-sm-6">
                                <label for="pension-admin">Pension Administrator</label><span style="color: red"> *</span>
                                <select id="pension-admin" class="select2 form-control mb-3 custom-select" required name="employee_pension_id" style="width: 100%; height:42px !important;">
                                  <option disabled> N/A </option>
                                  <?php foreach ($pensions as $pension) : ?>
                                    <option value="<?php echo $pension->pension_id; ?>"> <?php echo $pension->pension_provider; ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="text-center">
                            <span class="text-primary prv" style="cursor: pointer" id="prv">previous</span>
                            <div class="bullet"></div>
                            <span class="text-primary nxt" style="cursor: pointer" id="nxt">next</span>
                            <p class="form-text text-muted">Please click next or previous to ensure all required fields are complete to submit the form</p>
                          </div>
                        </div>
                        <div class="tab-pane p-3" id="other-information" role="tabpanel">
                          <div class="form-group row">
                            <div class="col-sm-6">
                              <label for="employee-username">Employee Username</label>
                              <input id="employee-username" readonly name="employee_username" type="text" value="<?php echo $unique_id; ?>" class="form-control" />
                              <p class="form-text text-muted">The employee will use these credentials to access their self-service portal</p>
                            </div>
                            <div class="col-sm-6">
                              <label for="employee-password">Employee Password</label>
                              <input id="employee-password" readonly name="employee_password" value="<?php echo "password1234"; ?>" class="form-control" type="text">
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-6">
                              <label for="nysc-pass-out">NYSC Pass Out Number</label>
                              <input id="nysc-pass-out" name="nysc_pass_out" type="text" class="form-control" />
                            </div>
                            <div class="col-sm-6">
                              <label>NYSC Document</label>
                              <div class="custom-file">
                                <input id="employee-nysc" name="employee_nysc" class="custom-file-input" type="file">
                                <label for="employee-nysc" class="custom-file-label">Choose File</label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label for="employee-start-date">Employment Start Date</label><span style="color: red"> *</span>
                              <input id="employee-start-date" type="text" name="employment_start_date" required class="form-control datepicker" placeholder="mm/dd/yyyy">
                              <div class="invalid-feedback">
                                please fill in an employment start date
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <label for="employee-status">Employment Status</label><span style="color: red"> *</span>
                              <select id="employee-status" class="select2 form-control" required name="employment_status" style="width: 100%; height:42px !important;">
                                <option value="">Select</option>
                                <option value="1"> Probationary </option>
                                <option value="2"> Confirmed </option>
                              </select>
                              <div class="invalid-feedback">
                                please select an employment status
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <label>Passport Photograph</label><span style="color: red"> *</span>
                              <div class="custom-file">
                                <input id="employee-passport" name="employee_passport" class="custom-file-input" type="file" required>
                                <label for="employee-passport" class="custom-file-label">Choose File</label>
                              </div>
                              <div class="invalid-feedback">
                                please upload a passport photograph image
                              </div>
                              <p class="form-text text-muted">Upload image as either gif, jpg, png or jpeg </p>

                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-12">
                              <div id="myId" class="dropzone">
                                <div class="dz-message needsclick">
                                  <i class="hi text-muted dripicons-cloud-upload"></i>
                                  <h3>Drop all other relevant documents here...</h3>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="text-center">
                            <span class="text-primary prv" style="cursor: pointer" id="prv">previous</span>
                            <div class="bullet"></div>
                            <span class="nxt" style="cursor: not-allowed" id="nxt">next</span>
                            <p class="form-text text-muted">Please click previous to ensure all required fields are complete to submit the form</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-right bg-whitesmoke">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <input type="reset" class="btn btn-secondary">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>

  <?php include(APPPATH . '/views/footer.php'); ?>
  <?php include(APPPATH . '/views/js.php'); ?>

  <script>
    $('title').html('New Employee - IHUMANE');

    $(document).ready(function() {
      // show file names on file upload for nysc documents...
      $(".custom-file-input").on('change', function() {
        let fileName = $(this).val().split('//').pop();
        $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
      });
      // accept phone number in nigerian format i.e. 0909 600 0024
      let cleavePN = new Cleave('.cleave-number', {
        phone: true,
        phoneRegionCode: 'ng'
      })

      Dropzone.autoDiscover = false;
      let name = new Date().getTime();
      let myDropzone = this;
      $("div#myId").dropzone({
        renameFilename: function(file) {
          return name + '_' + file.name;
          //return newName;
        },
        url: '<?php echo site_url('employee_upload_others'); ?>',
        method: 'post',
        addRemoveLinks: 'true',
        dictRemoveFile: 'Remove',

        success: function(file, response) {
          //file.upload.filename =  name + '_' + file.name;
          $('form').append('<input type="hidden" name="employee_others[]" value="' + response + '">');
          console.log(response);
        },

        error: function(file, response) {
          console.log(response);
        },
        removedfile: function(file) {
          file.previewElement.remove();
          //                    var name = '';
          //                    if (typeof file.file_name !== 'undefined') {
          //                        name = file.file_name
          //                    } else {
          //                        name = uploadedDocumentMap[file.name]
          //                    }
          $('form').find('input[name="employee_others[]"][value="' + name + '_' + file.name + '"]').remove()
        }
      });
    });
    window.onload = function() {
      document.getElementById("work_experiences").style.display = 'none';
      document.getElementById("pension_div").style.display = 'none';
    };

    $('.nxt').on('click', function() {
      moveTab('next');
    });
    $('.prv').on('click', function() {
      moveTab('previous');
    })

    function moveTab(nextOrPrev) {
      var currentTab = "";
      $('.nav-pills li a').each(function() {
        if ($(this).hasClass('active')) {
          currentTab = $(this);
        }
      });
      if (nextOrPrev == 'next') {
        if (currentTab.parent().next().length) {
          currentTab.parent().next().children().trigger('click');
        }
      } else {
        if (currentTab.parent().prev().length) {
          currentTab.parent().prev().children().trigger('click');
        }
      }
    }

    function pensionable() {
      var pensionable = document.getElementById('employee_pensionable').value

      if (pensionable == 0) {
        document.getElementById("pension_div").style.display = 'none';
      }

      if (pensionable == 1) {
        document.getElementById("pension_div").style.display = 'block';
      }

    }

    function work_experience() {
      let work_experience = document.getElementById("work_experiences");
      let work_experience_value = document.getElementById("check_experience").value

      if (work_experience_value == 0) {
        work_experience.style.display = 'none';
      } else {
        work_experience.style.display = 'block';
      }

    }

    function clone_div() {
      let elem = document.getElementById('work_experience1');
      if (elem.style.display == 'none') {
        elem.style.display = 'block';
      } else {
        // Create a copy of it
        let clone = elem.cloneNode(true);
        // Update the ID and add a class
        clone.id = 'work_experience2';
        // document.getElementById('work_experiences').appendChild(clone);
        let work_experiences = document.getElementById('work_experiences');

        let work_experience_button = document.getElementById('work_experience_button');
        //clone.insertBefore(work_experience_button);
        work_experiences.insertBefore(clone, work_experience_button)
        // Inject it into the DOM
        elem.after(clone);
      }
    }

    function delete_div(e) {
      let id = e.parentElement.id;
      if (id == 'work_experience1') {
        let elem = document.getElementById('work_experience1');
        let inputs = elem.getElementsByTagName('input');
        let index;
        for (index = 0; index < inputs.length; ++index) {
          if (inputs[index].type == 'text')
            inputs[index].value = '';
        }
        inputs = elem.getElementsByTagName('input');
        for (index = 0; index < inputs.length; ++index) {
          if (inputs[index].type == 'date')
            inputs[index].value = '';
        }

        inputs = elem.getElementsByTagName('textarea');
        for (index = 0; index < inputs.length; ++index) {
          // if(inputs[index].type == 'textarea')
          inputs[index].value = '';
        }
        // var textarea = elem.getElementsByTagName('textarea');
        // textarea.value = '';
        elem.style.display = 'none';
      } else {
        e.parentElement.remove();
      }
    }
  </script>
</body>

</html>
