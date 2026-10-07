-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 30, 2026 at 05:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apartment_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `leases`
--

CREATE TABLE `leases` (
  `lease_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `lease_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leases`
--

INSERT INTO `leases` (`lease_id`, `tenant_id`, `unit_id`, `start_date`, `end_date`, `lease_status`) VALUES
(1, 1, 1, '2026-01-01', '2026-12-31', 'Active'),
(2, 2, 2, '2026-02-01', '2027-01-31', 'Active'),
(3, 3, 3, '2026-03-01', '2027-02-28', 'Active'),
(4, 4, 4, '2026-04-01', '2027-03-31', 'Active'),
(5, 5, 5, '2026-05-01', '2027-04-30', 'Expired'),
(7, 8, 1, '2026-09-30', '2026-10-29', 'Active'),
(8, 10, 8, '2026-09-18', '2026-09-26', 'Expired');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `lease_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(30) NOT NULL,
  `payment_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `lease_id`, `payment_date`, `amount`, `payment_method`, `payment_status`) VALUES
(1, 1, '2026-09-01', 5000.00, 'Cash', 'Paid'),
(2, 2, '2026-09-02', 5000.00, 'GCash', 'Paid'),
(3, 3, '2026-09-03', 7500.00, 'Bank Transfer', 'Paid'),
(4, 4, '2026-09-04', 5500.00, 'Cash', 'Paid'),
(5, 5, '2026-09-05', 8000.00, 'GCash', 'Paid'),
(8, 7, '2026-09-30', 1111.00, 'Bank Transfer', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `payment_detail_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`payment_detail_id`, `payment_id`, `bill_id`, `amount_paid`) VALUES
(1, 1, 1, 1200.00),
(2, 2, 2, 500.00),
(3, 3, 3, 1500.00),
(4, 4, 4, 600.00),
(5, 5, 5, 1800.00);

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `tenant_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`tenant_id`, `first_name`, `last_name`, `contact_number`, `email`, `address`) VALUES
(1, 'John', 'Santos', '09171234567', 'john@email.com', 'Cabuyao, Laguna'),
(2, 'Maria', 'Reyes', '09181234567', 'maria@email.com', 'Santa Rosa, Laguna'),
(3, 'Carlo', 'Garcia', '09191234567', 'carlo@email.com', 'Biñan, Laguna'),
(4, 'Anna', 'Cruz', '09201234567', 'anna@email.com', 'Calamba, Laguna'),
(5, 'Mark', 'Dela Cruz', '09211234567', 'mark@email.com', 'Cabuyao, Laguna'),
(8, 'Rhian', 'Galang', '091234567810', 'rhian@email.com', 'Cabuyao, Laguna'),
(9, 'Rhian', 'Galang', '091234567810', 'rhian@email.com', 'Cabuyao, Laguna'),
(10, 'Jimuel', 'Galang', '09705498741', 'jimuelgalang8@gmail.com', '404 Purok 5, Marinig, Cabuyao, Laguna');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` int(11) NOT NULL,
  `unit_number` varchar(20) NOT NULL,
  `unit_type` varchar(50) NOT NULL,
  `monthly_rent` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_number`, `unit_type`, `monthly_rent`, `status`) VALUES
(1, 'A-101', 'Single Room', 5000.00, 'Occupied'),
(2, 'A-102', 'Single Room', 5000.00, 'Occupied'),
(3, 'A-103', 'Double Room', 7500.00, 'Occupied'),
(4, 'B-101', 'Single Room', 5500.00, 'Available'),
(5, 'B-102', 'Double Room', 8000.00, 'Available'),
(8, '6', 'Single', 1111.00, 'Available'),
(14, '8', 'Single bedroom', 1500.00, 'Available'),
(15, '9', 'Single bedroom', 1500.00, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `full_name`) VALUES
(1, 'admin', 'admin123', 'Apartment Administrator'),
(2, 'staff01', 'staff123', 'Maria Santos'),
(3, 'staff02', 'staff123', 'Juan Dela Cruz'),
(4, 'staff03', 'staff123', 'Ana Reyes'),
(5, 'staff04', 'staff123', 'Mark Garcia');

-- --------------------------------------------------------

--
-- Table structure for table `utility_bills`
--

CREATE TABLE `utility_bills` (
  `bill_id` int(11) NOT NULL,
  `lease_id` int(11) NOT NULL,
  `utility_type` varchar(30) NOT NULL,
  `billing_month` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `bill_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utility_bills`
--

INSERT INTO `utility_bills` (`bill_id`, `lease_id`, `utility_type`, `billing_month`, `amount`, `bill_status`) VALUES
(1, 1, 'Water', '2026-09-25', 1200.00, 'Paid'),
(2, 2, 'Water', '2026-09-08', 500.00, 'Unpaid'),
(3, 3, 'Electricity', '2026-09-01', 1500.00, 'Unpaid'),
(4, 4, 'Water', '2026-09-01', 600.00, 'Paid'),
(5, 5, 'Electricity', '2026-09-01', 1800.00, 'Unpaid');

--
-- Indexes for dumped tables
--


CREATE TABLE archive (
    archive_id INT(11) NOT NULL AUTO_INCREMENT,
    record_type VARCHAR(50) NOT NULL,
    record_id INT(11) NOT NULL,
    record_details TEXT NOT NULL,
    archived_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (archive_id)
);


--
-- Indexes for table `leases`
--
ALTER TABLE `leases`
  ADD PRIMARY KEY (`lease_id`),
  ADD KEY `tenant_id` (`tenant_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `lease_id` (`lease_id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`payment_detail_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `bill_id` (`bill_id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`tenant_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`),
  ADD UNIQUE KEY `unit_number` (`unit_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `utility_bills`
--
ALTER TABLE `utility_bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `lease_id` (`lease_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leases`
--
ALTER TABLE `leases`
  MODIFY `lease_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `payment_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `tenant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `utility_bills`
--
ALTER TABLE `utility_bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leases`
--
ALTER TABLE `leases`
  ADD CONSTRAINT `leases_ibfk_1` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`tenant_id`),
  ADD CONSTRAINT `leases_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`lease_id`) REFERENCES `leases` (`lease_id`);

--
-- Constraints for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`),
  ADD CONSTRAINT `payment_details_ibfk_2` FOREIGN KEY (`bill_id`) REFERENCES `utility_bills` (`bill_id`);

--
-- Constraints for table `utility_bills`
--
ALTER TABLE `utility_bills`
  ADD CONSTRAINT `utility_bills_ibfk_1` FOREIGN KEY (`lease_id`) REFERENCES `leases` (`lease_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

