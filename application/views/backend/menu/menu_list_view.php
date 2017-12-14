<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
    <aside class="right-side">
    
        <section class="content-header">
            <h1>
                <small><?= $title?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url?>home/" title="<?= lang("set.menuleft_home")?>" data-original-title="<?= lang("set.menuleft_home")?>"><i class="fa fa-dashboard"></i> <?= trang_chu?></a></li>
                <li class="active"><?= $title ?></li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-sitemap"></i>
                    <h3 class="box-title"><?= $title ?></h3>

                    <div class="pull-right box-tools">
                        <a href="<?= admin_url ?>menu/add/" class="btn btn-primary btn-sm" title="<?= them?> Menu Admin">
                            <i class="fa fa-plus"></i>
                            <span><?= them?></span>
                        </a>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th><?= ten_danh_muc?></th>
                            <th class="text-left"><?= loai?></th>
                            
                            <th class="text-center"><?= thiet_lap?></th>
                        </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        <?= $this->mmenu->showMenu(); ?>
                        </tbody>
                    </table>
                </div>

                <div class="box-footer">
                    <?php if(isset($pagination)){echo $pagination;};?>
                    <button class="btn btn-default disabled"><?= tong_cong?>: <?= $record?> <?= danh_muc?></button>
                </div>
            </div>
        </section>
    </aside>
</form>