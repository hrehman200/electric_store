<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Permission Map Add</h3>
            </div>
            <?php echo form_open('permission_map/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
                    <div class="col-md-2">
                        <label for="product_title_format" class="control-label">Permission</label>
                        <div class="form-group">
                            <select name="permissionID">
                                <?php
                                foreach($permissions as $p) {
                                    echo sprintf('<option value="%d">%s</option>', $p['permissionID'], $p['permission']);
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="product_title_format" class="control-label">Group</label>
                        <div class="form-group">
                            <select name="groupID">
                                <?php
                                foreach($permission_groups as $pg) {
                                    echo sprintf('<option value="%d">%s</option>', $pg['id'], $pg['name']);
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