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

                                <?php if ($this->permission->has_permission('delete_product')) { ?>
                                <a href="<?php echo site_url('product/remove/' . $p['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>

            </div>
        </div>
    </div>
</div>

<script src="<?php echo site_url('resources/js/jquery.ui.widget.js'); ?>"></script>
<script src="<?php echo site_url('resources/js/jquery.iframe-transport.js'); ?>"></script>
<script src="<?php echo site_url('resources/js/jquery.fileupload.js'); ?>"></script>
<script src="<?php echo site_url('resources/js/jquery.fileupload-process.js'); ?>"></script>
<script src="<?php echo site_url('resources/js/jquery.fileupload-validate.js'); ?>"></script>
<script src="<?php echo site_url('resources/js/jquery.fileupload-ui.js'); ?>"></script>

<div class="modal" id="uploadModal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static"
     style="overflow: hidden">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Add new file</h4>

            </div>
            <div class="modal-body" id="modal-body">
                <div id="upload">
                    <div id="drop">Drop files here<a>Browse</a>

                        <input type="file" name="upl" multiple="multiple"/>
                    </div>
                    <div class="fileupload-buttonbar">
                        <div>
                            <button type="submit" class="btn btn-success start"><i
                                        class="glyphicon glyphicon-upload"></i><span>Start upload</span>

                            </button>
                            <button type="reset" class="btn btn-warning cancel"><i
                                        class="glyphicon glyphicon-upload"></i><span>Clear upload</span>

                            </button>
                            <button type="reset" class="btn btn-danger cancel"><i
                                        class="glyphicon glyphicon-ban-circle"></i><span>Cancel All</span>

                            </button>
                        </div>
                    </div>
                    <!-- The table listing the files available for upload/download -->
                    <!--<table class="table table-striped">
                        <tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody>
                    </table>-->
                    <ol class="files upload-files-list"></ol>
                    <!--files go here-->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    #uploadModal {
        min-width: 600px;
    }

    .upload-file .start {
        display: none;
    }

    .modal-footer, .modal-header {
        padding: 10px;
    }

    .modal-header .close {
        margin-top: 3px;
    }

    ol.upload-files-list {
        /*border: 1px solid #b9b9b9;*/
        margin: 0;
        padding: 0 10px 10px 10px;
        border-left: none;
        border-right: none;
        overflow: hidden;
    }

    ol.upload-files-list .upload-file:last-child {
        border-bottom: 1px solid #ddd;
    }

    ol.upload-files-list .upload-file.template-download .error-col {
        float: right;
        ` `
    }

    ol.upload-files-list .upload-file.template-upload .error-col {
        float: left;
    }

    ol.upload-files-list .upload-file.template-upload .filesize-col {
        float: left;
        padding-right: 5px;
        padding-left: 5px;
        width: 80px;
    }

    ol.upload-files-list .upload-file {
        list-style: none;
        position: relative;
        margin: 0;
        height: 35px;
        line-height: 35px;
        border-top: 1px solid #ddd;
        border-left: 1px solid #ddd;
        border-right: 1px solid #ddd;
        vertical-align: bottom;
    }

    ol.upload-files-list .upload-file .upload-file-info {
        vertical-align: baseline;
        border-collapse: collapse;
        /*width: 100%;*/
        height: 35px;
        position: absolute;
        top: 0;
        left: 10px;
        right: 10px;
    }

    ol.upload-files-list .upload-file .upload-progress-bar {
        height: 33px;
        padding: 0;
        margin: 0;
    }

    .upload-file.complete .upload-progress-bar {
        background-color: #ebffd9;
    }

    .upload-file.error .upload-progress-bar {
        background-color: #FD9F9F;
    }

    .upload-file .upload-progress-bar {
        border-radius: 0;
        background-color: #e9f4ff;
    }

    .upload-files-list .upload-file .upload-file-info .filename-col {
        float: left;
        width: 310px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .upload-files-list .upload-file .upload-file-info div {
        display: block;
    }

    .upload-files-list .upload-file .upload-file-info .status-col {
        float: right;

    }

    .upload-files-list .upload-file .upload-file-info .actions-col {
        float: right;
    }

    .field-validation-error {
        color: red;
    }

    .fileupload-buttonbar {
        padding: 10px;
    }

    #openUpload {
        position: absolute;
        top: 50%;
        left: 50%;
        margin-left: -75px;
        width: 150px;
        margin-top: -25px;
        height: 50px;
    }

    .modal-content {
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .modal-body {
        padding: 0;
    }

    .modal-content, .btn {
        border-radius: 0;
    }

    .modal-backdrop {
        background-color: #fff;
    }

    .modal-footer {
        margin-top: 0 !important;
    }

    .modal-vertical-centered {
        transform: translate(0, 50%) !important;
        -ms-transform: translate(0, 50%) !important;
        /* IE 9 */
        -webkit-transform: translate(0, 50%) !important;
        /* Safari and Chrome */
    }

    #upload {
        font-family: 'PT Sans Narrow', sans-serif;
        /*background-color: #373a3d;
                background-image: -webkit-linear-gradient(top, #373a3d, #313437);
                background-image: -moz-linear-gradient(top, #373a3d, #313437);
                background-image: linear-gradient(top, #373a3d, #313437);
                /*width: 250px;*/
        /*padding: 30px;*/
        /*border-radius: 3px;*/
        /*margin: 200px auto 100px;*/
        /*box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);*/
        */
    }

    #drop {
        /*background-color: #2E3134;*/
        padding: 10px 10px 0px 10px;
        /*margin-bottom: 30px;*/
        /*border: 20px solid rgba(0, 0, 0, 0);*/
        /*border-radius: 3px;*/
        text-align: center;
        text-transform: uppercase;
        font-size: 16px;
        font-weight: bold;
        color: #7f858a;
    }

    #drop a {
        background-color: #007a96;
        padding: 12px 26px;
        color: #fff;
        font-size: 14px;
        border-radius: 2px;
        cursor: pointer;
        display: block;
        /*margin-top: 12px;*/
        line-height: 1;
    }

    #drop a:hover {
        background-color: #0986a3;
    }

    #drop input {
        display: none;
    }
