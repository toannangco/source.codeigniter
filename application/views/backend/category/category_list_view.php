<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
    <aside class="right-side">
        <!-- BEGIN: Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <small><?= $title ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url?>/home/" title="<?= lang("set.menuleft_home")?>" data-original-title="<?= lang("set.menuleft_home")?>"><i class="fa fa-dashboard"></i> <?= trang_chu?></a></li>
                <li class="active"><?= $title ?></li>
            </ol>
        </section>
        <!-- END: Content Header (Page header) -->

        <!-- BEGIN: Main content -->
        <section class="content">
            <div class="box box-primary">
                <!-- BEGIN: Box-Header -->
                <div class="box-header">
                    <i class="fa fa-list-ol"></i>
                    <h3 class="box-title"><?= $title ?></h3>

                    <div class="pull-right box-tools">
                        <a href="<?= admin_url ?>category/add/" class="btn btn-primary btn-sm" title="<?= them?> Menu Admin">
                            <i class="fa fa-plus"></i>
                            <span><?= them?></span>
                        </a>
                    </div>
                </div>
                <!-- END: Box-Header -->

                <!-- BEGIN: Box-Table-->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th><?= ten_danh_muc?></th>
                            <th class="text-center"><?= loai?></th>
                            <th class="text-center"><?= hanh_dong?></th>
                            <th class="text-center"><?= stt?></th>
                            <th class="text-center"><?= thiet_lap?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($list) {
                            foreach ($list as $item) {
                                /**begin trang thai*/
                                $status = $item["category_status"] == 1 ? "icon-eye-open" : "icon-eye-close";
                                $status_change = $item["category_status"] == 1 ? 0 : 1;
                                $status_title = $item["category_status"] == 1 ? hien_thi : an;
                                $opacity = $item["category_status"] == 1 ? "" : "opcity02";

                                /**name ngon ngu*/
                                $infoMenuLang = $this->mcategory_lang->getData('category_lang_name',array("category_id" => $item["id"], "category_lang" => $lang));
                                if ($infoMenuLang) {
                                    $infoMenuLang["category_lang_name"] = $infoMenuLang["category_lang_name"];
                                } else {
                                    $infoMenuLang["category_lang_name"] = "<i class='text_ccc'></i>";
                                }
                                /**danh sach menu cap 2*/
                                $list_c2 = $this->mcategory->getArray('',array("category_parent" => $item["id"]), "category_orderby asc ");
                                $show_more = "";
                                if ($list_c2) {
                                    $show_more = '<i class="fa fa-angle-left"></i>';
                                }
                                $category_icon = $item['category_icon'] ? '<i class="' . $item["category_icon"] . '"></i>' : '<i class="fa fa-angle-double-right"></i>';
                                if($infoMenuLang["category_lang_name"]=="-"){
                                    echo '<tr><td colspan="5"></td></tr>';
                                }else{
                                ?>
                                <tr class="<?= $opacity ?> show_more" data-id="<?= $item["id"] ?>">
                                    <td class="cate-c1">
                                        <a class="title_sum">
                                            <?= $category_icon ?>
                                            <span><?= $infoMenuLang["category_lang_name"] ?></span>
                                            <span class="badge pull-right bg-aqua"><?= count($list_c2) ?></span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <span class="alias_cate"><?= $item["category_component"] ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="alias_cate"><?= $item["category_action"] ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-purple"><?= $item["category_orderby"] ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span>
                                            <a href="<?= admin_url . 'category/update/' . $item["id"] . '/?redirect=' . base64_encode(curPageURL()) ?>" class="btn btn-sm btn-primary" title="<?= cap_nhap?>" data-original-title="<?= cap_nhap?>"><i class="fa fa-edit"></i></a>
                                            <a href="<?= admin_url . 'category/delete/' . $item["id"] . '/?redirect=' . base64_encode(curPageURL()) ?>" class="btn btn-sm btn-danger" title="<?= xoa?>" data-original-title="<?= xoa?>" onclick="return Delete();"><i class="fa fa-trash-o"></i></a>
                                            <a href="<?= admin_url . 'category/update_status/' . $item["id"] . '/' . $status_change . '/?redirect=' . base64_encode(curPageURL()) ?>" class="btn btn-sm btn-warning" title="<?= $status_title ?>" data-original-title="<?= $status_title ?>"><i class="fa fa-eye"></i></a>
                                        </span>
                                    </td>
                                </tr>
                                <!-- BEGIN: Trình bày Menu Cấp 2-->
                                <?php
                                if ($list_c2) {
                                    foreach ($list_c2 as $item_c2) {
                                        /**begin trang thai*/
                                        $status_c2 = $item_c2["category_status"] == 1 ? "icon-eye-open" : "icon-eye-close";
                                        $status_change_c2 = $item_c2["category_status"] == 1 ? 0 : 1;
                                        $status_title_c2 = $item_c2["category_status"] == 1 ? hien_thi : an ;
                                        $opacity_c2 = $item_c2["category_status"] == 1 ? "" : "opcity02";

                                        /**name ngon ngu*/
                                        $infoMenuLang_c2 = $this->mcategory_lang->getData('category_lang_name',array("category_id" => $item_c2["id"], "category_lang" => $lang));
                                        if ($infoMenuLang_c2) {
                                            $infoMenuLang_c2["category_lang_name"] = $infoMenuLang_c2["category_lang_name"];
                                        } else {
                                            $infoMenuLang_c2["category_lang_name"] = $infoMenuLang_c2["category_lang_name_alias"] = "<i class='text_ccc'>".cho_cap_nhap."</i>";
                                        }
                                        $category_icon_c2 = $item_c2['category_icon'] ? '<i class="' . $item_c2["category_icon"] . '"></i>' : '<i class="fa fa-angle-double-right"></i>';
                                        ?>
                                        <tr class="<?= $opacity_c2 ?> show_more_<?= $item["id"] ?> show_more_hidden">
                                            <td class="cate-c2">
                                                <a class="title_sum">
                                                    <?= $category_icon_c2 ?>
                                                    <span><?= $infoMenuLang_c2["category_lang_name"] ?></span>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <span class="alias_cate"><?= $item_c2["category_component"] ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="alias_cate"><?= $item_c2["category_action"] ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-fuchsia"><?= $item_c2["category_orderby"] ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span>
                                                    <a href="<?= admin_url . 'category/update/' . $item_c2["id"] . '/?redirect=' . base64_encode(curPageURL()) ?>" class="btn btn-sm btn-primary" title="<?= cap_nhap?>" data-original-title="<?= cap_nhap?>"><i class="fa fa-edit"></i></a>
                                                    <a href="<?= admin_url . 'category/delete/' . $item_c2["id"] . '/?redirect=' . base64_encode(curPageURL()) ?>" class="btn btn-sm btn-danger" title="<?= xoa?>" data-original-title="<?= xoa?>" onclick="return Delete();"><i class="fa fa-trash-o"></i></a>
                                                    <a href="<?= admin_url . 'category/update_status/' . $item_c2["id"] . '/' . $status_change_c2 . '/?redirect=' . base64_encode(curPageURL()) ?>" class="btn btn-sm btn-warning" title="<?= $status_title_c2 ?>" data-original-title="<?= $status_title_c2 ?>"><i class="fa fa-eye"></i></a>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    /**end foreach cap 2*/
                                } /**end if cap 2*/
                                }
                                ?>
                                <!-- BEGIN: Trình bày Menu Cấp 2-->
                            <?php
                            }
                            /**end foreach cap 1*/
                        } /**end if cap 1*/
                        ?>
                        </tbody>
                        </tbody>
                    </table>
                </div>
                <!-- END: Box-Table-->
            </div>
        </section>
        <!-- END: Main content -->
    </aside>
</form>