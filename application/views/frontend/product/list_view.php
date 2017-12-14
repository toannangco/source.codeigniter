<div class="breadcrumb-container">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="<?= base_url()?>"><?= trang_chu?></a></li>
                <li class="active"><?= strip_tags($title)?></li>
            </ol>
        </div>
    </div>
    <section class="main-content">
        <div class="products">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 sidebar-left">
                        <?php $this->load->view("template/frontend/usercontrol/right.php"); ?>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                        <header class="title-01">
                            <h2 class="title"><?= $title?></h2>
                        </header>
                        <div class="row list-product">
                        <?php
                        if(!empty($list))
                        {
                            foreach ($list as $key => $value) {
                                $picture = base_file.'product/'.$value->product_picture;
                                $link= base_url.$menuInfo['menu_alias'].'/'.$value->product_lang_alias.'-product'.$value->id.'.html';
                                $price = 'Vui lòng gọi';
                                $promotion = 0;
                                $percen = 0;
                                if(is_numeric($value->product_lang_price))
                                {
                                    $price = number_format($value->product_lang_price) .' VND';
                                }
                                if(is_numeric($value->product_lang_promotion) && $value->product_lang_promotion > 0)
                                {
                                    $promotion = number_format($value->product_lang_promotion) .' VND';
                                    $percen = ($value->product_lang_promotion*100)/$value->product_lang_price;
                                    $percen = round((100 - $percen),0);
                                }
                                ?>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <a class="thumbnail" href="<?= $link?>">
                                        <img src="<?= $picture?>" alt="<?= $value->product_lang_name; ?>">
                                        <span class="new">New</span>
                                    </a>
                                    <div class="info text-center">
                                        <div class="text-center">
                                            <header class="title-product"><?= $value->product_lang_name; ?></header>
                                            <div class="price-box">
                                                <span class="price"><?= $price?></span>
                                            </div>
                                        </div>
                                        <button type="button" class="aj_shopping btn btn-default btn-cart text-center" data-id="<?= $value->id?>" role="button" data-toggle="tooltip" data-placement="bottom" data-original-title="Đặt hàng">
                                            <span>Đặt hàng</span>
                                        </button>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        else{
                            echo '<i>Dữ liệu đang cập nhật !</i>';
                        }
                        ?>
                        <!-- /.blog holder -->
                        <div class="col-md-12 tp-pagination">
                            <ul class="pagination">
                                <?php echo $pagination;?> 
                            </ul>
                        </div>
                        </div>
                    </div>
                </div>                      
            </div>
        </div>
    </section>