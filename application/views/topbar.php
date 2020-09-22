
<nav class="navbar navbar-expand-lg main-navbar">
	<form class="form-inline mr-auto" onsubmit="return false;">
		<ul class="navbar-nav mr-3">
			<li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
			<li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
		</ul>
		<div class="search-element">
			<input class="form-control" type="search" placeholder="Search Employees" aria-label="Search" data-width="250" onkeyup="filter(this)">
			<button class="btn" type="submit"><i class="fas fa-search"></i></button>
			<div class="search-backdrop"></div>
			<div class="search-result pl-2 pb-3" >
				<div class="search-header mb-2">
					Employees
				</div>
        <div class="search-items" id="search-items" style="max-height: 300px; overflow-y: auto">

        </div>
        <script language="javascript" type="text/javascript">
          function filter(element) {
            let value = $(element).val();
            $("#search-items > .search-item").each(function() {

              if ($(this).text().search(new RegExp(value, "i")) > -1) {
                $(this).show();
              }
              else {
                $(this).hide();
              }
            });
          }
        </script>
			</div>
		</div>
	</form>
	<ul class="navbar-nav navbar-right">
		<li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle"><i class="far fa-envelope"></i></a>
			<div class="dropdown-menu dropdown-list dropdown-menu-right">
				<div class="dropdown-header">Messages
					<div class="float-right">
						<a href="#">Mark All As Read</a>
					</div>
				</div>
<!--				<div class="dropdown-list-content dropdown-list-message">-->
<!--					<a href="#" class="dropdown-item dropdown-item-unread">-->
<!--						<div class="dropdown-item-avatar">-->
<!--							<img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle">-->
<!--							<div class="is-online"></div>-->
<!--						</div>-->
<!--						<div class="dropdown-item-desc">-->
<!--							<b>Kusnaedi</b>-->
<!--							<p>Hello, Bro!</p>-->
<!--							<div class="time">10 Hours Ago</div>-->
<!--						</div>-->
<!--					</a>-->
<!--					<a href="#" class="dropdown-item dropdown-item-unread">-->
<!--						<div class="dropdown-item-avatar">-->
<!--							<img alt="image" src="../assets/img/avatar/avatar-2.png" class="rounded-circle">-->
<!--						</div>-->
<!--						<div class="dropdown-item-desc">-->
<!--							<b>Dedik Sugiharto</b>-->
<!--							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>-->
<!--							<div class="time">12 Hours Ago</div>-->
<!--						</div>-->
<!--					</a>-->
<!--					<a href="#" class="dropdown-item dropdown-item-unread">-->
<!--						<div class="dropdown-item-avatar">-->
<!--							<img alt="image" src="../assets/img/avatar/avatar-3.png" class="rounded-circle">-->
<!--							<div class="is-online"></div>-->
<!--						</div>-->
<!--						<div class="dropdown-item-desc">-->
<!--							<b>Agung Ardiansyah</b>-->
<!--							<p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>-->
<!--							<div class="time">12 Hours Ago</div>-->
<!--						</div>-->
<!--					</a>-->
<!--					<a href="#" class="dropdown-item">-->
<!--						<div class="dropdown-item-avatar">-->
<!--							<img alt="image" src="../assets/img/avatar/avatar-4.png" class="rounded-circle">-->
<!--						</div>-->
<!--						<div class="dropdown-item-desc">-->
<!--							<b>Ardian Rahardiansyah</b>-->
<!--							<p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>-->
<!--							<div class="time">16 Hours Ago</div>-->
<!--						</div>-->
<!--					</a>-->
<!--					<a href="#" class="dropdown-item">-->
<!--						<div class="dropdown-item-avatar">-->
<!--							<img alt="image" src="../assets/img/avatar/avatar-5.png" class="rounded-circle">-->
<!--						</div>-->
<!--						<div class="dropdown-item-desc">-->
<!--							<b>Alfa Zulkarnain</b>-->
<!--							<p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>-->
<!--							<div class="time">Yesterday</div>-->
<!--						</div>-->
<!--					</a>-->
<!--				</div>-->
				<div class="dropdown-footer text-center">
					<a href="#">View All <i class="fas fa-chevron-right"></i></a>
				</div>
			</div>
		</li>
		<div id="notifications">
			<?php $count = count($notifications); ?>
		<li  class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg <?php if ($count > 0){echo "beep"; } ?>"><i class="far fa-bell"></i></a>
			<div class="dropdown-menu dropdown-list dropdown-menu-right">
				<div class="dropdown-header">Notifications
					<?php if($count > 0): ?>
										<div class="float-right">
											<a href="<?php echo site_url('clear_notifications')."/a"?>">Mark All As Read</a>
										</div>
					<?php endif; ?>
				</div>
				<?php if(!empty($notifications)): ?>

					<div class="dropdown-list-content dropdown-list-icons">
						<?php foreach ($notifications as $notification): ?>

							<a id="<?php echo $notification->notification_id; ?>" href="<?php echo site_url()."view_notifications/".$notification->notification_id; ?>" class="dropdown-item dropdown-item-unread">
								<div class="dropdown-item-icon bg-primary text-white">
									<i class="fas fa-code"></i>
								</div>
								<div class="dropdown-item-desc">
									<?php echo $notification->notification_type; ?>
									<div class="time text-primary"><?php echo $notification->notification_date; ?></div>
								</div>
							</a>
						<?php endforeach; ?>

					</div>
				<?php endif; ?>
				<?php if(empty($notifications)): ?>
					<div class="dropdown-footer text-center">
						No Notifications
					</div>
				<?php endif;?>
			</div>
		</li>
		</div>

		<li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
				<img alt="image" src="<?php echo base_url() ?>/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
				<div class="d-sm-none d-lg-inline-block">Hi, <?php echo $user_data->user_name; ?></div></a>
			<div class="dropdown-menu dropdown-menu-right">
				<div class="dropdown-title">Logged in for <br/><?php echo timespan($this->session->userdata('login_time'), time(), 2)?></div>
				<a href="<?php echo site_url('view_log')?>" class="dropdown-item has-icon">
					<i class="fas fa-bolt"></i> Activities
				</a>
				<a href="#" class="dropdown-item has-icon">
					<i class="fas fa-cog"></i> Settings
				</a>
				<?php if($user_data->user_type == 3): ?>
				<a href="<?php echo base_url('employee_main') ?>" class="dropdown-item has-icon">
					<i class="fas fa-arrow-circle-right"></i> Switch to Self-Service
				</a>
				<?php endif; ?>
				<div class="dropdown-divider"></div>
				<a href="<?php echo site_url('logout'); ?>" class="dropdown-item has-icon text-danger">
					<i class="fas fa-sign-out-alt"></i> Logout
				</a>
			</div>
		</li>
	</ul>
