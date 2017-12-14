<!-- Right side column. Contains the navbar and content of the page -->
<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
    <aside class="right-side">
        <!-- BEGIN: Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <small><?= $title?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url?>/home/" title="<?= lang("set.menuleft_home")?>" data-original-title="<?= lang("set.menuleft_home")?>"><i class="fa fa-dashboard"></i> <?= trang_chu?></a></li>
                <li class="active"><?= $title ?></li>
            </ol>
        </section>
        <!-- END: Content Header (Page header) -->

        <!-- BEGIN: Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN: Thêm từ vào Từ điển-->
                    <div class="box box-success">
                        <!-- BEGIN: Box-Header -->
                        <div class="box-header">
                            <i class="fa fa-plus-square"></i>
                            <h3 class="box-title"><?= nhap_tu_dien?> (<?= count($list)?>)</h3>
                            <!-- BEGIN: Tools -->
                            <div class="pull-right box-tools">
                                <button class="btn btn-success btn-sm refresh-btn" data-toggle="tooltip" title="" data-original-title="Reload"><i class="fa fa-refresh"></i></button>
                                <button class="btn btn-success btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-success btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
                            </div>
                            <!-- END: Tools -->
                        </div>
                        <!-- END: Box-Header -->

                        <!-- BEGIN: Box-Body-->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label"><?= ghi_chu?></label>
                                        <div class="controls">
                                            <input class="form-control input-sm translate_name" required="required" type="text" name="translate_name" placeholder="" id="translate_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Alias code</label>
                                        <div class="controls">
                                            <input class="form-control input-sm" required="required" type="text" name="translate_alias" placeholder="" id="translate_alias" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <?php
                            if($language){
                                foreach($language as $item){
                                    if(isset($item['language_name']) && $item['language_name']){
                                        $img =(isset($item['language_picture']) && $item['language_picture'])?base_file.'/language/thumbnail/'.$item['language_picture']:'';
                                        ?>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-15">
                                            <div class="input-group">
                                                <span class="input-group-addon"><?php if($img) { ?><img src="<?= $img?>" /><?php } ?></span>
                                                <input type="text" class="form-control" id="<?= $item['language_alias']?>" name="<?= $item['language_alias']?>" placeholder="<?= $item['language_name']?> (<?= $item['language_name_short']?>)">
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }
                            }
                            ?>
                            </div>
                        </div>
                        <!-- BEGIN: Box-Body-->

                        <!-- BEGIN: Box-Footer-->
                        <div class="box-footer text-center">
                            <button type="submit" class="btn btn-primary" name="submit">
                                <i class="fa fa-save"></i>
                                <span><?= them?></span>
                            </button>
                            <button type="reset" class="btn btn-danger">
                                <i class="fa fa-refresh"></i>
                                <span><?= nhap_lai?></span>
                            </button>
                        </div>
                        <!-- END: Box-Footer-->
                    </div>
                    <!-- END: Thêm từ vào Từ điển-->

                    <!-- BEGIN: Tra, Dịch từ điển -->
                    <div class="nav-tabs-custom">
                        <!-- BEGIN: Box-Header -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab"><?= danh_sach?></a></li>
                            <li>
                                <input type="text" name="table_search_translate" id="table_search_translate" class="form-control input-sm"  placeholder="<?= tim_kiem?>">
                            </li>
                            <li class="pull-right"><a href="<?= admin_url?>/language/"  class="text-muted" title="<?= quan_ly_ngon_ngu?>" data-original-title="<?= quan_ly_ngon_ngu?>"><i class="fa fa-gear"></i></a></li>
                        </ul>
                        <!-- END: Box-Header -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th><?= ghi_chu?></th>
                                            <th style="max-width: 100px">Alias code</th>
                                            <?php
                                            if($language){
                                                foreach($language as $item){
                                                    if(isset($item['language_name']) && $item['language_name']){
                                                        $img =(isset($item['language_picture']) && $item['language_picture'])?base_file.'/language/thumbnail/'.$item['language_picture']:'';
                                                        ?>
                                                        <th>
                                                            <?php if($img) { ?><img src="<?= $img?>" /><?php } ?>
                                                            <?= $item['language_name']?> (<?= $item['language_name_short']?>)
                                                        </th>
                                                    <?php
                                                    }
                                                }
                                            }
                                            ?>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody class="aj_search">
                                        <?php
                                        if($list){
                                            foreach($list as $item_k){
                                        ?>
                                                <tr>
                                                    <td><?= (isset($item_k['translate_name']) && $item_k['translate_name'])?$item_k["translate_name"]:""?></td>
                                                    <td><code><?= (isset($item_k['translate_alias']) && $item_k['translate_alias'])?$item_k["translate_alias"]:""?></code></td>
                                                    <?php
                                                    if($language){
                                                        foreach($language as $item){
                                                            if(isset($item['language_name']) && $item['language_name']){
                                                                $img =(isset($item['language_picture']) && $item['language_picture'])?base_file.'/language/thumbnail/'.$item['language_picture']:'';
                                                                /**begin lay ten cho tung ngon ngu*/
                                                                $translateName = $this->mtranslate_lang->getOnceAnd(array("translate_id"=>$item_k["id"],"translate_lang"=>$item['language_name_short']));
                                                                /**end lay ten cho tung ngon ngu*/
                                                                ?>
                                                                <td>
                                                                    <div class="sub_translate_name">
                                                                    <?php
                                                                        if(isset($translateName["translate_name"]) && $translateName["translate_name"]){
                                                                            echo '<div class="input-group" style="max-width: 212px;">';
                                                                                echo '<input type="text" class="form-control input-sm" disabled placeholder="'.$translateName["translate_name"].'">';
                                                                                echo '<span class="input-group-btn">
                                                                                            <button class="btn btn-success btn-flat btn-sm pointer edit_translate_name" type="button" data-id="'.$translateName["translate_id"].'" data-lang="'.$item['language_name_short'].'" data-name="'.$translateName["translate_name"].'" title="'.sua.'">
                                                                                                <i class="fa fa-edit"></i>
                                                                                            </button>
                                                                                      </span>';
                                                                            echo '</div>';
                                                                        }else{
                                                                            echo '<div class="input-group" style="max-width: 212px;">';
                                                                                echo '<input type="text" class="form-control input-sm fr_translate_name">';
                                                                                echo '<span class="input-group-btn">
                                                                                            <button class="btn btn-primary btn-flat btn-sm pointer save_translate_name" type="button" data-id="'.$item_k["id"].'" data-lang="'.$item['language_name_short'].'" data-name="" title="'.luu.'">
                                                                                                <i class="fa fa-save"></i>
                                                                                            </button>
                                                                                      </span>';
                                                                            echo '</div>';
                                                                        }
                                                                    ?>
                                                                    </div>
                                                                </td>
                                                            <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <td>
                                                        <a href="<?= admin_url?>translate/delete/<?= $item_k['id']?>/?redirect=<?= base64_encode(current_url())?>" onclick="return Delete();" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
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
                        </div>
                    </div>
                    <!-- BEGIN: Tra, Dịch từ điển -->
                </div>
            </div>
        </section>
        <!-- BEGIN: Main content -->
    </aside>
</form>