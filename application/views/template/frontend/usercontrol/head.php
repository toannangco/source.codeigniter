	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= strip_tags($title) ?> » <?=company?></title>
    <meta name="description" content="<?= strip_tags($description); ?>"/>
    <meta name="keywords" content="<?= strip_tags($keywords);?>"/>
    <link rel="shortcut icon" href="<?= base_url()?>favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= base_url()?>favicon.ico" type="image/x-icon">
    <meta property="og:image" content="<?= trim($picture);?>"/>
    <meta property="og:title" content="<?= strip_tags($title)?>"/>
    <meta property="og:site_name" content="<?= company;?>"/>
    <meta property="og:url" content="<?= current_url()?>"/>
    <meta property="og:description" content="<?= strip_tags($description); ?>" />
    <meta property="og:type" content="website" />
	<link rel="stylesheet" type="text/css" href="<?=base_css?>bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_css?>font-awesome.min.css">		
	<link rel="stylesheet" type="text/css" href="<?=base_css?>head.menu.css">
	<link rel="stylesheet" type="text/css" href="<?=base_css?>jquery.mmenu.all.css">		
	<link rel="stylesheet" type="text/css" href="<?=base_css?>style.css">
	<link rel="stylesheet" type="text/css" href="<?=base_css?>animate.css">
	
	<script type='text/javascript' src="<?=base_js?>jquery.min.js"></script>
	<script type="text/javascript">
        var configs = {
            base_url: '<?= base_url()?>', 
            curren_url: '<?= current_url();?>',
        }
		var base_url = "<?= base_url()?>" ;
    </script> 
	
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1372650639511833',
      xfbml      : true,
      version    : 'v2.11'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

 
 
 