<div class="content-wrap">
	<div class="container">
		<div class="row">
			<div class="outer-box">
				<div class="inner-box">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<?php
					if(isset($error) && $error)
					{
						echo '<div class="alert alert-danger">';
						echo '<ul>';
						foreach ($error as $key => $value) {
							# code...
							echo '<li>'.$value.'</li>';
						}
						echo '</ul>';
						echo '</div>';
					}
					?>
						<form role="form" class="frm-left" method="post" action="<?= base_url.$lang.'/user/login/'?>">
							<h3>Member Login</h3>
							<div class="form-group">
								<label>Username</label>
								<div class="input-wrap">
									<input type="text" class="form-control" name="username"  >
									<span class="lbl-alert">*</span>
								</div>
							</div>
							<div class="form-group">
								<label>Password</label>
								<div class="input-wrap">
									<input type="password" class="form-control" name="password"  >
									<span class="lbl-alert">*</span>
								</div>
							</div>
							<button type="submit" name="sflogin" class="btn btn-default">OK</button>
							
						</form>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<?php
						if(isset($error_re) && $error_re)
						{
							echo '<div class="alert alert-danger">';
							echo '<ul>';
							foreach ($error_re as $key => $value) {
								# code...
								echo '<li>'.$value.'</li>';
							}
							echo '</ul>';
							echo '</div>';
						}
						?>

						<form role="form"  class="frm-right" method="post"  action="<?= base_url.$lang.'/user/register/'?>">
							<h3>SIGN UP</h3>
							<div class="form-group">
								<label>Username</label>
								<div class="input-wrap">
									<input type="text" class="form-control" name="user_username" value="<?= $user_username?>" required="required">
									<span class="lbl-alert">*</span>
								</div>
							</div>
							<div class="form-group">
								<label>Password</label>
								<div class="input-wrap">
									<input type="password" class="form-control" name="user_password" value="<?= $user_password?>" required="required">
									<span class="lbl-alert">*</span>
								</div>
							</div>							
							<div class="form-group">
								<label>Email</label>
								<div class="input-wrap">
									<input type="email" class="form-control" name="user_email" value="<?= $user_email?>" required="required">
									<span class="lbl-alert">*</span>
								</div>
							</div>
							<div class="form-group">
								<label>Phone</label>
								<div class="input-wrap">
									<input type="text" class="form-control" name="user_phone" value="<?= $user_phone?>" required="required">
									<span class="lbl-alert">*</span>
								</div>
							</div>
							<button type="submit" class="btn btn-default">Register</button>
						</form>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</div>