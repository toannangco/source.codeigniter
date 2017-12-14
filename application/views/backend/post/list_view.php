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
                        <a href="<?= admin_url ?>post/add/<?= $post_parent >0 ? '?post_parent='.$post_parent:'';?>" class="btn btn-primary btn-sm" title="<?= them?> <?= bai_viet?>">
                            <i class="fa fa-plus"></i>
                            <span><?= them?></span>
                        </a>
                    </div>
                </div>

                <div id="example1_wrapper" class="box-body" role="grid">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <select onchange="this.form.submit()" class="form-control input-sm" name="post_parent" id="post_parent">
                                <option value="">---<?= loc_theo?> <?= danh_muc?>---</option>
                                <?php 
                                    $this->mmenu->dropDownMenu($post_parent,'post'); 
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <select onchange="this.form.submit()" name="thot" class="form-control input-sm">
                                <option value="">-- <?= loai?> --</option>
                                <option <?= $thot == 1 ? "selected":"";?> value="1">Tin nổi bật</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <select onchange="this.form.submit()" name="tstatus" class="form-control input-sm">
                                <option <?= $tstatus == 1 ? "selected":"";?> value="1"><?= hien_thi?></option>
                                <option <?= $tstatus == 0 ? "selected":"";?> value="0"><?= an?></option>
                                <option <?= $tstatus == -1 ? "selected":"";?> value="-1"><?= thung_rac?></option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" name="fkeyword" class="form-control input-sm" placeholder="<?= tim_kiem?>" value="<?= $fkeyword; ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> <?= tim_kiem?></button>
                        </div>
                    </div>
                </div>

                <div class="box-body table-responsive row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-striped dataTable table-checkbox" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="text-center" style="width: 10px;">
                                        ID
                                    </th>
                                    <th><?= tieu_de?></th>
                                    <th><?= danh_muc?></th>
                                    <th><?= hinh_dai_dien?></th>
                                    
                                    <th><?= tac_gia?></th>
                                    <th class="text-center"><?= ngay_dang?></th>
                                    <th class="text-center" style="width: 129px;"><?= hanh_dong?></th>
                                </tr>
                            </thead>

                            <tbody role="alert" aria-live="polite" aria-relevant="all">
                            <?php
                            if(isset($list)){
                                foreach ($list as $key => $value) {
                                    $myMenuLang = $this->mmenu_lang->getDataObject('menu_lang_name as menu_name',array("menu_lang"=>$lang,"menu_id"=>$value->post_parent));
                                    $menu_name = !empty($myMenuLang) ? $myMenuLang->menu_name : '--';
                                    
                                    $picture = $value->post_picture!=""?base_file.'post/'.$value->post_picture:admin_img.'no_image.png';

                                    $myUser = $this->muser->getOnceAnd(array("id"=>$value->user));
                                    $authorName = !empty($myUser) ? $myUser['user_username']:'--';
                                    
                                    $status = $value->news_status==1?"icon-eye-open":"icon-eye-close";
                                    $status_change = $value->news_status==1?0:1;
                                    $status_title = $value->news_status==1? an : hien_thi;
                                    
                                    $link_edit = admin_url.'post/update/'.$value->id.'/?redirect='.base64_encode(curPageURL());
                                    $link_status = admin_url.'post/status/'.$value->id.'/'.$status_change.'/?redirect='.base64_encode(curPageURL());
                                    $link_delete = admin_url.'post/status/'.$value->id.'/-1/?redirect='.base64_encode(curPageURL());
                                    if($value->news_status == -1)
                                        $link_delete = admin_url.'post/delete/'.$value->id.'/?redirect='.base64_encode(curPageURL());
                                    ?>
                                    <tr class="odd">
                                        <td class="text-center">
                                            <?= $value->id?>
                                        </td>
                                        <td><?= $value->post_lang_name?></td>
                                        <td><?= $menu_name?></td>
                                        <td class="text-center"><a href="<?= $picture?>" class="image zoom_img tip-bottom" title="Zoom img"><img src="<?= $picture?>" class="img-circle"></a></td>
                                         
                                        <td><small class="text-gray"><?= $authorName?></small></td>
                                        <td class="text-center"><small><?= $value->post_update_date?></small></td>
                                        <td class="text-center">
                                            <a href="<?= $link_edit?>" class="btn btn-xs btn-primary" title="Cập nhật"><i class="fa fa-edit"></i></a>
                                            <a href="<?= $link_delete?>" onclick="return Delete();" title="Xóa" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>
                                            <a href="<?= $link_status?>" class="btn btn-xs btn-warning" title="Ẩn / Hiện"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>

                                <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <?php if(isset($pagination)){echo $pagination;};?>
                        <li class="disabled"><a><?= tat_ca?>: <?= $record?> <?= bai_viet?></a></li>
                    </ul>
                </div>
            </div>
        </section>
    </aside>
</form>
<style>body > .header{margin-top:-20px;}</style>