</style>

<script type="text/javascript">
$(function () {

    var ol = $('#upload ol');
    $('#drop a').click(function () {
        $(this).parent().find('input').click();
    });

    $('body').on('click', '.btnOpenFileUpload', function (e) {
        e.preventDefault();
        $('#upload ol').empty();
        $('#uploadModal').modal('show');
    });

    $('#upload').fileupload({
        messages: {
            maxFileSize: "File is too big",
            minFileSize: "File is too small",
            acceptFileTypes: "Filetype not allowed",
            maxNumberOfFiles: "Too many files",
            uploadedBytes: "Uploaded bytes exceed file size",
            emptyResult: "Empty file upload result"
        },
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        //url: 'AJAX.ashx',
        url: 'http://jquery-file-upload.appspot.com/',
        dataType: 'json',
        disableImageLoad: true,
        headers: {
            Accept: "application/json"
        },
        accept: 'application/json',
        maxFileSize: 10000000, //5mb
        maxNumberOfFiles: 5,
        sequentialUploads: true,
        //singleFileUploads: false,
        //resizeMaxWidth: 1920,
        //resizeMaxHeight: 1200,
        acceptFileTypes: /(.|\/)(gif|jpe?g|png|pdf)$/i,
        uploadTemplateId: null,
        downloadTemplateId: null,
        uploadTemplate: function (o) {
            var rows = $();
            $.each(o.files, function (index, file) {
                var row = $('<li class="template-upload fade upload-file">' +
                    '<div class="upload-progress-bar progress" style="width: 0%;"></div>' +
                    '<div class="upload-file-info">' +
                    '<div class="filename-col"><span class="filename"></span></div>' +
                    '<div class="filesize-col"><span class="size"></span></div>' +
                    '<div class="error-col"><span class="error field-validation-error"></span></div>' +
                    '<div class="actions-col">' +
                    '<button class="btn btn-xs btn-danger cancel removeFile" data-toggle="tooltip" data-placement="left" title="" data-original-title="Remove file">' +
                    '<i class="glyphicon glyphicon-ban-circle"></i> <span></span>' +
                    '</button> ' +
                    '<button class="btn btn-success start"><i class="glyphicon glyphicon-upload"></i> <span>Start</span></button>' +
                    '</div>' +
                    '</div>' +
                    '</li>');
                row.find('.filename').text(file.name);
                row.find('.size').text(o.formatFileSize(file.size));
                if (file.error) {
                    row.find('.error').text(file.error);
                }
                rows = rows.add(row);
            });
            return rows;
        },
        downloadTemplate: function (o) {
            var rows = $();
            $.each(o.files, function (index, file) {
                var row = $('<li class="template-download fade upload-file complete">' +
                    '<div class="upload-progress-bar progress" style="width: 100%;"></div>' +
                    '<div class="upload-file-info">' +
                    '<div class="filename-col"><span class="filename"></span> - <span class="size"></span></div>' +
                    '<div class="error-col"><span class="error"></span></div>' +
                    '</div>' +
                    '</li>');

                row.find('.size').text(o.formatFileSize(file.size));
                if (file.error) {
                    row.find('.filename').text(file.name);
                    row.find('.error').text(file.error);
                    row.removeClass('complete').addClass('error');
                } else {
                    row.find('.filename').text(file.name);
                }
                rows = rows.add(row);
            });
            return rows;
        }
    });

    $('#upload').bind('fileuploadprocessalways', function (e, data) {
        var currentFile = data.files[data.index];
        if (data.files.error && currentFile.error) {
            //console.log(currentFile.error);
            data.context.find(".start").prop('disabled', true);
            data.context.find('.error').text(currentFile.error);
            return;
        }
    });

    /*$(document, '.removeFile').on('show.bs.tooltip', function (e) {
     e.stopPropagation();
     }).on('hide.bs.tooltip', function (e) {
     e.stopPropagation();
     });*/

    $('#upload').bind('fileuploadadd', function (e, data) {
        setTimeout(function () {
            $('.removeFile').tooltip();
        }, 0);
        //$('.removeFile').tooltip();
        //console.log('add');
    })
        .bind('fileuploadprogress', function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            data.context.find('.progress').css('width', progress + '%');
            //console.log(progress);
        })
        .bind('fileuploadfail', function (e, data) {
            console.log('fail');
        }).bind('fileuploadstart', function (e) {
        console.log('start');
    })

});
</script>

