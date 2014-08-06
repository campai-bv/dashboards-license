<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		<title><?php echo $title_for_layout; ?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php
			echo $this->Html->css(array(
				'/dashboard_license/css/bootstrap.min',
				'/dashboard_license/css/font-awesome.min',
			));

			echo $this->Html->script(array(
				'/autotask/js/jquery-1.10.2.min',
				'/autotask/js/bootstrap.min',
			));

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>
	</head>

	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Dashboards License</a>
				</div>
			</div>
		</div>

		<div class="container" style="padding-top: 60px;">

			<?php
				echo $this->fetch('content');
			?>

		</div><!-- /.container -->
	</body>
</html>
