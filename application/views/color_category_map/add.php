<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Color Category Map Add</h3>
            </div>
            <?php echo form_open('color_category_map/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<div class="form-group">
							<input type="checkbox" name="default" value="1"  id="default" />
							<label for="default" class="control-label">Default</label>
						</div>
					</div>
					<div class="col-md-6">
						<label for="category_id" class="control-label">Category</label>
						<div class="form-group">
							<select name="category_id" class="form-control">
								<option value="">select category</option>
								<?php 
								foreach($all_categories as $category)
								{
									$selected = ($category['id'] == $this->input->post('category_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$category['id'].'" '.$selected.'>'.$category['id'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="color_id" class="control-label">Color</label>
						<div class="form-group">
							<select name="color_id" class="form-control">
								<option value="">select color</option>
								<?php 
								foreach($all_colors as $color)
								{
									$selected = ($color['id'] == $this->input->post('color_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$color['id'].'" '.$selected.'>'.$color['id'].'</option>';
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