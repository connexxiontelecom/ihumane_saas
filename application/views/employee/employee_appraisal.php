<?php include(APPPATH.'\views\stylesheet.php');
$CI =& get_instance();
$CI->load->model('hr_configurations');
?>

<body>
<div id="app">
	<div class="main-wrapper">
		<div class="navbar-bg"></div>
		<?php include(APPPATH.'\views\topbar.php'); ?>
		<?php include(APPPATH.'\views\sidebar.php'); ?>
		<div class="main-content">
			<section class="section">
				<div class="section-header">
					<h1>Employee Appraisal</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Employee </div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">All About Employee appraisals</div>
          <p class="section-lead">You can manage employee appraisals here</p>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Employee appraisals</h4>
                  <div class="card-header-action">
                    <button onclick="location.href='<?php echo site_url('new_employee_appraisal')?>'" type="button" class="btn btn-icon icon-left btn-primary"><i class="fa fa-plus"></i> Initiate appraisal</button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-bordered table-striped table-md">
                      <thead>
                      <tr>
                        <th>Employee Name</th>
                        <th>Appraisal Period</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php if(!empty($appraisals)):
                        foreach($appraisals as $appraisal):
                          ?>
                          <tr>
                            <td><?php echo $appraisal->employee_last_name." ".$appraisal->employee_first_name; ?></td>
                            <td><?php //echo $appraisal->appraisal_name; ?></td>

                            <td>
                              <?php if($appraisal->employee_appraisal_status == 0): ?>
                                <div class="badge badge-warning">Running</div>
                                     <?php else:?>
                                <div class="badge badge-dark">Finished</div>
                              <?php endif;?>
                            </td>
                            <td class="text-center" style="width: 9px">
                              <?php if($appraisal->employee_appraisal_status == 0):
                                echo "No Actions";
                              else:?>
                                <div class="dropdown">
                                  <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item has-icon" href="<?php echo site_url('appraisal_result').'/'.$appraisal->employee_appraisal_id; ?>"><i class="fas fa-file-prescription"></i>Check Appraisal Result</a>
                                  </div>
                                </div>
                              <?php endif; ?>
                            </td>
                          </tr>
                        <?php
                        endforeach;
                      endif; ?>
                      </tbody>
                    </table>
                  </div>
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
<?php include(APPPATH.'\views\footer.php'); ?>
<?php include(APPPATH.'\views\js.php'); ?>
</body>
</html>
