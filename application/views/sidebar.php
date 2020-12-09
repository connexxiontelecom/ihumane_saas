<div class="main-sidebar">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand" style="padding-top: 12px">
			<a href="<?php echo site_url() ?>"><img src="<?php echo base_url() ?>/assets/img/ihumane-logo-1.png" alt="logo" width="100" class="mb-5 mt-2"></a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm" style="padding-top: 12px">
			<a href="<?php echo site_url() ?>"><img src="<?php echo base_url() ?>/assets/img/ihumane-logo-2.png" alt="logo" width="25" class="mb-5 mt-2"></a>
		</div>
		<ul class="sidebar-menu">

	<?php if($active_plan == 1): ?>
			<li class="menu-header">Dashboard</li>
			<li class="dropdown <?php echo $this->uri->segment(1) == '' || $this->uri->segment(1) == 'home' ? 'active' : ''; ?>">
				<a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Home</span></a>
				<ul class="dropdown-menu">
					<li class="<?php echo $this->uri->segment(1) == '' || $this->uri->segment(1) == 'home' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>">Dashboard</a></li>
				</ul>
			</li>
			<?php if($employee_management == 1){  ?>
        <li class="menu-header">Human Resource</li>
			<li class="dropdown <?php echo
      $this->uri->segment(1) == 'new_employee' ||
      $this->uri->segment(1) == 'employee' ||
      $this->uri->segment(1) == 'view_employee' ||
      $this->uri->segment(1) == 'update_employee' ||
      $this->uri->segment(1) == 'new_employee_leave' ||
      $this->uri->segment(1) == 'employee_leave' ||
      $this->uri->segment(1) == 'extend_leave' ||
      $this->uri->segment(1) == 'new_employee_transfer' ||
      $this->uri->segment(1) == 'query_employee' ||
      $this->uri->segment(1) == 'view_query' ||
      $this->uri->segment(1) == 'terminate_employee' ||
      $this->uri->segment(1) == 'employee_transfer' ? 'active' : '';
			?>">
				<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Employees</span></a>
				<ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(1) == 'new_employee' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo site_url('new_employee') ?>"> New Employee</a></li>
          <li class="<?php echo $this->uri->segment(1) == 'employee' || $this->uri->segment(1) == 'view_employee' || $this->uri->segment(1) == 'update_employee' || $this->uri->segment(1) == 'query_employee' || $this->uri->segment(1) == 'view_query' || $this->uri->segment(1) == 'terminate_employee' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo site_url('employee') ?>"> Manage Employees</a></li>
          <li class="<?php echo $this->uri->segment(1) == 'employee_transfer' || $this->uri->segment(1) == 'new_employee_transfer' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo site_url('employee_transfer') ?>"> Employee Transfers</a></li>
          <li class="<?php echo $this->uri->segment(1) == 'employee_leave' || $this->uri->segment(1) == 'new_employee_leave' || $this->uri->segment(1) == 'extend_leave' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo site_url('employee_leave') ?>"> Employee Leaves</a></li>
				</ul>
			</li>
      <?php } ?>

			<li class="dropdown <?php echo
			$this->uri->segment(1) == 'resignations' ||
			$this->uri->segment(1) == 'employee_appraisal' ||
			$this->uri->segment(1) == 'check_appraisal_result' ||
			$this->uri->segment(1) == 'new_employee_appraisal' ||
			$this->uri->segment(1) == 'employee_trainings' ||
			$this->uri->segment(1) == 'new_employee_training' ||
			$this->uri->segment(1) == 'view_training_result' ||
			$this->uri->segment(1) == 'employee_queries' ||
			$this->uri->segment(1) == 'terminations' ? 'active' : '';
			?>">
				<?php if($employee_management == 1){  ?>
					<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-chart-line"></i><span>Performance</span></a>
					<ul class="dropdown-menu">
						<li class="<?php echo $this->uri->segment(1) == 'employee_appraisal' || $this->uri->segment(1) == 'check_appraisal_result' || $this->uri->segment(1) == 'new_employee_appraisal' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo site_url('employee_appraisal') ?>">Employee Appraisal</a></li>
						<li class="<?php echo $this->uri->segment(1) == 'terminations'  ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo site_url('terminations') ?>"> Employee Terminations</a></li>
						<li class="<?php echo $this->uri->segment(1) == 'resignations'  ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo site_url('resignations') ?>"> Employee Resignations</a></li>
						<li class="<?php echo $this->uri->segment(1) == 'employee_trainings' || $this->uri->segment(1) == 'new_employee_training' || $this->uri->segment(1) == 'view_training_result' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo site_url('employee_trainings') ?>"> Employee Trainings</a></li>
						<li class="<?php echo $this->uri->segment(1) == 'employee_queries' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo site_url('employee_queries') ?>"> Employee Queries</a></li>
					</ul>
				<?php } ?>
			</li>
			<?php if($employee_management == 1){  ?>
			<li class="dropdown <?php echo $this->uri->segment(1) == 'memo' || $this->uri->segment(1) == 'specific_memo' || $this->uri->segment(1) == 'new_specific_memo'  ? 'active' : ''; ?>">
				<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-bell"></i> <span> Memos </span></a>
				<ul class="dropdown-menu">
					<li class="<?php echo $this->uri->segment(1) == 'memo'  ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo site_url('memo') ?>"> <span>Announcements</span></a></li>
					<li class="<?php echo $this->uri->segment(1) == 'specific_memo' || $this->uri->segment(1) == 'new_specific_memo' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo site_url('specific_memo') ?>"> <span>Directives</span></a></li>
				</ul>
			</li>
			<?php } ?>

			<li class="menu-header">Payroll System</li>
			<li class="dropdown <?php echo
      $this->uri->segment(1) == 'employee_salary_structure' ||
      $this->uri->segment(1) == 'view_employee_salary_structure' ||
      $this->uri->segment(1) == 'edit_employee_salary_structure' ||
      $this->uri->segment(1) == 'variational_payment' ||
      $this->uri->segment(1) == 'new_variational_payment' ||
      $this->uri->segment(1) == 'recall_month' ||
      $this->uri->segment(1) == 'approve_variational_payment' ||
      $this->uri->segment(1) == 'payroll_routine' ||
      $this->uri->segment(1) == 'approve_payroll_routine' ||
      $this->uri->segment(1) == 'payroll_report' ||
      $this->uri->segment(1) == 'emolument' ||
      $this->uri->segment(1) == 'emolument_report' ||
      $this->uri->segment(1) == 'deduction' ||
      $this->uri->segment(1) == 'deduction_report' ||
      $this->uri->segment(1) == 'pay_order' ||
      $this->uri->segment(1) == 'pay_order_report' ? 'active' : '';
			?>">
      <?php if($payroll_management == 1){  ?>
      <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-money-bill-wave"></i><span>Payroll Process</span></a>
      <ul class="dropdown-menu">
        <li class="<?php echo $this->uri->segment(1) == 'employee_salary_structure' || $this->uri->segment(1) == 'view_employee_salary_structure' || $this->uri->segment(1) == 'edit_employee_salary_structure'  ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('employee_salary_structure') ?>">Salary Structures </a></li>
        <li class="<?php echo $this->uri->segment(1) == 'variational_payment' || $this->uri->segment(1) == 'new_variational_payment' || $this->uri->segment(1) == 'recall_month' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('variational_payment') ?>">Variational Payments</a></li>
        <li class="<?php echo $this->uri->segment(1) == 'approve_variational_payment' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('approve_variational_payment') ?>">Approve Payments</a></li>
        <li class="<?php echo $this->uri->segment(1) == 'payroll_routine' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('payroll_routine') ?>"> Payroll Routine</a></li>
        <li class="<?php echo $this->uri->segment(1) == 'approve_payroll_routine' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('approve_payroll_routine') ?>"> Approve Routine </a></li>
        <li class="<?php echo $this->uri->segment(1) == 'payroll_report' || $this->uri->segment(1) == 'emolument' || $this->uri->segment(1) == 'emolument_report' || $this->uri->segment(1) == 'deduction' || $this->uri->segment(1) == 'deduction_report' || $this->uri->segment(1) == 'pay_order' || $this->uri->segment(1) == 'pay_order_report' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('payroll_report') ?>"> Payroll Reports </a></li>
      </ul>
      <?php  } ?>
			</li>
			<li class="dropdown <?php echo $this->uri->segment(1) == 'new_loan' || $this->uri->segment(1) == 'loans' || $this->uri->segment(1) == 'edit_loan' ? 'active' : ''; ?>">
			<?php if($payroll_management == 1){  ?>
				<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-university"></i> <span>Loans</span></a>
				<ul class="dropdown-menu">
					<li class="<?php echo $this->uri->segment(1) == 'new_loan' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('new_loan') ?>"> New Loan </a></li>
					<li class="<?php echo $this->uri->segment(1) == 'loans' || $this->uri->segment(1) == 'edit_loan' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('loans') ?>"> Manage Loans </a></li>
				</ul>
			<?php } ?>
			</li>

