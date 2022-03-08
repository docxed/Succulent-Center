-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2022 at 09:59 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `succulent`
--

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `plants_id` int(11) NOT NULL COMMENT 'หมายเลขกำกับพันธุ์ไม้',
  `plants_name` varchar(255) NOT NULL COMMENT 'ชื่อพันธุ์ไม้',
  `plants_namemarket` varchar(255) DEFAULT NULL COMMENT 'ชื่อพันธุ์ไม้ทางการตลาด',
  `plants_detail` text NOT NULL COMMENT 'รายละเอียด',
  `plants_img` varchar(255) NOT NULL COMMENT 'รูปภาพ',
  `plantsfamily_name` varchar(255) NOT NULL COMMENT 'วงศ์',
  `plantsgroup_name` varchar(255) NOT NULL COMMENT 'สกุล',
  `plants_timestamp` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'ประทับเวลาพันธุ์ไม้'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `plantsfamily`
--

CREATE TABLE `plantsfamily` (
  `plantsfamily_id` int(11) NOT NULL COMMENT 'หมายเลขกำกับวงศ์',
  `plantsfamily_name` varchar(255) NOT NULL COMMENT 'ชื่อวงศ์',
  `plantsfamily_detail` text NOT NULL COMMENT 'รายละเอียด',
  `plantsfamily_timestamp` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'ประทับเวลาวงศ์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plantsfamily`
--

INSERT INTO `plantsfamily` (`plantsfamily_id`, `plantsfamily_name`, `plantsfamily_detail`, `plantsfamily_timestamp`) VALUES
(7, 'Aizoaceae', 'วงศ์ไอโอซีอี\r\n       เป็นพืชใบเลี้ยงคู่ที่มีชื่อสามัญว่า Carpetweed Family เพราะในธรรมชาติแทรกอยู่ตามซอกหิน ดูกลมกลืนไปกับพื้นดินและออกดอกพรูทั่วทั้งพื้นที่ สมาชิกในวงศ์นี้ส่วนใหญ่เป็นพืชเฉพาะถิ่นในเขตหนาวของประเทศแอฟริกาใต้ มีบางชนิดพบในทวีตออสเตรเสียและหมู่เกาะทางตอนกลางของมหาสมุทรแปซิฟิก ปัจจุบันมีสมาชิกประมาณ 146 สกุล มากกว่า 2,000 ชนิด\r\n       ลักษณะเด่นของพืชวงศ์นี้คือ เป็นไม้ล้มลุกอายุหลายปี อวบน้ำ บางชนิดมีเนื้อไม้เมื่อมีอายุมากขึ้นลำต้นตั้งตรงหรือทอดเลื้อย ยอดชูตั้ง ใบเดี่ยวออกตรงข้ามกันหรือเรีงสลับ แผ่นใบอวบหนา บางชนิดปกคลุมไปด้วยเซลล์พิเศษ เมื่อสะท้อนกับแสงแดดจะดูคล้ายเกล็ดน้ำแข็งเกาะอยู่ตามลำต้น จึงมีชื่อเรียกว่า Ice plant เช่น Carpobrotus edulis ช่อดอกเป็นช่อกระจุกออกที่ซอกใบใกล้ปลายยอด ส่วนใหญ่เป็นดอกสมบูรณ์เพศ\r\nสมมาตรรัศมี มีกลีบเลี้ยง 5 กลีบ ส่วนกลีบดอกลดรูป บางชนิดเกสรเพศผู้ที่เป็นหมันจะลดรูปเป็นเส้นที่ดูคล้ายกลีบดอกเรียงเป็นวงรอบๆผลเป็นฝักมี 1 เมล็ดหรือเมล็ดจำนวนมาก', '2022-03-01 19:06:05'),
(8, 'Amaryllidaceae', 'วงศ์ อมาริลลีเดซีอี\r\nสมาชิกวงศ์นี้ที่รู้จักกันดีคือกลุ่ม \"ว่าน\" หลายชนิด มีความเชื่อว่าใครปลูกไว้หน้าบ้าน จะช่วยป้องกันภยันตรายและสิ่งเลวร้ายไม่ให้มาสู่บ้านเรือ เช่น ว่านนางล้อม (Proiphys amboinensis) ว่านมหาลาภ (Eucrosia bicolor) พลับพลึง (Crinum spp)ที่นอกจากปลูกเลี้ยงเป็นว่านแล้ว ยังนิยมนำใบมาย่างไปให้นิ่ม วางบนบริเวณที่ปวดเพื่อช่วยลดอาการปวดบวมและการอักเสบของกล้ามเนื้อ รวมทั้งว่านสี่ทิศ (Hippeastrum spp.)ที่ปัจจุบันมีการพัฒนาพันธุ์จนมีความหลากหลายของรูปทรง ขนาด และสีดอก จนกลายเป็นไม้ประดับยอดนิยม\r\nลักษณะเด่นของพืชวงศ์นี้คือ มีหัวแบบหัวหอม (Tunicated bulb) อยู่ใต้ดินโดยพัฒนากาบใบที่ซ้อนทับกันบริเวณโคนต้นให้สามารถเก็บสะสมอาหารให้สามารถเจริญเติบโคต่อไปเมื่อมีความชุ่่่มชื่นของสายฝนมาเยือน วงศืนี้มีหลายสกุลที่ทนแล้งได้ดี จนกลายเป็นไม้อวบน้ำที่นิยมปลูกเลี้ยงกัน\r\n', '2022-03-01 19:06:19');

-- --------------------------------------------------------

--
-- Table structure for table `plantsform`
--

CREATE TABLE `plantsform` (
  `plantsform_id` int(11) NOT NULL COMMENT 'หมายเลขกำกับพันธุ์ไม้จดทะเบียน',
  `plantsfamily_name` varchar(255) NOT NULL COMMENT 'วงศ์',
  `plantsgroup_name` varchar(255) NOT NULL COMMENT 'สกุล',
  `plantsform_name` varchar(255) NOT NULL COMMENT 'ชื่อพันธุ์ไม้จดทะเบียน',
  `plantsform_namemarket` varchar(255) DEFAULT NULL COMMENT 'ชื่อทางการตลาดพันธุ์ไม้จดทะเบียน',
  `plantsform_detail` text NOT NULL COMMENT 'รายละเอียด',
  `plantsform_address` text NOT NULL COMMENT 'ระแวกที่อยู่ในการตรวจสอบพันธุ์ไม้',
  `plantsform_img` varchar(255) NOT NULL COMMENT 'รูปภาพ',
  `plantsform_status` enum('check','uncheck') NOT NULL DEFAULT 'uncheck' COMMENT 'สถานะ',
  `user_id` int(11) NOT NULL COMMENT 'ผู้ใช้',
  `plantsform_timestamp` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'ประทับเวลาพันธุ์ไม้จดทะเบียน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `plantsgroup`
--

CREATE TABLE `plantsgroup` (
  `plantsgroup_id` int(11) NOT NULL COMMENT 'หมายเลขกำกับสกุล',
  `plantsgroup_name` varchar(255) NOT NULL COMMENT 'ชื่อสกุล',
  `plantsgroup_detail` text NOT NULL COMMENT 'รายละเอียด',
  `plantsgroup_type` text NOT NULL COMMENT 'ลักษณะทั่วไป',
  `plantsfamily_name` varchar(255) NOT NULL COMMENT 'ชื่อวงศ์',
  `plantsgroup_timestamp` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'ประทับเวลาสกุล'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plantsgroup`
--

INSERT INTO `plantsgroup` (`plantsgroup_id`, `plantsgroup_name`, `plantsgroup_detail`, `plantsgroup_type`, `plantsfamily_name`, `plantsgroup_timestamp`) VALUES
(1, 'Argyroderma', 'Argyroderma สกุล อาร์จีโรเดอร์มา     \r\n     ชื่อสกุลมาจากภาษากรีกว่า arguros แปลว่า สีเงิน กับ derma แปลว่า ผิว หมายถึงผิวที่มีสีเงิน พบเฉพาะในประเทศแอฟริกาใต้ มักขึ้นปนอยู่กับก้อนกรวด ให้ดอกในฤดูใบไม้ผลิไปจนถึงฤดูหนาว มีราว 11 ชนิด ชอบดินร่วนระบายน้ําดี แสงมาก ปลูกเลี้ยงยากในที่อากาศร้อน นิยมขยายพันธุ์โดยการเพาะเมล็ด\r\n', 'ไม้เนื้ออ่อนอายุหลายปี แตกกอทางด้านข้าง ใบอวบหนาทรงกลมหรือรี ออกตรงข้ามกัน ผิวสีเทาหรือเขียวอมเทาเชื่อมติดกันแทนลําต้น มีร่องตรงกลาง ดอกออกที่กึ่งกลางยอด กลีบดอกเป็นฝอยสีชมพู เหลือง หรือสม บานตอนกลางวัน ผลเป็นผลแห้งแตก ภายในมีเมล็ดเล็ก ๆ จํานวนมาก', 'Aizoaceae', '2022-03-01 19:16:17'),
(2, 'Aloinopsis', 'Aloinopsis สกุล สกุลอะลอยน็อปซิส \r\n      ชื่อสกุลมาจากชื่อสกุล aloe กับภาษากรีกว่า opsia สื่อถึงลักษณะพืชสกุลอโล ขนาดเล็กบางชนิด มีมากกว่า 15 ชนิด กระจายพันธุ์บริเวณพื้นที่แห้งแล้งในประเทศแอฟริกาใต้ สกุลนี้พบปลูกเลี้ยงในเมืองไทยเพียงไม่กี่ชนิด ชอบดินร่วนระบายน้ำดี อากาศเย็นและมีลมถ่ายเทดี นิยมขยายพันธุ์โดยการแยกกอ', 'ไม้เนื้อออนอายุหลายปี แตกยอเล็ก ๆ ทุกส่วนร่วมด้ 100% ไม่ มีรากสะสมอาหารขนาดใหญ่อยู่ใต้ดิน ใบสีเขียวอมเทา ผ้าหนาไม่เสียภารกิดจากราย เป็นตุ่ม ดูคล้ายเม็ดหินหรือกรวด ปลายใบแหลมหรือหยักเว้า ช่อดอก ชั้น ตรา 18 ก ถึงกลางต้น กลีบดอกสีเหลืองหรือชมพู ผลแห้งแตก\r\n', 'Aizoaceae', '2022-03-01 19:41:09'),
(4, 'Ammocharis', 'ชื่อสกุลมาจากภาษากรีก 2 คํา คือ ammos แปลว่า ทราย กับคําว่า charls ที่ แปลว่า สวยงาม รวมหมายถึงความงดงามของดอกที่มักพบเห็นท่ามกลางความ แห้งแล้งของดินแดนแถบทะเลทรายสะฮาราซึ่งเป็นถิ่นกําเนิดของพืชสกุยน กระจาย พันธ์ในเขตแห้งแล้งถึงทะเลทรายของทวีปแอฟริกา โดยพบทั้งสิ้น 7 ชนิด ในเมืองไทย แยกหัวและเพาะเมล็ด จะพักตัวและทิ้งใบในช่วงฤดูร้อนและผลิดอกในช่วงหน้าหนาว ขยายพันธุ์ด้วยการ', 'ไม้ล้มลุกอายุหลายปี มีลําต้นใต้ดินเป็นหัวแบบหัวหอม โดยพัฒนา กาบใบที่ซ้อนทับกันบริเวณโคนต้นให้สามารถเก็บสะสมน้ําได้ มีหัวสีเขียวขนาดใหญ่ อยู่ใต้ผิวดิน ช่อดอกแบบช่อซี่ร่มออกจากกึ่งกลางต้น มีดอกย่อยจํานวนมาก ผมแห้ง ค่อนข้างกลม เมื่อแก่ไม่แตกออก ภายในมีเมล็ดค่อนข้างกลมที่มีสันเหลี่ยมเล็กน้อย สีเขียวอ่อน สําหรับชนิดที่นิยมนํามาปลูกเลี้ยงเป็นไม้โขดโชว์หัวมีชื่อสามัญว่า Karoo Lily ซึ่งมีดอกสีแดงสวยงามมาก', 'Amaryllidaceae', '2022-03-01 19:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shop_id` int(11) NOT NULL COMMENT 'หมายเลขกำกับร้านค้า',
  `shop_name` varchar(255) NOT NULL COMMENT 'ชื่อร้านค้า',
  `shop_person` varchar(255) NOT NULL COMMENT 'ชื่อเจ้าของร้าน',
  `shop_detail` text NOT NULL COMMENT 'รายละเอียด',
  `shop_address` text NOT NULL COMMENT 'ที่อยู่',
  `shop_img` varchar(255) NOT NULL COMMENT 'รูปภาพ',
  `user_id` int(11) NOT NULL COMMENT 'ผู้ใช้',
  `shop_timestamp` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'ประทับเวลาร้านค้า'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'หมายเลขกำกับผู้ใช้',
  `user_fname` varchar(255) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `user_lname` varchar(255) NOT NULL COMMENT 'นามสกุล',
  `user_idcard` varchar(255) NOT NULL COMMENT 'บัตรประชาชน',
  `user_email` varchar(255) NOT NULL COMMENT 'อีเมล',
  `user_pass` varchar(255) NOT NULL COMMENT 'รหัสผ่าน',
  `user_role` enum('admin','user') NOT NULL DEFAULT 'user' COMMENT 'สิทธิ์',
  `user_timestamp` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'ประทับเวลาผู้ใช้'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_fname`, `user_lname`, `user_idcard`, `user_email`, `user_pass`, `user_role`, `user_timestamp`) VALUES
(1, 'อคิราภ์', 'สีแสนยง', '1100501551879', 'akira.ajeyb@gmail.com', '$2y$10$VHI0y64ss6Mfo4Q6El.4IuFYc6eM2.bn97JqEe8g27EIUryfGDgJe', 'admin', '2022-03-01 08:43:21'),
(12, 'สอบทด', 'ทดสอบ', '1100501551876', 'test@gmail.com', '$2y$10$t/LkSmSWqa2zaCGR3JUTG.0GUH6C3CpmPRfU57avWTpzHoFUp9UM2', 'user', '2022-03-01 17:20:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`plants_id`);

--
-- Indexes for table `plantsfamily`
--
ALTER TABLE `plantsfamily`
  ADD PRIMARY KEY (`plantsfamily_id`);

--
-- Indexes for table `plantsform`
--
ALTER TABLE `plantsform`
  ADD PRIMARY KEY (`plantsform_id`);

--
-- Indexes for table `plantsgroup`
--
ALTER TABLE `plantsgroup`
  ADD PRIMARY KEY (`plantsgroup_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `plants_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับพันธุ์ไม้';

--
-- AUTO_INCREMENT for table `plantsfamily`
--
ALTER TABLE `plantsfamily`
  MODIFY `plantsfamily_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับวงศ์', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `plantsform`
--
ALTER TABLE `plantsform`
  MODIFY `plantsform_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับพันธุ์ไม้จดทะเบียน';

--
-- AUTO_INCREMENT for table `plantsgroup`
--
ALTER TABLE `plantsgroup`
  MODIFY `plantsgroup_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับสกุล', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับร้านค้า';

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับผู้ใช้', AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
