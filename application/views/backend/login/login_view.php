<!DOCTYPE html>
<html class="bg-black">
<head>
    <meta charset="UTF-8">
    <title><?= dang_nhap?> | CMS</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?= admin_css_no?>bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= admin_css_no?>font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= admin_css?>AdminLTE.css" rel="stylesheet" type="text/css" />
    <script src="<?= admin_js?>html5shiv.js"></script>
    <script src="<?= admin_js?>respond.min.js"></script>
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
        <div class="header bg-aqua"><b>Login</b></div>
        <form  method="post">
            <div class="body bg-gray">
                <?php if(isset($_SESSION['unsuccess'])) { ?>
                <div class="alert alert-warning" style="margin-left:0px">Tài khoản đã đăng nhập sai <?= $_SESSION['unsuccess']?>/5 lần.</div>
                <?php } ?>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" autocomplete="off" name="username" value="<?= set_value('username')?>"  class="form-control" required="required" placeholder="<?= nhap_tai_khoan?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input type="password" autocomplete="off" name="password" class="form-control" required="required" placeholder="<?= mat_khau?>"/>
                    </div>
                </div>
                <input type="hidden" name="hd_brower" id="hd_brower" />
            </div>
            <div class="footer">
                <button type="submit" class="btn bg-aqua btn-block"><i class="fa fa-unlock"></i> Login</button>
            </div>
        </form>
    </div>

    <!-- jQuery 2.0.2 -->
    <script src="<?= admin_js_no?>jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= admin_js_no?>bootstrap.min.js" type="text/javascript"></script>
     
    <script type="text/javascript">
        $(document).ready(function(){
            function browserName(){
                var Browser = navigator.userAgent;
                if (Browser.indexOf('MSIE') >= 0){
                    Browser = 'MSIE';
                }
                else if (Browser.indexOf('Firefox') >= 0){
                    Browser = 'Firefox';
                }
                else if (Browser.indexOf('Chrome') >= 0){
                    Browser = 'Chrome';
                }
                else if (Browser.indexOf('Safari') >= 0){
                    Browser = 'Safari';
                }
                else if (Browser.indexOf('Opera') >= 0){
                    Browser = 'Opera';
                }
                else{
                    Browser = 'UNKNOWN';
                }
                return Browser;
            }
            function browserVersion(){
                var index;
                var version = 0;
                var name = browserName();
                var info = navigator.userAgent;
                index = info.indexOf(name) + name.length + 1;
                version = parseFloat(info.substring(index,index + 3));
                return version;
            }
            $('#hd_brower').val(browserName() + '/version ' + browserVersion());
        });
    </script>
</body>
</html>