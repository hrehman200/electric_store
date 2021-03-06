<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Accessory Add</h3>
            </div>
            <?php echo form_open('accessory/add'); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="category_id" class="control-label">Category</label>
                        <div class="form-group">
                            <select name="category_id" class="form-control">
                                <option value="">select category</option>
                                <?php
                                foreach ($all_categories as $category) {
                                    $selected = ($category['id'] == $this->input->post('category_id')) ? ' selected="selected"' : "";

                                    echo '<option value="' . $category['id'] . '" ' . $selected . '>' . $category['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="category_id" class="control-label">Options</label>
                        <div class="form-group">
                            <select name="option_id[]" class="form-control" multiple>
                                <option value="">select options</option>
                                <?php
                                foreach ($options as $option) {
                                    $selected = ($option['id'] == $this->input->post('option_id')) ? ' selected="selected"' : "";

                                    echo '<option value="' . $option['id'] . '" ' . $selected . '>' . $option['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="control-label">Name</label>
                        <div class="form-group">
                            <input type="text" name="name" value="<?php echo $this->input->post('name'); ?>"
                                   class="form-control" id="name"/>
                            <span class="text-danger"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Save
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>