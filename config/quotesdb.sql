-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2024 at 09:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quotesdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `author` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `author`) VALUES
(1, 'Akira Toriyama'),
(2, 'Plato'),
(3, 'Han Fei'),
(4, 'Susan B. Anthony'),
(5, 'Vivienne Westwood');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'Myself'),
(2, 'Time'),
(3, 'Detail'),
(4, 'Want'),
(5, 'Like'),
(6, 'Soul'),
(7, 'Love'),
(8, 'Conclusion'),
(9, 'Growth'),
(10, 'Courage');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` int(11) NOT NULL,
  `quote` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `quote`, `author_id`, `category_id`) VALUES
(1, 'I\'d want to be born once more as myself, but more talented.\r\n\r\n', 1, 1),
(2, 'Maybe I\'m just like a child. I\'m full of curiosity about things, and it\'s fine as long as it\'s fun at that time, yet at the same time, I hate things that are tough.\r\n\r\n', 1, 2),
(3, 'If you want to depict something exactly the way it is, it takes a tremendous amount of time. If you don\'t get the details right, the inaccuracies will accumulate somewhere.\r\n\r\n', 1, 3),
(4, 'A teleporter would be nice. There are lots of places I want to go, but getting there is a pain.\r\n\r\n', 1, 4),
(5, 'I like efficient people. I\'m pretty impatient, so I can\'t stand people who putter around.\r\n\r\n', 1, 5),
(6, 'Music is a moral law. It gives soul to the universe, wings to the mind, flight to the imagination, and charm and gaiety to life and to everything.\r\n\r\n', 2, 6),
(7, 'Love is a serious mental disease.\r\n\r\n', 2, 7),
(8, 'Dictatorship naturally arises out of democracy, and the most aggravated form of tyranny and slavery out of the most extreme liberty.\r\n\r\n', 2, 8),
(9, 'People are like dirt. They can either nourish you and help you grow as a person or they can stunt your growth and make you wilt and die.\r\n\r\n', 2, 9),
(10, 'Courage is a kind of salvation.\r\n\r\n', 2, 10),
(11, 'The ruler who possesses methods of government does not follow the good that happens by chance but practices according to necessary principles. Law, methods, and power must be employed for government: these constitute its \'necessary principles.\'', 3, 8),
(12, 'I believe it is impossible to be sure of anything.\r\n\r\n', 3, 8),
(13, 'If you rely on political factions to promote men to office, the people will work to develop instrumental relationships and will not seek to be useful with regard to the law. Thus, a ruler who mistakes reputation for ability when assigning offices will see his state fall into disorder.\r\n\r\n', 3, 8),
(14, 'The Way is the beginning of the ten thousand things and the guiding thread of truth and falsity.\r\n\r\n', 3, 9),
(15, 'The object of rewards is to encourage; that of punishments, to prevent. If rewards are high, then what the ruler wants will be quickly effected; if punishments are heavy, what he does not want will be swiftly prevented.\r\n\r\n', 3, 8),
(16, 'Men, their rights, and nothing more; women, their rights, and nothing less.\r\n\r\n', 4, 8),
(17, 'Join the union, girls, and together say Equal Pay for Equal Work.\r\n\r\n', 4, 4),
(18, 'She who succeeds in gaining the mastery of the bicycle will gain the mastery of life.\r\n\r\n', 4, 9),
(19, 'Suffrage is the pivotal right.\r\n\r\n', 4, 8),
(20, 'I have given my life and all I am to it, and now I want my last act to be to give it all I have, to the last cent.\r\n\r\n', 4, 1),
(21, 'My aim is to make the poor look rich and the rich look poor.\r\n\r\n', 5, 4),
(22, 'You\'ve got to invest in the world, you\'ve got to read, you\'ve got to go to art galleries, you\'ve got to find out the names of plants. You\'ve got to start to love the world and know about the whole genius of the human race. We\'re amazing people.\r\n\r\n', 5, 6),
(23, 'I just use fashion as an excuse to talk about politics. Because I\'m a fashion designer, it gives me a voice, which is really good.\r\n\r\n', 5, 1),
(24, 'Popular culture is a contradiction in terms. If it\'s popular, it\'s not culture.\r\n\r\n', 5, 8),
(25, 'When I first saw a picture of the crucifixion, I lost respect for my parents. I suddenly realised that this is what the adult world is like - full of cruelty and hypocrisy.\r\n\r\n', 5, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
