<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <title><?= $title?></title>
    <meta name="description" content="<?php if(defined('config_description')){echo  $title.' '.config_description;}else{ isset($title)?$title:company;}?>"/>
    <meta name="keywords" content="<?php if(defined('config_keyword')){echo $title.' '.config_keyword;}else{ isset($title)?$title:company;}?>"/>
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_css?>bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_css?>intro.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Navigation -->
    <nav class="navigation font-1">
        <ul class="list-inline">
            <?php
            if(!empty($myMenuTop))
            {
                $i = 1;
                foreach ($myMenuTop as $key => $value) {
                    $active = $this->uri->segment(1)== $value['menu_com'].'-'.$value['menu_alias'] ? 'active':'';
                    $link = base_url().$value['menu_com'].'-'.$value['menu_alias'].'/';
                    if($value['menu_com']=='welcome'){
                        $link = base_url();
                    }
                    echo '<li class="'.$active.'">';
                        echo '<a href="'.$link.'">'.$value['menu_name'].'</a>';
                    echo '</li>';
                }
            }
            ?>
        </ul>
    </nav>
    <!--END: navigation-->
    <!-- Full Page Image Background Carousel Header -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php
            if(!empty($welcome))
            {
                $i=0;
                foreach ($welcome as $key => $value) {
                    $active= $i++ == 0 ? ' active' : '';
                    ?>
                    <li data-target="#myCarousel" data-slide-to="<?= $key?>" class="<?= $active?>"><?= $key?></li>
                    <?php
                }
            }
            ?>
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <?php
            if(!empty($welcome))
            {
                $i=1;
                foreach ($welcome as $key => $value) {
                    $active= $i++ == 1 ? ' active' : '';
                    $picture = base_file.'banner/'.$value['banner_picture'];
                    $ahref = !empty($value['banner_link']) ? 'href="'.$value['banner_link'].'"' : '';
                    ?>
                    <div class="item<?= $active?>">
                        <div class="fill" style="background-image: url(<?= $picture?>);"></div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </header>   
    <!--END: slide-->
    <section class="logo">
        <a href="<?= base_url;?>" title=""><img src="<?= base_img?>logo.png" alt="logo"></a>
    </section>
    <!--END: logo-->
    <section class="sidebar-intro support-intro font-1">
        <?php
        if(!empty($support))
        {
            foreach ($support as $key => $value) {
                ?>
                 <a href="ymsgr:sendIM?<?= $value->company_support_yahoo?>">
                    <img border="0" title="<?= $value->company_support_name?>" alt="<?= $value->company_support_name?>" src="<?= base_img?>online.gif"> 
                    <?= $value->company_support_name?>
                </a>
                <?php
            }
        }
        ?>
    </section>
    <!--END: art-nostyle-->
    <section class="sidebar-intro social-intro">
        <ul class="list-unstyled">
            <?php if(company_facebook_1) { ?><li><a target="_blank" href="<?= company_facebook_1?>"> <i class="fa fa-facebook"></i></a></li><?php } ?>
            <?php if(company_google_1) { ?><li><a target="_blank" href="<?= company_google_1?>"> <i class="fa fa-google-plus"></i></a></li><?php } ?>
            <?php if(company_twitter_1) { ?><li><a target="_blank" href="<?= company_twitter_1?>"><i class="fa fa-twitter"></i></a></li><?php } ?>
            <?php if(company_youtube_1) { ?><li><a target="_blank" href="<?= company_youtube_1?>"><i class="fa fa-youtube"></i></a></li><?php } ?>
        </ul>
    </section>
    <!--END: social-intro-->
    <footer class="footer">
        <p>Copyright &copy; 2015 <?= company?>. All rights reserved. </p>
    </footer>
    <!--END: footer-->
    <!-- jQuery -->
    <script src="<?= base_js?>jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_js?>bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
