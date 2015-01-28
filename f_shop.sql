-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 28, 2015 at 10:58 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `f_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE IF NOT EXISTS `about_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `about_del` text NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `about_del`, `updated`) VALUES
(1, '<p>\r\nWhether you are looking for a personal way to express your affection for loved ones away from you, or make that first impression which will make that special someone smile in years to come, <a>Flower Shop</a> can provide just the right bouquet to get your message across.\r\n</p>\r\n<img src="/images/about_look.png" alt="about_look.png" align="middle" /> \r\n<p>\r\nBeing a family owned business, we believe that sending flowers should be a pleasure. That is why we use only the very best graded flowers under strict quality controls, along with the most reliable next-day delivery service to create the most pleasant and smooth experience for you. \r\n</p>\r\n<p>\r\nAt <a>Flower Shop</a>, each order counts for us. Whether the order is large or small, customer satisfaction is our top priority, meaning that we are always dedicated to ensuring that our flowers arrive on time and in exceptional form every time. \r\n</p>\r\n<p>\r\nLike our customers, we believe that top quality products and service should only be expected as norm. \r\n</p>\r\n<p>\r\nWhat ultimately makes us unique, however, is the experience and expertise which our talented floral design team have accumulated from our past 32 years in the business. These attribute to the colourful inspirations which perfect our every bouquet, taking floral presentation into a whole new dimension which gives us the edge over our competitors. \r\n</p>\r\n<p>\r\nThe artistic arrangements of colours and variety of flowers used at <a>Flower Shop</a> means that for every occasion there is a captivating selection to choose from. That is why our customers keep coming back And if you are still not convinced, do take a look at what our customers have said about their experience with us in the past. \r\n\r\n</p>', '2015-01-27 12:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `add_pro_cata`
--

CREATE TABLE IF NOT EXISTS `add_pro_cata` (
  `pro_id` int(11) NOT NULL,
  `catalog_id` int(11) NOT NULL,
  `add_on` datetime NOT NULL,
  PRIMARY KEY (`pro_id`,`catalog_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_pro_cata`
--

INSERT INTO `add_pro_cata` (`pro_id`, `catalog_id`, `add_on`) VALUES
(1, 1, '2011-08-15 16:02:52'),
(2, 1, '2015-01-27 16:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `catalog`
--

CREATE TABLE IF NOT EXISTS `catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog_name` varchar(20) NOT NULL,
  `catalog_des` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `catalog`
--

INSERT INTO `catalog` (`id`, `catalog_name`, `catalog_des`) VALUES
(1, 'Hot Winter 2012', 'Make your winter as hot as fire');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(20) NOT NULL,
  `subcategory` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `subcategory`) VALUES
(1, 'Flowers Bouquet', 'Cut Flowers'),
(2, 'Plants', 'Pot Flowers');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photograph_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `author` varchar(255) NOT NULL,
  `sub` varchar(35) NOT NULL,
  `email` varchar(55) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `photograph_id` (`photograph_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `photograph_id`, `created`, `author`, `sub`, `email`, `body`) VALUES
(1, 1, '2012-01-11 10:37:16', 'Omer', 'Beautiful color', 'mfahim.slr1@gmail.com', 'Looks great in green color.'),
(2, 1, '2012-01-11 10:37:16', 'Khasif', 'Beautiful look', 'mfahim.slr1@gmail.com', 'Great Photography.'),
(3, 2, '2012-01-11 10:37:16', 'Ali omer', 'Arrangemnet', 'ali_123@yahoo.com', 'Great set of flowers.'),
(4, 3, '2012-01-11 10:37:16', 'Umair', 'Presentation', 'john_15@gmail.com', 'Great presentation Cymbidium.'),
(5, 5, '2012-01-11 10:37:16', 'Mehmood', 'Fine', 'm_meh@yahoo.com', 'Look more simple than it is.'),
(6, 10, '2012-01-11 10:37:16', 'Fahim', 'Great work', 'fahim_sl1@gmail.com', 'Great Work'),
(7, 10, '2012-01-11 10:37:16', 'Haroon', 'Looks matter', 'haroon_123@gmail.com', 'Color scheme is great.'),
(8, 23, '2012-01-11 10:37:16', 'Khalid', 'Look Beautiful', 'kh_17@gamil.com', 'Look great in pot.'),
(9, 16, '2012-01-11 10:37:16', 'Kamran', 'Great work', 'kami_101@gmail.com', 'Great work done by Photographer'),
(10, 21, '2012-01-11 10:37:16', 'Stootmelo', 'Comment : dcyyuc', 'r.onspayossy@gmail.com', 'kapRyp <a href=http://pennyauctionsc.com/>penny auctions</a> wvwXckt     \r\nvaQtou <a href="http://pennyauctionsc.com/">penny auction</a> ZEccelv     \r\nZeoaav <a href=http://www.ahydroxatonereviews.com/>hydroxatone reviews</a> kkEXdZe     \r\ndRjpae <a href="http://www.ahydroxatonereviews.com/">hydroxatone</a> yaAlyva     \r\ncouEAi <a href=http://pellgrantapplicationa.com/>pell grant application</a> qicReEu     \r\nihplca <a href="http://pellgrantapplicationa.com/">pell grant</a> diQZhuw     \r\nuklulZ <a href=http://www.pellgranteligibilityb.com/>pell grant eligibility</a> tptacsh     \r\nsdouov <a href="http://www.pellgranteligibilityb.com/">pell grant</a> ZZcXwAc    \r\naQAlQo <a href=http://redlandsliving.com/>penny auctions</a> iXcesXy    \r\niocaEZ &lt;a href="http://redlandsliving.com/"&gt;penny auctions&lt;/a&gt; wwcllZQ'),
(11, 21, '2012-01-11 10:37:16', 'Stootmelo', 'Comment : vhZuov', 'rons.payossy@gmail.com', 'AvpQEX <a href=http://pennyauctionsc.com/>penny auctions</a> uhcXuEq       \r\nRXyEqR <a href="http://pennyauctionsc.com/">penny auction</a> qkQQvdX       \r\nRovcdo <a href=http://www.ahydroxatonereviews.com/>hydroxatone reviews</a> dXpdcjd       \r\nEdRddd <a href="http://www.ahydroxatonereviews.com/">hydroxatone</a> uciAicv       \r\nQZkpdo <a href=http://pellgrantapplicationa.com/>pell grant application</a> djuEcoE       \r\nEdZpZE <a href="http://pellgrantapplicationa.com/">pell grant</a> ldkaqdA       \r\nlqksup <a href=http://www.pellgranteligibilityb.com/>pell grant eligibility</a> poyioQa       \r\nactAci <a href="http://www.pellgranteligibilityb.com/">pell grant</a> woyZEsc      \r\nhkdtda <a href=http://redlandsliving.com/>penny auctions</a> kyXjcts      \r\nyccjyk &lt;a href="http://redlandsliving.com/"&gt;penny auctions&lt;/a&gt; cktAlyE'),
(12, 21, '2012-01-11 10:37:16', 'Stootmelo', 'Comment : kEacyy', 'ronsp.ayossy@gmail.com', 'qRsuth <a href=http://pennyauctionsc.com/>penny auctions</a> XysoaZi          \r\npjkeuc <a href="http://pennyauctionsc.com/">penny auctions</a> etRcapd          \r\nliqRZp <a href=http://pellgrantapplicationa.com/>pell grant application</a> avZdsta          \r\nocdaso <a href="http://pellgrantapplicationa.com/">pell grant</a> Eacoeda          \r\nkoqQdQ <a href=http://www.pellgranteligibilityb.com/>pell grant eligibility</a> plQclwc          \r\nptqvhs <a href="http://www.pellgranteligibilityb.com/">pell grant</a> ojcQatv         \r\naXXvZi <a href=http://redlandsliving.com/>penny auctions</a> vpduvQc         \r\nieQqhp <a href="http://redlandsliving.com/">penny auctions</a> uqdadpE'),
(13, 21, '2012-01-11 10:37:16', 'african mango', 'Comment : ulRcul', 'ronsossy@gmail.com', 'AcqQQp <a href=http://saturnspringfield.com/>african mango</a> jjdotZi          \r\ncodkwa <a href="http://saturnspringfield.com/">african mango</a> taejAkA'),
(14, 21, '2012-01-11 10:37:16', 'african mango', 'Comment : yyXRpd', 'ronsossy@gmail.com', 'aZwucX <a href=http://saturnspringfield.com/>african mango</a> EsyiaZs          \r\ncysdcc <a href="http://saturnspringfield.com/">african mango</a> vppEvvE'),
(15, 21, '2012-01-02 14:10:09', 'Stootmelo', 'Comment : uaQijc', 'ronsp.ayossy@gmail.com', 'REcslp <a href=http://pennyauctionsc.com/>penny auctions</a> wvQQutj          \r\nRovtaa <a href="http://pennyauctionsc.com/">penny auctions</a> hsquQtu          \r\ntvEvao <a href=http://pellgrantapplicationa.com/>pell grant application</a> EdkycuE          \r\nkasylZ <a href="http://pellgrantapplicationa.com/">pell grant</a> jskEacy          \r\nelswjq <a href=http://www.pellgranteligibilityb.com/>pell grant eligibility</a> leeuZRA          \r\ncaiuoX <a href="http://www.pellgranteligibilityb.com/">pell grant</a> QRoyAZi         \r\ndwkadq <a href=http://redlandsliving.com/>penny auctions</a> oEcohik         \r\ndtlove <a href="http://redlandsliving.com/">penny auctions</a> vhapEEt'),
(16, 4, '2012-01-11 02:06:53', 'haris', 'Comment : my first comment', 'mfahim_slr@yahoo.com', 'great flower'),
(17, 1, '2012-01-11 10:37:16', 'Haris', 'Comment : great one', 'mfahim_slr@yahoo.com', 'i like it'),
(18, 18, '2012-01-11 16:23:28', 'James', 'Comment : Great work', 'mfahim_slr@yahoo.com', 'i like it.'),
(21, 18, '2012-01-11 16:36:43', 'Elvis', 'Comment : Keep it up', 'mfahim_slr@yahoo.com', 'great work.'),
(22, 18, '2012-01-11 16:43:04', 'Albert', 'Comment : Hydrangea', 'mfahim_slr@yahoo.com', 'Hydrangea is my passion'),
(23, 18, '2012-01-11 16:48:17', 'Nabeel Ahmed', 'Comment : Great', 'mfahim_slr@yahoo.com', 'i like the photography the most.');

-- --------------------------------------------------------

--
-- Table structure for table `photographs`
--

CREATE TABLE IF NOT EXISTS `photographs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `size` int(11) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `family` varchar(50) NOT NULL,
  `color` varchar(7) NOT NULL,
  `price` double NOT NULL,
  `inserted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `photographs`
--

INSERT INTO `photographs` (`id`, `filename`, `type`, `size`, `caption`, `description`, `category_id`, `family`, `color`, `price`, `inserted`) VALUES
(1, 'alstroemeria-01.jpg', 'image/jpeg', 78087, 'Alstroemeria', '<ul><li>Alstroemerias can be stored in the cold store at 2 to 5 ºC.</li><li>Place the Alstroemeria in clean buckets or vases with clean water.</li><li>A\r\n preservative will ensure that the flowers open nicely, the foliage does\r\n not yellow and the water is not contaminated by bacteria.</li><li>Cut 3 to 5 cm off the stems with a sharp knife or secateurs and remove the bottom leaves.</li><li>Ensure that there are no leaves in the water, particularly not when combining with other flowers.</li><li>The\r\n Alstroemerias will open nicely at a higher temperature, provided that \r\nthey were not too under-ripened when bought, particularly in the winter \r\nmonths.</li><li>Ensure that the flowers cannot become damp as a result \r\nof excessive humidity or condensation in the cellophane. This will \r\nencourage Botrytis.</li></ul', 1, 'Alstroemeriaceae', 'FFFFFF', 11, '2011-08-12 18:41:21'),
(2, 'chrysanthemum-01.jpg', 'image/jpeg', 173591, 'Chrysanthemum ', '<ul><li>Chrysanthemums\r\n can be stored dry in the cold store at 2-5 °C. In order to ensure that \r\nthe flowers and foliage do not droop, it is a good idea to place the \r\nflowers in a shallow layer of water after a few days.</li><li>Chrysanthemums like clean vases or buckets with clean water.</li><li>Cut 3 to 5 cm off the stems with a sharp knife or secateurs.</li><li>Ensure that there are no leaves in the water, particularly not when combining with other flowers.</li><li>Top the vases up regularly - chrysanthemums are very thirsty.</li><li>Outdoor\r\n chrysanthemums in particular can have a somewhat woody stem, which \r\nmakes it harder to take up water. A preservative is therefore needed in \r\nthis case.</li><li>However, ensure that the flowers cannot become damp as a result of excessive humidity or condensation in the cellophane.</li><li>Disbudded\r\n chrysanthemums are often supplied with a protective cellophane around \r\nthe flower. If this cellophane is wetted slightly with a spray, it is \r\neasy to remove without damaging the flower. If disbudded chrysanthemums \r\nnevertheless shed petals, a drop of glue or candle wax can be applied to\r\n the damaged spot, which means that the flower is still sellable.</li><li>Outdoor\r\n chrysanthemums should be stored in water, because they have a woody \r\nstem and it is harder for them to take up water than for greenhouse \r\nchrysanthemums with their herbaceous stems.</li></ul>', 1, 'Asteraceae', 'DEFFF3', 8, '2012-01-12 00:52:55'),
(3, 'cymbidium-01.jpg', 'image/jpeg', 58468, 'Cymbidium', '<ul><li>Cymbidium\r\n flowers are best transported at a temperature which is not less than 8 \r\nºC.&nbsp; Many florists think that it is a tropical flower and that the \r\nstorage temperature must be more than 14 ºC, but this is not \r\ncorrect.&nbsp; If the temperature is too low and storage lasts too long,\r\n the flower will glaze.</li><li>Cut a piece off the end of the stems.</li><li>Place the branches in clean water.</li><li>The test-tubes in which the flowers are transported in the box can be saved for later use in flower arrangements or bouquets.</li><li>Ensure\r\n that the vulnerable ‘anther cap’ is not damaged or snapped off, since \r\nthis will immediately reduce the lifespan significantly.</li><li>Do not \r\nallow the flower to come into contact with sources of ethylene, such as \r\nripening fruit, vegetables or exhaust fumes. This will cause the flower \r\nto age rapidly.</li><li>When producing floral arrangements or bouquets \r\nthe Cymbidium is placed in test-tubes as a loose flower. Ensure that the\r\n test-tubes remained well-filled with water.</li><li>Avoid condensation or the flowers getting wet because of the risk of Botrytis.</li><li>Clean and dry working is very important.</li></ul>', 1, 'Orchidaceae', 'E6CDCC', 6, '2012-01-12 00:52:55'),
(4, 'eustoma-01.jpg', 'image/jpeg', 44536, 'Eustoma', '<ul><li>Eustoma can be stored in the cold store at 5 to 8 ºC.</li><li>Cut a few centimetres off the stems with a sharp knife or secateurs.</li><li>Ensure that there are no leaves in the water.</li><li>It\r\n may sometimes be a good idea to remove a few side shoots (buds or \r\nrunners) or extra foliage. This will benefit the flowers’ lifespan.</li><li>Place the Eustoma in clean buckets or vases with clean water.</li><li>A preservative will ensure that the flowers open nicely and that the water is not contaminated by bacteria.</li><li>However,\r\n ensure that the flowers cannot become damp as a result of excessive \r\nhumidity or condensation in the cellophane because of the risk of \r\nBotrytis. This is often referred to as spot on Eustoma flowers, or \r\nblight if it is on the leaf.</li><li>The Eustoma will open nicely at a \r\nhigher temperature, provided that they were not too under-ripened when \r\nbought, particularly in the winter months.</li></ul>', 1, 'Gentianaceae', 'D1D4FF', 9, '2011-08-12 23:38:39'),
(5, 'freesia-01.jpg', 'image/jpeg', 67278, 'Freesia', '<ul><li>Freesias can be stored in the cold store at 2 to 5 ºC.</li><li>In\r\n order to ensure that the flowers and foliage do not droop or yellow, it\r\n is a good idea to place the flowers in a small amount of water after a \r\nfew days.</li><li>Cut a few centimetres off the stems with a sharp knife or secateurs.</li><li>Place the freesias in clean buckets or vases with clean water.</li><li>A\r\n preservative (preferably specially intended for bulb flowers) will \r\nensure that the flowers open nicely, even the smallest buds on the \r\nspike, and that the water is not contaminated by bacteria. Freesias will\r\n open nicely at a higher temperature, provided that they were not too \r\nunder-ripened when bought, particularly in the winter months.</li><li>When\r\n producing table decorations for dinners and buffets it is important to \r\ntake account of the scent of some cultivars; this can affect the taste \r\nof the food.</li><li>However, ensure that the flowers cannot become damp\r\n as a result of excessive humidity or condensation in the cellophane \r\nbecause of the risk of Botrytis. With freesias this is often called \r\nspotting or speckle due to the small patches on the flowers.</li></ul>', 1, 'Iridaceae', 'FFF2FC', 13, '2011-08-12 23:41:25'),
(6, 'gerbera-01.jpg', 'image/jpeg', 44731, 'Gerbera', '<ul><li>Gerbera can be stored in boxes or on water in the cold store at 5 to 7 °C.</li><li>Gerbera\r\n flowers which have been bought in boxes must first be removed from the \r\nboxes. This is done most easily by placing the interiors horizontally on\r\n top of a raised bucket so that the stems can hang in the water. The \r\nbenefit of this method is that the flowers take up water horizontally, \r\nwhich makes it unnecessary to mount them on wire later.</li><li>In order\r\n to ensure that the flowers and the foliage don’t droop, it is a good \r\nidea to place the flowers in a shallow layer of water with some \r\npreservative after a few days.</li><li>Once the flower stems have been trimmed, they are placed in a clean vase with a preservative.</li><li>If there is no preservative available, a drop of chlorine can also be put in the water to retard the growth of bacteria.</li><li>Gerberas\r\n only need to be mounted on wire nowadays if the stem of the flower \r\nneeds to be placed in a particular position. Provided that it is fresh, \r\nthe current range requires no additional work. If the Gerbera is \r\nnonetheless mounted on wire, it is a good idea to allow for slight \r\ngrowth of the stem.</li><li>Clean and dry working is important.&nbsp; \r\nThe flowers are sensitive to bacteria, and will quickly droop as a \r\nresult of Botrytis. This is often called ‘spotting’ on Gerberas when it \r\nis on the petals. The heart can also be affected. The flowers are \r\nsensitive to bacteria and can soon droop if you do not work cleanly.</li><li>Clean and dry working is very important.</li></ul>', 1, 'Asteraceae', 'F9FFA6', 25, '2012-01-12 00:52:55'),
(7, 'hippaestrum-01.jpg', 'image/jpeg', 49391, 'Hippaestrum', '<ul><li>Hippeastrum can be stored dry in boxes in the cold store at 8 to 12 °C. Colder is not good - it will cause the flowers to glaze.</li><li>In\r\n order to ensure that the flowers and foliage do not droop or yellow, it\r\n is a good idea to place the flowers in a small amount of water after a \r\nfew days.</li><li>Cut a few centimetres off the stems with a sharp knife or secateurs.</li><li>Place the Hippeastrum in clean buckets or vases with clean water.</li><li>Add\r\n a preservative, preferably one specially intended for bulb flowers. A \r\npreservative will ensure that the flowers open nicely and that the water\r\n is not contaminated by bacteria.</li><li>Ensure that the flowers cannot\r\n become damp as a result of excessive humidity or condensation because \r\nof the risk of Botrytis. With Hippeastrum this is often called spotting \r\nor speckle due to the small patches on the flowers.</li><li>When \r\ncreating bouquets and arrangements, it is a good idea to insert a stick \r\ninto the hollow stem to help support the heavy flowers. This is only \r\nnecessary on the older cultivars; the new range has stronger stems.</li><li>Place\r\n tape or an elastic band around the stem in order to prevent the ends of\r\n the stem from curling. This will ensure that the flower continues to \r\ndrink for longer.</li><li>When using Hippeastrum in oasis, it is a good idea to make the hole first before inserting the flower into it.&nbsp;</li></ul>', 1, 'Amaryllidaceae', 'FFBCB8', 12, '2011-08-12 23:47:22'),
(8, 'hydrangea-01.jpg', 'image/jpeg', 35885, 'Hydrangea', '<ul><li>Cut Hydrangeas will not do well in a metal\r\n vase or pail. Glass vases are ideal. They allow you to keep a check on \r\nthe water level and water quality at all times.</li><li>Slant cut the stems to facilitate improved absorption of water.</li><li>Stand the flowers in sufficient fresh, cold water.</li><li>Always\r\n use cut flower food. This helps the flowers to open fully and keeps the\r\n leaves green and firm. In the case of fresh cut Hydrangeas, cut flower \r\nfood can add more than a week to their vase life.</li><li>Always give your customers some cut flower food with their purchase of cut Hydrangeas.</li><li>Fresh\r\n cut Hydrangeas dislike drought. If you are using them in Oasis foam, \r\nensure they have an adequate supply of water to keep them looking good \r\nlonger.</li><li>The ideal storage temperature is 8°C.</li><li>If the \r\nflowers stop absorbing water and the leaves look limp, remove the leaves\r\n from the stem and empty the vase of water. Replace the flowers in the \r\nvase minus the leaves and water. Normally the flowers will then dry out \r\ncompletely and provide further months of enjoyment!</li></ul>', 1, 'Saxifragaceae', 'FFEBBD', 23, '2012-01-12 00:52:55'),
(9, 'lilium-01.jpg', 'image/jpeg', 73161, 'Lilium ', '<ul><li>Lilies can be stored dry in the cold store at 2 to 5 °C.</li><li>Place the lilies in clean buckets or vases with clean water.</li><li>A\r\n preservative (preferably specially intended for bulb flowers) will \r\nensure that the flowers open nicely, the foliage does not yellow and the\r\n water is not contaminated by bacteria.</li><li>Cut 3 to 5 cm off the \r\nstems with a sharp knife or secateurs and remove the bottom leaves. \r\nEnsure that there are no leaves in the water, particularly not when \r\ncombining with other flowers.</li><li>A preservative will ensure that \r\nthe flowers open nicely, the foliage does not yellow and the water is \r\nnot contaminated by bacteria.</li><li>The lilies will open nicely at a \r\nhigher temperature, provided that they were not too under-ripened when \r\nbought, particularly in the winter months.</li><li>When creating \r\narrangements and bouquets it is important to take account of the opening\r\n flowers and the stamens in them which could shed. To prevent this the \r\nstamens can be removed or carefully sprayed with spray glue so that they\r\n cannot shed.</li><li>When producing table decorations for dinners and \r\nbuffets it is important to take account of the strong scent of some \r\ncultivars; this can affect the taste of the food.</li><li>However ensure that the flowers cannot become damp as a result of excessive humidity or condensation in the cellophane.</li></ul>', 1, 'Liliaceae', 'FFFFFF', 25, '2011-08-12 23:58:35'),
(10, 'snijorchidee-01.jpg', 'image/jpeg', 95291, 'Orchidee', '<p>\r\n                <strong>\r\n                    <!--startindex-->\r\n                    Tips for care for the florist<!--stopindex-->\r\n                </strong>\r\n            </p>\r\n            \r\n            \r\n            <!--startindex-->\r\n            <p><strong>Tips transport and storage</strong></p><ul><li>Transport orchids at temperatures between 10 and 12° C.</li><li>Keep the flowers away from sources of ethylene such as ripe fruit, vegetables or exhaust fumes.</li><li>Never stand orchids in a draught or in full sunlight.</li><li>Treat them with care and avoid dropping or bumping them.</li><li>Keep the vials filled with water at all times.</li><li>Take care with the delicate stigma.</li></ul><!--stopindex-->\r\n\r\n            \r\n            \r\n            \r\n            <!--startindex-->\r\n            <p><strong>Tips for presentation</strong></p><ul><li>Display orchids by colour and variety. This looks attractive and will enhance the turnover speed.</li><li>Remove any sprays of dead flowers. This keeps the display looking attractive and tempting.</li><li>Replicate situations in the home: Place a few orchids in pretty vases on an attractive sideboard or mantelpiece. Give your customers ideas they can use in their own homes.</li><li>The choice of vase can have huge effect on the impact of the flowers. Opt for a specific ambience that either contrasts with the flower or tones with it. An antique vase will create a different effect to a contemporary one. The same applies to sober and bright colours, natural or synthetic materials. Experiment and inspire!</li></ul>', 1, ' orchid', 'CFF0FF', 24, '2012-01-12 00:52:55'),
(11, 'rosa-01.jpg', 'image/jpeg', 64887, 'Rosa', '<ul><li>Roses\r\n can be stored in water in the cold store at 2-4 °C - the colder the \r\nbetter. However, ensure that the flowers cannot become damp as a result \r\nof excessive humidity or condensation in the cellophane.</li><li>Use vases or containers which have been thoroughly cleaned.</li><li>Use clean tap water.\r\n<br>\r\nAdd the correct concentration of special rose (or general) preservative to the water in order to counter the growth of bacteria.</li><li>Remove the leaves that will be below water level from the stem in order to prevent the growth of bacteria.</li><li>If\r\n possible, leave the thorns in place. Wounds to the stem will encourage \r\nthe growth of bacteria, which will affect the lifespan.</li><li>Cut or \r\nsnip about 4 or 5 cm off the bottom of the stem using a sharp knife or \r\nsecateurs, and place the roses in clean water immediately. There is no \r\ndifference in principle between cutting straight or diagonally.</li><li>Check the water level regularly and top up.&nbsp; The water should not be replaced.</li><li>Keep the roses away from sources of heat (heaters, sun).</li><li>Do not use a plant spray on roses - this will encourage Botrytis.</li></ul>', 1, 'Rosaceae', 'FF8CB6', 16, '2011-08-13 00:44:36'),
(12, 'tulipa-01.jpg', 'image/jpeg', 65615, 'Tulipa', '<ul><li>Tulips\r\n can continue to grow by 5 to 15 cm; it is important to take account of \r\nthis when creating a bouquet or arrangement or when displaying in store.\r\n Account should also be taken of the fact that tulips continue to grow \r\nwhen mounting them on wire. Growers sometimes pre-treat tulips in order \r\nto restrict growth.</li><li>There is a special preservative to prevent \r\nfurther growth in the vase at the sales outlet. Giving the consumer a \r\nspecial tulip preservative will have a positive effect on the vase life.</li><li>Store\r\n tulips as cool as possible in order to prevent them from ripening \r\nfurther. A temperature of 2 to 5 degrees Celsius at the florist is best -\r\n the cooler the better.</li><li>The flowers can be stored dry in a \r\ncooled space in order to prevent further growth. If necessary place them\r\n in a little water to ensure that the flower is sufficiently rigid when \r\nsold.</li><li>On arrival in store it is a good idea to wrap the tulips \r\ntightly in the water and allow them to drink standing upright from a \r\nshallow layer of water in order to prevent them from growing crooked.</li><li>Cut\r\n off the white part which can often be found at the bottom of the stem, \r\nso that the flower can take up water more easily, and place the flowers \r\nin the sales area in a shallow layer of water.</li><li>Prevent condensation or the flowers or foliage from getting wet because of Botrytis.</li><li>We occasionally encounter ‘topple’ - this can cause the tulip to bend, which destroys the flower’s decorative value.</li></ul>', 1, 'Liliaceae', 'EBFFF7', 17, '2011-08-13 00:47:26'),
(13, 'anthurium-01.jpg', 'image/jpeg', 46206, 'Anthurium ', '<ul><li>Caring for Anthurium in store is simple.\r\n<br>\r\nDepending on the type of sales outlet, the plants can stay in the sleeve or be removed from it.</li><li>Leave\r\n the plant in its sleeve during shipping and transfer in order to \r\nprevent cold damage.&nbsp; Ensure that the flowers cannot become damp as\r\n a result of excessive humidity or condensation in the cellophane.</li><li>If necessary water once a week - ensure that the water given is not too cold.</li><li>Make sure that the plant does get enough light, but do not place it in direct sunlight.</li><li>Anthurium\r\n is sensitive to cold - the minimum temperature in the store must be \r\n12-15 °C. In the winter beware of draughts in the sales area and don’t \r\nplace the plant in front of a cold window and/or opening doors. Cold \r\ndamage can be recognised by dark patches on the foliage, on the spathe \r\nor on the spadix. These can literally ‘turn blue with cold’.</li><li>When\r\n the plant is given to the consumer, extra packaging must be applied in \r\nlow temperatures on order to protect the plant from the cold.</li><li>Caution: the young leaves and the spadix are poisonous.</li></ul>', 2, 'Araceae', 'FF7377', 25, '2012-01-12 00:52:55'),
(14, 'pot-chrysanthemum-01.jpg', 'image/jpeg', 76688, 'Pot Chrysanthemum', '<ul><li>Caring for pot chrysanthemums in store requires some attention.</li><li>Display\r\n the pot chrysanthemums in a light spot in order to prevent stretching \r\nof the stems, leaf yellowing, and the loss and drying out of buds.</li><li>A\r\n pot chrysanthemum can be stored successfully in cool conditions, even \r\nin a cold store. The ideal storage temperature is 5 °C. if the storage \r\nconditions are too warm, the plant will ripen more quickly.</li><li>Ensure that the plant is not deprived of light for too long - the buds can dry out.\r\n<br>\r\nDepending on the type of sales outlet, the plants can stay in the sleeve\r\n or be removed from it.&nbsp; In any case avoid condensation or moisture\r\n in the sleeve, since this can cause Botrytis on the leaves and the \r\nstem.</li><li>If necessary water two to three times a week, preferably \r\nfrom below. Ensure that the water given is not too cold. The pot soil \r\nmay not be allowed to dry out.</li><li>Check the plant for spent flowers and other defects.</li></ul>', 2, 'Asteraceae', 'F4BAFF', 13, '2012-01-12 00:52:55'),
(15, 'dracaena-01.jpg', 'image/jpeg', 51209, 'Dracaena', '<ul><li>Dracaena is very easy to care for in the store.</li><li>Display Dracaena in a light spot.</li><li>If\r\n necessary water once a week, preferably from below. Ensure that the \r\nwater given is not too cold. The bigger and fatter the stem, the less \r\nwater the plant will need at the point of sale. However, the pot soil \r\nmay not be allowed to dry out.</li><li>Check the plant for any pests, falling or yellowing leaves and other defects.</li><li>Dracaena is sensitive to cold and should therefore be transported and stored at a temperature of at least 12 to 15 &#730;C.</li><li>Beware of temperature fluctuations or cold from doors and windows, particularly in the cold months.</li><li>Give the consumer extra packaging around the plant if the temperature falls below 12&#730;C.</li><li>It is important that the plant gets sufficient light during shipping and storage.</li><li>Caution: The sap is poisonous if ingested!</li></ul>', 2, 'Dracaenaceae', '6E4678', 21, '2012-01-12 00:52:55'),
(16, 'ficus-01.jpg', 'image/jpeg', 52284, 'Ficus', '<ul><li>Caring for Ficus in store requires some attention.</li><li>Display the Ficus in the light spot in order to prevent leaf drop.</li><li>Water\r\n two to three times a week where necessary, preferably from below. Make \r\nsure the water given is not too cold. The pot soil may not be allowed to\r\n dry out.</li><li>Check the plant for any pests, falling or yellowing leaves and other defects.</li><li>Ficus is sensitive to cold and should therefore be transported and stored at a temperature of 12 to 15 &#730;C.</li><li>Beware of large temperature fluctuations caused by things like draughts in the cold months.</li><li>Provide the consumer with extra packaging around the plant if the temperature falls below 12&#730;C.</li><li>It is important that the plant gets sufficient light during shipping and storage.</li><li>Caution: Ingesting a piece of ficus leaf with the sap can have a laxative effect.</li></ul>', 2, 'Moraceae', '384F39', 253, '2012-01-12 00:52:55'),
(17, 'hyacinthus-01.jpg', 'image/jpeg', 57253, 'Hyacinthus ', '<ul><li>Hyacinthus is easy to care for in store.\r\n<br>\r\nDisplay Hyacinthus in the coolest spot available.</li><li>Hyacinthus can\r\n be stored successfully in cool conditions, even in a cold store. The \r\nideal storage temperature is 0-5 °C. Make sure that the plant is in the \r\ncold store for as short a time as possible, since it will otherwise get \r\ntoo little light and the buds can dry out. If the storage conditions are\r\n too warm, the plant will ripen more quickly.</li><li>Prevent \r\ncondensation or moisture from getting onto the flowers, since this can \r\ncause Botrytis on the bulb, the foliage, the stem or the flower.</li><li>Water once a week if required. Check the plant for spent flowers and other defects.\r\n<br>\r\nPot hyacinths do not need additional plant food. The bulbs are full of nutrition which the flower can use.</li><li>Caution:\r\n All parts of the plant are poisonous if ingested (particularly the bulb\r\n and seed). Repeated contact with the dry bulbs can cause serious \r\nirritation.</li></ul>', 2, 'Hyacinthaceae', '7936FF', 245, '2012-01-12 00:52:55'),
(18, 'pot-hydrangea-01.jpg', 'image/jpeg', 37266, 'Pot Hydrangea', '<strong>Tips to keep your pot Hydrangea looking good indoors</strong></p><ul><li>Hydrangeas like lots of light and plenty of water! The plant prefers a well lit spot out of bright sunlight.</li><li>The\r\n plant prefers fresh, fairly moist air so keep Hydrangeas away from the \r\ncentral heating. Avoid draughts and strong temperature fluctuations. The\r\n ideal temperature is 15 to 22 °C.</li><li>Ensure the soil in the pot is kept moist. The plant will enjoy a plunge bath once or twice a week.</li><li>Remove any excess water from the cache pot or bowl.</li><li>Are\r\n the leaves/flowers looking limp? Immerse the plant in water for 15 \r\nminutes and the leaves and flowers will generally recover. This could \r\ntake between one and two hours depending on how limp they have become. \r\nStand in a cool spot for even better results.</li></ul><p><strong>Tips to help you enjoy your Hydrangea in the garden</strong></p><ul><li><p>When\r\n you houseplant has finished flowering, you can allow it to acclimatise \r\nto the atmosphere outdoors. In this way you will be able to enjoy a \r\nflowering Hydrangea outdoors in the following season.</p></li><li><p>The\r\n best time to put the plant outdoors is in late spring (after 15 May). \r\nThis is the date generally assumed to be the last day in which night \r\nfrost could occur.</p></li><li><p>Once it has been planted in the garden the Hydrangea will be hardy. Water copiously during the first year.</p></li><li><p>Late\r\n night frosts can lead to buds being shed. This is actually not a bad \r\nthing as it presents a good opportunity to cut the plant back hard.</p></li><li><p>If your Hydrangea is kept outdoors in a pot the minimum temperature should not fall below 5 °C.</p></li><li><p>Hydrangeas need lots of water: when planting outdoors avoid coarse sandy soils.</p></li><li><p>At\r\n the end of the season leave the dead flowers on the shrub for as long \r\nas possible. They help protect the plant from frosts. Never cut the \r\nplant back before winter. The old flowers can be cut off when the plant \r\nstarts to produce new shoots at the end of March. This applies \r\nparticularly to the Macrophylla varieties.</p></li><li><p>If you cut the plant back in summer, around the longest day, it will produce flowers again the following year.</p></li><li><p>Hydrangeas\r\n thrive best in the shade. In fact, white varieties should only be grown\r\n in the shade as they will not stay white otherwise. The flowers will \r\nburn.</p></li></ul>', 2, 'Saxifragaceae', 'FAFFE3', 250, '2012-01-12 00:52:55'),
(19, 'kalanchoe-01.jpg', 'image/jpeg', 42591, 'Kalanchoe', '<ul><li>Caring for Kalanchoe in store is simple.</li><li>Depending\r\n on the type of sales outlet, the plants can stay in the sleeve or be \r\nremoved from it.&nbsp; In any case avoid condensation or moisture in the\r\n sleeves because of the risk of Botrytis.</li><li>If necessary water once a week, from below if possible. Make sure the water given is not too cold.</li><li>Check the plant for spent flowers and other defects.</li><li>Ensure that it gets enough light in order to avoid stretching of the flower stems.</li><li>Kalanchoe\r\n cannot be stored at temperatures below 12-15 °C. You should therefore \r\nleave the plant in its sleeve during shipping and transfer in order to \r\nprevent cold damage.</li></ul>', 2, 'Crassulaceae', 'BF2242', 200, '2012-01-12 00:52:55'),
(20, 'phalaenopsis-01.jpg', 'image/jpeg', 45368, 'Phalaenopsis', '<ul><li>Caring for Phalaenopsis in store is simple.</li><li>Water the plant once a week.</li><li>Phalaenopsis needs an ambient temperature of at least 12-15 °C.</li><li>Leave\r\n the plant in its sleeve during shipping and transfer in order to \r\nprevent cold damage. Ensure that the flowers cannot become damp as a \r\nresult of excessive humidity or condensation in the cellophane.</li><li>Check the plant for spent flowers and other defects.</li><li>Ensure\r\n that the plant is not placed in direct sunlight but does get enough \r\nlight, especially during the winter months. Buds can shed in the winter,\r\n particularly from plants which are too unripe when bought.</li><li>Clean and dry working is important in order to prevent Botrytis.</li></ul>', 2, 'Orchidaceae', 'FFEBFA', 241, '2012-01-12 00:52:55'),
(21, 'pot-orchidee-01.jpg', 'image/jpeg', 117389, 'Pot Orchidee', '<p>Contrary to popular belief orchids are not in \r\nthe least difficult to care for. In fact, they are really low \r\nmaintenance! With just a little extra attention most orchids will flower\r\n several times a year. It goes without saying that the thousands of \r\ndifferent orchid varieties will not all thrive on the same type of care.\r\n However, there are some general tips that will benefit most varieties \r\nof orchids. If you follow the guidelines below, you will be well on the \r\nway to success. Ask the florist for any specific care tips when you buy \r\nan orchid!</p><p><strong>Orchids like</strong></p><ul><li>a well-lit spot</li><li>room temperatures between 18 and 20ºC</li><li>special, liquid orchid food (once a month)</li><li>a bath</li></ul><p><strong>Orchids dislike:</strong></p><ul><li>wet\r\n feet. Immerse the pot in water for 5 to 10 minutes, once a week and \r\nthen allow to drain well. The water should be at room temperature</li><li>draughts</li><li>direct sunlight</li><li>standing near the central heating or a heater</li><li>fruit bowls! Fruit produces gases that cause flowers to age prematurely</li></ul><p><strong>Tips for watering</strong></p><ul><li>If possible use rainwater!</li><li>Never water the plant, always the soil.</li><li>It is preferable to water orchids in the morning so that the moisture has time to dry up.</li><li>Keep orchids drier in winter than in summer. They rest in winter. Only water occasionally.</li><li>In spring increase the amount of water given, occasionally adding some special plant food.</li><li>Most\r\n modern houses suffer from a dry atmosphere, whereas orchids like some \r\nhumidity: The leaves of the orchid should therefore be sprayed regularly\r\n with water.</li></ul>', 2, 'orchid', 'FFEA61', 170, '2012-01-12 00:52:55'),
(22, 'pot-rosa-01.jpg', 'image/jpeg', 51407, 'Pot Rosa', '<ul><li>Caring for pot roses in store requires some attention.</li><li>Display\r\n the pot roses in a light spot in order to prevent stretching of the \r\nstems, yellowing of the leaves and the loss and drying out of buds.</li><li>A\r\n pot rose can be stored successfully in cool conditions, even in a cold \r\nstore. The ideal storage temperature is 5 °C. if the storage conditions \r\nare too warm, the plant will ripen more quickly.</li><li>Leave the plant in the sleeve during the shipping and storage phase.</li><li>Depending\r\n on the type of sales outlet, the plants can stay in the sleeve or be \r\nremoved from it.&nbsp; In any case avoid condensation or moisture in the\r\n sleeves because of the risk of Botrytis on the leaves and the stem.</li><li>If\r\n necessary water two to three times a week, preferably from below.&nbsp;\r\n Ensure that the water given is not too cold. The pot soil may not be \r\nallowed to dry out.</li><li>Check the plant for spent flowers and other defects.</li><li>Watch out for injuries from the thorns.</li></ul>', 2, 'Rosaceae', 'F79CCD', 125, '2012-01-12 00:52:55'),
(23, 'spathiphyllum-01.jpg', 'image/jpeg', 48078, 'Spathiphyllum ', '<ul><li>Caring for Spathiphyllum in store is simple.</li><li>Depending on the type of sales outlet, the plants can stay in the sleeve or be removed from it.</li><li>If\r\n necessary water once or twice a week - but ensure that the water given \r\nis not too cold. If the plant has nonetheless drooped, the pot soil can \r\nbe immersed in a bucket of water.</li><li>Feed the plant once every three weeks, in the correct concentration as specified on the packaging.</li><li>Check the plant for spent flower shoots and other defects.</li><li>Ensure that it gets enough light, but is not placed in direct sunlight.</li><li>Spathiphyllum\r\n is sensitive to cold.&nbsp; The temperature in the store should not be \r\nless than 12-15 °C. In the winter beware of draughts in the sales area \r\nand avoid placing the plant in front of a cold window and/or opening \r\ndoors. Cold damage can be recognised by dark patches on the leaf or the \r\nflower.</li><li>Leave the plant in its sleeve during shipping and \r\ntransfer in order to prevent cold damage. Ensure that the spathes cannot\r\n become damp as a result of excessive humidity or condensation in the \r\ncellophane.</li><li>When the plant is given to the consumer, extra \r\npackaging must be applied in low temperatures in order to protect the \r\nplant from the cold.</li><li>Caution: Spathiphyllum’s sap can irritate the skin and mucous membranes.</li></ul>', 2, 'Araceae', 'FCFFED', 160, '2011-08-13 01:28:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `user_type`, `email`, `address`) VALUES
(1, 'hassan', 'a4j5e4x5s4m454o4m463', 'Hassan', 'Rauf', 'administrator', 'hassan.rauf@yahoo.com', '299-A Johar Town Lahore, Pakistan'),
(2, 'ali', 'a4j5e4x5s4m454o4m463', 'Ali', 'Khasif', 'administrator', 'ali@yahoo.com', '13-G Gulberg II Lahore,Pakistan'),
(3, 'omer', 'a4j5e4x5s4m454o4m463', 'Omer', 'Anwar', 'employee', 'omer@gmail.com', '14-Y Gulberg III Lahore,Pakistan'),
(4, 'haroon', 'a4j5e4x5s4m454o4m463', 'Haroon', 'Malik', 'customer', 'haroon_17@gmail.com', '15-B Gulberg II Lahore,Pakistan'),
(7, 'umair', 'a4j5e4x5s4m454o4m463', 'Umair', 'Raza', 'customer', 'umair_66@hotmail.com', '277-G  Gulshan-e-ravi Lahore, Pakistan'),
(8, 'kami', 'a4j5e4x5s4m454o4m463', 'Kamran', 'Rashid', 'customer', 'kami_17@yahoo.com', '58-F Johar Town Lahore, Pakistan');
