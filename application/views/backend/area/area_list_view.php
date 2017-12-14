<form accept-charset="utf-8" method="get">
    <aside class="right-side">
        <section class="content-header">
            <h1>
                <small><?= $title ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url?>home/" ><i class="fa fa-dashboard"></i> <?= trang_chu?></a></li>
                <li class="active"><?= $title ?></li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-list-alt"></i>
                    <h3 class="box-title"><?= $title ?></h3>
                    <small class="badge bg-aqua"><?= $record?></small>
                    <div class="pull-right box-tools">
                        <a href="<?= admin_url ?>area/add/" class="btn btn-primary btn-sm" title="<?= them?>">
                            <i class="fa fa-plus"></i>
                            <span><?= them?></span>
                        </a>
                    </div>
                </div>

                <div id="example1_wrapper" class="box-body" role="grid">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <select onchange="this.form.submit()" class="form-control input-sm" name="tparent" id="tparent">
                                <option value="">---<?= loc_theo?> <?= danh_muc?>---</option>
                                <?php 
                                    $this->marea->dropdown($tparent); 
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-bordered table-striped dataTable table-checkbox" aria-describedby="example1_info">
                        <thead>
                            <tr role="row">
                                <th class="text-center" style="width: 10px;">STT</th>
                                <th><?= tieu_de?></th>
                                <th class="text-center" width="100px"><?= ngay_dang?></th>
                                <th class="text-center" style="width: 129px;"><?= hanh_dong?></th>
                            </tr>
                        </thead>

                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        <?= $this->marea->showData($tparent,$tstatus); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </aside>
</form>