<?php
try {  	
	$pdo = new PDO ("mysql:host=localhost","root","");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "CREATE DATABASE IF NOT EXISTS acmeArtsDB";
	executeStmt($pdo,$sql);
					
	$sql = "USE acmeArtsDB";
	executeStmt($pdo,$sql);
	
	$sql = "DROP TABLE IF EXISTS Painting";
	executeStmt($pdo,$sql);

	$sql = "DROP TABLE IF EXISTS Artist";
	executeStmt($pdo,$sql);
		
	//Created two field BornYear and DeathYear 
	//Had used INT instead of YEAR data type for both BornYear and DeathYear because I found that if I put YEAR as datatype it will input 0000 for the year before 1900.
	$sql = "CREATE TABLE Artist(
			Id INT NOT NULL AUTO_INCREMENT,
			ArtistName VARCHAR(255) NOT NULL,
			BornYear INT,
			DeathYear INT,
			Thumbnail BLOB,
			PRIMARY KEY (Id)
			)";
	executeStmt($pdo,$sql);
	
	
	$sql = "INSERT INTO Artist(ArtistName,BornYear,DeathYear,Thumbnail)
			VALUES 
				('August Renoir',1841,1919, NULL),          
				('Michelangelo',1475,1564, NULL),           
				('Vincent Van Gogh',1853,1890 , NULL),       
				('Leonardo da Vinci',1452,1519, NULL),      
				('Claude Monet',1840,1926, NULL),           
				('Pablo Picasso',1881,1973, NULL),          
				('Salvador Dali',1904,1989, NULL),          
				('Paul Cezanne',1839,1906, NULL)";          
	executeStmt($pdo,$sql);
	
	$sql = "DROP TABLE IF EXISTS Style";
	executeStmt($pdo,$sql);
					
	$sql = "CREATE TABLE Style(
			Id INT NOT NULL AUTO_INCREMENT,
			ArtStyle VARCHAR(255) NOT NULL,
			PRIMARY KEY (Id)
			)";
	executeStmt($pdo,$sql);
	
	$sql = "INSERT INTO Style(ArtStyle)
			VALUES 
				('Impressionism'),      
				('Mannerism'),			
				('Still-life'),			
				('Portrait'),			
				('Realism'),			
				('Cubism'),				
				('Surrealism')";		
	executeStmt($pdo,$sql);
	
	$sql = "DROP TABLE IF EXISTS Media";
	executeStmt($pdo,$sql);
	
	$sql = "CREATE TABLE Media(
			Id INT NOT NULL AUTO_INCREMENT,
			Medium VARCHAR(255) NOT NULL,
			PRIMARY KEY (Id)
			)";
	executeStmt($pdo,$sql);
	
	$sql = "INSERT INTO Media(Medium)
			VALUES 
				('oil'),            
				('pen-ink')";       
	executeStmt($pdo,$sql);

	//ON DELETE SET Null will set the column to null when the parent row is deleted.
	//ON UPDATE CASCADE will tells the database that when an update occurs on the referenced column from the parent table (Id), it must automatically update the matching rows in the child table (''painting) with the new value.
	$sql = "CREATE TABLE Painting(
			Id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
			Title VARCHAR(255) NOT NULL,
			Year INT NOT NULL,
			Thumbnail BLOB,
			Image LONGBLOB,
			ArtistId INT,
			ArtStyleId INT,
			MediumId INT(255),
			FOREIGN KEY(ArtistId) REFERENCES Artist(Id) ON DELETE SET NULL ON UPDATE CASCADE,
			FOREIGN KEY(ArtStyleId) REFERENCES Style(Id) ON DELETE SET NULL ON UPDATE CASCADE,
			FOREIGN KEY(MediumId) REFERENCES Media(Id) ON DELETE SET NULL ON UPDATE CASCADE
			);";
	executeStmt($pdo,$sql);
	
	$sql = array(
		"INSERT INTO `Painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistId`, `ArtStyleId`, `MediumId`) VALUES ('Bal du moulin de la Galette', '1876', NULL, NULL, 1, 1, 1);",

		"INSERT INTO `Painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistId`, `ArtStyleId`, `MediumId`) VALUES ('Doni Tondo (Doni Madonna)', '1507', NULL, NULL, 2, 2, 1);",

		"INSERT INTO `Painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistId`, `ArtStyleId`, `MediumId`) VALUES ('Vase with Twelve Sunflowers', '1888', NULL, NULL, 3, 3, 1);",

		"INSERT INTO `Painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistId`, `ArtStyleId`, `MediumId`) VALUES ('Mona Lisa', '1503', NULL, NULL, 4, 4, 1);",

		"INSERT INTO `Painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistId`, `ArtStyleId`, `MediumId`) VALUES ('The Potato Eaters', '1885', NULL, NULL, 3, 5, 1);",

		"INSERT INTO `Painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistId`, `ArtStyleId`, `MediumId`) VALUES ('Sunrise', '1972', NULL, NULL, 5, 1, 1);",

		"INSERT INTO `Painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistId`, `ArtStyleId`, `MediumId`) VALUES ('Weaver', '1884', NULL, NULL, 3, 5, 1);",

		"INSERT INTO `Painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistId`, `ArtStyleId`, `MediumId`) VALUES ('Nature morte au compotier', '1914', NULL, NULL, 6, 6, 1);",

		"INSERT INTO `Painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistId`, `ArtStyleId`, `MediumId`) VALUES ('Houses of Parliament', '1899', NULL, NULL, 5, 1, 1);",

		"INSERT INTO `Painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistId`, `ArtStyleId`, `MediumId`) VALUES ('Cafe Terrace at Night', '1888', NULL, NULL, 3, 1, 1);",

		"INSERT INTO `Painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistId`, `ArtStyleId`, `MediumId`) VALUES ('At the Lapin Agile', '1905', NULL, NULL, 6, 1, 1);",

		"INSERT INTO `Painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistId`, `ArtStyleId`, `MediumId`) VALUES ('The Persistence of Memory', '1931', NULL, NULL, 7, 7, 1);",

		"INSERT INTO `Painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistId`, `ArtStyleId`, `MediumId`) VALUES ('The Hallucinogenic Toreador', '1970', NULL, NULL, 7, 7, 1);",

		"INSERT INTO `Painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistId`, `ArtStyleId`, `MediumId`) VALUES ('Jaz de Bouffan', '1877', NULL, NULL, 8, 1, 1);",

		"INSERT INTO `Painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistId`, `ArtStyleId`, `MediumId`) VALUES ('Vitruvian Man', '1490', NULL, NULL, 4, 5, 2);",

		"INSERT INTO `Painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistId`, `ArtStyleId`, `MediumId`) VALUES ('The Kingfisher', '1495', NULL, NULL, 3, 5, 2);",
	);
	foreach($sql as $insert) {
		executeStmt($pdo,$insert);
	}				
} catch(PDOException $e) {
	die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}			
unset($pdo);

function executeStmt($pdo, $sql) {
	if($stmt = $pdo -> prepare($sql)){
		if($stmt->execute()){
			unset($stmt);}}
}