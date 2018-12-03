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
                        <label for="name" class="control-label">Name</label>
                        <div class="form-group">
                            <input type="text" name="name" value="<?php echo ($this->input->post('name') ? $this->input->post('name') : $user['name']); ?>" class="form-control" id="name" />
                            <span class="text-danger"><?php echo form_error('name');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="address" class="control-label">Address</label>
                        <div class="form-group">
                            <input type="text" name="address" value="<?php echo ($this->input->post('address') ? $this->input->post('address') : $user['address']); ?>" class="form-control" id="address" />
                            <span class="text-danger"><?php echo form_error('address');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="control-label">Email</label>
                        <div class="form-group">
                            <input type="text" name="email" value="<?php echo ($this->input->post('email') ? $this->input->post('email') : $user['email']); ?>" class="form-control" id="email" />
                            <span class="text-danger"><?php echo form_error('email');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="control-label">Password</label>
                        <div class="form-group">
                            <input type="password" name="password" value="<?php echo ($this->input->post('password') ? $this->input->post('password') : ''); ?>" class="form-control" id="email" />
                            <span class="text-danger"><?php echo form_error('password');?></span>
                        </div>
                    </div>
					<div class="col-md-6">
						<label for="admin_group" class="control-label">Permission Group</label>
						<div class="form-group">
                            <select name="permissionID" class="form-control">
                                <?php
                                foreach($permission_groups as $pg) {
                                    echo sprintf('<option value="%d" %s>%s</option>', $pg['id'], ($user['permission_group']==$pg['id']?'selected':''), $pg['name']);
                                }
                                ?>
                            </select>
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