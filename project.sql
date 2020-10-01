-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 02 2020 г., 14:55
-- Версия сервера: 5.7.25
-- Версия PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `project`
--

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `allaboutdep` (IN `ad` INT)  BEGIN
SELECT DISTINCT v.email,v.date, v.time, v.receipt
from allinfoview v
WHERE v.dep_id=ad;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `allin` ()  BEGIN
SELECT DISTINCT v.email,v.date, v.time, v.address, v.order_id
from allinfoview v;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deletingpro` (IN `o` INT)  BEGIN
  DELETE FROM `order` WHERE id=o;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getall` (IN `c` INT)  BEGIN
SELECT v.date, v.time, v.address, v.title
from allinfoview v
WHERE v.client_id=c;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getandaddress` (IN `addid` INT(11))  BEGIN
  SELECT address
  FROM department d
  WHERE d.id=addid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getinfo` (IN `clientid` INT)  BEGIN
  SELECT o.date, o.time
from `order` o
WHERE o.client_id=clientid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getorderid` (IN `r` VARCHAR(25))  BEGIN
  SELECT o.id, o.date, o.time, o.comment
  FROM `order` o
  WHERE o.receipt LIKE r;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getsdid` (IN `sid` INT, IN `adid` INT)  BEGIN
  SELECT * FROM service_in_department sid WHERE sid.service_id=sid AND sid.department_id=adid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertdata` (IN `firstname` VARCHAR(50), IN `lastname` VARCHAR(50), IN `mail` VARCHAR(50), IN `phone` VARCHAR(50), IN `pass` VARCHAR(25))  BEGIN
INSERT IGNORE INTO client(first_name, last_name, email, phone_number, password) 
  VALUES (firstname, lastname, mail, phone, pass);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertfullorder` (IN `s` INT, `o` INT)  BEGIN
  INSERT IGNORE INTO service_in_order(service_dept_id, order_id) VALUES(s,o);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertorder` (IN `r` VARCHAR(25), IN `c` INT, IN `d` DATE, IN `t` VARCHAR(10), IN `com` VARCHAR(255))  BEGIN
  INSERT IGNORE INTO `order`(receipt, client_id, date, time, comment)
  VALUES (r,c,d,t,com);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `services` (IN `dep` INT)  BEGIN
  SELECT s.id, s.title
  FROM service_in_department sid JOIN service s ON sid.service_id = s.id
  WHERE sid.department_id=dep;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `allinfoview`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `allinfoview` (
`first_name` varchar(50)
,`last_name` varchar(50)
,`email` varchar(50)
,`client_id` int(11)
,`date` date
,`time` varchar(10)
,`address` varchar(255)
,`title` varchar(50)
,`order_id` int(11)
,`dep_id` int(11)
,`receipt` varchar(25)
);

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `client`
--

INSERT INTO `client` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `password`) VALUES
(1, 'Наталья', 'Пупкина', 'firstclient@gmail.com', '000', '000'),
(6, 'Алиса', 'Кукушкина', 'secondclient@gmail.com', '+77777777777', '001'),
(7, 'Лилия', 'Иванова', 'thirdclient@gmail.com', '+79681921928', '003'),
(9, 'Марина', 'Цыглина', 'alohatsyglina@gmail.com', '+77777777770', '555'),
(10, 'Елена', 'Комарова', 'ekom@yandex.ru', '+1111111111', '123');

-- --------------------------------------------------------

--
-- Структура таблицы `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(25) NOT NULL,
  `district` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `department`
--

INSERT INTO `department` (`id`, `address`, `phone_number`, `district`) VALUES
(1, 'ул.Бармалеева, 27', '8-965-256-68-96', 'Петроградский р-н'),
(2, 'пр.Стачек, 134', '8-981-659-12-89', 'Кировский р-н'),
(3, 'ул.Оптиков, 11', '8-999-159-36-78', 'Приморский р-н'),
(4, 'ул. Первого Мая, 1', '8-985-333-11-22', 'Выборгский р-н');

