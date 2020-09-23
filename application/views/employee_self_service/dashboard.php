
<?php
	include(APPPATH.'/views/stylesheet.php');
	$CI =& get_instance();
	$CI->load->model('hr_configurations');
	$CI->load->model('payroll_configurations');
	$location = 'Abuja';
	$key = '4bbd388761052d71725bcd55680d1d0c';
	$url = "https://api.openweathermap.org/data/2.5/weather?q=".$location."&appid=".$key."&units=metric";
//"https://api.openweathermap.org/data/2.5/weather?q=Abuja&appid=4bbd388761052d71725bcd55680d1d0c&units=metric"
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
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
          <h1>Dashboard</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo site_url('employee_main'); ?>">Dashboard</a></div>
          </div>
        </div>
        <div class="section-body">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-md-6 col-12">
              <div class="card pt-3" id="welcome" style="height: 195px; border-radius: 12px">
	              <?php
	              $dob = $employee->employee_dob;
	              $date = DateTime::createFromFormat("Y-m-d", $dob);
	              $_dob = $date->format("m")."-".$date->format("d");
	              $today = date('Y-m-d');
	              $dates = DateTime::createFromFormat("Y-m-d", $today);
	              $_today = $dates->format("m")."-".$dates->format("d");
	              $greeting;
	              if($_dob == $_today){ $greeting = "Happy Birthday,"; }
	              else { $greeting = "Hello,";} ?>
                <div class="card-body">
	                <?php if($_dob == $_today){ ?>
                    <script>
                      let elem = document.getElementById('welcome');
                      elem.style.removeProperty('height');
                    </script>
                    <canvas class="card-img-top" id="birthday" style="margin-top: -15px; border-radius: 12px; margin-bottom: 10px;"></canvas>
	                <?php } ?>
                  <h5 class="card-title"><?php echo $greeting.' '.$user_data->user_name; ?>!</h5>
                  <p class="card-text">Welcome back. You have <?php echo count($notifications)?> notifications.</p>
                  <a href="<?php echo base_url('personal_information'); ?>" class="btn btn-primary">My Information</a>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-md-6 col-12">
              <div class="card card-statistic-2" style="border-radius: 12px;">
                <div class="card-stats" >
                  <div class="card-stats-title" style="border-radius: 12px; !important;">Performance Overview
                  </div>
                  <div class="card-stats-items" style="border-radius: 12px;">
                    <div class="card-stats-item">
                      <div class="card-stats-item-count"><?php echo count($appraisals)?></div>
                      <div class="card-stats-item-label">Appraisals</div>
                    </div>
                    <div class="card-stats-item">
                      <div class="card-stats-item-count"><?php echo count($appraisees)?></div>
                      <div class="card-stats-item-label">Appraisees</div>
                    </div>
                    <div class="card-stats-item">
                      <div class="card-stats-item-count"><?php echo count($trainings)?></div>
                      <div class="card-stats-item-label">Trainings</div>
                    </div>
                  </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-chart-line"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Appraisal Results</h4>
                  </div>
                  <div class="card-body">
                    <?php
                      $num_results = 0;
                      if(!empty($appraisals)):
                        foreach($appraisals as $appraisal):
                          if ($appraisal->employee_appraisal_status == 1): $num_results ++; endif;
                        endforeach;
                      endif;
                      echo $num_results;
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-md-6 col-12">
              <div class="card card-hero" style="height: 195px; border-radius: 12px;">
                <div class="card-header" style="height: 195px; border-radius: 12px; padding-top: 30px !important;">
	                <?php if($response): $response = json_decode($response); //print_r($response); ?>
                  <div class="media">
                    <div class="media-body">
                      <h4  class="media-title text-white"><?php echo $location?></h4>
                      <small class="text-job text-white"><?php echo $response->weather[0]->description?></small>
                      <h2><?php echo $response->main->temp?>&#176;</h2>
                      <h6 class="text-white" id="timestamp"><?php echo date('F j, Y g:i:s a', now('Africa/Lagos'));?></h6>
                    </div>
                    <div class="media-right">
                      <a class="text-white" href="javascript:void(0)" data-toggle="modal" data-target="#details"><i class="text-white fa fa-ellipsis-h"></i></a>
                    </div>
                  </div>
                  <?php endif?>
                </div>
              </div>
            </div>
          </div>
