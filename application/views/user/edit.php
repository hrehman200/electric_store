<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">User Edit</h3>
            </div>
			<?php echo form_open('user/edit/'.$user['id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="password" class="control-label">Password</label>
						<div class="form-group">
							<input type="text" name="password" value="<?php echo ($this->input->post('password') ? $this->input->post('password') : $user['password']); ?>" class="form-control" id="password" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="username" class="control-label">Username</label>
						<div class="form-group">
							<input type="text" name="username" value="<?php echo ($this->input->post('username') ? $this->input->post('username') : $user['username']); ?>" class="form-control" id="username" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="email" class="control-label">Email</label>
						<div class="form-group">
							<input type="text" name="email" value="<?php echo ($this->input->post('email') ? $this->input->post('email') : $user['email']); ?>" class="form-control" id="email" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="last_signin" class="control-label">Last Signin</label>
						<div class="form-group">
							<input type="text" name="last_signin" value="<?php echo ($this->input->post('last_signin') ? $this->input->post('last_signin') : $user['last_signin']); ?>" class="form-control" id="last_signin" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="created_date" class="control-label">Created Date</label>
						<div class="form-group">
							<input type="text" name="created_date" value="<?php echo ($this->input->post('created_date') ? $this->input->post('created_date') : $user['created_date']); ?>" class="form-control" id="created_date" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="ip" class="control-label">Ip</label>
						<div class="form-group">
							<input type="text" name="ip" value="<?php echo ($this->input->post('ip') ? $this->input->post('ip') : $user['ip']); ?>" class="form-control" id="ip" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="verification_key" class="control-label">Verification Key</label>
						<div class="form-group">
							<input type="text" name="verification_key" value="<?php echo ($this->input->post('verification_key') ? $this->input->post('verification_key') : $user['verification_key']); ?>" class="form-control" id="verification_key" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="admin_group" class="control-label">Admin Group</label>
						<div class="form-group">
							<input type="text" name="admin_group" value="<?php echo ($this->input->post('admin_group') ? $this->input->post('admin_group') : $user['admin_group']); ?>" class="form-control" id="admin_group" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="name" class="control-label">Name</label>
						<div class="form-group">
							<input type="text" name="name" value="<?php echo ($this->input->post('name') ? $this->input->post('name') : $user['name']); ?>" class="form-control" id="name" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="address" class="control-label">Address</label>
						<div class="form-group">
							<input type="text" name="address" value="<?php echo ($this->input->post('address') ? $this->input->post('address') : $user['address']); ?>" class="form-control" id="address" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="address2" class="control-label">Address2</label>
						<div class="form-group">
							<input type="text" name="address2" value="<?php echo ($this->input->post('address2') ? $this->input->post('address2') : $user['address2']); ?>" class="form-control" id="address2" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="city" class="control-label">City</label>
						<div class="form-group">
							<input type="text" name="city" value="<?php echo ($this->input->post('city') ? $this->input->post('city') : $user['city']); ?>" class="form-control" id="city" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="state" class="control-label">State</label>
						<div class="form-group">
							<input type="text" name="state" value="<?php echo ($this->input->post('state') ? $this->input->post('state') : $user['state']); ?>" class="form-control" id="state" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="zip" class="control-label">Zip</label>
						<div class="form-group">
							<input type="text" name="zip" value="<?php echo ($this->input->post('zip') ? $this->input->post('zip') : $user['zip']); ?>" class="form-control" id="zip" />
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Save
				</button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>