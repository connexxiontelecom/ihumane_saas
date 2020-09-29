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
            <a href="<?php echo site_url('user')?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
          </div>
					<h1>New User</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?php echo site_url('user')?>">Manage Users</a></div>
            <div class="breadcrumb-item">New User</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">All About Creating Users</div>
          <p class="section-lead">You can complete the form to create a user here</p>
          <div class="row">
            <div class="col-12">
              <form class="needs-validation" novalidate method="post" action="<?php echo site_url('add_user'); ?>">
                <div class="card card-primary">
                  <div class="card-header">
                    <h4>New User Form</h4>
                  </div>
                  <div class="card-body">
			              <?php if($error != ' '): ?>
                      <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <i class="mdi mdi-close-circle font-32"></i><strong class="pr-1">Error !</strong> <?php echo $error; ?>.
                      </div>
			              <?php endif; ?>
                    <div class="form-group">
                      <label>User</label><span style="color: red"> *</span>
                      <input type="text" class="form-control"  name="name" required/>
                      <div class="invalid-feedback">
                        please fill in the user's names
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>Email</label><span style="color: red"> *</span>
                        <input type="email" class="form-control"  name="email" id="email" required/>

						  <div id="email_alert">
							  <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert" >
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
								  </button>
								  <i class="mdi mdi-close-circle font-32"></i><strong class="pr-1">Error !</strong> Email Already Taken. Enter Another
							  </div>
						  </div>
                        <div class="invalid-feedback">
                          please fill in a valid email
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <label>Username</label><span style="color: red"> *</span>
                        <input type="text" class="form-control"  name="username" id="username" required/>
						  <div id="username_alert">
							  <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert" >
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
								  </button>
								  <i class="mdi mdi-close-circle font-32"></i><strong class="pr-1">Error !</strong> Username Already Taken. Enter Another
							  </div>
						  </div>
                        <div class="invalid-feedback">
                          please fill in a username
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
                        <label>Password</label><span style="color: red"> *</span>
                        <div class="input-group">
                          <input class="form-control" name="password" type="password" required id="password-field" autocomplete="current-password">
                          <div class="input-group-append">
                            <a class="btn btn-light" onClick="viewPassword()"><i style="padding-top: 70%" id="pass-status" class="fas fa-eye"></i></a>
                          </div>
                        </div>
                        <div class="invalid-feedback">
                          please fill in a password
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <label>Status</label><span style="color: red"> *</span>
                        <select name="status" class="select2 form-control" required style="width: 100%; height:42px !important;">
                          <option value="">-- Select --</option>
                          <option value="1"> Active </option>
                          <option value="0"> Inactive </option>
                        </select>
                        <div class="invalid-feedback">
                          please select a status
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>User Permissions</label>
                      <div class="selectgroup selectgroup-pills">
                        <label class="selectgroup-item">
                          <input type="checkbox" class="selectgroup-input" value="1" name="employee_management">
                          <span class="selectgroup-button">Employee Management</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="checkbox" class="selectgroup-input" value="1" name="payroll_management">
                          <span class="selectgroup-button">Payroll Management</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="checkbox" class="selectgroup-input" value="1" name="biometrics">
                          <span class="selectgroup-button">Biometrics</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="checkbox" class="selectgroup-input" value="1" name="user_management">
                          <span class="selectgroup-button">User Management</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="checkbox" class="selectgroup-input" value="1" name="configuration">
                          <span class="selectgroup-button">App Configuration</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="checkbox" class="selectgroup-input" value="1" name="payroll_configuration">
                          <span class="selectgroup-button">Payroll Configuration</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="checkbox" class="selectgroup-input" value="1" name="hr_configuration">
                          <span class="selectgroup-button">HR Configuration</span>
                        </label>
                      </div>
                    </div>
                    <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
                    <input type="hidden" name="user_id" value="" />
                  </div>
                  <div class="card-footer text-right bg-whitesmoke">
                    <button id="new_button" type="submit" class="btn btn-primary">Create User</button>
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
<?php include(APPPATH.'/views/footer.php'); ?>
<?php include(APPPATH.'/views/js.php'); ?>
<script>
  function viewPassword() {
    let passwordInput = document.getElementById('password-field');
    let passStatus = document.getElementById('pass-status');
    if (passwordInput.type === 'password') {
      passwordInput.type='text';
      passStatus.className='fas fa-eye-slash';
    } else {
      passwordInput.type='password';
      passStatus.className='fas fa-eye';
    }
  }



	document.getElementById('email_alert').style.display = 'none';
	document.getElementById('username_alert').style.display = 'none';
  	document.getElementById('new_button').style.display = 'none';
	function check_password() {
		var password = document.getElementById('password').value;
		var password_confirm = document.getElementById('password_confirm').value;

		if(password === password_confirm){
			document.getElementById('password_alert').style.display = 'none';
			document.getElementById('password_success').style.display = 'block';

		}else{
			document.getElementById('password_alert').style.display = 'block';
			document.getElementById('password_success').style.display = 'none';

		}
	}

	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		else{
			var year = document.getElementById('payroll_start_year').value;
			var length = year.length;
			if(length < 4){
				return  true
			}
			return false;
		}
	}



	$("#username").keyup(function () {
		var username = $(this).val();
		$.ajax({
			type: 'POST',
			url: '<?php echo site_url('check_user_username'); ?>',
			data: {username: username},
			cache: false,
			success : function(data){
				data = JSON.parse(data);
				console.log(data);
				if(data === 0){
					document.getElementById("username_alert").style.display = 'none';
					document.getElementById('new_button').style.display = 'block';
				} else{
					document.getElementById("username_alert").style.display = 'block';
					document.getElementById('new_button').style.display = 'none';
				}


			}
		});
	});

	$("#email").keyup(function () {
		var email = $(this).val();
		$.ajax({
			type: 'POST',
			url: '<?php echo site_url('check_user_email'); ?>',
			data: {email: email},
			cache: false,
			success : function(data){
				data = JSON.parse(data);

				console.log(data);
				if(data === 0){
					document.getElementById("email_alert").style.display = 'none';
					document.getElementById('new_button').style.display = 'block';
				} else{
					document.getElementById("email_alert").style.display = 'block';
					document.getElementById('new_button').style.display = 'none';
				}


			}
		});
	});
</script>

</body>
</html>


