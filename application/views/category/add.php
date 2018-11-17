<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Category Add</h3>
            </div>
            <?php echo form_open('category/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="parent_id" class="control-label">Parent Category</label>
						<div class="form-group">
							<select name="parent_id" class="form-control">
								<option value="">None</option>
                                <?php
                                echo $all_categories;
                                ?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="name" class="control-label">Name</label>
						<div class="form-group">
							<input type="text" name="name" value="<?php echo $this->input->post('name'); ?>" class="form-control" id="name" />
							<span class="text-danger"><?php echo form_error('name');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="product_title_format" class="control-label">Product Title Format</label>
						<div class="form-group">
							<input type="text" name="product_title_format" value="<?php echo $this->input->post('product_title_format'); ?>" class="form-control" id="product_title_format" />
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