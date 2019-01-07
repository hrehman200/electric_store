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
                <table class="table table-striped" id="tblProducts">
                    <thead>
                    <tr>
                        <th>Tracking No</th>
                        <th>Model No</th>
                        <th>Serial No</th>
                        <th>Title</th>
                        <th></th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<script type="text/javascript">
$(function() {
    $('#tblProducts').on('click', '.btn-delete-product', function (e) {
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

    $('#tblProducts').DataTable({
        ordering: false,
        searching: false,
        ajax: '<?=base_url()?>ajax/get_products',
        columns: [
            { data: 'tracking_no'},
            { data: 'model_no1'},
            { data: 'serial_no1'},
            { data: 'title'},
            { data: 'action_needed'},
            { data: 'buttons'}
        ]
    });
});
</script>