</nav>
<script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/push.js/bin/push.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.playSound.js"></script>

<script>
	$(document).ready(function () {
		setInterval(timestamp, 5000);
		function timestamp() {
			var employee_id = 0;
			$.ajax({
				type: "POST",
				url: '<?php echo site_url('get_notifications'); ?>',
				data: {employee_id: employee_id},
				success: function (data) {
					var data = JSON.parse(data);
					for (i = 0; i < data.length; i++) {
						var notification_id = data[i].notification_id;
						Push.create("iHumane", {
							body: data[i].notification_type,
							icon: "https://app.ihumane.net//assets/img/ihumane-logo-1.png",
							timeout: 4000,
							onClick: function () {
								// window.focus();
								// this.close();
							location.href = '<?php echo site_url()?>/view_notifications/' + notification_id;
							}
						});
						$.playSound("<?php echo base_url('assets/notification/done-for-you.mp3'); ?>");
					}
				},
				error: function () {
					console.log(this.error);
				}
			});
		}

    $.ajax({
      url: '<?php echo site_url('get_employees')?>',
      success: function(employees) {
        let employeeList = JSON.parse(employees)
        for(let i = 0; i<employeeList.length; i++){
          console.log(employeeList[i])
          $('.search-items').append(`
            <div class="search-item">
              <a href="<?php echo site_url('view_employee').'/'; ?>${employeeList[i].employee_id}">
                <img class="mr-3 rounded" width="30" height="30" src="<?php echo base_url()?>/uploads/employee_passports/${employeeList[i].employee_passport}" alt="product">
                ${employeeList[i].employee_first_name} ${employeeList[i].employee_last_name}
              </a>
            </div>
          `)
        }
        // console.log(JSON.parse(employees));
      }
    });


	})

</script>
