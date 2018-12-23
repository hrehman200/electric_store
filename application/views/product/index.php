<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Products Listing</h3>
                <div class="box-tools">
                    <?php if ($this->permission->has_permission('create_product')) { ?>
                    <a href="<?php echo site_url('product/add'); ?>" class="btn btn-success btn-sm">Add</a>
                    <?php } ?>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
                        <th>Tracking No</th>
                        <th>Model No</th>
                        <th>Serial No</th>
                        <th>Title</th>
                        <th></th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($products as $p) { ?>
                        <tr>
                            <td><?php echo $p['tracking_no']; ?></td>
                            <td><?php echo $p['model_no1']; ?></td>
                            <td><?php echo $p['serial_no1']; ?></td>
                            <td><?php echo $p['title']; ?></td>
                            <td>
                                <span class="fa fa-2x <?=$p['action_needed']?'fa-times text-danger':'fa-check text-success'?>"></span>
                            </td>
                            <td>
                                <?php if ($this->permission->has_permission('sticker')) { ?>
                                <a href="<?php echo site_url('product/sticker/' . $p['id']); ?>" class="btn btn-warning btn-xs" target="_blank"><span class="fa fa-certificate"></span> Sticker</a>
                                <?php } ?>

                                <?php if ($this->permission->has_permission('edit_product') ||
                                    $this->permission->has_permission('update_warranty')) { ?>
                                <a href="<?php echo site_url('product/add/' . $p['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a>
                                <?php } ?>

                                <?php if ($this->permission->has_permission('shopify_csv')) { ?>
                                    <a href="<?php echo site_url('product/shopify_csv/' . $p['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-save"></span> CSV</a>
                                <?php } ?>

                                <?php if ($this->permission->has_permission('delete_product')) { ?>
                                <a href="javascript:;" data-id="<?=$p['id']?>" class="btn btn-danger btn-xs btn-delete-product"><span class="fa fa-trash"></span> Delete</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function() {
    $('.btn-delete-product').on('click', function (e) {
        var response = confirm('Are you sure you want to delete this product?');
        var id = $(this).data('id');
        var parent = $(this).parents('tr');
        if(response) {
            $.ajax({
                url: '<?=base_url()?>product/remove/'+id,
                method: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result.success) {
                        $(parent).remove();
                    }
                }
            });
        }
    });
});
</script>

