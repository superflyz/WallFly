-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Sep 03, 2015 at 03:12 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `chatdate` date NOT NULL,
  `msg` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `username`, `chatdate`, `msg`) VALUES
(1, 'aaa', '2015-03-29', 'aaaa'),
(2, 'admin', '2015-03-30', 'Test'),
(3, 'owner', '2015-03-30', 'Test'),
(4, 'tenant', '0000-00-00', 'test'),
(5, 'agent', '0000-00-00', 'asas'),
(6, 'admin', '0000-00-00', 'asdfasdf'),
(7, 'asdfasdf', '2015-03-30', 'asdf'),
(8, 'aaa', '2015-03-30', 'gkdjkjf'),
(9, 'aaa', '2015-03-30', 'jkshdjkfhsd'),
(10, 'Test', '2015-03-30', 'hello'),
(11, 'Test', '2015-03-30', 'this is so COOOL !!!'),
(12, 'aa', '2015-03-31', 'good'),
(13, 'asas', '2015-03-31', 'skgjekdlg'),
(14, 'Test', '2015-04-02', 'Test'),
(15, 'MyName', '2015-04-30', 'test'),
(16, '', '2015-05-11', 'hello'),
(17, '', '2015-05-11', 'hi this is me');

-- --------------------------------------------------------

--
-- Table structure for table `inspection`
--

CREATE TABLE `inspection` (
  `inspection_id` int(100) NOT NULL,
  `inspection_date` varchar(10) NOT NULL,
  `tenant_id` varchar(20) NOT NULL,
  `tenant_fname` varchar(20) NOT NULL,
  `tenant_lname` varchar(20) NOT NULL,
  `inspector` varchar(20) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `property_id` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inspection`
--

INSERT INTO `inspection` (`inspection_id`, `inspection_date`, `tenant_id`, `tenant_fname`, `tenant_lname`, `inspector`, `comment`, `property_id`) VALUES
(2, '01-06-2015', 'alex', 'Alex', 'Liu', 'agent', 'Good condition', '93'),
(3, '02-06-2015', 'alex', 'Alex', 'Liu', 'agent', 'Bad condition', '93'),
(4, '03-06-2015', 'alex', 'Alex', 'Liu', 'agent', 'Broken door', '93'),
(5, '02-06-2015', 'ben', 'Ben', 'Park', 'agent', 'good condition', '106'),
(6, '02-06-2015', 'ben', 'Ben', 'Park', 'agent', 'Test', '107'),
(7, '02-06-2015', 'ben', 'Ben', 'Park', 'agent', 'test', '109'),
(8, '02-06-2015', 'ben', 'Ben', 'Park', 'agent', 'test', '110'),
(9, '02-06-2015', 'ben', 'Ben', 'Park', 'agent', 'test', '112'),
(10, '09-06-2015', 'ben', 'Ben', 'Park', 'agent', 'Good condition', '112'),
(11, '19-06-2015', 'john', 'john', '', 'ecosys', '', '117'),
(12, '10-06-2015', 'john_test', 'John', 'Lee', 'ecosys', 'Bad Conditions', '118'),
(13, '11-06-2015', 'my5082', 'Matthew', 'Shin', 'ecosys', 'Terrible', '120'),
(14, '12-06-2015', 'testing', 'John', 'Doe', 'ecosys', 'bad tenant', '121'),
(15, '20-06-2015', 'soobin', 'Soobin', '', 'ecosys', 'bad', '122');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pay_id` int(255) NOT NULL,
  `property` varchar(255) NOT NULL,
  `payment_date` varchar(10) NOT NULL,
  `tenant_id` varchar(20) NOT NULL,
  `tenant_fname` varchar(20) NOT NULL,
  `tenant_lname` varchar(20) NOT NULL,
  `amount` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`pay_id`, `property`, `payment_date`, `tenant_id`, `tenant_fname`, `tenant_lname`, `amount`) VALUES
