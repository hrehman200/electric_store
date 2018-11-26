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
                        <th>Tracking No</th>
                        <th>Model No</th>
                        <th>Serial No</th>
						<th>Title</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($products as $p){ ?>
                    <tr>
						<td><?php echo $p['tracking_no']; ?></td>
						<td><?php echo $p['model_no']; ?></td>
						<td><?php echo $p['serial_no']; ?></td>
						<td><?php echo $p['title']; ?></td>
						<td>
                            <a href="<?php echo site_url('product/sticker/'.$p['id']); ?>" class="btn btn-warning btn-xs" target="_blank"><span class=""></span> Sticker</a>
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
