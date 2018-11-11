<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Login</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url() ?>resources/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?= base_url() ?>resources/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">

    <!-- Plugin CSS -->
    <link href="<?= base_url() ?>resources/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url() ?>resources/css/sb-admin.css" rel="stylesheet">
    <style>
        h2 {
            color: white;
        }

        p {
            color: red;
        }
    </style>
</head>

<body>
<div class="container">

    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    <form class="form-signin" action="<?= base_url() ?>login" method="POST">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="username" type="text"
                                       autofocus="">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password"
                                       value="">
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Login"/>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div> <!-- /container -->

<!-- Bootstrap core JavaScript -->
<script src="<?= base_url() ?>resources/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>resources/vendor/tether/tether.min.js"></script>
<script src="<?= base_url() ?>resources/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="<?= base_url() ?>resources/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url() ?>resources/vendor/chart.js/Chart.min.js"></script>
<script src="<?= base_url() ?>resources/vendor/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>resources/vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for this template -->
<script src="<?= base_url() ?>resources/js/sb-admin.min.js"></script>

</body>

</html>
