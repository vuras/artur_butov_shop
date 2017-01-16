-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2017 at 09:55 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artur_butov_shop`
--

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `user_id`, `name`, `category`, `price`, `quantity`, `image_name`, `description`) VALUES
(1, 2, 'Camera', 2, 125.99, 3, 'camera.jpg', 'Impressive camera'),
(2, 3, 'Camera 2', 2, 45, 3, 'camera2.jpg', 'Superb lens'),
(3, 3, 'Hugo Boss', 4, 89.99, 2, 'hugo boss parfume.jpg', 'Excellent'),
(4, 4, 'Jeans', 0, 49.99, 2, 'jeans.jpg', 'Slim fit'),
(5, 4, 'Coat', 0, 60, 1, 'coat.jpg', 'Warm'),
(6, 4, 'iPhone 7', 2, 900, 5, 'iphone7.jpg', 'Slim'),
(7, 4, 'Tricycle', 1, 25, 3, 'toy bicycle.jpg', 'Over 3 years old'),
(8, 4, 'Mario Kart', 1, 35, 2, 'mario.jpg', 'Fast'),
(9, 4, 'Viennie Pooh', 1, 1, 76, 'pooh.jpg', 'Yellow'),
(10, 2, 'Pizza', 3, 8, 15, 'pizza.jpg', 'Delicious');

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `user_id`, `total`) VALUES
(1, 2, 504.95);

--
-- Dumping data for table `purchase_product`
--

INSERT INTO `purchase_product` (`id`, `purchase_id`, `product_id`, `quantity`) VALUES
(1, 1, 3, 3),
(2, 1, 2, 3),
(3, 1, 4, 2);

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'test', 'test', 'test@test.com', 'test@test.com', 1, NULL, '$2y$13$BAjyR1Q0P8u6FQsM0EjonO2iyQbJdjlkPSP976gycsf03wH/4UPZy', '2017-01-16 20:10:17', NULL, NULL, 'a:0:{}'),
(2, 'test2', 'test2', 'test2@test.com', 'test2@test.com', 1, NULL, '$2y$13$lwxSNCKG2HbHuIOaG1Xjb.JTdYvME7qSVAcQiq.G28JVkWEM.zFhK', '2017-01-16 20:38:23', NULL, NULL, 'a:0:{}'),
(3, 'test3', 'test3', 'test3@test.com', 'test3@test.com', 1, NULL, '$2y$13$1qNubQfvEzNL4pKnoS6bpOEdZIt.JxjsYmf/YOnk2MU2wXrky1JMW', '2017-01-16 21:54:39', NULL, NULL, 'a:0:{}'),
(4, 'test4', 'test4', 'test4@test.com', 'test4@test.com', 1, NULL, '$2y$13$xAOvWa20boKJTIBVSo0/zuMsuIvKL2mU6w1/7Z7yHS929rMBQa6LS', '2017-01-16 20:31:31', NULL, NULL, 'a:0:{}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
