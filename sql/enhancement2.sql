INSERT INTO `clients`(`clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `comment`) VALUES ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', '"I am the real Ironman"');
UPDATE `clients` SET `clientLevel`=3 WHERE `clientId` = 1;
UPDATE `inventory` SET `invDescription`= replace(`invDescription`, 'small interior', 'spacious interior') WHERE UPPER(CONCAT(`invMake`,' ',`invModel`)) = 'GM HUMMER';
SELECT `invModel`, `classificationName` FROM `inventory` i INNER JOIN `carclassification` c ON i.`classificationId` = c.`classificationId` WHERE UPPER(c.`classificationName`) = 'SUV';
DELETE FROM `inventory` WHERE `invId` = 1;
UPDATE `inventory` SET `invImage`=CONCAT('/phpmotors',`invImage`),`invThumbnail`= CONCAT('/phpmotors',`invThumbnail`);
INSERT INTO `carclassification`(`classificationId`, `classificationName`) VALUES ('6','prueba');
UPDATE `inventory` SET `invImage`= replace(`invImage`, '/images/', '/images/vehicles/'), `invThumbnail`= replace(`invThumbnail`, '/images/', '/images/vehicles/') WHERE `invId`>0;