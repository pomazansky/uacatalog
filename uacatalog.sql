-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 19 2015 г., 22:53
-- Версия сервера: 5.5.41-0ubuntu0.14.10.1
-- Версия PHP: 5.5.12-2ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `uacatalog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
`id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `blog`
--

INSERT INTO `blog` (`id`, `title`, `text`, `image`) VALUES
(1, 'Найстильніше україньке висілля 2015', 'На відміну від поширеної думки Lorem Ipsum не є випадковим набором літер. Він походить з уривку класичної латинської літератури 45 року до н.е., тобто має більш як 2000-річну історію. Річард Макклінток, професор латини з коледжу Хемпдін-Сидні, що у Вірджінії, вивчав одне з найменш зрозумілих латинських слів - consectetur - з уривку Lorem Ipsum, і у пошуку цього слова в класичній літературі знайшов безсумнівне джерело', 'blog_item_1.jpg'),
(2, 'Айдентика в націнальному стилі тепер у моді', 'На відміну від поширеної думки Lorem Ipsum не є випадковим набором літер. Він походить з уривку класичної латинської літератури 45 року до н.е., тобто має більш як 2000-річну історію. Річард Макклінток, професор латини з коледжу Хемпдін-Сидні, що у Вірджінії, вивчав одне з найменш зрозумілих латинських слів - consectetur - з уривку Lorem Ipsum, і у пошуку цього слова в класичній літературі знайшов безсумнівне джерело', 'blog_item_2.jpg'),
(3, 'Айдентика в націнальному стилі тепер у моді', 'На відміну від поширеної думки Lorem Ipsum не є випадковим набором літер. Він походить з уривку класичної латинської літератури 45 року до н.е., тобто має більш як 2000-річну історію. Річард Макклінток, професор латини з коледжу Хемпдін-Сидні, що у Вірджінії, вивчав одне з найменш зрозумілих латинських слів - consectetur - з уривку Lorem Ipsum, і у пошуку цього слова в класичній літературі знайшов безсумнівне джерело', 'blog_item_2.jpg'),
(4, 'Найстильніше україньке висілля 2015', 'На відміну від поширеної думки Lorem Ipsum не є випадковим набором літер. Він походить з уривку класичної латинської літератури 45 року до н.е., тобто має більш як 2000-річну історію. Річард Макклінток, професор латини з коледжу Хемпдін-Сидні, що у Вірджінії, вивчав одне з найменш зрозумілих латинських слів - consectetur - з уривку Lorem Ipsum, і у пошуку цього слова в класичній літературі знайшов безсумнівне джерело', 'blog_item_1.jpg'),
(5, 'Залиш свій слід', 'Існує багато варіацій уривків з Lorem Ipsum, але більшість з них зазнала певних змін на кшталт жартівливих вставок або змішування слів, які навіть не виглядають правдоподібно. Якщо ви збираєтесь використовувати Lorem Ipsum, ви маєте упевнитись в тому, що всередині тексту не приховано нічого, що могло б викликати у читача конфуз. Більшість відомих генераторів Lorem Ipsum в Мережі генерують текст', 'blog_item_3.jpg'),
(6, 'Парад фотоконкурсів в українському строї', 'Існує багато варіацій уривків з Lorem Ipsum, але більшість з них зазнала певних змін на кшталт жартівливих вставок або змішування слів, які навіть не виглядають правдоподібно. Якщо ви збираєтесь використовувати Lorem Ipsum, ви маєте упевнитись в тому, що всередині тексту не приховано нічого, що могло б викликати у читача конфуз. Більшість відомих генераторів Lorem Ipsum в Мережі генерують текст', 'blog_item_4.jpg'),
(7, 'Парад фотоконкурсів в українському строї', 'Існує багато варіацій уривків з Lorem Ipsum, але більшість з них зазнала певних змін на кшталт жартівливих вставок або змішування слів, які навіть не виглядають правдоподібно. Якщо ви збираєтесь використовувати Lorem Ipsum, ви маєте упевнитись в тому, що всередині тексту не приховано нічого, що могло б викликати у читача конфуз. Більшість відомих генераторів Lorem Ipsum в Мережі генерують текст', 'blog_item_4.jpg'),
(8, 'Залиш свій слід', 'Існує багато варіацій уривків з Lorem Ipsum, але більшість з них зазнала певних змін на кшталт жартівливих вставок або змішування слів, які навіть не виглядають правдоподібно. Якщо ви збираєтесь використовувати Lorem Ipsum, ви маєте упевнитись в тому, що всередині тексту не приховано нічого, що могло б викликати у читача конфуз. Більшість відомих генераторів Lorem Ipsum в Мережі генерують текст', 'blog_item_3.jpg'),
(9, 'У пошуках MADE IN UKRAINE', 'У лютому 2013 року пообіцяла, що буде рік купувати тільки товари українського виробництва і розповідати про всі знахідки читачам свого блогу. Пообіцяла і зробила. Продовжує агітувати за все якісне і модне українське тепер не тільки в блозі, але і в якості керівника окремого напрямку Made in Ukraine в Ekonomika Communication Hub', 'reviews_1.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `parent_id`) VALUES
(1, 'Одяг', NULL),
(2, 'Жіночий одяг', 1),
(3, 'Чоловічий одяг', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `manufacturer`
--

CREATE TABLE IF NOT EXISTS `manufacturer` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shops` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `name`, `url`, `shops`) VALUES
(1, 'Отаман', 'http://www.otaman.com.ua', '| «Отаман» Київ, вул. Михайлівська 21 А | «Отаман» Київ, вул.Грушевського, 28/2 |'),
(2, 'Grâce à vous', NULL, NULL),
(3, 'Cat Orange', NULL, NULL),
(4, 'Alve', NULL, NULL),
(5, 'Одежда с символикой Украины', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `description`, `image`, `category_id`, `manufacturer_id`) VALUES
(1, 'Вишиванка батистова з поясом', 3400, 'Вишиванка жіноча стилізована з машинною вишивкою темно-синього кольору.\n\nТканина - батист, склад - шовк 50 %, бавовна 50%.\n\nМашинна вишивка. Нитки - бавовняні.\n\nПланка та рукава оздобені машинною вишивкою контрастного кольору, в основі якої лежать орнаментальні геометричні елементи, що взяті з рушників Центральної України.\n\nБлуза виготовляється під замовлення. Термін виготовлення - до 15 днів.\n\nФормуй свою традицію з Отаман!', 'product_foto_1.jpg', 2, 1),
(2, 'Блуза "Гуцульська"', 1, '', 'otaman_1.jpg', 2, 1),
(3, 'Пояс шкіряний чорний', 1, '', 'otaman_2.jpg', 2, 1),
(4, 'Вишиванка батистова з молочною вишивкою', 1, '', 'otaman_3.jpg', 2, 1),
(5, 'Вишиванка рожева з ручною вишивкою', 1, '', 'otaman_4.jpg', 2, 1),
(6, 'Жупанчик зелений з поясом', 1, '', 'otaman_5.jpg', 2, 1),
(7, 'Жупан жаккардовий синій', 1, '', 'otaman_6.jpg', 2, 1),
(8, 'Жупан жаккардовий синій', 1, '', 'otaman_7.jpg', 3, 1),
(9, 'Платье на пуговицах', 1450, '', 'item_1.jpg', 2, 2),
(10, 'Блузка шифон', 850, '', 'item_2.jpg', 2, 3),
(11, 'Платья 886&103н', 890, '', 'item_3.jpg', 2, 4),
(12, 'Футболка женская PATRIOT', 230, '', 'item_4.jpg', 2, 5),
(13, 'Жупан короткий з відктритими швами', 6700, '', 'item_5.jpg', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(72) COLLATE utf8_unicode_ci NOT NULL,
  `roles` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `roles`) VALUES
(1, 'admin', '$2y$04$m1tcGnWvkwj7o1oqSSuv9egsK1WC9mIVqI5k/1PVDQrpto8hIrJeO', '| ROLE_ADMIN |');

-- --------------------------------------------------------

--
-- Структура таблицы `user_product`
--

CREATE TABLE IF NOT EXISTS `user_product` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user_product`
--

INSERT INTO `user_product` (`user_id`, `product_id`) VALUES
(1, 1),
(1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`id`), ADD KEY `product_fi_904832` (`category_id`), ADD KEY `product_fi_26eba6` (`manufacturer_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_product`
--
ALTER TABLE `user_product`
 ADD PRIMARY KEY (`user_id`,`product_id`), ADD KEY `user_product_fi_0f5ed8` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
ADD CONSTRAINT `product_fk_904832` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
ADD CONSTRAINT `product_fk_26eba6` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturer` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_product`
--
ALTER TABLE `user_product`
ADD CONSTRAINT `user_product_fk_29554a` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
ADD CONSTRAINT `user_product_fk_0f5ed8` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
