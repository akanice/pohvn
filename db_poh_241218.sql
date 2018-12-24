-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2018 at 03:48 PM
-- Server version: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_poh`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
`id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `group` enum('admin','mod') COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `last_login` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `name`, `password`, `group`, `create_time`, `last_login`) VALUES
(4, 'hoangviet11088@gmail.com', 'Hoàng Việt', '72a02467e0aadcf0107a7ae3aeb79223', 'admin', 1451988321, 0),
(7, 'cuongnd2609@gmail.com', 'Cường', '6a5f9ad8f02e4f6b53d6aae5b50f9c22', 'admin', 1468966930, 0);

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
`id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_clicked` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `alias`, `description`, `image`, `thumb`, `total_clicked`, `url`, `create_time`) VALUES
(1, 'Bí quyết giúp thai nhi khỏe mạnh thông minh', 'bi-quyet-giup-thai-nhi-khoe-manh-thong-minh', 'Trong thai giáo có rất nhiều phương pháp khác nhau. Nếu không có đủ thời gian để áp dụng tất cả thì phải chọn phương pháp nào đây? Ưu tiên phương pháp nào trước để hiệu quả là cao nhất?', '/assets/uploads/sample-thumb.jpeg', '/assets/uploads/sample-thumb.jpeg', 96, 'https://google.com/', 1452568877),
(3, 'Bí quyết thai giáo thành công cho các mẹ bầu thông thái', 'bi-quyet-thai-giao-thanh-cong-cho-cac-me-bau-thong-thai', 'Tôi nghĩ rằng vai trò của người bố trong gia đình là rất quan trọng. Chỉ là từ trước đến giờ các ông bố chưa để ý đến việc này. Một phần do quan niệm của đa số người Việt thì việc nuôi dạy con là trách nhiệm của phụ nữ, còn trách nhiệm của chồng chỉ là kiếm tiền lo cho gia đình. Cần phải có một công cụ nào đó để khơi gợi lên tình yêu và trách nhiệm hơn nữa của Chồng bạn trong việc nuôi dạy con cái. Tôi nghĩ rằng ngay lúc này đây, khi Bạn đang mang bầu là thời điểm tốt nhất để Bạn và Chồng bạn bắt đầu. Đây là lúc Bạn cần và xứng đáng nhận được nhiều sự quan tâm và yêu thương hơn cả. Hãy thai giáo cho Con ngay từ bây giờ.', 'assets/uploads/banners/banner-noi-that-phong-an.jpg', '/assets/uploads/thumb/banners/banner-noi-that-phong-an_thumb.jpg', 0, 'https://google.com', 1545058622);

-- --------------------------------------------------------

--
-- Table structure for table `banners_source_click`
--

