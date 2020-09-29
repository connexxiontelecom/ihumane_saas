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
					<h1>Manage User</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?php echo site_url('user')?>">Manage Users</a></div>
            <div class="breadcrumb-item">Manage User</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">All About Managing A User</div>
          <p class="section-lead">You can update a user's information here</p>
          <div class="row">
            <div class="col-12">
              <form class="needs-validation" novalidate method="post" action="<?php echo site_url('edit_user'); ?>">
                <div class="card card-primary">
                  <div class="card-header">
                    <h4>Update User Form</h4>
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
                      <input type="text" class="form-control"  name="name" required value="<?php echo $user_datum->user_name; ?>"/>
                      <div class="invalid-feedback">
                        please fill in the user's names
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>Email</label><span style="color: red"> *</span>
                        <input type="email" class="form-control"  name="email" required value="<?php echo $user_datum->user_email; ?>"/>
                        <div class="invalid-feedback">
                          please fill in a valid email
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <label>Username</label>
                        <input type="text" class="form-control" readonly  name="username" value="<?php echo $user_datum->user_username; ?>"/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-4">
                        <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
                        <input type="hidden" name="user_user_id" value="<?php echo $user_datum->user_id;?>" />
                        <label>Password</label><span style="color: red"> *</span>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <a onClick="enablePassword()" class="btn btn-icon btn-light"><i style="padding-top: 70%" id="pass-active" class="fa fa-toggle-on"></i></a>
                          </div>
                          <input class="form-control" name="password" type="password" disabled="disabled"  id="password-field" autocomplete="current-password">
                          <div class="input-group-append">
                            <a class="btn btn-light" onClick="viewPassword()"><i style="padding-top: 70%" id="pass-status" class="fas fa-eye"></i></a>
                          </div>
                          <div class="invalid-feedback">
                            please fill in a password
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <label>Status</label>
                        <select name="status" class="form-control select2" required style="width: 100%; height:42px !important;">
                          <option value="1" <?php if($user_datum->user_status == 1){ echo "selected"; } ?>> Active </option>
                          <option value="0" <?php if($user_datum->user_status == 0){ echo "selected"; } ?>> Inactive </option>
                        </select>
                      </div>
                      <div class="col-sm-4">
						          <?php  if ($check == 1 || $usertype < 4):?>
                        <label>User Type</label>
                        <select name="user_type" required class="form-control select2" style="width: 100%; height:42px !important;">
                          <option value="1" <?php if($user_datum->user_type == 1){ echo "selected"; } ?>> Administrator </option>
                          <option value="2" <?php if($user_datum->user_type == 2){ echo "selected"; } ?>> Employee </option>
                          <option value="3" <?php if($user_datum->user_type == 3){ echo "selected"; } ?>>Moderator </option>
                        </select>
                      <?php endif; ?>
                      <?php  if ($check == 0 && $usertype == 1):?>
                        <label>User Type</label>
                        <select name="user_type" required class="form-control select2" style="width: 100%; height:42px !important;">
                          <option value="1" <?php if($user_datum->user_type == 1){ echo "selected"; } ?>> Administrator </option>
                        </select>
                      <?php endif; ?>

						  <?php  if ($usertype == 4):?>
							  <label>User Type</label>
							  <select name="user_type" required class="form-control select2" style="width: 100%; height:42px !important;">
								  <option value="1" <?php if($user_datum->user_type == 4){ echo "selected"; } ?>> Super Admin </option>
							  </select>
						  <?php endif; ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>User Permissions</label>
                      <div class="selectgroup selectgroup-pills">
                        <label class="selectgroup-item">
                          <input type="checkbox" class="selectgroup-input" value="1" name="employee_management" <?php if($user_datum->employee_management == 1) { echo "checked" ;} ?>>
                          <span class="selectgroup-button">Employee Management</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="checkbox" class="selectgroup-input" value="1" name="payroll_management" <?php if($user_datum->payroll_management == 1) { echo "checked" ;} ?>>
                          <span class="selectgroup-button">Payroll Management</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="checkbox" class="selectgroup-input" value="1" name="biometrics" <?php if($user_datum->biometrics == 1) { echo "checked" ;} ?>>
                          <span class="selectgroup-button">Biometrics</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="checkbox" class="selectgroup-input" value="1" name="user_management" <?php if($user_datum->user_management == 1) { echo "checked" ;} ?>>
                          <span class="selectgroup-button">User Management</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="checkbox" class="selectgroup-input" value="1" name="configuration" <?php if($user_datum->configuration == 1) { echo "checked" ;} ?>>
                          <span class="selectgroup-button">App Configuration</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="checkbox" class="selectgroup-input" value="1" name="payroll_configuration" <?php if($user_datum->payroll_configuration == 1) { echo "checked" ;} ?>>
                          <span class="selectgroup-button">Payroll Configuration</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="checkbox" class="selectgroup-input" value="1" name="hr_configuration" <?php if($user_datum->hr_configuration == 1) { echo "checked" ;} ?>>
                          <span class="selectgroup-button">HR Configuration</span>
                        </label>
                      </div>
                    </div>
                    <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
                    <input type="hidden" name="user_id" value="" />
                  </div>
                  <div class="card-footer text-right bg-whitesmoke">
                    <button type="submit" class="btn btn-primary">Update User</button>
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
  $('title').html('Manage User - IHUMANE')

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

  function enablePassword() {
    let passwordInput = document.getElementById('password-field');
    let passwordActive = document.getElementById('pass-active');
    if(passwordInput.disabled == false){
      passwordInput.value = null;
      passwordInput.disabled = true;
      passwordActive.className = 'fa fa-toggle-on';
    } else{
      passwordInput.disabled = false;
      passwordActive.className = 'fa fa-toggle-off';
    }
  }
</script>
</body>
</html>
