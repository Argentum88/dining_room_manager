-- phpMyAdmin SQL Dump
-- version 4.1.13
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 27 2014 г., 22:21
-- Версия сервера: 5.6.15
-- Версия PHP: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `dining_room_manager`
--

-- --------------------------------------------------------

--
-- Структура таблицы `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `item_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_type` (`item_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `item`
--

INSERT INTO `item` (`id`, `name`, `item_type_id`) VALUES
(1, 'Мимоза', 7),
(2, 'Салат из свиного фарша с рисовой лапшой', 8),
(3, 'Щи', 11);

-- --------------------------------------------------------

--
-- Структура таблицы `item_type`
--

CREATE TABLE IF NOT EXISTS `item_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `foreign_key01` (`parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `item_type`
--

INSERT INTO `item_type` (`id`, `name`, `parent`) VALUES
(6, 'Салаты', NULL),
(7, 'Холодные Салаты', 6),
(8, 'Горячие Салаты', 6),
(11, 'Супы', NULL),
(12, 'Гарниры', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` char(32) NOT NULL,
  `email` varchar(70) NOT NULL,
  `role` enum('user','cook') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `password`, `email`, `role`) VALUES
(1, '21232f297a57a5a743894a0e4a801fc3', 'andreyevpv@mail.ru', 'user'),
(2, 'e3e90fd6d2a7c4661a1a3acf2f60bc6d', 'cook@mail.ru', 'cook');

-- --------------------------------------------------------

--
-- Структура таблицы `user_item`
--

CREATE TABLE IF NOT EXISTS `user_item` (
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`item_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_item`
--

INSERT INTO `user_item` (`user_id`, `item_id`) VALUES
(2, 3);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_type` FOREIGN KEY (`item_type_id`) REFERENCES `item_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `item_type`
--
ALTER TABLE `item_type`
  ADD CONSTRAINT `item_type_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `item_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_item`
--
ALTER TABLE `user_item`
  ADD CONSTRAINT `item_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
