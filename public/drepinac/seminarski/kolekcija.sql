-- --------------------------------------------------------
-- Poslužitelj:                  127.0.0.1
-- Server version:               10.1.30-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Verzija:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for kolekcija
CREATE DATABASE IF NOT EXISTS `kolekcija` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `kolekcija`;

-- Dumping structure for table kolekcija.filmovi
CREATE TABLE IF NOT EXISTS `filmovi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `naslov` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_zanr` int(11) unsigned NOT NULL,
  `godina` int(4) unsigned NOT NULL,
  `trajanje` int(5) unsigned NOT NULL,
  `slika` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_filmovi_zanr` (`id_zanr`),
  CONSTRAINT `FK_filmovi_zanr` FOREIGN KEY (`id_zanr`) REFERENCES `zanr` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kolekcija.filmovi: ~5 rows (approximately)
DELETE FROM `filmovi`;
/*!40000 ALTER TABLE `filmovi` DISABLE KEYS */;
INSERT INTO `filmovi` (`id`, `naslov`, `id_zanr`, `godina`, `trajanje`, `slika`) VALUES
	(19, 'War Games', 1, 1983, 125, 'war_games_1983.jpg'),
	(22, 'Tron', 1, 1983, 125, 'tron_1982.jpg'),
	(23, 'Operation swordfish', 1, 1123, 152, 'operation_swordfish_2001.jpg'),
	(24, 'Firewall', 1, 2006, 152, 'firewall_2006.jpg'),
	(26, 'Tron legacy', 1, 2010, 111, 'tron_legacy_2010.jpg');
/*!40000 ALTER TABLE `filmovi` ENABLE KEYS */;

-- Dumping structure for table kolekcija.zanr
CREATE TABLE IF NOT EXISTS `zanr` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `naziv` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kolekcija.zanr: ~4 rows (approximately)
DELETE FROM `zanr`;
/*!40000 ALTER TABLE `zanr` DISABLE KEYS */;
INSERT INTO `zanr` (`id`, `naziv`) VALUES
	(1, 'Akcija'),
	(2, 'Povjesni'),
	(3, 'Triller'),
	(4, 'Fantastični');
/*!40000 ALTER TABLE `zanr` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
