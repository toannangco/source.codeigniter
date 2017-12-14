CREATE TABLE IF NOT EXISTS `tkwp_product` (
  `id` int(11) NOT NULL,
  `product_parent` int(11) NOT NULL,
  `product_area_local_id` int(11) NOT NULL,
  `product_area_id` int(11) NOT NULL,
  `product_sizeid` int(11) NOT NULL,
  `product_subid` int(11) NOT NULL,
  `product_techid` int(11) NOT NULL,
  `product_height` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_width` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_length` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_orderby` int(11) NOT NULL,
  `product_picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_hot` tinyint(4) NOT NULL,
  `product_home` tinyint(4) NOT NULL,
  `product_view` int(11) NOT NULL,
  `product_like` int(11) NOT NULL,
  `product_unlike` int(11) NOT NULL,
  `product_status` tinyint(4) NOT NULL,
  `product_create_date` int(11) NOT NULL,
  `product_update_date` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `buildings` tinyint(4) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tkwp_product`
--

INSERT INTO `tkwp_product` (`id`, `product_parent`, `product_area_local_id`, `product_area_id`, `product_sizeid`, `product_subid`, `product_techid`, `product_height`, `product_width`, `product_length`, `product_orderby`, `product_picture`, `product_hot`, `product_home`, `product_view`, `product_like`, `product_unlike`, `product_status`, `product_create_date`, `product_update_date`, `customer`, `buildings`, `user`) VALUES
(1, 3, 0, 0, 0, 0, 0, '0', '0', '0', 0, 'GC04BC-795-3ok.jpg', 1, 0, 5, 0, 0, 1, 1456419430, 1456419430, 0, 0, 1),
(2, 3, 0, 0, 0, 0, 0, '0', '0', '0', 0, 'CAO-GOT-QUAI-NGANG-103GR.jpg', 1, 0, 2, 0, 0, 1, 1456488122, 1456488122, 0, 0, 1),
(3, 3, 0, 0, 0, 0, 0, '0', '0', '0', 0, 'IMG_20151019_124228.jpg', 1, 0, 0, 0, 0, 1, 1456489199, 1456489199, 0, 0, 1),
(4, 3, 0, 0, 0, 0, 0, '0', '0', '0', 0, 'giay-kalani-giay-vnxk-2.jpg', 1, 0, 0, 0, 0, 1, 1456489279, 1456489279, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_product_lang`
--

CREATE TABLE IF NOT EXISTS `tkwp_product_lang` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_lang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_code` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `product_lang_name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `product_lang_alias` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `product_lang_search` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `product_lang_price` int(11) NOT NULL,
  `product_lang_promotion` int(11) NOT NULL,
  `product_lang_quality` tinyint(4) NOT NULL,
  `product_lang_madein` tinyint(4) NOT NULL,
  `product_lang_warranty` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `product_lang_unit` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `product_lang_quantity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_lang_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `product_lang_more` text COLLATE utf8_unicode_ci NOT NULL,
  `product_lang_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_lang_using` text COLLATE utf8_unicode_ci NOT NULL,
  `product_lang_advantage` text COLLATE utf8_unicode_ci NOT NULL,
  `product_lang_unadvantage` text COLLATE utf8_unicode_ci NOT NULL,
  `product_lang_seo_title` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `product_lang_seo_keyword` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `product_lang_seo_description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tkwp_product_lang`
--

INSERT INTO `tkwp_product_lang` (`id`, `product_id`, `product_lang`, `product_code`, `product_lang_name`, `product_lang_alias`, `product_lang_search`, `product_lang_price`, `product_lang_promotion`, `product_lang_quality`, `product_lang_madein`, `product_lang_warranty`, `product_lang_unit`, `product_lang_quantity`, `product_lang_detail`, `product_lang_more`, `product_lang_address`, `product_lang_using`, `product_lang_advantage`, `product_lang_unadvantage`, `product_lang_seo_title`, `product_lang_seo_keyword`, `product_lang_seo_description`) VALUES
(1, 1, 'vn', 'GC09CB', 'GIÀY VNXK CAO GÓT MŨI NHỌN – GC09CB', 'giay-vnxk-cao-got-mui-nhon-gc09cb', '0', 789000, 0, 0, 0, '0', '0', '0', '<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;"><span style="box-sizing: border-box; outline: none 0px !important; font-weight: 700;">GI&Agrave;Y VNXK 100% DA TỰ NHI&Ecirc;N</span></p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">M&atilde; h&agrave;ng:&nbsp;<span style="box-sizing: border-box; outline: none 0px !important; font-weight: 700;">GC09CB</span></p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">Loại: Gi&agrave;y g&oacute;t cao</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">Chất liệu</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">+ Mũi gi&agrave;y: Da cừu</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">+ L&oacute;t trong: Da heo</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">+ L&oacute;t tẩy: Da heo</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">+ Đế: Cao su tổng hợp (chống trơn trượt)</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">Chiều cao g&oacute;t: 8cm</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">M&agrave;u sắc: Nude, Đen, Cobalt, Đỏ, Bordo</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">Size: 34-35-36-37-38-39</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">Thương hiệu: KALANI</p>\n', '', '', '<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">Thiết kế mũi gi&agrave;y sang trọng c&ugrave;ng phần g&oacute;t mảnh đem lại phong c&aacute;ch quyến rũ v&agrave; gợi cảm cho c&aacute;c n&agrave;ng khi diện ch&uacute;ng. Sản phẩm được l&agrave;m từ da cừu cao cấp.</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">Mũi gi&agrave;y: DA CỪU</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">L&oacute;t trong: DA HEO</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">G&oacute;t cao: 8cm</p>\n', '', '', '', '', ''),
(2, 2, 'vn', 'GV1031GRS', 'GIÀY SANDAL QUAI NGANG VNXK', 'giay-sandal-quai-ngang-vnxk', '0', 380000, 295000, 0, 0, '0', '0', '0', '<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;"><span style="box-sizing: border-box; outline: none 0px !important; font-weight: 700;">GI&Agrave;Y SANDAL VNXK&nbsp;</span></p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">M&atilde; h&agrave;ng: GV1031GRS</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">Loại:&nbsp;Gi&agrave;y g&oacute;t vu&ocirc;ng</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">G&oacute;t cao 5cm</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">Chất liệu</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">+ Mũi gi&agrave;y: Da lộn tổng hợp</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">+ L&oacute;t trong: Da thật mềm mại, &ecirc;m &aacute;i cho đ&ocirc;i ch&acirc;n</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">+ L&oacute;t tẩy: Da thật</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">+ Đế: Cao su chống trơn trượt</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">M&agrave;u sắc: Đen, &nbsp;X&aacute;m</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">Size: 35-36-37-38-39</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">Thương hiệu:&nbsp;SABRINA</p>\n', '', '', '', '', '', '', '', ''),
(3, 3, 'vn', 'GV101P', 'GIÀY VNXK ĐẾ XUỒNG QUAI ĐÔI', 'giay-vnxk-de-xuong-quai-doi', '0', 315000, 265000, 10, 0, '0', '0', '0', '<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;"><span style="box-sizing: border-box; outline: none 0px !important; font-weight: 700;">GI&Agrave;Y VNXK&nbsp;DA TỰ NHI&Ecirc;N</span></p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">M&atilde; h&agrave;ng: GV101P</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">Loại:&nbsp;Gi&agrave;y đế xuồng</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">G&oacute;t cao 6.5cm</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">Chất liệu</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">+ Mũi gi&agrave;y: Da tổng hợp</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">+ L&oacute;t trong: Da thật</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">+ L&oacute;t tẩy: Da thật</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">+ Đế: Cao su chống trơn trượt</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">M&agrave;u sắc: Nude, Hồng phấn</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">Size: 34-35-36-37-38-39</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">Thương hiệu:&nbsp;SABRINA</p>\n', '', '', '', '', '', '', '', ''),
(4, 4, 'vn', 'BB12R', 'SANDAL QUAI CHÉO', 'sandal-quai-cheo', '0', 520000, 0, 0, 0, '0', '0', '0', '<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;"><span style="box-sizing: border-box; outline: none 0px !important; font-weight: 700;">GI&Agrave;Y VNXK 100% DA TỰ NHI&Ecirc;N</span></p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">M&atilde; h&agrave;ng:&nbsp;<span style="box-sizing: border-box; outline: none 0px !important; font-weight: 700;">BB12R</span></p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">Loại: Gi&agrave;y bệt</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">Chất liệu</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">+ Mũi gi&agrave;y: Da cừu</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">+ L&oacute;t trong: Da</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">+ L&oacute;t tẩy: Da</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">+ Đế: Cao su tổng hợp (chống trơn trượt)</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">M&agrave;u sắc: Đen, Đỏ, N&acirc;u</p>\n\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: rgb(85, 85, 85); line-height: 20px; outline: none 0px !important;">Size: 34-35-36-37-38-39</p>\n', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_product_picture`
--

CREATE TABLE IF NOT EXISTS `tkwp_product_picture` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_picture_name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `product_picture_status` tinyint(4) NOT NULL,
  `product_picture_create_date` int(11) NOT NULL,
  `product_picture_update_date` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tkwp_product`
--
ALTER TABLE `tkwp_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tkwp_product_lang`
--
ALTER TABLE `tkwp_product_lang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tkwp_product_picture`
--
ALTER TABLE `tkwp_product_picture`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tkwp_product`
--
ALTER TABLE `tkwp_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tkwp_product_lang`
--
ALTER TABLE `tkwp_product_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tkwp_product_picture`
--
ALTER TABLE `tkwp_product_picture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
