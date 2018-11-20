<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Product Add</h3>
            </div>
            <?php echo form_open('product/add'); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-3">
                        <label for="source" class="control-label">Source</label>
                        <div class="form-group">
                            <input type="text" name="source" value="<?php echo $this->input->post('source'); ?>"
                                   class="form-control" id="source"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="tracking_no" class="control-label">Tracking No</label>
                        <div class="form-group">
                            <input type="text" name="tracking_no"
                                   value="<?php echo $this->input->post('tracking_no'); ?>" class="form-control"
                                   id="tracking_no"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="model_no" class="control-label">Model No</label>
                        <div class="form-group">
                            <input type="text" name="model_no" value="<?php echo $this->input->post('model_no'); ?>"
                                   class="form-control" id="model_no"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="serial_no" class="control-label">Serial No</label>
                        <div class="form-group">
                            <input type="text" name="serial_no" value="<?php echo $this->input->post('serial_no'); ?>"
                                   class="form-control" id="serial_no"/>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-3" style="padding-left:0;">
                            <label for="category_id" class="control-label">Category</label>
                            <div class="form-group">
                                <select name="category_id" class="form-control selCategory">
                                    <?php
                                    echo $all_categories;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 hidden" style="padding-left:0;">
                            <label for="category_id" class="control-label">Subcategory</label>
                            <div class="form-group">
                                <select name="category_id" class="form-control selCategory">
                                    <?php
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 hidden" style="padding-left:0;">
                            <label for="category_id" class="control-label">Subcategory</label>
                            <div class="form-group">
                                <select name="category_id" class="form-control selCategory">
                                    <?php
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 hidden" style="padding-left:0;">
                            <label for="category_id" class="control-label">Subcategory</label>
                            <div class="form-group">
                                <select name="category_id" class="form-control selCategory">
                                    <?php
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 ">
                        <label for="option_id" class="control-label">Option</label>
                        <div class="form-group">
                            <select id="option_id" name="option_id" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="condition_id" class="control-label">Condition</label>
                        <div class="form-group">
                            <select name="condition_id" class="form-control">
                                <?php
                                foreach ($all_conditions as $condition) {
                                    $selected = ($condition['id'] == $this->input->post('condition_id')) ? ' selected="selected"' : "";

                                    echo '<option value="' . $condition['id'] . '" ' . $selected . '>' . $condition['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="brand_id" class="control-label">Brand</label>
                        <div class="form-group">
                            <select name="brand_id" class="form-control">
                                <?php
                                foreach ($all_brands as $brand) {
                                    $selected = ($brand['id'] == $this->input->post('brand_id')) ? ' selected="selected"' : "";

                                    echo '<option value="' . $brand['id'] . '" ' . $selected . '>' . $brand['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="color_id" class="control-label">Color</label>
                        <div class="form-group">
                            <select name="color_id" class="form-control">
                                <?php
                                foreach ($all_colors as $color) {
                                    $selected = ($color['id'] == $this->input->post('color_id')) ? ' selected="selected"' : "";

                                    echo '<option value="' . $color['id'] . '" ' . $selected . '>' . $color['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="cubic_feet" class="control-label">Cubic Feet</label>
                        <div class="form-group">
                            <input type="text" name="cubic_feet" value="<?php echo $this->input->post('cubic_feet'); ?>"
                                   class="form-control" id="cubic_feet"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="feature1" class="control-label">Feature1</label>
                        <div class="form-group">
                            <input type="text" name="feature1" value="<?php echo $this->input->post('feature1'); ?>"
                                   class="form-control" id="feature1"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="feature2" class="control-label">Feature2</label>
                        <div class="form-group">
                            <input type="text" name="feature2" value="<?php echo $this->input->post('feature2'); ?>"
                                   class="form-control" id="feature2"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="feature3" class="control-label">Feature3</label>
                        <div class="form-group">
                            <input type="text" name="feature3" value="<?php echo $this->input->post('feature3'); ?>"
                                   class="form-control" id="feature3"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="price" class="control-label">Price</label>
                        <div class="form-group">
                            <input type="text" name="price" value="<?php echo $this->input->post('price'); ?>"
                                   class="form-control" id="price"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="comparable_price" class="control-label">Comparable Price</label>
                        <div class="form-group">
                            <input type="text" name="comparable_price"
                                   value="<?php echo $this->input->post('comparable_price'); ?>" class="form-control"
                                   id="comparable_price"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="height" class="control-label">Height</label>
                        <div class="form-group">
                            <input type="text" name="height" value="<?php echo $this->input->post('height'); ?>"
                                   class="form-control" id="height"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="width" class="control-label">Width</label>
                        <div class="form-group">
                            <input type="text" name="width" value="<?php echo $this->input->post('width'); ?>"
                                   class="form-control" id="width"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="depth" class="control-label">Depth</label>
                        <div class="form-group">
                            <input type="text" name="depth" value="<?php echo $this->input->post('depth'); ?>"
                                   class="form-control" id="depth"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="title" class="control-label">Title</label>
                        <div class="form-group">
                            <input type="text" name="title" value="<?php echo $this->input->post('title'); ?>"
                                   class="form-control" id="title"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="description" class="control-label">Description</label>
                        <div class="form-group">
                            <textarea name="description" class="form-control"
                                      id="description"><?php echo $this->input->post('description'); ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="tags" class="control-label">Tags</label>
                        <div class="form-group">
                            <textarea name="tags" class="form-control"
                                      id="tags"><?php echo $this->input->post('tags'); ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="accessories" class="control-label">Accessories</label>
                        <div class="form-group">
                            <textarea name="accessories" class="form-control"
                                      id="accessories"><?php echo $this->input->post('accessories'); ?></textarea>
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

<script type="text/javascript">
    $(function () {
        $('.selCategory').on('change', function(e) {

            var parentDiv = $(this).parent().parent();
            var categoryId = $(this).val();
            var nextDiv = $(parentDiv).next('div');
            var selCategory = $(nextDiv).find('.selCategory');

            $('#option_id').html('');

            $.ajax({
                url: '<?=base_url()?>ajax/get_options/'+categoryId,
                method: 'GET',
                dataType: 'json',
                success: function(result) {
                    if(result.length > 0) {
                        for (var i in result) {
                            $('#option_id').append('<option value="' + result[i].id + '">' + result[i].name + '</option>')
                        }
                    }
                }
            });

            $.ajax({
                url: '<?=base_url()?>ajax/get_categories/'+categoryId,
                method: 'GET',
                dataType: 'json',
                success: function(result) {
                    $(selCategory).find('option').remove();
                    if(result.length > 0) {
                        $(nextDiv).removeClass('hidden');
                        for (var i in result) {
                            $(selCategory).append('<option value="' + result[i].id + '">' + result[i].name + '</option>')
                        }
                        $(selCategory).trigger('change');
                    } else {
                        $(nextDiv).addClass('hidden').nextAll('div').addClass('hidden');
                    }
                }
            });
        }).trigger('change');
    });
</script>