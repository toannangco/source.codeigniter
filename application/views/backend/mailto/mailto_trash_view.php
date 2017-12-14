<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
    <aside class="right-side">
        <!-- BEGIN: Content Header (Page header) -->
        <section class="content-header no-margin">
            <h1 class="text-center">
                <?= hop_thu?>
            </h1>
        </section>
        <!-- END: Content Header (Page header) -->

        <!-- BEGIN: Main content -->
        <section class="content">
            <!-- MAILBOX BEGIN -->
            <div class="mailbox row">
                <div class="col-xs-12">
                    <div class="box box-solid">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-4">
                                    <!-- BOXES are complex enough to move the .box-header around.
                                         This is an example of having the box header within the box body -->
                                    <div class="box-header">
                                        <i class="fa fa-trash-o"></i>
                                        <h3 class="box-title"><?= thung_rac?></h3>
                                    </div>
                                    <!-- compose message btn -->
                                    <a class="btn btn-block btn-primary" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i> <?= soan_thu?></a>
                                    <!-- Navigation - folders-->
                                    <div style="margin-top: 15px;">
                                        <ul class="nav nav-pills nav-stacked">
                                            <li class="header"><?= thu_muc?></li>
                                            <li><a href="<?= admin_url?>mailto/index/" title="<?= $record_read?> mail chưa đọc"><i class="fa fa-inbox"></i> <?= hop_thu_den?> (<?= $record_read?>)</a></li>
                                            <!--<li><a href="#"><i class="fa fa-comments-o"></i> <?= hoi_dap?> (5)</a></li>-->
                                            <li><a href="<?= admin_url?>mailto/customer/" title="<?= $record_read?> mail chưa đọc"><i class="fa fa-inbox"></i> Đăng ký nhận mail</a></li>
                                            <li class="active"><a href="<?= admin_url?>mailto/trash/" title="<?= $record_trash?> mail chưa đọc"><i class="fa fa-trash-o"></i> <?= thung_rac?> (<?= $record_trash?>)</a></li>
                                            <!--<li ><a href="<?= admin_url?>mailto/send/"><i class="fa fa-mail-forward"></i> Sent</a></li>-->
                                            <!--<li><a href="#"><i class="fa fa-pencil-square-o"></i> Drafts</a></li>
                                            <li><a href="#"><i class="fa fa-mail-forward"></i> Sent</a></li>
                                            <li><a href="#"><i class="fa fa-star"></i> Starred</a></li>
                                            <li><a href="#"><i class="fa fa-folder"></i> Junk</a></li>-->
                                        </ul>
                                    </div>
                                </div><!-- /.col (LEFT) -->
                                <div class="col-md-9 col-sm-8">
                                    <div class="row pad">
                                        <div class="col-sm-6">
                                            <label>
                                                <input type="checkbox" id="check-all">
                                            </label>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-sm btn-flat dropdown-toggle" data-toggle="dropdown">
                                                    <?= hanh_dong?> <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <button name="refreshCheckAll" class="btn-dropdown"><i class="fa fa-refresh"></i> <?= phuc_hoi?></button>
                                                    </li>
                                                    <li>
                                                        <button name="deleteCheckAll" onclick="return Delete();" class="btn-dropdown"><i class="fa fa-trash-o"></i> <?= xoa_vinh_vien?></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 search-form">
                                            <form action="#" class="text-right">
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" name="fkeyword" placeholder="<?= tim_kiem?>">
                                                    <div class="input-group-btn">
                                                        <button type="submit" name="fsearchtour" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div><!-- /.row -->

                                    <div class="table-responsive">
                                        <!-- THE MESSAGES -->
                                        <table class="table table-mailbox table-checkbox">
                                            <tbody>
                                            <?php if($list){
                                                $i=1;
                                                foreach($list as $item){
                                                    /**begin trang thai*/
                                                    $open_strong = $item['mailto_read']==0?"<strong>":"";
                                                    $close_strong = $item['mailto_read']==0?"</strong>":"";
                                                    $unread = $item['mailto_read']==0?"unread":"";
                                                    $link_info = admin_url.'mailto/info/'.$item['id'].'/?redirect='.base64_encode(current_url());
                                                    ?>
                                                    <tr class="<?= $unread?>">
                                                        <td class="small-col"><input type="checkbox" class="checkbox_item" name="check_all[]" value="<?= $item["id"]?>"></td>
                                                        <td class="name">
                                                            <a href="<?= $link_info?>" title="<?= (isset($item['mailto_email']) && $item['mailto_email'])?$item['mailto_email']:''?>">
                                                                <?= $open_strong?><?= (isset($item['mailto_fullname']) && $item['mailto_fullname'])?$item['mailto_fullname']:''?><?= $close_strong?>
                                                            </a>
                                                        </td>
                                                        <td class="subject">
                                                            <a href="<?= $link_info?>">
                                                                <?= $open_strong?><?= (isset($item['mailto_title']) && $item['mailto_title'])?$item['mailto_title']:''?><?= $close_strong?>
                                                                <small class="text-gray"><?= (isset($item['mailto_content']) && $item['mailto_content'])?'- '.substring(strip_tags($item['mailto_content']),100):''?></small>
                                                            </a>
                                                        </td>
                                                        <td class="time" title="<?= (isset($item['mailto_create_date']) && $item['mailto_create_date'])?date("d/m/Y h:i:s a",$item['mailto_create_date']):'';?>">
                                                            <?php
                                                            if( (isset($item['mailto_create_date']) && $item['mailto_create_date'])){
                                                                if(date("d")==date("d",$item["mailto_create_date"])){
                                                                    echo date("h:i a",$item['mailto_create_date']);
                                                                    echo ' <i class="fa fa-clock-o" style="cursor: help;"></i>';
                                                                }else{
                                                                    echo date("d M",$item['mailto_create_date']);
                                                                    echo ' <i class="fa fa-calendar" style="cursor: help;"></i>';
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                }
                                            }?>

                                            </tbody></table>
                                    </div><!-- /.table-responsive -->
                                </div><!-- /.col (RIGHT) -->
                            </div><!-- /.row -->
                        </div><!-- /.box-body -->

                        <!-- BEGIN: Box-Footer -->
                        <div class="box-footer clearfix">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <?php if(isset($pagination)){echo $pagination;};?>
                                <li class="disabled"><a><?= tat_ca?>: <?= $record?> email</a></li>
                            </ul>
                        </div>
                        <!-- END: Box-Footer -->
                    </div><!-- /.box -->
                </div><!-- /.col (MAIN) -->
            </div>
            <!-- MAILBOX END -->

        </section><!-- /.content -->
        <!-- BEGIN: Main content -->
    </aside>
</form>
<!--begin soan mail-->
<div class="modal fade in" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-envelope-o"></i> Compose New Message</h4>
            </div>
            <form action="#" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">TO:</span>
                            <input name="email_to" id="email_to" required="required" type="email" class="form-control" placeholder="Email TO">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">CC:</span>
                            <input name="email_cc" id="email_cc" type="email" class="form-control" placeholder="Email CC">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">BCC:</span>
                            <input name="email_bcc" id="email_bcc" type="email" class="form-control" placeholder="Email BCC">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Title:</span>
                            <input name="email_title" id="email_title" required="required" type="text" class="form-control" placeholder="Title">
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="email_message" required="required" id="email_message" class="form-control textarea" placeholder="Message" style="height: 120px;"></textarea>
                    </div>
                    <!--<div class="form-group">
                        <div class="btn btn-success btn-file">
                            <i class="fa fa-paperclip"></i> Attachment
                            <input type="file" name="attachment">
                        </div>
                        <p class="help-block">Max. 32MB</p>
                    </div>-->

                </div>
                <div class="modal-footer clearfix">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
                    <button type="submit" id="sf_sendmail" class="btn btn-primary pull-left"><i class="fa fa-envelope"></i> Send Message <img src="<?= admin_img?>loading3.gif" class="img_load" style="display: none" alt="Loading..." /></button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--end soan mail-->