(26, '73', '13-04-2015', 'tenant', 'Helen', 'Shin', '500'),
(31, '77', '14-05-2015', '123', 'sumanto', 'jaln', '10000'),
(59, '112', '02-06-2015', 'ben', 'Ben', 'Park', '500'),
(60, '112', '03-06-2015', 'ben', 'Ben', 'Park', '500'),
(62, '118', '10-06-2015', 'john_test', 'John', 'Lee', '500'),
(63, '112', '10-06-2015', 'ben', 'Ben', 'Park', '500'),
(64, '120', '11-06-2015', 'my5082', 'Matthew', 'Shin', '500'),
(65, '121', '13-06-2015', 'testing', 'John', 'Doe', '2000'),
(66, '122', '25-06-2015', 'soobin', 'Soobin', '', '500');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `property_id` int(11) NOT NULL,
  `owner_id` varchar(20) NOT NULL,
  `agent_id` varchar(20) NOT NULL,
  `tenant_id` varchar(20) NOT NULL,
  `owner_fname` varchar(20) NOT NULL,
  `owner_lname` varchar(20) NOT NULL,
  `tenant_fname` varchar(20) NOT NULL,
  `tenant_lname` varchar(20) NOT NULL,
  `property_agent` varchar(20) NOT NULL,
  `contact_owner` varchar(20) NOT NULL,
  `contact_agent` varchar(20) NOT NULL,
  `contact_tenant` varchar(20) NOT NULL,
  `property_street` varchar(20) NOT NULL,
  `property_suburb` varchar(20) NOT NULL,
  `property_state` varchar(4) NOT NULL,
  `property_postcode` text NOT NULL,
  `image` varchar(100) NOT NULL DEFAULT 'img/properties/default.jpg',
  `user_id` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`property_id`, `owner_id`, `agent_id`, `tenant_id`, `owner_fname`, `owner_lname`, `tenant_fname`, `tenant_lname`, `property_agent`, `contact_owner`, `contact_agent`, `contact_tenant`, `property_street`, `property_suburb`, `property_state`, `property_postcode`, `image`, `user_id`) VALUES
