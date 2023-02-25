-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 5.0.97.1
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 28.05.2022 17:14:25
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
USE base3399;

--
-- Описание для таблицы document_type
--
DROP TABLE IF EXISTS document_type;
CREATE TABLE document_type (
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
-- Описание для таблицы image
--
DROP TABLE IF EXISTS image;
CREATE TABLE image (
  id INT(11) NOT NULL AUTO_INCREMENT,
  loading_date DATETIME DEFAULT NULL,
  title VARCHAR(255) DEFAULT NULL,
  description LONGTEXT DEFAULT NULL,
  file_name VARCHAR(255) DEFAULT NULL,
  size INT(11) DEFAULT NULL,
  height INT(11) DEFAULT NULL,
  width INT(11) DEFAULT NULL,
  check_sum INT(11) DEFAULT NULL,
  id_user INT(11) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 56
AVG_ROW_LENGTH = 1170
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы material
--
DROP TABLE IF EXISTS material;
CREATE TABLE material (
  id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) DEFAULT NULL,
  description LONGTEXT DEFAULT NULL,
  cost DOUBLE DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы request_status
--
DROP TABLE IF EXISTS request_status;
CREATE TABLE request_status (
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
-- Описание для таблицы review_status
--
DROP TABLE IF EXISTS review_status;
CREATE TABLE review_status (
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
-- Описание для таблицы service
--
DROP TABLE IF EXISTS service;
CREATE TABLE service (
  id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) DEFAULT NULL,
  cost DOUBLE DEFAULT NULL,
  description LONGTEXT DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 91
AVG_ROW_LENGTH = 655
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
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы service_image
--
DROP TABLE IF EXISTS service_image;
CREATE TABLE service_image (
  id INT(11) NOT NULL AUTO_INCREMENT,
  id_service INT(11) DEFAULT NULL,
  id_image INT(11) DEFAULT NULL,
  title VARCHAR(255) DEFAULT NULL,
  description LONGTEXT DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT FK_service_image_image_id FOREIGN KEY (id_image)
    REFERENCES image(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_service_image_service_id FOREIGN KEY (id_service)
    REFERENCES service(id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AUTO_INCREMENT = 42
AVG_ROW_LENGTH = 2340
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы service_material
--
DROP TABLE IF EXISTS service_material;
CREATE TABLE service_material (
  id INT(11) NOT NULL AUTO_INCREMENT,
  id_service INT(11) DEFAULT NULL,
  id_material INT(11) DEFAULT NULL,
  amount DOUBLE DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT FK_service_material_material_id FOREIGN KEY (id_material)
    REFERENCES material(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_service_material_service_id FOREIGN KEY (id_service)
    REFERENCES service(id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AUTO_INCREMENT = 5
AVG_ROW_LENGTH = 4096
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы user
--
DROP TABLE IF EXISTS user;
CREATE TABLE user (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
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
  report_date_1 DATETIME DEFAULT NULL,
  report_date_2 DATETIME DEFAULT NULL,
  id_request INT(11) DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX email (email),
  UNIQUE INDEX password_reset_token (password_reset_token),
  UNIQUE INDEX username (username),
  CONSTRAINT FK_user_user_type_id FOREIGN KEY (id_user_type)
    REFERENCES user_type(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 21
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Описание для таблицы document
--
DROP TABLE IF EXISTS document;
CREATE TABLE document (
  id INT(11) NOT NULL AUTO_INCREMENT,
  registration_date DATETIME DEFAULT NULL,
  title VARCHAR(255) DEFAULT NULL,
  description LONGTEXT DEFAULT NULL,
  id_document_type INT(11) DEFAULT NULL,
  file_name VARCHAR(255) DEFAULT NULL,
  size INT(11) DEFAULT NULL,
  id_user INT(11) DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT FK_document_document_type_id FOREIGN KEY (id_document_type)
    REFERENCES document_type(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_document_user_id FOREIGN KEY (id_user)
    REFERENCES user(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 2
AVG_ROW_LENGTH = 16384
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы request
--
DROP TABLE IF EXISTS request;
CREATE TABLE request (
  id INT(11) NOT NULL AUTO_INCREMENT,
  registration_date DATETIME DEFAULT NULL,
  id_creator INT(11) DEFAULT NULL,
  id_request_status INT(11) DEFAULT NULL,
  id_client INT(11) DEFAULT NULL,
  order_date DATETIME DEFAULT NULL,
  order_number INT(11) DEFAULT NULL,
  cost DOUBLE DEFAULT NULL,
  description LONGTEXT DEFAULT NULL,
  id_executor INT(11) DEFAULT NULL,
  paid BIT(1) DEFAULT NULL,
  PRIMARY KEY (id),
  INDEX FK_request_client_id (id_client),
  CONSTRAINT FK_request_creator_id FOREIGN KEY (id_creator)
    REFERENCES user(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT FK_request_executor_id FOREIGN KEY (id_executor)
    REFERENCES user(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT FK_request_request_status_id FOREIGN KEY (id_request_status)
    REFERENCES request_status(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 12
AVG_ROW_LENGTH = 1820
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы review
--
DROP TABLE IF EXISTS review;
CREATE TABLE review (
  id INT(11) NOT NULL AUTO_INCREMENT,
  registration_date DATETIME DEFAULT NULL,
  description LONGTEXT DEFAULT NULL,
  id_user INT(11) DEFAULT NULL,
  id_review_status INT(11) DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT FK_review_review_status_id FOREIGN KEY (id_review_status)
    REFERENCES review_status(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT FK_review_user_id FOREIGN KEY (id_user)
    REFERENCES user(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 8
AVG_ROW_LENGTH = 2730
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Отзыв';

--
-- Описание для таблицы request_service
--
DROP TABLE IF EXISTS request_service;
CREATE TABLE request_service (
  id INT(11) NOT NULL AUTO_INCREMENT,
  id_request INT(11) DEFAULT NULL,
  registration_date DATETIME DEFAULT NULL,
  id_service INT(11) DEFAULT NULL,
  amount DOUBLE DEFAULT NULL,
  cost DOUBLE DEFAULT NULL,
  total DOUBLE DEFAULT NULL,
  description LONGTEXT DEFAULT NULL,
  id_creator INT(11) DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT FK_request_service_request_id FOREIGN KEY (id_request)
    REFERENCES request(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_request_service_service_id FOREIGN KEY (id_service)
    REFERENCES service(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_request_service_user_id FOREIGN KEY (id_creator)
    REFERENCES user(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 28
AVG_ROW_LENGTH = 1260
CHARACTER SET utf8
COLLATE utf8_general_ci;

-- 
-- Вывод данных для таблицы document_type
--
INSERT INTO document_type VALUES 
  (1, 'Договор'),
  (2, 'Приказ'),
  (3, 'Накладная');

-- 
-- Вывод данных для таблицы image
--
INSERT INTO image VALUES 
  (42, '2016-11-15 17:30:25', 'Chrysanthemum.jpg', NULL, 'Chrysanthemum.jpg', 879394, 768, 1024, 1007558895, 1),
  (43, '2016-11-15 17:30:25', 'Desert.jpg', NULL, 'Desert.jpg', 845941, 768, 1024, 519636876, 1),
  (44, '2016-11-15 17:30:25', 'Hydrangeas.jpg', NULL, 'Hydrangeas.jpg', 595284, 768, 1024, -692888549, 1),
  (45, '2016-11-15 17:30:25', 'Jellyfish.jpg', NULL, 'Jellyfish.jpg', 775702, 768, 1024, -1322760000, 1),
  (46, '2016-11-15 17:30:25', 'Koala.jpg', NULL, 'Koala.jpg', 780831, 768, 1024, -1456094351, 1),
  (47, '2016-11-15 17:30:25', 'Lighthouse.jpg', NULL, 'Lighthouse.jpg', 561276, 768, 1024, -406368630, 1),
  (48, '2016-11-15 17:30:26', 'Penguins.jpg', NULL, 'Penguins.jpg', 777835, 768, 1024, 179623928, 1),
  (49, '2016-11-15 17:30:26', 'Tulips.jpg', NULL, 'Tulips.jpg', 620888, 768, 1024, 138735869, 1),
  (50, '2016-11-15 17:39:14', '1348038978-2084245-0282071_www.nevseoboi.com.ua.jpg', NULL, '1348038978-2084245-0282071_www.nevseoboi.com.ua.jpg', 2084245, 1600, 2560, -34482239, 1),
  (51, '2016-11-15 17:39:14', '1353935340_savv-120.jpg', NULL, '1353935340_savv-120.jpg', 1155049, 1200, 1920, -1243562954, 1),
  (52, '2016-11-15 18:36:00', 'c0e32595babcx.jpg', NULL, 'c0e32595babcx.jpg', 4122, 96, 96, 3307676, 1),
  (53, '2016-11-15 18:43:28', '1.jpg', NULL, '1.jpg', 317056, 768, 1024, -398931761, 1),
  (54, '2016-11-15 18:43:28', '2.jpg', NULL, '2.jpg', 193308, 768, 1024, -1348947425, 1),
  (55, '2016-11-15 18:43:28', '3.jpg', NULL, '3.jpg', 113654, 768, 1024, -1829200977, 1);

-- 
-- Вывод данных для таблицы material
--
INSERT INTO material VALUES 
  (1, 'Бумага, формат А3', 'Цена указана за лист', 1.5),
  (2, 'Бумага, формат А4', 'Цена указана за лист', 0.5);

-- 
-- Вывод данных для таблицы request_status
--
INSERT INTO request_status VALUES 
  (1, 'Заполняется'),
  (2, 'Заполнен'),
  (3, 'Выполняется'),
  (4, 'Выполнен');

-- 
-- Вывод данных для таблицы review_status
--
INSERT INTO review_status VALUES 
  (1, 'Создан'),
  (2, 'Рассмотрен'),
  (3, 'Отклонен'),
  (4, 'Опубликован');

-- 
-- Вывод данных для таблицы service
--
INSERT INTO service VALUES 
  (4, 'Иллюстрированное пособие сварщика', 380, 'Иллюстрированное пособие сварщика-цветной альбом - формат А4, 56стр.,цвет, иллюстр.'),
  (5, 'Иллюстрированное пособие стропальщика', 290, 'Иллюстрированное пособие стропальщика-цветной альбом - формат А4, 36стр.,цвет, иллюстр.'),
  (6, 'Механизированная сварка плавящимся электродом в защитных газах', 290, 'Механизированная сварка плавящимся электродом в защитных газах пособие,72 стр.,цвет, иллюстр.'),
  (7, 'Выбор сварочного электрода', 290, 'Выбор сварочного электрода учебно-справочное пособие, 68стр.,цвет, иллюстр.'),
  (8, 'Ручная сварка трубопроводов пара и горячей воды', 260, 'Ручная сварка при сооружении и ремонте трубопроводов пара и горячей воды, 56стр.,цвет, иллюстр.'),
  (9, 'Ручная дуговая сварка не плавящимся электродом в защитных газах', 260, 'Ручная дуговая сварка не плавящимся электродом в защитных газах 48 стр..цвет, иллюстр.'),
  (10, 'Краткий курс безопасности-памятка для пользователей компьютеров', 120, 'Краткий курс безопасности-памятка для пользователей компьютеров,40 стр.'),
  (11, 'Знаки дорожного движения', 550, 'Знаки дорожного движения - 8 л.'),
  (12, 'Экстренная реанимация и первая медицинская помощь', 450, 'Экстренная реанимация и первая медицинская помощь - 6л.'),
  (13, 'Безопасность путевых работ (на железной дороге)', 450, 'Безопасность путевых работ (на железной дороге) - 6л.'),
  (14, 'Перевозка опасных грузов автотранспортом', 410, 'Перевозка опасных грузов автотранспортом - 5 л.'),
  (15, 'Безопасность труда при ремонте автомобилей', 410, 'Безопасность труда при ремонте автомобилей - 5 л.'),
  (16, 'Инструментальный контроль грузовых автомобилей - 5 л.', 410, 'Инструментальный контроль грузовых автомобилей - 5 л.'),
  (17, 'Проверка технического состояния автотранспортных средств - 5 л.', 410, 'Проверка технического состояния автотранспортных средств - 5 л.'),
  (18, 'Вождение автомобиля в сложных условиях - 5 л.', 410, 'Вождение автомобиля в сложных условиях - 5 л.'),
  (19, 'Безопасность труда при металлообработке - 5 л.', 410, 'Безопасность труда при металлообработке - 5 л.'),
  (20, 'Безопасность работ в сельском хозяйстве -5л.', 410, 'Безопасность работ в сельском хозяйстве -5л.'),
  (21, 'Безопасность труда при деревообработке - 5 л.', 410, 'Безопасность труда при деревообработке - 5 л.'),
  (22, 'Безопасная эксплуатация паровых котлов - 5 л.', 410, 'Безопасная эксплуатация паровых котлов - 5 л.'),
  (23, 'Техника безопасности при сварочных работах - 5 л.', 410, 'Техника безопасности при сварочных работах - 5 л.'),
  (24, 'Техника безопасности грузоподъёмных работ - 5 л.', 410, 'Техника безопасности грузоподъёмных работ - 5 л.'),
  (25, 'Первичные средства пожаротушения - 4 л.', 360, 'Первичные средства пожаротушения - 4 л.'),
  (26, 'Организация рабочего места газосварщика - 4 л.', 360, 'Организация рабочего места газосварщика - 4 л.'),
  (27, 'Безопасность работ на высоте 3 л.', 280, 'Безопасность работ на высоте 3 л.'),
  (28, 'Перевозка крупногабаритных и тяжеловесных грузов - 4 л.', 360, 'Перевозка крупногабаритных и тяжеловесных грузов - 4 л.'),
  (29, 'Безопасность труда на объектах водоснабжения и канализации - 4 л.', 360, 'Безопасность труда на объектах водоснабжения и канализации - 4 л.'),
  (30, 'Заземление и защитные меры электробезопасности ( напряж. 1000 В ) - 4 л.', 360, 'Заземление и защитные меры электробезопасности ( напряж. 1000 В ) - 4 л.'),
  (31, 'Знаки безопасности по ГОСТ 12.4.026-2001 - 4 л.', 360, 'Знаки безопасности по ГОСТ 12.4.026-2001 - 4 л.'),
  (32, 'Одноковшовый экскаватор. Безопасность земляных работ.-4 л.', 360, 'Одноковшовый экскаватор. Безопасность земляных работ.-4 л.'),
  (33, 'Безопасная эксплуатация газораспределительных пунктов,- 4л.', 360, 'Безопасная эксплуатация газораспределительных пунктов,- 4л.'),
  (34, 'Технические меры электробезопасности - 4л.', 360, 'Технические меры электробезопасности - 4л.'),
  (35, 'Безопасность работ в газовом хозяйстве - 4л.', 360, 'Безопасность работ в газовом хозяйстве - 4л.'),
  (36, 'Строповка и складирование грузов - 4 л.', 360, 'Строповка и складирование грузов - 4 л.'),
  (37, 'Пожарная безопасность -Зл.', 280, 'Пожарная безопасность -Зл.'),
  (38, 'Котлован. Ограждение мест работ - 3 л.', 280, 'Котлован. Ограждение мест работ - 3 л.'),
  (39, 'Безопасность изоляционных работ - 3 л.', 280, 'Безопасность изоляционных работ - 3 л.'),
  (40, 'Безопасность работ на АЗС - 3 л.', 280, 'Безопасность работ на АЗС - 3 л.'),
  (41, 'Электробезопасность при напряжении до 1000 В - 3 л.', 280, 'Электробезопасность при напряжении до 1000 В - 3 л.'),
  (42, 'Безопасность работ с автоподъемниками - 3 л.', 280, 'Безопасность работ с автоподъемниками - 3 л.'),
  (43, 'Аккумуляторные помещения - 3 л.', 280, 'Аккумуляторные помещения - 3 л.'),
  (44, 'Ручной слесарный инструмент - 3 л.', 280, 'Ручной слесарный инструмент - 3 л.'),
  (45, 'Газовые баллоны - 3 л.', 280, 'Газовые баллоны - 3 л.'),
  (46, 'Сосуды под давлением. Ресиверы - 3 л.', 280, 'Сосуды под давлением. Ресиверы - 3 л.'),
  (47, 'Прибор ОНК - 140 на автокранах - 3 л.', 280, 'Прибор ОНК - 140 на автокранах - 3 л.'),
  (48, 'Осторожно терроризм - 3 л.', 280, 'Осторожно терроризм - 3 л.'),
  (49, 'Сварные соединения и швы - Зл.', 280, 'Сварные соединения и швы - Зл.'),
  (50, 'Средства защиты в электроустановках - 3 л.', 280, 'Средства защиты в электроустановках - 3 л.'),
  (51, 'Безопасность работ на лесосеке (бензомоторная пила). 3 листа', 280, 'Безопасность работ на лесосеке (бензомоторная пила). 3 листа'),
  (52, 'Организация обеспечения электробезопасности. 3 листа', 280, 'Организация обеспечения электробезопасности. 3 листа'),
  (53, 'Признаки классификации сварочных швов - Зл.', 280, 'Признаки классификации сварочных швов - Зл.'),
  (54, 'Строительные леса (конструкции, монтаж, проверка на безопасность) - 3 л.', 280, 'Строительные леса (конструкции, монтаж, проверка на безопасность) - 3 л.'),
  (55, 'Физкультурная пауза - Зл.', 280, 'Физкультурная пауза - Зл.'),
  (56, 'Дуговая сварка покрытыми электродами - Зл.', 280, 'Дуговая сварка покрытыми электродами - Зл.'),
  (57, 'Безопасность работ на предприятиях общественного питания - 3 л.', 295, 'Безопасность работ на предприятиях общественного питания - 3 л.'),
  (58, 'Электроинструменты ( электробезопасность ) - 2 л.', 210, 'Электроинструменты ( электробезопасность ) - 2 л.'),
  (59, 'Сигналы светофоров - 2 л.', 210, 'Сигналы светофоров - 2 л.'),
  (60, 'Движение по железнодорожному переезду - 2 л.', 210, 'Движение по железнодорожному переезду - 2 л.'),
  (61, 'Безопасность работ с электропогрузчиками - 2 л.', 210, 'Безопасность работ с электропогрузчиками - 2 л.'),
  (62, 'Организация обучения безопасности труда. - 2 листа', 210, 'Организация обучения безопасности труда. - 2 листа'),
  (63, 'Строение и параметры сварочной дуги - 2 л.', 210, 'Строение и параметры сварочной дуги - 2 л.'),
  (64, 'Химическая безопасность. Хлор. - 2 л.', 210, 'Химическая безопасность. Хлор. - 2 л.'),
  (65, 'Правила установки автокранов - 2 л.', 210, 'Правила установки автокранов - 2 л.'),
  (66, 'Компьютер и безопасность - 2 л.', 210, 'Компьютер и безопасность - 2 л.'),
  (67, 'Дорожная разметка - 2 л.', 210, 'Дорожная разметка - 2 л.'),
  (68, 'Профилактика пожара на автотранспортных средствах - 2 л.', 210, 'Профилактика пожара на автотранспортных средствах - 2 л.'),
  (69, 'Расследование несчастных случаев на производстве - 2 л.', 210, 'Расследование несчастных случаев на производстве - 2 л.'),
  (70, 'Безопасность в авторемонтной мастерской. Шиномонтаж и шиноремонт -1 л.', 130, 'Безопасность в авторемонтной мастерской. Шиномонтаж и шиноремонт -1 л.'),
  (71, 'Безопасность в авторемонтной мастерской. Электромеханический подёмник -1 л.', 130, 'Безопасность в авторемонтной мастерской. Электромеханический подёмник -1 л.'),
  (72, 'Противопожарный инструктаж - 1 л.', 130, 'Противопожарный инструктаж - 1 л.'),
  (73, 'Обозначение сварных швов - 1 л.', 130, 'Обозначение сварных швов - 1 л.'),
  (74, '“Боевой расчет “ Добровольной пожарной дружины - липкая бумага', 130, '“Боевой расчет “ Добровольной пожарной дружины - липкая бумага'),
  (75, 'Детям о правилах пожарной безопасности - альбом из 10 листов АЗ', 290, 'Детям о правилах пожарной безопасности - альбом из 10 листов АЗ'),
  (76, 'Электротравматизм и первая доврачебная помощь - 32стр..цвет, иллюстр.', 100, 'Электротравматизм и первая доврачебная помощь - 32стр..цвет, иллюстр.'),
  (77, 'Практика безопасного труда. Работа с газовыми баллонами - 36стр..цвет, иллюстр.', 100, 'Практика безопасного труда. Работа с газовыми баллонами - 36стр..цвет, иллюстр.'),
  (78, 'Дефекты швов и соединений - пособие, 56стр..цвет, иллюстр.', 260, 'Дефекты швов и соединений - пособие, 56стр..цвет, иллюстр.'),
  (79, 'Детям о правилах дорожного движения - альбом из 10 листо', 280, 'Детям о правилах дорожного движения - альбом из 10 листо'),
  (80, 'Детям о Правилах Пожарной Безопасности - альбом из 10 листов', 280, 'Детям о Правилах Пожарной Безопасности - альбом из 10 листов'),
  (81, 'Плакат “ Берегите зрение “ (для пользователей ПК ) ( формат 330 х 460 мм.)', 110, 'Плакат “ Берегите зрение “ (для пользователей ПК ) ( формат 330 х 460 мм.)'),
  (82, 'Плакат “ Соблюдай скоростной режим “ ( формат 450 х 600 мм.)', 110, 'Плакат “ Соблюдай скоростной режим “ ( формат 450 х 600 мм.)'),
  (83, 'Плакат “ Надень защитную каску1'' ( формат 450 х 600 мм.)', 110, 'Плакат “ Надень защитную каску1'' ( формат 450 х 600 мм.)'),
  (84, 'Плакат “ Защитись от вращающихся деталей “ ( формат 450 х 600 мм.)', 110, 'Плакат “ Защитись от вращающихся деталей “ ( формат 450 х 600 мм.)'),
  (85, 'Плакат “Не стой под грузом” ( формат 450x600 мм )', 110, 'Плакат “Не стой под грузом” ( формат 450x600 мм )'),
  (86, 'Двух стороннее ламинирование, горячим способом 1 лист, размером (620x460) мм.', 40, 'Двух стороннее ламинирование, горячим способом 1 лист, размером (620x460) мм.'),
  (87, 'Плоттерная резка самоклеящейся пленки ПВХ за 1 мин.', 10, 'Плоттерная резка самоклеящейся пленки ПВХ за 1 мин.'),
  (88, 'Холодное ламинирование ширина до 1480мм за 1м.п.', 220, 'Холодное ламинирование ширина до 1480мм за 1м.п.'),
  (89, 'Цветная широкоформатная плоттерная печать на банерной ткани -1 м2', 1500, 'Цветная широкоформатная плоттерная печать на банерной ткани -1 м2'),
  (90, 'Печать на ткани (футболки, майки, спец. одежде и т.д.) через термопресс -1 см2', 0.6, 'Печать на ткани (футболки, майки, спец. одежде и т.д.) через термопресс -1 см2');

-- 
-- Вывод данных для таблицы user_type
--
INSERT INTO user_type VALUES 
  (1, 'Администратор'),
  (2, 'Менеджер'),
  (3, 'Клиент');

-- 
-- Вывод данных для таблицы service_image
--
INSERT INTO service_image VALUES 
  (25, 43, 42, 'Изображение 1', ''),
  (26, 43, 43, NULL, NULL),
  (27, 43, 44, NULL, NULL),
  (35, 7, 52, 'Изображение 1', ''),
  (36, 7, 53, NULL, NULL),
  (37, 7, 54, NULL, NULL),
  (38, 7, 55, NULL, NULL);

-- 
-- Вывод данных для таблицы service_material
--
INSERT INTO service_material VALUES 
  (1, 43, 1, 3),
  (2, 33, 1, 4),
  (3, 22, 1, 5),
  (4, 20, 1, 5);

-- 
-- Вывод данных для таблицы user
--
INSERT INTO user VALUES 
  (1, 'admin', '$2y$13$YAM7lquxh2TsGFtk6yp5auGcZMXozKSgGYzoMpUvaxCz7cBRLHgFy', 'uo3oaTjqwMPiAZugOmnx4Z9pvRWxRTbx', NULL, NULL, 'admin@mail.ru', 10, 1446794447, 1455210900, 'admin', 1, 'Зайцев', 'Алексей', 'Петрович', '+79232131323', '2015-02-07 00:00:00', '2016-07-15 00:00:00', NULL),
  (19, 'manager', '$2y$13$YAM7lquxh2TsGFtk6yp5auGcZMXozKSgGYzoMpUvaxCz7cBRLHgFy', 'IiGfMD7sySpVWoJ7k2IOak-bmD1XlrKQ', NULL, 'R6oTdoqwTTGKzVv7PYHYgkd3dJGy1pD5_1450019853', 'manager@mail.ru', 10, 1450019853, 1456165308, 'manager', 2, 'Иванов', 'Павел', 'Владимирович', '+79879878787', NULL, NULL, NULL),
  (20, 'client', '$2y$13$O/hxEESqBCVlGFaKcZoVPOzIUnpPsVAtpOBCEpXPGYeQ1KLOz7TCu', '1xQWuyjmRzE5Y1sF99SsrF8SCO5tvRWD', NULL, 'vcBBbljrP7HL9Mid1LFP4L7FEONa8Q0I_1479094384', 'gudkova.ann@mail.ru', 10, 1479094384, 1479094384, 'client', 3, 'Гудкова', 'Анна', 'Ивановна', '+79856544545', NULL, NULL, NULL);

-- 
-- Вывод данных для таблицы document
--
INSERT INTO document VALUES 
  (1, '2020-06-04 18:08:12', '№0001 от 01.06.2020', 'Договор с ИП Петровым А.А., печать буклета, 100 шт.', 1, 'Koala.jpg', 780831, 1);

-- 
-- Вывод данных для таблицы request
--
INSERT INTO request VALUES 
  (1, '2016-11-02 22:03:40', 20, 4, NULL, NULL, NULL, 5700, NULL, 1, True),
  (3, '2016-11-15 13:14:18', 20, 4, NULL, NULL, NULL, 380, NULL, 19, True),
  (4, '2016-11-15 14:28:24', 20, 4, NULL, NULL, NULL, 380, NULL, 19, True),
  (5, '2016-11-15 14:52:06', 20, 4, NULL, NULL, NULL, 380, NULL, 19, True),
  (6, '2016-11-15 14:52:30', 20, 4, NULL, NULL, NULL, 2180, NULL, 19, True),
  (8, '2016-11-15 16:39:20', 1, 1, NULL, NULL, NULL, 1120, NULL, NULL, NULL),
  (9, '2016-11-15 19:27:21', 20, 4, NULL, NULL, NULL, 2860, NULL, 19, True),
  (10, '2016-11-15 19:41:56', 20, 2, NULL, NULL, NULL, 640, NULL, NULL, NULL),
  (11, '2020-06-04 19:51:26', 20, 1, NULL, NULL, NULL, 14000, NULL, NULL, NULL);

-- 
-- Вывод данных для таблицы review
--
INSERT INTO review VALUES 
  (1, '2022-05-28 09:07:52', 'Услуги высшего качества, цены приемлемые', 1, 4),
  (2, '2022-05-28 09:28:38', 'Для маркировки нашей продукции заказываем у них цветные рулонные и полимерные самоклеющиеся этикетки с нанесением нашей информации. Они всегда выполняют заказ быстро в нужные нам сроки. Качество этикеток хорошее, печать четкая и по цене получается нормально. Работаем с ними уже более трех лет и довольные нашим сотрудничеством.', 20, 4),
  (3, '2022-05-28 09:48:35', 'Спасибо вам огромное! Работаем уже не в первый раз! Дважды делали блокноты разной сложности и перекидной календарь домик с кашированием на каппу. Довольны всем! Качеством, срокими, цветопередачей, а что немаловажно - ценой. Спасибо! Коллектив Серпуховского музея.', 20, 4),
  (4, '2022-05-28 10:07:41', 'Раз 10 уже наверное заходила сюда распечатывать фотографии. Делаю для дочки фотоальбомы на память на каждый месяц первого года жизни. Печатают качественно, на следующий день после заказа уже забираю, по деньгам недорого выходит. Сделайте скидку постоянным клиентам, было бы супер).', 20, 1),
  (5, '2022-05-28 10:08:43', 'В типографии заказывала открытки в фирменном стиле нашей компании к новому году. Тираж был готов в оговоренное время, в нужном количестве. Качество печати отличное. Буду обращаться еще.', 20, 2),
  (6, '2022-05-28 10:10:29', '"Долго и плохо" - вот девиз этой замечательной конторки. Хотите продукцию плохого качество и неизвестно когда- тогда вам сюда. Отдельный респект директору. Более наплевательского отношения к клиентам я не встречал.', 20, 3);

-- 
-- Вывод данных для таблицы request_service
--
INSERT INTO request_service VALUES 
  (15, 3, '2016-11-15 13:14:18', 4, 1, 380, 380, NULL, 20),
  (16, 4, '2016-11-15 14:28:24', 4, 1, 380, 380, NULL, 20),
  (17, 5, '2016-11-15 14:52:50', 4, 1, 380, 380, NULL, 20),
  (18, 6, '2016-11-15 15:09:11', 4, 5, 380, 1900, NULL, 20),
  (19, 6, '2016-11-15 15:11:37', 43, 1, 280, 280, NULL, 20),
  (20, 8, '2016-11-15 16:39:20', 43, 4, 280, 1120, NULL, 1),
  (21, 9, '2016-11-15 19:27:21', 43, 5, 280, 1400, NULL, 20),
  (22, 9, '2016-11-15 19:27:28', 33, 1, 360, 360, NULL, 20),
  (23, 9, '2016-11-15 19:27:33', 22, 2, 410, 820, NULL, 20),
  (24, 9, '2016-11-15 19:27:49', 51, 1, 280, 280, NULL, 20),
  (25, 10, '2016-11-15 19:41:56', 43, 1, 280, 280, NULL, 20),
  (26, 10, '2016-11-15 19:42:09', 33, 1, 360, 360, NULL, 20),
  (27, 11, '2020-06-04 19:51:26', 43, 50, 280, 14000, NULL, 20);

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;