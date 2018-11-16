<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Products Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('product/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Category Id</th>
						<th>Brand Id</th>
						<th>Color Id</th>
						<th>Condition Id</th>
						<th>Option Id</th>
						<th>Source</th>
						<th>Tracking No</th>
						<th>Cubic Feet</th>
						<th>Model No</th>
						<th>Serial No</th>
						<th>Feature1</th>
						<th>Feature2</th>
						<th>Feature3</th>
						<th>Price</th>
						<th>Comparable Price</th>
						<th>Height</th>
						<th>Width</th>
						<th>Depth</th>
						<th>Title</th>
						<th>Created</th>
						<th>Updated</th>
						<th>Description</th>
						<th>Tags</th>
						<th>Accessories</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($products as $p){ ?>
                    <tr>
						<td><?php echo $p['id']; ?></td>
						<td><?php echo $p['category_id']; ?></td>
						<td><?php echo $p['brand_id']; ?></td>
						<td><?php echo $p['color_id']; ?></td>
						<td><?php echo $p['condition_id']; ?></td>
						<td><?php echo $p['option_id']; ?></td>
						<td><?php echo $p['source']; ?></td>
						<td><?php echo $p['tracking_no']; ?></td>
						<td><?php echo $p['cubic_feet']; ?></td>
						<td><?php echo $p['model_no']; ?></td>
						<td><?php echo $p['serial_no']; ?></td>
						<td><?php echo $p['feature1']; ?></td>
						<td><?php echo $p['feature2']; ?></td>
						<td><?php echo $p['feature3']; ?></td>
						<td><?php echo $p['price']; ?></td>
						<td><?php echo $p['comparable_price']; ?></td>
						<td><?php echo $p['height']; ?></td>
						<td><?php echo $p['width']; ?></td>
						<td><?php echo $p['depth']; ?></td>
						<td><?php echo $p['title']; ?></td>
						<td><?php echo $p['created']; ?></td>
						<td><?php echo $p['updated']; ?></td>
						<td><?php echo $p['description']; ?></td>
						<td><?php echo $p['tags']; ?></td>
						<td><?php echo $p['accessories']; ?></td>
						<td>
                            <a href="<?php echo site_url('product/edit/'.$p['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('product/remove/'.$p['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
