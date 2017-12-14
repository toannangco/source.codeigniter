<?php 
 
 if(!empty($_SERVER['REQUEST_URI'])){
    $menu_alias = $_SERVER['REQUEST_URI'];
    $menu_alias = ltrim($menu_alias,'/');
    $menu_alias = explode('/',$menu_alias);
    $menu_alias = str_replace('.html', '',$menu_alias[0]);
	 
	// Get id from alias
	$root = $this->mmenu->getInfoAlias($menu_alias,$lang='vn');
	$this->mmenu->leftNews( 'news', $menu_parent = $root['id'], $lang='vn' ) ; 
	$data = $this->mmenu->leftNews( 'news', $menu_parent = $root['id'], $lang='vn' ) ;
	if(!$data){
		// get menu parent
		$parent = $this->mmenu->getIdParent($menu_alias ,$lang='vn') ;
		$data   = $this->mmenu->leftNews( 'news', $menu_parent =$parent, $lang='vn' ) ; 
	}
 }
 
?>
<div class="category" style="margin-top:-20px;">
<div class="items">
	<div class="item ">  
		<ul class="all">
			 <?php  echo $data ;  ?>
		</ul>
	</div>
</div>
</div>