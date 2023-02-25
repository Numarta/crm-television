-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 29 2022 г., 20:28
-- Версия сервера: 5.7.35-38
-- Версия PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `numart_televidphp7`
--

-- --------------------------------------------------------

--
-- Структура таблицы `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `registration_date` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext,
  `id_document_type` int(11) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=16384 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `document`
--

INSERT INTO `document` (`id`, `registration_date`, `title`, `description`, `id_document_type`, `file_name`, `size`, `id_user`) VALUES
(1, '2022-05-28 18:08:12', '№0001 от 29.05.2022', 'Договор с ИП Петровым А.А., корпоративное ТВ, 1 шт.', 1, 'Koala.jpg', 780831, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `document_type`
--

CREATE TABLE `document_type` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=5461 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `document_type`
--

INSERT INTO `document_type` (`id`, `title`) VALUES
(1, 'Договор'),
(2, 'Приказ'),
(3, 'Накладная');

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `loading_date` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext,
  `file_name` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `check_sum` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=1170 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id`, `loading_date`, `title`, `description`, `file_name`, `size`, `height`, `width`, `check_sum`, `id_user`) VALUES
(42, '2022-05-29 22:03:40', 'Chrysanthemum.jpg', NULL, 'Chrysanthemum.jpg', 879394, 768, 1024, 1007558895, 1),
(43, '2022-05-29 22:03:40', 'Desert.jpg', NULL, 'Desert.jpg', 845941, 768, 1024, 519636876, 1),
(44, '2022-05-29 22:03:40', 'Hydrangeas.jpg', NULL, 'Hydrangeas.jpg', 595284, 768, 1024, -692888549, 1),
(45, '2022-05-29 22:03:40', 'Jellyfish.jpg', NULL, 'Jellyfish.jpg', 775702, 768, 1024, -1322760000, 1),
(46, '2022-05-29 22:03:40', 'Koala.jpg', NULL, 'Koala.jpg', 780831, 768, 1024, -1456094351, 1),
(47, '2022-05-29 22:03:40', 'Lighthouse.jpg', NULL, 'Lighthouse.jpg', 561276, 768, 1024, -406368630, 1),
(48, '2022-05-29 22:03:40', 'Penguins.jpg', NULL, 'Penguins.jpg', 777835, 768, 1024, 179623928, 1),
(49, '2022-05-29 22:03:40', 'Tulips.jpg', NULL, 'Tulips.jpg', 620888, 768, 1024, 138735869, 1),
(50, '2022-05-29 22:03:40', '1348038978-2084245-0282071_www.nevseoboi.com.ua.jpg', NULL, '1348038978-2084245-0282071_www.nevseoboi.com.ua.jpg', 2084245, 1600, 2560, -34482239, 1),
(51, '2022-05-29 22:03:40', '1353935340_savv-120.jpg', NULL, '1353935340_savv-120.jpg', 1155049, 1200, 1920, -1243562954, 1),
(52, '2022-05-29 22:03:40', 'c0e32595babcx.jpg', NULL, 'c0e32595babcx.jpg', 4122, 96, 96, 3307676, 1),
(53, '2022-05-29 22:03:40', '1.jpg', NULL, '1.jpg', 317056, 768, 1024, -398931761, 1),
(54, '2022-05-29 22:03:40', '2.jpg', NULL, '2.jpg', 193308, 768, 1024, -1348947425, 1),
(55, '2022-05-29 22:03:40', '3.jpg', NULL, '3.jpg', 113654, 768, 1024, -1829200977, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext,
  `cost` double DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `material`
--

INSERT INTO `material` (`id`, `title`, `description`, `cost`) VALUES
(1, 'Приставка', 'Цена указана за единицу товара', 1000),
(2, 'Кабель для подключения ТВ', 'Цена указана за 1 погонный метр оптоволокна', 670);

-- --------------------------------------------------------

--
-- Структура таблицы `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `registration_date` datetime DEFAULT NULL,
  `id_creator` int(11) DEFAULT NULL,
  `id_request_status` int(11) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `order_number` int(11) DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `description` longtext,
  `id_executor` int(11) DEFAULT NULL,
  `paid` bit(1) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=1820 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `request`
--

INSERT INTO `request` (`id`, `registration_date`, `id_creator`, `id_request_status`, `id_client`, `order_date`, `order_number`, `cost`, `description`, `id_executor`, `paid`) VALUES
(1, '2022-05-29 22:03:40', 20, 4, NULL, NULL, NULL, 5700, NULL, 1, b'1'),
(3, '2022-05-29 22:03:40', 20, 4, NULL, NULL, NULL, 380, NULL, 19, b'1'),
(4, '2022-05-29 22:03:40', 20, 4, NULL, NULL, NULL, 380, NULL, 19, b'1'),
(5, '2022-05-29 22:03:40', 20, 4, NULL, NULL, NULL, 380, NULL, 19, b'1'),
(6, '2022-05-29 22:03:40', 20, 4, NULL, NULL, NULL, 2180, NULL, 19, b'1'),
(8, '2022-05-29 22:03:40', 1, 1, NULL, NULL, NULL, 1120, NULL, NULL, NULL),
(9, '2022-05-29 22:03:40', 20, 4, NULL, NULL, NULL, 2860, NULL, 19, b'1'),
(10, '2022-05-29 22:03:40', 20, 2, NULL, NULL, NULL, 640, NULL, NULL, NULL),
(11, '2022-05-29 22:03:40', 20, 1, NULL, NULL, NULL, 14000, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `request_service`
--

CREATE TABLE `request_service` (
  `id` int(11) NOT NULL,
  `id_request` int(11) DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `id_service` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `description` longtext,
  `id_creator` int(11) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=1260 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `request_service`
--

INSERT INTO `request_service` (`id`, `id_request`, `registration_date`, `id_service`, `amount`, `cost`, `total`, `description`, `id_creator`) VALUES
(15, 3, '2022-05-29 22:03:40', 4, 1, 380, 380, NULL, 20),
(16, 4, '2022-05-29 22:03:40', 4, 1, 380, 380, NULL, 20),
(17, 5, '2022-05-29 22:03:40', 4, 1, 380, 380, NULL, 20),
(18, 6, '2022-05-29 22:03:40', 4, 5, 380, 1900, NULL, 20);

-- --------------------------------------------------------

--
-- Структура таблицы `request_status`
--

CREATE TABLE `request_status` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=4096 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `request_status`
--

INSERT INTO `request_status` (`id`, `title`) VALUES
(1, 'Заполняется'),
(2, 'Заполнен'),
(3, 'Выполняется'),
(4, 'Выполнен');

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `registration_date` datetime DEFAULT NULL,
  `description` longtext,
  `id_user` int(11) DEFAULT NULL,
  `id_review_status` int(11) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=2730 DEFAULT CHARSET=utf8 COMMENT='Отзыв';

--
-- Дамп данных таблицы `review`
--

INSERT INTO `review` (`id`, `registration_date`, `description`, `id_user`, `id_review_status`) VALUES
(1, '2022-05-28 09:07:52', 'Услуги высшего качества, цены приемлемые', 1, 4),
(2, '2022-05-28 09:28:38', 'Они всегда выполняют заказ быстро в нужные нам сроки. Качество хорошее, ЦТ четкое и по цене получается нормально. Работаем с ними уже более трех лет и довольные нашим сотрудничеством.', 20, 4),
(3, '2022-05-28 09:48:35', 'Спасибо вам огромное! Работаем уже не в первый раз! Довольны всем! Качеством, сроками, отношением, а что немаловажно - ценой. Спасибо! Коллектив Серпуховского музея.', 20, 4),
(4, '2022-05-28 10:07:41', 'Раз 10 уже наверное заходила сюда за услугами. Сделайте скидку постоянным клиентам, было бы супер).', 20, 1),
(5, '2022-05-28 10:08:43', 'Здесь заказывала услугу подключения ЦТ в офисе к новому году. Заказ был готов в оговоренное время, в нужном количестве. Качество связи отличное. Буду обращаться еще.', 20, 2),
(6, '2022-05-28 10:10:29', '\"Долго и плохо\" - вот девиз этой замечательной конторки. Хотите услуги плохого качество и неизвестно когда- тогда вам сюда. Отдельный респект директору. Более наплевательского отношения к клиентам я не встречал.', 20, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `review_status`
--

CREATE TABLE `review_status` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=4096 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `review_status`
--

INSERT INTO `review_status` (`id`, `title`) VALUES
(1, 'Создан'),
(2, 'Рассмотрен'),
(3, 'Отклонен'),
(4, 'Опубликован');

-- --------------------------------------------------------

--
-- Структура таблицы `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `description` longtext
) ENGINE=InnoDB AVG_ROW_LENGTH=655 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `service`
--

