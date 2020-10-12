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
            <a href="<?php echo site_url('employee_appraisal')?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
          </div>
					<h1>Reassign Appraisal</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?php echo site_url('employee_appraisal')?>">Employee Appraisals</a></div>
            <div class="breadcrumb-item">Reassign Appraisal</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">Appraisal Reassignment</div>
          <p class="section-lead">You can fill in the form to Reassign an Appraisal to a New Supervisor</p>
        </div>
        <div class="row">
          <div class="col-12">
            <form class="needs-validation" data-persist="garlic" novalidate method="post" action="<?php echo site_url('update_employee_appraisal'); ?>" >
              <div class="card card-primary">
                <div class="card-header">
                  <h4>Reassignment Form</h4>
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label>Employee</label><span style="color: red"> *</span>
						<input type="text" class="form-control"  readonly value=" <?php echo $appraisal_detail->employee_unique_id." (".$appraisal_detail->employee_last_name." ".$appraisal_detail->employee_first_name.")"; ?>" />
						<input type="hidden" id="employee" name="employee_id" value="<?php echo $appraisal_detail->employee_appraisal_employee_id; ?>">
						<input type="hidden" name="appraisal_id" value="<?php echo $appraisal_detail->employee_appraisal_id ?>" />
                    </div>
                    <div class="col-sm-6">
                      <label>Supervisor</label><span style="color: red"> *</span>
                      <select class="select2 form-control" required name="supervisor_id" id="supervisor" onchange="compare_employee_supervisor()" style="width: 100%; height:42px !important;">
                        <option value=""> -- Select -- </option>
                        <?php foreach ($employees as $employee):?>
                          <option value="<?php echo $employee->employee_id ?>" <?php if($appraisal_detail->employee_appraisal_supervisor_id == $employee->employee_id) : echo "selected"; endif; ?>> <?php echo $employee->employee_unique_id." (".$employee->employee_last_name." ".$employee->employee_first_name.")"; ?> </option>
                        <?php endforeach; ?>
                      </select>
                      <div class="invalid-feedback">
                        please select a supervisor
                      </div>
                    </div>
                  </div>

                  <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
                </div>
                <div class="card-footer text-right bg-whitesmoke">
                  <button type="submit" id="appraisal_button" disabled  class="btn btn-primary">Update Appraisal</button>
                  <button onclick="location.href='<?php echo site_url('employee_appraisal');?>'" class="btn btn-danger" type="button">Go Back</button>
                </div>
              </div>
            </form>
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

<script>
  $('title').html('New Appraisal - IHUMANE')
  function compare_employee_supervisor() {
	let employee_id = document.getElementById('employee').value;
	let supervisor_id = document.getElementById('supervisor').value;
	if(employee_id === supervisor_id){
		swal('Sorry!', 'Employee and Supervisor Cannot be the same!', 'error');
		document.getElementById('appraisal_button').disabled = true;
	} else{
		document.getElementById('appraisal_button').disabled = !employee_id || !supervisor_id;
	}
}
</script>



