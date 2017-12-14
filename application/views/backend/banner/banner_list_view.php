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
                    <i class="fa fa-bar-chart-o"></i>
                    <h3 class="box-title"><?= $title ?></h3>
                    <div class="pull-right box-tools">
                        <a href="<?= admin_url ?>banner/add_banner/" class="btn btn-primary btn-sm" title="<?= them?> Banner">
                            <i class="fa fa-plus"></i>
                            <span><?= them?></span>
                        </a>
                    </div>
                </div>

                <div id="example1_wrapper" class="box-body" role="grid">
                    <div class="row">
                         
                      <!--  <div class="form-group col-md-2">
                            <select onchange="this.form.submit()" name="tpos" class="form-control input-sm">
                                <option value="0">-- Vị trí --</option>
                                <?php $this->mposition->dropDown($tpos); ?>
                            </select>
                        </div> -->
                        <div class="form-group col-md-2">
                            <select onchange="this.form.submit()" name="tstatus" class="form-control input-sm">
                                <option <?= $tstatus == 1 ? "selected":"";?> value="1"><?= hien_thi?></option>
                                <option <?= $tstatus == 0 ? "selected":"";?> value="0"><?= an?></option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" name="fkeyword" class="form-control input-sm" placeholder="<?= tim_kiem?>" value="<?= $fkeyword; ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
                        </div>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-bordered table-striped dataTable table-checkbox" aria-describedby="example1_info">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10px;">ID</th>
                                <th><?= tieu_de?></th>
                                <th><?= vi_tri?></th>
                                <th><?= trang?> <?= hien_thi_1?></th>
                                <th class="text-center"><?= link_lien_ket?></th>
                                <th class="text-center"><?= hinh_anh?></th>
                                <th class="text-center"><?= ngay_dang?></th>
                                <th class="text-center" style="width: 129px;"><?= hanh_dong?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($list){
                            foreach($list as $item){
                                $myPosition = $this->mposition->getData('position_name,position_code',array("id"=>$item->position_id));
                                $codename = $position_name = '--';
                                if($myPosition){
                                    $position_name = $myPosition["position_name"];
                                    $codename  = $myPosition["position_code"];
                                }
                                /**begin trang thai*/
                                $link_lienket = (isset($item->banner_link) && $item->banner_link)?$item->banner_link:'';
                                $status = $item->banner_status==1?"icon-eye-open":"icon-eye-close";
                                $status_change = $item->banner_status==1?0:1;
                                $status_title = $item->banner_status==1? an : hien_thi;
                                $opacity = $item->banner_status == 1?"":"opcity02";
                                /**trang hien thi*/
                                $page = "Tất cả các trang";
                                $menu = $this->mmenu_lang->getData('',array("menu_id"=>$item->menu_id,"menu_lang"=>$lang));
                                if($menu){
                                    $page = $menu["menu_lang_name"];
                                }
                                /**picture*/
                                $picture = $item->banner_picture?base_file.'banner/'.$item->banner_picture:admin_img.'no_image.png';
                                /**button*/
                                $link_edit = admin_url.'banner/update_banner/'.$item->id.'/?redirect='.base64_encode(curPageURL());
                                $link_status = admin_url.'banner/update_status_banner/'.$item->id.'/'.$status_change.'/?redirect='.base64_encode(curPageURL());
                                $link_delete = admin_url.'banner/delete_banner/'.$item->id.'/?redirect='.base64_encode(curPageURL());
                                ?>
                                <tr class="<?= $opacity?>">
                                    <td><?= $item->id?></td>
                                    <td><?= $item->banner_title?></td>
                                    <td><small class="label label-info" title="<?= $codename?>" style="cursor: help;"><?= $position_name?></small></td>
                                    <td><small><?= $page?></small></td>
                                    <td class="text-center"><?= $link_lienket==""?"":"<a href='".$link_lienket."' title='".bam_vao_de_mo." ".link_lien_ket."' class='btn btn-success btn-xs' target='blank' ><i class='fa fa-external-link'></i> ".link_lien_ket."</a>"?></td>
                                    <td class="text-center">
                                        <a href="<?= $picture?>" class="image zoom_img tip-bottom" data-original-title="<?= bam_vao_xem_anh_lon?>">
                                            <img src="<?= $picture?>" alt="<?= $item->banner_title?>" title="<?= $item->banner_title?>" class="img-circle">
                                        </a>
                                    </td>
                                    <td class="text-center"><small class="text-gray"><?= date("d/m/Y",$item->banner_create_date)?></small></td>
                                    <td class="text-center">
                                        <a href="<?= $link_edit?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="<?= $link_delete?>" onclick="return Delete();" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                                        <a href="<?= $link_status?>" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <?php if(isset($pagination)){echo $pagination;};?>
                        <li class="disabled"><a><?= tat_ca?>: <?= $record?> item</a></li>
                    </ul>
                </div>
            </div>
        </section>
    </aside>
</form>