INSERT INTO `service` (`id`, `title`, `cost`, `description`) VALUES
(4, 'Цифровое ТВ 2.0', 1100, 'Цифровым называется телевидение, в котором видеоряд и звук передаются не просто с помощью модулированного ТВ-сигнала, а посредством набора импульсов, содержащих в себе закодированную информацию.\r\nЕго базовые отличия от аналогового:\r\nВысокая плотность сигнала.\r\nВ том диапазоне частот, где помещается один аналоговый телеканал, «цифра» может передать целый мультиплекс – набор из нескольких телевизионных каналов (конкретно в России передаются большей частью два федеральных мультиплекса по 10 каналов, плюс в некоторых местах возможно вещание третьего мультиплекса);\r\nКачество изображения и звука.\r\nАналоговый сигнал легко забивается помехами, закодированный же цифровой даже при довольно сильном шуме может быть за счёт алгоритмов декодирования восстановлен без потерь.\r\nЛегче переносит усиление.\r\nТам, где такие попытки для активной аналоговой антенны начинают гнать искажения, цифровой сигнал принимается точно. Однако есть и обратная сторона качества: даже зашумленный аналоговый сигнал еще несет какую-то информацию, цифровой же либо принимается идеально, либо не отображается вовсе. Из-за этого какие-то части передаваемых пакетами данных могут быть полностью утеряны. При попытке декодирующей программы восстановить информацию возможно застывание кадра (полное или частью), пропуски звуков.'),
(5, 'VIP-пакет TV', 1600, 'Цифровым называется телевидение, в котором видеоряд и звук передаются не просто с помощью модулированного ТВ-сигнала, а посредством набора импульсов, содержащих в себе закодированную информацию.\r\nЕго базовые отличия от аналогового:\r\nВысокая плотность сигнала.\r\nВ том диапазоне частот, где помещается один аналоговый телеканал, «цифра» может передать целый мультиплекс – набор из нескольких телевизионных каналов (конкретно в России передаются большей частью два федеральных мультиплекса по 10 каналов, плюс в некоторых местах возможно вещание третьего мультиплекса);\r\nКачество изображения и звука.\r\nАналоговый сигнал легко забивается помехами, закодированный же цифровой даже при довольно сильном шуме может быть за счёт алгоритмов декодирования восстановлен без потерь.\r\nЛегче переносит усиление.\r\nТам, где такие попытки для активной аналоговой антенны начинают гнать искажения, цифровой сигнал принимается точно. Однако есть и обратная сторона качества: даже зашумленный аналоговый сигнал еще несет какую-то информацию, цифровой же либо принимается идеально, либо не отображается вовсе. Из-за этого какие-то части передаваемых пакетами данных могут быть полностью утеряны. При попытке декодирующей программы восстановить информацию возможно застывание кадра (полное или частью), пропуски звуков.'),
(6, 'Цифровое ТВ - АКЦИЯ \"Жаркое лето с ТВ\"', 870, 'Цифровым называется телевидение, в котором видеоряд и звук передаются не просто с помощью модулированного ТВ-сигнала, а посредством набора импульсов, содержащих в себе закодированную информацию.\r\nЕго базовые отличия от аналогового:\r\nВысокая плотность сигнала.\r\nВ том диапазоне частот, где помещается один аналоговый телеканал, «цифра» может передать целый мультиплекс – набор из нескольких телевизионных каналов (конкретно в России передаются большей частью два федеральных мультиплекса по 10 каналов, плюс в некоторых местах возможно вещание третьего мультиплекса);\r\nКачество изображения и звука.\r\nАналоговый сигнал легко забивается помехами, закодированный же цифровой даже при довольно сильном шуме может быть за счёт алгоритмов декодирования восстановлен без потерь.\r\nЛегче переносит усиление.\r\nТам, где такие попытки для активной аналоговой антенны начинают гнать искажения, цифровой сигнал принимается точно. Однако есть и обратная сторона качества: даже зашумленный аналоговый сигнал еще несет какую-то информацию, цифровой же либо принимается идеально, либо не отображается вовсе. Из-за этого какие-то части передаваемых пакетами данных могут быть полностью утеряны. При попытке декодирующей программы восстановить информацию возможно застывание кадра (полное или частью), пропуски звуков.');

