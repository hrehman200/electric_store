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

                <fieldset class="fieldset-border">
                    <legend class="fieldset-border"> Washer</legend>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="col-md-3 hidden" style="padding-left:0;">
                                <label for="category_id" class="control-label">Subcategory</label>
                                <div class="form-group">
                                    <select name="category_id[]" class="form-control selCategory">
                                        <?php
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 hidden" style="padding-left:0;">
                                <label for="category_id" class="control-label">Subcategory</label>
                                <div class="form-group">
                                    <select name="category_id[]" class="form-control selCategory">
                                        <?php
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 ">
                            <label for="option_id" class="control-label">Option</label>
                            <div class="form-group">
                                <div class="checkbox options1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="condition_id" class="control-label">Condition</label>
                            <div class="form-group">
                                <select name="condition_id1" id="condition_id1" class="form-control" data-index="1">
                                    <?php
                                    foreach ($all_conditions as $condition) {
                                        echo sprintf('<option value="%d" data-description="%s">%s</option>', $condition['id'], $condition['description'], $condition['name']);
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="condition_id" class="control-label">Warranty</label>
                            <div class="form-group">
                                <span name="condition_warranties_txt_1" id="condition_warranties_txt_1"
                                      style="display: none;"></span>
                                <input type="date" name="condition_date_1" id="condition_date_1" value=""
                                       style="display: inline-flex;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="height" class="control-label">Height</label>
                            <div class="form-group">
                                <input type="text" name="height1" value="<?php echo $this->input->post('height1'); ?>"
                                       class="form-control" id="height1"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="width" class="control-label">Width</label>
                            <div class="form-group">
                                <input type="text" name="width1" value="<?php echo $this->input->post('width1'); ?>"
                                       class="form-control" id="width1"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="depth" class="control-label">Depth</label>
                            <div class="form-group">
                                <input type="text" name="depth1" value="<?php echo $this->input->post('depth1'); ?>"
                                       class="form-control" id="depth1"/>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="fieldset-border">
                    <legend class="fieldset-border"> Dryer</legend>

                    <div class="row">
                        <div class="col-md-3 hidden">
                            <label for="category_id" class="control-label">Subcategory</label>
                            <div class="form-group">
                                <select name="category_id[]" class="form-control selCategory">
                                    <?php
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 ">
                            <label for="option_id" class="control-label">Option</label>
                            <div class="form-group">
                                <div class="checkbox options2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="condition_id" class="control-label">Condition</label>
                            <div class="form-group">
                                <select name="condition_id2" id="condition_id2" class="form-control" data-index="2">
                                    <?php
                                    foreach ($all_conditions as $condition) {
                                        echo sprintf('<option value="%d" data-description="%s">%s</option>', $condition['id'], $condition['description'], $condition['name']);
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="condition_id" class="control-label">Warranty</label>
                            <div class="form-group">
                                <span name="condition_warranties_txt_2" id="condition_warranties_txt_2"
                                      style="display: none;"></span>
                                <input type="date" name="condition_date_2" id="condition_date_2" value=""
                                       style="display: inline-flex;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="height" class="control-label">Height</label>
                            <div class="form-group">
                                <input type="text" name="height2" value="<?php echo $this->input->post('height2'); ?>"
                                       class="form-control" id="height2"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="width" class="control-label">Width</label>
                            <div class="form-group">
                                <input type="text" name="width2" value="<?php echo $this->input->post('width2'); ?>"
                                       class="form-control" id="width2"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="depth" class="control-label">Depth</label>
                            <div class="form-group">
                                <input type="text" name="depth2" value="<?php echo $this->input->post('depth2'); ?>"
                                       class="form-control" id="depth2"/>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <div class="row">
                    <div class="col-md-4">
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
                    <div class="col-md-4">
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
                    <div class="col-md-4">
                        <label for="cubic_feet" class="control-label">Cubic Feet</label>
                        <div class="form-group">
                            <input type="text" name="cubic_feet" value="<?php echo $this->input->post('cubic_feet'); ?>"
                                   class="form-control" id="cubic_feet"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="feature1" class="control-label">Feature1</label>
                        <div class="form-group">
                            <input type="text" name="feature1" value="<?php echo $this->input->post('feature1'); ?>"
                                   class="form-control" id="feature1"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="feature2" class="control-label">Feature2</label>
                        <div class="form-group">
                            <input type="text" name="feature2" value="<?php echo $this->input->post('feature2'); ?>"
                                   class="form-control" id="feature2"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="feature3" class="control-label">Feature3</label>
                        <div class="form-group">
                            <input type="text" name="feature3" value="<?php echo $this->input->post('feature3'); ?>"
                                   class="form-control" id="feature3"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="price" class="control-label">Price</label>
                        <div class="form-group">
                            <input type="text" name="price" value="<?php echo $this->input->post('price'); ?>"
                                   class="form-control" id="price"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="comparable_price" class="control-label">Comparable Price</label>
                        <div class="form-group">
                            <input type="text" name="comparable_price"
                                   value="<?php echo $this->input->post('comparable_price'); ?>" class="form-control"
                                   id="comparable_price"/>
                        </div>
                    </div>
                </div>
                <div class="row">
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

<style>
    legend {
        width: auto;
    }

    fieldset.fieldset-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;
        background-color: #eeeeee;
    }
</style>

<script type="text/javascript">
    $(function () {

        var WASHER_DRYER_SET_ID = 34;
        var WASHER_ID = 35;
        var DRYER_ID = 38;

        function toggleWasherDryerSet() {

            if($('.selCategory:first').val() == WASHER_DRYER_SET_ID) {
                $('.selCategory:eq(1), .selCategory:eq(2), .selCategory:eq(3)').parent().parent().addClass('hidden');
                $('.selCategory:eq(4), .selCategory:eq(5), .selCategory:eq(6), .selCategory:eq(7), .selCategory:eq(8)').parent().parent().removeClass('hidden');

                $('legend').show();
                $('fieldset').addClass('fieldset-border');
                $('fieldset:eq(1)').show();
            } else {
                $('.selCategory:eq(1), .selCategory:eq(2), .selCategory:eq(3)').parent().parent().removeClass('hidden');
                $('.selCategory:eq(4), .selCategory:eq(5), .selCategory:eq(6), .selCategory:eq(7), .selCategory:eq(8)').parent().parent().addClass('hidden');

                $('legend').hide();
                $('fieldset').removeClass('fieldset-border');
                $('fieldset:eq(1)').hide();
            }
        }

        function getOptions(categoryId, optionsDiv) {

            console.log(optionsDiv);

            $.ajax({
                url: '<?=base_url()?>ajax/get_options/' + categoryId,
                method: 'GET',
                dataType: 'json',
                success: function (result) {
                    if (result.length > 0) {
                        $(optionsDiv).html('');
                        for (var i in result) {
                            $(optionsDiv).append('<label><input type="checkbox" name="option_id2[]" value="' + result[i].id + '">' + result[i].name + '</label><br/>');
                        }
                    }
                }
            });
        }

        function getCategories(categoryId, selCategory, nextDiv, optionsDiv) {
            $.ajax({
                url: '<?=base_url()?>ajax/get_categories/' + categoryId,
                method: 'GET',
                dataType: 'json',
                async: false,
                success: function (result) {
                    $(selCategory).find('option').remove();
                    if (result.length > 0) {
                        $(nextDiv).removeClass('hidden');
                        for (var i in result) {
                            $(selCategory).append('<option value="' + result[i].id + '">' + result[i].name + '</option>')
                        }
                        $(selCategory).trigger('change');
                    } else {
                        $(nextDiv).addClass('hidden').nextAll('div').addClass('hidden');
                        getOptions(categoryId, optionsDiv);
                    }
                }
            });
        }

        $('.selCategory').on('change', function (e) {

            var parentDiv = $(this).parent().parent();
            var categoryId = $(this).val();
            var nextDiv = $(parentDiv).next('div');
            var selCategory = $(nextDiv).find('.selCategory');
            var optionsDiv = $(parentDiv).closest('fieldset').find('.checkbox');
            if(optionsDiv.length == 0) {
                optionsDiv = $('.options1');
            }
            toggleWasherDryerSet();

            if($('.selCategory:first').val() == WASHER_DRYER_SET_ID && $(this)[0] == $('.selCategory:first')[0]) {
                selCategory = $('.selCategory:eq(4)');
                nextDiv = $(selCategory).parent().parent().next('div');
                getCategories(WASHER_ID, selCategory, nextDiv, optionsDiv);

                selCategory = $('.selCategory:eq(6)');
                nextDiv = $(selCategory).parent().parent().next('div');
                getCategories(DRYER_ID, selCategory, nextDiv, optionsDiv);

            } else {
                getCategories(categoryId, selCategory, nextDiv, optionsDiv);
            }
        });

        $('.selCategory:first').trigger('change');

        $('#condition_id1, #condition_id2').on('change', function (e) {
            var index = $(this).data('index');
            var description = $(this).find('option:selected').data('description');
            if ($(this).val() == 3) {
                $('#condition_date_' + index).show();
                $('#condition_warranties_txt_' + index).hide();
            } else {
                $('#condition_date_' + index).hide();
                $('#condition_warranties_txt_' + index).show().html(description);
            }
        }).trigger('change');

    });
</script>