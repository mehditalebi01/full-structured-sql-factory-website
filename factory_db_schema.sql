
-- Create the database
CREATE DATABASE IF NOT EXISTS factory_db;
USE factory_db;

-- Office Table
CREATE TABLE Office (
    OfficeID INT PRIMARY KEY,
    Name VARCHAR(100),
    Location VARCHAR(200),
    Phone VARCHAR(20),
    Email VARCHAR(100),
    ManagerID INT
);

-- Factory Table
CREATE TABLE Factory (
    FactoryID INT PRIMARY KEY,
    Name VARCHAR(100),
    Location VARCHAR(200),
    Phone VARCHAR(20),
    Email VARCHAR(100),
    EstablishedDate DATE,
    Status ENUM('Active', 'Inactive'),
    OfficeID INT,
    ManagerID INT,
    FOREIGN KEY (OfficeID) REFERENCES Office(OfficeID)
);

-- Employee Table
CREATE TABLE Employee (
    EmployeeID INT PRIMARY KEY,
    Name VARCHAR(100),
    NationalID VARCHAR(50),
    Phone VARCHAR(20),
    Email VARCHAR(100),
    HireDate DATE,
    Salary DECIMAL(10,2),
    Type ENUM('Manager', 'Worker', 'OfficeEmployee')
);

-- Manager Table
CREATE TABLE Manager (
    EmployeeID INT PRIMARY KEY,
    Level VARCHAR(50),
    ManagesEntityType ENUM('Factory', 'Office'),
    ManagesEntityID INT,
    FOREIGN KEY (EmployeeID) REFERENCES Employee(EmployeeID)
);

-- Worker Table
CREATE TABLE Worker (
    EmployeeID INT PRIMARY KEY,
    FactoryID INT,
    Shift ENUM('Morning', 'Evening', 'Night'),
    Skills TEXT,
    IsFullTime BOOLEAN,
    FOREIGN KEY (EmployeeID) REFERENCES Employee(EmployeeID),
    FOREIGN KEY (FactoryID) REFERENCES Factory(FactoryID)
);

-- OfficeEmployee Table
CREATE TABLE OfficeEmployee (
    EmployeeID INT PRIMARY KEY,
    OfficeID INT,
    Role VARCHAR(100),
    Department VARCHAR(100),
    FOREIGN KEY (EmployeeID) REFERENCES Employee(EmployeeID),
    FOREIGN KEY (OfficeID) REFERENCES Office(OfficeID)
);

-- Product Table
CREATE TABLE Product (
    ProductID INT PRIMARY KEY,
    FactoryID INT,
    Name VARCHAR(100),
    Category VARCHAR(100),
    UnitPrice DECIMAL(10,2),
    StockQuantity INT,
    ProductionDate DATE,
    ExpirationDate DATE,
    FOREIGN KEY (FactoryID) REFERENCES Factory(FactoryID)
);

-- RawMaterial Table
CREATE TABLE RawMaterial (
    RawMaterialID INT PRIMARY KEY,
    Name VARCHAR(100),
    Unit VARCHAR(20),
    CostPerUnit DECIMAL(10,2),
    StockQuantity INT,
    SupplierID INT
);

-- Supplier Table
CREATE TABLE Supplier (
    SupplierID INT PRIMARY KEY,
    Name VARCHAR(100),
    CompanyName VARCHAR(100),
    Phone VARCHAR(20),
    Email VARCHAR(100),
    Location VARCHAR(200)
);

-- Customer Table
CREATE TABLE Customer (
    CustomerID INT PRIMARY KEY,
    FullName VARCHAR(100),
    Phone VARCHAR(20),
    Email VARCHAR(100),
    Address VARCHAR(200),
    RegisteredDate DATE
);

-- Order Table
CREATE TABLE `Order` (
    OrderID INT PRIMARY KEY,
    CustomerID INT,
    OfficeID INT,
    OrderDate DATE,
    Status ENUM('Pending', 'Completed', 'Cancelled'),
    FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID),
    FOREIGN KEY (OfficeID) REFERENCES Office(OfficeID)
);

-- Transaction Table
CREATE TABLE Transaction (
    TransactionID INT PRIMARY KEY,
    OrderID INT,
    PaymentDate DATE,
    AmountPaid DECIMAL(10,2),
    Method ENUM('Cash', 'Card', 'Online'),
    Status ENUM('Success', 'Failed', 'Refunded'),
    FOREIGN KEY (OrderID) REFERENCES `Order`(OrderID)
);

-- FactoryRawMaterial (junction table)
CREATE TABLE FactoryRawMaterial (
    FactoryID INT,
    RawMaterialID INT,
    QuantityUsed INT,
    DateUsed DATE,
    PRIMARY KEY (FactoryID, RawMaterialID),
    FOREIGN KEY (FactoryID) REFERENCES Factory(FactoryID),
    FOREIGN KEY (RawMaterialID) REFERENCES RawMaterial(RawMaterialID)
);

-- OrderProduct (junction table)
CREATE TABLE OrderProduct (
    OrderID INT,
    ProductID INT,
    Quantity INT,
    UnitPriceAtTime DECIMAL(10,2),
    PRIMARY KEY (OrderID, ProductID),
    FOREIGN KEY (OrderID) REFERENCES `Order`(OrderID),
    FOREIGN KEY (ProductID) REFERENCES Product(ProductID)
);
