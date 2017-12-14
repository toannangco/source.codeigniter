 <link  rel="stylesheet" type="text/css" href="<?=base_css?>document.css">
<div class="list-breadcrum" style="margin-top: -21px;">
	<div class="container" >
		<ul class="list-inline">
			 <li>  <a href="<?=base_url()?>">Trang chủ ></a>  </li>
            <?php if($menuInfo['menu_name']!=$title) { ?>
            <li> <a href="<?=base_url() . $menuInfo['menu_alias']?>/"><?=$menuInfo['menu_name']?> ></a>  </li>
            <?php } ?>
            <li class="active"><a ><?=$view['document_name']?> </a></li>
		</ul>
	</div>
</div>
 <div class="container" >
	<div class="col-study-step row " >
		 <div class="col-md-8 col-xs-12">
			<h4><?=$view['document_name']?> </h4>
			<p><i><?=$view['document_summary']?></i></p>
			<div style="padding-bottom:30px;">
				<a href="<?=base_file.'document/'.$view['document_file']?>" download class="clickdownload" data-id=<?=$view['id']?> >Bấm vào đây để tải</a>
			</div>
			
			<iframe src="<?=base_file.'document/'.$view['document_file']?>" width="100%" height="600px"></iframe>
			<?=$view['document_detail']?>
			
		 </div>
		 <div class="col-md-4 col-xs-12"> 
			<div class="sidebar-block" style="padding-top:10px;">
				<div class="title-header-bl"><h2>Kho học liệu download</h2><span><i class="fa fa-angle-right arow"></i></span></div>
				
				<ul class="menuSub">
					 <?php  $this->mmenu->dropChild( "document",31,"" ); ?>
				 </ul>
			</div>
		 </div>
		
	</div>
	 
</div>
 