<!--          <div class="row">-->
<!--            <div class="col-12 mb-4">-->
<!--              <div class="hero bg-primary text-white">-->
<!--                <div class="hero-inner">-->
<!--                  <h2> --><?php
//                    $dob = $employee->employee_dob;
//                    $date = DateTime::createFromFormat("Y-m-d", $dob);
//                    $_dob = $date->format("m")."-".$date->format("d");
//                    $today = date('Y-m-d');
//                    $dates = DateTime::createFromFormat("Y-m-d", $today);
//                    $_today = $dates->format("m")."-".$dates->format("d");
//                    if($_dob == $_today){ echo "Happy Birthday,"; } else {
//                      echo "Welcome,";
//                    } ?><!-- --><?php //echo $user_data->user_name; ?><!-- </h2>-->
<!--									<p class="lead">The self-service portal provides you with access to the full range of human resource functions and responsibilities</p>-->
<!--                  <p class="lead" id="timestamp"></p>-->
<!--                </div>-->
<!--                --><?php //if($_dob == $_today){ ?>
<!--                  <canvas id="birthday" style="height: 50vh; display: inherit"></canvas>-->
<!--                --><?php //} ?>
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
          <div class="row">
            <div class="col-lg-6 col-md-6 col-12 col-sm-12">
              <div class="card" style="border-radius: 12px;">
                <div class="card-body">
                  <div class="summary">
                    <div class="summary-info">
                      <h4><?php echo count($memos)?> Announcements</h4>
                      <div class="text-muted"><?php echo count($specific_memos)?> Directives</div>
                      <div class="d-block mt-2">
                        <a href="<?php echo site_url('employee_leave') ?>">View Announcements</a>
                      </div>
                    </div>
                    <div class="summary-item">
                      <h6>Recent Announcements & Directives</h6>
                      <ul class="list-unstyled list-unstyled-border">
	                      <?php if(!empty($memos)):
	                      $count = 1;
	                      foreach($memos as $memo):
	                      ?>
                          <li class="media">
                            <div class="media-body">
                              <div class="media-right">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#view_<?php echo $memo->memo_id ?>"><i class="fas fa-ellipsis-h"></i></a>
                              </div>
                              <div class="media-title"><a href="#"><?php echo $memo->memo_subject; ?></a></div>
                              <div class="text-muted trunc text-small"> <small class="font-italic text-info" style="font-size: 10px;">Announcement</small> <div class="bullet"></div> Sent <?php echo date('F j, Y g:i a', strtotime($memo->memo_date)); ?></div>
                            </div>
                          </li>
                        <?php
                        if($count == 3):
                          break;
                        endif;
                        $count++;
	                      endforeach;
	                      endif;
	                      ?>
	                      <?php if(!empty($specific_memos)):
	                      $count = 1;
	                      foreach($specific_memos as $memo):
	                      ?>
                          <li class="media">
                            <div class="media-body">
                              <div class="media-right">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#view_<?php echo $memo->specific_memo_id ?>"><i class="fas fa-ellipsis-h"></i></a>
                              </div>
                              <div class="media-title"><a href="#"><?php echo $memo->specific_memo_subject; ?></a></div>
                              <div class="text-muted trunc text-small"> <small class="font-italic text-warning" style="font-size: 10px;">Directive</small> <div class="bullet"></div> Sent <?php echo date('F j, Y g:i a', strtotime($memo->specific_memo_date)); ?></div>
                            </div>
                          </li>
		                      <?php
		                      if($count == 3):
			                      break;
		                      endif;
		                      $count++;
	                      endforeach;
	                      endif;
	                      ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 col-sm-12">
              <div class="row">
                <div class="col-4">
                  <div class="alert alert-success alert-has-icon" style="border-radius: 12px;">
                    <div class="alert-icon"><i class="far fa-check-circle"></i></div>
                    <div class="alert-body">
                      <div class="alert-title">Payslip</div>
                      Your Payslip for September is ready
                    </div>
                  </div>
                </div>
                <div class="col-8">
                  <div class="card card-statistic-2" style="border-radius: 12px;">
                    <div class="card-chart">
                      <canvas id="balance-chart" height="80"></canvas>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                      <i class="fas fa-coins"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Income Payments (<?php echo date('Y')?>)</h4>
                      </div>
                      <div class="card-body">
                        $187,130
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card" style="border-radius: 12px;">
                <div class="card-body">
                  <div class="summary">
                    <div class="summary-info">
                      <h4><?php echo count($queries)?> Queries</h4>
                      <?php
                        $num_open = 0;
                        if(!empty($queries)):
                        foreach($queries as $query):
                          if($query->query_status == 1): $num_open ++; endif;
                        endforeach;
                        endif;
                      ?>
                      <div class="text-muted"><?php echo $num_open?> Open Queries</div>
                      <div class="d-block mt-2">
                        <a href="<?php echo base_url('my_queries'); ?>">View Queries</a>
                      </div>
                    </div>
                    <div class="summary-item">
                      <h6>Open Queries</h6>
                      <ul class="list-unstyled list-unstyled-border">
	                      <?php if(!empty($queries)):
	                      $count = 0;
	                      foreach($queries as $query):
                          if($query->query_status == 1):
	                      ?>
                          <li class="media">
                            <div class="media-body">
                              <div class="media-right">
                                <div class="dropleft">
                                  <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item has-icon" href="<?php echo site_url('view_my_query').'/'.$query->query_id; ?>"><i class="fas fa-eye"></i> View Query</a>
                                  </div>
                                </div>
                              </div>
                              <div class="media-title"><a href="#"><?php echo $query->query_subject; ?></a></div>
                              <div class="text-muted trunc text-small"> <small class="font-italic <?php echo $query->query_type == 0 ? 'text-warning' : 'text-danger' ?>" style="font-size: 10px;"><?php echo $query->query_type == 0 ? 'Warning' : 'Query' ?></small> <div class="bullet"></div> Opened <?php echo date("F j, Y", strtotime($query->query_date));?></div>
                            </div>
                          </li>
                        <?php
                        if($count == 5 ):
                          break;
                        endif;
                        $count++;
                        endif;
                        endforeach;
                        endif;
                        ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
		<?php include(APPPATH.'/views/footer.php'); ?>
	</div>
