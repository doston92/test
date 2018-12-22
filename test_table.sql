-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 22 2018 г., 08:35
-- Версия сервера: 5.7.23
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test_table`
--

-- --------------------------------------------------------

--
-- Структура таблицы `table_cat`
--

CREATE TABLE `table_cat` (
  `user_id` int(11) NOT NULL,
  `word_id` int(11) NOT NULL,
  `created_time` timestamp NOT NULL,
  `bal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `table_users`
--

CREATE TABLE `table_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(255) NOT NULL,
  `parol` varchar(32) NOT NULL,
  `ism` varchar(255) NOT NULL,
  `familiya` varchar(255) NOT NULL,
  `otchestvo` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'yoq',
  `jins` enum('Erkak','Ayol') NOT NULL,
  `authKey` varchar(255) DEFAULT NULL,
  `accessToken` varchar(255) DEFAULT NULL,
  `bal` int(10) UNSIGNED DEFAULT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('faol','nofaol') DEFAULT 'faol'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `table_users`
--

INSERT INTO `table_users` (`id`, `login`, `parol`, `ism`, `familiya`, `otchestvo`, `image`, `jins`, `authKey`, `accessToken`, `bal`, `created_time`, `status`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Doston', 'Usmonov', '...', 'papka/uzer/2018-21-00-12-15.jpg', 'Erkak', 'H4HXAnSui5cjnJEBrEEqvD-u6xCT3FCR', 'n4YeHzjrh_w5kMQXt9ThbvBjSIK03Dk7', NULL, '2018-12-20 19:15:25', 'faol');

-- --------------------------------------------------------

--
-- Структура таблицы `table_word`
--

CREATE TABLE `table_word` (
  `id` int(11) NOT NULL,
  `work` text NOT NULL,
  `word` varchar(255) DEFAULT NULL,
  `bal` int(11) NOT NULL DEFAULT '1',
  `view` int(11) NOT NULL DEFAULT '0',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('faol','nofaol') DEFAULT 'faol'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `table_word`
--

INSERT INTO `table_word` (`id`, `work`, `word`, `bal`, `view`, `created_time`, `status`) VALUES
(1, 'Assalomu alaykum. Siz saytimizga xush kelibsiz. Sizni saytimizda ko\'rganimizdan xursandmiz', 'alaykum,kelibsiz,xursand,kelib,sayt', 1, 0, '2018-12-21 07:58:07', 'faol');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `table_cat`
--
ALTER TABLE `table_cat`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `word_id` (`word_id`);

--
-- Индексы таблицы `table_users`
--
ALTER TABLE `table_users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `table_word`
--
ALTER TABLE `table_word`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `table_users`
--
ALTER TABLE `table_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `table_word`
--
ALTER TABLE `table_word`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
