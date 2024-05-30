-- phpMyAdmin SQL Dump
-- version 
-- http://www.phpmyadmin.net
--
-- Хост: u429579.mysql.masterhost.ru
-- Время создания: Мар 17 2017 г., 14:39
-- Версия сервера: 5.6.28
-- Версия PHP: 5.4.45-0+deb7u7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `u429579_1735`
--

-- --------------------------------------------------------

--
-- Структура таблицы `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=5461 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `department`
--

INSERT INTO `department` (`id`, `title`) VALUES
(1, 'Отдел 1'),
(2, 'Отдел 2'),
(3, 'Отдел 3');

-- --------------------------------------------------------

--
-- Структура таблицы `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_folder` int(11) DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext,
  `page_count` int(11) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_document_status` int(11) DEFAULT NULL,
  `id_document_kind` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_document_document_kind_id` (`id_document_kind`),
  KEY `FK_document_document_status_id` (`id_document_status`),
  KEY `FK_document_folder_id` (`id_folder`),
  KEY `FK_document_user_id` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `document`
--

INSERT INTO `document` (`id`, `id_folder`, `registration_date`, `number`, `title`, `description`, `page_count`, `destination`, `id_user`, `id_document_status`, `id_document_kind`) VALUES
(1, 1, '2017-03-12 06:41:43', '01', 'Документ 1', 'Описание документа 1', 25, '', 1, 1, 1),
(2, 1, '2017-03-13 09:26:12', '02', 'Документ 2', 'Описание документа 2', 30, '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `document_access`
--

CREATE TABLE IF NOT EXISTS `document_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_document` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_department` int(11) DEFAULT NULL,
  `id_user_type` int(11) DEFAULT NULL,
  `flag_view` bit(1) DEFAULT NULL,
  `flag_edit` bit(1) DEFAULT NULL,
  `flag_delete` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_document_access_department_id` (`id_department`),
  KEY `FK_document_access_document_id` (`id_document`),
  KEY `FK_document_access_user_id` (`id_user`),
  KEY `FK_document_access_user_type_id` (`id_user_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=16384 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `document_access`
--

INSERT INTO `document_access` (`id`, `id_document`, `id_user`, `id_department`, `id_user_type`, `flag_view`, `flag_edit`, `flag_delete`) VALUES
(1, 1, NULL, NULL, 2, '', '\0', '\0');

-- --------------------------------------------------------

--
-- Структура таблицы `document_kind`
--

CREATE TABLE IF NOT EXISTS `document_kind` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=5461 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `document_kind`
--

INSERT INTO `document_kind` (`id`, `title`) VALUES
(1, 'Вид документа 1'),
(2, 'Вид документа 2'),
(3, 'Вид документа 3');

-- --------------------------------------------------------

--
-- Структура таблицы `document_status`
--

CREATE TABLE IF NOT EXISTS `document_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=4096 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `document_status`
--

INSERT INTO `document_status` (`id`, `title`) VALUES
(1, 'Зарегистрирован'),
(2, 'Рассмотрен'),
(3, 'Поставлен на контроль'),
(4, 'Отправлен в архив');

-- --------------------------------------------------------

--
-- Структура таблицы `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_document` int(11) DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_file_document_id` (`id_document`),
  KEY `FK_file_user_id` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `file`
--