<!--      <li class="menu-header">Biometrics</li>-->
<!--      <li class="dropdown --><?php //echo $this->uri->segment(1) == 'enroll_employee' ? 'active' : ''; ?><!--">-->
<!--			--><?php //if($biometrics == 1){  ?>
<!--				<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-fingerprint"></i> <span>Biometrics</span></a>-->
<!--				<ul class="dropdown-menu">-->
<!--					<li class="--><?php //echo $this->uri->segment(1) == 'enroll_employee' ? 'active' : '' ?><!--"><a class="nav-link" href="--><?php //echo site_url('enroll_employee') ?><!--"> Biometric Enrollment </a></li>-->
<!--				</ul>-->
<!--				--><?php //} ?>
<!--			</li>-->
<!--      <li class="dropdown --><?php //echo $this->uri->segment(1) == 'clockin' || $this->uri->segment(1) == 'biometrics_report' || $this->uri->segment(1) == 'today_present' || $this->uri->segment(1) == 'today_absent' || $this->uri->segment(1) == 'present_employee' || $this->uri->segment(1) == 'present_employeee' || $this->uri->segment(1) == 'absent_employee' || $this->uri->segment(1) == 'absent_employeee' ? 'active' : ''; ?><!--">-->
<!--        <a href="#" class="nav-link has-dropdown"><i class="fas fa-clock"></i> <span>Attendance</span></a>-->
<!--        <ul class="dropdown-menu">-->
<!--          <li class="--><?php //echo $this->uri->segment(1) == 'clockin' ? 'active' : '' ?><!--"><a class="nav-link" href="--><?php //echo site_url('clockin') ?><!--"> Clock In </a></li>-->
<!--          <li class="--><?php //echo $this->uri->segment(1) == 'biometrics_report' || $this->uri->segment(1) == 'today_present' || $this->uri->segment(1) == 'today_absent' || $this->uri->segment(1) == 'present_employee' || $this->uri->segment(1) == 'present_employeee' || $this->uri->segment(1) == 'absent_employee' || $this->uri->segment(1) == 'absent_employeee' ? 'active' : '' ?><!--"><a class="nav-link" href="--><?php //echo site_url('biometrics_report') ?><!--"> Attendance Reports </a></li>-->
<!--        </ul>-->
<!--      </li>-->

			<li class="menu-header">Admin Settings</li>
			<li class="dropdown <?php echo $this->uri->segment(1) == 'user' || $this->uri->segment(1) == 'new_user' || $this->uri->segment(1) == 'manage_user' ? 'active' : ''; ?>">
				<?php if($user_management == 1){  ?>
				<a href="#" class="nav-link has-dropdown"><i class="fas fa-user-plus"></i> <span>Users</span></a>
				<ul class="dropdown-menu">
					<li class="<?php echo $this->uri->segment(1) == 'user' || $this->uri->segment(1) == 'new_user' || $this->uri->segment(1) == 'manage_user' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('user') ?>">Manage Users</a></li>
				</ul>
				<?php } ?>
			</li>

      <li class="dropdown">
		  <?php if($configuration == 1){  ?>
				<a href="#" class="nav-link has-dropdown"><i class="fas fa-laptop"></i> <span>App Config</span></a>
				<ul class="dropdown-menu">
					<li class="<?php echo $this->uri->segment(1) == 'app_configuration' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('app_configuration') ?>">Basic Configuration</a></li>

				</ul>

		  <?php } ?>
			</li>

			<li class="dropdown <?php echo
      $this->uri->segment(1) == 'bank' ||
      $this->uri->segment(1) == 'pension' ||
      $this->uri->segment(1) == 'health_insurance' ||
      $this->uri->segment(1) == 'department' ||
      $this->uri->segment(1) == 'grade' ||
      $this->uri->segment(1) == 'job_role' ||
      $this->uri->segment(1) == 'location' ||
      $this->uri->segment(1) == 'subsidiary' ||
      $this->uri->segment(1) == 'leave' ||
      $this->uri->segment(1) == 'appraisal_setup' ||
      $this->uri->segment(1) == 'self_assessment' ||
      $this->uri->segment(1) == 'quantitative_assessment' ||
      $this->uri->segment(1) == 'view_quantitative_assessment' ||
      $this->uri->segment(1) == 'qualitative_assessment' ||
      $this->uri->segment(1) == 'supervisor_assessment' ||
	  	$this->uri->segment(1) == 'trainings' ||
	  	$this->uri->segment(1) == 'new_training' ||
	  	$this->uri->segment(1) == 'edit_training' ||
	  	$this->uri->segment(1) == 'view_training' ||
	  	$this->uri->segment(1) == 'training_questions' ||
	  	$this->uri->segment(1) == 'hr_documents' ||
	  	$this->uri->segment(1) == 'view_hr_document' ||
      $this->uri->segment(1) == 'qualification' ? 'active' : '';
			?>">
			<?php if($hr_configuration == 1){  ?>
				<a href="#" class="nav-link has-dropdown"><i class="fas fa-users-cog"></i> <span>HR Config</span></a>
				<ul class="dropdown-menu">
					<li class="<?php echo $this->uri->segment(1) == 'bank' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('bank') ?>">Bank Setup</a></li>
					<li class="<?php echo $this->uri->segment(1) == 'pension' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('pension') ?>">Pension Setup</a></li>
					<li class="<?php echo $this->uri->segment(1) == 'health_insurance' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('health_insurance') ?>">HMO Setup</a></li>
					<li class="<?php echo $this->uri->segment(1) == 'department' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('department') ?>">Department Setup</a></li>
					<li class="<?php echo $this->uri->segment(1) == 'grade' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('grade') ?>">Grade Setup</a></li>
					<li class="<?php echo $this->uri->segment(1) == 'job_role' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('job_role') ?>">Job Roles Setup</a></li>
					<li class="<?php echo $this->uri->segment(1) == 'location' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('location') ?>">Location Setup</a></li>
					<li class="<?php echo $this->uri->segment(1) == 'appraisal_setup' || $this->uri->segment(1) == 'self_assessment' || $this->uri->segment(1) == 'quantitative_assessment' || $this->uri->segment(1) == 'view_quantitative_assessment' || $this->uri->segment(1) == 'qualitative_assessment' || $this->uri->segment(1) == 'supervisor_assessment' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('appraisal_setup') ?>">Appraisal Setup</a></li>
					<li class="<?php echo $this->uri->segment(1) == 'qualification' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('qualification') ?>">Qualification Setup</a></li>
					<li class="<?php echo $this->uri->segment(1) == 'subsidiary' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('subsidiary') ?>">Subsidiary Setup</a></li>
					<li class="<?php echo $this->uri->segment(1) == 'leave' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('leave') ?>">Leave Type Setup</a></li>
					<li class="<?php echo $this->uri->segment(1) == 'trainings' || $this->uri->segment(1) == 'new_training' || $this->uri->segment(1) == 'edit_training' || $this->uri->segment(1) == 'view_training' || $this->uri->segment(1) == 'training_questions' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('trainings') ?>">Training Setup</a></li>
      		<li class="<?php echo $this->uri->segment(1) == 'hr_documents' || $this->uri->segment(1) == 'view_hr_document' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('hr_documents') ?>">Documents</a></li>
				</ul>
			<?php } ?>
			</li>

			<li class="dropdown <?php echo
      $this->uri->segment(1) == 'payment_definition' ||
      $this->uri->segment(1) == 'new_payment_definition' ||
      $this->uri->segment(1) == 'edit_payment_definition' ||
      $this->uri->segment(1) == 'tax_rates' ||
      $this->uri->segment(1) == 'salary_structure' ||
      $this->uri->segment(1) == 'view_salary_structure' ||
      $this->uri->segment(1) == 'allowance' ||
      $this->uri->segment(1) == 'new_salary_allowance' ||
      $this->uri->segment(1) == 'edit_salary_allowance' ||
      $this->uri->segment(1) == 'payroll_month_year' ||
      $this->uri->segment(1) == 'min_tax_rate' ||
      $this->uri->segment(1) == 'pension_rate' ? 'active' : '';
      ?>">
      <?php if($payroll_configuration == 1){  ?>
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-money-check"></i> <span>Payroll Config</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(1) == 'payment_definition' || $this->uri->segment(1) == 'new_payment_definition' || $this->uri->segment(1) == 'edit_payment_definition' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('payment_definition') ?>">Payment Definition</a></li>
          <li class="<?php echo $this->uri->segment(1) == 'tax_rates' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('tax_rates') ?>">Tax Rates</a></li>
          <li class="<?php echo $this->uri->segment(1) == 'salary_structure' || $this->uri->segment(1) == 'view_salary_structure' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('salary_structure') ?>">Salary Structure</a></li>
          <li class="<?php echo $this->uri->segment(1) == 'allowance' || $this->uri->segment(1) == 'new_salary_allowance' || $this->uri->segment(1) == 'edit_salary_allowance' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('allowance') ?>">Salary Allowances</a></li>
          <li class="<?php echo $this->uri->segment(1) == 'payroll_month_year' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('payroll_month_year') ?>"> Payroll Month/Year </a></li>
          <li class="<?php echo $this->uri->segment(1) == 'min_tax_rate' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('min_tax_rate') ?>"> Minimum Tax Rate </a></li>
          <li class="<?php echo $this->uri->segment(1) == 'pension_rate' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('pension_rate') ?>"> Pension Rate </a></li>
        </ul>
      <?php } ?>
			</li>

			<li class="dropdown <?php echo $this->uri->segment(1) == 'view_log' ? 'active' : ''?>">
				<?php if($payroll_configuration == 1){  ?>
				<a href="#" class="nav-link has-dropdown"><i class="fas fa-clipboard-list "></i> <span>Logs</span></a>
				<ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(1) == 'view_log' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('view_log') ?>">View Logs</a></li>
				</ul>
				<?php } ?>
			</li>

			<?php endif; ?>

<?php if($user_data->user_type == 4): ?>
			<li class="menu-header">Subscription Management</li>
			<li class="dropdown <?php echo $this->uri->segment(1) == 'enroll_employee' ? 'active' : ''; ?>">

				<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-fingerprint"></i> <span>Subscription</span></a>
				<ul class="dropdown-menu">
					<li class="<?php echo $this->uri->segment(1) == 'subscription' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo site_url('subscription') ?>"> Your Subscription </a></li>
				</ul>

			</li>
<?php endif; ?>
		</ul>



		<div class="mt-4 mb-4 p-3 hide-sidebar-mini">
			<a href="<?php echo base_url('logout'); ?>" class="btn btn-primary btn-lg btn-block btn-icon-split">
				<i class="fas fa-rocket"></i> Logout
			</a>
		</div>
	</aside>
</div>


