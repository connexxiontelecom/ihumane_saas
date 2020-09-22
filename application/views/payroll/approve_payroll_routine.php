<?php
  $CI =& get_instance();
  $CI->load->model('salaries');
  include(APPPATH.'/views/stylesheet.php');
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
          <h1>Approve Payroll Routine</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Approve Payroll Routine</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">All About Approving Payroll Routines</div>
					<?php if($check_salary > 0): ?>
            <p class="section-lead">Approve payroll routine that was run for <?php echo date("F", mktime(0, 0, 0, $payroll_month, 10))." ".$payroll_year; ?></p>
					<?php else: ?>
            <p class="section-lead">No payroll routine is currently available to be approved</p>
					<?php endif; ?>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Payroll Routine Details</h4>
                  <div class="card-header-action">
	                  <?php if($check_salary > 0): ?>
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary" id="sa-paramss"><i class="fas fa-check"></i> Approve Routine</button>
                        <button type="button" class="btn btn-primary" id="sa-params"><i class="fas fa-undo"></i> Undo Routine</button>
                      </div>
	                  <?php endif ;?>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="datatable-buttons-2" class="table table-bordered table-striped table-md">
                      <thead>
                        <tr>
                          <th class="text-center">S/N</th>
                          <th>Employee Unique ID</th>
                          <th>Employee Name</th>
                          <th>Gross Pay</th>
                          <th>Total Deduction</th>
                          <th>Net Pay </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if($check_salary > 0):
                          $sn = 1;
                          if(!empty($employees)):
                            foreach($employees as $employee):
                              if($employee->employee_status == 3 || $employee->employee_status == 0):
                              else:
                                ?>
                                <tr>
                                  <td class="text-center" style="width: 9px;"><?php echo $sn; ?></td>
                                  <td><?php echo $employee->employee_unique_id; ?></td>
                                  <td><?php echo $employee->employee_first_name." ".$employee->employee_last_name." ".$employee->employee_other_name; ?></td>
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
                          endif;
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
<script>
  $('title').html('Approve Payroll Routine - IHUMANE')
  $(document).ready(function () {
    $('#sa-params').click(function () {
      swal({
        title: 'Are you sure?',
        text: 'Action Cannot be reversed!',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          window.location="<?php echo site_url('undo_payroll_routine'); ?>"
        } else {
          swal('Approval Canceled!', { icon: 'error' });
        }
      });
    });

    $('#sa-paramss').click(function () {
      swal({
        title: 'Are you sure?',
        text: 'Action Cannot be reversed!',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          window.location="<?php echo site_url('run_approve_payroll_routine'); ?>"
        } else {
          swal('Routine Canceled!', { icon: 'error' });
        }
      });
    });
  });
</script>
</body>
</html>
