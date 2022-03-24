-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2022 at 06:55 AM
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

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`plants_id`, `plants_name`, `plants_namemarket`, `plants_detail`, `plants_img`, `plantsfamily_name`, `plantsgroup_name`, `plants_timestamp`) VALUES
(3, 'Arguroderma PearSonii', '-', '       อาร์จีโรเดอร์มา เพียร์โซนิอาย\r\nA. (N.E.Br.) Schwantes\r\nถิ่นกำเนิด แอฟริกาใต้', '1846071121.jpg', 'Aizoaceae', 'Argyroderma', '2022-03-23 11:28:50'),
(5, 'Ammocharis Coranica', '-', '       แอมโมคาริส โครานิกา \r\nAmmocharis Coranica (Ker Gawl.) Herb, \r\nถิ่นกําเนิด ซิมบับเว แอฟริกาใต้ ', '1693171535.jpg', 'Amaryllidaceae', 'Ammocharis', '2022-03-23 12:27:46'),
(6, 'Boophane Disticha', '-', '       บูเฟน ดิสติชา \r\nBoophane disticha (L.f.)', '262695984.jpg', 'Amaryllidaceae', 'Boophane', '2022-03-23 13:27:02'),
(7, 'Gethyllis Linearis', '-', '       โกตีลลิส ไลเนียริส\r\nGethyllis linearis L.Bolus \r\nถิ่นกําเนิด แอฟริกาใต้', '110144193.jpg', 'Amaryllidaceae', 'Gethyllis', '2022-03-23 13:31:06');

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
  `plantsform_detail` text NOT NULL COMMENT 'คำอธิบายเกี่ยวกับพรรณไม้ที่ผลิตได้',
  `plantsform_address` text NOT NULL COMMENT 'ระแวกที่อยู่ในการตรวจสอบพันธุ์ไม้',
  `plantsform_lat` varchar(255) NOT NULL COMMENT 'ละติจูด',
  `plantsform_lng` varchar(255) NOT NULL COMMENT 'ลองติจูด',
  `plantsform_img` varchar(255) NOT NULL COMMENT 'รูปภาพ',
  `plantsform_status` enum('check','uncheck') NOT NULL DEFAULT 'uncheck' COMMENT 'สถานะ',
  `user_id` int(11) NOT NULL COMMENT 'ผู้ใช้',
  `plantsform_timestamp` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'ประทับเวลาพันธุ์ไม้จดทะเบียน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plantsform`
--

