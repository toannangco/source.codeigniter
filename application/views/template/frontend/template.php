<!DOCTYPE html>
<html lang="vi">
<head >
	<?php $this->load->view("template/frontend/usercontrol/head.php"); ?>
</head>
<body>
<div id="page">
	<?
		$this->load->view("template/frontend/usercontrol/header.php");
		echo $content_for_layout;
		$this->load->view("template/frontend/usercontrol/footer");
	?>
</div>
</body>
</html>