CREATE TABLE IF NOT EXISTS `banners_source_click` (
`id` int(11) NOT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `count_click` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE IF NOT EXISTS `configs` (
`id` int(11) NOT NULL,
  `term` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `term_id` int(11) NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`id`, `term`, `name`, `term_id`, `value`) VALUES
(1, 'home', 'cat_available', 0, '["1","2"]'),
(2, 'global', 'head_js', 0, ''),
(3, 'global', 'footer_js', 0, ''),
(4, 'category', 'featured_new', 1, '["1","4"]'),
(5, 'category', 'slogan', 1, 'Sức khỏe mẹ bầu khi mang thai rất quan trọng với bé sau này'),
(6, 'category', 'featured_new', 2, '["3","5"]');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
`id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL COMMENT 'Upload Date',
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Unblock, 0=Block'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
`id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `display_name` varchar(50) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_id`, `parent`, `display_name`, `icon`, `slug`, `number`) VALUES
(1, 1, NULL, 'Item 0', 'glyphicon glyphicon-user', 'Item-0', 1),
(2, 1, NULL, 'Item 1', 'glyphicon glyphicon-remove', 'Item-1', 2),
(3, 1, NULL, 'Item 2', '', 'Item-2', 3),
(5, 1, NULL, 'Item 4', '', 'Item-4', 5),
(6, 1, NULL, 'Item 5', '', 'Item-5', 6),
(8, 1, 1, 'Item 0.1', '', 'item-0.1', 1),
(9, 1, 1, 'Item 0.2', 'glyphicon glyphicon-search', 'item-0-2', 2),
(10, 1, 8, 'Item 0.1.1', '', 'item-0-1-1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menus_term`
--

CREATE TABLE IF NOT EXISTS `menus_term` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` enum('navigation','footer-1','footer-2','footer-3') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `menus_term`
--

INSERT INTO `menus_term` (`id`, `name`, `position`) VALUES
(1, 'Navigation Menu', 'navigation'),
(2, 'Footer menu 1', 'footer-1');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `count_view` int(11) NOT NULL,
  `type` enum('default','landing') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default',
  `language` enum('vietnamese','english') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `order`, `categoryid`, `title`, `alias`, `description`, `content`, `image`, `thumb`, `create_time`, `meta_title`, `meta_description`, `meta_keywords`, `count_view`, `type`, `language`) VALUES
(1, 1, 1, 'Thai giáo và tất cả những điều cha mẹ cần biết', 'thai-giao-va-tat-ca-nhung-dieu-cha-me-can-biet', 'Là mẹ bầu, mong muốn cháy bỏng nhất của bạn là gì? Nếu điều bạn mong muốn nhất là con yêu của bạn sinh ra được thông minh, khỏe mạnh, ngoan ngoãn, vui tươi, ít ốm đau thì xin mời bạn hãy đọc tiếp để biết bí quyết này nhé!', '<div class="entry-content clearfix">    <h2 style="text-align: justify;"><span class="ez-toc-section" id="Thai_giao_la_gi">Thai giáo là gì?</span></h2>    <p>Thai giáo là phương pháp khoa học nhằm tạo ra môi trường phù hợp giúp con yêu phát triển tốt nhất cả về thể chất và trí tuệ.</p>    <p>Thông qua các hoạt động tương tác giữa ba mẹ với thai nhi, tạo ra các kích thích tích cực tới các giác quan và não bộ, giúp con yêu phát triển toàn diện về thể chất và trí tuệ, để con yêu có một khởi đầu vượt trội.</p>    <p style="text-align: justify;">Thai giáo là phương pháp dạy con từ trong bụng mẹ. Thực hành thai giáo đã được chứng minh đem đến những lợi ích tuyệt vời cho cả mẹ và thai nhi trong thai kỳ như:</p>    <p style="text-align: justify;">– Tăng cường trí não của trẻ – em bé khi chào đời sẽ thông minh và dễ dàng thích nghi với quá trình học tập hơn.</p>    <p style="text-align: justify;">– Kích thích sự phát triển các giác quan của thai nhi, bao gồm vị giác, thính giác, khứu giác, xúc giác và thị giác của trẻ.</p>    <p style="text-align: justify;">– Tăng cường hệ miễn dịch, giúp bé khỏe mạnh, ngoan ngoãn, hoạt bát, nhanh nhẹn và ít ốm đau.</p>    <p style="text-align: justify;">– Xây dựng nhân cách tốt cho trẻ – em bé sinh ra sẽ có tính cách vui vẻ, hòa đồng, biết quan tâm, yêu thương mọi người.</p>    <p style="text-align: justify;">– Phát triển sợi dây gắn kết tình cảm thiêng liêng giữa mẹ và thai nhi.</p>    <p style="text-align: justify;">– Giúp mẹ bầu giảm căng thẳng, duy trì cảm xúc tích cực, thoải mái và nhận được nhiều hormone hạnh phúc hơn.</p>    <p>&gt;&gt;&gt; <em>Nếu mới tìm hiểu về Thai Giáo thì chắc hẳn cha mẹ đang còn rất mơ hồ về khái niệm này. POH cũng đã có một bài viết khá chi tiết về chủ đề <a href="https://poh.vn/thai-giao-la-gi/">Thai Giáo Là Gì</a>&nbsp;để giúp các bạn làm rõ hơn những khái niệm, và có một cái nhìn chi tiết hơn về khái niệm khá mới mẻ nhưng vô cùng quan trọng này.</em></p>    <p style="text-align: justify;"><img class="aligncenter size-large wp-image-1111     lazyloaded" src="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-1024x667.jpg" data-lazy-src="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-1024x667.jpg" alt="thai giáo dạy con từ trong bụng mẹ POH 01" width="1024" height="667" data-lazy-srcset="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-1024x667.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-300x195.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-768x500.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-1140x742.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-848x552.jpg 848w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-600x391.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01.jpg 1536w" data-lazy-sizes="(max-width: 1024px) 100vw, 1024px" srcset="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-1024x667.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-300x195.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-768x500.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-1140x742.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-848x552.jpg 848w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-600x391.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01.jpg 1536w" sizes="(max-width: 1024px) 100vw, 1024px"><noscript><img class="aligncenter size-large wp-image-1111" src="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-1024x667.jpg" alt="thai giáo dạy con từ trong bụng mẹ POH 01" width="1024" height="667" srcset="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-1024x667.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-300x195.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-768x500.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-1140x742.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-848x552.jpg 848w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01-600x391.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-01.jpg 1536w" sizes="(max-width: 1024px) 100vw, 1024px" /></noscript></p>    <p style="text-align: center;"><em>Thai giáo từ trong bụng mẹ</em></p>    <h2 style="text-align: justify;"><span class="ez-toc-section" id="Cach_thai_giao_cua_nguoi_Nhat">Cách thai giáo của người Nhật?</span></h2>    <p style="text-align: justify;">Nhật bản là một trong những quốc gia hàng đầu trong việc đề xuất thai giáo trên thế giới và đã gặt hái được nhiều thành tựu về thai giáo. Đặc biệt, thai giáo kiểu Nhật đã được các bà mẹ Nhật và nhiều phụ nữ trên toàn thế giới áp dụng tích cực giúp tạo điều kiện phát triển tốt nhất cho con.</p>    <p style="text-align: justify;">Các nhà khoa học Nhật Bản phát hiện ra rằng, theo phương pháp thai giáo của người Nhật và các sách thai giáo của người Nhật, thì việc thai giáo bằng ngôn ngữ chính là một phương pháp giúp thai nhi có những phản hồi tích cực đối với những kích thích từ ba mẹ.</p>    <p>&nbsp;</p>    <p style="text-align: justify;">Bằng chứng là những đứa trẻ được tiến hành thai giáo bằng ngôn ngữ có khả năng nhận ra giọng nói của người mẹ ngay sau khi chào đời. Lúc này, khi nghe thấy giọng nói ấm áp quen thuộc của người mẹ, em bé lập tức nín khóc và quay đầu về phía phát ra tiếng nói của mẹ.</p>    <p style="text-align: justify;">Trong khi đó, những đứa trẻ không được thai giáo ngôn ngữ phải mất đến hơn mười ngày mới có thể có phản ứng với giọng nói của người mẹ.</p>    <blockquote>        <p>Cha mẹ có thể tham khảo những thông tin về cách thai giáo của người Nhật tại <a href="https://poh.vn/thai-giao-kieu-nhat/">bài viết này</a> của POH.</p>    </blockquote>    <p>&nbsp;</p>    <p style="text-align: justify;"><img class="aligncenter size-large wp-image-1112     lazyloaded" src="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-1024x682.jpg" data-lazy-src="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-1024x682.jpg" alt="thai giáo dạy con từ trong bụng mẹ POH 02" width="1024" height="682" data-lazy-srcset="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-1024x682.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-300x200.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-768x512.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-600x400.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-1140x760.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-848x565.jpg 848w" data-lazy-sizes="(max-width: 1024px) 100vw, 1024px" srcset="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-1024x682.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-300x200.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-768x512.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-600x400.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-1140x760.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-848x565.jpg 848w" sizes="(max-width: 1024px) 100vw, 1024px"><noscript><img class="aligncenter size-large wp-image-1112" src="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-1024x682.jpg" alt="thai giáo dạy con từ trong bụng mẹ POH 02" width="1024" height="682" srcset="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-1024x682.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-300x200.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-768x512.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-600x400.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-1140x760.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-dạy-con-từ-trong-bụng-mẹ-POH-02-848x565.jpg 848w" sizes="(max-width: 1024px) 100vw, 1024px" /></noscript></p>    <p style="text-align: center;"><em>Phương pháp thai giáo của người Nhật</em></p>    <h2 style="text-align: justify;"><span class="ez-toc-section" id="Cac_Phuong_Phap_Thai_Giao">Các Phương Pháp Thai Giáo</span></h2>    <p style="text-align: justify;">Thai giáo không chỉ đóng vai trò quan trọng trong việc kích thích, tác động tới các giác quan của thai nhi như: Thính giác, thị giác, xúc giác mà còn giúp phát triển khả năng vận động, ghi nhớ của trẻ. Ngoài ra, việc thực hành các phương pháp thai giáo còn giúp tạo sợi dây gắn kết giữa mẹ và con, giúp bé có thể cảm nhận những thay đổi cả về mặt thể lực và tình cảm của người mẹ.</p>    <a href="https://poh.vn/khoa-thuc-hanh-thai-giao-poh/" class="banner-top-38"><img src="https://poh.vn/wp-content/uploads/2018/10/chốt-1.jpg" data-lazy-src="https://poh.vn/wp-content/uploads/2018/10/chốt-1.jpg" class="     lazyloaded"><noscript><img src="https://poh.vn/wp-content/uploads/2018/10/chốt-1.jpg"></noscript></a>    <p style="text-align: justify;">Theo nghiên cứu khoa học thì các phương pháp thai giáo nên được áp dụng một cách đều đặn, chính vì vậy mà POH đã nghiên cứu và xây dựng chương trình thực hành thai giáo_280 ngày yêu thương theo từng cấp độ phát triển của thai nhi, dựa trên số tuần thai để thai nhi nhận được những lợi ích tối ưu nhất từ thai giáo.</p>    <p style="text-align: justify;">Một số các phương pháp thai giáo phổ biến nhất đã được các nhà khoa học chứng minh đem đến những lợi ích tuyệt vời cho cả mẹ và bé trong thai kỳ bao gồm: Thai giáo Ánh Sáng, thai giáo Âm Nhạc, thai giáo Ngôn Ngữ, thai giáo Vận Động, thai giáo Xúc Giác, thai giáo Cảm Xúc, thai giáo tri thức, thai giáo liên tưởng và thai giáo Mỹ Thuật.</p>    <h2 style="text-align: justify;"><span class="ez-toc-section" id="Thai_giao_Anh_Sang">Thai giáo Ánh Sáng</span></h2>    <p style="text-align: justify;">Để đạt được hiệu quả tốt nhất, việc thực hành thai giáo ánh sáng cho bé nên được áp dụng từ tuần 27 trở đi, lúc này mí mắt của thai nhi bắt đầu mở. Bé đã có khả năng nhìn nhận ánh sáng chiếu vào bụng mẹ có hình mờ mờ.</p>    <p>&nbsp;</p>    <p style="text-align: justify;"><img class="aligncenter size-large wp-image-1124     lazyloaded" src="https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-1024x535.jpg" data-lazy-src="https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-1024x535.jpg" alt="Thực hành thai giáo ánh sáng POH" width="1024" height="535" data-lazy-srcset="https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-1024x535.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-300x157.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-768x401.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-1140x596.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-848x443.jpg 848w, https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-600x314.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH.jpg 1200w" data-lazy-sizes="(max-width: 1024px) 100vw, 1024px" srcset="https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-1024x535.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-300x157.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-768x401.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-1140x596.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-848x443.jpg 848w, https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-600x314.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH.jpg 1200w" sizes="(max-width: 1024px) 100vw, 1024px"><noscript><img class="aligncenter size-large wp-image-1124" src="https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-1024x535.jpg" alt="Thực hành thai giáo ánh sáng POH" width="1024" height="535" srcset="https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-1024x535.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-300x157.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-768x401.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-1140x596.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-848x443.jpg 848w, https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH-600x314.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/Thực-hành-thai-giáo-ánh-sáng-POH.jpg 1200w" sizes="(max-width: 1024px) 100vw, 1024px" /></noscript></p>    <p style="text-align: center;"><em>Mẹ bầu thực hành thai giáo ánh sáng cho con.</em></p>    <p style="text-align: justify;">Việc thực hành <a href="https://poh.vn/thai-giao-bang-anh-sang/">thai giáo ánh sáng</a> cho bé lúc này giúp kích thích thị giác của bé phát triển tốt hơn. Đồng thời nếu ba mẹ thực hành thai giáo ánh sáng cho bé thường xuyên sẽ giúp bé có khả năng phân biệt được sáng tối, ngày đêm từ đó hình thành nếp sinh hoạt điều độ thời gian biểu trong ngày, bé sinh ra sẽ ít quấy, khóc đêm.</p>    <h2 style="text-align: justify;"><span class="ez-toc-section" id="Thai_giao_Am_nhac">Thai giáo Âm nhạc</span></h2>    <p style="text-align: justify;">Thai giáo âm nhạc là một trong những phương pháp thai giáo quan trọng đối với sự phát triển của thai nhi, giúp bé phát triển thính giác và não bộ một cách hiệu quả.</p>    <p style="text-align: justify;">Bắt đầu từ tuần 13, thính giác của trẻ đã phát triển và có thể nghe được những âm thanh bên ngoài tử cung của người mẹ. Vậy nên thời điểm tốt nhất để thực hành thai giáo âm nhạc cho trẻ là từ tuần 13 trở đi để thai nhi nhận được những tác dụng tuyệt vời nhất.</p>    <p>&nbsp;</p>    <p style="text-align: justify;"><img class="aligncenter size-large wp-image-1110 lazyload" src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-âm-nhạc-POH-1024x683.jpg" alt="Thai giáo âm nhạc POH" width="1024" height="683" data-lazy-srcset="https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-âm-nhạc-POH-1024x683.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-âm-nhạc-POH-300x200.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-âm-nhạc-POH-768x512.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-âm-nhạc-POH-600x400.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-âm-nhạc-POH-1140x760.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-âm-nhạc-POH-848x566.jpg 848w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-âm-nhạc-POH.jpg 1429w" data-lazy-sizes="(max-width: 1024px) 100vw, 1024px"><noscript><img class="aligncenter size-large wp-image-1110" src="https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-âm-nhạc-POH-1024x683.jpg" alt="Thai giáo âm nhạc POH" width="1024" height="683" srcset="https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-âm-nhạc-POH-1024x683.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-âm-nhạc-POH-300x200.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-âm-nhạc-POH-768x512.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-âm-nhạc-POH-600x400.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-âm-nhạc-POH-1140x760.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-âm-nhạc-POH-848x566.jpg 848w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-âm-nhạc-POH.jpg 1429w" sizes="(max-width: 1024px) 100vw, 1024px" /></noscript></p>    <p style="text-align: center;"><em>Thai giáo âm nhạc có lợi cho cả mẹ và con yêu.</em></p>    <p>&nbsp;</p>    <p style="text-align: justify;">Thai giáo âm nhạc không chỉ đem lại lợi ích cho mẹ bầu mà còn có vai trò quan trọng đối với sự phát triển của bé trong thai kỳ. Thai giáo âm nhạc giúp bé phát triển khả năng cảm nhận âm thanh, hình thành cảm xúc tốt đẹp về thế giới xung quanh thông qua những vần điệu âm nhạc du dương, êm ái.</p>    <p>POH cũng đã có một bài viết chi tiết về chủ đề Thai Giáo bằng Âm Nhạc, các cha mẹ có thể tham khảo thêm bài viết đó <a href="https://poh.vn/thai-giao-bang-am-nhac/">tại đây</a>.</p>    <h3 style="text-align: justify;"><span class="ez-toc-section" id="Nhac_thai_giao_3_thang_dau">Nhạc thai giáo 3 tháng đầu</span></h3>    <p style="text-align: justify;">3 tháng đầu là giai đoạn các bộ phận, giác quan và não bộ của thai nhi đang được hình thành và phát triển, vậy nên việc thực hành thai giáo âm nhạc trong thời kỳ này chủ yếu là để duy trì cảm xúc tích cực của người mẹ, giúp mẹ bầu được thư giãn, vui vẻ, từ đó sản sinh ra nhiều hormone hạnh phúc. Hormone này sẽ theo máu mẹ vào nuôi dưỡng cơ thể con, giúp con phát triển tốt nhất trong giai đoạn này.</p>    <p style="text-align: justify;">Đây cũng là khoảng thời gian nhiều mẹ bầu phải trải qua giai đoạn ốm nghén, căng thẳng, buồn chán, lúc này việc thực hành thai giáo âm nhạc có thể giúp mẹ cải thiện tình trạng ốm nghén một cách hiệu quả.</p>    <p style="text-align: justify;"><a href="https://poh.vn/nhac-thai-giao-3-thang-dau/">Nhạc thai giáo 3 tháng đầu</a> nên là những thể loại âm nhạc nhẹ, trầm, có giai điệu êm ái, tạo cảm giác thư giãn cho mẹ bầu. Mẹ có thể nghe các bản nhạc mà mình yêu thích, miễn là tạo cảm giác thoải mái nhất cho mẹ.</p>    <p style="text-align: justify;">Mẹ Huyền Iris, bắt đầu đăng ký khóa thực hành Thai giáo_280 ngày yêu thương và thực hành thai giáo âm nhạc cho con có chia sẻ: “Mình vốn nhạy cảm, hay cả nghĩ nhưng khi sáng nào cũng nghe nhạc không lời giai điệu vui vẻ, hay nhạc trẻ con đáng yêu thì mình thấy lạ là tinh thần mình cũng lạc quan hơn hẳn, kiểm soát cảm xúc tốt hơn.”</p>    <h3 style="text-align: justify;"><span class="ez-toc-section" id="Nhac_thai_giao_3_thang_giua">Nhạc thai giáo 3 tháng giữa</span></h3>    <p style="text-align: justify;">Bắt đầu từ tuần 13 trở đi, thính giác của thai nhi phát triển và có thể được các âm thanh bên ngoài tử cung của người mẹ. Lúc này, thai giáo âm nhạc không chỉ giúp mẹ bầu thư giãn để mẹ duy trì cảm xúc tích cực, từ đó bé có cảm giác thoải mái và bình an mà còn tạo điều kiện để bé phát triển thính giác và khả năng cảm thụ âm nhạc.</p>    <p style="text-align: justify;"><a href="https://poh.vn/nhac-thai-giao-3-thang-giua/">Nhạc thai giáo 3 tháng giữa</a> được khuyến khích cho mẹ bầu nghe là nhạc không lời với những giai điệu nhẹ nhàng, êm dịu, du dương hoặc có giai điệu vui tươi để mẹ thư giãn, duy trì cảm xúc tích cực và sản sinh nhiều hormone hạnh phúc, đồng thời cũng giúp kích thích não bộ của thai nhi phát triển tốt hơn.</p>    <p>&nbsp;</p>    <p style="text-align: justify;"><img class="aligncenter size-large wp-image-1109 lazyload" src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-3-tháng-giữa-POH-1024x576.jpg" alt="Thai giáo 3 tháng giữa POH" width="1024" height="576" data-lazy-srcset="https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-3-tháng-giữa-POH-1024x576.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-3-tháng-giữa-POH-300x169.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-3-tháng-giữa-POH-768x432.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-3-tháng-giữa-POH-1140x641.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-3-tháng-giữa-POH-848x477.jpg 848w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-3-tháng-giữa-POH-600x338.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-3-tháng-giữa-POH.jpg 1429w" data-lazy-sizes="(max-width: 1024px) 100vw, 1024px"><noscript><img class="aligncenter size-large wp-image-1109" src="https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-3-tháng-giữa-POH-1024x576.jpg" alt="Thai giáo 3 tháng giữa POH" width="1024" height="576" srcset="https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-3-tháng-giữa-POH-1024x576.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-3-tháng-giữa-POH-300x169.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-3-tháng-giữa-POH-768x432.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-3-tháng-giữa-POH-1140x641.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-3-tháng-giữa-POH-848x477.jpg 848w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-3-tháng-giữa-POH-600x338.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-3-tháng-giữa-POH.jpg 1429w" sizes="(max-width: 1024px) 100vw, 1024px" /></noscript></p>    <p style="text-align: center;"><em>Nhạc thai giáo 3 tháng giữa giúp kích thích não bộ con yêu phát triển.</em></p>    <p style="text-align: justify;">Theo nghiên cứu của các nhà khoa học, ở giai đoạn này ba mẹ nên cho con yêu nghe những loại nhạc có giai điệu với tần số nhịp từ 60 – 80 nhịp/phút tương tự với tần số nhịp tim của con người, để giúp mẹ và con yêu được thư thái.</p>    <p style="text-align: justify;">Có một ông bố đã nêu lên suy nghĩ về trải nghiệm nghe nhạc của vợ khi tham gia chương trình Thai giáo 280 ngày yêu thương như sau: “Vợ tôi khi mang bầu thường rất thích nghe các bản nhạc của các nghệ sỹ piano ở trong chương trình như: Richard Clayderman, Yiruma, Banradi, hay những bản nhạc saxophone của nghệ sỹ Keny G… Những bản nhạc du dương, nhẹ nhàng phù hợp với con yêu, mà mẹ bầu vẫn thấy rất thoải mái, dễ chịu.”</p>    <h3 style="text-align: justify;"><span class="ez-toc-section" id="Nhac_thai_giao_3_thang_cuoi">Nhạc thai giáo 3 tháng cuối</span></h3>    <p style="text-align: justify;">Mẹ bầu lưu ý không nên nghe những bản nhạc có tiết tấu mạnh, thay đổi liên tục như nhạc rock, disco vì có tác động xấu đến bé, làm nhịp tim của thai nhi đập nhanh. Các bản nhạc buồn cũng không được khuyến khích cho mẹ vì nó tạo cảm giác đau buồn, ảnh hưởng đến tinh thần của cả mẹ và thai nhi.</p>    <p style="text-align: justify;">Các nhà khoa học đã chứng minh được, ở giai đoạn này thai nhi có khả năng phân biệt ngoại ngữ với tiếng mẹ đẻ. Vậy nên đây là giai đoạn thích hợp nhất để ba mẹ giúp bé làm quen với ngoại ngữ bằng cách lựa chọn cho bé nghe các bản nhạc hay đoạn hội thoại tiếng nước ngoài phù hợp.</p>    <p style="text-align: justify;">Bé sẽ bắt đầu làm quen với các từ ngữ, các nguyên âm và phụ âm khi chưa hiểu ý nghĩa của chúng. Việc này tạo nền tảng để trẻ phát triển khả năng học ngoại ngữ của mình sau này.</p>    <p style="text-align: justify;">Đây cũng chính là nghiên cứu của tiến sĩ Patricia Kuhl đến từ Đại học Washington, Mỹ, cho thấy trẻ sơ sinh có khả năng phân biệt được các âm thanh khác nhau của những ngôn ngữ khác nhau trên thế giới.</p>    <p>&gt;&gt;&gt; <em>Tham khảo bài viết <a href="https://poh.vn/nhac-thai-giao-3-thang-cuoi/">nhạc thai giáo 3 tháng cuối</a> để hiểu rõ hơn những lợi ích của âm nhạc đối với thai nhi trong giai đoạn vô cùng quan trọng này và những thể loại nhạc mà cha mẹ nên cho thai nhi nghe</em></p>    <h2 style="text-align: justify;"><span class="ez-toc-section" id="Thai_Giao_Ngon_Ngu">Thai Giáo Ngôn Ngữ</span></h2>    <p style="text-align: justify;">Thai giáo ngôn ngữ là việc sử dụng những ngôn ngữ giao tiếp để đối thoại với thai nhi, từ đó nhận được những phản ứng ngược lại từ trẻ, đồng thời tạo sợ dây kết nối giữa ba mẹ với trẻ.</p>    <p style="text-align: justify;"><a href="https://poh.vn/thai-giao-bang-ngon-ngu/">Thai giáo ngôn ngữ</a> có vai trò quan trọng trong việc kích thích thai nhi phát triển cả về thể lực và trí tuệ. Khi thính giác của trẻ phát triển, bắt đầu từ tuần 13 trở đi bé có thể nghe được âm thanh bên ngoài và cảm nhận được tiếng nói thân quen của ba mẹ.</p>    <p style="text-align: justify;">Việc thực hành thai giáo ngôn ngữ lúc này đặc biệt giúp bé làm quen với giọng nói của ba mẹ, nhờ giọng nói tràn đầy tình yêu thương của ba mẹ mà con yêu sẽ cảm thấy an toàn và vui vẻ ở trong bụng mẹ. Đồng thời, thai giáo ngôn ngữ còn giúp tăng cường khả năng phát triển ngôn ngữ của con yêu.</p>    <p>&nbsp;</p>    <p style="text-align: center;"><img class="aligncenter size-large wp-image-1116 lazyload" src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-ngôn-ngữ-POH-1024x538.jpg" alt="Thai giáo ngôn ngữ POH" width="1024" height="538" data-lazy-srcset="https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-ngôn-ngữ-POH-1024x538.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-ngôn-ngữ-POH-300x158.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-ngôn-ngữ-POH-768x403.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-ngôn-ngữ-POH-1140x599.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-ngôn-ngữ-POH-848x445.jpg 848w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-ngôn-ngữ-POH-600x315.jpg 600w" data-lazy-sizes="(max-width: 1024px) 100vw, 1024px"><noscript><img class="aligncenter size-large wp-image-1116" src="https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-ngôn-ngữ-POH-1024x538.jpg" alt="Thai giáo ngôn ngữ POH" width="1024" height="538" srcset="https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-ngôn-ngữ-POH-1024x538.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-ngôn-ngữ-POH-300x158.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-ngôn-ngữ-POH-768x403.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-ngôn-ngữ-POH-1140x599.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-ngôn-ngữ-POH-848x445.jpg 848w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-ngôn-ngữ-POH-600x315.jpg 600w" sizes="(max-width: 1024px) 100vw, 1024px" /></noscript></p>    <p style="text-align: center;"><em>Con yêu phát triển khả năng ngôn ngữ nhờ thai giáo ngôn ngữ.</em></p>    <p style="text-align: justify;">Một bà mẹ đã kể lại trải nghiệm rất thú vị của mình như sau: “Khi mang thai ở tháng thứ 7, tôi thường nói với cục cưng của mình như sau: Con yêu, mẹ là mẹ của con, chào con. Vừa nói, tôi vừa đưa tay lên xoa bụng nhẹ nhàng.</p>    <p style="text-align: justify;">Mỗi khi nói với thai nhi như vậy, bé đều phản ứng lại một cách vui vẻ, tích cực bằng cách “cựa quậy” trong bụng mẹ. Khi con chào đời, mỗi khi con khóc, tôi lại nói vỗ về như vậy và không ngờ con nín khóc, quay đầu về phía tôi và cười một cách vui vẻ.”</p>    <p style="text-align: justify;">Như vậy, giọng nói quen thuộc của ba mẹ giúp tạo cảm giác an toàn và loại bỏ sự bất an cho con ngay khi bé chào đời, vẫn còn lạ lẫm với môi trường rộng lớn bên ngoài.</p>    <h2 style="text-align: justify;"><span class="ez-toc-section" id="Thai_giao_Van_Dong">Thai giáo Vận Động</span></h2>    <p style="text-align: justify;">Thai giáo vận động trong thai kỳ có vai trò quan trọng giúp rèn luyện thể lực của người mẹ, giúp mẹ bầu khỏe mạnh hơn, đồng thời con yêu cũng nhận được lợi ích từ việc rèn luyện sức khỏe của người mẹ.</p>    <p style="text-align: justify;">Nghiên cứu khoa học cho thấy, khi vận động, cơ thể người mẹ sẽ tiết ra hormone endorphin, chính là hormone hạnh phúc, tạo cảm giác vui vẻ, thư giãn cho người mẹ. Con yêu cũng sẽ nhận được hormone hạnh phúc từ người mẹ tốt nhất.</p>    <p>&nbsp;</p>    <p style="text-align: center;"><img class="aligncenter size-full wp-image-1123 lazyload" src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-vận-động-POH.jpg" alt="thai giáo vận động POH" width="1000" height="640" data-lazy-srcset="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-vận-động-POH.jpg 1000w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-vận-động-POH-300x192.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-vận-động-POH-768x492.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-vận-động-POH-848x543.jpg 848w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-vận-động-POH-600x384.jpg 600w" data-lazy-sizes="(max-width: 1000px) 100vw, 1000px"><noscript><img class="aligncenter size-full wp-image-1123" src="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-vận-động-POH.jpg" alt="thai giáo vận động POH" width="1000" height="640" srcset="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-vận-động-POH.jpg 1000w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-vận-động-POH-300x192.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-vận-động-POH-768x492.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-vận-động-POH-848x543.jpg 848w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-vận-động-POH-600x384.jpg 600w" sizes="(max-width: 1000px) 100vw, 1000px" /></noscript></p>    <p style="text-align: center;"><em>Thai giáo vận động giúp duy trì sức khỏe và tinh thần cho mẹ bầu.</em></p>    <p style="text-align: justify;">Ngoài ra, <a href="https://poh.vn/thai-giao-van-dong/">thai giáo vận động</a> còn giúp mẹ bầu giảm các triệu chứng ốm nghén, buồn nôn, mệt mỏi trong thai kỳ, đem lại giấc ngủ ngon hơn cho mẹ, giúp cơ thể khỏe khoắn và tràn đầy năng lượng.</p>    <p style="text-align: justify;">Nhờ thai giáo vận động của người mẹ, mà thai nhi nhận được nhiều lợi ích như được massage nhẹ nhàng trong làn nước ối ấm áp của người mẹ, có được cảm giác an toàn thoải mái, giúp bé phát triển giác quan cảm xúc và xúc giác.</p>    <p style="text-align: justify;">Một số các hình thức thai giáo vận động mà mẹ bầu nên áp dụng như: Tập yoga, bơi lội, đi bộ hay tập những động tác nhẹ nhàng dành riêng cho phụ nữ có thai.</p>    <h2 style="text-align: justify;"><span class="ez-toc-section" id="Thai_giao_Xuc_Giac">Thai giáo Xúc Giác</span></h2>    <p style="text-align: justify;"><a href="https://poh.vn/thai-giao-xuc-giac/">Thai giáo xúc giác</a> là việc tác động để tạo nên những kích thích lên bụng của người mẹ, giúp con khỏe mạnh, hoạt bát và nhanh nhẹn hơn.</p>    <p style="text-align: justify;">Nhiều mẹ bầu tham gia khóa <a href="https://poh.vn/khoa-thuc-hanh-thai-giao-poh/">thực hành thai giáo_280 ngày yêu thương</a> chia sẻ với POH khi thực hành hoạt động thai giáo xúc giác cho con yêu, họ nhận được những cú đá chân từ em bé sau khi áp dụng bài tập của chúng tôi một thời gian.</p>    <p style="text-align: justify;">Thời gian phù hợp nhất để thực hiện thai giáo xúc giác cho thai nhi là từ tuần 22 trở đi, lúc này hầu hết các mẹ đã có thể cảm nhận được con máy. Vì vậy việc thực hành thai giáo xúc giác cho thai nhi sẽ giúp con yêu có khả năng phản ứng lại những kích thích của ba mẹ một cách linh hoạt và nhanh nhạy.</p>    <h2 style="text-align: justify;"><span class="ez-toc-section" id="Thai_giao_Cam_Xuc">Thai giáo Cảm Xúc</span></h2>    <p style="text-align: justify;">Thai giáo cảm xúc là một trong những phương pháp thai giáo quan trọng nhất trong việc tạo môi trường giúp thai nhi được phát triển toàn diện trong bụng mẹ. Yếu tố quyết định đến thai nhi chính là cảm xúc tích cực và ổn định của người mẹ.</p>    <p>&nbsp;</p>    <p style="text-align: justify;"><img class="aligncenter size-large wp-image-1125 lazyload" src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="https://poh.vn/wp-content/uploads/2018/07/Cảm-xúc-của-mẹ-bầu-khi-thai-giáo-1024x683.jpg" alt="Cảm xúc của mẹ bầu khi thai giáo" width="1024" height="683" data-lazy-srcset="https://poh.vn/wp-content/uploads/2018/07/Cảm-xúc-của-mẹ-bầu-khi-thai-giáo-1024x683.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/Cảm-xúc-của-mẹ-bầu-khi-thai-giáo-300x200.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/Cảm-xúc-của-mẹ-bầu-khi-thai-giáo-768x512.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/Cảm-xúc-của-mẹ-bầu-khi-thai-giáo-600x400.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/Cảm-xúc-của-mẹ-bầu-khi-thai-giáo-1140x760.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/Cảm-xúc-của-mẹ-bầu-khi-thai-giáo-848x566.jpg 848w" data-lazy-sizes="(max-width: 1024px) 100vw, 1024px"><noscript><img class="aligncenter size-large wp-image-1125" src="https://poh.vn/wp-content/uploads/2018/07/Cảm-xúc-của-mẹ-bầu-khi-thai-giáo-1024x683.jpg" alt="Cảm xúc của mẹ bầu khi thai giáo" width="1024" height="683" srcset="https://poh.vn/wp-content/uploads/2018/07/Cảm-xúc-của-mẹ-bầu-khi-thai-giáo-1024x683.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/Cảm-xúc-của-mẹ-bầu-khi-thai-giáo-300x200.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/Cảm-xúc-của-mẹ-bầu-khi-thai-giáo-768x512.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/Cảm-xúc-của-mẹ-bầu-khi-thai-giáo-600x400.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/Cảm-xúc-của-mẹ-bầu-khi-thai-giáo-1140x760.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/Cảm-xúc-của-mẹ-bầu-khi-thai-giáo-848x566.jpg 848w" sizes="(max-width: 1024px) 100vw, 1024px" /></noscript></p>    <p style="text-align: center;"><em>Cảm xúc tích cực của mẹ là phương pháp thai giáo hiệu quả nhất cho con.</em></p>    <p style="text-align: justify;">Vì vậy, mẹ bầu nên luôn luôn duy trì những cảm xúc tích cực, vui tươi một cách ổn định trong thai kỳ. Việc này giúp cơ thể mẹ sản sinh ra nhiều hormone hạnh phúc là hormone hormoneserotonin và endorphins. Các hormone có lợi này sẽ được truyền đến nuôi dưỡng thai nhi cũng với máu và các chất dinh dưỡng.</p>    <p style="text-align: justify;">Nhờ vậy khi mẹ vui vẻ thì thai nhi cũng sẽ được vui vẻ, thoải mái và an toàn trong làn nước ối ấm áp của người mẹ. Mẹ bầu thực hiện <a href="https://poh.vn/thai-giao-cam-xuc/">thai giáo cảm xúc</a> bằng cách luôn duy trì trạng thái tâm lý vui vẻ, thoải mái và thư giãn nhất, đồng thời chủ động làm chủ được cảm xúc của mình trước mọi tác động ngoại cảnh.</p>    <h2 style="text-align: justify;"><span class="ez-toc-section" id="Thai_giao_tri_thuc">Thai giáo tri thức</span></h2>    <p style="text-align: justify;"><a href="https://poh.vn/thai-giao-tri-thuc/">Thai giáo tri thức</a> chính là việc mẹ bầu thường xuyên và không ngừng học tập, trau dồi các kiến thức mới, rèn luyện tri thức cho bản thân thông qua các hoạt động giải toán hay chơi các trò chơi trí tuệ như: Cờ tướng, giải đố IQ, ghép tranh, đuổi hình bắt chữ, Sudoku…</p>    <p>&nbsp;</p>    <p style="text-align: justify;"><img class="aligncenter size-full wp-image-1122 lazyload" src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-tri-thức-thông-qua-đọc-sách.jpg" alt="Thai giáo tri thức thông qua đọc sách" width="696" height="400" data-lazy-srcset="https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-tri-thức-thông-qua-đọc-sách.jpg 696w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-tri-thức-thông-qua-đọc-sách-300x172.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-tri-thức-thông-qua-đọc-sách-600x345.jpg 600w" data-lazy-sizes="(max-width: 696px) 100vw, 696px"><noscript><img class="aligncenter size-full wp-image-1122" src="https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-tri-thức-thông-qua-đọc-sách.jpg" alt="Thai giáo tri thức thông qua đọc sách" width="696" height="400" srcset="https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-tri-thức-thông-qua-đọc-sách.jpg 696w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-tri-thức-thông-qua-đọc-sách-300x172.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-tri-thức-thông-qua-đọc-sách-600x345.jpg 600w" sizes="(max-width: 696px) 100vw, 696px" /></noscript></p>    <p style="text-align: center;"><em>Mẹ bầu thai giáo tri thức cho con yêu bằng việc đọc sách.</em></p>    <p style="text-align: justify;">Mẹ bầu cũng có thể đọc sách, báo, truyện để tìm hiểu về những chủ đề hay lĩnh vực mà mình yêu thích. Từ việc thường xuyên rèn luyện tư duy của mẹ, thai nhi sẽ nhận được những kích thích từ người mẹ, giúp bé phát triển não bộ một cách hiệu quả nhất.</p>    <h2 style="text-align: justify;"><span class="ez-toc-section" id="Thai_giao_lien_tuong">Thai giáo liên tưởng</span></h2>    <p style="text-align: justify;">Phương pháp thai giáo liên tưởng là cách truyền cho thai nhi những ý nghĩ, tình cảm tốt đẹp và sự vật gần gũi thông qua mối liên hệ tình cảm và ý thức giữa mẹ và thai nhi. Khi thực hành <a href="https://poh.vn/thai-giao-lien-tuong/">thai giáo liên tưởng</a>, người mẹ sẽ tưởng tượng ra những sự vật tốt đẹp với cảm xúc tích cực để truyền đến con yêu.</p>    <p>Khi thực hành thai giáo liên tưởng, mẹ bầu hãy tưởng tượng hình ảnh của những em bé xinh đẹp, đáng yêu. Hoặc ba mẹ cũng có thể hình dung và vẽ bức hình của con yêu. Thông qua những suy nghĩ, tưởng tượng này, người mẹ có thể đem những kỳ vọng đẹp đẽ của mình truyền cho thai nhi, giúp mẹ sinh ra một em bé xinh xắn và đáng yêu.</p>    <h2 style="text-align: justify;"><span class="ez-toc-section" id="Thai_giao_My_Thuat">Thai giáo Mỹ Thuật</span></h2>    <p style="text-align: justify;">Thai giáo mỹ thuật là hoạt động thai giáo cho con thông qua các hoạt động thẩm mỹ, nghệ thuật, dạy con về những cái đẹp cái hay ngay từ trong bụng mẹ. Phương pháp này không chỉ giúp mẹ phát triển cảm quan về cái đẹp mà từ đó sẽ truyền sang con qua các xung thần kinh.</p>    <p>&nbsp;</p>    <p style="text-align: justify;"><img class="aligncenter size-full wp-image-1115 lazyload" src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-mỹ-thuật-POH.jpg" alt="Thai giáo mỹ thuật POH" width="733" height="489" data-lazy-srcset="https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-mỹ-thuật-POH.jpg 733w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-mỹ-thuật-POH-300x200.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-mỹ-thuật-POH-600x400.jpg 600w" data-lazy-sizes="(max-width: 733px) 100vw, 733px"><noscript><img class="aligncenter size-full wp-image-1115" src="https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-mỹ-thuật-POH.jpg" alt="Thai giáo mỹ thuật POH" width="733" height="489" srcset="https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-mỹ-thuật-POH.jpg 733w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-mỹ-thuật-POH-300x200.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/Thai-giáo-mỹ-thuật-POH-600x400.jpg 600w" sizes="(max-width: 733px) 100vw, 733px" /></noscript></p>    <p style="text-align: center;"><em>Vẽ tranh là một trong những hoạt động thai giáo mỹ thuật phổ biến.</em></p>    <p style="text-align: justify;">Mẹ bầu có thể thực hiện <a href="https://poh.vn/thai-giao-my-thuat/">thai giáo mỹ thuật</a> bằng cách ngắm nhìn cảnh đẹp, tắm nắng, chiêm ngưỡng tranh ảnh đẹp, vẽ tranh, ngắm nhìn những đứa trẻ xinh xắn đáng yêu, hay tự làm những món đồ thủ công, trang trí cho ngôi nhà của mình.</p>    <p style="text-align: justify;">Từ xa xưa, người Trung Quốc đã có quan niệm: “Phụ nữ mang thai mắt không nhìn màu sắc xấu xí, tai không nghe lời tục tĩu, miệng không nói những câu ngạo mạn”. Vì thai nhi có thể hấp thụ tất cả những điều này, ảnh hướng xấu đến sự phát triển của trẻ.</p>    <p style="text-align: justify;">Trong thai kỳ, người mẹ rèn luyện cảm thụ cái đẹp, nói những lời hay, lẽ đẹp thì đứa trẻ cũng sẽ phát triển khả năng cảm nhận cái đẹp rất sớm.</p>    <h2 style="text-align: justify;"><span class="ez-toc-section" id="Thai_giao_theo_tung_thoi_diem_trong_thai_ky">Thai giáo theo từng thời điểm trong thai kỳ</span></h2>    <h3 style="text-align: justify;"><span class="ez-toc-section" id="Thai_giao_3_thang_dau">Thai giáo 3 tháng đầu</span></h3>    <p style="text-align: justify;">Việc áp dụng thai giáo cần phải có sự linh hoạt để phù hợp với từng thời kỳ phát triển của thai nhi. Trong giai đoạn 3 tháng đầu mang thai, đây là khoảng thời gian vô cùng quan trọng trong việc đặt nền móng để nuôi dạy con cho tốt.</p>    <p style="text-align: justify;">Ba tháng đầu là khoảng thời gian mà nhiều mẹ bầu gặp phải tình trạng ốm nghén, cơ thể mệt mỏi, tâm trạng buồn chán bởi sự thay đổi hormone trong cơ thể. Vì vậy, <a href="https://poh.vn/thai-giao-3-thang-dau/">thai giáo 3 tháng đầu</a> là sự kết hợp của một chế độ dinh dưỡng thật tốt cho mẹ bầu với việc duy trì cảm xúc tích cực, thoải mái, giúp cơ thể người mẹ tiết ra nhiều hormone hạnh phúc nuôi dưỡng con.</p>    <h4 style="text-align: justify;"><span class="ez-toc-section" id="Thai_giao_thang_thu_1">Thai giáo tháng thứ 1</span></h4>    <p style="text-align: justify;">Trong thời gian đầu thai kỳ, sự phát triển hệ thống thần kinh của thai nhi là vô cùng quan trọng. Lúc này, số lượng tế tế bào não tăng cao. Vậy nên, <a href="https://poh.vn/thai-giao-thang-thu-1/">thai giáo tháng thứ nhất</a> chủ yếu vẫn là phương pháp thai giáo bằng dinh dưỡng để đảm bảo sức khỏe cho cả mẹ và sự phát triển của thai nhi.</p>    <p>&nbsp;</p>    <p style="text-align: justify;"><img class="aligncenter size-large wp-image-1120 lazyload" src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tháng-thứ-nhất-bằng-dinh-dưỡng-1024x599.jpg" alt="thai giáo tháng thứ nhất bằng dinh dưỡng" width="1024" height="599" data-lazy-srcset="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tháng-thứ-nhất-bằng-dinh-dưỡng-1024x599.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tháng-thứ-nhất-bằng-dinh-dưỡng-300x175.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tháng-thứ-nhất-bằng-dinh-dưỡng-768x449.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tháng-thứ-nhất-bằng-dinh-dưỡng-1140x666.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tháng-thứ-nhất-bằng-dinh-dưỡng-848x496.jpg 848w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tháng-thứ-nhất-bằng-dinh-dưỡng-600x351.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tháng-thứ-nhất-bằng-dinh-dưỡng.jpg 1432w" data-lazy-sizes="(max-width: 1024px) 100vw, 1024px"><noscript><img class="aligncenter size-large wp-image-1120" src="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tháng-thứ-nhất-bằng-dinh-dưỡng-1024x599.jpg" alt="thai giáo tháng thứ nhất bằng dinh dưỡng" width="1024" height="599" srcset="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tháng-thứ-nhất-bằng-dinh-dưỡng-1024x599.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tháng-thứ-nhất-bằng-dinh-dưỡng-300x175.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tháng-thứ-nhất-bằng-dinh-dưỡng-768x449.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tháng-thứ-nhất-bằng-dinh-dưỡng-1140x666.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tháng-thứ-nhất-bằng-dinh-dưỡng-848x496.jpg 848w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tháng-thứ-nhất-bằng-dinh-dưỡng-600x351.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tháng-thứ-nhất-bằng-dinh-dưỡng.jpg 1432w" sizes="(max-width: 1024px) 100vw, 1024px" /></noscript></p>    <p style="text-align: center;"><em>Thai giáo tháng thứ nhất bằng dinh dưỡng.</em></p>    <p style="text-align: justify;">Đồng thời, mẹ bầu nên duy trì những cảm xúc tích cực, thư giãn bằng cách có thể thoải mái lựa chọn những thứ mình thích như nghe các bản nhạc không lời với âm điệu du dương, êm ái, chuẩn bị trước sinh, trang trí nhà cửa, cải thiện không gian sống, điều tiết cảm xúc, đi bộ hay nói chuyện với thai nhi.</p>    <h4 style="text-align: justify;"><span class="ez-toc-section" id="Thai_giao_thang_thu_2">Thai giáo tháng thứ 2</span></h4>    <p style="text-align: justify;">Khi thai nhi bước sang tháng thứ 2, người mẹ có thể biết được việc mình có thai. Lúc này, cả tâm và sinh lí đều có những sự thay đổi rõ rệt, mẹ bầu có thể sẽ lo lắng và bất an. Đây cũng là giai đoạn mà não bộ của bé bắt đầu hình thành và phát triển, các tế bào thần kinh và xúc giác của bé cũng phát triển.</p>    <p style="text-align: justify;">Vì vậy <a href="https://poh.vn/thai-giao-thang-thu-2/">các phương pháp thai giáo tháng thứ 2</a> nên được ưu tiên vẫn là thai giáo dinh dưỡng để duy trì sức khỏe cho mẹ và sự phát triển của thai nhi. Đồng thời mẹ bầu nên thực hiện thai giáo cảm xúc để duy trì cảm xúc tích cực và tâm trạng vui vẻ, thoải mái vì tâm trạng vui vẻ của người mẹ chính là phương pháp thai giáo hiệu quả nhất.</p>    <h4 style="text-align: justify;"><span class="ez-toc-section" id="Thai_giao_thang_thu_3">Thai giáo tháng thứ 3</span></h4>    <p style="text-align: justify;">Tháng thứ 3 chính là giai đoạn quan trọng trong sự phát triển của trẻ bởi bắt đầu từ tuần 8 trở đi, não bộ của bé trở nên phức tạp hơn khi dây thần kinh phân nhánh và kết nối với nhau. Trung khu thần kinh dần được phân hoá thành thục, có các điều kiện phản xạ và hình thành các hoạt động đầu tiên của cơ thể.</p>    <p>&nbsp;</p>    <p style="text-align: justify;"><img class="aligncenter size-large wp-image-1121 lazyload" src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tri-thức-tháng-thứ-3-1024x768.jpg" alt="thai giáo tri thức tháng thứ 3" width="1024" height="768" data-lazy-srcset="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tri-thức-tháng-thứ-3-1024x768.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tri-thức-tháng-thứ-3-300x225.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tri-thức-tháng-thứ-3-768x576.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tri-thức-tháng-thứ-3-1140x855.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tri-thức-tháng-thứ-3-848x636.jpg 848w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tri-thức-tháng-thứ-3-600x450.jpg 600w" data-lazy-sizes="(max-width: 1024px) 100vw, 1024px"><noscript><img class="aligncenter size-large wp-image-1121" src="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tri-thức-tháng-thứ-3-1024x768.jpg" alt="thai giáo tri thức tháng thứ 3" width="1024" height="768" srcset="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tri-thức-tháng-thứ-3-1024x768.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tri-thức-tháng-thứ-3-300x225.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tri-thức-tháng-thứ-3-768x576.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tri-thức-tháng-thứ-3-1140x855.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tri-thức-tháng-thứ-3-848x636.jpg 848w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-tri-thức-tháng-thứ-3-600x450.jpg 600w" sizes="(max-width: 1024px) 100vw, 1024px" /></noscript></p>    <p style="text-align: center;"><em>Thai giáo tháng thứ 3 bằng tri thức cho con yêu</em></p>    <p style="text-align: justify;">Lúc này, <a href="https://poh.vn/thai-giao-thang-thu-3/">các phương pháp thai giáo tháng thứ 3</a> nên được áp dụng là thai giáo mỹ thuật và thai giáo tri thức, giúp thúc đẩy hệ thần kinh bé phát triển. Ba mẹ thực hiện thai giáo tri thức bằng cách chơi trò chơi Sudoku. Hoạt động tư duy của mẹ bầu có thể giúp bé tiếp nhận những kích thích, từ đó thúc đẩy sự phát triển của tế bào và hệ thần kinh đại não.</p>    <p style="text-align: justify;">Ngoài ra, ba mẹ cũng có thể thực hiện thai giáo bằng đối thoại, nói những lời yêu thương với con để con cảm nhận được tình yêu của ba mẹ.</p>    <h3 style="text-align: justify;"><span class="ez-toc-section" id="Thai_giao_3_thang_giua">Thai giáo 3 tháng giữa</span></h3>    <p style="text-align: justify;">Bước sang tháng thứ 4, cảm giác khó chịu của những cơn ốm nghén đã giảm đáng kể, tâm trạng mẹ trở nên ổn định và tốt hơn. Vậy nên, mẹ hãy tiếp tục điều tiết cảm xúc để duy trì ổn định tâm trạng.</p>    <p style="text-align: justify;">Mẹ nên tiếp tục duy trì các <a href="https://poh.vn/thai-giao-3-thang-dau/">hoạt động thai giáo của ba tháng đầu</a> để đạt được hiệu quả tốt nhất. Đồng thời, <a href="https://poh.vn/thai-giao-3-thang-giua/">thai giáo 3 tháng giữa</a> nên được bổ sung thêm một số các hoạt động như hát cho bé nghe để giúp bé làm quen với giọng nói của ba mẹ hay chơi trò chơi cùng bé, giúp thúc đẩy khả năng vận động tứ chi của trẻ.</p>    <h4 style="text-align: justify;"><span class="ez-toc-section" id="Thai_giao_thang_thu_4">Thai giáo tháng thứ 4</span></h4>    <p style="text-align: justify;">Thai nhi bước sang tháng thứ 4, lúc này tuy chưa mở được mắt nhưng thị giác của trẻ đã bắt đầu hình thành, đồng thời não bộ của bé cũng trở nên phức tạp hơn. Thai nhi cũng bắt đầu cảm nhận được âm thanh từ thế giới bên ngoài.</p>    <p style="text-align: justify;">Các đường vân tay đang dần hình thành trên mười đầu ngón tay, và thậm chí bé đã có thể tự ngậm đầu ngón tay cái của mình ở giai đoạn này.</p>    <p>&nbsp;</p>    <p><img class="aligncenter size-large wp-image-1117 lazyload" src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-4-1024x681.jpg" alt="thai giáo ngôn ngữ tháng thứ 4" width="1024" height="681" data-lazy-srcset="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-4-1024x681.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-4-300x200.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-4-768x511.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-4-600x399.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-4-1140x758.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-4-848x564.jpg 848w" data-lazy-sizes="(max-width: 1024px) 100vw, 1024px"><noscript><img class="aligncenter size-large wp-image-1117" src="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-4-1024x681.jpg" alt="thai giáo ngôn ngữ tháng thứ 4" width="1024" height="681" srcset="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-4-1024x681.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-4-300x200.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-4-768x511.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-4-600x399.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-4-1140x758.jpg 1140w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-4-848x564.jpg 848w" sizes="(max-width: 1024px) 100vw, 1024px" /></noscript></p>    <p style="text-align: center;"><em>Mẹ bầu thai giáo tháng thứ 4 cho con yêu bằng ngôn ngữ.</em></p>    <p style="text-align: justify;">Vì vậy các phương pháp <a href="https://poh.vn/thai-giao-thang-thu-4/">thai giáo tháng thứ 4</a> nên được ưu tiên là thai giáo bằng ngôn ngữ để bé có thể tiếp nhận ghi nhớ ngôn ngữ và làm quen với giọng nói của ba mẹ. Thai giáo vận động cũng nên được áp dụng vừa để duy trì cảm xúc cân bằng của người mẹ, đồng thời tạo nên những kích thích vận động hợp lí, thúc đẩy sự phát triển của thai nhi.</p>    <h4 style="text-align: justify;"><span class="ez-toc-section" id="Thai_giao_thang_thu_5">Thai giáo tháng thứ 5</span></h4>    <p style="text-align: justify;">Ở tháng thứ 5, hệ thống thần kinh của trẻ đang trong giai đoạn phát triển vô cùng quan trọng. Khả năng nhận và truyền thông tin từ các dây thần kinh đến não bộ của bé cũng phát triển mạnh mẽ. Đồng thời, thính giác của bé cũng đang dần trở nên hoàn thiện hơn.</p>    <p style="text-align: justify;">Đây cũng chính là cơ hội thai giáo của những ông bố tương lai vì thai nhi đặc biệt nhạy cảm với âm thanh trầm của nam giới. Người bố có thể thực hành thai giáo bằng ngôn ngữ với con yêu bằng giọng nói trầm ấm, kể cho con nghe về cảnh sắc thiên nhiên, những câu chuyện đẹp đẽ, ý nghĩa để thai nhi cảm nhận được sự yêu thương của bố.</p>    <p style="text-align: justify;">Ngoài ra, những phương pháp <a href="https://poh.vn/thai-giao-thang-thu-5/">thai giáo tháng thứ 5</a> khác nên được áp dụng là thai giáo bằng vuốt ve, tiếp xúc và thai giáo âm nhạc để mẹ bầu duy trì những cảm xúc tích cực và thoải mái trong thai kì.</p>    <h4 style="text-align: justify;"><span class="ez-toc-section" id="Thai_giao_thang_thu_6">Thai giáo tháng thứ 6</span></h4>    <p style="text-align: justify;">Bước sang tháng thứ 6, thai nhi phát triển rất nhanh, những hoạt động của trẻ trở nên rõ ràng hơn, nhịp tim cũng thể hiện rõ nét hơn, khả năng nghe cũng phát triển đến một mức hoàn thiện nhất định.</p>    <p>&nbsp;</p>    <p><img class="aligncenter size-large wp-image-1118 lazyload" src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-6-1024x682.jpg" alt="thai giáo ngôn ngữ tháng thứ 6" width="1024" height="682" data-lazy-srcset="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-6.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-6-300x200.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-6-768x512.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-6-600x400.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-6-848x565.jpg 848w" data-lazy-sizes="(max-width: 1024px) 100vw, 1024px"><noscript><img class="aligncenter size-large wp-image-1118" src="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-6-1024x682.jpg" alt="thai giáo ngôn ngữ tháng thứ 6" width="1024" height="682" srcset="https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-6.jpg 1024w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-6-300x200.jpg 300w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-6-768x512.jpg 768w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-6-600x400.jpg 600w, https://poh.vn/wp-content/uploads/2018/07/thai-giáo-ngôn-ngữ-tháng-thứ-6-848x565.jpg 848w" sizes="(max-width: 1024px) 100vw, 1024px" /></noscript></p>    <p style="text-align: center;"><em>Thai giáo tháng thứ 6 bằng ngôn ngữ và âm nhạc cho thai nhi.</em></p>    <p style="text-align: justify;"><a href="https://poh.vn/thai-giao-thang-thu-6/">Thai giáo tháng thứ 6</a> tập trung vào việc tăng cường huấn luyện khả năng nghe, mở mang trí tuệ cho thai nhi. Các phương pháp thai giáo nên được áp dụng là thai giáo bằng ngôn ngữ, thai giáo bằng âm nhạc.</p>    <p style="text-align: justify;">Ngoài ra, ba mẹ cũng nên thực hành thai giáo vận động yêu để duy trì sức khỏe tốt cho người mẹ đồng thời giúp con phát triển cả về thể lực và trí tuệ.</p>    <h3 style="text-align: justify;"><span class="ez-toc-section" id="Thai_giao_3_thang_cuoi">Thai giáo 3 tháng cuối</span></h3>    <p style="text-align: justify;">Ba tháng cuối thai kỳ là khoảng thời gian vô cùng quan trọng, khi sắp đến ngày ba mẹ chào đón con yêu đến với thế giới mới. Vì vậy <a href="https://poh.vn/thai-giao-3-thang-cuoi/">thai giáo 3 tháng cuối</a> vẫn tập trung vào việc duy trì sức khỏe và cảm xúc ổn định của người mẹ, đồng thời tăng cường rèn luyện các giác quan và trí tuệ của con yêu.</p>    <p style="text-align: justify;">Các phương pháp thai giáo ở những giai đoạn trước vẫn nên được duy trì và áp dụng thường xuyên để đạt được những lợi ích tuyệt vời nhất. Tuy nhiên, ba mẹ nên chú trọng vào các phương pháp thai giáo ánh sáng, thai giáo ngôn ngữ, thai giáo vận động, thai giáo âm nhạc, và thai giáo tiếng Anh.</p>    <h4 style="text-align: justify;"><span class="ez-toc-section" id="Thai_giao_thang_thu_7">Thai giáo tháng thứ 7</span></h4>    <p style="text-align: justify;">Bước sang tháng thứ 7, các giác quan của bé cũng đang phát triển một cách nhanh chóng, các dây thần kinh thị giác của bé cũng đang hoạt động. Ảnh chụp não bộ bào thai cho thấy thai nhi có phản ứng lại với các kích thích và ánh sáng.</p>    <p sty', '/assets/uploads/sample-thumb.jpeg', '/assets/uploads/sample-thumb.jpeg', 1452568877, '', '', '', 69, 'default', 'vietnamese');
INSERT INTO `news` (`id`, `order`, `categoryid`, `title`, `alias`, `description`, `content`, `image`, `thumb`, `create_time`, `meta_title`, `meta_description`, `meta_keywords`, `count_view`, `type`, `language`) VALUES
(2, 0, 3, 'Tập thói quen ăn ngủ cho trẻ sơ sinh với EASY ONE', 'tap-thoi-quen-an-ngu-cho-tre-so-sinh-voi-easy-one', 'Trong quá trình chăm sóc và nuôi dạy trẻ sơ sinh, ba mẹ gặp phải không ít khó khăn trong vấn đề ăn ngủ của con yêu. Vậy làm thế nào để con được ăn no, ngủ đủ giấc và cách luyện trẻ sơ sinh tự ngủ là gì? Để biết được bí quyết, mời ba mẹ đọc bài viết này của POH nhé!', '<p style="text-align:justify">Bạn đang lo lắng về vấn đề ăn ngủ của con m&igrave;nh? V&agrave; bạn vẫn chưa biết c&aacute;ch n&agrave;o để cải thiện t&igrave;nh trạng n&agrave;y?</p>\r\n\r\n<p style="text-align:justify">Bạn c&oacute; thực sự muốn:</p>\r\n\r\n<ul>\r\n	<li>Con c&oacute; thể ngủ một mạch từ 19h tối đến 6-7h s&aacute;ng h&ocirc;m sau, đ&ecirc;m con chỉ ăn đ&ecirc;m 2 lần sau đ&oacute; ngủ trở lại lu&ocirc;n</li>\r\n	<li>Con c&oacute; thể ăn đủ no để ngủ một giấc d&agrave;i chứ kh&ocirc;ng ăn vặt ngủ vặt</li>\r\n	<li>Con c&oacute; thể tự ngủ m&agrave; kh&ocirc;ng cần ti để ngủ hay phải bế ru</li>\r\n	<li>Con c&oacute; một giấc ngủ ngon m&agrave; kh&ocirc;ng giật m&igrave;nh dậy kh&oacute;c th&eacute;t l&ecirc;n</li>\r\n	<li>Vợ chồng bạn được ngủ đủ 8 tiếng buổi đ&ecirc;m, c&oacute; thời gian ri&ecirc;ng cho bản th&acirc;n giống như thời con g&aacute;i.</li>\r\n</ul>\r\n\r\n<p style="text-align:justify">N&agrave;o&hellip; T&ocirc;i biết bạn th&iacute;ch cuộc sống như vậy. Cuộc sống m&agrave; bất kỳ b&agrave; mẹ bỉm sữa n&agrave;o cũng ao ước.</p>\r\n\r\n<p style="text-align:justify">Vậy tại sao bạn vẫn chưa thể giải quyết c&aacute;c vấn đề con bạn đang gặp phải?</p>\r\n\r\n<p style="text-align:justify">H&atilde;y nhớ lại v&agrave;i ng&agrave;y gần đ&acirc;y bạn c&oacute; gặp phải t&igrave;nh trạng n&agrave;y kh&ocirc;ng:</p>\r\n\r\n<ul>\r\n	<li>Con bạn &iacute;t ngủ, giấc ngủ ngắn v&agrave; chập chờn, hay giật m&igrave;nh tỉnh dậy kh&oacute;c?</li>\r\n	<li>Con ngủ ng&agrave;y quấy đ&ecirc;m?</li>\r\n	<li>Con kh&oacute; v&agrave;o giấc ngủ, hay gắt ngủ, hay chỉ ngủ khi bế tr&ecirc;n tay, chỉ ngủ khi được ti?</li>\r\n	<li>Con ăn &iacute;t, ti vặt ngủ vặt?</li>\r\n	<li>Con tỉnh dậy nhiều lần v&agrave;o ban đ&ecirc;m đ&ograve;i ăn, hay quấy kh&oacute;c?</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt="EASY ONE giúp con ăn no ngủ đủ" class="aligncenter lazyloaded size-large wp-image-4374" src="https://poh.vn/wp-content/uploads/2018/11/EASY-ONE-gi%C3%BAp-con-%C4%83n-no-ng%E1%BB%A7-%C4%91%E1%BB%A7-1024x681.jpg" style="border:0px; box-sizing:border-box; clear:both; display:block; height:auto; margin:0px auto; max-width:100%; outline:none !important; vertical-align:middle; width:1024px" /></p>\r\n\r\n<p style="text-align:center"><em>EASY ONE gi&uacute;p con ăn no ngủ đủ.</em></p>\r\n\r\n<p style="text-align:justify">&hellip;&hellip;&hellip;&hellip;.</p>\r\n\r\n<p style="text-align:justify">N&agrave;o&hellip; H&atilde;y thừa nhận đi.</p>\r\n\r\n<p style="text-align:justify">Đ&acirc;y kh&ocirc;ng phải lần đầu ti&ecirc;n bạn đi t&igrave;m một phương ph&aacute;p khoa học, đ&atilde; được &aacute;p dụng th&agrave;nh c&ocirc;ng ở rất nhiều em b&eacute; sơ sinh để c&oacute; thể gi&uacute;p con ăn no ngủ đủ, đ&uacute;ng kh&ocirc;ng?</p>\r\n\r\n<p style="text-align:justify">Khi n&agrave;o mới tới lượt bạn th&agrave;nh c&ocirc;ng đ&acirc;y?</p>\r\n\r\n<p style="text-align:justify">T&ocirc;i c&oacute; một tin vui cho bạn. Khi đọc hết b&agrave;i viết n&agrave;y, bạn sẽ t&igrave;m được trợ thủ tuyệt vời gi&uacute;p con y&ecirc;u của bạn ăn no, ngủ đủ, tự ngủ. C&ograve;n bạn c&oacute; thời gian nghỉ ngơi v&agrave; chăm s&oacute;c bản th&acirc;n giống như thời con g&aacute;i.</p>\r\n\r\n<p style="text-align:justify">Xin ch&agrave;o, t&ocirc;i l&agrave; Hachun Lyonnet, t&aacute;c giả bộ s&aacute;ch Nu&ocirc;i con kh&ocirc;ng phải cuộc chiến v&agrave; đ&atilde; tư vấn về vấn đề ăn ngủ cho h&agrave;ng chục ngh&igrave;n ba mẹ trong hơn 9 năm qua.</p>\r\n\r\n<p style="text-align:justify"><em>&ldquo;Nh&igrave;n con kh&oacute;c em muốn ph&aacute;t đi&ecirc;n l&ecirc;n. Nh&igrave;n đứa b&eacute; trước mặt m&agrave; nghĩ n&oacute; kh&ocirc;ng phải con m&igrave;nh. Kể cả khi con cười h&oacute;ng chuyện, em cũng kh&ocirc;ng muốn cười lại với n&oacute;. Khi nh&igrave;n con kh&oacute;c, em đ&atilde; từng nghĩ quẩn, muốn quăng n&oacute; ra vườn, rồi m&igrave;nh chết đi, để n&oacute; lại cho người mẹ mới.&rdquo;</em></p>\r\n\r\n<p style="text-align:justify">Đ&oacute; l&agrave; đoạn t&acirc;m sự của một b&agrave; mẹ (H.A) gửi cho t&ocirc;i. Thật buồn khi phải chứng kiến những điều n&agrave;y.</p>\r\n\r\n<p style="text-align:justify">Bạn ấy n&oacute;i với t&ocirc;i rằng:<em>&nbsp;&ldquo;B&eacute; nh&agrave; em đ&atilde; gần 3 th&aacute;ng, sinh con xong em c&agrave;ng ng&agrave;y c&agrave;ng mệt mỏi, người như kh&ocirc;ng c&ograve;n t&iacute; sức sống n&agrave;o cả về thể x&aacute;c v&agrave; tinh thần. Em vật lộn với con cả ng&agrave;y, m&agrave; con vẫn quấy kh&oacute;c, ti &iacute;t, ngủ &iacute;t.&rdquo;</em></p>\r\n\r\n<p style="text-align:justify">T&ocirc;i giới thiệu với H.A một trợ thủ, bạn &yacute; đồng &yacute; tham gia, H.A cũng được add v&agrave;o group hỗ trợ ri&ecirc;ng. V&agrave; t&ocirc;i n&oacute;i với bạn &yacute; rằng:</p>\r\n\r\n<p style="text-align:justify"><em>&ldquo;Nếu em muốn kết quả thay đổi, em phải thay đổi từ h&ocirc;m nay. Những biểu hiện của con em b&acirc;y giờ l&agrave; kết quả của lịch sinh hoạt v&agrave; th&oacute;i quen lộn xộn trước đ&acirc;y.&rdquo;</em></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style="text-align:justify">T&ocirc;i bảo H.A đọc hết phần &ldquo;EASY muộn &ndash; D&agrave;nh cho c&aacute;c b&eacute; sau 6 tuần&rdquo;, sau đ&oacute; &aacute;p dụng. Nếu gặp kh&oacute; khăn, em đăng v&agrave;o group. Những người mẹ đi trước, đ&atilde; &aacute;p dụng th&agrave;nh c&ocirc;ng sẽ hỗ trợ em.</p>\r\n\r\n<p style="text-align:justify">Hai h&ocirc;m sau, t&ocirc;i thấy H.A bắt đầu đăng v&agrave;o group để hỏi về EASY. Rồi đến h&ocirc;m thứ 3, bạn ấy tiếp tục hỏi 1 vấn đề đang gặp phải về hướng dẫn con tự ngủ. T&ocirc;i thấy H.A trao đổi rất nhiều với c&aacute;c mẹ kh&aacute;c. Hai h&ocirc;m sau, kh&ocirc;ng thấy H.A hỏi g&igrave;, t&ocirc;i c&oacute; ch&uacute;t lo lắng, v&igrave; mẹ n&agrave;y đang bị trầm cảm. Rồi đến ng&agrave;y thứ 6, bạn &yacute; nhắn tin cho t&ocirc;i khoe:</p>\r\n\r\n<p style="text-align:justify"><em>&ldquo;Chị ơi, em cảm ơn chị nhiều lắm. Em tham gia chương tr&igrave;nh h&ocirc;m nay mới l&agrave; ng&agrave;y thứ 6, m&agrave; con em đ&atilde; ngủ được từ 7h tối, đ&ecirc;m dậy ăn 2 lần, mỗi cữ 130ml. Ăn xong lại ngủ tiếp ngay. S&aacute;ng đến 6h hơn bạn &yacute; mới dậy. Từ chỗ em quần quật với con cả đ&ecirc;m, ng&agrave;y ngủ chập chờn, li&ecirc;n tục tỉnh dậy kh&oacute;c, bước đầu được thế n&agrave;y, em m&atilde;n nguyện lắm rồi. Kh&ocirc;ng c&oacute; chị chắc em chết mất. Trước h&ocirc;m nhắn tin cho chị, em đang định l&ecirc;n HN để đi kh&aacute;m trầm cảm v&agrave; điều trị, m&agrave; giờ hết rồi. Hehe.&rdquo;</em></p>\r\n\r\n<p style="text-align:justify">Sở dĩ t&ocirc;i để &yacute; bạn n&agrave;y v&igrave; bị &aacute;m ảnh với tin nhắn h&ocirc;m đầu bạn n&agrave;y li&ecirc;n hệ, bạn &yacute; c&oacute; dấu hiệu trầm cảm kh&aacute; nặng, n&ecirc;n t&ocirc;i kh&aacute; lo lắng.&nbsp;B&acirc;y giờ th&igrave; t&ocirc;i thở ph&agrave;o nhẹ nh&otilde;m rồi.</p>\r\n', '/assets/uploads/sample-thumb.jpeg', '/assets/uploads/sample-thumb.jpeg', 1544714555, '', '', '', 93, 'default', 'vietnamese'),
(3, 0, 2, 'test 2', 'test-2', 'gfd', '<p><img alt="" src="blob:http://poh.com/c65fb8b6-188e-4579-bdb3-a89bcc406ef7" style="width:2142px" /></p>\r\n\r\n<p>rgdgfdgfdgfdgfdgfdgfd</p>\r\n', '/assets/uploads/2.jpg', '', 1545131153, '', '', '', 0, 'default', 'vietnamese'),
(4, 0, 1, 'Tập thói quen ăn ngủ cho trẻ sơ sinh với EASY ONE', 'tap-thoi-quen-an-ngu-cho-tre-so-sinh-voi-easy-one', 'Trong quá trình chăm sóc và nuôi dạy trẻ sơ sinh, ba mẹ gặp phải không ít khó khăn trong vấn đề ăn ngủ của con yêu. Vậy làm thế nào để con được ăn no, ngủ đủ giấc và cách luyện trẻ sơ sinh tự ngủ là gì? Để biết được bí quyết, mời ba mẹ đọc bài viết này của POH nhé!', '<p style="text-align:justify">Bạn đang lo lắng về vấn đề ăn ngủ của con m&igrave;nh? V&agrave; bạn vẫn chưa biết c&aacute;ch n&agrave;o để cải thiện t&igrave;nh trạng n&agrave;y?</p>\r\n\r\n<p style="text-align:justify">Bạn c&oacute; thực sự muốn:</p>\r\n\r\n<ul>\r\n	<li>Con c&oacute; thể ngủ một mạch từ 19h tối đến 6-7h s&aacute;ng h&ocirc;m sau, đ&ecirc;m con chỉ ăn đ&ecirc;m 2 lần sau đ&oacute; ngủ trở lại lu&ocirc;n</li>\r\n	<li>Con c&oacute; thể ăn đủ no để ngủ một giấc d&agrave;i chứ kh&ocirc;ng ăn vặt ngủ vặt</li>\r\n	<li>Con c&oacute; thể tự ngủ m&agrave; kh&ocirc;ng cần ti để ngủ hay phải bế ru</li>\r\n	<li>Con c&oacute; một giấc ngủ ngon m&agrave; kh&ocirc;ng giật m&igrave;nh dậy kh&oacute;c th&eacute;t l&ecirc;n</li>\r\n	<li>Vợ chồng bạn được ngủ đủ 8 tiếng buổi đ&ecirc;m, c&oacute; thời gian ri&ecirc;ng cho bản th&acirc;n giống như thời con g&aacute;i.</li>\r\n</ul>\r\n\r\n<p style="text-align:justify">N&agrave;o&hellip; T&ocirc;i biết bạn th&iacute;ch cuộc sống như vậy. Cuộc sống m&agrave; bất kỳ b&agrave; mẹ bỉm sữa n&agrave;o cũng ao ước.</p>\r\n\r\n<p style="text-align:justify">Vậy tại sao bạn vẫn chưa thể giải quyết c&aacute;c vấn đề con bạn đang gặp phải?</p>\r\n\r\n<p style="text-align:justify">H&atilde;y nhớ lại v&agrave;i ng&agrave;y gần đ&acirc;y bạn c&oacute; gặp phải t&igrave;nh trạng n&agrave;y kh&ocirc;ng:</p>\r\n\r\n<ul>\r\n	<li>Con bạn &iacute;t ngủ, giấc ngủ ngắn v&agrave; chập chờn, hay giật m&igrave;nh tỉnh dậy kh&oacute;c?</li>\r\n	<li>Con ngủ ng&agrave;y quấy đ&ecirc;m?</li>\r\n	<li>Con kh&oacute; v&agrave;o giấc ngủ, hay gắt ngủ, hay chỉ ngủ khi bế tr&ecirc;n tay, chỉ ngủ khi được ti?</li>\r\n	<li>Con ăn &iacute;t, ti vặt ngủ vặt?</li>\r\n	<li>Con tỉnh dậy nhiều lần v&agrave;o ban đ&ecirc;m đ&ograve;i ăn, hay quấy kh&oacute;c?</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt="EASY ONE giúp con ăn no ngủ đủ" class="aligncenter lazyloaded size-large wp-image-4374" src="https://poh.vn/wp-content/uploads/2018/11/EASY-ONE-gi%C3%BAp-con-%C4%83n-no-ng%E1%BB%A7-%C4%91%E1%BB%A7-1024x681.jpg" style="border:0px; box-sizing:border-box; clear:both; display:block; height:auto; margin:0px auto; max-width:100%; outline:none !important; vertical-align:middle; width:1024px" /></p>\r\n\r\n<p style="text-align:center"><em>EASY ONE gi&uacute;p con ăn no ngủ đủ.</em></p>\r\n\r\n<p style="text-align:justify">&hellip;&hellip;&hellip;&hellip;.</p>\r\n\r\n<p style="text-align:justify">N&agrave;o&hellip; H&atilde;y thừa nhận đi.</p>\r\n\r\n<p style="text-align:justify">Đ&acirc;y kh&ocirc;ng phải lần đầu ti&ecirc;n bạn đi t&igrave;m một phương ph&aacute;p khoa học, đ&atilde; được &aacute;p dụng th&agrave;nh c&ocirc;ng ở rất nhiều em b&eacute; sơ sinh để c&oacute; thể gi&uacute;p con ăn no ngủ đủ, đ&uacute;ng kh&ocirc;ng?</p>\r\n\r\n<p style="text-align:justify">Khi n&agrave;o mới tới lượt bạn th&agrave;nh c&ocirc;ng đ&acirc;y?</p>\r\n\r\n<p style="text-align:justify">T&ocirc;i c&oacute; một tin vui cho bạn. Khi đọc hết b&agrave;i viết n&agrave;y, bạn sẽ t&igrave;m được trợ thủ tuyệt vời gi&uacute;p con y&ecirc;u của bạn ăn no, ngủ đủ, tự ngủ. C&ograve;n bạn c&oacute; thời gian nghỉ ngơi v&agrave; chăm s&oacute;c bản th&acirc;n giống như thời con g&aacute;i.</p>\r\n\r\n<p style="text-align:justify">Xin ch&agrave;o, t&ocirc;i l&agrave; Hachun Lyonnet, t&aacute;c giả bộ s&aacute;ch Nu&ocirc;i con kh&ocirc;ng phải cuộc chiến v&agrave; đ&atilde; tư vấn về vấn đề ăn ngủ cho h&agrave;ng chục ngh&igrave;n ba mẹ trong hơn 9 năm qua.</p>\r\n\r\n<p style="text-align:justify"><em>&ldquo;Nh&igrave;n con kh&oacute;c em muốn ph&aacute;t đi&ecirc;n l&ecirc;n. Nh&igrave;n đứa b&eacute; trước mặt m&agrave; nghĩ n&oacute; kh&ocirc;ng phải con m&igrave;nh. Kể cả khi con cười h&oacute;ng chuyện, em cũng kh&ocirc;ng muốn cười lại với n&oacute;. Khi nh&igrave;n con kh&oacute;c, em đ&atilde; từng nghĩ quẩn, muốn quăng n&oacute; ra vườn, rồi m&igrave;nh chết đi, để n&oacute; lại cho người mẹ mới.&rdquo;</em></p>\r\n\r\n<p style="text-align:justify">Đ&oacute; l&agrave; đoạn t&acirc;m sự của một b&agrave; mẹ (H.A) gửi cho t&ocirc;i. Thật buồn khi phải chứng kiến những điều n&agrave;y.</p>\r\n\r\n<p style="text-align:justify">Bạn ấy n&oacute;i với t&ocirc;i rằng:<em>&nbsp;&ldquo;B&eacute; nh&agrave; em đ&atilde; gần 3 th&aacute;ng, sinh con xong em c&agrave;ng ng&agrave;y c&agrave;ng mệt mỏi, người như kh&ocirc;ng c&ograve;n t&iacute; sức sống n&agrave;o cả về thể x&aacute;c v&agrave; tinh thần. Em vật lộn với con cả ng&agrave;y, m&agrave; con vẫn quấy kh&oacute;c, ti &iacute;t, ngủ &iacute;t.&rdquo;</em></p>\r\n\r\n<p style="text-align:justify">T&ocirc;i giới thiệu với H.A một trợ thủ, bạn &yacute; đồng &yacute; tham gia, H.A cũng được add v&agrave;o group hỗ trợ ri&ecirc;ng. V&agrave; t&ocirc;i n&oacute;i với bạn &yacute; rằng:</p>\r\n\r\n<p style="text-align:justify"><em>&ldquo;Nếu em muốn kết quả thay đổi, em phải thay đổi từ h&ocirc;m nay. Những biểu hiện của con em b&acirc;y giờ l&agrave; kết quả của lịch sinh hoạt v&agrave; th&oacute;i quen lộn xộn trước đ&acirc;y.&rdquo;</em></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style="text-align:justify">T&ocirc;i bảo H.A đọc hết phần &ldquo;EASY muộn &ndash; D&agrave;nh cho c&aacute;c b&eacute; sau 6 tuần&rdquo;, sau đ&oacute; &aacute;p dụng. Nếu gặp kh&oacute; khăn, em đăng v&agrave;o group. Những người mẹ đi trước, đ&atilde; &aacute;p dụng th&agrave;nh c&ocirc;ng sẽ hỗ trợ em.</p>\r\n\r\n<p style="text-align:justify">Hai h&ocirc;m sau, t&ocirc;i thấy H.A bắt đầu đăng v&agrave;o group để hỏi về EASY. Rồi đến h&ocirc;m thứ 3, bạn ấy tiếp tục hỏi 1 vấn đề đang gặp phải về hướng dẫn con tự ngủ. T&ocirc;i thấy H.A trao đổi rất nhiều với c&aacute;c mẹ kh&aacute;c. Hai h&ocirc;m sau, kh&ocirc;ng thấy H.A hỏi g&igrave;, t&ocirc;i c&oacute; ch&uacute;t lo lắng, v&igrave; mẹ n&agrave;y đang bị trầm cảm. Rồi đến ng&agrave;y thứ 6, bạn &yacute; nhắn tin cho t&ocirc;i khoe:</p>\r\n\r\n<p style="text-align:justify"><em>&ldquo;Chị ơi, em cảm ơn chị nhiều lắm. Em tham gia chương tr&igrave;nh h&ocirc;m nay mới l&agrave; ng&agrave;y thứ 6, m&agrave; con em đ&atilde; ngủ được từ 7h tối, đ&ecirc;m dậy ăn 2 lần, mỗi cữ 130ml. Ăn xong lại ngủ tiếp ngay. S&aacute;ng đến 6h hơn bạn &yacute; mới dậy. Từ chỗ em quần quật với con cả đ&ecirc;m, ng&agrave;y ngủ chập chờn, li&ecirc;n tục tỉnh dậy kh&oacute;c, bước đầu được thế n&agrave;y, em m&atilde;n nguyện lắm rồi. Kh&ocirc;ng c&oacute; chị chắc em chết mất. Trước h&ocirc;m nhắn tin cho chị, em đang định l&ecirc;n HN để đi kh&aacute;m trầm cảm v&agrave; điều trị, m&agrave; giờ hết rồi. Hehe.&rdquo;</em></p>\r\n\r\n<p style="text-align:justify">Sở dĩ t&ocirc;i để &yacute; bạn n&agrave;y v&igrave; bị &aacute;m ảnh với tin nhắn h&ocirc;m đầu bạn n&agrave;y li&ecirc;n hệ, bạn &yacute; c&oacute; dấu hiệu trầm cảm kh&aacute; nặng, n&ecirc;n t&ocirc;i kh&aacute; lo lắng.&nbsp;B&acirc;y giờ th&igrave; t&ocirc;i thở ph&agrave;o nhẹ nh&otilde;m rồi.</p>\r\n', '/assets/uploads/sample-thumb.jpeg', '/assets/uploads/sample-thumb.jpeg', 1544714555, '', '', '', 93, 'default', 'vietnamese'),
(5, 0, 2, 'Tập thói quen ăn ngủ cho trẻ sơ sinh với EASY ONE', 'tap-thoi-quen-an-ngu-cho-tre-so-sinh-voi-easy-one', 'Trong quá trình chăm sóc và nuôi dạy trẻ sơ sinh, ba mẹ gặp phải không ít khó khăn trong vấn đề ăn ngủ của con yêu. Vậy làm thế nào để con được ăn no, ngủ đủ giấc và cách luyện trẻ sơ sinh tự ngủ là gì? Để biết được bí quyết, mời ba mẹ đọc bài viết này của POH nhé!', '<p style="text-align:justify">Bạn đang lo lắng về vấn đề ăn ngủ của con m&igrave;nh? V&agrave; bạn vẫn chưa biết c&aacute;ch n&agrave;o để cải thiện t&igrave;nh trạng n&agrave;y?</p>\r\n\r\n<p style="text-align:justify">Bạn c&oacute; thực sự muốn:</p>\r\n\r\n<ul>\r\n	<li>Con c&oacute; thể ngủ một mạch từ 19h tối đến 6-7h s&aacute;ng h&ocirc;m sau, đ&ecirc;m con chỉ ăn đ&ecirc;m 2 lần sau đ&oacute; ngủ trở lại lu&ocirc;n</li>\r\n	<li>Con c&oacute; thể ăn đủ no để ngủ một giấc d&agrave;i chứ kh&ocirc;ng ăn vặt ngủ vặt</li>\r\n	<li>Con c&oacute; thể tự ngủ m&agrave; kh&ocirc;ng cần ti để ngủ hay phải bế ru</li>\r\n	<li>Con c&oacute; một giấc ngủ ngon m&agrave; kh&ocirc;ng giật m&igrave;nh dậy kh&oacute;c th&eacute;t l&ecirc;n</li>\r\n	<li>Vợ chồng bạn được ngủ đủ 8 tiếng buổi đ&ecirc;m, c&oacute; thời gian ri&ecirc;ng cho bản th&acirc;n giống như thời con g&aacute;i.</li>\r\n</ul>\r\n\r\n<p style="text-align:justify">N&agrave;o&hellip; T&ocirc;i biết bạn th&iacute;ch cuộc sống như vậy. Cuộc sống m&agrave; bất kỳ b&agrave; mẹ bỉm sữa n&agrave;o cũng ao ước.</p>\r\n\r\n<p style="text-align:justify">Vậy tại sao bạn vẫn chưa thể giải quyết c&aacute;c vấn đề con bạn đang gặp phải?</p>\r\n\r\n<p style="text-align:justify">H&atilde;y nhớ lại v&agrave;i ng&agrave;y gần đ&acirc;y bạn c&oacute; gặp phải t&igrave;nh trạng n&agrave;y kh&ocirc;ng:</p>\r\n\r\n<ul>\r\n	<li>Con bạn &iacute;t ngủ, giấc ngủ ngắn v&agrave; chập chờn, hay giật m&igrave;nh tỉnh dậy kh&oacute;c?</li>\r\n	<li>Con ngủ ng&agrave;y quấy đ&ecirc;m?</li>\r\n	<li>Con kh&oacute; v&agrave;o giấc ngủ, hay gắt ngủ, hay chỉ ngủ khi bế tr&ecirc;n tay, chỉ ngủ khi được ti?</li>\r\n	<li>Con ăn &iacute;t, ti vặt ngủ vặt?</li>\r\n	<li>Con tỉnh dậy nhiều lần v&agrave;o ban đ&ecirc;m đ&ograve;i ăn, hay quấy kh&oacute;c?</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt="EASY ONE giúp con ăn no ngủ đủ" class="aligncenter lazyloaded size-large wp-image-4374" src="https://poh.vn/wp-content/uploads/2018/11/EASY-ONE-gi%C3%BAp-con-%C4%83n-no-ng%E1%BB%A7-%C4%91%E1%BB%A7-1024x681.jpg" style="border:0px; box-sizing:border-box; clear:both; display:block; height:auto; margin:0px auto; max-width:100%; outline:none !important; vertical-align:middle; width:1024px" /></p>\r\n\r\n<p style="text-align:center"><em>EASY ONE gi&uacute;p con ăn no ngủ đủ.</em></p>\r\n\r\n<p style="text-align:justify">&hellip;&hellip;&hellip;&hellip;.</p>\r\n\r\n<p style="text-align:justify">N&agrave;o&hellip; H&atilde;y thừa nhận đi.</p>\r\n\r\n<p style="text-align:justify">Đ&acirc;y kh&ocirc;ng phải lần đầu ti&ecirc;n bạn đi t&igrave;m một phương ph&aacute;p khoa học, đ&atilde; được &aacute;p dụng th&agrave;nh c&ocirc;ng ở rất nhiều em b&eacute; sơ sinh để c&oacute; thể gi&uacute;p con ăn no ngủ đủ, đ&uacute;ng kh&ocirc;ng?</p>\r\n\r\n<p style="text-align:justify">Khi n&agrave;o mới tới lượt bạn th&agrave;nh c&ocirc;ng đ&acirc;y?</p>\r\n\r\n<p style="text-align:justify">T&ocirc;i c&oacute; một tin vui cho bạn. Khi đọc hết b&agrave;i viết n&agrave;y, bạn sẽ t&igrave;m được trợ thủ tuyệt vời gi&uacute;p con y&ecirc;u của bạn ăn no, ngủ đủ, tự ngủ. C&ograve;n bạn c&oacute; thời gian nghỉ ngơi v&agrave; chăm s&oacute;c bản th&acirc;n giống như thời con g&aacute;i.</p>\r\n\r\n<p style="text-align:justify">Xin ch&agrave;o, t&ocirc;i l&agrave; Hachun Lyonnet, t&aacute;c giả bộ s&aacute;ch Nu&ocirc;i con kh&ocirc;ng phải cuộc chiến v&agrave; đ&atilde; tư vấn về vấn đề ăn ngủ cho h&agrave;ng chục ngh&igrave;n ba mẹ trong hơn 9 năm qua.</p>\r\n\r\n<p style="text-align:justify"><em>&ldquo;Nh&igrave;n con kh&oacute;c em muốn ph&aacute;t đi&ecirc;n l&ecirc;n. Nh&igrave;n đứa b&eacute; trước mặt m&agrave; nghĩ n&oacute; kh&ocirc;ng phải con m&igrave;nh. Kể cả khi con cười h&oacute;ng chuyện, em cũng kh&ocirc;ng muốn cười lại với n&oacute;. Khi nh&igrave;n con kh&oacute;c, em đ&atilde; từng nghĩ quẩn, muốn quăng n&oacute; ra vườn, rồi m&igrave;nh chết đi, để n&oacute; lại cho người mẹ mới.&rdquo;</em></p>\r\n\r\n<p style="text-align:justify">Đ&oacute; l&agrave; đoạn t&acirc;m sự của một b&agrave; mẹ (H.A) gửi cho t&ocirc;i. Thật buồn khi phải chứng kiến những điều n&agrave;y.</p>\r\n\r\n<p style="text-align:justify">Bạn ấy n&oacute;i với t&ocirc;i rằng:<em>&nbsp;&ldquo;B&eacute; nh&agrave; em đ&atilde; gần 3 th&aacute;ng, sinh con xong em c&agrave;ng ng&agrave;y c&agrave;ng mệt mỏi, người như kh&ocirc;ng c&ograve;n t&iacute; sức sống n&agrave;o cả về thể x&aacute;c v&agrave; tinh thần. Em vật lộn với con cả ng&agrave;y, m&agrave; con vẫn quấy kh&oacute;c, ti &iacute;t, ngủ &iacute;t.&rdquo;</em></p>\r\n\r\n<p style="text-align:justify">T&ocirc;i giới thiệu với H.A một trợ thủ, bạn &yacute; đồng &yacute; tham gia, H.A cũng được add v&agrave;o group hỗ trợ ri&ecirc;ng. V&agrave; t&ocirc;i n&oacute;i với bạn &yacute; rằng:</p>\r\n\r\n<p style="text-align:justify"><em>&ldquo;Nếu em muốn kết quả thay đổi, em phải thay đổi từ h&ocirc;m nay. Những biểu hiện của con em b&acirc;y giờ l&agrave; kết quả của lịch sinh hoạt v&agrave; th&oacute;i quen lộn xộn trước đ&acirc;y.&rdquo;</em></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style="text-align:justify">T&ocirc;i bảo H.A đọc hết phần &ldquo;EASY muộn &ndash; D&agrave;nh cho c&aacute;c b&eacute; sau 6 tuần&rdquo;, sau đ&oacute; &aacute;p dụng. Nếu gặp kh&oacute; khăn, em đăng v&agrave;o group. Những người mẹ đi trước, đ&atilde; &aacute;p dụng th&agrave;nh c&ocirc;ng sẽ hỗ trợ em.</p>\r\n\r\n<p style="text-align:justify">Hai h&ocirc;m sau, t&ocirc;i thấy H.A bắt đầu đăng v&agrave;o group để hỏi về EASY. Rồi đến h&ocirc;m thứ 3, bạn ấy tiếp tục hỏi 1 vấn đề đang gặp phải về hướng dẫn con tự ngủ. T&ocirc;i thấy H.A trao đổi rất nhiều với c&aacute;c mẹ kh&aacute;c. Hai h&ocirc;m sau, kh&ocirc;ng thấy H.A hỏi g&igrave;, t&ocirc;i c&oacute; ch&uacute;t lo lắng, v&igrave; mẹ n&agrave;y đang bị trầm cảm. Rồi đến ng&agrave;y thứ 6, bạn &yacute; nhắn tin cho t&ocirc;i khoe:</p>\r\n\r\n<p style="text-align:justify"><em>&ldquo;Chị ơi, em cảm ơn chị nhiều lắm. Em tham gia chương tr&igrave;nh h&ocirc;m nay mới l&agrave; ng&agrave;y thứ 6, m&agrave; con em đ&atilde; ngủ được từ 7h tối, đ&ecirc;m dậy ăn 2 lần, mỗi cữ 130ml. Ăn xong lại ngủ tiếp ngay. S&aacute;ng đến 6h hơn bạn &yacute; mới dậy. Từ chỗ em quần quật với con cả đ&ecirc;m, ng&agrave;y ngủ chập chờn, li&ecirc;n tục tỉnh dậy kh&oacute;c, bước đầu được thế n&agrave;y, em m&atilde;n nguyện lắm rồi. Kh&ocirc;ng c&oacute; chị chắc em chết mất. Trước h&ocirc;m nhắn tin cho chị, em đang định l&ecirc;n HN để đi kh&aacute;m trầm cảm v&agrave; điều trị, m&agrave; giờ hết rồi. Hehe.&rdquo;</em></p>\r\n\r\n<p style="text-align:justify">Sở dĩ t&ocirc;i để &yacute; bạn n&agrave;y v&igrave; bị &aacute;m ảnh với tin nhắn h&ocirc;m đầu bạn n&agrave;y li&ecirc;n hệ, bạn &yacute; c&oacute; dấu hiệu trầm cảm kh&aacute; nặng, n&ecirc;n t&ocirc;i kh&aacute; lo lắng.&nbsp;B&acirc;y giờ th&igrave; t&ocirc;i thở ph&agrave;o nhẹ nh&otilde;m rồi.</p>\r\n', '/assets/uploads/sample-thumb.jpeg', '/assets/uploads/sample-thumb.jpeg', 1544714555, '', '', '', 93, 'default', 'vietnamese'),
(6, 0, 1, 'test 2', 'test-2', 'gfd', '<p><img alt="" src="blob:http://poh.com/c65fb8b6-188e-4579-bdb3-a89bcc406ef7" style="width:2142px" /></p>\r\n\r\n<p>rgdgfdgfdgfdgfdgfdgfd</p>\r\n', '/assets/uploads/2.jpg', '', 1545131153, '', '', '', 0, 'default', 'vietnamese');

-- --------------------------------------------------------

--
-- Table structure for table `news_category`
--

CREATE TABLE IF NOT EXISTS `news_category` (
`id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `featured_news_id` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `language` enum('vietnamese','english') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'vietnamese'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `news_category`
--

INSERT INTO `news_category` (`id`, `title`, `alias`, `parent_id`, `meta_title`, `meta_description`, `meta_keywords`, `featured_news_id`, `language`) VALUES
(1, 'Nuôi dạy con', 'nuoi-day-con', 0, '', '', '', '["1","2"]', 'vietnamese'),
(2, 'Bầu', 'bau', 0, '', '', '', '["2","3"]', 'vietnamese'),
(3, 'Thai giáo', 'thai-giao', 2, '', '', '', '["2","3"]', 'vietnamese'),
(4, 'Kiến thức thai kỳ', 'kien-thuc-thai-ky', 2, '', '', '', '["2","3"]', 'vietnamese');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('text','ckeditor','file') COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `name`, `type`, `value`, `description`) VALUES
(1, 'home_logo', 'file', 'assets/uploads/logo-sample.png', 'Logo trên navigation website'),
(2, 'home_themes_info', 'ckeditor', '<h1 style="text-align:center"><span style="font-size:36px"><span style="color:rgb(178, 34, 34)"><strong>Du xu&acirc;n B&iacute;nh Th&acirc;n 2016 - cảm x&uacute;c mới </strong></span></span></h1>\n\n<hr />\n<div class="des center" style="text-align: center;">\n<p style="text-align:justify"><span style="font-size:20px">Năm mới, đặt ch&acirc;n l&ecirc;n một v&ugrave;ng đất mới, h&iacute;t h&agrave; kh&ocirc;ng kh&iacute; xu&acirc;n trong l&agrave;nh quả l&agrave; một sự khởi đầu th&uacute; vị v&agrave; thật phong c&aacute;ch. N&oacute; gi&uacute;p bạn nạp đầy năng lượng với những niềm vui v&agrave; sự thoải m&aacute;i, hứa hẹn một năm mới may mắn hạnh ph&uacute;c đang ch&agrave;o đ&oacute;n. AsiaTravel thiết kế ch&ugrave;m Tour &ldquo;<em>Du xu&acirc;n B&iacute;nh Th&acirc;n 2016</em>&rdquo;, để bạn được đặt ch&acirc;n đến th&agrave;nh phố đ&aacute;ng sống nhất Việt Nam v&agrave; cầu mong một năm mới tốt l&agrave;nh tại Linh Ứng Tự nổi tiếng linh thi&ecirc;ng. Hoặc kh&aacute;m ph&aacute; m&ugrave;a xu&acirc;n tr&ecirc;n dẻo cao ph&iacute;a Bắc Việt Nam, chi&ecirc;m ngưỡng bạt ng&agrave;n hoa mận nở trắng đất trời v&agrave; n&ocirc; đ&ugrave;a c&ugrave;ng lũ trẻ m&aacute; ửng h&acirc;y h&acirc;y với Tour &ldquo;Mộc Ch&acirc;u &ndash; tết kết nối&rdquo;. Đắm m&igrave;nh trong lễ hội Roong Pooc của người Gi&aacute;y Tả Van hay tận hưởng những ph&uacute;t gi&acirc;y y&ecirc;n b&igrave;nh, thư gi&atilde;n tại &ldquo;một Sapa kh&aacute;c&rdquo;. Thăm th&uacute; cao nguy&ecirc;n đ&aacute; Đồng Văn &ndash; H&agrave; Giang với những bản người H&rsquo;M&ocirc;ng l&agrave; c&aacute;ch ch&uacute;ng ta mở rộng tr&aacute;i tim v&agrave; đ&ocirc;i mắt để học về thế giới tuyệt vời như thế n&agrave;o. Ch&uacute;ng ta chỉ c&oacute; duy nhất một m&ugrave;a xu&acirc;n trong năm. Nếu cứ tr&igrave; ho&atilde;n những chuyến đi, bạn sẽ chẳng bao giờ c&oacute; lại cơ hội để đi du lịch như l&uacute;c n&agrave;y. H&atilde;y để AsiaTravel hiện thực h&oacute;a kế hoạch về những chuyến đi cho bạn!</span></p>\n</div>\n', 'Mô tả ngắn về chủ đề từng gian đoạn'),
(3, 'footer_aboutus', 'ckeditor', 'Công ty CP Dịch vụ Truyền thông &amp; Du lịch Á Châu &reg;\r\n							<br> P602, Tòa nhà Bảo Việt Bank, số 8 Phạm Ngọc Thạch, Hà Nội\r\n							<br>\r\n							<span>Tel. (084) 913 912818</span>\r\n							<br>\r\n							<span>hoặc (084) 437 921379</span>\r\n							<br>\r\n							<span>Fax: (084) 437 480208</span>\r\n							<br>\r\n							<br>', 'Giới thiệu ngắn về công ty - địa chỉ liên hệ'),
(4, 'link_facebook', 'text', 'http://facebook.com/', 'Link facebook'),
(5, 'link_twitter', 'text', 'http://twitter.com', 'Link twitter'),
(6, 'link_gplus', 'text', 'http://google.com', 'Link google plus'),
(7, 'link_instagram', 'text', 'http://instagram.com', 'Link instagram'),
(8, 'home_hotline', 'text', '090 468 3491', 'Hotline liên hệ'),
(9, 'home_meta_title', 'text', 'á châu travel', 'Thẻ meta title ở trang chủ'),
(10, 'home_meta_description', 'text', 'á châu travel', 'Thẻ meta description ở trang chủ'),
(11, 'home_meta_keywords', 'text', 'á châu travel,du lịch giá rẻ, khám phá văn hóa', 'Thẻ meta keywords ở trang chủ'),
(12, 'tour_banner', 'ckeditor', '/assets/img/sample_banner2.jpg', 'Banner ở cuối trang tour'),
(13, 'footer_logo_partners', 'ckeditor', '', 'Logo các đối tác của công ty'),
(14, 'home_short_introduction', 'ckeditor', '<h1 style="font-size: 16px;font-weight: 600">MaichauTourist là công ty số 1 về du lịch Mai Châu</h1>\n<p style="font-size: 14px;">Với kinh nghiệm 7 năm tổ chức tour đi Mai Châu cùng hệ thống nhà sàn, khách sạn và đội ngũ hướng dẫn viên chuyên nghiệp nhất Mai Châu.</p>\n', 'Lời chào ngắn dưới slideshow');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
`id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `meta_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `language` enum('vietnamese','english','japanese') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `alias`, `content`, `thumb`, `create_time`, `meta_description`, `meta_keywords`, `language`) VALUES
(1, 'Về chúng tôi', 'about-us', '<section class="aboutus center">\r\n<div class="container">\r\n<div class="row clearfix">\r\n<div class="col-sm-12">\r\n<div class="mainblock">\r\n<h3 class="maintitle">Lorem ipsum</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n</div>\r\n</div>\r\n\r\n<div class="col-sm-4">\r\n<div class="subblock">\r\n<div class="subtitle">Lorem ipsum</div>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<span style="line-height: 1.6em;"> </span></p>\r\n</div>\r\n</div>\r\n\r\n<div class="col-sm-4">\r\n<div class="subblock">\r\n<div class="subtitle">Lorem ipsum</div>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n</div>\r\n</div>\r\n\r\n<div class="col-sm-4">\r\n<div class="subblock">\r\n<div class="subtitle">Lorem ipsum</div>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</section>\r\n', '', 1469960566, '', '', 'vietnamese');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE IF NOT EXISTS `sliders` (
`id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `thumb` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `caption` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `show` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `image`, `thumb`, `link`, `caption`, `show`) VALUES
(10, 'sample 2', 'assets/uploads/slider/slider_sample.jpg', 'assets/uploads/thumb/slider/slider_sample_thumb.jpg', '#', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE IF NOT EXISTS `subscriber` (
`id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`id`, `email`, `active`, `create_time`) VALUES
(1, 'cuongnd2609@gmail.com', 1, 1469959342);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
`id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `alias` varchar(250) NOT NULL,
  `language` enum('vietnamese','english','japanese') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `name`, `alias`, `language`) VALUES
(1, 'Mai Châu', 'mai-chau', 'vietnamese'),
(2, 'Team Building', 'team-building', 'vietnamese'),
(3, 'Hòa Bình', 'hoa-binh', 'vietnamese'),
(4, 'Phượt Mai Châu', 'phuot-mai-chau', 'vietnamese');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE IF NOT EXISTS `testimonials` (
`id` int(11) NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tour_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `quote` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `display` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `subject`, `alias`, `tour_id`, `name`, `image`, `thumb`, `quote`, `content`, `address`, `email`, `display`) VALUES
(2, 'tour rất tốt', '2-chi-pham-thu-trang', 2, 'Chị Phạm Thu Trang', 'assets/uploads/testimonials/sample_avatar.jpg', 'assets/uploads/thumb/testimonials/sample_avatar_thumb.jpg', 'Công ty chúng tôi lần đầu tiên dự định tổ chức cho CBNV đi du lịch 2 ngày. Điểm đến của chúng tôi là một trong 7 kỳ quan thiên nhiên của thế giới Vịnh Hạ Long. Tôi và BGD Công ty rất lo lắng cho sự an toàn của CBNV cũng như làm sao để tổ chức một buổi giao lưu ấn tượng cho CBNV. Qua tìm hiểu, Công ty chúng tôi đã chọn Công ty Mai Châu Tourist. ', '<p>“Đoàn của chúng tôi đã có người đến Thailand học tập, công tác và du lịch.Nhưng chuyến tham quan cùng với Á Châu lại mang đến sự hiểu biết và trải nghiệm về đất nước, con người và những nét văn hóa đặc sắc của dân tộc Thái. Ấn tượng để lại cho chúng tôi về HDV du lịch tại Thái, đó là tính chuyên nghiệp cao, hài hước,  tế nhị và lịch sự. Đặc biệt hơn, thành viên trong đoàn thực sự bất ngờ & hạnh phúc khi được tận hưởng một bữa tiệc sinh nhật ấm cúng không báo trước mà Achau mang lại cho một số thành viên trong đó có tôi. Cảm ơn Achau”</p>\r\n', 'Trưởng phòng Hành chính Phòng Thống kê Nhà máy Giấy Bãi Bằng', 'maruska@gmail.com', '1'),
(3, 'khách sạn rất đẹp', '1-chi-ngoc-anh', 1, 'Chị Ngọc Anh', 'assets/uploads/testimonials/sample_avatar.jpg', 'assets/uploads/thumb/testimonials/sample_avatar_thumb.jpg', 'Công ty chúng tôi lần đầu tiên dự định tổ chức cho CBNV đi du lịch 2 ngày. Điểm đến của chúng tôi là một trong 7 kỳ quan thiên nhiên của thế giới Vịnh Hạ Long. Tôi và BGD Công ty rất lo lắng cho sự an toàn của CBNV cũng như làm sao để tổ chức một buổi giao lưu ấn tượng cho CBNV. Qua tìm hiểu, Công ty chúng tôi đã chọn Công ty Mai Châu Tourist. ', '<p>Công ty chúng tôi hàng năm vẫn tổ chức cho cán bộ công nhân viên đi nghỉ trong và ngoài nước vào dịp hè, đã sử dụng dịch vụ của nhiều tổ chức khác nhau; mấy năm gần đây thì lựa chọn và đặt niền tin vào Công ty CPDV truyền thông và Du lịch Á Châu bởi nếu so sánh với các đơn vị khác cùng lĩnh vực mà chúng tôi đã sử dụng thì Á Châu vẫn chuyên nghiệp hơn, cước dịch vụ cạnh tranh hơn, chất lượng dịch vụ tốt hơn; đặc biệt Á Châu có đội ngũ cán bộ, nhân viên trẻ, năng động; hướng dẫn viên tận tình, chu đáo, chuyên nghiệp. Chính vì lẽ đó hàng năm sau những tháng ngày lao động mệt mỏi, bươn trải trên thương trường khi cần phải nghỉ ngơi ít ngày ở đâu đó trên dải đất hình chữ S hay ở nước ngoài thì Á Châu là sự lựa chọn của chúng tôi.</p>\r\n', 'Tổng Giám Đốc Công Ty Cổ Phần Phát Triển Hạ Tầng Vĩnh Phúc', 'ngocnapham@gmail.com', '1'),
(4, 'Đồ ăn ngon giá cả hợp lý', '3-chi-trang', 3, 'Chị Trang', 'assets/uploads/testimonials/sample_avatar.jpg', 'assets/uploads/thumb/testimonials/sample_avatar_thumb.jpg', 'Công ty chúng tôi lần đầu tiên dự định tổ chức cho CBNV đi du lịch 2 ngày. Điểm đến của chúng tôi là một trong 7 kỳ quan thiên nhiên của thế giới Vịnh Hạ Long. Tôi và BGD Công ty rất lo lắng cho sự an toàn của CBNV cũng như làm sao để tổ chức một buổi giao lưu ấn tượng cho CBNV. Qua tìm hiểu, Công ty chúng tôi đã chọn Công ty Mai Châu Tourist. ', '<p>Công ty chúng tôi lần đầu tiên dự định tổ chức cho CBNV đi du lịch 2 ngày. Điểm đến của chúng tôi là một trong 7 kỳ quan thiên nhiên của thế giới Vịnh Hạ Long. Tôi và BGD Công ty rất lo lắng cho sự an toàn của CBNV cũng như làm sao để tổ chức một buổi giao lưu ấn tượng cho CBNV. Qua tìm hiểu, Công ty chúng tôi đã chọn Công ty Mai Châu Tourist. Làm việc với các bạn tôi thấy được sự chuyên nghiệp, chu đáo, sáng tạo trong việc sắp xếp xây dựng lịch trình và phối hợp với khách hàng để xây dựng chương trình rất khoa học của nhân viên Công ty Á Châu. Với đoàn đông trên 400 người chúng tôi đã không gặp bất cứ sự cố nào. Chúng tôi đã có một kỳ du lịch thú vị và ấn tượng. BGD người Nhật của Công ty chúng tôi đặc biệt rất hài lòng về chất lượng dịch vụ của Công ty Á Châu. Á châu đã để lại sự tin tưởng cho chúng tôi. Cảm ơn các bạn!</p>\r\n', 'Công Ty TNHH Midori Apparel Việt Nam', 'trang@gmail.com', '1'),
(5, 'Hà Nội mùa này vắng những cơn mưa', '3-ta-hoang-viet', 3, 'Hoang Viet Ta', 'assets/uploads/testimonials/avatar.jpg', 'assets/uploads/thumb/testimonials/avatar_thumb.jpg', 'Một trong những trải nghiệm tuyệt cmn vời hehe', '<p>Một trong những trải nghiệm tuyệt cmn vời hehe</p>\r\n', 'Thanh Xuan Bac - Thanh Xuan', 'hoangviet11088@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `widget`
--

CREATE TABLE IF NOT EXISTS `widget` (
`id` int(11) NOT NULL,
  `section_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `widget`