INSERT INTO `plantsform` (`plantsform_id`, `plantsfamily_name`, `plantsgroup_name`, `plantsform_name`, `plantsform_namemarket`, `plantsform_detail`, `plantsform_address`, `plantsform_lat`, `plantsform_lng`, `plantsform_img`, `plantsform_status`, `user_id`, `plantsform_timestamp`) VALUES
(1, 'Amaryllidaceae', 'Boophane', 'เทสชื่อพันธุ์ไม้', '-', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '19/49 ซอย สายไหม 15 แขวง สายไหม เขตสายไหม กรุงเทพมหานคร 10220 ประเทศไทย', '13.9276771', '100.6441696', '1157915302.jpg', 'uncheck', 1, '2022-03-23 16:33:15'),
(2, 'Aizoaceae', 'Aloinopsis', 'เทสชื่อพันธุ์ไม้ 2', '-', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 'อนุสาวรีย์ชัยสมรภูมิ ถนน พหลโยธิน แขวง ถนนพญาไท เขตราชเทวี กรุงเทพมหานคร', '13.7649084', '100.5382846', '1138015110.jpg', 'uncheck', 1, '2022-03-23 17:02:18');

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
(5, 'Ammocharis', '            ชื่อสกุลมาจากภาษากรีก 2 คํา คือ ammos แปลว่า ทราย กับคําว่า charls ที่ แปลว่า สวยงาม รวมหมายถึงความงดงามของดอกที่มักพบเห็นท่ามกลางความ แห้งแล้งของดินแดนแถบทะเลทรายสะฮาราซึ่งเป็นถิ่นกําเนิดของพืชสกุยน กระจาย พันธ์ในเขตแห้งแล้งถึงทะเลทรายของทวีปแอฟริกา โดยพบทั้งสิ้น 7 ชนิด ในเมืองไทย แยกหัวและเพาะเมล็ด จะพักตัวและทิ้งใบในช่วงฤดูร้อนและผลิดอกในช่วงหน้าหนาว ขยายพันธุ์ด้วยการ', '            ไม้ล้มลุกอายุหลายปี มีลําต้นใต้ดินเป็นหัวแบบหัวหอม โดยพัฒนา กาบใบที่ซ้อนทับกันบริเวณโคนต้นให้สามารถเก็บสะสมน้ําได้ มีหัวสีเขียวขนาดใหญ่ อยู่ใต้ผิวดิน ช่อดอกแบบช่อซี่ร่มออกจากกึ่งกลางต้น มีดอกย่อยจํานวนมาก ผมแห้ง ค่อนข้างกลม เมื่อแก่ไม่แตกออก ภายในมีเมล็ดค่อนข้างกลมที่มีสันเหลี่ยมเล็กน้อย สีเขียวอ่อน สําหรับชนิดที่นิยมนํามาปลูกเลี้ยงเป็นไม้โขดโชว์หัวมีชื่อสามัญว่า Karoo Lily ซึ่งมีดอกสีแดงสวยงามมาก', 'Amaryllidaceae', '2022-03-23 11:59:49'),
(6, 'Boophane', '            ชื่อสกุลมาจากภาษากรีก 2 คํา คือคําว่า bous แปลา วัว และ phone ที่แปลว่า ความตาย สื่อถึงลักษณะเด่นของพืชชนิดนี้ที่มีพิษร้ายแรง หากกินเข้าไปอาจทําให้ตายได้ จึงได้ขอ สามัญว่า Bushman Poison สกุลนี้มีถิ่นกําเนิดในเขตแห้งแล้งทางตอนใต้ของทวีปแอฟริกา พบเพียง 2 ชนิด หากนํามาปลูกเลี้ยง วัสดุปลูกต้องโปร่งระบายน้ําดี นิยมใช้ขุยมะพร้าว 1 ส่วนผสมกับหินภูเขาไฟ 2 ส่วน ส่วนภาชนะปลูกควรเป็นกระถางทรงลึกปากแคบ ตั้งในที มีแสงแดดรําไร 50 เปอร์เซ็นต์ รดน้ําสัปดาห์ละ 2 ครั้ง เติบโตได้ดีในช่วงฤดูหนาวของ เมืองไทย พักตัวในช่วงฤดูร้อนและฝน จึงควรงดน้ําและหมั่นฉีดพ่นสารป้องกันกําจัดเชื้อรา เป็นประจํา ขยายพันธุ์ด้วยการแยกหัวและเพาะเมล็ด ', '            ไม้ล้มลุกอายุหลายปี มีลําต้นใต้ดินเป็นหัวแบบหัวหอมขนาดใหญ่ โดย พัฒนากาบใบที่เรียงซ้อนทับกันบริเวณโคนต้นให้สามารถเก็บสะสมน้ําได้ โคนกาบใบชั้นนอก จะแห้งคล้ายเยื่อกระดาษเพื่อปกป้องหัวให้ปลอดภัยจากความแห้งแล้งและไฟป่า ใบรูป แกบยาว ออกเรียงสลับซ้ายขวาในระนาบเดียว แผ่นใบเป็นลอนสวยงามดูคล้ายพัด ช่อดอกเป็นช่อซี่ร่มขนาดใหญ่ออกจากกึ่งกลางหัว มีดอกย่อยจํานวนมาก กลีบรวมเชื่อม ติดกันเป็นหลอด ปลายแยกเป็น 6 กลีบคล้ายว่านแสงอาทิตย์ (Scadoxus multiflorus) ผลแห้ง ภายในมีเมล็ดกลม มีเนื้อหุ้มเมล็ด นิยมปลูกให้หัวอยู่เหนือผิวดินเพื่อโชว์หัว ทรงต้น และช่อดอก แต่ออกดอกยากในเมืองไทย ว่ากันว่าในธรรมชาติไฟป่าจะช่วยกระตุ้น ให้เกิดตาดอก', 'Amaryllidaceae', '2022-03-23 13:26:21'),
(7, 'Gethyllis', '            ชื่อสกุลมาจากภาษากรีกว่า gethuon แปลว่า หัวหอม ดังลักษณะหัวของพืชสกุลนี้ ซึ่งมีการกระจายพันธุ์อยู่ตามพื้นทรายในแอฟริกาใต้ นามิเบีย และบอตสวานา มีอยู่ ด้วยกันราว 30 กว่าชนิด ช่วงการเจริญเติบโตคือฤดูหนาวและทิ้งไปเมือฤดูฝนมาถึง อนุกรมวิธานของพืชกลุ่มนี้ยังคงมีข้อถกเถียงกันอยู่มาก บทความที่ตีพิมพ์ใน Bulb Society of Africa Bulletin ใช้การจําแนกชนิดจากใบและขนบนใบโดยไม่ได้นําลักษณะ ตอกและผลมาใช้ในการจําแนก ซึ่งขัดกับหลักการทางพฤกษศาสตร์ ทั้ง ๆ ที่ผสมกลิ่น เฉพาะตัวที่เชื่อว่าใช้ล่อให้สัตว์มากินเพื่อช่วยกระจายพันธุ์ ด้วยเหตุนี้ทําให้ผลของ พืชสกุลนี้เป็นที่ต้องการของตลาด ชาวบ้านในท้องถิ่นมักนําไปแช่ในแอลกอฮอล์เพื่อ สกัดกลิ่นและทําเป็นเครื่องดื่ม บ้างใช้อบผ้าเช็ดหน้าหรือกระดาษให้มีกลิ่น ขยายพันธุ์ ด้วยการเพาะเมล็ด โดยเมล็ดจะงอกทันทีเมื่อหลุดออกจากผลและได้รับความชื่น เพียงพอ ถ้าความชื้นไม่พอก็จะเหี่ยวแห้งไป ชอบอากาศเย็น ดินร่วนระบายน้ําดี ', '            ไม้ล้มลุกอายุหลายปี มีหัวคล้ายหัวหอม ใบออกเป็นกระจุกจาก ถึงกลางหัว ใบยาวเป็นเส้นตรงหรือบิดเป็นเกลียว สีเขียวอ่อนหรือเขียวอมฟ้า ส่วนใหญ่มีผิวเรียบ บางชนิดมีเพียง 1 - 2 ใบหรือมีขนสีขาวปกคลุม ออกดอกหลังจาก ผ่านฤดูกาลพักตัวเข้าสู่ฤดูหนาว ให้ดอกเพียงหัวละ 1 ดอกต่อปี มีกลีบดอก 5 กลีบ สีขาวหรือขาวอมเหลือง ผลรูปทรงกระบอกคล้ายใส้กรอก มีเนื้อนุ่ม ภายในมีเมล็ดกลม จํานวนมาก', 'Amaryllidaceae', '2022-03-23 13:27:44');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shop_id` int(11) NOT NULL COMMENT 'หมายเลขกำกับร้านค้า',
  `shop_name` varchar(255) NOT NULL COMMENT 'ชื่อร้านค้า',
  `shop_phone` varchar(255) NOT NULL COMMENT 'เบอร์ติดต่อ',
  `shop_detail` text NOT NULL COMMENT 'รายละเอียด',
  `shop_address` text NOT NULL COMMENT 'ที่อยู่',
  `shop_lat` varchar(255) NOT NULL COMMENT 'ละติจูด',
  `shop_lng` varchar(255) NOT NULL COMMENT 'ลองติจูด',
  `shop_img` varchar(255) NOT NULL COMMENT 'รูปภาพ',
  `user_id` int(11) NOT NULL COMMENT 'ผู้ใช้',
  `shop_timestamp` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'ประทับเวลาร้านค้า'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shop_id`, `shop_name`, `shop_phone`, `shop_detail`, `shop_address`, `shop_lat`, `shop_lng`, `shop_img`, `user_id`, `shop_timestamp`) VALUES
