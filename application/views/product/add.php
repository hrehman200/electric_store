<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Product Add</h3>
            </div>
            <?php echo form_open('product/add/'.($editing)?$product['id']:''); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-3">
                        <label for="tracking_no" class="control-label">Tracking No</label>
                        <div class="form-group">
                            <input type="text" name="tracking_no"
                                   value="<?php echo ($editing ? $product['tracking_no'] :  $this->input->post('tracking_no')); ?>" class="form-control"
                                   id="tracking_no"/>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-3" style="padding-left:0;">
                            <label for="category_id" class="control-label">Category</label>
                            <div class="form-group">
                                <select name="category_id1[]" class="form-control selCategory" data-index="0">
                                    <?php
                                    echo $all_categories;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 hidden" style="padding-left:0;">
                            <label for="category_id" class="control-label">Subcategory</label>
                            <div class="form-group">
                                <select name="category_id1[]" class="form-control selCategory" data-index="1">
                                    <?php
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 hidden" style="padding-left:0;">
                            <label for="category_id" class="control-label">Subcategory</label>
                            <div class="form-group">
                                <select name="category_id1[]" class="form-control selCategory" data-index="2">
                                    <?php
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 hidden" style="padding-left:0;">
                            <label for="category_id" class="control-label">Subcategory</label>
                            <div class="form-group">
                                <select name="category_id1[]" class="form-control selCategory" data-index="3">
                                    <?php
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row title-row hidden">
                    <div class="col-md-6">
                        <label for="title" class="control-label">Title</label>
                        <div class="form-group ">
                            <input type="text" name="title" value="<?php echo ($editing ? $product['title'] :  $this->input->post('title')); ?>"
                                   class="form-control" id="title"/>
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
                                    <select name="category_id1[]" class="form-control selCategory" data-index="4">
                                        <?php
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 hidden" style="padding-left:0;">
                                <label for="category_id" class="control-label">Subcategory</label>
                                <div class="form-group">
                                    <select name="category_id1[]" class="form-control selCategory" data-index="5">
                                        <?php
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 ">
                            <label for="option_id" class="control-label">Option</label>
                            <div class="form-group">
                                <div class="checkbox options1" data-index="1">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="source1" class="control-label">Source</label>
                            <div class="form-group">
                                <input type="text" name="source1" value="<?php echo ($editing ? $product['source1'] :  $this->input->post('source1')); ?>"
                                       class="form-control source" id="source1" data-index="1" maxlength="2" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="model_no1" class="control-label">Model No</label>
                            <div class="form-group">
                                <input type="text" name="model_no1" value="<?php echo ($editing ? $product['model_no1'] :  $this->input->post('model_no1')); ?>"
                                       class="form-control" id="model_no1"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="serial_no1" class="control-label">Serial No</label>
                            <div class="form-group">
                                <input type="text" name="serial_no1" value="<?php echo ($editing ? $product['serial_no1'] :  $this->input->post('serial_no1')); ?>"
                                       class="form-control" id="serial_no1"/>
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
                                        if($editing) {
                                            $selected = ($condition['id'] == $product['condition_id1') ? ' selected="selected"' : "";
                                        } else {
                                            $selected = ($condition['id'] == $this->input->post('condition_id1')) ? ' selected="selected"' : "";
                                        }
                                        echo sprintf('<option value="%d" %s data-description="%s">%s</option>', $condition['id'], $selected, $condition['description'], $condition['name']);
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
                                <input type="date" name="condition_date_1" id="condition_date_1" value="<?php echo ($editing ? $product['warranty_date1'] :  $this->input->post('condition_date_1')); ?>"
                                       style="display: inline-flex;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="height" class="control-label">Height</label>
                            <div class="form-group">
                                <input type="text" name="height1" value="<?php echo ($editing ? $product['height1'] :  $this->input->post('height1')); ?>"
                                       class="form-control" id="height1"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="width" class="control-label">Width</label>
                            <div class="form-group">
                                <input type="text" name="width1" value="<?php echo ($editing ? $product['width1'] :  $this->input->post('width1')); ?>"
                                       class="form-control" id="width1"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="depth" class="control-label">Depth</label>
                            <div class="form-group">
                                <input type="text" name="depth1" value="<?php echo ($editing ? $product['depth1'] :  $this->input->post('depth1')); ?>"
                                       class="form-control" id="depth1"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="brand_id1" class="control-label">Brand</label>
                            <div class="form-group">
                                <select name="brand_id1" class="form-control">
                                    <?php
                                    foreach ($all_brands as $brand) {
                                        if($editing) {
                                            $selected = ($brand['id'] == $product['brand_id1') ? ' selected="selected"' : "";
                                        } else {
                                            $selected = ($brand['id'] == $this->input->post('brand_id1')) ? ' selected="selected"' : "";
                                        }
                                        echo '<option value="' . $brand['id'] . '" ' . $selected . '>' . $brand['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="color_id1" class="control-label">Color</label>
                            <div class="form-group">
                                <select name="color_id1" class="form-control">
                                    <?php
                                    foreach ($all_colors as $color) {
                                        if($editing) {
                                            $selected = ($color['id'] == $product['color_id1']) ? ' selected="selected"' : "";
                                        } else {
                                            $selected = ($color['id'] == $this->input->post('color_id1')) ? ' selected="selected"' : "";
                                        }
                                        echo '<option value="' . $color['id'] . '" ' . $selected . '>' . $color['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="cubic_feet1" class="control-label">Cubic Feet</label>
                            <div class="form-group">
                                <input type="text" name="cubic_feet1" value="<?php echo ($editing ? $product['cubic_feet1'] :  $this->input->post('cubic_feet1')); ?>"
                                       class="form-control" id="cubic_feet1"/>
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
                                <select name="category_id2[]" class="form-control selCategory" data-index="6">
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
                                <div class="checkbox options2" data-index="2">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="source2" class="control-label">Source</label>
                            <div class="form-group">
                                <input type="text" name="source2" value="<?php echo ($editing ? $product['source2'] :  $this->input->post('source2')); ?>"
                                       class="form-control source" id="source2" data-index="2" maxlength="2" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="model_no2" class="control-label">Model No</label>
                            <div class="form-group">
                                <input type="text" name="model_no2" value="<?php echo ($editing ? $product['model_no2'] :  $this->input->post('model_no2')); ?>"
                                       class="form-control" id="model_no2"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="serial_no2" class="control-label">Serial No</label>
                            <div class="form-group">
                                <input type="text" name="serial_no2" value="<?php echo ($editing ? $product['serial_no2'] :  $this->input->post('serial_no2')); ?>"
                                       class="form-control" id="serial_no2"/>
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
                                        if($editing) {
                                            $selected = ($condition['id'] == $product['condition_id2']) ? ' selected="selected"' : "";
                                        } else {
                                            $selected = ($condition['id'] == $this->input->post('condition_id2')) ? ' selected="selected"' : "";
                                        }
                                        echo sprintf('<option value="%d" %s data-description="%s">%s</option>', $condition['id'], $selected, $condition['description'], $condition['name']);
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
                                <input type="date" name="condition_date_2" id="condition_date_2" value="<?php echo ($editing ? $product['warranty_date2'] :  $this->input->post('condition_date_2')); ?>"
                                       style="display: inline-flex;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="height" class="control-label">Height</label>
                            <div class="form-group">
                                <input type="text" name="height2" value="<?php echo ($editing ? $product['height2'] :  $this->input->post('height2')); ?>"
                                       class="form-control" id="height2"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="width" class="control-label">Width</label>
                            <div class="form-group">
                                <input type="text" name="width2" value="<?php echo ($editing ? $product['width2'] :  $this->input->post('width2')); ?>"
                                       class="form-control" id="width2"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="depth" class="control-label">Depth</label>
                            <div class="form-group">
                                <input type="text" name="depth2" value="<?php echo ($editing ? $product['depth2'] :  $this->input->post('depth2')); ?>"
                                       class="form-control" id="depth2"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="brand_id2" class="control-label">Brand</label>
                            <div class="form-group">
                                <select name="brand_id2" class="form-control">
                                    <?php
                                    foreach ($all_brands as $brand) {
                                        if($editing) {
                                            $selected = ($brand['id'] == $product['brand_id2']) ? ' selected="selected"' : "";
                                        } else {
                                            $selected = ($brand['id'] == $this->input->post('brand_id2')) ? ' selected="selected"' : "";
                                        }
                                        echo '<option value="' . $brand['id'] . '" ' . $selected . '>' . $brand['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="color_id1" class="control-label">Color</label>
                            <div class="form-group">
                                <select name="color_id2" class="form-control">
                                    <?php
                                    foreach ($all_colors as $color) {
                                        if($editing) {
                                            $selected = ($color['id'] == $product['color_id2']) ? ' selected="selected"' : "";
                                        } else {
                                            $selected = ($color['id'] == $this->input->post('color_id2')) ? ' selected="selected"' : "";
                                        }
                                        echo '<option value="' . $color['id'] . '" ' . $selected . '>' . $color['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="cubic_feet1" class="control-label">Cubic Feet</label>
                            <div class="form-group">
                                <input type="text" name="cubic_feet2" value="<?php echo ($editing ? $product['cubic_feet2'] :  $this->input->post('cubic_feet2')); ?>"
                                       class="form-control" id="cubic_feet2"/>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <div class="row">
                    <div class="col-md-4">
                        <label for="feature1" class="control-label">Feature1</label>
                        <div class="form-group">
                            <input type="text" name="feature1" value="<?php echo ($editing ? $product['feature1'] :  $this->input->post('feature1')); ?>"
                                   class="form-control" id="feature1"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="feature2" class="control-label">Feature2</label>
                        <div class="form-group">
                            <input type="text" name="feature2" value="<?php echo ($editing ? $product['feature2'] :  $this->input->post('feature2')); ?>"
                                   class="form-control" id="feature2"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="feature3" class="control-label">Feature3</label>
                        <div class="form-group">
                            <input type="text" name="feature3" value="<?php echo ($editing ? $product['feature3'] :  $this->input->post('feature3')); ?>"
                                   class="form-control" id="feature3"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="price" class="control-label">Price</label>
                        <div class="form-group">
                            <input type="text" name="price" value="<?php echo ($editing ? $product['price'] :  $this->input->post('price')); ?>"
                                   class="form-control" id="price"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="comparable_price" class="control-label">Comparable Price</label>
                        <div class="form-group">
                            <input type="text" name="comparable_price"
                                   value="<?php echo ($editing ? $product['comparable_price'] :  $this->input->post('comparable_price')); ?>" class="form-control"
                                   id="comparable_price"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="description" class="control-label">Description</label>
                        <div class="form-group">
                            <textarea name="description" class="form-control"
                                      id="description"><?php echo ($editing ? $product['description'] :  $this->input->post('description')); ?></textarea>
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

        function toggleWasherDryerSet() {

            if($('.selCategory:first').val() == <?=WASHER_DRYER_SET?>) {
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

            var index = $(optionsDiv).closest('.checkbox').data('index');

            $.ajax({
                url: '<?=base_url()?>ajax/get_options/' + categoryId,
                method: 'GET',
                dataType: 'json',
                success: function (result) {
                    if (result.length > 0) {
                        $(optionsDiv).html('');
                        for (var i in result) {
                            $(optionsDiv).append('<label><input type="checkbox" name="option_id'+index+'[]" value="' + result[i].id + '">' + result[i].name + '</label><br/>');
                        }
                        <?php
                        if($editing) {
                        ?>
                            var arrOptionIds1 = $.parseJSON('<?=json_encode($product['option_id1_arr'])?>');
                            var arrOptionIds2 = $.parseJSON('<?=json_encode($product['option_id2_arr'])?>');
                            if(index == 1) {
                                for(var i in arrOptionIds1) {
                                    console.log($(optionsDiv).find('input[value="'+arrOptionIds1[i]+'"]'));
                                    $(optionsDiv).find('input[value="'+arrOptionIds1[i]+'"]').prop('checked', true);
                                }
                            } else {
                                for(var i in arrOptionIds2) {
                                    $(optionsDiv).find('input[value="'+arrOptionIds2[i]+'"]').prop('checked', true);
                                }
                            }
                        <?php
                        }
                        ?>
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
                        <?php
                        if($editing) {
                        ?>
                            var arrCategoryIds1 = $.parseJSON('<?=json_encode($product['category_id1_arr'])?>');
                            var index = $(selCategory).data('index');
                            $(selCategory).val(arrCategoryIds1[index]);
                        <?php
                        }
                        ?>
                        $(selCategory).trigger('change');
                    } else {
                        $(nextDiv).addClass('hidden').nextAll('div').addClass('hidden');
                        getOptions(categoryId, optionsDiv);
                    }
                }
            });
        }

        $('.selCategory').on('change', function (e) {

            if($('.selCategory:first').val() == <?=MISCELLANIOUS?>) {
                $('.title-row').removeClass('hidden').find('#title').val('');
            } else {
                $('.title-row').addClass('hidden').find('#title').val('');
            }

            var parentDiv = $(this).parent().parent();
            var categoryId = $(this).val();
            var nextDiv = $(parentDiv).next('div');
            var selCategory = $(nextDiv).find('.selCategory');
            var optionsDiv = $(parentDiv).closest('fieldset').find('.checkbox');
            if(optionsDiv.length == 0) {
                optionsDiv = $('.options1');
            }
            toggleWasherDryerSet();

            if($('.selCategory:first').val() == <?=WASHER_DRYER_SET?> && $(this)[0] == $('.selCategory:first')[0]) {
                selCategory = $('.selCategory:eq(4)');
                nextDiv = $(selCategory).parent().parent().next('div');
                getCategories(<?=WASHER?>, selCategory, nextDiv, optionsDiv);

                selCategory = $('.selCategory:eq(6)');
                nextDiv = $(selCategory).parent().parent().next('div');
                getCategories(<?=DRYER?>, selCategory, nextDiv, optionsDiv);

            } else {
                getCategories(categoryId, selCategory, nextDiv, optionsDiv);
            }
        });

        <?php
        if($editing) {
            ?>
            $('.selCategory:first').val(<?=$product['category_id1_arr'][0]?>);
            <?php
        }
        ?>
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

        $('.source').keyup(function(e) {
            var source = $(this).val().trim();
            var index = $(this).data('index');
            var arrSources = ['<?=implode("','", SOURCES_TO_APPLY_REFURBISHED_CONDITION)?>'];
            if($.inArray(source, arrSources) != -1) {
                $('#condition_id'+index)
                    .find('option:last').prop('selected', true).end()
                    .change();
            } else {
                $('#condition_id'+index)
                    .find('option:first').prop('selected', true).end()
                    .change();
            }
        });

    });
</script>