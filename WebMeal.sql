-- phpMyAdmin SQL Dump
-- version 4.6.5.1deb1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 09 2019 г., 16:16
-- Версия сервера: 5.6.28-1
-- Версия PHP: 7.0.22-2+ubuntu16.04.1+deb.sury.org+4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `WebMeal`
--

-- --------------------------------------------------------

--
-- Структура таблицы `wm_fields`
--

CREATE TABLE `wm_fields` (
  `_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `_rule` int(10) UNSIGNED NOT NULL,
  `parameters` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date_added` int(10) UNSIGNED NOT NULL,
  `_show_in_list` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `wm_fields`
--

INSERT INTO `wm_fields` (`_id`, `name`, `f_name`, `_rule`, `parameters`, `description`, `date_added`, `_show_in_list`) VALUES
(2, 'Заголовок', 'title', 6, '', 'Заголовок объекта (не более 255 символов)', 1504993347, 1),
(3, 'Анонс', 'announce', 8, '', 'Анонс объекта (текстовое описание)', 1504993458, 0),
(4, 'Контент (HTML)', 'html', 7, '', 'HTML-код объекта', 1504993485, 0),
(5, 'URL', 'url', 5, '', 'URL объекта', 1505000599, 1),
(6, 'Дата публикации', 'date', 9, '', 'Дата и время публикации объекта', 1505001687, 1),
(7, 'Координата (широта)', 'coord_lat', 1, '', '', 1505001822, 1),
(8, 'Координата (долгота)', 'coord_lng', 1, '', '', 1505001833, 1),
(9, 'Дата события', 'event_date', 9, '', 'Дата проведения события', 1505001927, 1),
(10, 'Примечания', 'notes', 10, '', '', 1505006073, 0),
(11, 'Секунда', 'tmp_second', 11, '', 'Тестовое поле range с параметрами', 1505031471, 1),
(12, 'Какой-то переключатель', 'test_switch', 15, '', 'Для теста', 1505043592, 0),
(13, 'Вы уверены?', 'test_switch_yes_no', 14, '', 'для теста', 1505043614, 0),
(14, 'Просто файл', 'file', 16, '', 'тестовый файл', 1505045566, 0),
(15, 'Выбор элемента из простейшего набора', 'sample_set', 19, '{&quot;set_id&quot;:&quot;5&quot;}', 'Выбор одного элемента из простейшего набора, проверка связи с сетами', 1505151086, 0),
(16, 'Множественный выбор элемента из простейшего набора', 'sample_multiply_set', 20, '{&quot;set_id&quot;:6}', 'Множественный выбор элемента из простейшего набора', 1505151125, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `wm_files`
--

CREATE TABLE `wm_files` (
  `_id` int(10) UNSIGNED NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `mime_type` varchar(255) NOT NULL,
  `str_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `wm_files`
--

INSERT INTO `wm_files` (`_id`, `original_name`, `mime_type`, `str_id`) VALUES
(1, 'fav.png', 'image/png', 'JBLsUWnW2o'),
(2, '14919693266_dcf70fbb1a_k.jpg', 'image/jpeg', 'DSCPlghx08'),
(3, 'putin.jpg', 'image/jpeg', 'GDACMfuai6'),
(4, 'tmp2.jpg', 'image/jpeg', 'H6rihQ8o7z');

-- --------------------------------------------------------

--
-- Структура таблицы `wm_items`
--

CREATE TABLE `wm_items` (
  `_id` int(10) UNSIGNED NOT NULL,
  `_set` int(10) UNSIGNED NOT NULL,
  `_disabled` int(11) NOT NULL DEFAULT '0',
  `date_added` int(10) UNSIGNED NOT NULL,
  `s_index` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `wm_items`
--

INSERT INTO `wm_items` (`_id`, `_set`, `_disabled`, `date_added`, `s_index`) VALUES
(1, 3, 0, 1505052159, 'some_url;Заголовок;анонс;10.09.2017, 20:00;11.09.2017, 12:00;12.123123168945312;32.31211853027344;Большой и &amp;lt;i style=&amp;quot;&amp;quot;&amp;gt;&amp;lt;font color=&amp;quot;#ff0000&amp;quot; style=&amp;quot;&amp;quot;&amp;gt;красивый&amp;lt;/font&amp;gt;&amp;lt;/i&amp;gt; текст в html&amp;#039;е.&amp;lt;div&amp;gt;Очень &amp;lt;font color=&amp;quot;#ff0000&amp;quot; style=&amp;quot;&amp;quot;&amp;gt;&amp;lt;i&amp;gt;красивый&amp;lt;/i&amp;gt;&amp;lt;/font&amp;gt;.&amp;lt;/div&amp;gt;;file;fav.png;image/png;JBLsUWnW2o;1;Тег 3;Тег 2;2;Заголовок 2;32.312101;12.1231;Анонс материала'),
(2, 3, 0, 1505052246, 'some_url2;Еще один заголовок;Анонс события;10.09.2017, 20:05;11.09.2017, 21:00;23.1321296;21.3211002;Еще &amp;lt;b&amp;gt;немного&amp;lt;/b&amp;gt; html&amp;#039;я;file;tmp2.jpg;image/jpeg;H6rihQ8o7z;0;'),
(3, 3, 0, 1505056921, 'url;Путин проголосовал на муниципальных выборах;Владимир Путин проголосовал на муниципальных выборах в Москве, а также рассказал журналистам, что изучал биографии кандидатов. &amp;quot;Выбор был осознанный&amp;quot;, - подчеркнул президент;10.09.2017, 18:45;10.09.2017, 18:45;55.71057;37.577561;&amp;lt;div&amp;gt;Владимир Путин поздоровался с сотрудниками участковой избирательной комиссии, предъявил паспорт и получил бюллетень, после чего зашел в кабинку для голосования. Через пару минут президент подошел к прозрачной пластиковой урне и опустил в нее бюллетень.&amp;lt;/div&amp;gt;&amp;lt;div&amp;gt;&amp;lt;br&amp;gt;&amp;lt;/div&amp;gt;&amp;lt;div&amp;gt;Глава государства сказал журналистам, что изучал биографии кандидатов заранее. Но отказался сообщить, за кого проголосовал: &amp;quot;Это же секретная информация&amp;quot;. По его словам, за ходом избирательной кампании он следил &amp;quot;не очень&amp;quot;. &amp;quot;А знаю откуда? Изучал биографии предварительно, перед тем, как прийти сюда. Выбор был осознанный&amp;quot;, - подчеркнул президент.&amp;lt;/div&amp;gt;&amp;lt;div&amp;gt;&amp;lt;br&amp;gt;&amp;lt;/div&amp;gt;&amp;lt;div&amp;gt;От Путина не укрылась невысокая явка, но он сказал, что раз журналистов много, это &amp;quot;тоже неплохо, интерес прессы к муниципальным выборам тоже важен&amp;quot;. А жители &amp;quot;придут еще, еще не вечер&amp;quot;, уверен он. Ко времени появления главы государства на участке там проголосовали чуть более 100 человек.&amp;lt;/div&amp;gt;&amp;lt;div&amp;gt;&amp;lt;br&amp;gt;&amp;lt;/div&amp;gt;&amp;lt;div&amp;gt;Можно было выбрать от одного до трех депутатов из 18 предложенных кандидатур. В списке - три самовыдвиженца, представители &amp;quot;Единой России&amp;quot;, КПРФ, &amp;quot;Яблока&amp;quot;, &amp;quot;Родины&amp;quot;, &amp;quot;Справедливой России&amp;quot; и Партии роста.&amp;lt;/div&amp;gt;&amp;lt;div&amp;gt;&amp;lt;br&amp;gt;&amp;lt;/div&amp;gt;&amp;lt;div&amp;gt;В Единый день голосования выборы проходят в 82 регионах, в нескольких из них будут избраны губернаторы и депутаты заксобраний.&amp;lt;/div&amp;gt;&amp;lt;div&amp;gt;&amp;lt;br&amp;gt;&amp;lt;/div&amp;gt;&amp;lt;div&amp;gt;На выходе главу государства окружили журналисты. Удалось поговорить с президентом и кубинским корреспондентам. Россия готова оказать помощь острову в ликвидации последствий урагана, успокоил их президент. &amp;quot;Да, мы готовы. Глава МЧС вам уже предложил свою помощь. Готовы&amp;quot;, - сказал Путин. Ураган &amp;quot;Ирма&amp;quot; продолжает продвигаться над северным побережьем Кубы.&amp;lt;/div&amp;gt;;Array;1;'),
(4, 2, 0, 1505057869, '10.09.2017, 21:37;news1;Тестовая новость;Анонс тестовой новости;8;Текст тестовой новости;0'),
(5, 5, 0, 1505059880, '1;Заголовок 1;12.123120307922363;31.123119354248047;Анонс материала'),
(6, 5, 0, 1505059903, '2;Заголовок 2;32.312101;12.1231;Анонс материала'),
(8, 6, 0, 1505155093, 'Тег 1'),
(9, 6, 0, 1505155098, 'Тег 2'),
(10, 6, 0, 1505155103, 'Тег 3'),
(11, 2, 0, 1505292185, '13.09.2017, 15:00;ttt;Заголовок новости;Красивый анонс тестовой новости;30;Контент в формате html.;1');

-- --------------------------------------------------------

--
-- Структура таблицы `wm_items_data`
--

CREATE TABLE `wm_items_data` (
  `_id` int(10) UNSIGNED NOT NULL,
  `_item` int(10) UNSIGNED NOT NULL,
  `_set` int(10) UNSIGNED NOT NULL,
  `_field` int(10) UNSIGNED NOT NULL,
  `val_int` int(10) UNSIGNED DEFAULT NULL,
  `val_float` double DEFAULT NULL,
  `val_string` varchar(255) NOT NULL,
  `val_text` text NOT NULL,
  `val_file` varchar(255) NOT NULL,
  `val_bool` tinyint(1) DEFAULT NULL,
  `date_added` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `wm_items_data`
--

INSERT INTO `wm_items_data` (`_id`, `_item`, `_set`, `_field`, `val_int`, `val_float`, `val_string`, `val_text`, `val_file`, `val_bool`, `date_added`) VALUES
(1, 1, 3, 5, NULL, NULL, 'some_url', '', '', NULL, 1505052159),
(2, 1, 3, 2, NULL, NULL, 'Заголовок', '', '', NULL, 1505052159),
(3, 1, 3, 3, NULL, NULL, '', 'анонс', '', NULL, 1505052159),
(4, 1, 3, 6, 1505062800, NULL, '', '', '', NULL, 1505052159),
(5, 1, 3, 9, 1505120400, NULL, '', '', '', NULL, 1505052159),
(6, 1, 3, 7, NULL, 12.123123168945312, '', '', '', NULL, 1505052159),
(7, 1, 3, 8, NULL, 32.31211853027344, '', '', '', NULL, 1505052159),
(8, 1, 3, 4, NULL, NULL, '', 'Большой и &lt;i style=&quot;&quot;&gt;&lt;font color=&quot;#ff0000&quot; style=&quot;&quot;&gt;красивый&lt;/font&gt;&lt;/i&gt; текст в html&#039;е.&lt;div&gt;Очень &lt;font color=&quot;#ff0000&quot; style=&quot;&quot;&gt;&lt;i&gt;красивый&lt;/i&gt;&lt;/font&gt;.&lt;/div&gt;', '', NULL, 1505052159),
(9, 1, 3, 14, NULL, NULL, '', '', '1', NULL, 1505052159),
(10, 1, 3, 13, NULL, NULL, '', '', '', 1, 1505052160),
(11, 2, 3, 5, NULL, NULL, 'some_url2', '', '', NULL, 1505052246),
(12, 2, 3, 2, NULL, NULL, 'Еще один заголовок', '', '', NULL, 1505052246),
(13, 2, 3, 3, NULL, NULL, '', 'Анонс события', '', NULL, 1505052246),
(14, 2, 3, 6, 1505063100, NULL, '', '', '', NULL, 1505052246),
(15, 2, 3, 9, 1505152800, NULL, '', '', '', NULL, 1505052246),
(16, 2, 3, 7, NULL, 23.1321296, '', '', '', NULL, 1505052247),
(17, 2, 3, 8, NULL, 21.3211002, '', '', '', NULL, 1505052247),
(18, 2, 3, 4, NULL, NULL, '', 'Еще &lt;b&gt;немного&lt;/b&gt; html&#039;я', '', NULL, 1505052247),
(19, 2, 3, 14, NULL, NULL, '', '', '4', NULL, 1505052247),
(20, 2, 3, 13, NULL, NULL, '', '', '', 0, 1505052247),
(21, 3, 3, 5, NULL, NULL, 'url', '', '', NULL, 1505056921),
(22, 3, 3, 2, NULL, NULL, 'Путин проголосовал на муниципальных выборах', '', '', NULL, 1505056921),
(23, 3, 3, 3, NULL, NULL, '', 'Владимир Путин проголосовал на муниципальных выборах в Москве, а также рассказал журналистам, что изучал биографии кандидатов. &quot;Выбор был осознанный&quot;, - подчеркнул президент', '', NULL, 1505056921),
(24, 3, 3, 6, 1505058300, NULL, '', '', '', NULL, 1505056921),
(25, 3, 3, 9, 1505058300, NULL, '', '', '', NULL, 1505056921),
(26, 3, 3, 7, NULL, 55.71057, '', '', '', NULL, 1505056921),
(27, 3, 3, 8, NULL, 37.577561, '', '', '', NULL, 1505056921),
(28, 3, 3, 4, NULL, NULL, '', '&lt;div&gt;Владимир Путин поздоровался с сотрудниками участковой избирательной комиссии, предъявил паспорт и получил бюллетень, после чего зашел в кабинку для голосования. Через пару минут президент подошел к прозрачной пластиковой урне и опустил в нее бюллетень.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Глава государства сказал журналистам, что изучал биографии кандидатов заранее. Но отказался сообщить, за кого проголосовал: &quot;Это же секретная информация&quot;. По его словам, за ходом избирательной кампании он следил &quot;не очень&quot;. &quot;А знаю откуда? Изучал биографии предварительно, перед тем, как прийти сюда. Выбор был осознанный&quot;, - подчеркнул президент.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;От Путина не укрылась невысокая явка, но он сказал, что раз журналистов много, это &quot;тоже неплохо, интерес прессы к муниципальным выборам тоже важен&quot;. А жители &quot;придут еще, еще не вечер&quot;, уверен он. Ко времени появления главы государства на участке там проголосовали чуть более 100 человек.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Можно было выбрать от одного до трех депутатов из 18 предложенных кандидатур. В списке - три самовыдвиженца, представители &quot;Единой России&quot;, КПРФ, &quot;Яблока&quot;, &quot;Родины&quot;, &quot;Справедливой России&quot; и Партии роста.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;В Единый день голосования выборы проходят в 82 регионах, в нескольких из них будут избраны губернаторы и депутаты заксобраний.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;На выходе главу государства окружили журналисты. Удалось поговорить с президентом и кубинским корреспондентам. Россия готова оказать помощь острову в ликвидации последствий урагана, успокоил их президент. &quot;Да, мы готовы. Глава МЧС вам уже предложил свою помощь. Готовы&quot;, - сказал Путин. Ураган &quot;Ирма&quot; продолжает продвигаться над северным побережьем Кубы.&lt;/div&gt;', '', NULL, 1505056921),
(29, 3, 3, 14, NULL, NULL, '', '', '3', NULL, 1505056921),
(30, 3, 3, 13, NULL, NULL, '', '', '', 1, 1505056921),
(31, 4, 2, 6, 1505068620, NULL, '', '', '', NULL, 1505057869),
(32, 4, 2, 5, NULL, NULL, 'news1', '', '', NULL, 1505057869),
(33, 4, 2, 2, NULL, NULL, 'Тестовая новость', '', '', NULL, 1505057869),
(34, 4, 2, 3, NULL, NULL, '', 'Анонс тестовой новости', '', NULL, 1505057869),
(35, 4, 2, 11, 8, NULL, '', '', '', NULL, 1505057869),
(36, 4, 2, 4, NULL, NULL, '', 'Текст тестовой новости', '', NULL, 1505057869),
(37, 4, 2, 12, NULL, NULL, '', '', '', 0, 1505057869),
(38, 5, 5, 5, NULL, NULL, '1', '', '', NULL, 1505059880),
(39, 5, 5, 2, NULL, NULL, 'Заголовок 1', '', '', NULL, 1505059880),
(40, 5, 5, 8, NULL, 12.123120307922363, '', '', '', NULL, 1505059880),
(41, 5, 5, 7, NULL, 31.123119354248047, '', '', '', NULL, 1505059880),
(42, 5, 5, 3, NULL, NULL, '', 'Анонс материала', '', NULL, 1505059880),
(43, 6, 5, 5, NULL, NULL, '2', '', '', NULL, 1505059903),
(44, 6, 5, 2, NULL, NULL, 'Заголовок 2', '', '', NULL, 1505059904),
(45, 6, 5, 8, NULL, 32.312101, '', '', '', NULL, 1505059904),
(46, 6, 5, 7, NULL, 12.1231, '', '', '', NULL, 1505059904),
(47, 6, 5, 3, NULL, NULL, '', 'Анонс материала', '', NULL, 1505059904),
(63, 1, 3, 16, NULL, NULL, '10,9', '', '', NULL, 1505154687),
(64, 1, 3, 15, 6, NULL, '', '', '', NULL, 1505154687),
(65, 8, 6, 2, NULL, NULL, 'Тег 1', '', '', NULL, 1505155093),
(66, 9, 6, 2, NULL, NULL, 'Тег 2', '', '', NULL, 1505155098),
(67, 10, 6, 2, NULL, NULL, 'Тег 3', '', '', NULL, 1505155103),
(68, 3, 3, 15, 0, NULL, '', '', '', NULL, 1505221273),
(69, 2, 3, 15, 0, NULL, '', '', '', NULL, 1505221714),
(70, 11, 2, 6, 1505304017, NULL, '', '', '', NULL, 1505292185),
(71, 11, 2, 5, NULL, NULL, 'ttt', '', '', NULL, 1505292185),
(72, 11, 2, 2, NULL, NULL, 'Заголовок новости', '', '', NULL, 1505292185),
(73, 11, 2, 3, NULL, NULL, '', 'Красивый анонс тестовой новости', '', NULL, 1505292185),
(74, 11, 2, 11, 30, NULL, '', '', '', NULL, 1505292185),
(75, 11, 2, 4, NULL, NULL, '', 'Контент в формате html.', '', NULL, 1505292185),
(76, 11, 2, 12, NULL, NULL, '', '', '', 1, 1505292185);

-- --------------------------------------------------------

--
-- Структура таблицы `wm_links_templates_fields`
--

CREATE TABLE `wm_links_templates_fields` (
  `_id` int(10) UNSIGNED NOT NULL,
  `_template` int(10) UNSIGNED NOT NULL,
  `_field` int(10) UNSIGNED NOT NULL,
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `date_added` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `wm_links_templates_fields`
--

INSERT INTO `wm_links_templates_fields` (`_id`, `_template`, `_field`, `position`, `date_added`) VALUES
(58, 2, 6, 0, 1505043679),
(59, 2, 5, 1, 1505043679),
(60, 2, 2, 2, 1505043679),
(61, 2, 3, 3, 1505043679),
(62, 2, 11, 4, 1505043679),
(63, 2, 4, 5, 1505043679),
(64, 2, 12, 6, 1505043679),
(75, 4, 5, 0, 1505059534),
(76, 4, 2, 1, 1505059534),
(77, 4, 8, 2, 1505059534),
(78, 4, 7, 3, 1505059534),
(79, 4, 3, 4, 1505059534),
(92, 3, 5, 0, 1505151176),
(93, 3, 2, 1, 1505151176),
(94, 3, 3, 2, 1505151176),
(95, 3, 6, 3, 1505151176),
(96, 3, 9, 4, 1505151176),
(97, 3, 7, 5, 1505151176),
(98, 3, 8, 6, 1505151176),
(99, 3, 4, 7, 1505151176),
(100, 3, 14, 8, 1505151176),
(101, 3, 16, 9, 1505151176),
(102, 3, 15, 10, 1505151176),
(103, 5, 2, 0, 1505155078);

-- --------------------------------------------------------

--
-- Структура таблицы `wm_rules`
--

CREATE TABLE `wm_rules` (
  `_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `_type` int(10) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `date_added` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `wm_rules`
--

INSERT INTO `wm_rules` (`_id`, `name`, `_type`, `data`, `date_added`) VALUES
(1, 'Координата', 3, '', 1504992797),
(5, 'URL', 1, '', 1504993053),
(6, 'Строка', 1, '', 1504993090),
(7, 'HTML', 4, '{&quot;type&quot;:&quot;wysiwyg&quot;}', 1504993156),
(8, 'Текст', 4, '', 1504993433),
(9, 'Дата', 2, '{&quot;type&quot;:&quot;datetime&quot;}', 1505001495),
(10, 'Кастомное текстовое поле', 4, '', 1505006021),
(11, 'Число в пределах 0 - 60', 2, '{&quot;type&quot;:&quot;range&quot;,&quot;min&quot;:&quot;0&quot;,&quot;max&quot;:&quot;60&quot;,&quot;step&quot;:&quot;1&quot;}', 1505031081),
(14, 'Переключатель Да/Нет', 6, '{&quot;positive_value&quot;:&quot;Да&quot;, &quot;negative_value&quot;:&quot;Нет&quot;}', 1505043552),
(15, 'Переключатель без обозначений', 6, '', 1505043568),
(16, 'Любой файл', 7, '', 1505045547),
(19, 'Set', 2, '{&quot;type&quot;:&quot;set&quot;}', 1505150426),
(20, 'Multiply set', 1, '{&quot;type&quot;:&quot;multiply_set&quot;}', 1505150452);

-- --------------------------------------------------------

--
-- Структура таблицы `wm_sets`
--

CREATE TABLE `wm_sets` (
  `_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `_template` int(10) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `sort_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `sort_order` varchar(5) NOT NULL DEFAULT 'desc',
  `date_added` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `wm_sets`
--

INSERT INTO `wm_sets` (`_id`, `name`, `f_name`, `_template`, `description`, `sort_by`, `sort_order`, `date_added`) VALUES
(2, 'Новости', 'news', 2, 'Тестовый проект &quot;Новости&quot;', 0, 'desc', 1505000968),
(3, 'События', 'events', 3, 'Сет событий', 6, 'desc', 1505001979),
(5, 'Простейший набор', 'sample', 4, 'Просто набор для тестирования, без излишеств', 2, 'desc', 1505059464),
(6, 'Теги', 'sample_tags', 5, 'Например тэги', 0, 'desc', 1505155054);

-- --------------------------------------------------------

--
-- Структура таблицы `wm_templates`
--

CREATE TABLE `wm_templates` (
  `_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_added` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `wm_templates`
--

INSERT INTO `wm_templates` (`_id`, `name`, `f_name`, `description`, `date_added`) VALUES
(2, 'Новости', 'news', 'Тестовый шаблон', 1504993584),
(3, 'Событие', 'event', 'Шаблон для событий', 1505001861),
(4, 'Шаблон для тестирования', 'sample_template', 'Набор с простейшими полями для тестинга вывода json&#039;ов', 1505059505),
(5, 'Поля названия', 'sample_name_fields', 'Простейший набор, состоящий из названий', 1505155029);

-- --------------------------------------------------------

--
-- Структура таблицы `wm_types`
--

CREATE TABLE `wm_types` (
  `_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `datatype` varchar(255) NOT NULL,
  `date_added` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `wm_types`
--

INSERT INTO `wm_types` (`_id`, `name`, `datatype`, `date_added`) VALUES
(1, 'Строка', 'string', 1504992676),
(2, 'Число', 'int', 1504992676),
(3, 'Число с плавающей точкой', 'float', 1504992676),
(4, 'Текст', 'text', 1504993111),
(5, 'HTML', 'text', 1504993119),
(6, 'Переключатель', 'bool', 1505043374),
(7, 'Файл', 'file', 1505045530);

-- --------------------------------------------------------

--
-- Структура таблицы `wm_users`
--

CREATE TABLE `wm_users` (
  `_id` int(10) UNSIGNED NOT NULL,
  `_group` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_added` int(10) UNSIGNED NOT NULL,
  `_disabled` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `wm_users`
--

INSERT INTO `wm_users` (`_id`, `_group`, `login`, `pass`, `name`, `date_added`, `_disabled`) VALUES
(1, 4, 'demo', 'bdbf96b53cfee416de4881cbcf45c1dc', 'demo', 1505132978, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `wm_users_groups`
--

CREATE TABLE `wm_users_groups` (
  `_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `_access` int(11) NOT NULL DEFAULT '0' COMMENT '0 - guest, 1 - editor, 2 - integrator, 3 - administrator'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `wm_users_groups`
--

INSERT INTO `wm_users_groups` (`_id`, `name`, `_access`) VALUES
(1, 'Гость', 0),
(2, 'Редактор', 1),
(3, 'Главный редактор', 2),
(4, 'Администратор', 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `wm_fields`
--
ALTER TABLE `wm_fields`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `f_name` (`f_name`),
  ADD KEY `_rule` (`_rule`);

--
-- Индексы таблицы `wm_files`
--
ALTER TABLE `wm_files`
  ADD PRIMARY KEY (`_id`),
  ADD KEY `str_id` (`str_id`);

--
-- Индексы таблицы `wm_items`
--
ALTER TABLE `wm_items`
  ADD PRIMARY KEY (`_id`),
  ADD KEY `_set` (`_set`);
ALTER TABLE `wm_items` ADD FULLTEXT KEY `s_index` (`s_index`);

--
-- Индексы таблицы `wm_items_data`
--
ALTER TABLE `wm_items_data`
  ADD PRIMARY KEY (`_id`),
  ADD KEY `_field` (`_field`),
  ADD KEY `_item` (`_item`);

--
-- Индексы таблицы `wm_links_templates_fields`
--
ALTER TABLE `wm_links_templates_fields`
  ADD PRIMARY KEY (`_id`),
  ADD KEY `_field` (`_field`),
  ADD KEY `_template` (`_template`),
  ADD KEY `_field_2` (`_field`);

--
-- Индексы таблицы `wm_rules`
--
ALTER TABLE `wm_rules`
  ADD PRIMARY KEY (`_id`),
  ADD KEY `_type` (`_type`);

--
-- Индексы таблицы `wm_sets`
--
ALTER TABLE `wm_sets`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `f_name` (`f_name`);

--
-- Индексы таблицы `wm_templates`
--
ALTER TABLE `wm_templates`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `f_name` (`f_name`);

--
-- Индексы таблицы `wm_types`
--
ALTER TABLE `wm_types`
  ADD PRIMARY KEY (`_id`);

--
-- Индексы таблицы `wm_users`
--
ALTER TABLE `wm_users`
  ADD PRIMARY KEY (`_id`);

--
-- Индексы таблицы `wm_users_groups`
--
ALTER TABLE `wm_users_groups`
  ADD PRIMARY KEY (`_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `wm_fields`
--
ALTER TABLE `wm_fields`
  MODIFY `_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `wm_files`
--
ALTER TABLE `wm_files`
  MODIFY `_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `wm_items`
--
ALTER TABLE `wm_items`
  MODIFY `_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `wm_items_data`
--
ALTER TABLE `wm_items_data`
  MODIFY `_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT для таблицы `wm_links_templates_fields`
--
ALTER TABLE `wm_links_templates_fields`
  MODIFY `_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT для таблицы `wm_rules`
--
ALTER TABLE `wm_rules`
  MODIFY `_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT для таблицы `wm_sets`
--
ALTER TABLE `wm_sets`
  MODIFY `_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `wm_templates`
--
ALTER TABLE `wm_templates`
  MODIFY `_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `wm_types`
--
ALTER TABLE `wm_types`
  MODIFY `_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `wm_users`
--
ALTER TABLE `wm_users`
  MODIFY `_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `wm_users_groups`
--
ALTER TABLE `wm_users_groups`
  MODIFY `_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