INSERT INTO `file` (`id`, `id_document`, `registration_date`, `number`, `title`, `filename`, `size`, `id_user`) VALUES
(1, 1, '2017-03-12 07:38:21', '01', 'Файл 1', 'Composer-Setup.exe', 751448, 1),
(2, 1, '2017-03-13 11:31:00', '02', 'Файл 2', 'Opera_NI_stable.exe', 718136, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `file_access`
--

CREATE TABLE IF NOT EXISTS `file_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_file` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_department` int(11) DEFAULT NULL,
  `id_user_type` int(11) DEFAULT NULL,
  `flag_view` bit(1) DEFAULT NULL,
  `flag_edit` bit(1) DEFAULT NULL,
  `flag_delete` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_file_access_department_id` (`id_department`),
  KEY `FK_file_access_file_id` (`id_file`),
  KEY `FK_file_access_user_id` (`id_user`),
  KEY `FK_file_access_user_type_id` (`id_user_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=16384 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `file_access`
--

INSERT INTO `file_access` (`id`, `id_file`, `id_user`, `id_department`, `id_user_type`, `flag_view`, `flag_edit`, `flag_delete`) VALUES
(1, 1, NULL, NULL, NULL, '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `folder`
--

CREATE TABLE IF NOT EXISTS `folder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_partition` int(11) DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_folder_partition_id` (`id_partition`),
  KEY `FK_folder_user_id` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=5461 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `folder`
--

INSERT INTO `folder` (`id`, `id_partition`, `registration_date`, `number`, `title`, `id_user`) VALUES
(1, 1, '2017-03-12 18:09:35', '01', 'Устав предприятия', 1),
(2, 1, '2017-03-12 06:12:30', '02', 'Протоколы заседания совета директоров', 1),
(3, 1, '2017-03-15 08:32:24', '03', 'Договоры', 19);

-- --------------------------------------------------------

--
-- Структура таблицы `folder_access`
--

CREATE TABLE IF NOT EXISTS `folder_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_folder` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_department` int(11) DEFAULT NULL,
  `id_user_type` int(11) DEFAULT NULL,
  `flag_view` bit(1) DEFAULT NULL,
  `flag_edit` bit(1) DEFAULT NULL,
  `flag_delete` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_folder_access_department_id` (`id_department`),
  KEY `FK_folder_access_folder_id` (`id_folder`),
  KEY `FK_folder_access_user_id` (`id_user`),
  KEY `FK_folder_access_user_type_id` (`id_user_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=16384 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `folder_access`
--

INSERT INTO `folder_access` (`id`, `id_folder`, `id_user`, `id_department`, `id_user_type`, `flag_view`, `flag_edit`, `flag_delete`) VALUES
(1, 1, NULL, NULL, 2, '', '\0', '\0');

-- --------------------------------------------------------

--
-- Структура таблицы `partition`
--

CREATE TABLE IF NOT EXISTS `partition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=5461 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `partition`
--

INSERT INTO `partition` (`id`, `title`) VALUES
(1, 'Раздел 1'),
(2, 'Раздел 2'),
(3, 'Раздел 3');

-- --------------------------------------------------------

--
-- Структура таблицы `rule_type`
--

CREATE TABLE IF NOT EXISTS `rule_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `rule_type`
--

INSERT INTO `rule_type` (`id`, `title`) VALUES
(1, 'Разрешить'),
(2, 'Запретить');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_str` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `nikname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_user_type` int(11) DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `middle_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_department` int(11) DEFAULT NULL,
  `id_user_function` int(11) DEFAULT NULL,
  `birthday` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  KEY `FK_user_department_id` (`id_department`),
  KEY `FK_user_user_function_id` (`id_user_function`),
  KEY `FK_user_user_type_id` (`id_user_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AVG_ROW_LENGTH=5461 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password_str`, `password_hash`, `auth_key`, `password_reset_token`, `activation_token`, `email`, `status`, `created_at`, `updated_at`, `nikname`, `id_user_type`, `last_name`, `first_name`, `middle_name`, `phone`, `id_department`, `id_user_function`, `birthday`) VALUES
(1, 'admin', '123123', '$2y$13$3RLXTm8bp5uAjw4.TKueN.QQx4/wQIhD3cZFTI2cUK1eNcflbzhyy', 'uo3oaTjqwMPiAZugOmnx4Z9pvRWxRTbx', NULL, NULL, 'admin@mail.ru', 10, 1446794447, 1489592615, 'admin', 1, 'Зайцев', 'Алексей', 'Петрович', '+79232131323', 1, 1, '1960-05-15 00:00:00'),
(19, 'user', '123123', '$2y$13$gIHiF3A0F85BiZJsUY0ZSuVhaCEuoY9j/9d.1StnElo1BfyygmiyC', 'IiGfMD7sySpVWoJ7k2IOak-bmD1XlrKQ', NULL, 'R6oTdoqwTTGKzVv7PYHYgkd3dJGy1pD5_1450019853', 'expert@mail.ru', 10, 1450019853, 1489592628, 'manager', 2, 'Иванов', 'Павел', 'Владимирович', '+79879878787', 2, NULL, NULL),
(20, 'user2', '123123', '$2y$13$cHCKSyOlLnLCHfSNdwe6ZexbCswJfKih9RcuRV9lqgdYhyW7oZ/1S', 'ZVFefeFGwDG9C3_QUyULFWerDbvqM5oA', NULL, 'uk5DjMmRQCQjP-NTr6DQhMWd7VTVLJyC_1489592246', 'gudkova@mail.ru', 10, 1489592246, 1489592579, NULL, 2, 'Гудкова', 'Анна', 'Павловна', '+79885252233', 1, 1, '1992-02-15 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `user_function`
--

CREATE TABLE IF NOT EXISTS `user_function` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=5461 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `user_function`
--

INSERT INTO `user_function` (`id`, `title`) VALUES
(1, 'Должность 1'),
(2, 'Должность 2'),
(3, 'Должность 3');

-- --------------------------------------------------------

--
-- Структура таблицы `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `user_type`
--

INSERT INTO `user_type` (`id`, `title`) VALUES
(1, 'Администратор'),
(2, 'Сотрудник');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `FK_document_document_kind_id` FOREIGN KEY (`id_document_kind`) REFERENCES `document_kind` (`id`),
  ADD CONSTRAINT `FK_document_document_status_id` FOREIGN KEY (`id_document_status`) REFERENCES `document_status` (`id`),
  ADD CONSTRAINT `FK_document_folder_id` FOREIGN KEY (`id_folder`) REFERENCES `folder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_document_user_id` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `document_access`
--
ALTER TABLE `document_access`
  ADD CONSTRAINT `FK_document_access_department_id` FOREIGN KEY (`id_department`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_document_access_document_id` FOREIGN KEY (`id_document`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_document_access_user_id` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_document_access_user_type_id` FOREIGN KEY (`id_user_type`) REFERENCES `user_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `FK_file_document_id` FOREIGN KEY (`id_document`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_file_user_id` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `file_access`
--
ALTER TABLE `file_access`
  ADD CONSTRAINT `FK_file_access_department_id` FOREIGN KEY (`id_department`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_file_access_file_id` FOREIGN KEY (`id_file`) REFERENCES `file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_file_access_user_id` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_file_access_user_type_id` FOREIGN KEY (`id_user_type`) REFERENCES `user_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `folder`
--
ALTER TABLE `folder`
  ADD CONSTRAINT `FK_folder_partition_id` FOREIGN KEY (`id_partition`) REFERENCES `partition` (`id`),
  ADD CONSTRAINT `FK_folder_user_id` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `folder_access`
--
ALTER TABLE `folder_access`
  ADD CONSTRAINT `FK_folder_access_department_id` FOREIGN KEY (`id_department`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_folder_access_folder_id` FOREIGN KEY (`id_folder`) REFERENCES `folder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_folder_access_user_id` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_folder_access_user_type_id` FOREIGN KEY (`id_user_type`) REFERENCES `user_type` (`id`);

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_department_id` FOREIGN KEY (`id_department`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `FK_user_user_function_id` FOREIGN KEY (`id_user_function`) REFERENCES `user_function` (`id`),
  ADD CONSTRAINT `FK_user_user_type_id` FOREIGN KEY (`id_user_type`) REFERENCES `user_type` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