-- --------------------------------------------------------

--
-- Структура таблицы `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `employee`
--

INSERT INTO `employee` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `password`, `department_id`, `job_id`) VALUES
(1, 'Анастасия', 'Смирнова', 'admin1@gmail.com', '111', '111', 1, 1),
(3, 'Татьяна', 'Ларина', 'stylist1@gmail.com', '112', '112', 1, 2),
(4, 'Ольга', 'Ларина', 'cosmet1@gmail.com', '113', '113', 1, 3),
(5, 'Мария', 'Миронова', 'nails1@gmail.com', '114', '114', 1, 4),
(6, 'Елена', 'Курочкина', 'admin2@gmail.com', '211', '211', 2, 1),
(7, 'Анастасия', 'Попова', 'nails2@gmail.com', '214', '214', 2, 4),
(8, 'Елена', 'Шпик', 'cosmet2@gmail.com', '213', '213', 2, 3),
(9, 'Алена', 'Кукушкина', 'admin3@gmail.com', '311', '311', 3, 1),
(10, 'Екатерина', 'Сычикова', 'stylist3@gmail.com', '312', '312', 3, 2),
(11, 'Василиса', 'Иванова', 'admin4@gmail.com', '411', '411', 4, 1),
(12, 'Светлана', 'Пушкина', 'stylist4@gmail.com', '412', '412', 4, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `job`
--

CREATE TABLE `job` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `service_type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `job`
--

