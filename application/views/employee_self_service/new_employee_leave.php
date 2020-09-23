

<?php
  include(APPPATH.'/views/stylesheet.php');
  $CI =& get_instance();
  $CI->load->model('hr_configurations');
  $CI->load->model('payroll_configurations');
  $CI->load->model('employees');
?>

<body class="layout-3">
<div id="app">
	<div class="main-wrapper container">
		<div class="navbar-bg"></div>
		<?php include('header.php'); ?>
		<?php include('menu.php'); ?>
		<div class="main-content">
			<section class="section">
				<div class="section-header">
					<h1>New Leave</h1>
					<div class="section-header-breadcrumb">
						<div class="breadcrumb-item active"><a href="<?php echo site_url('employee_main'); ?>">Dashboard</a></div>
						<div class="breadcrumb-item">New Leave</div>
					</div>
				</div>
				<div class="section-body">
					<div class="section-title">All About New Leave Requests</div>
					<p class="section-lead">You can fill in the form to request a leave here</p>
				</div>
				<div class="row">
					<div class="col-12">
						<form class="needs-validation" data-persist="garlic" novalidate method="post" action="<?php echo site_url('request_new_leave'); ?>" id="leave_form">
							<div class="card card-primary">
								<div class="card-header">
									<h4>New Leave Form</h4>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-12 col-xl-4 col-md-4">
											<div class="card card-hero">
												<div class="card-header">
													<div class="card-icon">
														<i class="fas fa-plane-departure"></i>
													</div>
													<h4>Leave Wallet</h4>
													<div class="card-description">.</div>
												</div>
												<div class="card-body p-0">
													<div class="tickets-list">
														<?php
                              $username = $this->session->userdata('user_username');
                              $tenant_id = $this->users->get_user($username)->tenant_id;
															$wallet_array = array();
															$leaves = $CI->hr_configurations->view_leaves($tenant_id);
															$year =  date('Y');
															$year = 2021;
															foreach ($leaves as $leave):
																$wallets = 	$CI->employees->get_my_leave_wallet($employee->employee_id, $leave->leave_id, $year);
																$used_leaves = 0;
																foreach ($wallets as $wallet):
																	$date_diff = strtotime($wallet->leave_end_date) - strtotime($wallet->leave_start_date);
																	$used_leave =  round($date_diff/(60*60*24));
																	$used_leaves = $used_leaves + $used_leave;
																endforeach;
															$remaining_leave = $leave->leave_duration - $used_leaves;
														?>
															<div class="ticket-item">
																<div class="ticket-title">
																	<h4><?php echo $leave->leave_name; ?></h4>
																</div>
																<div class="ticket-info">
																	<div class="text-primary"><?php echo $remaining_leave." days remaining";  ?></div>
																</div>
															</div>
														<?php
															$wallet_array[$leave->leave_id] = $remaining_leave;
															endforeach;
														?>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-12 col-xl-8 col-md-8">
											<div class="form-group row">
												<input type="hidden" name="employee_id" value="<?php echo $employee->employee_id; ?>">
												<input type="hidden" id="leave_bal" value='<?php echo json_encode($wallet_array); ?>'>
												<div class="col-sm-6">
													<label>Leave Type</label><span style="color: red"> *</span>
													<select class="form-control select2" id="leave_id" required name="leave_id" style="width: 100%; height: 42px !important;">
														<option value=""> -- Select -- </option>
														<?php foreach ($leaves as $leave):?>
															<option value="<?php echo $leave->leave_id ?>"> <?php echo $leave->leave_name; ?> </option>
														<?php endforeach; ?>
													</select>
													<div class="invalid-feedback">
														please select a leave type
													</div>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-sm-6">
													<label>Start Date</label><span style="color: red"> *</span>
													<input type="text" id="start_date" class="form-control datepicker"  name="start_date" required/>
													<div class="invalid-feedback">
														please fill in a start date
													</div>
												</div>
												<div class="col-sm-6">
													<label>End Date</label><span style="color: red"> *</span>
													<input type="text" class="form-control datepicker" id="end_date"  name="end_date" required/>
													<div class="invalid-feedback">
														please fill in an end date
													</div>
												</div>
											</div>
											<input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
											<div class="card-footer text-right">
												<button type="button" onclick="compute_leave()"  class="btn btn-primary">Add Leave</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
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
<script>
	$('title').html('New Leave - IHUMANE');
	function calcBusinessDays(dDate1, dDate2) { // input given as Date objects
		var iWeeks, iDateDiff, iAdjust = 0;
		if (dDate2 < dDate1) return -1; // error code if dates transposed
		var iWeekday1 = dDate1.getDay(); // day of week
		var iWeekday2 = dDate2.getDay();
		iWeekday1 = (iWeekday1 == 0) ? 7 : iWeekday1; // change Sunday from 0 to 7
		iWeekday2 = (iWeekday2 == 0) ? 7 : iWeekday2;
		if ((iWeekday1 > 5) && (iWeekday2 > 5)) iAdjust = 1; // adjustment if both days on weekend
		iWeekday1 = (iWeekday1 > 5) ? 5 : iWeekday1; // only count weekdays
		iWeekday2 = (iWeekday2 > 5) ? 5 : iWeekday2;

		// calculate differnece in weeks (1000mS * 60sec * 60min * 24hrs * 7 days = 604800000)
		iWeeks = Math.floor((dDate2.getTime() - dDate1.getTime()) / 604800000)

		if (iWeekday1 < iWeekday2) { //Equal to makes it reduce 5 days
			iDateDiff = (iWeeks * 5) + (iWeekday2 - iWeekday1)
		} else {
			iDateDiff = ((iWeeks + 1) * 5) - (iWeekday1 - iWeekday2)
		}

		iDateDiff -= iAdjust // take into account both days on weekend

		return (iDateDiff + 1); // add 1 because dates are inclusive
	}




	function compute_leave() {
		let start_date = new Date(document.getElementById('start_date').value);
		let end_date = new Date(document.getElementById('end_date').value);
		let leave_id = document.getElementById('leave_id').value;
		if(start_date === '' || leave_id === '' || end_date === '' ){
			swal('Why are you here if you do not want a leave', { icon: 'error' });
		}else{

				let leave_day_policy = calcBusinessDays(start_date, end_date)
			var obj = JSON.parse(document.getElementById('leave_bal').value);

			if(start_date < new Date()){
				swal('Why do you want to start a leave before today?', { icon: 'error' });

			} else if(start_date > end_date){
				swal('Why is your leave ending before it starts?', { icon: 'error' });
			}
			else{
				if(parseInt(leave_day_policy, 10) > parseInt(obj[leave_id], 10)){

					swal('Check your leave Wallet Please', { icon: 'error' });


				}
				else{
					swal({
						title: 'Almost there',
						text: 'Click Ok to Proceed to Submit',
						icon: 'warning',
						buttons: true,
						dangerMode: true,
					}).then((willDelete) => {
						if (willDelete) {
							$("#leave_form").submit();
						} else {
							swal('Action Canceled!', { icon: 'error' });
						}
					});
				}

			}






			//alert(obj[leave_id]);




		}




	}

	$(document).ready(function() {




		setInterval(timestamp, 1000);
		function timestamp() {
			$.ajax({
				url: '<?php echo site_url('timestamp')?>',
				success: function (data) {
					$('#timestamp').html(data);
				}
			})
		}
	});
</script>
