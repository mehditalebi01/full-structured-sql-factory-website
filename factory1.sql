-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 13, 2025 at 06:09 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `factory1`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `CustomerID` int NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `RegisteredDate` date DEFAULT NULL,
  PRIMARY KEY (`CustomerID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `EmployeeID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `NationalID` varchar(50) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `HireDate` date DEFAULT NULL,
  `Salary` decimal(10,2) DEFAULT NULL,
  `Type` enum('Manager','Worker','OfficeEmployee') DEFAULT NULL,
  PRIMARY KEY (`EmployeeID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `factory`
--

DROP TABLE IF EXISTS `factory`;
CREATE TABLE IF NOT EXISTS `factory` (
  `FactoryID` int NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Location` varchar(200) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `EstablishedDate` date DEFAULT NULL,
  `Status` enum('Active','Inactive') DEFAULT NULL,
  `OfficeID` int DEFAULT NULL,
  `ManagerID` int DEFAULT NULL,
  PRIMARY KEY (`FactoryID`),
  KEY `OfficeID` (`OfficeID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `factoryrawmaterial`
--

DROP TABLE IF EXISTS `factoryrawmaterial`;
CREATE TABLE IF NOT EXISTS `factoryrawmaterial` (
  `FactoryID` int NOT NULL,
  `RawMaterialID` int NOT NULL,
  `QuantityUsed` int DEFAULT NULL,
  `DateUsed` date DEFAULT NULL,
  PRIMARY KEY (`FactoryID`,`RawMaterialID`),
  KEY `RawMaterialID` (`RawMaterialID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE IF NOT EXISTS `manager` (
  `EmployeeID` int NOT NULL,
  `Level` varchar(50) DEFAULT NULL,
  `ManagesEntityType` enum('Factory','Office') DEFAULT NULL,
  `ManagesEntityID` int DEFAULT NULL,
  PRIMARY KEY (`EmployeeID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

DROP TABLE IF EXISTS `office`;
CREATE TABLE IF NOT EXISTS `office` (
  `OfficeID` int NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Location` varchar(200) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `ManagerID` int DEFAULT NULL,
  PRIMARY KEY (`OfficeID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `officeemployee`
--

DROP TABLE IF EXISTS `officeemployee`;
CREATE TABLE IF NOT EXISTS `officeemployee` (
  `EmployeeID` int NOT NULL,
  `OfficeID` int DEFAULT NULL,
  `Role` varchar(100) DEFAULT NULL,
  `Department` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`EmployeeID`),
  KEY `OfficeID` (`OfficeID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `OrderID` int NOT NULL,
  `CustomerID` int DEFAULT NULL,
  `OfficeID` int DEFAULT NULL,
  `OrderDate` date DEFAULT NULL,
  `Status` enum('Pending','Completed','Cancelled') DEFAULT NULL,
  PRIMARY KEY (`OrderID`),
  KEY `CustomerID` (`CustomerID`),
  KEY `OfficeID` (`OfficeID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderproduct`
--

DROP TABLE IF EXISTS `orderproduct`;
CREATE TABLE IF NOT EXISTS `orderproduct` (
  `OrderID` int NOT NULL,
  `ProductID` int NOT NULL,
  `Quantity` int DEFAULT NULL,
  `UnitPriceAtTime` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`OrderID`,`ProductID`),
  KEY `ProductID` (`ProductID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `ProductID` int NOT NULL,
  `FactoryID` int DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Category` varchar(100) DEFAULT NULL,
  `UnitPrice` decimal(10,2) DEFAULT NULL,
  `StockQuantity` int DEFAULT NULL,
  `ProductionDate` date DEFAULT NULL,
  `ExpirationDate` date DEFAULT NULL,
  PRIMARY KEY (`ProductID`),
  KEY `FactoryID` (`FactoryID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rawmaterial`
--

DROP TABLE IF EXISTS `rawmaterial`;
CREATE TABLE IF NOT EXISTS `rawmaterial` (
  `RawMaterialID` int NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Unit` varchar(20) DEFAULT NULL,
  `CostPerUnit` decimal(10,2) DEFAULT NULL,
  `StockQuantity` int DEFAULT NULL,
  `SupplierID` int DEFAULT NULL,
  PRIMARY KEY (`RawMaterialID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `SupplierID` int NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `CompanyName` varchar(100) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Location` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`SupplierID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `TransactionID` int NOT NULL,
  `OrderID` int DEFAULT NULL,
  `PaymentDate` date DEFAULT NULL,
  `AmountPaid` decimal(10,2) DEFAULT NULL,
  `Method` enum('Cash','Card','Online') DEFAULT NULL,
  `Status` enum('Success','Failed','Refunded') DEFAULT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `OrderID` (`OrderID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

DROP TABLE IF EXISTS `worker`;
CREATE TABLE IF NOT EXISTS `worker` (
  `EmployeeID` int NOT NULL,
  `FactoryID` int DEFAULT NULL,
  `Shift` enum('Morning','Evening','Night') DEFAULT NULL,
  `Skills` text,
  `IsFullTime` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`EmployeeID`),
  KEY `FactoryID` (`FactoryID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