(6, 'ตลาดต้นไม้จตุจักร', '0882923740', 'เป็นตลาดต้นไม้ที่ได้รับความนิยมมากๆ ในช่วงนี้เนื่องจากเดินทางสะดวก แล้วยังมีต้นไม้ให้เลือกเยอะมาก รวมถึงอุปกรณ์การปลูกต้นไม้อย่างครบครัน ไม่ว่าจะเป็น กระถางต้นไม้ ปุ๋ย ดิน ของตกแต่ง เรียกได้ว่ามือใหม่ที่ต้องการปลูกต้นไม้ มาที่นี่ที่เดียวก็สามารถกลับไปปลูกต้นไม้ที่บ้านได้เลย สำหรับต้นไม้ยอดนิยมไว้ฟอกอากาศอย่างพวก ลิ้นมังกร, มอนสเตอร่า, ยางอินเดีย, ไทรใบสัก หรือแม้แต่กระบองเพชร ก็มีให้เลือกเยอะมาก รวมถึงพวกพืชผักสวนครัวก็มีด้วยเช่นกัน ราคาก็ไม่แพงยังอยู่ในเกณฑ์ที่พอรับได้ แนะนำให้มาวันอังคารจะมีของให้เลือกเยอะที่สุด', 'เขตจตุจักร กรุงเทพมหานคร', '13.8306588', '100.5575633', '1105491082.jpg', 1, '2022-03-24 04:55:21'),
(7, 'ตลาดต้นไม้เทเวศร์', '0882923741', 'เป็นตลาดต้นไม้และตลาดสดดั้งเดิมของกรุงเทพฯ อยู่ในเขตพระนคร เลียบคลองผดุงกรุงเกษม มีต้นไม้หลากหลายชนิด ส่วนใหญ่จะเป็นพวกไม้ดอก ไม้ประดับ และไม้มงคล มีอุปกรณ์ตกแต่งสวนให้ได้เลือกซื้อ รวมถึงยังมีเมล็ดพันธ์ต่างๆ จำหน่ายในราคาถูกด้วย แถมคนขายใจดี พร้อมให้คำแนะนำในการเลือกซื้อต้นไม้และจัดสวนเป็นอย่างดีเลย ที่นี่เปิดขายทุกวัน แต่ถ้ามาวันเสาร์-อาทิตย์ก็จะคึกคักเป็นพิเศษ นอกจากนี้ที่ตลาดยังมีของอร่อยให้กินเพียบ\r\n\r\n', 'เขตพระนคร กรุงเทพมหานคร', '13.7573251', '100.4951406', '1052487464.jpg', 1, '2022-03-24 04:56:05'),
(8, 'ตลาดต้นไม้กรมทหารราบ 11', '0882923742', 'เป็นตลาดต้นไม้ที่ติดอับดับ 1 ใน 5 ที่ใหญ่ที่สุดในกรุงเทพฯ เมื่อเดินเข้ามาพื้นที่ด้านหน้าโครงการส่วนมากจะเป็นร้านจำหน่ายไม้ประดับขนาดเล็กทั่วไป ด้านในมีจำหน่ายไม้ดอกหลากสีนานาพันธุ์ และต้นไม้หลากหลายชนิดตั้งแต่ไม้ขนาดเล็กไปจนถึงไม้ใหญ่ รวมถึงมีอุปกรณ์ที่ใช้ในการปลูก การจัดสวนด้วย ซึ่งจำหน่ายในราคาถูกกว่าท้องตลาดถึง 30 เปอร์เซ็นต์เลยทีเดียว ที่นี่เปิดให้บริการทุกวัน ถ้ามาวันหยุดคนจะเยอะหน่อย แต่รับรองว่าได้ต้นไม้ถูกใจ และคุ้มค่า คุ้มราคาแน่นอนจ้า\r\n\r\n', 'กองพันทหารราบที่ 2 กรมทหารราบที่ 11 รักษาพระองค์ แขวง อนุสาวรีย์ เขตบางเขน กรุงเทพมหานคร', '13.863655', '100.5942459', '1940723130.jpg', 1, '2022-03-24 04:56:35'),
(9, 'ตลาดต้นไม้เลียบทางด่วนรามอินทรา', '0882923742', 'ถึงแม้ที่นี่จะไม่ได้รวมกลุ่มกันขายเป็นตลาดเหมือนที่อื่นๆ ส่วนใหญ่จะเปิดเป็นร้านๆ ไป ตลอดแนวเลียบทางด่วนรามอินทราบนถนนประดิษฐ์มนูธรรม 27 สำหรับใครที่อยากจัดสวนเล็กๆ ไว้ในบริเวณบ้านที่นี่มีจำหน่ายต้นไม้กระถางเล็กๆ อย่างพวกไม้ดอก ไม้ประดับ และของตกแต่งสวนน่ารักๆ แต่ที่นี่จะหาที่จอดรถค่อนข้างยากเพราะอยู่ติดริมถนน ใครที่อาศัยหรือทำงานอยู่แถวๆ นี้แล้วอยากได้ต้นไม้ไปตกแต่งบ้าน มาแวะซื้อกันได้เลยนะ เพราะเขาเปิดขายทุกวันจ้า\r\n\r\n', 'ถนน ประดิษฐ์มนูธรรม แขวงลาดพร้าว เขตลาดพร้าว กรุงเทพมหานคร', '13.819494', '100.6253923', '218516836.jpg', 1, '2022-03-24 04:57:24'),
(10, 'ตลาดต้นไม้ธนบุรี (สนามหลวง 2)', '0882923743', 'เป็นอีกหนึ่งตลาดต้นไม้ขนาดใหญ่ อยู่ทางฝั่งธน หรือที่รู้จักกันดีว่าสนามหลวง 2 ที่นี่จะเป็นศูนย์รวมต้นไม้ ดอกไม้ พันธุ์ไม้ชนิดต่างๆ ราคาถูก มีให้เลือกหลายร้าน นอกจากต้นไม้ดอกไม้แล้ว ยังจำหน่ายสัตว์เลี้ยงด้วยไม่ว่าจะเป็น สัตว์น้ำ สัตว์บก ปลาสายพันธุ์ต่างๆ สุนัขพันธุ์น่ารักๆ รวมถึงของประดับตกแต่งทั้งในบ้านและนอกบ้าน แถมระแวกนั้นมีสวนสาธารณะที่สามารถไปถ่ายรูป นั่งเล่นได้ เหมาะกับไปในวันว่างชิลๆ', 'ถนน คลองทวีวัฒนา แขวง ทวีวัฒนา เขตทวีวัฒนา กรุงเทพมหานคร', '13.7575863', '100.3496325', '1171471567.jpg', 1, '2022-03-24 04:58:22'),
(11, 'ตลาดต้นไม้ทอ.ทุ่งสีกัน', '0882923744', 'เป็นตลาดต้นไม้ในส่วนของกองทัพอากาศย่านดอนเมือง ถึงที่นี่จะเป็นตลาดต้นไม้ที่ไม่ใหญ่มากนัก แต่ก็มีพันธุ์ไม้ให้เลือกเยอะ ที่ฮิตๆ อย่างยางอินเดีย ไทรใบสัก แล้วก็พวกกระบองเพชรน่ารักๆ ก็มีให้เลือกเต็มไปหมด รวมถึงวัสดุอุปกรณ์ในการจัดสวนก็มี เช่น กระถางต้นไม้สวยๆ อ่างบัว หินจัดสวน อิฐจัดสวน ดิน ปุ๋ย ราคาย่อมเยาไม่แพงมากนัก แถมที่นี่ยังมีที่จอดรถให้ด้วยสะดวกสุดๆ ใครที่อยู่ย่านดอนเมืองแล้วกำลังมองหาต้นไม้ไปปลูกสักต้น พร้อมอุปกรณ์ในการจัดสวนแวะมาที่นี่ได้เลย', 'ดอนเมือง (อาคารผู้โดยสาร 1) แขวง สนามบิน เขตดอนเมือง กรุงเทพมหานคร', '13.9029982', '100.5936219', '1884744555.jpg', 1, '2022-03-24 04:59:11');

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
  MODIFY `plants_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับพันธุ์ไม้', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `plantsfamily`
--
ALTER TABLE `plantsfamily`
  MODIFY `plantsfamily_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับวงศ์', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `plantsform`
--
ALTER TABLE `plantsform`
  MODIFY `plantsform_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับพันธุ์ไม้จดทะเบียน', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plantsgroup`
--
ALTER TABLE `plantsgroup`
  MODIFY `plantsgroup_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับสกุล', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับร้านค้า', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับผู้ใช้', AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
