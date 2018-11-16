<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Color Category Map Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('color_category_map/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Default</th>
						<th>Category Id</th>
						<th>Color Id</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($color_category_map as $c){ ?>
                    <tr>
						<td><?php echo $c['default']; ?></td>
						<td><?php echo $c['category_id']; ?></td>
						<td><?php echo $c['color_id']; ?></td>
						<td>
                            <a href="<?php echo site_url('color_category_map/edit/'.$c['']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('color_category_map/remove/'.$c['']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
