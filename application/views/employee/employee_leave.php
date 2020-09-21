<?php include(APPPATH.'/views/stylesheet.php');
$CI =& get_instance();
$CI->load->model('hr_configurations');
?>

<body>
<div id="app">
	<div class="main-wrapper">
		<div class="navbar-bg"></div>
		<?php include(APPPATH.'/views/topbar.php'); ?>
		<?php include(APPPATH.'/views/sidebar.php'); ?>
		<div class="main-content">
			<section class="section">
				<div class="section-header">
					<h1>Employee Leaves</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Employee Leaves</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">All About Employee Leaves</div>
          <p class="section-lead">You can manage employee leaves here</p>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Employee Leaves</h4>
                  <div class="card-header-action">
                    <button onclick="location.href='<?php echo site_url('new_employee_leave')?>'" type="button" class="btn btn-icon icon-left btn-primary"><i class="fa fa-plus"></i> Initiate Leave</button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-bordered table-striped table-md">
                      <thead>
                      <tr>
                        <th>Employee Name</th>
                        <th>Leave Type</th>
						            <th>Duration</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php if(!empty($leaves)):
                        foreach($leaves as $leave):
                          ?>
                          <tr>
                            <td><?php echo $leave->employee_last_name." ".$leave->employee_first_name; ?></td>
                            <td><?php echo $leave->leave_name; ?></td>
							              <td> <?php

//											  $date_diff = strtotime($leave->leave_end_date) - strtotime($leave->leave_start_date);
//							                echo round($date_diff/(60*60*24))." days";
											  $start = new DateTime($leave->leave_start_date);
											  $end = new DateTime($leave->leave_end_date);
											  // otherwise the  end date is excluded (bug?)
											  $end->modify('+1 day');

											  $interval = $end->diff($start);

											  // total days
											  $days = $interval->days;

											  // create an iterateable period of date (P1D equates to 1 day)
											  $period = new DatePeriod($start, new DateInterval('P1D'), $end);

											  // best stored as array, so you can add more than one
											  $holidays = array('2012-09-07');

											  foreach($period as $dt) {
												  $curr = $dt->format('D');

												  // substract if Saturday or Sunday
												  if ($curr == 'Sat' || $curr == 'Sun') {
													  $days--;
												  }

												  // (optional) for the updated question
												  elseif (in_array($dt->format('Y-m-d'), $holidays)) {
													  $days--;
												  }
											  }


											  echo $days." days"; // 4

							                ?>
                            </td>
                            <td><?php echo date('l, j F Y', strtotime($leave->leave_start_date));?></td>
                            <td><?php echo date('l, j F Y', strtotime($leave->leave_end_date));?></td>
                            <td>
                              <?php if($leave->leave_status == 0): ?>
                                <div class="badge badge-warning">Pending</div>
                              <?php elseif ($leave->leave_status == 1):?>
                                <div class="badge badge-success">Approved</div>
							                <?php elseif ($leave->leave_status == 3):?>
                                <div class="badge badge-danger">Discarded</div>
                              <?php else:?>
                                <div class="badge badge-dark">Finished</div>
                              <?php endif;?>
                            </td>
                            <td class="text-center" style="width: 9px">
                              <?php if($leave->leave_status == 2 || $leave->leave_status == 3):
                                echo "No Actions";
                              endif;
                              if($leave->leave_status == 1):?>
                                <div class="dropdown">
                                  <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item has-icon" href="<?php echo site_url('extend_leave').'/'.$leave->employee_leave_id; ?>"><i class="fas fa-plane-departure"></i>Extend Leave</a>
                                  </div>
                                </div>
                              <?php endif;
								                if($leave->leave_status == 0):?>
                                <div class="dropdown">
                                  <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item has-icon" href="<?php echo site_url('approve_leave').'/'.$leave->employee_leave_id; ?>"><i class="fas fa-check-square"></i>Approve Leave</a>
                                    <a class="dropdown-item has-icon" href="<?php echo site_url('discard_leave').'/'.$leave->employee_leave_id; ?>"><i class="fas fa-trash"></i>Discard Leave</a>
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
<?php include(APPPATH.'/views/footer.php'); ?>
<?php include(APPPATH.'/views/js.php'); ?>
</body>
</html>
<script>
  $('title').html('Employee Leaves - IHUMANE')
</script>
