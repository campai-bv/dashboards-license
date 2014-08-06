<div class="row">

	<div class="col-lg-6">

		<?php echo $this->Session->flash(); ?>

		<form role="form" action="/dashboard_license/licenses/edit" method="POST">
			<div class="form-group">
				<label for="license">License</label>
				<textarea name="data[License][license]" class="form-control" id="license" placeholder="Enter your License" rows="10"><?php
						if (isset($this->request->data['License']['license'])) {
							echo $this->request->data['License']['license'];
						}
				?></textarea>
			</div>

			<button type="submit" class="btn  btn-success  pull-right">Save</button>
			<a href="/" class="btn  btn-text  pull-right">Go to Dashboards</a>

		</form>

	</div>

	<div class="col-lg-5  col-lg-offset-1">

		<h1>Contact</h1>
		<p>
			Want to request or update your license, or ask a question?<br/>
		</p>

		<div class="row">
			<div class="col-lg-6">
				<h4>Sales & General</h4>
				Tel: +31 (0)79 363 7050<br/>
				Fax: +31 (0)79 363 7052<br/>
				Email: sales@campai.nl<br/>
			</div>
			<div class="col-lg-6">
				<h4>Support</h4>
				Tel: +31 (0)79 363 7051<br/>
				Email: autotask@campai.nl<br/>
			</div>
		</div>

	</div>
</div>