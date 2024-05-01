-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2023 at 09:03 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydreamblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` int(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `title`, `image`, `description`) VALUES
(5, 'Art Extravaganza', 'img/Art Supplies Extravaganza.jpg', 'Calling all art enthusiasts and creators! Get ready to unlock your full artistic potential at our exclusive Art Supplies Extravaganza! Immerse yourself in a world of creativity and bring your imagination to life with our handpicked selection of high-quality art supplies.\r\n\r\nDiscover Premium Quality: Elevate your artwork with our top-notch acrylic paints, watercolor sets, and more, sourced from trusted brands renowned for their exceptional quality.\r\n\r\nUnearth a Spectrum of Brushes: Choose from a diverse range of brushes tailored to suit your unique artistic style, whether you prefer fine detailing or bold, expressive strokes.\r\n\r\nExplore Mixed Media: Embrace the endless possibilities of mixed media art with our comprehensive range of materials, including textured canvases and charcoal pencils.\r\n\r\nExclusive Deals Await: Don\'t miss out on irresistible deals and special discounts during our Art Supplies Extravaganza. We believe that every artist deserves to have the best tools without breaking the bank!\r\n\r\nFree Gift with Purchase: As a token of appreciation, enjoy a complimentary art-related gift with every purchase made during this event.\r\n\r\nLimited Time Offer: The Art Supplies Extravaganza is a one-of-a-kind opportunity that won\'t last forever. Act now to fuel your creativity and take advantage of these fantastic offers.\r\n\r\nConvenient and Fast Shipping: We deliver right to your doorstep, ensuring a seamless and hassle-free shopping experience, so you can focus on unleashing your creativity.');

-- --------------------------------------------------------

--
-- Table structure for table `buying`
--

CREATE TABLE `buying` (
  `id` int(20) NOT NULL,
  `ad_id` int(20) DEFAULT NULL,
  `user_id` int(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `response` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(15, 'Arts'),
(16, 'Designs '),
(17, 'Hardware'),
(18, 'Programming');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(20) NOT NULL,
  `user_id` int(20) DEFAULT NULL,
  `post_id` int(20) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `status` int(10) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment`, `status`) VALUES
(2, 34, 11, 'this is good', 1),
(3, 37, 11, 'Awesome', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(20) NOT NULL,
  `category_id` int(20) DEFAULT NULL,
  `posted_by` int(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(10) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `posted_by`, `title`, `image`, `tags`, `description`, `date`, `status`) VALUES
(11, 15, 34, 'Exploring the World of Art', 'images/art-contest.jpg', 'world, art, article', 'Welcome to \"Brushstrokes of Inspiration,\" an art blog dedicated to unlocking the vast realm of creativity and artistic expression. Whether you\'re an avid art enthusiast, an aspiring artist seeking inspiration, or simply curious about the captivating world of art, this blog is your gateway to a diverse and colorful journey.\r\n\r\nDelve into the works of renowned masters and emerging talents across various art forms, from timeless classics to contemporary creations. Discover the stories behind iconic paintings, sculptures, and installations, and explore the cultural, historical, and emotional significance they carry.\r\n\r\nUncover the techniques and secrets that artists employ to breathe life into their visions. From exploring the intricacies of oil painting to the beauty of intricate pencil sketches, we\'ll unravel the tools and methods that shape art\'s mesmerizing tapestry.\r\n\r\nJoin us in celebrating the wonders of artistic expression as we showcase artists from different cultures and backgrounds, shedding light on the transformative power of art in our lives. Whether you seek artistic insights, thought-provoking discussions, or simply wish to immerse yourself in beauty, \"Brushstrokes of Inspiration\" invites you to embark on an unforgettable odyssey through the boundless world of art. Let your creativity soar as we paint vivid strokes of inspiration together.', '2023-07-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(20) NOT NULL,
  `post_id` int(20) DEFAULT NULL,
  `questioner` int(20) DEFAULT NULL,
  `respond_by` int(20) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `stars` int(30) DEFAULT 0,
  `status` int(10) DEFAULT 0,
  `starsgivers` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `post_id`, `questioner`, `respond_by`, `question`, `answer`, `stars`, `status`, `starsgivers`) VALUES
(1, 11, 34, 34, 'Contest Location ?', 'Islamabad', 2, 1, '[\"34\",\"35\"]'),
(3, 11, 37, 35, 'What is Exploring ?', 'Knowing Art', 1, 1, '[\"37\"]');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `phone` varchar(60) DEFAULT NULL,
  `city` varchar(60) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `city`, `role`) VALUES
(34, 'MAH', 'muqadas@gmail.com', 'muqadas', '03104455210', 'Islamabad', 'user'),
(35, 'Admin', 'admin@gmail.com', 'admin', '03451245148', 'Islamabad', 'admin'),
(37, 'Salman', 'salman@yahoo.com', 'salman', '03859685123', 'Gujranwala', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buying`
--
ALTER TABLE `buying`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `buying`
--
ALTER TABLE `buying`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
