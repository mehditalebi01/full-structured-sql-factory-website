-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 02, 2025 at 02:32 PM
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
  `CustomerID` int NOT NULL AUTO_INCREMENT,
  `FullName` varchar(100) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `RegisteredDate` date DEFAULT NULL,
  PRIMARY KEY (`CustomerID`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `FullName`, `Phone`, `Email`, `Address`, `RegisteredDate`) VALUES
(18, 'Diane Sanders', '(048)489-9713x2920', 'ismith@kelly.com', '0370 Gray Parkways\nCassandraville, WV 80919', '2024-04-07'),
(17, 'Christopher Brooks', '+1-548-938-4393x2586', 'rothriley@hotmail.com', 'Unit 8062 Box 0649\nDPO AA 83231', '2024-02-26'),
(16, 'Samuel Alvarado', '974.835.8921', 'jamesleon@fox.com', '5610 Kevin Underpass\nCisnerosmouth, FL 82878', '2025-02-02'),
(14, 'Kevin Contreras', '001-009-236-4199', 'timothy97@davis.org', '13957 Davidson Point\nLake Heatherburgh, WY 55964', '2022-07-27'),
(15, 'Sarah Wright', '+1-394-455-7898x5329', 'zacharywilson@church.org', '0453 Ferrell Estate\nWest James, SC 19858', '2025-01-25'),
(13, 'Jacob Jordan', '535.940.9938', 'billy78@gmail.com', '23118 Monica Trail Suite 772\nBullockhaven, OH 49391', '2024-09-21'),
(12, 'Kelly Ashley', '(419)764-4597x506', 'denise14@huang.com', '9536 Pamela Gateway Suite 917\nTammyhaven, AR 86845', '2025-04-07'),
(11, 'Danielle Knight', '023-148-9601', 'thomasclark@yahoo.com', '181 Jonathan Circles\nPort Aliciaburgh, WY 13274', '2022-06-15'),
(10, 'Joshua Perez', '788-863-2321x7486', 'brian28@gutierrez-rosales.com', '06123 Elijah Rest Suite 296\nPettyport, ID 71329', '2024-09-02'),
(9, 'Crystal David', '268.550.4661', 'kathy56@gmail.com', '716 Evans Stravenue\nSouth Kellymouth, DE 48820', '2024-01-10'),
(7, 'Sarah Lopez', '001-812-847-5766x693', 'michaelstokes@yahoo.com', '312 Amber Harbors Apt. 307\nNew Samuelview, AR 04269', '2024-08-17'),
(6, 'Tyler Farmer', '407.556.3419x3849', 'brianwalker@hotmail.com', 'USNS Williams\nFPO AP 99898', '2022-08-26'),
(5, 'Mark Lewis', '001-848-117-3242x476', 'annajones@yahoo.com', '0312 Sara River Apt. 641\nSharonfort, NH 88619', '2025-02-18'),
(4, 'Sean Sparks', '390.684.8455x544', 'anthonymartin@dixon-houston.com', 'USNV Ellis\nFPO AA 89160', '2023-12-20'),
(3, 'Mr. Victor Wright', '961-104-1849x8222', 'sarah85@yahoo.com', '648 Wright Court Suite 912\nLisafurt, AR 62333', '2022-09-16'),
(2, 'Joseph Nguyen', '001-354-704-6666', 'lmoore@bates.com', '55474 Raymond Row\nLake Nicole, AR 68081', '2024-05-20'),
(1, 'Michael Wilkinson', '835.547.3437', 'carterdenise@garcia-luna.org', '15086 Jordan Ferry\nConnieport, NV 04953', '2024-09-27'),
(19, 'Michael Weaver', '717.578.5531', 'merickson@mitchell.biz', '22130 Laura Loaf Apt. 080\nMelindaview, MO 15401', '2022-11-17'),
(20, 'Lindsey Oconnor', '+1-914-654-9586x6012', 'steve12@campbell.biz', '48266 Cochran Mission\nHughesview, AR 78574', '2024-12-16'),
(21, 'mehdiiiiiii', '00000000000000', 'mehhhhhhhhh@gmail.com', 'mmmmmm', '2025-05-13'),
(22, 'mahyar', '010101010101', 'mahhh@gmail.com', 'ssajgfoiuragbhi', '2025-10-30'),
(23, 'mahyar pa', '919191919119', 'mamamama@gmail.com', 'ufhwrfiouwh', '2025-05-15');

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
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeID`, `Name`, `NationalID`, `Phone`, `Email`, `HireDate`, `Salary`, `Type`) VALUES
(24, 'Kenneth Zamora', '8098190089', '(941)018-7106x4148', 'gonzalezkevin@gmail.com', '2022-09-09', 5464.87, 'Manager'),
(22, 'Sonya Summers', '4394565495', '003-518-0010', 'joshuagilbert@hall.com', '2015-12-14', 2253.19, 'OfficeEmployee'),
(23, 'Justin Wise', '7440933264', '1151211294', 'bbrown@gmail.com', '2019-11-14', 5450.23, 'OfficeEmployee'),
(21, 'Tracy Horton', '9897721873', '276.958.0364', 'cruzcarol@hinton-allen.com', '2017-12-11', 2769.99, 'OfficeEmployee'),
(20, 'Robert Adams', '5766979939', '514-482-2998', 'sayala@hotmail.com', '2018-07-02', 4592.35, 'OfficeEmployee'),
(19, 'Eric Larson', '1630080667', '835-026-3596x57263', 'terrygoodman@hotmail.com', '2020-07-24', 3556.49, 'Worker'),
(18, 'Edward Walker', '1398035094', '131-152-8073x506', 'jprice@yahoo.com', '2022-01-28', 3739.39, 'Worker'),
(17, 'Randy Little', '9735708222', '001-628-192-3303x156', 'ybaker@yahoo.com', '2023-01-21', 4305.77, 'OfficeEmployee'),
(16, 'Justin Hodge', '787147713', '+1-950-722-8754x9310', 'schmittsusan@smith.com', '2020-12-31', 5143.51, 'Worker'),
(15, 'Brian Delacruz', '1304564199', '313-952-7159x9368', 'sharpscott@brown.com', '2019-01-04', 1595.70, 'OfficeEmployee'),
(14, 'Mark Williams', '9624881196', '001-583-071-1938', 'tanya10@gmail.com', '2015-11-16', 3686.97, 'Manager'),
(13, 'Michael Villa', '2651809656', '+1-360-959-0803x7020', 'lisa82@hotmail.com', '2023-10-04', 5136.11, 'Worker'),
(12, 'Robert Phillips', '2872546522', '(073)691-7183x980', 'scottcruz@yahoo.com', '2019-11-06', 3193.57, 'OfficeEmployee'),
(11, 'Hannah Garcia', '6287223655', '406-623-8075', 'david71@cain.net', '2016-01-01', 4295.85, 'OfficeEmployee'),
(10, 'Richard Kelly', '2857456363', '965-881-6347x1865', 'robertmullen@cole-gonzalez.com', '2017-03-18', 5290.99, 'OfficeEmployee'),
(9, 'Angela Martinez', '8652191895', '161-021-3911x23532', 'justinalvarez@shea.com', '2021-10-08', 4200.63, 'Manager'),
(8, 'Phillip Farmer', '3622685265', '321.979.0307x577', 'rose97@gmail.com', '2023-05-23', 4960.32, 'Manager'),
(7, 'Kelly Lynch', '5648307596', '001-819-600-5561x290', 'chad46@barry-crawford.org', '2021-02-25', 2828.06, 'Manager'),
(6, 'Jennifer May', '7198712631', '(594)166-3986', 'uadams@yahoo.com', '2019-07-18', 2077.04, 'Manager'),
(5, 'Joel Buckley', '5587327292', '5750657638', 'karen25@davis-santiago.net', '2019-08-04', 2037.67, 'Worker'),
(4, 'Andrew Wright', '737365569', '+1-242-721-6013x6638', 'brookslisa@porter-thomas.net', '2022-02-22', 1626.98, 'OfficeEmployee'),
(3, 'Nicholas Williams', '9784013532', '601-234-3408x81459', 'pdunn@yahoo.com', '2020-07-14', 5574.26, 'Manager'),
(2, 'Christopher Kennedy', '5746618030', '529-257-8707', 'canderson@hotmail.com', '2021-02-05', 5118.71, 'OfficeEmployee'),
(1, 'Ashley Miller', '6363255091', '001-651-320-5157x735', 'durankimberly@sanchez.biz', '2021-12-17', 5095.07, 'Worker'),
(25, 'James Morgan', '6721879599', '519.664.8817x7451', 'savannahmiller@hotmail.com', '2017-10-18', 4410.87, 'OfficeEmployee'),
(26, 'Eric Harrington', '6547089610', '7839357945', 'debrabell@gmail.com', '2017-08-26', 5315.85, 'Manager'),
(27, 'Gary Howe', '1576194865', '(551)849-2781x67832', 'mary28@hotmail.com', '2016-03-16', 3288.58, 'Manager'),
(28, 'Erica Bean', '8674655833', '(361)368-5720x4396', 'taramyers@lawson.biz', '2015-11-29', 1974.82, 'OfficeEmployee'),
(29, 'Matthew Page', '5533349686', '001-480-053-7272x267', 'alyssaprice@yahoo.com', '2018-02-08', 4243.53, 'Manager'),
(30, 'Megan Lawrence', '2916522084', '001-855-827-2240', 'norma18@sanchez.com', '2019-10-31', 3432.31, 'Worker'),
(31, 'afkan afkani', '9999666', '9666699', 'afkan@estan.com', '2025-05-09', 500.00, 'Worker'),
(32, 'anderrrrrr', '2222222222', '333333333', 'mmmmmm@gmail.com', '2025-05-01', 7000.00, 'Manager'),
(33, 'mehdiiiiiiii', '11111111', '22222222', 'mehhhhh@gmil.com', '2025-05-14', 80000.00, 'Manager'),
(34, 'xxxx xian', '454566', '77777777777777', 'xxxxxx@gmail.com', '2027-07-07', 60000.00, 'Manager'),
(35, 'mahyar pajuhi', '989898', '3344442200', 'marharrrrr@gmail.com', '2025-05-05', 66600.00, 'Manager'),
(39, 'mmmmmmmmm', '3333333333', '444444', 'mmmmnn@gmail.com', '2025-05-22', 2333.00, 'OfficeEmployee');

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

--
-- Dumping data for table `factory`
--

INSERT INTO `factory` (`FactoryID`, `Name`, `Location`, `Phone`, `Email`, `EstablishedDate`, `Status`, `OfficeID`, `ManagerID`) VALUES
(5, 'Cunningham LLC', 'Port Brandiville', '308.911.3249x150', 'mendozajeffrey@gmail.com', '2016-06-11', 'Active', 4, 34),
(3, 'Wood LLC', 'North Yvonne', '(146)274-4084', 'xwalker@schwartz.com', '2005-05-24', 'Active', 4, 3),
(4, 'Snyder, Williams and Mccormick', 'North Bruceshire', '3072284378', 'jonesjonathan@gmail.com', '2020-10-30', 'Active', 1, 35),
(2, 'Anderson and Sons', 'Port Jennifermouth', '540-848-3399', 'williamortiz@garcia.com', '2010-05-08', 'Inactive', 5, 33),
(1, 'Ford, Watson and Brown', 'Bradleyberg', '078-876-0140x7428', 'joseph58@yahoo.com', '2006-05-24', 'Inactive', 3, 38);

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
  `EmployeeID` int NOT NULL AUTO_INCREMENT,
  `Level` varchar(50) DEFAULT NULL,
  `ManagesEntityType` enum('Factory','Office') DEFAULT NULL,
  `ManagesEntityID` int DEFAULT NULL,
  PRIMARY KEY (`EmployeeID`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`EmployeeID`, `Level`, `ManagesEntityType`, `ManagesEntityID`) VALUES
(29, 'C', 'Factory', 2),
(27, 'B', 'Office', 4),
(26, 'B', 'Factory', 5),
(24, 'A', 'Office', 1),
(14, 'B', 'Factory', 1),
(9, 'C', 'Factory', 3),
(8, 'A', 'Factory', 5),
(7, 'A', 'Factory', 3),
(6, 'A', 'Factory', 3),
(3, 'C', 'Office', 2),
(32, '', 'Factory', 2),
(33, 'A', 'Factory', 2),
(34, '', 'Factory', 5),
(35, 'A', 'Factory', 4);

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

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`OfficeID`, `Name`, `Location`, `Phone`, `Email`, `ManagerID`) VALUES
(5, 'Martinez, Meyer and Nelson', 'Shafferville', '0753961234', 'johnsonmark@howell.com', 5),
(4, 'Carrillo, Sanchez and Moore', 'Lake Jennifer', '+1-823-987-2811x6325', 'taracurry@palmer-rosario.info', 4),
(2, 'Smith Inc', 'West Elizabeth', '049-884-2840x9206', 'mercerrenee@wilson.com', 2),
(3, 'Williams-Wilkinson', 'East Seanberg', '001-586-885-1188x698', 'brandon31@owen-mitchell.com', 3),
(1, 'Mueller-Wilkerson', 'Port Amanda', '001-821-904-0065x053', 'umelton@robinson.org', 1);

-- --------------------------------------------------------

--
-- Table structure for table `officeemployee`
--

DROP TABLE IF EXISTS `officeemployee`;
CREATE TABLE IF NOT EXISTS `officeemployee` (
  `EmployeeID` int NOT NULL AUTO_INCREMENT,
  `OfficeID` int DEFAULT NULL,
  `Role` varchar(100) DEFAULT NULL,
  `Department` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`EmployeeID`),
  KEY `OfficeID` (`OfficeID`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `officeemployee`
--

INSERT INTO `officeemployee` (`EmployeeID`, `OfficeID`, `Role`, `Department`) VALUES
(23, 4, 'Patent examiner', 'my'),
(22, 5, 'Animal nutritionist', 'beat'),
(21, 3, 'Human resources officer', 'model'),
(20, 5, 'Engineer, petroleum', 'none'),
(17, 3, 'Equities trader', 'bad'),
(15, 2, 'Geophysical data processor', 'campaign'),
(12, 3, 'Adult guidance worker', 'way'),
(11, 5, 'Theme park manager', 'letter'),
(10, 2, 'Ambulance person', 'hour'),
(4, 5, 'Airline pilot', 'not'),
(2, 1, 'Call centre manager', 'international'),
(25, 3, 'Trading standards officer', 'provide'),
(28, 2, 'Colour technologist', 'appear'),
(39, 2, 'mm', 'm');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `OrderID` int NOT NULL AUTO_INCREMENT,
  `CustomerID` int DEFAULT NULL,
  `OfficeID` int DEFAULT NULL,
  `OrderDate` date DEFAULT NULL,
  `Status` enum('Pending','Completed','Cancelled') DEFAULT NULL,
  PRIMARY KEY (`OrderID`),
  KEY `CustomerID` (`CustomerID`),
  KEY `OfficeID` (`OfficeID`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`OrderID`, `CustomerID`, `OfficeID`, `OrderDate`, `Status`) VALUES
(1, 14, 4, '2024-05-30', 'Cancelled'),
(2, 16, 3, '2024-11-21', 'Pending'),
(3, 20, 4, '2024-06-24', 'Pending'),
(4, 4, 4, '2023-08-08', 'Cancelled'),
(5, 10, 3, '2024-11-29', 'Completed'),
(6, 12, 3, '2023-06-06', 'Pending'),
(7, 8, 4, '2023-11-05', 'Cancelled'),
(8, 4, 5, '2024-08-22', 'Completed'),
(9, 10, 2, '2024-03-05', 'Cancelled'),
(10, 12, 5, '2024-08-12', 'Completed'),
(11, 17, 4, '2025-03-04', 'Pending'),
(12, 5, 5, '2023-06-13', 'Completed'),
(13, 15, 3, '2025-01-15', 'Pending'),
(14, 19, 4, '2025-05-01', 'Cancelled'),
(15, 19, 1, '2023-06-04', 'Pending'),
(16, 14, 4, '2025-05-02', 'Pending'),
(17, 8, 2, '2023-06-10', 'Cancelled'),
(18, 13, 5, '2024-08-14', 'Pending'),
(19, 18, 2, '2023-10-31', 'Completed'),
(20, 17, 4, '2023-08-29', 'Cancelled'),
(21, 19, 2, '2024-10-06', 'Pending'),
(22, 15, 3, '2024-09-07', 'Pending'),
(23, 4, 2, '2024-04-24', 'Cancelled'),
(24, 7, 2, '2024-09-07', 'Pending'),
(25, 16, 5, '2024-06-30', 'Cancelled'),
(26, 7, 5, '2023-11-12', 'Cancelled'),
(27, 2, 3, '2024-08-25', 'Completed'),
(28, 6, 5, '2024-03-08', 'Pending'),
(29, 7, 3, '2023-10-11', 'Cancelled'),
(30, 4, 3, '2024-01-31', 'Pending'),
(31, 0, 2, '2025-05-13', 'Completed'),
(32, 2, 5, '2025-05-13', 'Pending'),
(33, 2, 5, '2025-05-13', 'Pending'),
(34, 0, 5, '2025-05-05', 'Pending'),
(35, 18, 4, '2025-05-14', 'Pending'),
(36, 0, 5, '2025-05-14', 'Pending'),
(37, 22, 1, '2025-05-15', 'Completed'),
(38, 21, 5, '2025-05-15', 'Pending'),
(39, 21, 5, '2025-05-19', 'Pending'),
(40, 21, 2, '2025-06-12', 'Pending');

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

--
-- Dumping data for table `orderproduct`
--

INSERT INTO `orderproduct` (`OrderID`, `ProductID`, `Quantity`, `UnitPriceAtTime`) VALUES
(1, 3, 3, 25.56),
(1, 6, 2, 96.79),
(1, 8, 1, 58.75),
(2, 9, 3, 34.11),
(3, 4, 1, 36.43),
(3, 7, 1, 18.33),
(0, 10, 1, 30.65),
(0, 9, 22, 17.59),
(0, 8, 444, 37.23),
(0, 7, 55555, 97.59),
(32, 10, 50, 30.65),
(33, 10, 30, 30.65),
(34, 10, 666, 30.65),
(34, 9, 666, 17.59),
(35, 10, 8555555, 30.65),
(36, 7, 5, 97.59),
(36, 0, 30, 10.00),
(37, 12, 2, 9999.00),
(38, 10, 345, 30.65),
(38, 8, 345, 37.23),
(38, 7, 345, 97.59),
(39, 13, 100, 1.00),
(40, 99, 2, NULL),
(40, 3, 5, 41.67);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `ProductID` int NOT NULL AUTO_INCREMENT,
  `FactoryID` int DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Category` varchar(100) DEFAULT NULL,
  `UnitPrice` decimal(10,2) DEFAULT NULL,
  `StockQuantity` int DEFAULT NULL,
  `ProductionDate` date DEFAULT NULL,
  `ExpirationDate` date DEFAULT NULL,
  PRIMARY KEY (`ProductID`),
  KEY `FactoryID` (`FactoryID`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `FactoryID`, `Name`, `Category`, `UnitPrice`, `StockQuantity`, `ProductionDate`, `ExpirationDate`) VALUES
