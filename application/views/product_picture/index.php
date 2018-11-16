<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Product Pictures Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('product_picture/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Product Id</th>
						<th>Type</th>
						<th>Name</th>
						<th>Description</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($product_pictures as $p){ ?>
                    <tr>
						<td><?php echo $p['id']; ?></td>
						<td><?php echo $p['product_id']; ?></td>
						<td><?php echo $p['type']; ?></td>
						<td><?php echo $p['name']; ?></td>
						<td><?php echo $p['description']; ?></td>
						<td>
                            <a href="<?php echo site_url('product_picture/edit/'.$p['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('product_picture/remove/'.$p['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
