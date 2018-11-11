<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Breadcrumbs -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Dashboard</a></li>
    <li class="breadcrumb-item">Settings</li>
    <li class="breadcrumb-item"><a href="<?= base_url() ?>settings/users">Users</a></li>
    <li class="breadcrumb-item active">Edit</li>
</ol>

<form method="POST" action="">
    <input type="hidden" name="action" value="edit">
    <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label text-right">Username</label>
        <div class="col-6">
            <input class="form-control" type="text" <?= $result->username ? 'readonly' : '' ?>
                   value="<?= $result->username ?>" placeholder="" name="username">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label text-right">Password <br>(leave blank to keep)</label>
        <div class="col-6">
            <input class="form-control" type="password" value="" placeholder="" name="password">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label text-right">Password Verify <br>(leave blank to keep)</label>
        <div class="col-6">
            <input class="form-control" type="password" value="" placeholder="" name="password2">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label text-right">Email</label>
        <div class="col-6">
            <input class="form-control" type="email" value="<?= $result->email ?>" placeholder="" name="email">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label text-right">Name</label>
        <div class="col-6">
            <input class="form-control" type="text" value="<?= $result->name ?>" placeholder="" name="name">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label text-right">Address</label>
        <div class="col-6">
            <input class="form-control" type="text" value="<?= $result->address ?>" placeholder="" name="address">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label text-right">Address 2 (Suite,Apt)</label>
        <div class="col-6">
            <input class="form-control" type="text" value="<?= $result->address2 ?>" placeholder="" name="address2">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label text-right">City</label>
        <div class="col-6">
            <input class="form-control" type="text" value="<?= $result->city ?>" placeholder="" name="city">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label text-right">State</label>
        <div class="col-6">
            <input class="form-control" type="text" value="<?= $result->state ?>" placeholder="" name="state">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label text-right">Zip</label>
        <div class="col-6">
            <input class="form-control" type="text" value="<?= $result->zip ?>" placeholder="" name="zip">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label text-right">Permission Group</label>
        <div class="col-6">
            <select class="form-control" name="admin_group" required>
                <?php
                foreach ($admin_groups as $v) {
                    if ($v["id"] == $result->admin_group) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    echo "<option value='" . $v["id"] . "' " . $selected . ">" . $v["name"] . "</option>";
                } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-3 offset-3">
            <input type="submit" class="btn btn-primary">
        </div>
    </div>


</form>