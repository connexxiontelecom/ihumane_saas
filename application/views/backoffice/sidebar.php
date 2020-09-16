<div class="main-sidebar">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand" style="padding-top: 12px">
			<a href="<?php echo site_url() ?>"><img src="<?php echo base_url() ?>/assets/img/ihumane-logo-1.png" alt="logo" width="100" class="shadow-light mb-5 mt-2"></a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm" style="padding-top: 12px">
			<a href="<?php echo site_url() ?>"><img src="<?php echo base_url() ?>/assets/img/ihumane-logo-2.png" alt="logo" width="25" class="shadow-light mb-5 mt-2"></a>
		</div>
		<ul class="sidebar-menu">
			<li class="menu-header">Dashboard</li>
			<li class="dropdown <?php echo $this->uri->segment(1) == '' || $this->uri->segment(1) == 'home' ? 'active' : ''; ?>">
				<a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Home</span></a>
				<ul class="dropdown-menu">
					<li class="<?php echo $this->uri->segment(1) == '' || $this->uri->segment(1) == 'home' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>">Dashboard</a></li>
				</ul>
			</li>
			<li class="menu-header">Tenants Operations</li>
			<li class="dropdown <?php echo
      $this->uri->segment(1) == 'new_employee' ||

      $this->uri->segment(1) == 'employee_transfer' ? 'active' : '';
			?>">

				<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Tenants</span></a>
				<ul class="dropdown-menu">

          <li class="<?php echo $this->uri->segment(1) == 'employee' || $this->uri->segment(1) == 'view_employee' || $this->uri->segment(1) == 'update_employee' || $this->uri->segment(1) == 'query_employee' || $this->uri->segment(1) == 'view_query' || $this->uri->segment(1) == 'terminate_employee' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo site_url('employee') ?>"> All Tenants</a></li>
          <li class="<?php echo $this->uri->segment(1) == 'employee_transfer' || $this->uri->segment(1) == 'new_employee_transfer' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo site_url('employee_transfer') ?>"> Active Tenants</a></li>
          <li class="<?php echo $this->uri->segment(1) == 'employee_leave' || $this->uri->segment(1) == 'new_employee_leave' || $this->uri->segment(1) == 'extend_leave' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo site_url('employee_leave') ?>"> Inactive Tenants</a></li>
				</ul>

			</li>

			<li class="menu-header">Tenant Subscriptions</li>
			<li class="dropdown <?php echo
			$this->uri->segment(1) == 'new_employee' ||

			$this->uri->segment(1) == 'employee_transfer' ? 'active' : '';
			?>">

				<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Subscriptions</span></a>
				<ul class="dropdown-menu">

					<li class="<?php echo $this->uri->segment(1) == 'employee' || $this->uri->segment(1) == 'view_employee' || $this->uri->segment(1) == 'update_employee' || $this->uri->segment(1) == 'query_employee' || $this->uri->segment(1) == 'view_query' || $this->uri->segment(1) == 'terminate_employee' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo site_url('employee') ?>"> Active Subscriptions</a></li>
					<li class="<?php echo $this->uri->segment(1) == 'employee_transfer' || $this->uri->segment(1) == 'new_employee_transfer' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo site_url('employee_transfer') ?>"> Expiring Subscriptions </a></li>
					<li class="<?php echo $this->uri->segment(1) == 'employee_leave' || $this->uri->segment(1) == 'new_employee_leave' || $this->uri->segment(1) == 'extend_leave' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo site_url('employee_leave') ?>"> Subscription Reports</a></li>
				</ul>

			</li>



			<li class="menu-header">Set Up </li>
			<li class="dropdown <?php echo
			$this->uri->segment(1) == 'new_employee' ||

			$this->uri->segment(1) == 'employee_transfer' ? 'active' : '';
			?>">

				<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Plans</span></a>
				<ul class="dropdown-menu">

					<li class="<?php echo $this->uri->segment(1) == 'new_plan' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo site_url('new_plan') ?>"> New Plan</a></li>
					<li class="<?php echo $this->uri->segment(1) == 'plans'  ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo site_url('plans') ?>"> Manage Plans </a></li>
							</ul>

			</li>

		</ul>

		<div class="mt-4 mb-4 p-3 hide-sidebar-mini">
			<a href="<?php echo base_url('backoffice_logout'); ?>" class="btn btn-primary btn-lg btn-block btn-icon-split">
				<i class="fas fa-rocket"></i> Logout
			</a>
		</div>
	</aside>
</div>


