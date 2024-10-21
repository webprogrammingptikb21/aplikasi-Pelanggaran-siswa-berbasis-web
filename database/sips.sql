-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2022 at 03:27 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sips`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `teacher_name` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id`, `nik`, `teacher_name`, `subject`) VALUES
(1, 12345678, 'Silfia', 'Fisika'),
(2, 87654321, 'Marita Dwi', 'Kimia'),
(3, 12348765, 'Ahmad ', 'Biologi'),
(4, 43215678, 'Muzamil', 'Fiqih'),
(5, 567854321, 'Agung', 'Ekonomi'),
(6, 123555, 'Rifa\'a', 'Bahasa Arab'),
(7, 11111222, 'Anita Dwi', 'Bahasa Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id` int(11) NOT NULL,
  `wali_name` varchar(50) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `sub_class` enum('X','XI','XII') NOT NULL,
  `total_students` int(11) NOT NULL,
  `total_poin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id`, `wali_name`, `class_name`, `sub_class`, `total_students`, `total_poin`) VALUES
(1, 'Rifa\'a', 'XII IPA', 'XII', 40, 0),
(2, 'Agung', 'XII IPS', 'XII', 40, 0),
(3, 'Ahmad ', 'XI IPS', 'XI', 40, 0),
(4, 'Marita Dwi', 'X IPA', 'X', 40, 0),
(8, 'Silfia', 'X IPS', 'X', 40, 0),
(9, 'Muzamil', 'XI IPA', 'XI', 40, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggaran`
--

CREATE TABLE `tb_pelanggaran` (
  `id` int(11) NOT NULL,
  `nisn` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `wali_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `point` int(11) NOT NULL,
  `reported_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id` int(11) NOT NULL,
  `nisn` int(11) NOT NULL,
  `std_name` varchar(50) NOT NULL,
  `class_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `phone_number` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id`, `nisn`, `std_name`, `class_id`, `address`, `phone_number`) VALUES
(1, 1234, 'Deri Rifanudin', 2, 'Bekasi', 8965665),
(2, 2345, 'Hanif Ilmi', 1, 'Bekasi', 8965665),
(3, 5646, 'Sugiarto', 2, 'Bekasi', 8965665),
(4, 4151, 'Dewi Karina', 3, 'Bekasi', 8965665),
(5, 7611, 'Yuliana', 4, 'Bekasi', 8965665),
(6, 6272, 'Joko Susilo', 3, 'Bekasi', 8965665),
(7, 3556, 'Elevia Shabrina', 4, 'Bekasi', 8965665),
(8, 1254, 'Eko Wahyu', 1, 'Bekasi', 8965665);

-- --------------------------------------------------------

--
-- Table structure for table `tb_tipe_pelanggaran`
--

CREATE TABLE `tb_tipe_pelanggaran` (
  `id` int(11) NOT NULL,
  `violation_name` text NOT NULL,
  `get_point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tipe_pelanggaran`
--

INSERT INTO `tb_tipe_pelanggaran` (`id`, `violation_name`, `get_point`) VALUES
(1, 'Bolos', 10),
(2, 'Baju Tidak Rapi', 4),
(3, 'Rambut Gondrong', 6),
(4, 'Tidur Di Kelas', 8),
(5, 'Berkelahi', 9),
(27, 'asdasdaaaa', 16),
(28, 'asdfasad', 18);

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `level` enum('Admin','Guru','Siswa','Wali') NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `remember_me` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `full_name`, `email`, `username`, `password`, `level`, `status`, `remember_me`) VALUES
(2, 'Ari Setiawan', 'arisetiawan13@gmail.com', 'Admin', '$2y$10$qGtSTKeASa.Z1PZDD7vAcu.IYSukWOmT.DptVS1xxle98ti85Tpdi', 'Admin', 1, 'PuRrF2IySPM5nDZ8NGvbwlYHkFB5O98sgJad7UGW0Q3JHVAjf4ymx7x6YsRcpu96'),
(4, 'Marita Dwi', 'maritaaaa@gmail.com', 'guru', '$2y$10$QX4sC993ZC4fEXiLHamX/.K6FRNxFy4uW6J0gvzxqCxL9.Ibwsgxe', 'Guru', 1, ''),
(6, 'Fadhol Akun Tes', 'madrasahaliyahnegeri@yahoo.com', 'siswa', '$2y$10$0Ombt/DFpbn0YTtdRJ/yDuZ/RabHMTpD8y84n8DFv1JVqfMp9qqdm', 'Siswa', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_wali`
--

CREATE TABLE `tb_wali` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `parent_name` varchar(50) NOT NULL,
  `phone_number` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_wali`
--

INSERT INTO `tb_wali` (`id`, `student_id`, `parent_name`, `phone_number`) VALUES
(1, 1, 'Saubi', 8965665),
(2, 2, 'Saubi', 8965665),
(3, 3, 'Saubi', 8965665),
(4, 4, 'Saubi', 8965665),
(5, 5, 'Saubi', 8965665),
(6, 6, 'Saubi', 8965665),
(7, 7, 'Saubi', 8965665),
(8, 8, 'Saubi', 8965665);

-- --------------------------------------------------------

--
-- Table structure for table `tb_website`
--

CREATE TABLE `tb_website` (
  `id` int(1) NOT NULL,
  `school_name` varchar(50) NOT NULL,
  `point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_website`
--

INSERT INTO `tb_website` (`id`, `school_name`, `point`) VALUES
(1, 'MADRASAH ALIYAH NEGERI', 65);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pelanggaran`
--
ALTER TABLE `tb_pelanggaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `wali_id` (`wali_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `tb_tipe_pelanggaran`
--
ALTER TABLE `tb_tipe_pelanggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_wali`
--
ALTER TABLE `tb_wali`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `tb_website`
--
ALTER TABLE `tb_website`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_pelanggaran`
--
ALTER TABLE `tb_pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_tipe_pelanggaran`
--
ALTER TABLE `tb_tipe_pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_wali`
--
ALTER TABLE `tb_wali`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_website`
--
ALTER TABLE `tb_website`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
