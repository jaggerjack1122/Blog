Page & Functionality
________________________

Home Page
-View Article
-Paginated Records
-Able to sort according to Create Date

Category
-Add Category
-Delete Category

Article
-Add Article
-Multi Select Category
-Delete Article
-Update Article


Database Structure
_______________________
Database Name: Blog

Article Table:- (Store Article Detail)
----------------------------------------

CREATE TABLE `article` (
 `ID` int(11) NOT NULL AUTO_INCREMENT,
 `Title` varchar(100) NOT NULL,
 `Description` varchar(255) NOT NULL,
 `Author` varchar(100) NOT NULL,
 `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8

Category Table:- (Store Category Detail)
----------------------------------------

CREATE TABLE `category` (
 `ID` int(11) NOT NULL AUTO_INCREMENT,
 `Category` varchar(100) NOT NULL,
 `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8

Article Category:- (Link Article to Category, Enable Many-To-Many relationship)
----------------------------------------

CREATE TABLE `article_category` (
 `ID` int(11) NOT NULL AUTO_INCREMENT,
 `ArticleID` int(8) NOT NULL,
 `CategoryID` int(8) NOT NULL,
 PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8

