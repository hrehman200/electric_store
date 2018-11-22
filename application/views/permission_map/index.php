<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Permission Map Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('permission_map/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Group</th>
						<th>Permission</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($permission_map as $p){ ?>
                    <tr>
						<td><?php echo $p['name']; ?></td>
						<td><?php echo $p['permission']; ?></td>
						<td>
                            <a href="<?php echo site_url('permission_map/remove/'.$p['groupID']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
