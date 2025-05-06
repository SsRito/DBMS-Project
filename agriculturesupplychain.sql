-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2025 at 06:03 PM
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
-- Database: `agriculturesupplychain`
--

-- --------------------------------------------------------

--
-- Table structure for table `crop`
--

CREATE TABLE `crop` (
  `cropID` varchar(15) NOT NULL,
  `cropName` varchar(50) NOT NULL,
  `harvestedDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crop`
--

INSERT INTO `crop` (`cropID`, `cropName`, `harvestedDate`) VALUES
('C-Jackfruit-010', 'Jackfruit', '2024-07-05'),
('C-Jute-003', 'Jute', '2024-08-10'),
('C-Maize-007', 'Maize', '2025-04-05'),
('C-Mango-009', 'Mango', '2024-06-10'),
('C-Mustard-006', 'Mustard', '2025-01-30'),
('C-Onion-008', 'Onion', '2025-03-20'),
('C-Potato-004', 'Potato', '2025-02-25'),
('C-Rice-001', 'Rice', '2025-04-15'),
('C-Rice-002', 'Rice', '2024-11-20'),
('C-Wheat-005', 'Wheat', '2025-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `crop_batch`
--

CREATE TABLE `crop_batch` (
  `batchID` varchar(10) NOT NULL,
  `expiaryDate` date DEFAULT NULL,
  `processingDate` date DEFAULT NULL,
  `standardGradeID` varchar(30) NOT NULL,
  `packageID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crop_batch`
--

INSERT INTO `crop_batch` (`batchID`, `expiaryDate`, `processingDate`, `standardGradeID`, `packageID`) VALUES
('B0001', '2025-10-15', '2025-04-20', 'SG0001', 'P0001'),
('B0002', '2025-05-20', '2024-11-25', 'SG0002', 'P0001'),
('B0003', '2026-08-10', '2024-08-15', 'SG0003', 'P0002'),
('B0004', '2025-08-25', '2025-03-01', 'SG0004', 'P0003'),
('B0005', '2025-09-12', '2025-03-15', 'SG0005', 'P0002'),
('B0006', '2025-07-30', '2025-02-05', 'SG0006', 'P0004'),
('B0007', '2025-10-05', '2025-04-10', 'SG0007', 'P0002'),
('B0008', '2025-09-20', '2025-03-25', 'SG0008', 'P0003'),
('B0009', '2024-09-10', '2024-06-15', 'SG0009', 'P0007'),
('B0010', '2024-10-05', '2024-07-10', 'SG0010', 'P0007');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `deliveryID` varchar(10) NOT NULL,
  `location` varchar(100) NOT NULL,
  `dateTime` datetime NOT NULL,
  `batchID` varchar(10) NOT NULL,
  `vendorLicense` varchar(10) NOT NULL,
  `vehicleID` varchar(10) NOT NULL,
  `warehouseID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`deliveryID`, `location`, `dateTime`, `batchID`, `vendorLicense`, `vehicleID`, `warehouseID`) VALUES
('D0001', 'Kawran Bazar, Dhaka', '2025-04-22 14:00:00', 'B0001', 'VL0001', 'V0001', 'WH001'),
('D0002', 'Reazuddin Bazar, Chittagong', '2025-03-06 09:00:00', 'B0004', 'VL0002', 'V0002', 'WH002'),
('D0003', 'Gollamari Market, Khulna', '2025-04-12 16:00:00', 'B0007', 'VL0003', 'V0003', 'WH003'),
('D0004', 'Bandarbazar, Sylhet', '2024-06-17 17:00:00', 'B0009', 'VL0004', 'V0004', 'WH004'),
('D0005', 'Shaheb Bazar, Rajshahi', '2025-02-07 15:00:00', 'B0006', 'VL0006', 'V0005', 'WH005');

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `farmerID` char(5) NOT NULL,
  `farmerName` varchar(50) NOT NULL,
  `contactInfo` varchar(11) DEFAULT NULL,
  `f_district` varchar(50) DEFAULT NULL,
  `f_union` varchar(50) DEFAULT NULL,
  `f_village` varchar(50) DEFAULT NULL,
  `f_zip_code` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`farmerID`, `farmerName`, `contactInfo`, `f_district`, `f_union`, `f_village`, `f_zip_code`) VALUES
('F0001', 'Abdul Rahman', '01712345678', 'Dhaka', 'Savar', 'Ashulia', '1340'),
('F0002', 'Nasreen Begum', '01823456789', 'Rajshahi', 'Paba', 'Katakhali', '6201'),
('F0003', 'Mohammed Karim', '01934567890', 'Khulna', 'Dumuria', 'Sharafpur', '9252'),
('F0004', 'Fatima Khatun', '01645678901', 'Sylhet', 'Golapganj', 'Lakshmipur', '3161'),
('F0005', 'Jamal Hossain', '01756789012', 'Chittagong', 'Patiya', 'Kusumpura', '4371'),
('F0006', 'Sharmin Akter', '01867890123', 'Mymensingh', 'Gouripur', 'Ramgopalpur', '2271'),
('F0007', 'Rafiq Islam', '01978901234', 'Barisal', 'Babuganj', 'Rahamtpur', '8216'),
('F0008', 'Taslima Begum', '01689012345', 'Comilla', 'Burichang', 'Mokam', '3520'),
('F0009', 'Habibur Rahman', '01790123456', 'Rangpur', 'Pirganj', 'Kholeya', '5470'),
('F0010', 'Salma Akhter', '01601234567', 'Dinajpur', 'Birampur', 'Katla', '5266');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_crop`
--

CREATE TABLE `farmer_crop` (
  `farmerCropID` char(5) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `season` varchar(50) DEFAULT NULL,
  `cropID` varchar(15) NOT NULL,
  `farmerID` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer_crop`
--

INSERT INTO `farmer_crop` (`farmerCropID`, `quantity`, `season`, `cropID`, `farmerID`) VALUES
('FC001', 2500.00, 'Boro', 'C-Rice-001', 'F0001'),
('FC002', 1800.00, 'Aman', 'C-Rice-002', 'F0002'),
('FC003', 750.00, 'Kharif', 'C-Jute-003', 'F0003'),
('FC004', 3200.00, 'Rabi', 'C-Potato-004', 'F0004'),
('FC005', 1200.00, 'Rabi', 'C-Wheat-005', 'F0005'),
('FC006', 900.00, 'Rabi', 'C-Mustard-006', 'F0006'),
('FC007', 1700.00, 'Rabi', 'C-Maize-007', 'F0007'),
('FC008', 2100.00, 'Rabi', 'C-Onion-008', 'F0008'),
('FC009', 1500.00, 'Summer', 'C-Mango-009', 'F0009'),
('FC010', 2000.00, 'Summer', 'C-Jackfruit-010', 'F0010'),
('FC011', 1600.00, 'Boro', 'C-Rice-001', 'F0005'),
('FC012', 1400.00, 'Aman', 'C-Rice-002', 'F0007');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_crop_type`
--

CREATE TABLE `farmer_crop_type` (
  `cropTypeID` varchar(30) NOT NULL,
  `cropType` varchar(50) NOT NULL,
  `farmerCropID` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer_crop_type`
--

INSERT INTO `farmer_crop_type` (`cropTypeID`, `cropType`, `farmerCropID`) VALUES
('CT-Jackfruit-Khaja-010', 'Khaja Jackfruit', 'FC010'),
('CT-Jute-Tossa-003', 'Tossa Jute', 'FC003'),
('CT-Maize-BARI Hybrid-007', 'BARI Hybrid Maize-9', 'FC007'),
('CT-Mango-Fazli-009', 'Fazli Mango', 'FC009'),
('CT-Mustard-BARI-006', 'BARI Sarisha-14', 'FC006'),
('CT-Onion-BARI Piaz-008', 'BARI Piaz-1', 'FC008'),
('CT-Potato-Cardinal-004', 'Cardinal Potato', 'FC004'),
('CT-Rice-BIRRI29-011', 'BRRI Dhan 29', 'FC011'),
('CT-Rice-BIRRI39-012', 'BRRI Dhan 39', 'FC012'),
('CT-Rice-BRRI28-001', 'BRRI Dhan 28', 'FC001'),
('CT-Rice-BRRI34-002', 'BRRI Dhan 34', 'FC002'),
('CT-Wheat-Shatabdi-005', 'Shatabdi Wheat', 'FC005');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_crop_type_grade`
--

CREATE TABLE `farmer_crop_type_grade` (
  `standardGradeID` varchar(30) NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `cropGrade` varchar(1) NOT NULL,
  `criteria_size` decimal(10,2) DEFAULT NULL,
  `criteria_shape` varchar(50) DEFAULT NULL,
  `criteria_colour` varchar(50) DEFAULT NULL,
  `criteria_infestation` tinyint(1) DEFAULT NULL,
  `cropTypeID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer_crop_type_grade`
--

INSERT INTO `farmer_crop_type_grade` (`standardGradeID`, `quantity`, `cropGrade`, `criteria_size`, `criteria_shape`, `criteria_colour`, `criteria_infestation`, `cropTypeID`) VALUES
('SG0001', 2000.00, 'A', 5.50, 'Uniform', 'Golden', 0, 'CT-Rice-BRRI28-001'),
('SG0002', 1500.00, 'B', 5.20, 'Slightly Variable', 'Light Brown', 0, 'CT-Rice-BRRI34-002'),
('SG0003', 700.00, 'A', 2.80, 'Long', 'Golden Brown', 0, 'CT-Jute-Tossa-003'),
('SG0004', 2800.00, 'A', 8.50, 'Round', 'Brown', 0, 'CT-Potato-Cardinal-004'),
('SG0005', 1000.00, 'B', 3.80, 'Oval', 'Amber', 0, 'CT-Wheat-Shatabdi-005'),
('SG0006', 850.00, 'A', 2.10, 'Round', 'Black', 0, 'CT-Mustard-BARI-006'),
('SG0007', 1600.00, 'A', 9.00, 'Cylindrical', 'Yellow', 0, 'CT-Maize-BARI Hybrid-007'),
('SG0008', 1900.00, 'B', 6.50, 'Round', 'Red', 0, 'CT-Onion-BARI Piaz-008'),
('SG0009', 1400.00, 'A', 12.00, 'Oval', 'Green-Yellow', 0, 'CT-Mango-Fazli-009'),
('SG0010', 1800.00, 'A', 25.00, 'Oblong', 'Green', 0, 'CT-Jackfruit-Khaja-010'),
('SG0011', 1400.00, 'A', 5.60, 'Uniform', 'Golden', 0, 'CT-Rice-BIRRI29-011'),
('SG0012', 1200.00, 'B', 5.00, 'Variable', 'Brown', 0, 'CT-Rice-BIRRI39-012');

-- --------------------------------------------------------

--
-- Table structure for table `graded_p_track`
--

CREATE TABLE `graded_p_track` (
  `trackID` varchar(50) NOT NULL,
  `standardGradeID` varchar(50) NOT NULL,
  `warehouseID` varchar(50) NOT NULL,
  `cropGrade` varchar(50) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `graded_p_track`
--

INSERT INTO `graded_p_track` (`trackID`, `standardGradeID`, `warehouseID`, `cropGrade`, `location`) VALUES
('TR0001', 'SG0004', 'WH002', 'A', 'Chittagong Port Area'),
('TR0002', 'SG0006', 'WH005', 'A', 'Mymensingh Agricultural Zone'),
('TR0003', 'SG0007', 'WH003', 'A', 'Khulna\r\n'),
('TR0004', 'SG0001', 'WH001', 'A', 'Dhaka\r\n'),
('TR0005', 'SG0009', 'WH004', 'A', 'Sylhet'),
('TRK006', 'SG0002', 'WH004', 'B', 'Rajshahi');

-- --------------------------------------------------------

--
-- Table structure for table `grading_details`
--

CREATE TABLE `grading_details` (
  `past_problem` varchar(300) NOT NULL,
  `present_situation` varchar(1000) NOT NULL,
  `changes` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grading_details`
--

INSERT INTO `grading_details` (`past_problem`, `present_situation`, `changes`) VALUES
('Improper or Inadequate Packaging Materials: Use of non-durable or non-food-grade materials.', 'Better-designed packaging solutions (e.g., ventilated crates, shock-absorbing boxes) are more common. But affordability remains a barrier', 'Demand for eco-friendly, export-compliant, and protective packaging is rising.'),
('Lack of Infrastructure: Absence of proper grading centers or quality control labs.', 'Increase in government and private sector-run grading centers, especially near major markets. Still inadequate in remote areas.', 'Digital transformation is slowly penetrating agriculture, especially in export-oriented or industrialized farming sectors.');

-- --------------------------------------------------------

--
-- Table structure for table `inspector_records`
--

CREATE TABLE `inspector_records` (
  `record_id` char(6) NOT NULL,
  `inspector_name` varchar(80) DEFAULT NULL,
  `batchID` varchar(50) DEFAULT NULL,
  `standardGradeID` varchar(50) DEFAULT NULL,
  `packageID` varchar(50) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inspector_records`
--

INSERT INTO `inspector_records` (`record_id`, `inspector_name`, `batchID`, `standardGradeID`, `packageID`, `remarks`) VALUES
('INS001', 'Tasin Uddin', 'B0001', 'SG0001', 'P0001', 'Good'),
('INS002', 'Rahim Uddin', 'B0002', 'SG0002', 'P0002', 'Excellent');

-- --------------------------------------------------------

--
-- Table structure for table `packaging`
--

CREATE TABLE `packaging` (
  `packageID` char(5) NOT NULL,
  `packagingDescription` varchar(100) DEFAULT NULL,
  `materialType` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packaging`
--

INSERT INTO `packaging` (`packageID`, `packagingDescription`, `materialType`) VALUES
('P0001', '50kg Jute Sack', 'Jute'),
('P0002', '25kg PP Woven Bag', 'Polypropylene'),
('P0003', '20kg Plastic Crate', 'HDPE Plastic'),
('P0004', '10kg Cardboard Box', 'Corrugated Cardboard'),
('P0005', '5kg Net Bag', 'Mesh Netting'),
('P0006', '1kg Consumer Pack', 'LDPE Plastic'),
('P0007', '30kg Wooden Crate', 'Treated Wood'),
('P0008', '40kg Jute-HDPE Composite Bag', 'Jute-Plastic Composite');

-- --------------------------------------------------------

--
-- Table structure for table `packaging_tracking`
--

CREATE TABLE `packaging_tracking` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `batch_number` varchar(50) NOT NULL,
  `pack_date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packaging_tracking`
--

INSERT INTO `packaging_tracking` (`id`, `product_name`, `batch_number`, `pack_date`, `location`, `created_at`) VALUES
(1, 'P0001', 'B0001', '2025-04-04', 'Bangladesh', '2025-04-24 15:50:21'),
(5, 'P0002', 'B0002', '2025-04-26', 'Japan', '2025-04-25 12:36:49');

-- --------------------------------------------------------

--
-- Table structure for table `retailer`
--

CREATE TABLE `retailer` (
  `rvendorLicense` char(6) NOT NULL,
  `v_name` varchar(50) NOT NULL,
  `v_contactInfo` varchar(11) DEFAULT NULL,
  `v_location` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `retailer`
--

INSERT INTO `retailer` (`rvendorLicense`, `v_name`, `v_contactInfo`, `v_location`) VALUES
('VL0001', 'Dhaka Agro Suppliers', '01912345678', 'Dhaka'),
('VL0003', 'Bangla Fresh Foods', '01734567890', 'Khulna'),
('VL0004', 'Sylhet Organic Marketplace', '01645678901', 'Sylhet'),
('VL0006', 'Rajshahi Farmers Market', '01967890123', 'Rajshahi'),
('VL0008', 'Rangpur Krishi Bazar', '01789012345', 'Rangpur');

-- --------------------------------------------------------

--
-- Table structure for table `sensor`
--

CREATE TABLE `sensor` (
  `sensorID` char(5) NOT NULL,
  `sensorType` varchar(50) NOT NULL,
  `installationDate` date DEFAULT NULL,
  `expiaryPeriod` int(11) DEFAULT NULL,
  `warehouseID` varchar(10) DEFAULT NULL,
  `vehicleID` varchar(10) DEFAULT NULL
) ;

--
-- Dumping data for table `sensor`
--

INSERT INTO `sensor` (`sensorID`, `sensorType`, `installationDate`, `expiaryPeriod`, `warehouseID`, `vehicleID`) VALUES
('S0001', 'Temperature', '2024-01-15', 730, 'WH001', NULL),
('S0002', 'Humidity', '2024-01-15', 730, 'WH001', NULL),
('S0003', 'Temperature', '2024-02-10', 730, 'WH002', NULL),
('S0004', 'Humidity', '2024-02-10', 730, 'WH002', NULL),
('S0005', 'GPS Tracker', '2024-03-05', 365, NULL, 'V0001'),
('S0006', 'Temperature', '2024-03-05', 365, NULL, 'V0002'),
('S0007', 'GPS Tracker', '2024-03-20', 365, NULL, 'V0003'),
('S0008', 'Temperature', '2024-04-10', 365, NULL, 'V0004');

-- --------------------------------------------------------

--
-- Table structure for table `sensor_data`
--

CREATE TABLE `sensor_data` (
  `sensorDataID` char(6) NOT NULL,
  `date` datetime NOT NULL,
  `reading` varchar(255) NOT NULL,
  `sensorID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sensor_data`
--

INSERT INTO `sensor_data` (`sensorDataID`, `date`, `reading`, `sensorID`) VALUES
('SD0001', '2025-04-22 10:00:00', '26.2°C', 'S0001'),
('SD0002', '2025-04-22 10:00:00', '66.5%', 'S0002'),
('SD0003', '2025-03-05 08:00:00', '27.5°C', 'S0003'),
('SD0004', '2025-03-05 08:00:00', '71.2%', 'S0004'),
('SD0005', '2025-04-22 09:00:00', '23.8561°N, 90.2456°E', 'S0005'),
('SD0006', '2025-03-05 10:00:00', '4.5°C', 'S0006'),
('SD0007', '2025-04-12 09:30:00', '22.6731°N, 89.3874°E', 'S0007'),
('SD0008', '2024-06-17 08:00:00', '5.2°C', 'S0008'),
('SD0009', '2025-04-22 11:00:00', '26.4°C', 'S0001'),
('SD0010', '2025-04-22 11:00:00', '67.0%', 'S0002'),
('SD0011', '2025-04-22 10:00:00', '23.9152°N, 90.3756°E', 'S0005'),
('SD0012', '2025-03-05 12:00:00', '4.3°C', 'S0006');

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

CREATE TABLE `transport` (
  `vehicleID`  varchar(50) NOT NULL,
  `packageID` char(5),
  `destination` varchar(100) NOT NULL,
  `departureDate` datetime DEFAULT NULL,
  `arrivalDate` datetime DEFAULT NULL,
  `refrigeration` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transport`
--

INSERT INTO `transport` (`vehicleID`, `packageID`, `destination`, `departureDate`, `arrivalDate`, `refrigeration`) VALUES
('V0001', 'P0001', 'Dhaka Central Market', '2025-04-22 08:00:00', '2025-04-22 12:00:00', 0),
('V0002', 'P0003', 'Chittagong Retail Hub', '2025-03-05 06:00:00', '2025-03-05 16:00:00', 1),
('V0003', 'P0002', 'Khulna Distribution Center', '2025-04-12 07:00:00', '2025-04-12 14:00:00', 0),
('V0004', 'P0007', 'Sylhet Wholesale Market', '2024-06-17 05:00:00', '2024-06-17 15:00:00', 1),
('V0005', 'P0004', 'Rajshahi Agro-Complex', '2025-02-07 06:30:00', '2025-02-07 13:30:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transportation_vehicles`
--

CREATE TABLE `transportation_vehicles` (
  `id` int(11) NOT NULL,
  `vehicle_id` varchar(50) NOT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `batch_id` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transportation_vehicles`
--

INSERT INTO `transportation_vehicles` (`id`, `vehicle_id`, `vehicle_type`, `batch_id`, `location`, `created_at`, `updated_at`) VALUES
(2, 'TRK0001', 'Truck', 'B0001', 'Rajshahi', '2025-04-25 14:37:11', '2025-04-25 14:37:11'),
(5, 'TRK0002', 'Truck', 'B0003', 'Rangpur', '2025-04-25 14:58:46', '2025-04-25 14:58:46');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` char(6) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `dob` date NOT NULL,
  `c_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `name`, `email`, `password`, `phone`, `dob`, `c_password`) VALUES
('U158155', 'Sauharda Sarkar', '2210022@gmail.com', '123456', '01794017804', '2000-09-08', '123456'),
('U256369', 'Sauharda Sarkar', 'ritomister@gmail.com', '1234', '01794017804', '2000-09-08', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendorLicense` char(6) NOT NULL,
  `v_name` varchar(50) NOT NULL,
  `v_contactInfo` varchar(11) DEFAULT NULL,
  `v_location` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorLicense`, `v_name`, `v_contactInfo`, `v_location`) VALUES
('VL0001', 'Dhaka Agro Suppliers', '01912345678', 'Dhaka'),
('VL0002', 'Rahman Trading Company', '01823456789', 'Chittagong'),
('VL0003', 'Bangla Fresh Foods', '01734567890', 'Khulna'),
('VL0004', 'Sylhet Organic Marketplace', '01645678901', 'Sylhet'),
('VL0005', 'Barisal Crop Traders', '01556789012', 'Barisal'),
('VL0006', 'Rajshahi Farmers Market', '01967890123', 'Rajshahi'),
('VL0007', 'Rupali Agro Industries', '01878901234', 'Mymensingh'),
('VL0008', 'Rangpur Krishi Bazar', '01789012345', 'Rangpur'),
('VL0009', 'Padma Agricultural Supply', '01690123456', 'Faridpur'),
('VL0010', 'Meghna Food Corporation', '01501234567', 'Comilla');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `warehouseID` varchar(10) NOT NULL,
  `location` varchar(50) NOT NULL,
  `temperature` decimal(5,2) DEFAULT NULL,
  `humidity` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`warehouseID`, `location`, `temperature`, `humidity`) VALUES
('WH001', 'Dhaka-Narayanganj', 25.50, 65.00),
('WH002', 'Chittagong Port Area', 27.00, 70.00),
('WH003', 'Khulna-Mongla Road', 26.50, 68.00),
('WH004', 'Sylhet-Sunamganj Highway', 24.00, 75.00),
('WH005', 'Mymensingh Agricultural Zone', 25.00, 67.00);

-- --------------------------------------------------------

--
-- Table structure for table `wholeseller`
--

CREATE TABLE `wholeseller` (
  `wvendorLicense` varchar(10) NOT NULL,
  `v_name` varchar(50) NOT NULL,
  `v_contactInfo` varchar(11) DEFAULT NULL,
  `v_location` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wholeseller`
--

INSERT INTO `wholeseller` (`wvendorLicense`, `v_name`, `v_contactInfo`, `v_location`) VALUES
('VL0002', 'Rahman Trading Company', '01823456789', 'Chittagong'),
('VL0005', 'Barisal Crop Traders', '01556789012', 'Barisal'),
('VL0007', 'Rupali Agro Industries', '01878901234', 'Mymensingh'),
('VL0009', 'Padma Agricultural Supply', '01690123456', 'Faridpur'),
('VL0010', 'Meghna Food Corporation', '01501234567', 'Comilla');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crop`
--
ALTER TABLE `crop`
  ADD PRIMARY KEY (`cropID`);

--
-- Indexes for table `crop_batch`
--
ALTER TABLE `crop_batch`
  ADD PRIMARY KEY (`batchID`),
  ADD KEY `idx_crop_batch_standardGradeID` (`standardGradeID`),
  ADD KEY `idx_crop_batch_packageID` (`packageID`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`deliveryID`),
  ADD KEY `idx_delivery_batchID` (`batchID`),
  ADD KEY `idx_delivery_vendorLicense` (`vendorLicense`),
  ADD KEY `idx_delivery_vehicleID` (`vehicleID`),
  ADD KEY `idx_delivery_warehouseID` (`warehouseID`);

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
  ADD PRIMARY KEY (`farmerID`);

--
-- Indexes for table `farmer_crop`
--
ALTER TABLE `farmer_crop`
  ADD PRIMARY KEY (`farmerCropID`),
  ADD KEY `idx_farmer_crop_farmerID` (`farmerID`),
  ADD KEY `idx_farmer_crop_cropID` (`cropID`);

--
-- Indexes for table `farmer_crop_type`
--
ALTER TABLE `farmer_crop_type`
  ADD PRIMARY KEY (`cropTypeID`),
  ADD KEY `idx_farmer_crop_type_farmerCropID` (`farmerCropID`);

--
-- Indexes for table `farmer_crop_type_grade`
--
ALTER TABLE `farmer_crop_type_grade`
  ADD PRIMARY KEY (`standardGradeID`),
  ADD KEY `idx_farmer_crop_type_grade_cropTypeID` (`cropTypeID`);

--
-- Indexes for table `graded_p_track`
--
ALTER TABLE `graded_p_track`
  ADD PRIMARY KEY (`trackID`),
  ADD KEY `fk01` (`standardGradeID`),
  ADD KEY `fk02` (`warehouseID`);

--
-- Indexes for table `inspector_records`
--
ALTER TABLE `inspector_records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `fk03` (`batchID`),
  ADD KEY `fk04` (`packageID`),
  ADD KEY `fk05` (`standardGradeID`);

--
-- Indexes for table `packaging`
--
ALTER TABLE `packaging`
  ADD PRIMARY KEY (`packageID`);

--
-- Indexes for table `packaging_tracking`
--
ALTER TABLE `packaging_tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retailer`
--
ALTER TABLE `retailer`
  ADD PRIMARY KEY (`rvendorLicense`);

--
-- Indexes for table `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`sensorID`),
  ADD KEY `idx_sensor_warehouseID` (`warehouseID`),
  ADD KEY `idx_sensor_vehicleID` (`vehicleID`);

--
-- Indexes for table `sensor_data`
--
ALTER TABLE `sensor_data`
  ADD PRIMARY KEY (`sensorDataID`),
  ADD KEY `idx_sensor_data_sensorID` (`sensorID`);

--
-- Indexes for table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`vehicleID`),
  ADD KEY `transport_ibfk_1` (`packageID`);

--
-- Indexes for table `transportation_vehicles`
--
ALTER TABLE `transportation_vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk06` (`batch_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendorLicense`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`warehouseID`);

--
-- Indexes for table `wholeseller`
--
ALTER TABLE `wholeseller`
  ADD PRIMARY KEY (`wvendorLicense`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `crop_batch`
--
ALTER TABLE `crop_batch`
  ADD CONSTRAINT `crop_batch_ibfk_1` FOREIGN KEY (`standardGradeID`) REFERENCES `farmer_crop_type_grade` (`standardGradeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `crop_batch_ibfk_2` FOREIGN KEY (`packageID`) REFERENCES `packaging` (`packageID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`batchID`) REFERENCES `crop_batch` (`batchID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`vendorLicense`) REFERENCES `vendor` (`vendorLicense`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `delivery_ibfk_3` FOREIGN KEY (`vehicleID`) REFERENCES `transport` (`vehicleID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `delivery_ibfk_4` FOREIGN KEY (`warehouseID`) REFERENCES `warehouse` (`warehouseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `farmer_crop`
--
ALTER TABLE `farmer_crop`
  ADD CONSTRAINT `farmer_crop_ibfk_1` FOREIGN KEY (`cropID`) REFERENCES `crop` (`cropID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `farmer_crop_ibfk_2` FOREIGN KEY (`farmerID`) REFERENCES `farmer` (`farmerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `farmer_crop_type`
--
ALTER TABLE `farmer_crop_type`
  ADD CONSTRAINT `farmer_crop_type_ibfk_1` FOREIGN KEY (`farmerCropID`) REFERENCES `farmer_crop` (`farmerCropID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `farmer_crop_type_grade`
--
ALTER TABLE `farmer_crop_type_grade`
  ADD CONSTRAINT `farmer_crop_type_grade_ibfk_1` FOREIGN KEY (`cropTypeID`) REFERENCES `farmer_crop_type` (`cropTypeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `graded_p_track`
--
ALTER TABLE `graded_p_track`
  ADD CONSTRAINT `fk01` FOREIGN KEY (`standardGradeID`) REFERENCES `farmer_crop_type_grade` (`standardGradeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk02` FOREIGN KEY (`warehouseID`) REFERENCES `warehouse` (`warehouseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inspector_records`
--
ALTER TABLE `inspector_records`
  ADD CONSTRAINT `fk03` FOREIGN KEY (`batchID`) REFERENCES `crop_batch` (`batchID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk04` FOREIGN KEY (`packageID`) REFERENCES `packaging` (`packageID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk05` FOREIGN KEY (`standardGradeID`) REFERENCES `farmer_crop_type_grade` (`standardGradeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `retailer`
--
ALTER TABLE `retailer`
  ADD CONSTRAINT `retailer_ibfk_1` FOREIGN KEY (`rvendorLicense`) REFERENCES `vendor` (`vendorLicense`);

--
-- Constraints for table `sensor`
--
ALTER TABLE `sensor`
  ADD CONSTRAINT `sensor_ibfk_1` FOREIGN KEY (`warehouseID`) REFERENCES `warehouse` (`warehouseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sensor_ibfk_2` FOREIGN KEY (`vehicleID`) REFERENCES `transport` (`vehicleID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sensor_data`
--
ALTER TABLE `sensor_data`
  ADD CONSTRAINT `sensor_data_ibfk_1` FOREIGN KEY (`sensorID`) REFERENCES `sensor` (`sensorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transport`
--
ALTER TABLE `transport`
  ADD CONSTRAINT `transport_ibfk_1` FOREIGN KEY (`packageID`) REFERENCES `packaging` (`packageID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transportation_vehicles`
--
ALTER TABLE `transportation_vehicles`
  ADD CONSTRAINT `fk06` FOREIGN KEY (`batch_id`) REFERENCES `crop_batch` (`batchID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wholeseller`
--
ALTER TABLE `wholeseller`
  ADD CONSTRAINT `wholeseller_ibfk_1` FOREIGN KEY (`wvendorLicense`) REFERENCES `vendor` (`vendorLicense`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
