-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Дек 20 2020 г., 09:49
-- Версия сервера: 8.0.22-0ubuntu0.20.04.3
-- Версия PHP: 7.4.3


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `librarytestex`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `id` int NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `surname` varchar(30) DEFAULT NULL,
  `patronymic` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- ССЫЛКИ ТАБЛИЦЫ `authors`:
--

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `name`, `surname`, `patronymic`) VALUES
(1, 'Александр', 'Стёпин', 'Вячеславович'),
(2, 'Григорий ', 'Репенко', 'Абрамович'),
(3, 'Павел', 'Юзов', 'Денисович'),
(4, 'Александр', 'Какорин', 'Степанович'),
(5, 'Степан', 'Левченко', 'Михаилович'),
(6, 'Богдан', 'Терентьев', 'Павлович'),
(7, 'Михаил', 'Терентьев', 'Павлович'),
(8, 'Степан', 'Гроздьев', 'Анатольевич'),
(9, 'Анатолий', 'Тодоренко', 'Валентинович'),
(10, 'Валентин', 'Степанов', 'Богданович'),
(11, 'Игорь', 'Лапенко', 'Игорьевич');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `available` smallint UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ССЫЛКИ ТАБЛИЦЫ `books`:
--

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `name`, `available`) VALUES
(1, 'Hello world!', 7),
(2, 'Super mario!', 10),
(3, 'How not to die', 1),
(4, 'Книга о том что ', 138),
(5, 'Хочу творить', 243),
(6, 'Гарри потёр', 129),
(7, 'Тут и там', 0),
(8, 'Я же сдал да?', 735),
(9, 'Лол. Кек', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `books&authors`
--

CREATE TABLE `books&authors` (
  `bookID` int NOT NULL,
  `authorID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ССЫЛКИ ТАБЛИЦЫ `books&authors`:
--   `bookID`
--       `books` -> `id`
--   `authorID`
--       `authors` -> `id`
--

--
-- Дамп данных таблицы `books&authors`
--

INSERT INTO `books&authors` (`bookID`, `authorID`) VALUES
(1, 1),
(5, 1),
(6, 1),
(8, 1),
(1, 2),
(5, 3),
(2, 4),
(1, 5),
(9, 5),
(2, 6),
(7, 6),
(3, 7),
(5, 7),
(9, 8),
(4, 9),
(7, 10),
(4, 11),
(9, 11);

-- --------------------------------------------------------

--
-- Структура таблицы `books&publishers`
--

CREATE TABLE `books&publishers` (
  `bookID` int NOT NULL,
  `publisherID` int NOT NULL,
  `year` smallint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ССЫЛКИ ТАБЛИЦЫ `books&publishers`:
--   `bookID`
--       `books` -> `id`
--   `publisherID`
--       `publishers` -> `id`
--

--
-- Дамп данных таблицы `books&publishers`
--

INSERT INTO `books&publishers` (`bookID`, `publisherID`, `year`) VALUES
(1, 1, 2001),
(1, 2, 2003),
(2, 3, 2007),
(3, 4, 2020),
(4, 2, 2019),
(4, 3, 2020),
(5, 4, 2020),
(6, 4, 2013),
(7, 2, 1998),
(8, 4, 2020),
(9, 1, 1983);

-- --------------------------------------------------------

--
-- Структура таблицы `givenBooks`
--

CREATE TABLE `givenBooks` (
  `actionID` int NOT NULL,
  `bookID` int NOT NULL,
  `studentID` int NOT NULL,
  `date` date NOT NULL DEFAULT '2020-12-18'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ССЫЛКИ ТАБЛИЦЫ `givenBooks`:
--   `bookID`
--       `books` -> `id`
--   `studentID`
--       `students` -> `id`
--

--
-- Дамп данных таблицы `givenBooks`
--

INSERT INTO `givenBooks` (`actionID`, `bookID`, `studentID`, `date`) VALUES
(1, 1, 1, '2021-11-30'),
(2, 1, 2, '2020-12-18'),
(3, 1, 18, '2020-12-18'),
(4, 2, 4, '2020-12-18'),
(5, 2, 6, '2020-12-18'),
(6, 2, 7, '2020-12-18'),
(7, 2, 14, '2020-12-18'),
(8, 3, 12, '2020-12-18'),
(9, 4, 1, '2020-12-18'),
(10, 4, 5, '2020-12-18'),
(11, 4, 13, '2020-12-18'),
(12, 5, 1, '2020-12-18'),
(13, 5, 10, '2020-12-18'),
(14, 5, 12, '2020-12-18'),
(15, 6, 4, '2020-12-18'),
(16, 6, 6, '2020-12-18'),
(17, 6, 9, '2020-12-18'),
(18, 6, 15, '2020-12-18'),
(19, 6, 18, '2020-12-18'),
(20, 8, 6, '2020-12-18'),
(21, 8, 7, '2020-12-18'),
(22, 8, 12, '2020-12-18'),
(23, 8, 14, '2020-12-18'),
(24, 8, 16, '2020-12-18'),
(25, 8, 17, '2020-12-18'),
(26, 8, 20, '2020-12-18'),
(27, 8, 21, '2020-12-18'),
(28, 8, 22, '2020-12-18'),
(29, 8, 23, '2020-12-18'),
(30, 6, 1, '2020-12-18'),
(32, 2, 15, '2020-12-18'),
(33, 6, 2, '2020-12-18'),
(35, 6, 22, '2020-12-18'),
(38, 2, 1, '1992-02-13'),
(51, 8, 1, '2020-12-18'),
(52, 3, 1, '2020-12-18'),
(60, 2, 8, '2020-12-18');

--
-- Триггеры `givenBooks`
--
DELIMITER $$
CREATE TRIGGER `books-available-decrease` AFTER INSERT ON `givenBooks` FOR EACH ROW UPDATE books SET books.available = books.available - 1 WHERE books.id = NEW.bookID
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `no-books-available` BEFORE INSERT ON `givenBooks` FOR EACH ROW IF (SELECT COUNT(*) FROM books WHERE books.id=new.bookID AND books.available<=0) <> 0 THEN SET new.date=null;
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `wrong-date-on-givenBooks-update` BEFORE UPDATE ON `givenBooks` FOR EACH ROW IF (SELECT COUNT(*) FROM returnedBooks WHERE returnedBooks.actionID=new.actionID AND returnedBooks.date < new.date) <> 0 THEN SET new.date=null;
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `publishers`
--

CREATE TABLE `publishers` (
  `id` int NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- ССЫЛКИ ТАБЛИЦЫ `publishers`:
--

--
-- Дамп данных таблицы `publishers`
--

INSERT INTO `publishers` (`id`, `name`) VALUES
(1, 'Abaddon Books'),
(2, 'Academic Press'),
(3, 'Adelita'),
(4, 'Allen & Unwin'),
(5, 'superpublisher');

-- --------------------------------------------------------

--
-- Структура таблицы `returnedBooks`
--

CREATE TABLE `returnedBooks` (
  `actionID` int NOT NULL,
  `date` date NOT NULL DEFAULT '2021-12-23'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- ССЫЛКИ ТАБЛИЦЫ `returnedBooks`:
--   `actionID`
--       `givenBooks` -> `actionID`
--

--
-- Дамп данных таблицы `returnedBooks`
--

INSERT INTO `returnedBooks` (`actionID`, `date`) VALUES
(1, '2021-12-23'),
(2, '2021-12-23'),
(3, '2021-12-23'),
(4, '2021-12-23'),
(5, '2021-12-23'),
(6, '2021-12-23'),
(7, '2021-12-23'),
(8, '2021-12-23'),
(9, '2021-12-23'),
(10, '2021-12-23'),
(11, '2021-12-23'),
(12, '2021-12-23'),
(13, '2021-12-23'),
(14, '2021-12-23'),
(15, '2021-12-23'),
(16, '2020-12-18'),
(17, '2020-12-20'),
(18, '2020-12-20');

--
-- Триггеры `returnedBooks`
--
DELIMITER $$
CREATE TRIGGER `books-available-increase` AFTER INSERT ON `returnedBooks` FOR EACH ROW UPDATE books JOIN givenBooks ON books.id=givenBooks.bookID JOIN returnedBooks ON returnedBooks.actionID=givenBooks.actionID SET books.available = books.available + 1 WHERE givenBooks.actionID = NEW.actionID
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `earlier-than-givenBooks-date` BEFORE INSERT ON `returnedBooks` FOR EACH ROW IF (SELECT COUNT(*) FROM givenBooks WHERE givenBooks.actionID=new.actionID AND givenBooks.date>new.date) <> 0 THEN SET new.date=null;
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `wrong-date-on-update` BEFORE UPDATE ON `returnedBooks` FOR EACH ROW IF (SELECT COUNT(*) FROM givenBooks WHERE givenBooks.actionID=new.actionID AND givenBooks.date>new.date) <> 0 THEN SET new.date=null;
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `patronymic` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- ССЫЛКИ ТАБЛИЦЫ `students`:
--

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `name`, `surname`, `patronymic`) VALUES
(1, 'Осинцев', 'Богдан ', 'Никонович'),
(2, 'Солдатов ', 'Фома ', 'Карлович'),
(3, ' Феликс ', 'Хоботилов', 'Мартьянович'),
(4, ' Валерьян', 'Шепкин', ' Владимирович'),
(5, 'Никон', ' Лукьянов', ' Никитевич'),
(6, 'Артем ', 'Кауфман ', 'Панкратиевич'),
(7, 'Венедикт', 'Фамусов ', ' Мартьянович'),
(8, 'Фаина ', 'Данилевна', 'Мухоморова '),
(9, 'Всеслав ', 'Бакаринцев ', 'Яковович'),
(10, ' Рубен ', 'Шибалкин', 'Миронович'),
(11, 'Николай ', 'Мандрыко ', 'Зиновиевич'),
(12, ' Роза ', 'Ябурова', 'Евгениевна'),
(13, ' Оксана ', 'Энгельгардта', 'Евгениевна'),
(14, ' Маргарита ', 'Яшвили', 'Андрияновна'),
(15, ' Инесса ', 'Смолина', 'Георгиевна'),
(16, ' Лаврентий ', 'Бугаков', 'Маркович'),
(17, ' Михаил ', 'Ковалёв', 'Викентиевич'),
(18, ' Агап ', 'Карпюк', 'Валерьянович'),
(19, ' Артур ', 'Мухоморов', 'Маркович'),
(20, ' Тимур ', 'Каржов', 'Игнатиевич'),
(21, ' Леонид ', 'Сафиюлин', 'Титович'),
(22, ' Лидия ', 'Гурьянова', 'Тихоновна'),
(23, ' Илья ', 'Пасхин', 'Андроникович');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `books&authors`
--
ALTER TABLE `books&authors`
  ADD PRIMARY KEY (`bookID`,`authorID`),
  ADD KEY `authorID` (`authorID`);

--
-- Индексы таблицы `books&publishers`
--
ALTER TABLE `books&publishers`
  ADD PRIMARY KEY (`bookID`,`publisherID`),
  ADD KEY `publisherID` (`publisherID`);

--
-- Индексы таблицы `givenBooks`
--
ALTER TABLE `givenBooks`
  ADD PRIMARY KEY (`actionID`),
  ADD UNIQUE KEY `bookIDstudentID` (`bookID`,`studentID`) USING BTREE,
  ADD KEY `studentID` (`studentID`);

--
-- Индексы таблицы `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `returnedBooks`
--
ALTER TABLE `returnedBooks`
  ADD KEY `returnedBooks_ibfk_1` (`actionID`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `givenBooks`
--
ALTER TABLE `givenBooks`
  MODIFY `actionID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT для таблицы `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `books&authors`
--
ALTER TABLE `books&authors`
  ADD CONSTRAINT `books&authors_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `books&authors_ibfk_2` FOREIGN KEY (`authorID`) REFERENCES `authors` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `books&publishers`
--
ALTER TABLE `books&publishers`
  ADD CONSTRAINT `books&publishers_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `books&publishers_ibfk_2` FOREIGN KEY (`publisherID`) REFERENCES `publishers` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `givenBooks`
--
ALTER TABLE `givenBooks`
  ADD CONSTRAINT `givenBooks_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `givenBooks_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `returnedBooks`
--
ALTER TABLE `returnedBooks`
  ADD CONSTRAINT `returnedBooks_ibfk_1` FOREIGN KEY (`actionID`) REFERENCES `givenBooks` (`actionID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