(10, 1, 'Modern', 'Season', 30.65, 153, '2024-03-27', '2026-04-24'),
(99, 2, 'wier', 'tool', NULL, NULL, NULL, NULL),
(7, 5, 'Dog', 'Surface', 97.59, 77, '2023-12-30', '2026-04-19'),
(4, 3, 'Thing', 'Change', 47.04, 111, '2023-11-20', '2025-07-16'),
(3, 2, 'Book', 'Media', 41.67, 66, '2023-08-12', '2025-12-01'),
(11, 5, 'glass', 'glass', 10.00, 2000, '2025-05-23', '2025-05-14'),
(12, 4, 'cocain', 'drug', 9999.00, 1000, '2025-05-15', '2025-05-15'),
(13, 5, 'melone', 'veg', 1.00, 500, '2025-05-19', '2025-05-19'),
(14, 3, 'bottle', 'plastic', 5.00, 10000, '2025-06-12', '2025-06-12');

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

--
-- Dumping data for table `rawmaterial`
--

INSERT INTO `rawmaterial` (`RawMaterialID`, `Name`, `Unit`, `CostPerUnit`, `StockQuantity`, `SupplierID`) VALUES
(17, 'Still', 'kg', 1.96, 480, 3),
(16, 'Property', 'litre', 2.16, 408, 5),
(15, 'Anything', 'unit', 5.84, 254, 4),
(14, 'Society', 'litre', 14.08, 468, 3),
(13, 'Leg', 'litre', 12.39, 489, 3),
(12, 'Onto', 'litre', 8.67, 473, 1),
(11, 'Save', 'kg', 5.46, 129, 1),
(10, 'High', 'unit', 1.30, 277, 4),
(9, 'Statement', 'unit', 1.13, 276, 4),
(8, 'Structure', 'unit', 16.50, 449, 5),
(7, 'According', 'kg', 12.60, 267, 3),
(6, 'Alone', 'unit', 10.72, 393, 3),
(5, 'Position', 'unit', 14.19, 405, 3),
(4, 'Condition', 'litre', 14.95, 162, 3),
(3, 'Adult', 'litre', 12.57, 173, 5),
(2, 'Should', 'litre', 6.91, 307, 5),
(1, 'Significant', 'kg', 19.05, 432, 3),
(18, 'She', 'kg', 3.71, 447, 2),
(19, 'Everything', 'kg', 17.83, 419, 5),
(20, 'Medical', 'kg', 2.34, 432, 2),
(0, 'nitrat', 'litre', 6.00, 10000, 5);

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

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierID`, `Name`, `CompanyName`, `Phone`, `Email`, `Location`) VALUES
(5, 'Kelly Ruiz', 'Hall, Neal and Murillo', '919.609.7219x877', 'laurenyates@schaefer.info', 'New Katieton'),
(4, 'Stephen Martinez', 'Ford-Farrell', '001-178-254-4293', 'diazmeagan@yahoo.com', 'Lawsonside'),
(3, 'Kelsey Jackson', 'Hernandez, Marsh and Holmes', '311.692.2781', 'hward@hotmail.com', 'North Katrina'),
(1, 'Julie Adams', 'Johnson-Mata', '(377)388-1939x90615', 'revans@gmail.com', 'North Larryhaven'),
(2, 'Katherine Branch', 'Perkins LLC', '+1-685-240-8119x6540', 'warrenlisa@andrews.org', 'Lindseyfort');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `OrderID` int DEFAULT NULL,
  `PaymentDate` date DEFAULT NULL,
  `AmountPaid` decimal(10,2) DEFAULT NULL,
  `Method` enum('Cash','Card','Online') DEFAULT NULL,
  `Status` enum('Success','Failed','Refunded') DEFAULT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `OrderID` (`OrderID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`TransactionID`, `OrderID`, `PaymentDate`, `AmountPaid`, `Method`, `Status`) VALUES
