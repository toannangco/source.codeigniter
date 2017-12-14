<link rel="stylesheet" type="text/css" href="<?=base_css?>user.css">
<div class="modal-content text-left">
<div class="modal-header">
        <button class="close close_popup"><span aria-hidden="true" class=" text-danger">&times;</span></button>
        <h4 class="modal-title">Đăng nhập</h4>
      </div>
    <div class="row">
        <div class="col-lg-6">
            <form role="form" class="frm-left" method="post">
                <div class="modal-body">
                    <div class="input-group mb10">
                        <span class="input-group-addon"><i class="fa fa-user"></i> Username</span>
                        <input type="text" placeholder="Tài khoản" class="form-control" required="required" id="xnuser_acc" name="username">
                    </div>
                    <div class="input-group mb10">
                        <span class="input-group-addon"><i class="fa fa-key"></i> Password</span>
                        <input type="password" placeholder="Mật khẩu" class="form-control" required="required" id="xnuser_password" name="password">
                    </div>
                    <span id="instantsearch-progress"></span>
                    <div class="clr"></div>
                    <button type="submit" class="btn btn-com pull-left btn-success btnLogin" id="xndangnhap"><i class="fa fa-user"></i> Đăng nhập</button>
                    <div class="clr"></div>
                </div>
            </form>
            <div class="clr"></div>
        </div>
        <div class="col-lg-6">
            <form role="form"  class="frm-right" method="post"  action="<?= base_url.'user/register/'?>">
                <div class="modal-body">
                    <div class="input-group mb10">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        <input type="text" placeholder="Tài khoản" required class="form-control" id="user_username" name="user_username">
                    </div>
                
                    <div class="input-group mb10">
                        <span class="input-group-addon">
                            <i class="fa fa-key"></i>
                        </span>
                        <input type="password" placeholder="Mật khẩu" class="form-control" required id="user_password" name="user_password">
                    </div>

                    <div class="input-group mb10">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        <input type="text" placeholder="Họ và Tên" required class="form-control" id="user_first_name" name="user_first_name">
                    </div>
                    <div class="input-group mb10">
                        <span class="input-group-addon">
                            <i class="fa fa-home"></i>
                        </span>
                        <input type="text" placeholder="Địa chỉ" required class="form-control" id="user_address" name="user_address">
                        </div>
                    
                            <div class="input-group mb10">
                                <span class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </span>
                                <input type="text" placeholder="Điện thoại" required class="form-control" id="user_phone" name="user_phone">
                        </div>
                            <div class="input-group mb10">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="email" placeholder="Email" required class="form-control" id="user_email" name="user_email">
                        </div>
                        <button type="submit" class="btn btn-com pull-left mb10 btn-primary" id="xndangky"><i class="fa fa-send-o"></i> Đăng ký</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>