/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `tb_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_entry` (
  `state` int(2) NOT NULL,
  `uid` varchar(30) NOT NULL,
  PRIMARY KEY (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_list_access` (
  `uid` varchar(30) NOT NULL,
  `token` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_log` (
  `uid` varchar(30) NOT NULL,
  `token` varchar(30) NOT NULL,
  `date_time` datetime NOT NULL,
  `log_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_mcu` (
  `token` varchar(30) NOT NULL,
  `name` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `keypad_password` int(5) NOT NULL,
  `delay` int(6) NOT NULL,
  PRIMARY KEY (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_user` (
  `uid` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `block` int(11) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'password');
INSERT INTO `tb_admin` (`id`, `username`, `password`) VALUES
(2, 'dani', '123');


INSERT INTO `tb_entry` (`state`, `uid`) VALUES
(1, '');


INSERT INTO `tb_list_access` (`uid`, `token`) VALUES
('BADDCF80', '6228534b6e7c4');
INSERT INTO `tb_list_access` (`uid`, `token`) VALUES
('53E8823E', '6226f59be7766');
INSERT INTO `tb_list_access` (`uid`, `token`) VALUES
('53E8823E', '6228534b6e7c4');

INSERT INTO `tb_log` (`uid`, `token`, `date_time`, `log_status`) VALUES
('53E8823E', '6226f59be7766', '2022-03-08 14:41:49', 1);
INSERT INTO `tb_log` (`uid`, `token`, `date_time`, `log_status`) VALUES
('BADDCF80', '6226f59be7766', '2022-03-08 14:42:22', 1);
INSERT INTO `tb_log` (`uid`, `token`, `date_time`, `log_status`) VALUES
('BADDCF80', '6226f59be7766', '2022-03-08 14:42:41', 1);
INSERT INTO `tb_log` (`uid`, `token`, `date_time`, `log_status`) VALUES
('53E8823E', '6226f59be7766', '2022-03-08 14:42:57', 1),
('53E8823E', '6226f59be7766', '2022-03-08 14:51:57', 1),
('53E8823E', '6226f59be7766', '2022-03-08 14:59:56', 1),
('53E8823E', '6226f59be7766', '2022-03-08 15:00:15', 1),
('53E8823E', '6226f59be7766', '2022-03-08 15:01:11', 1),
('53E8823E', '6226f59be7766', '2022-03-08 15:01:33', 0),
('BADDCF80', '6226f59be7766', '2022-03-08 15:02:32', 1),
('BADDCF80', '6226f59be7766', '2022-03-08 15:03:53', 0),
('53E8823E', '6226f59be7766', '2022-03-08 15:06:49', 0),
('BADDCF80', '6226f59be7766', '2022-03-08 15:08:53', 0),
('BADDCF80', '6226f59be7766', '2022-03-08 15:15:33', 0),
('53E8823E', '6226f59be7766', '2022-03-08 15:24:41', 0),
('BADDCF80', '6226f59be7766', '2022-03-08 15:27:15', 0),
('53E8823E', '6226f59be7766', '2022-03-08 15:28:49', 0),
('BADDCF80', '6226f59be7766', '2022-03-08 15:31:39', 0),
('BADDCF80', '6226f59be7766', '2022-03-08 15:48:45', 0),
('53E8823E', '6226f59be7766', '2022-03-08 15:49:00', 0),
('53E8823E', '6226f59be7766', '2022-03-08 15:50:43', 0),
('BADDCF80', '6226f59be7766', '2022-03-08 20:16:27', 0),
('53E8823E', '6226f59be7766', '2022-03-08 20:18:14', 0),
('BADDCF80', '6226f59be7766', '2022-03-08 20:23:56', 0),
('53E8823E', '6226f59be7766', '2022-03-08 20:24:10', 0),
('53E8823E', '6226f59be7766', '2022-03-08 20:25:29', 0),
('53E8823E', '6226f59be7766', '2022-03-08 20:27:55', 0),
('53E8823E', '6228534b6e7c4', '2022-03-09 14:16:38', 1),
('53E8823E', '6228534b6e7c4', '2022-03-09 14:17:42', 0),
('BADDCF80', '6228534b6e7c4', '2022-03-09 14:18:03', 1),
('BADDCF80', '6228534b6e7c4', '2022-03-09 14:18:52', 0),
('53E8823E', '6228534b6e7c4', '2022-03-11 12:37:46', 0),
('BADDCF80', '6228534b6e7c4', '2022-03-11 12:37:55', 0),
('53E8823E', '6228534b6e7c4', '2022-03-11 12:38:39', 0),
('53E8823E', '6228534b6e7c4', '2022-03-11 12:39:02', 0),
('53E8823E', '6228534b6e7c4', '2022-03-11 12:40:17', 0),
('BADDCF80', '6228534b6e7c4', '2022-03-11 12:40:25', 0),
('53E8823E', '6228534b6e7c4', '2022-03-11 12:41:23', 0),
('BADDCF80', '6228534b6e7c4', '2022-03-11 12:41:36', 0),
('53E8823E', '6228534b6e7c4', '2022-03-11 12:43:12', 0);

INSERT INTO `tb_mcu` (`token`, `name`, `type`, `keypad_password`, `delay`) VALUES
('6226f59be7766', 'Test', 'NodeMCU', 12345, 10000);
INSERT INTO `tb_mcu` (`token`, `name`, `type`, `keypad_password`, `delay`) VALUES
('6228534b6e7c4', 'Ruang Kantor', 'NodeMCU', 24685, 5000);


INSERT INTO `tb_user` (`uid`, `username`, `block`) VALUES
('53E8823E', 'Khanzzz', 0);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;