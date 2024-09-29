-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2024 at 12:35 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_ms`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submissions`
--

CREATE TABLE `assignment_submissions` (
  `id` int(11) NOT NULL,
  `deadline_material_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignment_submissions`
--

INSERT INTO `assignment_submissions` (`id`, `deadline_material_id`, `user_id`, `file_path`, `submitted_at`) VALUES
(3, 6, 8, '8_9912070075.png', '2024-07-20 12:23:26'),
(5, 11, 1, '1_3159759979.PNG', '2024-09-02 15:45:27');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Computer Science', 'This is for Computer science ', '2024-07-16 14:17:49'),
(3, 'Programming Fundamentals', 'THis is programming', '2024-07-16 16:14:30'),
(4, 'App development', 'This is App development', '2024-09-01 16:14:43'),
(5, 'Software Engineering', 'This is software Engineering', '2024-09-01 16:15:20');

-- --------------------------------------------------------

--
-- Table structure for table `course_instructor_assigned`
--

CREATE TABLE `course_instructor_assigned` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_instructor_assigned`
--

INSERT INTO `course_instructor_assigned` (`id`, `course_id`, `instructor_id`, `assigned_at`) VALUES
(3, 1, 2, '2024-07-16 18:58:16'),
(4, 3, 2, '2024-07-17 13:11:37'),
(5, 4, 2, '2024-09-02 15:39:14');

-- --------------------------------------------------------

--
-- Table structure for table `course_materials`
--

CREATE TABLE `course_materials` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_materials`
--

INSERT INTO `course_materials` (`id`, `course_id`, `user_id`, `title`, `content`, `file_path`, `created_at`) VALUES
(7, 1, 2, 'Video', 'rauf', '2_4759740800.mp4', '2024-07-18 16:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `course_registration`
--

CREATE TABLE `course_registration` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_registration`
--

INSERT INTO `course_registration` (`id`, `course_id`, `user_id`, `created_at`) VALUES
(1, 1, 1, '2024-07-18 13:17:24'),
(2, 1, 8, '2024-07-20 07:43:24'),
(3, 3, 1, '2024-08-29 09:39:13'),
(4, 4, 1, '2024-09-01 16:21:45');

-- --------------------------------------------------------

--
-- Table structure for table `deadline_materials`
--

CREATE TABLE `deadline_materials` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `type` enum('lecture','assignment','quiz') NOT NULL,
  `content` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deadline_materials`
--

INSERT INTO `deadline_materials` (`id`, `course_id`, `user_id`, `title`, `type`, `content`, `file_path`, `from_date`, `to_date`, `created_at`) VALUES
(4, 1, 2, 'fgfdgsfd g', 'lecture', '23312afdsafdfd', '2_6935292541.pdf', '2024-07-17', '2024-07-26', '2024-07-17 12:47:07'),
(5, 3, 2, 'ghfdhgfdh', 'assignment', 'hgfhfdghgfdh', '2_3915731912.docx', '2024-07-17', '2024-08-15', '2024-07-17 13:12:16'),
(6, 1, 2, 'dsfdsgfdgf', 'assignment', 'fgfdsgertr', '2_2333576706.docx', '2024-07-18', '2024-08-31', '2024-07-18 14:21:15'),
(7, 1, 2, 'Question No:1', 'quiz', 'the question is the like jnkashd jhj  hsdjsahj', '2_3832170304.png', '2024-07-20', '2024-07-25', '2024-07-20 15:49:49'),
(8, 1, 2, 'intro', 'assignment', '', '2_9176491035.PNG', '0000-00-00', '0000-00-00', '2024-09-02 15:22:19'),
(9, 1, 2, 'nnnnn', 'lecture', '', '2_1460978429.PNG', '0000-00-00', '0000-00-00', '2024-09-02 15:23:14'),
(10, 1, 2, 'nnnnn', 'lecture', '', '2_8027407504.PNG', '0000-00-00', '0000-00-00', '2024-09-02 15:27:55'),
(11, 1, 2, 'intro', 'assignment', '', '2_3674525005.PNG', '2024-09-24', '2024-09-27', '2024-09-02 15:28:30'),
(12, 3, 2, 'mmmm', 'lecture', '', '2_2579404865.PNG', '2024-09-01', '2024-09-02', '2024-09-02 15:46:26');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Student'),
(2, 'Instructor'),
(3, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `profile_photo` varchar(256) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `address`, `phone`, `profile_photo`, `password`, `role_id`, `created_at`) VALUES
(1, 'attia', 'student@gmail.com', 'bagh AJK', '03449586953', '1721137070_SCO.png', '$2y$10$cQPzUVw8ZD8K2t2kaVCM6.Hu.wfMX4lu7xbz8OGSDp0OhqIYStS2.', 1, '2024-07-15 19:07:31'),
(2, 'Aqsa123', 'ins@gmail.com', 'Bagh AJK', '03366645807', '1721137054_Python_Libraries_for_Data_Science__1_.jpg', '$2y$10$cQPzUVw8ZD8K2t2kaVCM6.Hu.wfMX4lu7xbz8OGSDp0OhqIYStS2.', 2, '2024-07-15 18:40:09'),
(3, 'Laiba', 'admin@gmail.com', 'bagh AJK', '03449586953', '3_Capture.PNG', '$2y$10$cQPzUVw8ZD8K2t2kaVCM6.Hu.wfMX4lu7xbz8OGSDp0OhqIYStS2.', 3, '2024-07-15 19:07:31'),
(8, 'kaleeem', 'kaleem@gmail.com', '', '', '1721137084_1208507_amazing_gaming_wallpapers_hd_3840x2160.jpg', '$2y$10$KnNvr1GTyeSPzToCCiZTS.25q.KSHj62/jQ8P4oaJHQAqIjztj.De', 1, '2024-07-16 10:18:01'),
(9, 'AsadKhan2', 'asad2@gmail.com', '2 Village Waligai P/O Waligai Tehsel Domail District Bannu', '03362222222', '1721136406_University.png', '$2y$10$XvbEq4V5NY2Z3F.AiiIUNuIDRv85h9vkjEuYrznbRf3nrwoOTC1a2', 2, '2024-07-16 10:19:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deadline_material_id` (`deadline_material_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_instructor_assigned`
--
ALTER TABLE `course_instructor_assigned`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `course_materials`
--
ALTER TABLE `course_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `course_registration`
--
ALTER TABLE `course_registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `deadline_materials`
--
ALTER TABLE `deadline_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
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
-- AUTO_INCREMENT for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_instructor_assigned`
--
ALTER TABLE `course_instructor_assigned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_materials`
--
ALTER TABLE `course_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `course_registration`
--
ALTER TABLE `course_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `deadline_materials`
--
ALTER TABLE `deadline_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  ADD CONSTRAINT `assignment_submissions_ibfk_1` FOREIGN KEY (`deadline_material_id`) REFERENCES `deadline_materials` (`id`),
  ADD CONSTRAINT `assignment_submissions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `course_instructor_assigned`
--
ALTER TABLE `course_instructor_assigned`
  ADD CONSTRAINT `course_instructor_assigned_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_instructor_assigned_ibfk_2` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_materials`
--
ALTER TABLE `course_materials`
  ADD CONSTRAINT `course_materials_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_materials_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_registration`
--
ALTER TABLE `course_registration`
  ADD CONSTRAINT `course_registration_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_registration_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deadline_materials`
--
ALTER TABLE `deadline_materials`
  ADD CONSTRAINT `deadline_materials_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `deadline_materials_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
