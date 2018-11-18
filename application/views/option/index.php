<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Options Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('option/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Category Id</th>
						<th>Name</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($options as $o){ ?>
                    <tr>
						<td><?php echo $o['id']; ?></td>
						<td><?php echo $o['category']; ?></td>
						<td><?php echo $o['name']; ?></td>
						<td>
                            <a href="<?php echo site_url('option/edit/'.$o['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('option/remove/'.$o['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
