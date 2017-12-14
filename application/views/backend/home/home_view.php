 
<aside class="right-side">
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<section class="content">
 <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box  " style="background:#7e989e">
                <div class="inner">
                    <h3><font><font>
                        <?= $sum_aritce?>
                    </font></font></h3>
                    <p><font><font>
                        Bài viết ngoại ngữ
                    </font></font></p>
                </div>
                <div class="icon">
                    <i class="fa fa-list-alt "></i>
                </div>
                <a href="<?= admin_url?>news/index/" class="small-box-footer"><font><font class="">
                    More info </font></font><i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
		 <div class="col-lg-3 col-xs-6">
            <div class="small-box  " style="background:#387482">
                <div class="inner">
                    <h3><font><font>
                        <?= $sum_post?>
                    </font></font></h3>
                    <p><font><font>
                        Bài viết tin tức
                    </font></font></p>
                </div>
                <div class="icon">
                    <i class="fa fa-list-alt "></i>
                </div>
                <a href="<?= admin_url?>post/index/" class="small-box-footer"><font><font class="">
                    More info </font></font><i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
		 <div class="col-lg-3 col-xs-6">
            <div class="small-box  " style="background:#ab92af">
                <div class="inner">
                    <h3><font><font>
                        <?= $sum_document?>
                    </font></font></h3>
                    <p><font><font>
                        Tài liệu
                    </font></font></p>
                </div>
                <div class="icon">
                    <i class="fa fa-list-alt "></i>
                </div>
                <a href="<?= admin_url?>document/index/" class="small-box-footer"><font><font class="">
                    More info </font></font><i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><font><font>
                        <?= $sum_mailto?></font></font>
                    </h3>
                    <p><font><font>
                       Đăng ký nhận tin
                    </font></font></p>
                </div>
                <div class="icon">
                    <i class="fa fa-envelope"></i>
                </div>
                <a href="<?= admin_url?>mailto/index/" class="small-box-footer"><font><font>
                    More info </font></font><i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
		 <div class="col-lg-3 col-xs-6">
            <div class="small-box  " style="background:#1d4180;">
                <div class="inner">
                    <h3><font><font>
                        <?= $sum_video?></font></font>
                    </h3>
                    <p><font><font>
                      Video
                    </font></font></p>
                </div>
                <div class="icon">
                    <i class="fa fa-video-camera"></i>
                </div>
                <a href="<?= admin_url?>video/index/" class="small-box-footer"><font><font>
                    More info </font></font><i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><font><font>
                        <?= $sum_user?>
                    </font></font></h3>
                    <p><font><font>
                        User Registrations
                    </font></font></p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="<?= admin_url?>user/index/" class="small-box-footer"><font><font>
                    More info </font></font><i class="fa fa-user"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?= lich_su_dang_nhap?> </h3>
            <small class="badge pull-right bg-yellow">Top 10/<?=$record_history_login?></small>
        </div>
        <div class="box-body table-responsive">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline" role="grid">
                <table id="example1" class="table table-bordered table-striped dataTable" aria-describedby="example1_info">
                    <thead>
                        <tr role="row">
                            <th><?= tai_khoan?></th>
                       
                            <th>IP</th>
                            <th><?= trinh_duyet?></th>
                            <th><?= thoi_gian?></th>
                        </tr>
                    </thead>
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                        <?php if($list_history_login) { 
                            foreach ($list_history_login as $key => $value) {
                                 
                                ?>
                                <tr class="gradeA odd">
                                    <td class=" sorting_1"><?= $value["history_username"]?></td>
                                     
                                    <td class=" "><?= $value["history_ip"]?></td>
                                    <td class="center "><?= $value["history_user_agent"]?></td>
                                    <td class="center "><?= date("d/m/Y h:i:s a",$value["history_time"])?></td>
                                </tr>
                                <?php } 
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</aside>
<style>.small-box > .inner { color: #fff;}body > .header{margin-top:-20px;}</style>
 