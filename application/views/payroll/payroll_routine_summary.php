<?php
  include(APPPATH.'/views/stylesheet.php');
  $CI =& get_instance();
  $CI->load->model('salaries');
?>

<body class="fixed-left">
<div id="app">
	<div class="main-wrapper">
		<div class="navbar-bg"></div>
		<?php include(APPPATH.'/views/topbar.php'); ?>
		<?php include(APPPATH.'/views/sidebar.php'); ?>
		<div class="main-content">
			<section class="section">
				<div class="section-header">
					<h1> Payroll Routine Summary  </h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?php echo site_url('approve_payroll_routine'); ?>">Approve Payroll Routine</a></div>
            <div class="breadcrumb-item">Payroll Routine Summary</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">All About Summary Of Payroll Routine For <?php echo $payroll_year." ".date("F", mktime(0, 0, 0, $payroll_month, 10)); ?></div>
          <p class="section-lead">View summary of the payroll routines here</p>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Payroll Routine Details</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="datatable-buttons-2" class="table table-bordered table-striped table-md">
                      <thead>
                      <tr>
                        <th>S/N</th>
                        <th>Employee Id</th>
                        <th>Employee Name</th>
                        <th>Gross Pay</th>
                        <th>Total Deduction</th>
                        <th>Net Pay </th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                      $sn = 1;
                      if(!empty($employees)):
                        foreach($employees as $employee):
                          if($employee->employee_status == 3 || $employee->employee_status == 0):
                          else:
                            ?>
                            <tr>
                              <td><?php echo $sn; ?></td>
                              <td><?php echo $employee->employee_unique_id; ?></td>
                              <td> <?php echo $employee->employee_first_name." ".$employee->employee_last_name." ".$employee->employee_other_name; ?></td>
                              <td>
                                &#8358;
                                <?php
                                $gross_pay = 0;
                                $salaries = $CI->salaries->get_employee_income($employee->employee_id, $payroll_month, $payroll_year, 1, $tenant_id);
                                foreach ($salaries as $salary):
                                  $_gross_pay = $salary->salary_amount;
                                  $gross_pay = $gross_pay + $_gross_pay;
                                endforeach;
                                echo number_format($gross_pay);
                                ?>
                              </td>
                              <td>
                                &#8358;
                                <?php
                                $total_deduction = 0;
                                $salaries = $CI->salaries->get_employee_income($employee->employee_id, $payroll_month, $payroll_year, 0, $tenant_id);
                                foreach ($salaries as $salary):
                                  $_total_deduction = $salary->salary_amount;

                                  $total_deduction = $total_deduction + $_total_deduction;
                                endforeach;
                                echo number_format($total_deduction);
                                ?>
                              </td>
                              <td>&#8358; <?php echo number_format($gross_pay - $total_deduction); ?></td>
                            </tr>
                            <?php
                            $sn++;
                          endif;
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

<script>
  $('title').html('Payroll Routine Summary - IHUMANE')

  $( window ).on( "load", function() {
		swal({
			title: ' ',
			text: "Payroll Routine Successful",
			type: "success",
			confirmButtonClass: 'btn btn-confirm mt-2',
			cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
		}). then(function ()  {
			window.location="#";

		})
	});

	$('#sa-params').click(function () {
		swal({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, Undo PayRoll Routine!',
			cancelButtonText: 'No, Cancel!',
			confirmButtonClass: 'btn btn-success',
			cancelButtonClass: 'btn btn-danger m-l-10',
			buttonsStyling: false
		}).then(function () {

			window.location="<?php echo site_url('undo_payroll_routine'); ?>";
			// swal(
			// 		'Deleted!',
			// 		'Your file has been deleted.',
			// 		'success'
			// )
		}, function (dismiss) {
			// dismiss can be 'cancel', 'overlay',
			// 'close', and 'timer'
			if (dismiss === 'cancel') {
				swal(
						'Cancelled',
						'Undo Canceled!!',
						'error'
				)
			}
		})
	});

	$('#sa-paramss').click(function () {
		swal({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, Approve PayRoll Routine!',
			cancelButtonText: 'No, Cancel!',
			confirmButtonClass: 'btn btn-success',
			cancelButtonClass: 'btn btn-danger m-l-10',
			buttonsStyling: false
		}).then(function () {

			window.location="<?php echo site_url('run_approve_payroll_routine'); ?>";
			// swal(
			// 		'Deleted!',
			// 		'Your file has been deleted.',
			// 		'success'
			// )
		}, function (dismiss) {
			// dismiss can be 'cancel', 'overlay',
			// 'close', and 'timer'
			if (dismiss === 'cancel') {
				swal(
						'Cancelled',
						'Undo Canceled!!',
						'error'
				)
			}
		})
	});

</script>
<?php include(APPPATH.'/views/footer.php'); ?>
<?php include(APPPATH.'/views/js.php'); ?>
</body>
</html>
