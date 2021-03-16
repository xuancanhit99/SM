-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 16, 2021 lúc 11:40 PM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `university`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `isEditor` tinyint(1) NOT NULL,
  `UpdateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `isAdmin`, `isEditor`, `UpdateTime`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 0, '2021-03-13 12:57:52'),
(2, 'editor', '5aee9dbd2a188839105073571bee1b1f', 0, 1, '2021-03-10 22:19:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `ClassName` varchar(80) DEFAULT NULL,
  `ClassNumber` varchar(4) NOT NULL,
  `ClassYear` varchar(5) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `classes`
--

INSERT INTO `classes` (`id`, `ClassName`, `ClassNumber`, `ClassYear`, `CreationDate`, `UpdateTime`) VALUES
(21, 'IKBO', '07', '19', '2021-03-15 15:44:31', '2021-03-15 15:44:31'),
(22, 'IKBO', '03', '20', '2021-03-15 15:44:39', '2021-03-15 15:44:39'),
(23, 'INBO', '01', '21', '2021-03-15 15:44:51', '2021-03-15 15:44:51'),
(24, 'IABO', '25', '19', '2021-03-15 15:44:59', '2021-03-15 15:44:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `ClassID` int(11) DEFAULT NULL,
  `SubjectID` int(11) DEFAULT NULL,
  `Marks` int(11) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdateTime` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `results`
--

INSERT INTO `results` (`id`, `StudentID`, `ClassID`, `SubjectID`, `Marks`, `PostingDate`, `UpdateTime`) VALUES
(5, 7, 21, 16, 100, '2021-03-15 15:50:45', NULL),
(6, 7, 21, 11, 90, '2021-03-15 15:50:45', NULL),
(7, 7, 21, 12, 70, '2021-03-15 15:50:45', NULL),
(8, 7, 21, 15, 90, '2021-03-15 15:50:45', NULL),
(10, 10, 22, 18, 90, '2021-03-15 15:52:07', NULL),
(11, 10, 22, 14, 100, '2021-03-15 15:52:07', NULL),
(12, 10, 22, 12, 80, '2021-03-15 15:52:07', NULL),
(13, 9, 22, 18, 10, '2021-03-15 15:52:20', NULL),
(14, 9, 22, 18, 20, '2021-03-15 15:52:20', NULL),
(15, 9, 22, 14, 30, '2021-03-15 15:52:20', NULL),
(16, 9, 22, 12, 40, '2021-03-15 15:52:20', NULL),
(17, 8, 21, 16, 80, '2021-03-16 22:38:14', NULL),
(18, 8, 21, 11, 90, '2021-03-16 22:38:14', NULL),
(19, 8, 21, 12, 100, '2021-03-16 22:38:14', NULL),
(20, 8, 21, 15, 70, '2021-03-16 22:38:14', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `students`
--

CREATE TABLE `students` (
  `StudentID` int(11) NOT NULL,
  `StudentName` varchar(100) NOT NULL,
  `StudentNo` varchar(100) NOT NULL,
  `StudentEmail` varchar(100) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `DOB` varchar(100) NOT NULL,
  `ClassID` int(11) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateTime` timestamp NULL DEFAULT NULL,
  `Status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `students`
--

INSERT INTO `students` (`StudentID`, `StudentName`, `StudentNo`, `StudentEmail`, `Gender`, `DOB`, `ClassID`, `RegDate`, `UpdateTime`, `Status`) VALUES
(7, 'Xuan Canh', '14001', 'xuancanhit99@gmail.com', 'Male', '1999-09-14', 21, '2021-03-15 15:49:01', NULL, 1),
(8, 'Dinh Cuong', '14002', 'dinhcuong@gmail.com', 'Male', '1999-07-14', 21, '2021-03-15 15:49:30', NULL, 1),
(9, 'Xuan Bach', '14003', 'bachxuan@mail.ru', 'Male', '1999-11-23', 22, '2021-03-15 15:49:58', NULL, 1),
(10, 'Duc Manh', '14004', 'ducmanh@hotmail.com', 'Female', '1999-06-14', 22, '2021-03-15 15:50:29', NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subjectcombination`
--

CREATE TABLE `subjectcombination` (
  `id` int(11) NOT NULL,
  `ClassID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `subjectcombination`
--

INSERT INTO `subjectcombination` (`id`, `ClassID`, `SubjectID`, `status`, `CreationDate`, `UpdateTime`) VALUES
(8, 21, 11, 1, '2021-03-15 15:47:39', '2021-03-15 15:47:39'),
(9, 21, 12, 1, '2021-03-15 15:47:42', '2021-03-15 15:47:42'),
(10, 21, 15, 1, '2021-03-15 15:47:46', '2021-03-15 15:47:46'),
(11, 21, 16, 1, '2021-03-15 15:47:49', '2021-03-15 15:47:49'),
(12, 22, 18, 1, '2021-03-15 15:48:05', '2021-03-15 15:48:05'),
(13, 22, 12, 1, '2021-03-15 15:48:09', '2021-03-15 15:48:09'),
(14, 22, 18, 1, '2021-03-15 15:48:13', '2021-03-15 15:48:13'),
(15, 22, 14, 1, '2021-03-15 15:48:18', '2021-03-15 15:48:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `SubjectName` varchar(100) NOT NULL,
  `SubjectCode` varchar(100) NOT NULL,
  `Creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `subjects`
--

INSERT INTO `subjects` (`id`, `SubjectName`, `SubjectCode`, `Creationdate`, `UpdateTime`) VALUES
(11, 'Maths', '001', '2021-03-15 15:45:46', '2021-03-15 15:45:46'),
(12, 'Physics', '002', '2021-03-15 15:45:55', '2021-03-15 15:45:55'),
(13, 'Economics', '003', '2021-03-15 15:46:35', '2021-03-15 15:46:35'),
(14, 'Physical Education', '004', '2021-03-15 15:46:50', '2021-03-15 15:46:50'),
(15, 'Technology', '005', '2021-03-15 15:47:00', '2021-03-15 15:47:00'),
(16, 'Informatics', '006', '2021-03-15 15:47:10', '2021-03-15 15:47:10'),
(17, 'Engineering', '007', '2021-03-15 15:47:18', '2021-03-15 15:47:18'),
(18, 'History', '008', '2021-03-15 15:47:26', '2021-03-15 15:47:26');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`);

--
-- Chỉ mục cho bảng `subjectcombination`
--
ALTER TABLE `subjectcombination`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `students`
--
ALTER TABLE `students`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `subjectcombination`
--
ALTER TABLE `subjectcombination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
