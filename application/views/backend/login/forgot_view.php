<!DOCTYPE html>
<html class="bg-black">
<head>
    <meta charset="UTF-8">
    <title><?= quen_mat_khau?> | CMS</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?= admin_css_no?>bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= admin_css_no?>font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= admin_css?>AdminLTE.css" rel="stylesheet" type="text/css" />
    <script src="<?= admin_js?>html5shiv.js"></script>
    <script src="<?= admin_js?>respond.min.js"></script>
    <![endif]-->
    <style>
        @media (max-width: 767px){
            .form-box {
                margin: 20px auto 0 auto;
            }
        }
    </style>
</head>
<body class="bg-black">
    <div class="form-box" id="login-box">
        <div class="header bg-light-blue"><?= quen_mat_khau?></div>
        <form  method="post">
            <div class="body bg-gray">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="text" name="txt_email" class="form-control" placeholder="<?= nhap_dia_chi_email_de_nhan_mat_khau?>" required="required">
                </div>
            </div>
            <div class="footer">
                <button type="submit" class="btn bg-light-blue btn-block"><i class="fa fa-retweet"></i> <?= tao_lai_mat_khau?></button>
                <p><a href="<?= base_url().$lang.'/'.admin_name.'/index/'?>"><i class="fa fa-arrow-left"></i> <?= quay_lai?></a></p>
            </div>
        </form>
        <div class="margin text-center">
            <span><?= thiet_ke_va_phat_trien_boi?> thietkewebpro247.com</span>
            <br>
            <span><?= phien_ban?>: v1.2.0</span>
            <br>
            <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
            <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
            <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>
        </div>
    </div>

    <!-- jQuery 2.0.2 -->
    <script src="<?= admin_js_no?>jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= admin_js_no?>bootstrap.min.js" type="text/javascript"></script>
     
</body>
</html>