-- --------------------------------------------------------

--
-- Структура таблицы `service_image`
--

CREATE TABLE `service_image` (
  `id` int(11) NOT NULL,
  `id_service` int(11) DEFAULT NULL,
  `id_image` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext
) ENGINE=InnoDB AVG_ROW_LENGTH=2340 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `service_material`
--

CREATE TABLE `service_material` (
  `id` int(11) NOT NULL,
  `id_service` int(11) DEFAULT NULL,
  `id_material` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=4096 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
  `report_date_1` datetime DEFAULT NULL,
  `report_date_2` datetime DEFAULT NULL,
  `id_request` int(11) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=5461 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password_hash`, `auth_key`, `password_reset_token`, `activation_token`, `email`, `status`, `created_at`, `updated_at`, `nikname`, `id_user_type`, `last_name`, `first_name`, `middle_name`, `phone`, `report_date_1`, `report_date_2`, `id_request`) VALUES
(1, 'admin', '$2y$13$YAM7lquxh2TsGFtk6yp5auGcZMXozKSgGYzoMpUvaxCz7cBRLHgFy', 'uo3oaTjqwMPiAZugOmnx4Z9pvRWxRTbx', NULL, NULL, 'admin@mail.ru', 10, 1653855870, 1653855870, 'admin', 1, 'Зайцев', 'Алексей', 'Петрович', '+79232131323', '2022-05-29 22:03:40', '2022-05-29 22:03:40', NULL),
(19, 'manager', '$2y$13$YAM7lquxh2TsGFtk6yp5auGcZMXozKSgGYzoMpUvaxCz7cBRLHgFy', 'IiGfMD7sySpVWoJ7k2IOak-bmD1XlrKQ', NULL, 'R6oTdoqwTTGKzVv7PYHYgkd3dJGy1pD5_1450019853', 'manager@mail.ru', 10, 1653855870, 1653855870, 'manager', 2, 'Иванов', 'Павел', 'Владимирович', '+79879878787', NULL, NULL, NULL),
(20, 'client', '$2y$13$O/hxEESqBCVlGFaKcZoVPOzIUnpPsVAtpOBCEpXPGYeQ1KLOz7TCu', '1xQWuyjmRzE5Y1sF99SsrF8SCO5tvRWD', NULL, 'vcBBbljrP7HL9Mid1LFP4L7FEONa8Q0I_1479094384', 'gudkova.ann@mail.ru', 10, 1653855870, 1653855870, 'client', 3, 'Гудкова', 'Анна', 'Ивановна', '+79856544545', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=5461 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_type`
--

INSERT INTO `user_type` (`id`, `title`) VALUES
(1, 'Администратор'),
(2, 'Менеджер'),
(3, 'Клиент');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_document_document_type_id` (`id_document_type`),
  ADD KEY `FK_document_user_id` (`id_user`);

--
-- Индексы таблицы `document_type`
--
ALTER TABLE `document_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_request_client_id` (`id_client`),
  ADD KEY `FK_request_creator_id` (`id_creator`),
  ADD KEY `FK_request_executor_id` (`id_executor`),
  ADD KEY `FK_request_request_status_id` (`id_request_status`);

--
-- Индексы таблицы `request_service`
--
ALTER TABLE `request_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_request_service_request_id` (`id_request`),
  ADD KEY `FK_request_service_service_id` (`id_service`),
  ADD KEY `FK_request_service_user_id` (`id_creator`);

--
-- Индексы таблицы `request_status`
--
ALTER TABLE `request_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_review_review_status_id` (`id_review_status`),
  ADD KEY `FK_review_user_id` (`id_user`);

--
-- Индексы таблицы `review_status`
--
ALTER TABLE `review_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `service_image`
--
ALTER TABLE `service_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_service_image_image_id` (`id_image`),
  ADD KEY `FK_service_image_service_id` (`id_service`);

--
-- Индексы таблицы `service_material`
--
ALTER TABLE `service_material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_service_material_material_id` (`id_material`),
  ADD KEY `FK_service_material_service_id` (`id_service`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `FK_user_user_type_id` (`id_user_type`);

--
-- Индексы таблицы `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `document_type`
--
ALTER TABLE `document_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT для таблицы `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `request_service`
--
ALTER TABLE `request_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `request_status`
--
ALTER TABLE `request_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `review_status`
--
ALTER TABLE `review_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT для таблицы `service_image`
--
ALTER TABLE `service_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT для таблицы `service_material`
--
ALTER TABLE `service_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `FK_document_document_type_id` FOREIGN KEY (`id_document_type`) REFERENCES `document_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_document_user_id` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `FK_request_creator_id` FOREIGN KEY (`id_creator`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_request_executor_id` FOREIGN KEY (`id_executor`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_request_request_status_id` FOREIGN KEY (`id_request_status`) REFERENCES `request_status` (`id`);

--
-- Ограничения внешнего ключа таблицы `request_service`
--
ALTER TABLE `request_service`
  ADD CONSTRAINT `FK_request_service_request_id` FOREIGN KEY (`id_request`) REFERENCES `request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_request_service_service_id` FOREIGN KEY (`id_service`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_request_service_user_id` FOREIGN KEY (`id_creator`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK_review_review_status_id` FOREIGN KEY (`id_review_status`) REFERENCES `review_status` (`id`),
  ADD CONSTRAINT `FK_review_user_id` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `service_image`
--
ALTER TABLE `service_image`
  ADD CONSTRAINT `FK_service_image_image_id` FOREIGN KEY (`id_image`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_service_image_service_id` FOREIGN KEY (`id_service`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `service_material`
--
ALTER TABLE `service_material`
  ADD CONSTRAINT `FK_service_material_material_id` FOREIGN KEY (`id_material`) REFERENCES `material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_service_material_service_id` FOREIGN KEY (`id_service`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_user_type_id` FOREIGN KEY (`id_user_type`) REFERENCES `user_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