(1, 0, '2025-05-13', 10000.00, 'Cash', 'Success'),
(2, 33, '2025-05-13', 400.00, 'Cash', 'Success'),
(3, 34, '2025-05-05', 66600.00, 'Card', 'Success'),
(4, 35, '2025-05-14', 8555.00, 'Cash', 'Success'),
(5, 36, '2025-05-14', 1000.00, 'Card', 'Success'),
(6, 37, '2025-05-15', 1500.00, 'Cash', 'Success'),
(7, 38, '2025-05-15', 444444.00, 'Cash', 'Success'),
(8, 39, '2025-05-19', 100.00, 'Card', 'Success'),
(9, 40, '2025-06-25', 800.00, 'Card', 'Success');

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

DROP TABLE IF EXISTS `worker`;
CREATE TABLE IF NOT EXISTS `worker` (
  `EmployeeID` int NOT NULL AUTO_INCREMENT,
  `FactoryID` int DEFAULT NULL,
  `Shift` enum('Morning','Evening','Night') DEFAULT NULL,
  `Skills` text,
  `IsFullTime` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`EmployeeID`),
  KEY `FactoryID` (`FactoryID`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `worker`
--

INSERT INTO `worker` (`EmployeeID`, `FactoryID`, `Shift`, `Skills`, `IsFullTime`) VALUES
(18, 4, 'Evening', 'hit', 1),
(16, 2, 'Night', 'difficult', 1),
(13, 2, 'Evening', 'team', 1),
(5, 1, 'Night', 'add', 1),
(1, 1, 'Night', 'staff', 1),
(19, 1, 'Evening', 'magazine', 1),
(30, 4, 'Morning', 'age', 1),
(31, 23, 'Morning', '', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
