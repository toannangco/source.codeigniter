<?php
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?= $title?></title>
        <link rel="stylesheet" href="<?= base_url()?>public/backend/css/order.css" type="text/css">
        <link href="<?= admin_css_no?>bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?= admin_css_no?>font-awesome.min.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    <?php echo $content_for_layout ;/* các file view được nạp vào layout*/?>
    </body>
</html>