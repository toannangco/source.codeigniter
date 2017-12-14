<div class="breadcrumb-container">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><?=trang_chu?></a></li>
            <li><a href="<?=base_url . $menuInfo['menu_alias']?>.html"><?=$menuInfo['menu_name']?></a></li>
            <li class="active"><?=strip_tags($title)?></li>
        </ol>
    </div>
</div>
<section class="main-content">
    <div class="container content articles-box product-detail">
        <header class="title-01">
            <h1 class="title"><?= $title;?></h1>
        </header>
        <!--BEGIN: Info-product -->
        <div id="info-product">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
                    <div class="album-gallery">
                      <img id="image-zoom" src="<?=base_file . 'product/' . $info->product_picture?>" data-zoom-image="<?=base_file . 'product/' . $info->product_picture?>" width="274" height="274">
                      <?php
                      echo '<div id="images-gal" class="mt10">';
                      echo '<a data-image="' . base_file . 'product/' . $info->product_picture . '" data-zoom-image="' . base_file . 'product/' . $info->product_picture . '">
                      <img id="img_01" src="' . base_file . 'product/' . $info->product_picture . '">
                  </a>';
                  if (!empty($infoPicture)) {
                    foreach ($infoPicture as $key => $value) {
                        if (empty($value)) {
                            continue;
                        }
                        $pic = base_file . 'product/' . $value['product_picture_name'];
                        echo '<a data-image="' . $pic . '" data-zoom-image="' . $pic . '">
                        <img id="img_01" src="' . $pic . '">
                    </a>';
                }
            }
            echo '</div>';
            ?>
        </div>
    </div>
    <!-- END: Album-Gallery -->
    <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7 ">
        <div class="table-responsive table-detail-info ">
            <div class="form-group social-plugin form-inline">
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55754f8f36234635" async=""></script>
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div data-title="Document" data-url="<?=current_url()?>" class="addthis_native_toolbox"><div class="at-share-tbx-element addthis_default_style addthis_20x20_style addthis-smartlayers addthis-animated at4-show" id="atstbx2"><a fb:like:layout="button_count" class="addthis_button_facebook_like at300b"><div fb-iframe-plugin-query="action=like&amp;app_id=172525162793917&amp;container_width=0&amp;font=arial&amp;href=http%3A%2F%2Fhtml.devwebapp.com%2FTaiTruongThanh%2Fproduct-detail.html&amp;layout=button_count&amp;locale=en_US&amp;ref=.VkrPvsMeHyY.like&amp;sdk=joey&amp;send=false&amp;share=false&amp;show_faces=false&amp;width=90" fb-xfbml-state="rendered" data-send="false" data-href="http://html.devwebapp.com/TaiTruongThanh/product-detail.html" data-font="arial" data-width="90" data-action="like" data-share="false" data-show_faces="false" data-layout="button_count" class="fb-like fb_iframe_widget" data-ref=".VkrPvsMeHyY.like"><span style="vertical-align: bottom; width: 76px; height: 20px;"><iframe class="" src="http://www.facebook.com/v2.0/plugins/like.php?action=like&amp;app_id=172525162793917&amp;channel=http%3A%2F%2Fstatic.ak.facebook.com%2Fconnect%2Fxd_arbiter%2FwjDNIDNrTQG.js%3Fversion%3D41%23cb%3Df1d8bc6cb819fee%26domain%3Dhtml.devwebapp.com%26origin%3Dhttp%253A%252F%252Fhtml.devwebapp.com%252Ff160c43c7c11646%26relation%3Dparent.parent&amp;container_width=0&amp;font=arial&amp;href=http%3A%2F%2Fhtml.devwebapp.com%2FTaiTruongThanh%2Fproduct-detail.html&amp;layout=button_count&amp;locale=en_US&amp;ref=.VkrPvsMeHyY.like&amp;sdk=joey&amp;send=false&amp;share=false&amp;show_faces=false&amp;width=90" style="border: medium none; visibility: visible; width: 76px; height: 20px;" title="fb:like Facebook Social Plugin" scrolling="no" allowfullscreen="true" allowtransparency="true" name="f3b44b3d03b78ca" frameborder="0" height="1000px" width="90px"></iframe></span></div></a><a class="addthis_button_tweet at300b"><a data-width="110" data-hashtags="" data-related="" data-text="Document:" data-count="horizontal" data-counturl="http://html.devwebapp.com/TaiTruongThanh/product-detail.html" data-url="http://html.devwebapp.com/TaiTruongThanh/product-detail.html#.VkrPvvGTis8.twitter" class="twitter-share-button" href="http://twitter.com/share">Tweet</a></a><a g:plusone:size="medium" class="addthis_button_google_plusone at300b"><div id="___plusone_0" style="text-indent: 0px; margin: 0px; padding: 0px; background: transparent none repeat scroll 0% 0%; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; display: inline-block; width: 90px; height: 20px;"><iframe title="+1" data-gapiattached="true" src="https://apis.google.com/u/0/se/0/_/+1/fastbutton?usegapi=1&amp;size=medium&amp;hl=en-US&amp;origin=http%3A%2F%2Fhtml.devwebapp.com&amp;url=http%3A%2F%2Fhtml.devwebapp.com%2FTaiTruongThanh%2Fproduct-detail.html&amp;gsrc=3p&amp;ic=1&amp;jsh=m%3B%2F_%2Fscs%2Fapps-static%2F_%2Fjs%2Fk%3Doz.gapi.vi.onj4kFgAweM.O%2Fm%3D__features__%2Fam%3DAQ%2Frt%3Dj%2Fd%3D1%2Ft%3Dzcms%2Frs%3DAGLTcCN1Gmin3ZhGMHXDaLaIgL6Y6XmRxQ#_methods=onPlusOne%2C_ready%2C_close%2C_open%2C_resizeMe%2C_renderstart%2Concircled%2Cdrefresh%2Cerefresh&amp;id=I0_1447743426284&amp;parent=http%3A%2F%2Fhtml.devwebapp.com&amp;pfname=&amp;rpctoken=15697231" name="I0_1447743426284" id="I0_1447743426284" vspace="0" tabindex="0" style="position: static; top: 0px; width: 90px; margin: 0px; border-style: none; left: 0px; visibility: visible; height: 20px;" scrolling="no" marginwidth="0" marginheight="0" hspace="0" frameborder="0" width="100%"></iframe></div></a><div class="atclear"></div></div></div>
            </div>
            <!-- END: Addthis-->

            <table class="table info-product">
                <tbody>
                  <tr>
                    <td>
                        <span class="fa fa-dollar"></span> <strong>Giá: </strong>
                    </td>
                    <td>
                        <?php
                        $price     = 'Vui lòng gọi';
                        $promotion = 0;
                        $percen    = 0;
                        if (is_numeric($info->product_lang_price)) {
                            $price = number_format($info->product_lang_price) . ' VND';
                        }
                        if (is_numeric($info->product_lang_promotion) && $info->product_lang_promotion > 0) {
                            $promotion = number_format($info->product_lang_promotion) . ' VND';
                            $percen    = ($info->product_lang_promotion * 100) / $info->product_lang_price;
                            $percen    = round((100 - $percen), 0);
                        }
                        if ($promotion) {
                            echo '<p class="price promotion">' . $price . '</p>';
                            echo '<p class="price ">' . $promotion . '</p>';
                        } else {
                            echo '<p class="price promotion"></p>';
                            echo '<p class="price ">' . $price . '</p>';
                        }
                        ?>
                    </td>
                </tr>
                <?php if (!empty($info->product_code)) {?>
                <tr>
                    <td>
                        <span class="fa fa-barcode"></span> <strong>Mã Sản phẩm</strong>
                    </td>
                    <td><?=$info->product_code;?></td>
                </tr>
                <?php }
                ?>
                <tr>
                    <td>
                        <span class="fa fa-industry"></span>
                        <strong> Tên Sản phẩm</strong>
                    </td>
                    <td><?=$info->product_lang_name;?></td>
                </tr>
                <?php if ($info->product_lang_quality > 0) {?>
                <tr>
                    <td>
                        <i class="fa fa-sort-numeric-asc"></i>
                        <strong> Số lượng</strong>
                    </td>
                    <td><?=$info->product_lang_quality;?></td>
                </tr>
                <?php }
                ?>

                <?php if (!empty($info->product_lang_more)) {?>
                <tr>
                    <td colspan="2">
                        <pre class="my-font"><?=$info->product_lang_more;?></pre>
                    </td>
                </tr>
                <?php }
                ?>


                <?php if (!empty($info->product_lang_seo_keyword)) {
                    ?>
                    <tr>
                        <td colspan="2">
                            <?php
                            $tag = explode(',', $info->product_lang_seo_keyword);
                            echo '<span class="tagged_as">';
                            echo 'Tags:';
                            foreach ($tag as $key => $value) {
                                $link_tag = base_url . 'tim-kiem/?fkey=' . $value;
                                echo '<a href="' . $link_tag . '">' . $value . '</a>, ';
                            }
                            echo '</span>';
                            ?>
                        </td>
                    </tr>
                    <?php }
                    ?>
                    <tr>
                        <td colspan="2" class="products">
                            <button type="button" class="aj_shopping btn btn-default btn-cart text-center" data-id="<?=$info->id?>" role="button" data-toggle="tooltip" data-placement="bottom" data-original-title="Đặt hàng">
                                <span>Đặt hàng</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!--END: detail-info-->
        </div>
    </div>
    <!-- END: Info-->
