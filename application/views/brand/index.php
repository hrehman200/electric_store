<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Brands Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('brand/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Name</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($brands as $b){ ?>
                    <tr>
						<td><?php echo $b['name']; ?></td>
						<td>
                            <a href="<?php echo site_url('brand/edit/'.$b['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('brand/remove/'.$b['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