</div>

<div class="modal fade" id="details" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle2">Today</h5>
        <a type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-dark">&times;</span>
        </a>
      </div>
      <div class="modal-body">
	      <?php if($response):  //print_r($response); ?>
          <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
            <li class="media">
              <div class="media-body">
                <div class="media-title"><?php echo $location?></div>
                <div class="text-job text-muted"><?php echo $response->weather[0]->description?></div>
                <h2><?php echo $response->main->temp?>&#176;</h2>
              </div>
              <div class="media-right pb-3">
                <i class="fa fa-cloud-sun text-muted" style="font-size: 90px"></i>
              </div>
            </li>
            <li class="media text-center">
              <div class="media-body">
                <div class="media-title"><?php echo date('g:i a', $response->sys->sunrise);?></div>
                <div class="text-job text-muted">Sunrise</div>
              </div>
              <div class="media-body">
                <div class="media-title"><?php echo date('g:i a', $response->sys->sunset);?></div>
                <div class="text-job text-muted">Sunset</div>
              </div>
              <div class="media-body">
                <div class="media-title"><?php echo $response->visibility ?> m</div>
                <div class="text-job text-muted">Visibility</div>
              </div>
            </li>
            <li class="media text-center">
              <div class="media-body">
                <div class="media-title"><?php echo $response->main->temp_min?>&#176;</div>
                <div class="text-job text-muted">Min Temp</div>
              </div>
              <div class="media-body">
                <div class="media-title"><?php echo $response->main->temp_max?>&#176;</div>
                <div class="text-job text-muted">Max Temp</div>
              </div>
              <div class="media-body">
                <div class="media-title"><?php echo $response->main->feels_like?>&#176;</div>
                <div class="text-job text-muted">Feels Like</div>
              </div>
            </li>
            <li class="media text-center">
              <div class="media-body">
                <div class="media-title"><?php echo $response->main->pressure?> hPa</div>
                <div class="text-job text-muted">Pressure</div>
              </div>
              <div class="media-body">
                <div class="media-title"><?php echo $response->main->humidity?> %</div>
                <div class="text-job text-muted">Humidity</div>
              </div>
              <div class="media-body">
                <div class="media-title"><?php echo $response->wind->speed?> mps</div>
                <div class="text-job text-muted">Wind Speed</div>
              </div>
            </li>
          </ul>
        <?php endif;?>
      </div>
      <div class="modal-footer bg-whitesmoke">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php if(!empty($memos)): foreach($memos as $memo): ?>
  <div class="modal fade" id="view_<?php echo $memo->memo_id ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle2">Announcement</h5>
          <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-dark">&times;</span>
          </a>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Subject</label>
            <input type="text" class="form-control-plaintext" readonly value="<?php echo $memo->memo_subject?>"/>
          </div>
          <div class="form-group">
            <label>Announcement Body</label>
	          <p><?php echo $memo->memo_body?></p>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; endif;?>

