<link rel="stylesheet" type="text/css" href="<?=base_css?>user.css">
<div class="navi-crumb">
    <div class="container">
        <ul>
            <li class="current"><a href="#">Home</a></li>
            <li><span>|</span></li>
            <li><a href="#">SIGN UP</a></li>
        </ul>
    </div>
</div>
<div class="content-wrap">
    <div class="container">
        <div class="row">
            <div class="outer-box">
                <div class="inner-box">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <form role="form" class="frm-left" method="post" action="<?= base_url.$lang.'/user/login/'?>">
                            <h3>Member Login</h3>
                            <div class="form-group">
                                <label>Username</label>
                                <div class="input-wrap">
                                    <input type="text" class="form-control" name="username" required="required">
                                    <span class="lbl-alert">*</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-wrap">
                                    <input type="password" class="form-control" name="password" required="required">
                                    <span class="lbl-alert">*</span>
                                </div>
                            </div>
                            <button type="submit" name="sflogin" class="btn btn-default">OK</button>
                        </form>
                    </div>                  
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>