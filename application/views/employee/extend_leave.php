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
            <a href="<?php echo site_url('employee_leave')?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
          </div>
					<h1>Extend Leave</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?php echo site_url('employee_leaves')?>">Employee Leaves</a></div>
            <div class="breadcrumb-item">Extend Leave</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">Extend Employee Leave</div>
          <p class="section-lead">You can fill in the form to extend an employee leave here</p>
          <div class="row">
            <div class="col-md-7">
              <form class="needs-validation" novalidate data-persist="garlic" method="post" action="<?php echo site_url('extend_employee_leave'); ?>" id="loan_form">
                <div class="card card-primary">
                  <div class="card-header">
                    <h4>Extend Leave Form</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label>Employee</label>
                      <input type="text" class="form-control"  disabled value="<?php echo $leave->employee_first_name." ".$leave->employee_last_name; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Leave Type</label>
                      <input type="text" class="form-control"  disabled value="<?php echo $leave->leave_name; ?>" />
                    </div>
                    <input type="hidden" name="leave_id" value="<?php echo $leave->employee_leave_id; ?>">
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>Start Date</label>
                        <input type="date" class="form-control"   name="start_date"  required disabled  value="<?php echo $leave->leave_start_date; ?>" />
                      </div>
                      <div class="col-sm-6">
                        <label>End Date</label><span style="color: red"> *</span>
                        <input type="date" class="form-control"  name="end_date" required />
                        <div class="invalid-feedback">
                          please fill in an end date
                        </div>
                      </div>
                    </div>
                    <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
                  </div>
                  <div class="card-footer text-right bg-whitesmoke">
                    <button type="submit"  class="btn btn-primary">Extend Leave</button>
                    <button onclick="location.href='<?php echo site_url('employee_leave');?>'" class="btn btn-danger" type="button">Go Back</button>
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
</body>
</html>



