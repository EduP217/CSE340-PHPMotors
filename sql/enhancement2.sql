INSERT INTO `clients`(`clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `comment`) VALUES ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', '"I am the real Ironman"');
UPDATE `clients` SET `clientLevel`=3 WHERE `clientId` = 1;
UPDATE `inventory` SET `invDescription`= replace(`invDescription`, 'small interior', 'spacious interior') WHERE UPPER(CONCAT(`invMake`,' ',`invModel`)) = 'GM HUMMER';
SELECT `invModel`, `classificationName` FROM `inventory` i INNER JOIN `carclassification` c ON i.`classificationId` = c.`classificationId` WHERE UPPER(c.`classificationName`) = 'SUV';
DELETE FROM `inventory` WHERE `invId` = 1;
UPDATE `inventory` SET `invImage`=CONCAT('/phpmotors',`invImage`),`invThumbnail`= CONCAT('/phpmotors',`invThumbnail`);
INSERT INTO `carclassification`(`classificationId`, `classificationName`) VALUES ('6','prueba');
UPDATE `inventory` SET `invImage`= replace(`invImage`, '/images/', '/images/vehicles/'), `invThumbnail`= replace(`invThumbnail`, '/images/', '/images/vehicles/') WHERE `invId`>0;

CREATE TABLE `phpmotors`.`images` ( `ImgId` INT NOT NULL AUTO_INCREMENT , `InvId` INT NOT NULL , `ImgName` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL , `ImgPath` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL , `ImgDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `ImgPrimary` TINYINT(1) NOT NULL DEFAULT '0' , PRIMARY KEY (`ImgId`)) ENGINE = InnoDB;
ALTER TABLE `images` CHANGE `ImgId` `ImgId` INT UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `images` CHANGE `InvId` `InvId` INT UNSIGNED NOT NULL;
ALTER TABLE `images` ADD FOREIGN KEY (`InvId`) REFERENCES `inventory`(`invId`) ON DELETE RESTRICT ON UPDATE RESTRICT;