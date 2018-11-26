<?php
error_reporting(E_ERROR);
$h1 = $title;
$h2 = $_POST['condition1'];
$warranty = $_POST['conditionWarranties1'];
$price = $_POST['price'];
$extended_warranty = 0;

/**
 * @param $price
 * @return int
 */
function getExtendedWarrantyPrice($price) {
    $price = floor($price);
    $extended_warranty = 0;
    if ($price >= 99 && $price <= 399) {
        $extended_warranty = 49;
    } else if ($price >= 400 && $price <= 599) {
        $extended_warranty = 75;
    } else if ($price >= 600 && $price <= 899) {
        $extended_warranty = 99;
    } else if ($price >= 900) {
        $extended_warranty = 149;
    }
    return $extended_warranty;
}

/**
 * @param $condition_date
 * @return false|string
 */
function getFormattedDate($condition_date) {
    if (strlen($condition_date) > 0) {
        $condition_date = date('m/d/Y', strtotime($condition_date));
    }
    return $condition_date;
}

/**
 * @param $condition_warranty
 * @param $condition_date
 * @return mixed
 */
function getConditionWarranty($condition_warranty, $condition_date) {
    if (stripos($condition_warranty, 'warranty until') !== false) {
        $condition_warranty = str_replace('__/__/____', getFormattedDate($condition_date), $condition_warranty);
    }
    return $condition_warranty;
}

function isStackedCheckedInWasherDryerSet() {
    return in_array('Stacked', $_POST['washer']);
}

/**
 * @param $name
 * @return string
 */
function getVariable($name) {
    if(is_array($_POST[$name])) {
        return implode(' ', $_POST[$name]);
    }
    return $_POST[$name];
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="<?php echo site_url('resources/js/jquery-2.2.3.min.js');?>"></script>
    <script src="<?php echo site_url('resources/js/bootstrap.min.js');?>"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo site_url('resources/css/bootstrap.min.css');?>">
    <title>Print Sales Sticker</title>
    <style type="text/css" media="all">
        @page {
            size: 4.1in 5.8in;
            margin: 4mm;
        }

        html, body{
            padding: 0;
            margin: 2mm;
            width: 109mm;
            height: 152mm;
        }

        .table {
            width: 5.5in;
            height: 5.8in;
        }

        .table td {
            padding-top: 0;
            padding-bottom: 0;
            border: none;
            font-size: 4.7vw;
        }

        .price {
            font-size: 16vw;
            font-weight: bold;
            text-align: center;
        }

        #footer {
            position: absolute;
            bottom: 2mm;
            font-size: 1em;
            line-height: 1em;
            text-align: right;
            width: 5in;
        }

    </style>
</head>
<body>

<div class="container">
<table class="table">

    <tr class="d-print-none">
        <form method="post" action="./index.php">
            <?php
            foreach($_POST as $key=>$value) {
                if(is_array($value)) {
                    foreach($value as $k=>$v) {
                        echo sprintf('<input type="hidden" name="%s[]" value="%s" />', $key, $v);
                    }
                } else {
                    echo sprintf('<input type="hidden" name="%s" value="%s" />', $key, $value);
                }
            }
            ?>
        </form>
        <td colspan="3">
            <!--<a href="./index.php" class="btn btn-success btn-lg">Back</a>
            <a href="javascript:;" class="btn btn-warning btn-lg btnEdit">Edit</a>-->
        </td>
    </tr>
    <tr>
        <td colspan="3" class="headings">
            <h1 class="text-center"><?= $h1 ?></h1>
            <h2 class="<?=(strpos($h2, '<span') !== false) ? '' : 'text-center'?>"><?= $h2 ?></h2>
            <hr/>
            <h1 class="text-center price">$<?= $_POST['price'] ?></h1>
        </td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td><b>Compare</b></td>
        <td colspan="2">$<?= $_POST['compareTo'] ?></td>
    </tr>
    <tr>
        <td><b>Save</b></td>
        <td colspan="2">$<?= $_POST['save'] ?> (<?= $_POST['savePercent'] ?>% off)</td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td><b>Warranty</b></td>
        <td colspan="2"><?=$warranty?></td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3">
            <u><b>Features:</b></u><br/>
            <?= $feature1 ?><br/>
            <?= $feature2 ?><br/>
            <?= $feature3 ?>
        </td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <?php
        if(strlen($width2) > 0 /*&& !isStackedCheckedInWasherDryerSet()*/) {
            ?>
            <td>
                <div align="left">
                    <b><u>Washer</u></b><br>
                    <b>H: </b><?= $height1 ?>"<br>
                    <b>W: </b><?= $width1 ?>"<br>
                    <b>D: </b><?= $depth1 ?>"
                </div>
            </td>
            <td>
                <div align="left">
                    <b><u>Dryer</u></b><br>
                    <b>H: </b><?= $height2 ?>"<br>
                    <b>W: </b><?= $width2 ?>"<br>
                    <b>D: </b><?= $depth2 ?>"
                </div>
            </td>
            <?php
        } else {
            ?>
            <td>
                <div align="left">
                    <b>H: </b><?= $height1 ?>"<br>
                    <b>W: </b><?= $width1 ?>"<br>
                    <b>D: </b><?= $depth1 ?>"
                </div>
            </td>
            <td></td>
            <?php
        }
        ?>
        <td></td>
    </tr>
</table>

    <div id="footer">
        Ref # : <?=$tracking_no?>
    </div>

</div>
<script type="text/javascript">
    $(function () {

        $('.btnEdit').on('click', function(e) {
            $('form').submit();
        });

        <?php
        if($_POST['category'] != 'Washer Dryer Set') {
        ?>
            $('td:not(.headings)').css('font-size', '5.6vw');
        <?php
        }
        ?>

        //window.print();
    });
</script>
</body>
</html>



