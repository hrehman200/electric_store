<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Permission Edit</h3>
            </div>
			<?php echo form_open('permission/edit/'.$permission['permissionID']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="permission" class="control-label">Permission</label>
						<div class="form-group">
							<input type="text" name="permission" value="<?php echo ($this->input->post('permission') ? $this->input->post('permission') : $permission['permission']); ?>" class="form-control" id="permission" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="key" class="control-label">Key</label>
						<div class="form-group">
							<input type="text" name="key" value="<?php echo ($this->input->post('key') ? $this->input->post('key') : $permission['key']); ?>" class="form-control" id="key" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="category" class="control-label">Category</label>
						<div class="form-group">
							<input type="text" name="category" value="<?php echo ($this->input->post('category') ? $this->input->post('category') : $permission['category']); ?>" class="form-control" id="category" />
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