INSERT INTO `job` (`id`, `title`, `service_type_id`) VALUES
(1, 'Администратор', NULL),
(2, 'Стилист', 1),
(3, 'Косметолог', 3),
(4, 'Мастер ногтевого сервиса', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `receipt` varchar(25) NOT NULL,
  `client_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(10) NOT NULL,
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `receipt`, `client_id`, `date`, `time`, `comment`) VALUES
(137, '622020-05-01', 6, '2020-05-01', '11:30', ''),
(138, '122020-05-01', 1, '2020-05-01', '20:00', ''),
(151, '132020-05-06', 1, '2020-05-06', '12:15', '000000'),
(156, '722020-05-20', 7, '2020-05-20', '19:15', ''),
(157, '622020-06-30', 6, '2020-06-30', '11:15', ''),
(159, '712020-05-20', 7, '2020-05-20', '14:00', ''),
(161, '1012020-05-30', 10, '2020-05-30', '10:30', ''),
(162, '112020-05-09', 1, '2020-05-09', '12:30', '');

-- --------------------------------------------------------

--
-- Структура таблицы `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `service_type_id` int(11) DEFAULT NULL,
  `price` decimal(19,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `service`
--

INSERT INTO `service` (`id`, `title`, `service_type_id`, `price`) VALUES
(1, 'Женская стрижка', 1, '1000.00'),
(2, 'Мужская стрижка', 1, '700.00'),
(3, 'Укладка', 1, '500.00'),
(4, 'Маникюр без покрытия', 2, '700.00'),
(5, 'Маникюр с покрытием', 2, '1000.00'),
(6, 'Педикюр', 2, '1500.00'),
(7, 'Коррекция бровей', 3, '500.00'),
(8, 'Механический пилинг', 3, '1500.00'),
(9, 'Химический пилинг', 3, '3000.00');

-- --------------------------------------------------------

--
-- Структура таблицы `service_in_department`
--

CREATE TABLE `service_in_department` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `service_in_department`
--

INSERT INTO `service_in_department` (`id`, `service_id`, `department_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 4, 2),
(11, 5, 2),
(12, 6, 2),
(13, 7, 2),
(14, 8, 2),
(15, 9, 2),
(16, 1, 3),
(17, 2, 3),
(18, 3, 3),
(19, 3, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `service_in_order`
--

CREATE TABLE `service_in_order` (
  `id` int(11) NOT NULL,
  `service_dept_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `service_in_order`
--

INSERT INTO `service_in_order` (`id`, `service_dept_id`, `order_id`) VALUES
(83, 1, 159),
(85, 1, 161),
(84, 3, 159),
(86, 3, 161),
(87, 4, 162),
(88, 5, 162),
(81, 11, 157),
(70, 12, 137),
(71, 13, 137),
(105, 13, 138),
(75, 13, 156),
(76, 14, 156),
(74, 17, 151);

-- --------------------------------------------------------

--
-- Структура таблицы `service_type`
--

CREATE TABLE `service_type` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `service_type`
--

INSERT INTO `service_type` (`id`, `title`, `description`) VALUES
(1, 'Парикмахерские услуги', NULL),
(2, 'Ногтевой сервис', NULL),
(3, 'Косметология', NULL);

-- --------------------------------------------------------

--
-- Структура для представления `allinfoview`
--
DROP TABLE IF EXISTS `allinfoview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `allinfoview`  AS  select `c`.`first_name` AS `first_name`,`c`.`last_name` AS `last_name`,`c`.`email` AS `email`,`o`.`client_id` AS `client_id`,`o`.`date` AS `date`,`o`.`time` AS `time`,`d`.`address` AS `address`,`s`.`title` AS `title`,`o`.`id` AS `order_id`,`d`.`id` AS `dep_id`,`o`.`receipt` AS `receipt` from (((((`service_in_department` `sid` join `service` `s` on((`s`.`id` = `sid`.`service_id`))) join `department` `d` on((`sid`.`department_id` = `d`.`id`))) join `service_in_order` `sio` on((`sid`.`id` = `sio`.`service_dept_id`))) join `order` `o` on((`sio`.`order_id` = `o`.`id`))) join `client` `c` on((`o`.`client_id` = `c`.`id`))) ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `address` (`address`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Индексы таблицы `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD KEY `FK_employee_department_id` (`department_id`),
  ADD KEY `FK_employee_job_id` (`job_id`);

--
-- Индексы таблицы `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `FK_job_service_type_id` (`service_type_id`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `receipt` (`receipt`),
  ADD KEY `FK_order_client_id` (`client_id`);

--
-- Индексы таблицы `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `FK_service_service_type_id` (`service_type_id`);

--
-- Индексы таблицы `service_in_department`
--
ALTER TABLE `service_in_department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_service_in_department_service_id` (`service_id`),
  ADD KEY `FK_service_in_department_department_id` (`department_id`);

--
-- Индексы таблицы `service_in_order`
--
ALTER TABLE `service_in_order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_dept_id` (`service_dept_id`,`order_id`),
  ADD KEY `FK_service_in_order_order_id` (`order_id`);

--
-- Индексы таблицы `service_type`
--
ALTER TABLE `service_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `job`
--
ALTER TABLE `job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT для таблицы `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `service_in_department`
--
ALTER TABLE `service_in_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `service_in_order`
--
ALTER TABLE `service_in_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT для таблицы `service_type`
--
ALTER TABLE `service_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `FK_employee_department_id` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_employee_job_id` FOREIGN KEY (`job_id`) REFERENCES `job` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `FK_job_service_type_id` FOREIGN KEY (`service_type_id`) REFERENCES `service_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_order_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `FK_service_service_type_id` FOREIGN KEY (`service_type_id`) REFERENCES `service_type` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ограничения внешнего ключа таблицы `service_in_department`
--
ALTER TABLE `service_in_department`
  ADD CONSTRAINT `FK_service_in_department_department_id` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_service_in_department_service_id` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `service_in_order`
--
ALTER TABLE `service_in_order`
  ADD CONSTRAINT `FK_service_in_order_order_id` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_service_in_order_service_in_department_id` FOREIGN KEY (`service_dept_id`) REFERENCES `service_in_department` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
