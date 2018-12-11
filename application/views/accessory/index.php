<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Accessories Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('accessory/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Category</th>
                        <th>Options</th>
						<th>Name</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($accessories as $a){ ?>
                    <tr>
						<td><?php echo $a['id']; ?></td>
						<td><?php echo $a['category']; ?></td>
                        <td><?php echo $a['option']; ?></td>
						<td><?php echo $a['name']; ?></td>
						<td>
                            <a href="<?php echo site_url('accessory/remove/'.$a['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