(112, 'daniel', 'agent', 'ben', 'Daniel', 'Chung', 'Ben', 'Park', 'Agent', '0000000000', '1231415', '0123123122', '1 Test St', 'Test', 'QLD', '1111', 'img/properties/0w77ivcyen', 'agent'),
(118, 'daniel', 'ecosys', 'john_test', 'Daniel', '', 'John', 'Lee', 'Informations Ecosyst', '0411 256 849', '07 4562 4568', '0414 204 503', '1 Test Street', 'Test', 'QLD', '1111', 'img/properties/default_banner.gif', 'ecosys'),
(119, 'Leon', '12', '13', 'Leon', 'Teh', 'Gary', 'Foo', 'Jim Steel', 'Leon', 'Gary', 'Suzy', '12 Street', 'Toowong', 'qld', '4066', 'img/properties/default_banner.gif', 'Leon'),
(120, 'daniel', 'ecosys', 'my5082', 'Daniel', '', 'Matthew', 'Shin', 'Information Ecosyste', '0411256849', '0745624568', '0414204503', '1 Test St', 'Test', 'QLD', '1111', 'img/properties/default_banner.gif', 'ecosys'),
(121, 'hj', 'ecosys', 'testing', 'Hungry', 'Jack', 'John', 'Doe', 'Information Ecosyste', '', '', '', '1 Test Street', 'Test', 'QLD', '1111', 'img/properties/default_banner.gif', 'ecosys'),
(122, 'Daniel', 'ecosys', 'soobin', 'Daniel', '', 'Soobin', '', 'Emerging', '5214521412', '852852', '112', 'hahah', 'east', 'nsw', '1234', 'img/properties/default_banner.gif', 'ecosys'),
(123, 'anowner', 'anagentid', 'atenantid', 'an', 'owner', 'a', 'tenant', 'an agent', '12345123', '12345123', '12345123', '123', 'city', 'qld', '1234', 'img/properties/pqj4xq7swu', 'anowner'),
(124, 'anowner', 'anagent', 'atenant', 'an', 'owner', 'a', 'tenant', 'anagent', '12345123', '12345123', '12345123', '123', 'city', 'qld', '1234', 'img/properties/default_banner.gif', 'anagent');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privilege` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `privilege`, `email`, `first_name`, `last_name`) VALUES
(1, 'admin', 'password', 'ADMIN', 'sdhwa92@gmail.com', 'Tim', 'Seo'),
(2, 'owner', 'password', 'OWNER', 'dlong03111994@gmail.com', 'Darryl', 'Long'),
(3, 'agent', 'password', 'AGENT', 'steven_31194@hotmail.com', 'Steven', 'Hsu'),
(4, 'tenant', 'password', 'TENANT', 'y5b1hs1j@gmail.com', 'Helen', 'Shin'),
(5, 'testuser1', 'password', 'TENANT', 'oyi9220@gmail.com', 'Lucy', 'Oh'),
(6, 'testuser2', 'password', 'AGENT', 'adilet.tursyn@uqconnect.edu.au', 'Adi', 'Tursyn'),
(7, 'testuser3', 'password', 'OWNER', 'ziva-reiko@hotmail.com', 'Ziva', 'Reiko'),
(8, 'tenant02', 'password', 'TENANT', 'ricChoi@test.com', 'Eric', 'Choi'),
(9, 'testuser4', 'password', 'TENANT', 'david@test.com', 'David', 'Kim'),
(10, 'testuser5', 'password', 'AGENT', 'kelvin@test.com', 'Kelvin', 'Lee'),
(14, '123', '123', 'TENANT', 'lol@lol.com', '123', '123'),
(15, 'geralt', 'triss', 'OWNER', 'geralt@witcher.com', 'Geralt', 'of Rivia'),
(16, 'andrew', 'hello1', 'TENANT', 'andrew.dyer@uqconnect.edu.au', 'Andrew', 'Dyer'),
(17, 'andrewO', 'hello1', 'AGENT', 'andrew.dyer@uqconnect.edu.au', 'Andrew', 'Dyer'),
(18, 'andrew2', 'hello1', 'OWNER', 'andrew.dyer@uqconnect.edu.au', 'Andrew', 'Dyer'),
(19, 'a', 'b', 'OWNER', 'ab', 'a', 'b'),
(20, 'david', 'password', 'OWNER', 'david@cc.cc', 'David', 'Kim'),
(21, 'ben', 'password', 'TENANT', 'ben@cc.cc', 'Ben', 'Park'),
(22, 'alex', 'password', 'TENANT', 'ak@dk.ek', 'alex', 'liu'),
(23, 'daniel', 'password', 'OWNER', 'daniel@cc.com', 'Daniel', 'Chung'),
(24, '', '', 'AGENT', '', '', ''),
(25, 'Helen', 'haha', 'TENANT', 'dfhkdfhdk', 'helen', 'shin'),
(26, 'ecosys', '1234', 'AGENT', 'info@ecosys.com.au', 'James', ''),
(28, 'john_test', 'test1234', 'TENANT', 'jayden77.lee@gmail.com', 'John', 'Lee'),
(29, 'Leon', 'password', 'OWNER', 'leonxenarax@gmail.com', 'Leon', 'Teh'),
(30, 'my5082', '1q2w3e4r', 'TENANT', 'my5082@gmail.com', 'Matthew', 'Shin'),
(31, 'testing', 'testing', 'TENANT', 'so10what@hotmail.com', 'John', 'Doe'),
(32, 'soobin', 'son', 'TENANT', 'soobin@gmail.com', 'son', 'soobin'),
(33, 'anowner', 'password', 'OWNER', 'anowner@example.com', 'an', 'owner'),
(34, 'anagent', 'password', 'AGENT', 'anagent@example.com', 'an', 'agent'),
(35, 'helloworld', 'sha256:1000:tGPky+xJTcDf02sHZGCJJJPzuzwIIoM/:cAqiPqfrAFT0sCAQM7xd2ddLeeW878QG', 'AGENT', 'hello@example.com', 'hello', 'world');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `inspection`
--
ALTER TABLE `inspection`
  ADD PRIMARY KEY (`inspection_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `inspection`
--
ALTER TABLE `inspection`
  MODIFY `inspection_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pay_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;