--

INSERT INTO `widget` (`id`, `section_name`, `position`, `value`) VALUES
(1, 'featured_tour', 'heading', 'CÁC TOUR NỔI BẬT'),
(2, 'featured_tour', 'description', 'Gợi ý các tour hấp dẫn của MaiChauTourist'),
(3, 'featured_tour', 'number_display', '4'),
(4, 'featured_tour', 'biggest', '3'),
(5, 'places', 'heading', 'Nhà hàng - khách sạn - bungalow'),
(6, 'places', 'description', 'Gợi ý các nhà hàng khách sạn của MaiChauTourist'),
(7, 'places', 'number_display', '4'),
(8, 'places', 'number_available', '6'),
(9, 'blogs', 'heading', 'Các bài viết mới nhất của chúng tôi'),
(10, 'blogs', 'description', ''),
(11, 'blogs', 'number_display', '4'),
(12, 'blogs', 'number_available', '6'),
(13, 'testimonials', 'heading', 'Khách hàng chúng tôi đã nói'),
(14, 'testimonials', 'description', ''),
(15, 'testimonials', 'number_display', '2'),
(16, 'testimonials', 'number_available', '6'),
(17, 'footeruser1', 'heading', 'Về chúng tôi'),
(18, 'footeruser1', 'content', '<div class="footer-logo"><img class="img-holder" src="/assets/img/logo-sample.png" style="max-width:160px" /></div>\n\n<p>"Tiên phong" là kim chỉ nam cho mọi hoạt động của MaiChauTourist. Chúng tôi luôn tìm tòi những xu hướng du lịch mới cũng như xây dựng các dịch vụ du lịch hoàn toàn mới mẻ và độc đáo.</p>\n'),
(19, 'footeruser2', 'heading', 'Thông tin doanh nghiệp'),
(20, 'footeruser2', 'content', '<p>Giấy phép kinh doanh số ... do sở KH&ĐT TP Hà Nội cấp phép</p>\n\n<p>Giấy phép kinh doanh Lữ hành quốc tế ...</p>\n\n<ul class="address-info">\n	<li><i class="fa fa-map-marker"></i>số 17, ngách 75, ngõ 592 Trường Chinh, Hà Nội</li>\n	<li><i class="fa fa-phone"></i>0904 123 456</li>\n	<li><i class="fa fa-envelope"></i>maichautourist@gmail.com</li>\n	<li>test</li>\n</ul>\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners_source_click`
--
ALTER TABLE `banners_source_click`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
 ADD PRIMARY KEY (`id`), ADD KEY `parent` (`parent`);

--
-- Indexes for table `menus_term`
--
ALTER TABLE `menus_term`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_category`
--
ALTER TABLE `news_category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `widget`
--
ALTER TABLE `widget`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `banners_source_click`
--
ALTER TABLE `banners_source_click`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `menus_term`
--
ALTER TABLE `menus_term`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `news_category`
--
ALTER TABLE `news_category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `widget`
--
ALTER TABLE `widget`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menus` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