<?php if(!empty($specific_memos)): foreach($specific_memos as $memo): ?>
  <div class="modal fade" id="view_<?php echo $memo->specific_memo_id ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle2">Directive</h5>
          <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-dark">&times;</span>
          </a>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Subject</label>
            <input type="text" class="form-control-plaintext" readonly value="<?php echo $memo->specific_memo_subject?>"/>
          </div>
          <div class="form-group">
            <label>Directive Body</label>
            <p><?php echo $memo->specific_memo_body?></p>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; endif;?>

<?php include(APPPATH.'/views/js.php'); ?>
</body>
</html>
<script>
	$('title').html('Dashboard - IHUMANE');

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
    var balance_chart = document.getElementById("balance-chart").getContext('2d');

    var balance_chart_bg_color = balance_chart.createLinearGradient(0, 0, 0, 70);
    balance_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
    balance_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');

    var myChart = new Chart(balance_chart, {
      type: 'line',
      data: {
        labels: ['16-07-2018', '17-07-2018', '18-07-2018', '19-07-2018', '20-07-2018', '21-07-2018', '22-07-2018', '23-07-2018', '24-07-2018', '25-07-2018', '26-07-2018', '27-07-2018', '28-07-2018', '29-07-2018', '30-07-2018', '31-07-2018'],
        datasets: [{
          label: 'Balance',
          data: [0, 0, 80, 50, 72, 52, 60, 41, 30, 45, 70, 40, 93, 63, 50, 62],
          backgroundColor: balance_chart_bg_color,
          borderWidth: 3,
          borderColor: 'rgba(63,82,227,1)',
          pointBorderWidth: 0,
          pointBorderColor: 'transparent',
          pointRadius: 3,
          pointBackgroundColor: 'transparent',
          pointHoverBackgroundColor: 'rgba(63,82,227,1)',
        }]
      },
      options: {
        layout: {
          padding: {
            bottom: -1,
            left: -1
          }
        },
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            gridLines: {
              display: false,
              drawBorder: false,
            },
            ticks: {
              beginAtZero: true,
              display: false
            }
          }],
          xAxes: [{
            gridLines: {
              drawBorder: false,
              display: false,
            },
            ticks: {
              display: false
            }
          }]
        },
      }
    });
	});
	// helper functions
	const PI2 = Math.PI * 2
	const random = (min, max) => Math.random() * (max - min + 1) + min | 0
	const time = _ => new Date().getTime()
	// container
	class Birthday {
		constructor() {
			this.resize()
			// create a lovely place to store the firework
			this.fireworks = []
			this.counter = 0
		}
		resize() {
			this.width = canvas.width = window.innerWidth
			let center = this.width / 2 | 0
			this.spawnA = center - center / 4 | 0
			this.spawnB = center + center / 4 | 0
			this.height = canvas.height = window.innerHeight
			this.spawnC = this.height * .1
			this.spawnD = this.height * .5
		}
		onClick(evt) {
			let x = evt.clientX || evt.touches && evt.touches[0].pageX
			let y = evt.clientY || evt.touches && evt.touches[0].pageY
			let count = random(3,5)
			for(let i = 0; i < count; i++) this.fireworks.push(new Firework(
					random(this.spawnA, this.spawnB),
					this.height,
					x,
					y,
					random(0, 260),
					random(30, 110)))
			this.counter = -1
		}
		update(delta) {
			ctx.globalCompositeOperation = 'hard-light'
			ctx.fillStyle = `rgba(20,20,20,${ 7 * delta })`
			ctx.fillRect(0, 0, this.width, this.height)

			ctx.globalCompositeOperation = 'lighter'
			for (let firework of this.fireworks) firework.update(delta)

			// if enough time passed... create new new firework
			this.counter += delta * 3 // each second
			if (this.counter >= 1) {
				this.fireworks.push(new Firework(
						random(this.spawnA, this.spawnB),
						this.height,
						random(0, this.width),
						random(this.spawnC, this.spawnD),
						random(0, 360),
						random(30, 110)))
				this.counter = 0
			}

			// remove the dead fireworks
			if (this.fireworks.length > 1000) this.fireworks = this.fireworks.filter(firework => !firework.dead)

		}
	}

	class Firework {
		constructor(x, y, targetX, targetY, shade, offsprings) {
			this.dead = false
			this.offsprings = offsprings

			this.x = x
			this.y = y
			this.targetX = targetX
			this.targetY = targetY

			this.shade = shade
			this.history = []
		}
		update(delta) {
			if (this.dead) return

			let xDiff = this.targetX - this.x
			let yDiff = this.targetY - this.y
			if (Math.abs(xDiff) > 3 || Math.abs(yDiff) > 3) { // is still moving
				this.x += xDiff * 2 * delta
				this.y += yDiff * 2 * delta

				this.history.push({
					x: this.x,
					y: this.y
				})

				if (this.history.length > 20) this.history.shift()

			} else {
				if (this.offsprings && !this.madeChilds) {

					let babies = this.offsprings / 2
					for (let i = 0; i < babies; i++) {
						let targetX = this.x + this.offsprings * Math.cos(PI2 * i / babies) | 0
						let targetY = this.y + this.offsprings * Math.sin(PI2 * i / babies) | 0

						birthday.fireworks.push(new Firework(this.x, this.y, targetX, targetY, this.shade, 0))

					}

				}
				this.madeChilds = true
				this.history.shift()
			}

			if (this.history.length === 0) this.dead = true
			else if (this.offsprings) {
				for (let i = 0; this.history.length > i; i++) {
					let point = this.history[i]
					ctx.beginPath()
					ctx.fillStyle = 'hsl(' + this.shade + ',100%,' + i + '%)'
					ctx.arc(point.x, point.y, 1, 0, PI2, false)
					ctx.fill()
				}
			} else {
				ctx.beginPath()
				ctx.fillStyle = 'hsl(' + this.shade + ',100%,50%)'
				ctx.arc(this.x, this.y, 1, 0, PI2, false)
				ctx.fill()
			}

		}
	}

	let canvas = document.getElementById('birthday')
	var ctx = canvas.getContext('2d')

	let then = time()

	let birthday = new Birthday
	window.onresize = () => birthday.resize()
	document.onclick = evt => birthday.onClick(evt)
	document.ontouchstart = evt => birthday.onClick(evt)

	;(function loop(){
		requestAnimationFrame(loop)

		let now = time()
		let delta = now - then

		then = now
		birthday.update(delta / 1000)


	})()

</script>
