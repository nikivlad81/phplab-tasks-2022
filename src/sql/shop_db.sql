-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Сен 03 2022 г., 20:27
-- Версия сервера: 8.0.25
-- Версия PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop_db`
--

-- --------------------------------------------------------

-- Schema shop_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `shop_db` DEFAULT CHARACTER SET utf8mb4 ;
USE `shop_db` ;

-- --------------------------------------------------------
--
-- Структура таблицы `client`
--

CREATE TABLE `client` (
  `id` int NOT NULL,
  `name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `phone` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `client`
--

INSERT INTO `client` (`id`, `name`, `last_name`, `phone`) VALUES
(1, 'Kenneth', 'Turner', 501167167),
(2, 'Lucille', 'Smith', 502283419),
(3, 'James', 'Long', 504163768),
(4, 'Leo', 'Warren', 503733400),
(5, 'Teresa', 'Douglas', 501733311),
(6, 'Elsie', 'Richards', 503008196),
(7, 'Melinda', 'Taylor', 501398983),
(8, 'Melanie', 'Hopkins', 505779776),
(9, 'Stephanie', 'Little', 505028145),
(10, 'Bessie', 'Brown', 504536502);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int NOT NULL,
  `client` int NOT NULL,
  `product` int NOT NULL,
  `count` int NOT NULL,
  `city` varchar(45) NOT NULL,
  `nova_poshta` int NOT NULL,
  `status` int NOT NULL,
  `manager` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `client`, `product`, `count`, `city`, `nova_poshta`, `status`, `manager`) VALUES
(1, 2, 3, 4, 'Kyiv', 144, 1, 4),
(2, 1, 2, 5, 'Kharkiv', 22, 2, 4),
(3, 3, 1, 10, 'Lviv', 32, 3, 4),
(4, 4, 4, 11, 'Odessa', 112, 4, 4),
(5, 5, 5, 2, 'Dnipro', 134, 1, 4),
(6, 6, 6, 5, 'Zhitomir', 245, 2, 4),
(7, 7, 7, 7, 'Vinnitsa', 322, 3, 4),
(8, 8, 1, 8, 'Chernihiv', 123, 4, 4),
(9, 9, 2, 25, 'Khmelnitsky', 71, 1, 4),
(10, 10, 3, 11, 'Zaporozhye', 89, 2, 4),
(11, 1, 4, 3, 'Poltava', 55, 3, 4),
(12, 2, 5, 2, 'Donetsk', 34, 4, 4),
(13, 3, 6, 32, 'Lugansk', 346, 1, 4),
(14, 4, 7, 4, 'Simferopol', 45, 2, 4),
(15, 5, 1, 7, 'Nikolaev', 18, 3, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`) VALUES
(1, 'Mars', 'Enim nulla aliquet porttitor lacus luctus accumsan tortor posuere ac ut consequat semper viverra nam libero justo laoreet sit amet cursus sit amet dictum sit amet justo donec enim diam', '137'),
(2, 'Snickers', 'Metus vulputate eu scelerisque felis imperdiet proin fermentum leo vel orci porta non pulvinar neque laoreet suspendisse interdum consectetur libero id faucibus nisl tincidunt eget nullam non nisi est sit', '171'),
(3, 'Milky Way', 'Risus nullam eget felis eget nunc lobortis mattis aliquam faucibus purus in massa tempor nec feugiat nisl pretium fusce id velit ut tortor pretium viverra suspendisse potenti nullam ac tortor', '30'),
(4, 'Twix', 'Viverra accumsan in nisl nisi scelerisque eu ultrices vitae auctor eu augue ut lectus arcu bibendum at varius vel pharetra vel turpis nunc eget lorem dolor sed viverra ipsum nunc', '112'),
(5, 'Bounty', 'Blandit libero volutpat sed cras ornare arcu dui vivamus arcu felis bibendum ut tristique et egestas quis ipsum suspendisse ultrices gravida dictum fusce ut placerat orci nulla pellentesque dignissim enim', '100'),
(6, 'M&M’s', 'Sapien et ligula ullamcorper malesuada proin libero nunc consequat interdum varius sit amet mattis vulputate enim nulla aliquet porttitor lacus luctus accumsan tortor posuere ac ut consequat semper viverra nam', '212'),
(7, 'Uncle Ben’s', 'Ultrices sagittis orci a scelerisque purus semper eget duis at tellus at urna condimentum mattis pellentesque id nibh tortor id aliquet lectus proin nibh nisl condimentum id venenatis a condimentum', '89');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `role` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(2, 'admin'),
(6, 'courier'),
(4, 'manager'),
(3, 'operator'),
(1, 'owner'),
(5, 'packer');

-- --------------------------------------------------------

--
-- Структура таблицы `staff`
--

CREATE TABLE `staff` (
  `id` int NOT NULL,
  `name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `staff`
--

INSERT INTO `staff` (`id`, `name`, `last_name`, `role`) VALUES
(1, 'Valentin', 'Kalash', 1),
(2, 'Masha', 'Kurchit', 2),
(3, 'Kirill', 'Statsuk', 3),
(4, 'Marina', 'Levina', 3),
(5, 'Nastya', 'Tarasova', 4),
(6, 'Tanya', 'Ivanova', 5),
(7, 'Sasha', 'Kolesnik', 5),
(8, 'Anna', 'Statsuk', 6),
(9, 'Ihor', 'Kulikov', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(4, 'Completed'),
(2, 'In processing'),
(1, 'New'),
(3, 'Sent');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_UNIQUE` (`phone`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_idx` (`client`),
  ADD KEY `product_idx` (`product`),
  ADD KEY `status_idx` (`status`),
  ADD KEY `manager_idx` (`manager`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_UNIQUE` (`role`);

--
-- Индексы таблицы `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_idx` (`role`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status_UNIQUE` (`status`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `client`
--
ALTER TABLE `client`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `client` FOREIGN KEY (`client`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manager` FOREIGN KEY (`manager`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status` FOREIGN KEY (`status`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `role` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
