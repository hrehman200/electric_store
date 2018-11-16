<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Users Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('user/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Password</th>
						<th>Username</th>
						<th>Email</th>
						<th>Last Signin</th>
						<th>Created Date</th>
						<th>Ip</th>
						<th>Verification Key</th>
						<th>Admin Group</th>
						<th>Name</th>
						<th>Address</th>
						<th>Address2</th>
						<th>City</th>
						<th>State</th>
						<th>Zip</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($users as $u){ ?>
                    <tr>
						<td><?php echo $u['id']; ?></td>
						<td><?php echo $u['password']; ?></td>
						<td><?php echo $u['username']; ?></td>
						<td><?php echo $u['email']; ?></td>
						<td><?php echo $u['last_signin']; ?></td>
						<td><?php echo $u['created_date']; ?></td>
						<td><?php echo $u['ip']; ?></td>
						<td><?php echo $u['verification_key']; ?></td>
						<td><?php echo $u['admin_group']; ?></td>
						<td><?php echo $u['name']; ?></td>
						<td><?php echo $u['address']; ?></td>
						<td><?php echo $u['address2']; ?></td>
						<td><?php echo $u['city']; ?></td>
						<td><?php echo $u['state']; ?></td>
						<td><?php echo $u['zip']; ?></td>
						<td>
                            <a href="<?php echo site_url('user/edit/'.$u['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('user/remove/'.$u['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
