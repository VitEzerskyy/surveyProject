-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 06 2017 г., 12:35
-- Версия сервера: 10.1.16-MariaDB
-- Версия PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `surveydb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `answer`
--

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `answer`
--

INSERT INTO `answer` (`id`, `question_id`, `answer`) VALUES
(63, 46, 'Choice 1'),
(64, 47, 'Choice 2'),
(65, 48, 'Choice 2'),
(66, 51, 'Choice 2'),
(67, 52, 'bla'),
(68, 46, 'Choice 2'),
(69, 47, 'Choice 1'),
(70, 48, 'Choice 1'),
(71, 51, 'Choice 4'),
(72, 52, 'bla'),
(73, 49, 'Choice 1'),
(74, 50, 'Choice 1'),
(75, 53, 'Choice 2'),
(76, 49, 'Choice 3'),
(77, 50, 'Choice 1'),
(78, 53, 'bla'),
(79, 54, 'Maybe'),
(80, 55, 'Choice 2'),
(81, 56, 'Yes'),
(82, 54, 'Yes'),
(83, 55, 'Choice 1'),
(84, 56, 'Yes'),
(85, 57, 'Choice 1'),
(86, 58, 'Maybe'),
(87, 59, 'bla'),
(88, 60, 'Rubbish'),
(89, 57, 'bla'),
(90, 58, 'Yesn'),
(91, 59, 'Choice 1'),
(92, 60, 'No'),
(93, 61, 'true'),
(94, 61, 'false'),
(95, 61, 'false');

-- --------------------------------------------------------

--
-- Структура таблицы `choice`
--

CREATE TABLE `choice` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `choice`
--

INSERT INTO `choice` (`id`, `question_id`, `name`) VALUES
(91, 46, 'Choice 1'),
(92, 46, 'Choice 2'),
(93, 46, 'Choice 3'),
(94, 47, 'Choice 1'),
(95, 47, 'Choice 2'),
(96, 47, 'Choice 3'),
(97, 48, 'Choice 1'),
(98, 48, 'Choice 2'),
(99, 48, 'Choice 3'),
(100, 49, 'Choice 1'),
(101, 49, 'Choice 2'),
(102, 49, 'Choice 3'),
(103, 50, 'Choice 1'),
(104, 50, 'Choice 2'),
(105, 50, 'Choice 3'),
(106, 51, 'Choice 1'),
(107, 51, 'Choice 2'),
(108, 51, 'Choice 3'),
(109, 51, 'Choice 4'),
(110, 52, 'Choice 1'),
(111, 52, 'Choice 2'),
(112, 53, 'Choice 1'),
(113, 53, 'Choice 2'),
(114, 53, 'Choice 3'),
(115, 54, 'Yes'),
(116, 54, 'NO'),
(117, 54, 'Maybe'),
(118, 55, 'Choice 1'),
(119, 55, 'Choice 2'),
(120, 55, 'Choice 3'),
(121, 56, 'Yes'),
(122, 56, 'No'),
(123, 57, 'Choice 1'),
(124, 57, 'Choice 2'),
(125, 57, 'Choice 3'),
(126, 58, 'Yesn'),
(127, 58, 'No'),
(128, 58, 'Maybe'),
(129, 59, 'Choice 1'),
(130, 59, 'Choice 2'),
(131, 59, 'Choice 3'),
(132, 60, 'No'),
(133, 60, 'Rubbish'),
(134, 60, 'Aga'),
(135, 61, 'true'),
(136, 61, 'false');

-- --------------------------------------------------------

--
-- Структура таблицы `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `question` longtext COLLATE utf8_unicode_ci NOT NULL,
  `published` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `question`
--

INSERT INTO `question` (`id`, `survey_id`, `question`, `published`) VALUES
(46, 16, 'Question 1', 1),
(47, 16, 'Question 2', 1),
(48, 16, 'Question 3', 1),
(49, 17, 'Question 1', 1),
(50, 17, 'Question 2', 1),
(51, 16, 'Question 4', 1),
(52, 16, 'Question 5', 1),
(53, 17, 'Question 3', 1),
(54, 18, 'Tru la la ?', 1),
(55, 18, 'Question N', 1),
(56, 18, 'Really?', 1),
(57, 19, 'Question 10', 1),
(58, 19, 'Question M', 1),
(59, 19, 'Question 3', 1),
(60, 19, 'Question about you', 1),
(61, 20, 'Test question', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `survey`
--

CREATE TABLE `survey` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `survey`
--

INSERT INTO `survey` (`id`, `title`, `published`, `created`) VALUES
(16, 'Survey 1', 1, '2017-06-06 10:32:46'),
(17, 'Survey 2', 1, '2017-06-06 10:32:54'),
(18, 'Survey 3', 1, '2017-06-06 10:33:03'),
(19, 'Survey 4', 1, '2017-06-06 12:20:24'),
(20, 'Survey 5', 1, '2017-06-06 12:20:41');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `password`, `username`) VALUES
(2, '$2a$08$jHZj/wJfcVKlIwr5AvR78euJxYK7Ku5kURNhNx.7.CSIJ3Pq6LEPC', 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DADD4A251E27F6BF` (`question_id`);

--
-- Индексы таблицы `choice`
--
ALTER TABLE `choice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C1AB5A921E27F6BF` (`question_id`);

--
-- Индексы таблицы `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B6F7494EB3FE509D` (`survey_id`);

--
-- Индексы таблицы `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT для таблицы `choice`
--
ALTER TABLE `choice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;
--
-- AUTO_INCREMENT для таблицы `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT для таблицы `survey`
--
ALTER TABLE `survey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `FK_DADD4A251E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `choice`
--
ALTER TABLE `choice`
  ADD CONSTRAINT `FK_C1AB5A921E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_B6F7494EB3FE509D` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
