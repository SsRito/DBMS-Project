-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2025 at 07:43 PM
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
-- Database: `agriculturesupplychain`
--

-- --------------------------------------------------------

--
-- Table structure for table `crop`
--

CREATE TABLE `crop` (
  `cropID` varchar(50) NOT NULL,
  `cropName` varchar(100) NOT NULL,
  `harvestedDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crop`
--

INSERT INTO `crop` (`cropID`, `cropName`, `harvestedDate`) VALUES
('4209', 'pottao', '2025-04-09'),
('6363', 'tomtao', '2025-04-03'),
('C001', 'Wheat', '2024-06-15'),
('C002', 'Rice', '2024-07-20'),
('C003', 'Corn', '2024-08-10'),
('C004', 'Soybeans', '2024-09-05'),
('C005', 'Potatoes', '2024-05-25'),
('C006', 'Tomatoes', '2024-07-10'),
('C007', 'Apples', '2024-09-15'),
('C008', 'Oranges', '2024-10-20');

-- --------------------------------------------------------

--
-- Table structure for table `crop_batch`
--

CREATE TABLE `crop_batch` (
  `batchID` varchar(50) NOT NULL,
  `expiaryDate` date DEFAULT NULL,
  `processingDate` date DEFAULT NULL,
  `standardGradeID` varchar(50) NOT NULL,
  `packageID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crop_batch`
--

INSERT INTO `crop_batch` (`batchID`, `expiaryDate`, `processingDate`, `standardGradeID`, `packageID`) VALUES
('B001', '2025-06-15', '2024-06-20', 'SG001', 'P001'),
('B002', '2025-07-20', '2024-07-25', 'SG002', 'P002'),
('B003', '2025-02-10', '2024-08-15', 'SG003', 'P003'),
('B004', '2025-09-05', '2024-09-10', 'SG004', 'P004'),
('B005', '2024-11-25', '2024-05-30', 'SG005', 'P005'),
('B006', '2024-10-10', '2024-07-15', 'SG006', 'P006'),
('B007', '2025-03-15', '2024-09-20', 'SG007', 'P007'),
('B008', '2025-04-20', '2024-10-25', 'SG008', 'P008');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `deliveryID` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL,
  `dateTime` datetime NOT NULL,
  `batchID` varchar(50) NOT NULL,
  `vendorLicense` varchar(50) NOT NULL,
  `vehicleID` varchar(50) NOT NULL,
  `warehouseID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`deliveryID`, `location`, `dateTime`, `batchID`, `vendorLicense`, `vehicleID`, `warehouseID`) VALUES
('D001', 'Central City Market', '2024-06-22 10:00:00', 'B001', 'VL001', 'V001', 'W001'),
('D002', 'Portside Distribution Center', '2024-07-27 09:00:00', 'B002', 'VL002', 'V002', 'W002'),
('D003', 'Greenhill Farmers Market', '2024-08-17 11:00:00', 'B003', 'VL003', 'V003', 'W003'),
('D004', 'Riverside Shopping Mall', '2024-09-12 10:30:00', 'B004', 'VL004', 'V004', 'W004'),
('D005', 'Eastport Grocery Outlet', '2024-06-01 09:30:00', 'B005', 'VL005', 'V005', 'W005'),
('D006', 'Central City Superstore', '2024-07-17 10:00:00', 'B006', 'VL001', 'V006', 'W001'),
('D007', 'Portside Organic Shop', '2024-09-22 11:30:00', 'B007', 'VL002', 'V007', 'W002'),
('D008', 'Greenhill Food Co-op', '2024-10-27 10:00:00', 'B008', 'VL003', 'V008', 'W003');

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `farmerID` varchar(50) NOT NULL,
  `farmerName` varchar(100) NOT NULL,
  `contactInfo` varchar(255) DEFAULT NULL,
  `f_district` varchar(100) DEFAULT NULL,
  `f_union` varchar(100) DEFAULT NULL,
  `f_village` varchar(100) DEFAULT NULL,
  `f_zip_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`farmerID`, `farmerName`, `contactInfo`, `f_district`, `f_union`, `f_village`, `f_zip_code`) VALUES
('F001', 'John Smith', 'john.smith@email.com', 'Central', 'Greenfield', 'Harvest', '12345'),
('F002', 'Maria Garcia', 'maria.garcia@email.com', 'Eastern', 'Sunnydale', 'Riverside', '23456'),
('F003', 'Ahmed Hassan', 'ahmed.hassan@email.com', 'Western', 'Fieldview', 'Hillside', '34567'),
('F004', 'Li Wei', 'li.wei@email.com', 'Northern', 'Valleyview', 'Lakeside', '45678'),
('F005', 'Fatima Nkosi', 'fatima.nkosi@email.com', 'Southern', 'Greenmeadow', 'Mountainview', '56789');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_crop`
--

CREATE TABLE `farmer_crop` (
  `farmerCropID` varchar(50) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `season` varchar(50) DEFAULT NULL,
  `cropID` varchar(50) NOT NULL,
  `farmerID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer_crop`
--

INSERT INTO `farmer_crop` (`farmerCropID`, `quantity`, `season`, `cropID`, `farmerID`) VALUES
('FC001', 5000.00, 'Summer 2024', 'C001', 'F001'),
('FC002', 3500.00, 'Summer 2024', 'C002', 'F002'),
('FC003', 7500.00, 'Summer 2024', 'C003', 'F001'),
('FC004', 4200.00, 'Fall 2024', 'C004', 'F003'),
('FC005', 6000.00, 'Spring 2024', 'C005', 'F004'),
('FC006', 2800.00, 'Summer 2024', 'C006', 'F005'),
('FC007', 3200.00, 'Fall 2024', 'C007', 'F004'),
('FC008', 4800.00, 'Fall 2024', 'C008', 'F005');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_crop_type`
--

CREATE TABLE `farmer_crop_type` (
  `cropTypeID` varchar(50) NOT NULL,
  `cropType` varchar(100) NOT NULL,
  `farmerCropID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer_crop_type`
--

INSERT INTO `farmer_crop_type` (`cropTypeID`, `cropType`, `farmerCropID`) VALUES
('CT001', 'Hard Red Winter', 'FC001'),
('CT002', 'Basmati', 'FC002'),
('CT003', 'Sweet Corn', 'FC003'),
('CT004', 'Edamame', 'FC004'),
('CT005', 'Russet', 'FC005'),
('CT006', 'Roma', 'FC006'),
('CT007', 'Honeycrisp', 'FC007'),
('CT008', 'Valencia', 'FC008');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_crop_type_grade`
--

CREATE TABLE `farmer_crop_type_grade` (
  `standardGradeID` varchar(50) NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `cropGrade` varchar(50) NOT NULL,
  `criteria_size` varchar(50) DEFAULT NULL,
  `criteria_shape` varchar(50) DEFAULT NULL,
  `criteria_colour` varchar(50) DEFAULT NULL,
  `criteria_infestation` varchar(50) DEFAULT NULL,
  `cropTypeID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer_crop_type_grade`
--

INSERT INTO `farmer_crop_type_grade` (`standardGradeID`, `quantity`, `cropGrade`, `criteria_size`, `criteria_shape`, `criteria_colour`, `criteria_infestation`, `cropTypeID`) VALUES
('SG001', 4500.00, 'Grade A', 'Large', 'Uniform', 'Golden', 'None', 'CT001'),
('SG002', 3000.00, 'Grade A', 'Long', 'Uniform', 'White', 'None', 'CT002'),
('SG003', 6500.00, 'Grade B', 'Medium', 'Uniform', 'Yellow', 'Minimal', 'CT003'),
('SG004', 3800.00, 'Grade A', 'Medium', 'Uniform', 'Green', 'None', 'CT004'),
('SG005', 5200.00, 'Grade B', 'Large', 'Irregular', 'Brown', 'None', 'CT005'),
('SG006', 2500.00, 'Grade A', 'Medium', 'Uniform', 'Red', 'None', 'CT006'),
('SG007', 2800.00, 'Grade A', 'Large', 'Round', 'Red-Green', 'None', 'CT007'),
('SG008', 4200.00, 'Grade B', 'Medium', 'Round', 'Orange', 'Minimal', 'CT008');

-- --------------------------------------------------------

--
-- Table structure for table `packaging`
--

CREATE TABLE `packaging` (
  `packageID` varchar(50) NOT NULL,
  `packagingDescription` varchar(255) DEFAULT NULL,
  `materialType` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packaging`
--

INSERT INTO `packaging` (`packageID`, `packagingDescription`, `materialType`) VALUES
('P001', 'Burlap Sack 50kg', 'Jute'),
('P002', 'Paper Bag 25kg', 'Recycled Paper'),
('P003', 'Plastic Crate 30kg', 'HDPE Plastic'),
('P004', 'Cardboard Box 20kg', 'Corrugated Cardboard'),
('P005', 'Wooden Crate 40kg', 'Pine Wood'),
('P006', 'Mesh Bag 10kg', 'Polyethylene'),
('P007', 'Plastic Tray 5kg', 'Food-grade Plastic'),
('P008', 'Vacuum Sealed Bag 1kg', 'Multilayer Plastic');

-- --------------------------------------------------------

--
-- Table structure for table `retailer`
--

CREATE TABLE `retailer` (
  `rvendorLicense` varchar(50) NOT NULL,
  `v_name` varchar(100) NOT NULL,
  `v_contactInfo` varchar(255) DEFAULT NULL,
  `v_location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `retailer`
--

INSERT INTO `retailer` (`rvendorLicense`, `v_name`, `v_contactInfo`, `v_location`) VALUES
('VL001', 'Global Foods Retail', 'retail@globalfoods.com', 'Central City Mall'),
('VL004', 'Farm Direct Market', 'market@farmdirect.com', 'Riverside Shopping Center');

-- --------------------------------------------------------

--
-- Table structure for table `sensor`
--

CREATE TABLE `sensor` (
  `sensorID` varchar(50) NOT NULL,
  `sensorType` varchar(100) NOT NULL,
  `installationDate` date DEFAULT NULL,
  `expiaryPeriod` int(11) DEFAULT NULL,
  `warehouseID` varchar(50) DEFAULT NULL,
  `vehicleID` varchar(50) DEFAULT NULL
) ;

--
-- Dumping data for table `sensor`
--

INSERT INTO `sensor` (`sensorID`, `sensorType`, `installationDate`, `expiaryPeriod`, `warehouseID`, `vehicleID`) VALUES
('S001', 'Temperature', '2024-01-15', 365, 'W001', NULL),
('S002', 'Humidity', '2024-01-15', 365, 'W001', NULL),
('S003', 'Temperature', '2024-02-10', 365, 'W002', NULL),
('S004', 'Humidity', '2024-02-10', 365, 'W002', NULL),
('S005', 'Temperature', '2024-01-05', 365, NULL, 'V001'),
('S006', 'Humidity', '2024-01-05', 365, NULL, 'V001'),
('S007', 'Temperature', '2024-03-20', 365, NULL, 'V002'),
('S008', 'Humidity', '2024-03-20', 365, NULL, 'V002'),
('S009', 'Temperature', '2024-02-25', 365, 'W003', NULL),
('S010', 'Humidity', '2024-02-25', 365, 'W003', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sensor_data`
--

CREATE TABLE `sensor_data` (
  `sensorDataID` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `reading` varchar(255) NOT NULL,
  `sensorID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sensor_data`
--

INSERT INTO `sensor_data` (`sensorDataID`, `date`, `reading`, `sensorID`) VALUES
('SD001', '2024-06-22 10:00:00', '15.5°C', 'S001'),
('SD002', '2024-06-22 10:00:00', '62%', 'S002'),
('SD003', '2024-06-22 14:00:00', '16.0°C', 'S001'),
('SD004', '2024-06-22 14:00:00', '63%', 'S002'),
('SD005', '2024-07-27 09:00:00', '4.2°C', 'S003'),
('SD006', '2024-07-27 09:00:00', '84%', 'S004'),
('SD007', '2024-07-27 15:00:00', '4.5°C', 'S003'),
('SD008', '2024-07-27 15:00:00', '83%', 'S004'),
('SD009', '2024-06-21 08:00:00', '18.0°C', 'S005'),
('SD010', '2024-06-21 08:00:00', '55%', 'S006'),
('SD011', '2024-06-21 14:00:00', '19.5°C', 'S005'),
('SD012', '2024-06-21 14:00:00', '58%', 'S006'),
('SD013', '2024-07-26 07:30:00', '3.8°C', 'S007'),
('SD014', '2024-07-26 07:30:00', '86%', 'S008'),
('SD015', '2024-07-26 12:30:00', '4.1°C', 'S007'),
('SD016', '2024-07-26 12:30:00', '85%', 'S008'),
('SD017', '2024-08-17 11:00:00', '12.2°C', 'S009'),
('SD018', '2024-08-17 11:00:00', '71%', 'S010'),
('SD019', '2024-08-17 17:00:00', '12.5°C', 'S009'),
('SD020', '2024-08-17 17:00:00', '72%', 'S010');

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

CREATE TABLE `transport` (
  `vehicleID` varchar(50) NOT NULL,
  `packageID` varchar(50) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `departureDate` datetime DEFAULT NULL,
  `arrivalDate` datetime DEFAULT NULL,
  `refrigeration` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transport`
--

INSERT INTO `transport` (`vehicleID`, `packageID`, `destination`, `departureDate`, `arrivalDate`, `refrigeration`) VALUES
('V001', 'P001', 'Central City Storage Facility', '2024-06-21 08:00:00', '2024-06-21 14:00:00', 0),
('V002', 'P002', 'Portside Cold Storage', '2024-07-26 07:30:00', '2024-07-26 12:30:00', 1),
('V003', 'P003', 'Greenhill Organic Storage', '2024-08-16 09:00:00', '2024-08-16 15:00:00', 1),
('V004', 'P004', 'Riverside Dry Storage', '2024-09-11 10:00:00', '2024-09-11 14:00:00', 0),
('V005', 'P005', 'Eastport Climate Controlled Facility', '2024-05-31 08:30:00', '2024-05-31 13:30:00', 0),
('V006', 'P006', 'Central City Storage Facility', '2024-07-16 07:00:00', '2024-07-16 11:00:00', 1),
('V007', 'P007', 'Portside Cold Storage', '2024-09-21 09:30:00', '2024-09-21 14:30:00', 1),
('V008', 'P008', 'Greenhill Organic Storage', '2024-10-26 10:30:00', '2024-10-26 16:30:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendorLicense` varchar(50) NOT NULL,
  `v_name` varchar(100) NOT NULL,
  `v_contactInfo` varchar(255) DEFAULT NULL,
  `v_location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorLicense`, `v_name`, `v_contactInfo`, `v_location`) VALUES
('VL001', 'Global Foods Inc.', 'contact@globalfoods.com', 'Central City'),
('VL002', 'Fresh Produce Distributors', 'info@freshproduce.com', 'Portside'),
('VL003', 'Organic Valley Co-op', 'service@organicvalley.com', 'Greenhill'),
('VL004', 'Farm Direct Partners', 'support@farmdirect.com', 'Riverside'),
('VL005', 'Market Fresh Suppliers', 'info@marketfresh.com', 'Eastport');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `warehouseID` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL,
  `temperature` decimal(5,2) DEFAULT NULL,
  `humidity` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`warehouseID`, `location`, `temperature`, `humidity`) VALUES
('W001', 'Central City Storage Facility', 15.50, 60.00),
('W002', 'Portside Cold Storage', 4.00, 85.00),
('W003', 'Greenhill Organic Storage', 12.00, 70.00),
('W004', 'Riverside Dry Storage', 20.00, 40.00),
('W005', 'Eastport Climate Controlled Facility', 8.00, 65.00);

-- --------------------------------------------------------

--
-- Table structure for table `wholeseller`
--

CREATE TABLE `wholeseller` (
  `wvendorLicense` varchar(50) NOT NULL,
  `v_name` varchar(100) NOT NULL,
  `v_contactInfo` varchar(255) DEFAULT NULL,
  `v_location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wholeseller`
--

INSERT INTO `wholeseller` (`wvendorLicense`, `v_name`, `v_contactInfo`, `v_location`) VALUES
('VL002', 'Fresh Produce Wholesale', 'wholesale@freshproduce.com', 'Portside Industrial Zone'),
('VL003', 'Organic Valley Distribution', 'distribution@organicvalley.com', 'Greenhill Business Park'),
('VL005', 'Market Fresh Bulk Supply', 'bulk@marketfresh.com', 'Eastport Commerce Center');

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
-- Indexes for table `packaging`
--
ALTER TABLE `packaging`
  ADD PRIMARY KEY (`packageID`);

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
  ADD KEY `packageID` (`packageID`);

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
  ADD CONSTRAINT `crop_batch_ibfk_1` FOREIGN KEY (`standardGradeID`) REFERENCES `farmer_crop_type_grade` (`standardGradeID`),
  ADD CONSTRAINT `crop_batch_ibfk_2` FOREIGN KEY (`packageID`) REFERENCES `packaging` (`packageID`);

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`batchID`) REFERENCES `crop_batch` (`batchID`),
  ADD CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`vendorLicense`) REFERENCES `vendor` (`vendorLicense`),
  ADD CONSTRAINT `delivery_ibfk_3` FOREIGN KEY (`vehicleID`) REFERENCES `transport` (`vehicleID`),
  ADD CONSTRAINT `delivery_ibfk_4` FOREIGN KEY (`warehouseID`) REFERENCES `warehouse` (`warehouseID`);

--
-- Constraints for table `farmer_crop`
--
ALTER TABLE `farmer_crop`
  ADD CONSTRAINT `farmer_crop_ibfk_1` FOREIGN KEY (`cropID`) REFERENCES `crop` (`cropID`),
  ADD CONSTRAINT `farmer_crop_ibfk_2` FOREIGN KEY (`farmerID`) REFERENCES `farmer` (`farmerID`);

--
-- Constraints for table `farmer_crop_type`
--
ALTER TABLE `farmer_crop_type`
  ADD CONSTRAINT `farmer_crop_type_ibfk_1` FOREIGN KEY (`farmerCropID`) REFERENCES `farmer_crop` (`farmerCropID`);

--
-- Constraints for table `farmer_crop_type_grade`
--
ALTER TABLE `farmer_crop_type_grade`
  ADD CONSTRAINT `farmer_crop_type_grade_ibfk_1` FOREIGN KEY (`cropTypeID`) REFERENCES `farmer_crop_type` (`cropTypeID`);

--
-- Constraints for table `retailer`
--
ALTER TABLE `retailer`
  ADD CONSTRAINT `retailer_ibfk_1` FOREIGN KEY (`rvendorLicense`) REFERENCES `vendor` (`vendorLicense`);

--
-- Constraints for table `sensor`
--
ALTER TABLE `sensor`
  ADD CONSTRAINT `sensor_ibfk_1` FOREIGN KEY (`warehouseID`) REFERENCES `warehouse` (`warehouseID`),
  ADD CONSTRAINT `sensor_ibfk_2` FOREIGN KEY (`vehicleID`) REFERENCES `transport` (`vehicleID`);

--
-- Constraints for table `sensor_data`
--
ALTER TABLE `sensor_data`
  ADD CONSTRAINT `sensor_data_ibfk_1` FOREIGN KEY (`sensorID`) REFERENCES `sensor` (`sensorID`);

--
-- Constraints for table `transport`
--
ALTER TABLE `transport`
  ADD CONSTRAINT `transport_ibfk_1` FOREIGN KEY (`packageID`) REFERENCES `packaging` (`packageID`);

--
-- Constraints for table `wholeseller`
--
ALTER TABLE `wholeseller`
  ADD CONSTRAINT `wholeseller_ibfk_1` FOREIGN KEY (`wvendorLicense`) REFERENCES `vendor` (`vendorLicense`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