</div>
</div>
<!--END: Info-product -->
<div class="description-detail text-justify">
    <ul class="nav nav-tabs click_option">
        <li class="active">
            <a href="#tabs-1" data-toggle="tab">Thông tin sản phẩm</a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="tabs-1" class="tab-pane active tab-product">
          <div class="description">
            <div class="content_product pull-left col-xs-12 col-sm-12">
              <?=!empty($info->product_lang_detail) ? $info->product_lang_detail : '<i>Đang cập nhật</i>';?>
          </div>
      </div>
  </div>
</div>
</div>
<!--END: description-detail-->
<div class="similar-product products">
    <div class="wrapper-title-main">
        <header class="title-01">
            <h3 class="title">Sản phẩm tương tự</h1>
            </header>
        </nav>
    </div>
    <!-- /.title-main2-->
    <?php
    if (!empty($same)) {
        foreach ($same as $key => $value) {
            $picture   = base_file . 'product/' . $value->product_picture;
            $link      = base_url . $menuInfo['menu_alias'] . '/' . $value->product_lang_alias . '-product' . $value->id . '.html';
            $price     = 'Vui lòng gọi';
            $promotion = 0;
            $percen    = 0;
            if (is_numeric($value->product_lang_price)) {
                $price = number_format($value->product_lang_price) . ' VND';
            }
            if (is_numeric($value->product_lang_promotion) && $value->product_lang_promotion > 0) {
                $promotion = number_format($value->product_lang_promotion) . ' VND';
                $percen    = ($value->product_lang_promotion * 100) / $value->product_lang_price;
                $percen    = round((100 - $percen), 0);
            }
            ?>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <a class="thumbnail" href="<?=$link?>">
                    <img src="<?=$picture?>" alt="<?=$value->product_lang_name;?>">
                    <span class="new">New</span>
                </a>
                <div class="info text-center">
                    <div class="text-center">
                        <header class="title-product"><?=$value->product_lang_name;?></header>
                        <div class="price-box">
                            <span class="price"><?=$price?></span>
                        </div>
                    </div>
                    <button type="button" class="aj_shopping btn btn-default btn-cart text-center" data-id="<?=$value->id?>" role="button" data-toggle="tooltip" data-placement="bottom" data-original-title="Đặt hàng">
                        <span>Đặt hàng</span>
                    </button>
                </div>
            </div>
            <?php
        }
    }
    ?>
    <!-- /.wrapper-owl-->
</div>
</div>
</section>