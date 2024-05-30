-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 5.0.97.1
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 15.03.2017 23:09:03
-- Версия сервера: 5.0.67-community-nt
-- Версия клиента: 4.1

-- 
-- Отключение внешних ключей
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Установка кодировки, с использованием которой клиент будет посылать запросы на сервер
--
SET NAMES 'utf8';

-- 
-- Установка базы данных по умолчанию
--
USE base1735;

--
-- Описание для таблицы department
--
DROP TABLE IF EXISTS department;
CREATE TABLE department (
  id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы document_kind
--
DROP TABLE IF EXISTS document_kind;
CREATE TABLE document_kind (
  id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы document_status
--
DROP TABLE IF EXISTS document_status;
CREATE TABLE document_status (
  id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 5
AVG_ROW_LENGTH = 4096
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы partition
--
DROP TABLE IF EXISTS partition;
CREATE TABLE partition (
  id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы rule_type
--
DROP TABLE IF EXISTS rule_type;
CREATE TABLE rule_type (
  id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы user_function
--
DROP TABLE IF EXISTS user_function;
CREATE TABLE user_function (
  id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы user_type
--
DROP TABLE IF EXISTS user_type;
CREATE TABLE user_type (
  id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы user
--
DROP TABLE IF EXISTS user;
CREATE TABLE user (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  password_str VARCHAR(255) DEFAULT NULL,
  password_hash VARCHAR(255) NOT NULL,
  auth_key VARCHAR(32) NOT NULL,
  password_reset_token VARCHAR(255) DEFAULT NULL,
  activation_token VARCHAR(255) DEFAULT NULL,
  email VARCHAR(255) NOT NULL,
  status SMALLINT(6) NOT NULL DEFAULT 10,
  created_at INT(11) NOT NULL,
  updated_at INT(11) NOT NULL,
  nikname VARCHAR(255) DEFAULT NULL,
  id_user_type INT(11) DEFAULT NULL,
  last_name VARCHAR(255) DEFAULT NULL,
  first_name VARCHAR(255) DEFAULT NULL,
  middle_name VARCHAR(255) DEFAULT NULL,
  phone VARCHAR(255) DEFAULT NULL,
  id_department INT(11) DEFAULT NULL,
  id_user_function INT(11) DEFAULT NULL,
  birthday DATETIME DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX email (email),
  UNIQUE INDEX password_reset_token (password_reset_token),
  UNIQUE INDEX username (username),
  CONSTRAINT FK_user_department_id FOREIGN KEY (id_department)
    REFERENCES department(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT FK_user_user_function_id FOREIGN KEY (id_user_function)
    REFERENCES user_function(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT FK_user_user_type_id FOREIGN KEY (id_user_type)
    REFERENCES user_type(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 21
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Описание для таблицы folder
--
DROP TABLE IF EXISTS folder;
CREATE TABLE folder (
  id INT(11) NOT NULL AUTO_INCREMENT,
  id_partition INT(11) DEFAULT NULL,
  registration_date DATETIME DEFAULT NULL,
  number VARCHAR(255) DEFAULT NULL,
  title VARCHAR(255) DEFAULT NULL,
  id_user INT(11) DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT FK_folder_partition_id FOREIGN KEY (id_partition)
    REFERENCES partition(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT FK_folder_user_id FOREIGN KEY (id_user)
    REFERENCES user(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы document
--
DROP TABLE IF EXISTS document;
CREATE TABLE document (
  id INT(11) NOT NULL AUTO_INCREMENT,
  id_folder INT(11) DEFAULT NULL,
  registration_date DATETIME DEFAULT NULL,
  number VARCHAR(255) DEFAULT NULL,
  title VARCHAR(255) DEFAULT NULL,
  description LONGTEXT DEFAULT NULL,
  page_count INT(11) DEFAULT NULL,
  destination VARCHAR(255) DEFAULT NULL,
  id_user INT(11) DEFAULT NULL,
  id_document_status INT(11) DEFAULT NULL,
  id_document_kind INT(11) DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT FK_document_document_kind_id FOREIGN KEY (id_document_kind)
    REFERENCES document_kind(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT FK_document_document_status_id FOREIGN KEY (id_document_status)
    REFERENCES document_status(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT FK_document_folder_id FOREIGN KEY (id_folder)
    REFERENCES folder(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_document_user_id FOREIGN KEY (id_user)
    REFERENCES user(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы folder_access
--
DROP TABLE IF EXISTS folder_access;
CREATE TABLE folder_access (
  id INT(11) NOT NULL AUTO_INCREMENT,
  id_folder INT(11) DEFAULT NULL,
  id_user INT(11) DEFAULT NULL,
  id_department INT(11) DEFAULT NULL,
  id_user_type INT(11) DEFAULT NULL,
  flag_view BIT(1) DEFAULT NULL,
  flag_edit BIT(1) DEFAULT NULL,
  flag_delete BIT(1) DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT FK_folder_access_department_id FOREIGN KEY (id_department)
    REFERENCES department(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_folder_access_folder_id FOREIGN KEY (id_folder)
    REFERENCES folder(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_folder_access_user_id FOREIGN KEY (id_user)
    REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_folder_access_user_type_id FOREIGN KEY (id_user_type)
    REFERENCES user_type(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 5
AVG_ROW_LENGTH = 16384
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы document_access
--
DROP TABLE IF EXISTS document_access;
CREATE TABLE document_access (
  id INT(11) NOT NULL AUTO_INCREMENT,
  id_document INT(11) DEFAULT NULL,
  id_user INT(11) DEFAULT NULL,
  id_department INT(11) DEFAULT NULL,
  id_user_type INT(11) DEFAULT NULL,
  flag_view BIT(1) DEFAULT NULL,
  flag_edit BIT(1) DEFAULT NULL,
  flag_delete BIT(1) DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX id (id),
  CONSTRAINT FK_document_access_department_id FOREIGN KEY (id_department)
    REFERENCES department(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_document_access_document_id FOREIGN KEY (id_document)
    REFERENCES document(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_document_access_user_id FOREIGN KEY (id_user)
    REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_document_access_user_type_id FOREIGN KEY (id_user_type)
    REFERENCES user_type(id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AUTO_INCREMENT = 2
AVG_ROW_LENGTH = 16384
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы file
--
DROP TABLE IF EXISTS file;
CREATE TABLE file (
  id INT(11) NOT NULL AUTO_INCREMENT,
  id_document INT(11) DEFAULT NULL,
  registration_date DATETIME DEFAULT NULL,
  number VARCHAR(255) DEFAULT NULL,
  title VARCHAR(255) DEFAULT NULL,
  filename VARCHAR(255) DEFAULT NULL,
  size INT(11) DEFAULT NULL,
  id_user INT(11) DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT FK_file_document_id FOREIGN KEY (id_document)
    REFERENCES document(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_file_user_id FOREIGN KEY (id_user)
    REFERENCES user(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы file_access
--
DROP TABLE IF EXISTS file_access;
CREATE TABLE file_access (
  id INT(11) NOT NULL AUTO_INCREMENT,
  id_file INT(11) DEFAULT NULL,
  id_user INT(11) DEFAULT NULL,
  id_department INT(11) DEFAULT NULL,
  id_user_type INT(11) DEFAULT NULL,
  flag_view BIT(1) DEFAULT NULL,
  flag_edit BIT(1) DEFAULT NULL,
  flag_delete BIT(1) DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT FK_file_access_department_id FOREIGN KEY (id_department)
    REFERENCES department(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_file_access_file_id FOREIGN KEY (id_file)
    REFERENCES file(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_file_access_user_id FOREIGN KEY (id_user)
    REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_file_access_user_type_id FOREIGN KEY (id_user_type)
    REFERENCES user_type(id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AUTO_INCREMENT = 2
AVG_ROW_LENGTH = 16384
CHARACTER SET utf8
COLLATE utf8_general_ci;

-- 
-- Вывод данных для таблицы department
--
INSERT INTO department VALUES 
  (1, 'Отдел 1'),
  (2, 'Отдел 2'),
  (3, 'Отдел 3');

-- 
-- Вывод данных для таблицы document_kind
--
INSERT INTO document_kind VALUES 
  (1, 'Вид документа 1'),
  (2, 'Вид документа 2'),
  (3, 'Вид документа 3');

-- 
-- Вывод данных для таблицы document_status
--
INSERT INTO document_status VALUES 
  (1, 'Зарегистрирован'),
  (2, 'Рассмотрен'),
  (3, 'Поставлен на контроль'),
  (4, 'Отправлен в архив');

-- 
-- Вывод данных для таблицы partition
--
INSERT INTO partition VALUES 
  (1, 'Раздел 1'),
  (2, 'Раздел 2'),
  (3, 'Раздел 3');

-- 
-- Вывод данных для таблицы rule_type
--
INSERT INTO rule_type VALUES 
  (1, 'Разрешить'),
  (2, 'Запретить');

-- 
-- Вывод данных для таблицы user_function
--
INSERT INTO user_function VALUES 
  (1, 'Должность 1'),
  (2, 'Должность 2'),
  (3, 'Должность 3');

-- 
-- Вывод данных для таблицы user_type
--
INSERT INTO user_type VALUES 
  (1, 'Администратор'),
  (2, 'Сотрудник');

-- 
-- Вывод данных для таблицы user
--
INSERT INTO user VALUES 
  (1, 'admin', '123123', '$2y$13$3RLXTm8bp5uAjw4.TKueN.QQx4/wQIhD3cZFTI2cUK1eNcflbzhyy', 'uo3oaTjqwMPiAZugOmnx4Z9pvRWxRTbx', NULL, NULL, 'admin@mail.ru', 10, 1446794447, 1489592615, 'admin', 1, 'Зайцев', 'Алексей', 'Петрович', '+79232131323', 1, 1, '1960-05-15 00:00:00'),
  (19, 'user', '123123', '$2y$13$gIHiF3A0F85BiZJsUY0ZSuVhaCEuoY9j/9d.1StnElo1BfyygmiyC', 'IiGfMD7sySpVWoJ7k2IOak-bmD1XlrKQ', NULL, 'R6oTdoqwTTGKzVv7PYHYgkd3dJGy1pD5_1450019853', 'expert@mail.ru', 10, 1450019853, 1489592628, 'manager', 2, 'Иванов', 'Павел', 'Владимирович', '+79879878787', 2, NULL, NULL),
  (20, 'user2', '123123', '$2y$13$cHCKSyOlLnLCHfSNdwe6ZexbCswJfKih9RcuRV9lqgdYhyW7oZ/1S', 'ZVFefeFGwDG9C3_QUyULFWerDbvqM5oA', NULL, 'uk5DjMmRQCQjP-NTr6DQhMWd7VTVLJyC_1489592246', 'gudkova@mail.ru', 10, 1489592246, 1489592579, NULL, 2, 'Гудкова', 'Анна', 'Павловна', '+79885252233', 1, 1, '1992-02-15 00:00:00');

-- 
-- Вывод данных для таблицы folder
--
INSERT INTO folder VALUES 
  (1, 1, '2017-03-12 18:09:35', '01', 'Устав предприятия', 1),
  (2, 1, '2017-03-12 06:12:30', '02', 'Протоколы заседания совета директоров', 1),
  (3, 1, '2017-03-15 08:32:24', '03', 'Договоры', 19);

-- 
-- Вывод данных для таблицы document
--
INSERT INTO document VALUES 
  (1, 1, '2017-03-12 06:41:43', '01', 'Документ 1', 'Описание документа 1', 25, '', 1, 1, 1),
  (2, 1, '2017-03-13 09:26:12', '02', 'Документ 2', 'Описание документа 2', 30, '', 1, 1, 1);

-- 
-- Вывод данных для таблицы folder_access
--
INSERT INTO folder_access VALUES 
  (1, 1, NULL, NULL, 2, True, False, False);

-- 
-- Вывод данных для таблицы document_access
--
INSERT INTO document_access VALUES 
  (1, 1, NULL, NULL, 2, True, False, False);

-- 
-- Вывод данных для таблицы file
--
INSERT INTO file VALUES 
  (1, 1, '2017-03-12 07:38:21', '01', 'Файл 1', 'Composer-Setup.exe', 751448, 1),
  (2, 1, '2017-03-13 11:31:00', '02', 'Файл 2', 'Opera_NI_stable.exe', 718136, 1);

-- 
-- Вывод данных для таблицы file_access
--
INSERT INTO file_access VALUES 
  (1, 1, NULL, NULL, NULL, True, True, True);

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;