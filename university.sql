-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 13, 2021 lúc 02:51 PM
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
(1, 'IKBO', '7', '19', '2021-03-02 10:57:24', '0000-00-00 00:00:00'),
(2, 'INBO', '3', '19', '2021-03-02 11:00:26', '0000-00-00 00:00:00'),
(3, 'IABO', '09', 'C', '2021-03-02 11:01:47', '0000-00-00 00:00:00'),
(4, 'IKBO', '719', '1', '2021-03-03 23:26:54', '0000-00-00 00:00:00'),
(5, 'a', '1', '213', '2021-03-06 18:14:07', '0000-00-00 00:00:00'),
(6, 'b', '1123', 'qwe', '2021-03-06 18:14:15', '0000-00-00 00:00:00'),
(7, 'qw', '12', '4123', '2021-03-06 18:14:19', '0000-00-00 00:00:00'),
(8, '12', '4123', '123', '2021-03-06 18:14:22', '0000-00-00 00:00:00'),
(9, '123', '4123', '21312', '2021-03-06 18:14:25', '0000-00-00 00:00:00'),
(10, '123213', '4124', '12312', '2021-03-06 18:14:28', '0000-00-00 00:00:00'),
(11, '123123', '4124', '123', '2021-03-06 18:14:31', '0000-00-00 00:00:00'),
(12, '12323', '4441', '123', '2021-03-06 18:14:36', '0000-00-00 00:00:00'),
(13, '11', '22', '22', '2021-03-06 18:14:40', '0000-00-00 00:00:00'),
(14, '11', '223', '444', '2021-03-06 18:14:45', '0000-00-00 00:00:00'),
(15, '1', '213', '4', '2021-03-06 18:17:31', '0000-00-00 00:00:00'),
(16, '13124', '1231', '123', '2021-03-06 18:18:08', '0000-00-00 00:00:00'),
(17, '123111', '11', '1', '2021-03-06 18:18:18', '0000-00-00 00:00:00'),
(18, 'IBKO', '09', '21', '2021-03-13 10:07:38', '2021-03-13 10:07:38'),
(19, 'INBO', '20', '21', '2021-03-13 10:21:35', '2021-03-13 10:21:35'),
(20, 'IIIO', '1', '21', '2021-03-13 12:24:50', '2021-03-13 12:24:50');

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
(1, 1, 1, 1, 100, '2021-03-02 11:03:34', '2021-03-09 16:38:40'),
(2, 3, 1, 3, 123, '2021-03-13 12:24:07', NULL),
(3, 3, 1, 1, 123, '2021-03-13 12:24:07', NULL),
(4, 5, 20, 10, 1235123, '2021-03-13 12:29:04', NULL);

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
(1, 'Xuan canh', '12345', 'xuancanhit99@gmail.com', 'Male', '2021-12-12', 1, '2021-03-02 11:02:56', NULL, 1),
(2, 'qweqwe', '12312', 'xuancanhit99qwewqe@gmail.com', 'Male', '2021-02-01', 8, '2021-03-09 16:37:05', NULL, 1),
(3, 'asd', '12312', 'tranthuhoarwerewrn@gmail.com', 'Male', '1999-03-12', 1, '2021-03-13 12:00:46', NULL, 1),
(4, 'HiLeo', '12345', 'x@mail.ru', 'Male', '5123-12-13', 1, '2021-03-13 12:25:20', NULL, 1),
(5, 'aaaaaaaaa', '1', 'a@gmai.com', 'Male', '1999-12-12', 20, '2021-03-13 12:28:53', NULL, 1);

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
(1, 1, 1, 1, '2021-03-02 10:59:06', '2021-03-02 10:59:06'),
(2, 2, 2, 1, '2021-03-02 11:02:04', '2021-03-02 11:02:04'),
(3, 2, 2, 1, '2021-03-06 18:52:52', '2021-03-06 18:52:52'),
(4, 1, 3, 1, '2021-03-09 16:28:46', '2021-03-09 16:28:46'),
(5, 19, 1, 1, '2021-03-13 10:38:08', '2021-03-13 10:38:08'),
(6, 3, 3, 1, '2021-03-13 11:13:17', '2021-03-13 11:13:17'),
(7, 20, 10, 1, '2021-03-13 12:27:50', '2021-03-13 12:27:50');

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
(1, 'Math9', '0901', '2021-03-02 10:58:25', '0000-00-00 00:00:00'),
(2, 'Physical', '002', '2021-03-02 10:58:38', '0000-00-00 00:00:00'),
(3, 'English', '003', '2021-03-02 10:58:46', '0000-00-00 00:00:00'),
(4, 'Lasd', '21', '2021-03-06 18:29:02', '0000-00-00 00:00:00'),
(5, '123', '123', '2021-03-06 18:29:14', '0000-00-00 00:00:00'),
(6, '1', '1', '2021-03-06 18:29:21', '0000-00-00 00:00:00'),
(7, '3123', '123123', '2021-03-06 18:30:42', '0000-00-00 00:00:00'),
(8, '1231231231231', '123123213231', '2021-03-06 18:31:51', '0000-00-00 00:00:00'),
(9, 'Material', '123', '2021-03-13 10:25:27', '2021-03-13 10:25:27'),
(10, 'Leo', '1235', '2021-03-13 12:24:58', '2021-03-13 12:24:58');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `students`
--
ALTER TABLE `students`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `subjectcombination`
--
ALTER TABLE `subjectcombination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
