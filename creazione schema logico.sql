SET FOREIGN_KEY_CHECKS=0;
/* Creazione tabella CentriIppici */
DROP TABLE IF EXISTS `CentriIppici`;
CREATE TABLE `CentriIppici` (
    `Email` VARCHAR(40) NOT NULL,
    `Nome` VARCHAR(20) NOT NULL,
    `CodCitta` INT NOT NULL,
    `Indirizzo` VARCHAR(20) NOT NULL,
    `Tel` VARCHAR(11) NOT NULL,
    PRIMARY KEY(Email),
    FOREIGN KEY(CodCitta) REFERENCES Citta(CodCitta)
    )ENGINE=InnoDB;
/* Creazione tabella Cavalli */
DROP TABLE IF EXISTS `Cavalli`;
CREATE TABLE `Cavalli`(
    `CodPassaporto` CHAR(15) NOT NULL,
    `Nome` VARCHAR(20) NOT NULL,
    `Razza` VARCHAR(20) NOT NULL,
    `AnnoNascita` INT(4) NOT NULL,
    `Tipo` VARCHAR(20) NOT NULL,
    `CentroIppico` VARCHAR(40) NOT NULL,
    PRIMARY KEY(CodPassaporto),
    FOREIGN KEY(CentroIppico)REFERENCES CentriIppici(Email) ON DELETE CASCADE
    )ENGINE=InnoDB;
/* Creazione tabella UtentiRegistrati */
DROP TABLE IF EXISTS `UtentiRegistrati`;
CREATE TABLE `UtentiRegistrati`(
	`CodiceFiscale` CHAR(16) NOT NULL,
	`Nome` VARCHAR(20) NOT NULL,
	`Cognome` VARCHAR(20) NOT NULL,
	`DataNascita` DATE NOT NULL,
	`Risiede` INT NOT NULL,
	`CAP` CHAR(5) NOT NULL,
	`Indirizzo` VARCHAR(20) NOT NULL,
	`Email` VARCHAR(40) NOT NULL UNIQUE,
	`NumTel` VARCHAR(10),
	`Password` VARCHAR(50) NOT NULL,
	PRIMARY KEY(CodiceFiscale),
	FOREIGN KEY(Risiede) REFERENCES Citta(CodCitta)
	)ENGINE=InnoDB;
/* Creazione tabella Dipendenti */
DROP TABLE IF EXISTS `Dipendenti`;
CREATE TABLE `Dipendenti` (
	`CodDip` CHAR(16) NOT NULL,
	`CentroIppico` VARCHAR(40) NOT NULL,
	`Stipendio` DOUBLE NOT NULL,
	PRIMARY KEY(CodDip),
	FOREIGN KEY(CodDip) REFERENCES UtentiRegistrati(CodiceFiscale) ON DELETE CASCADE,
	FOREIGN KEY(CentroIppico) REFERENCES CentriIppici(Email) ON DELETE CASCADE
	) ENGINE=InnoDB;
/* Creazione tabella Amministratori */
DROP TABLE IF EXISTS `Amministratori`;
CREATE TABLE `Amministratori`(
	`CodAmm` CHAR(16) NOT NULL,
	PRIMARY KEY(CodAmm),
	FOREIGN KEY(CodAmm) REFERENCES Dipendenti(CodDip) ON DELETE CASCADE
	)ENGINE=InnoDB;
/* Creazione tabella Istruttori */
DROP TABLE IF EXISTS `Istruttori`;
CREATE TABLE `Istruttori`(
	`CodIstr` CHAR(16) NOT NULL,
	PRIMARY KEY(CodIstr),
	FOREIGN KEY(CodIstr) REFERENCES Dipendenti(CodDip) ON DELETE CASCADE
	)ENGINE=InnoDB;
/* Creazione tabella Allievi */
DROP TABLE IF EXISTS `Allievi`;
CREATE TABLE `Allievi` (
	`CodAllievo` CHAR(16) NOT NULL,
	`CodIstr` CHAR(16) NOT NULL,
	`Orario` VARCHAR(40) NOT NULL,
	`CentroIppico` VARCHAR(40) NOT NULL,
	PRIMARY KEY(CodAllievo),
	FOREIGN KEY(CodAllievo) REFERENCES UtentiRegistrati(CodiceFiscale) ON DELETE CASCADE,
	FOREIGN KEY(CodIstr) REFERENCES Istruttori(CodIstr),
	FOREIGN KEY(CentroIppico) REFERENCES CentriIppici(Email) ON DELETE CASCADE
	)ENGINE=InnoDB;
/* Creazione tabella MezzaFida */
DROP TABLE IF EXISTS `MezzaFida`;
CREATE TABLE `MezzaFida` (
	`CodMF` CHAR(16) NOT NULL,
	`CodCavallo` CHAR(15) NOT NULL,
	PRIMARY KEY(CodMF),
	FOREIGN KEY(CodMF) REFERENCES Allievi(CodAllievo) ON DELETE CASCADE,
	FOREIGN KEY(CodCavallo) REFERENCES Cavalli(CodPassaporto)
	)ENGINE=InnoDB;
/* Creazione tabella Agonistici */
DROP TABLE IF EXISTS `Agonistici`;
CREATE TABLE `Agonistici` (
	`CodAg` CHAR(16)  NOT NULL,
	`CodCavallo` CHAR(15) NOT NULL,
	`Patente` VARCHAR(10) NOT NULL,
	PRIMARY KEY(CodAg),
	FOREIGN KEY(CodAg) REFERENCES Allievi(CodAllievo) ON DELETE CASCADE,
	FOREIGN KEY(CodCavallo) REFERENCES Cavalli(CodPassaporto)
	)ENGINE=InnoDB;
/* Creazione tabella Assicurazioni */
DROP TABLE IF EXISTS `Assicurazioni`;
CREATE TABLE `Assicurazioni` (
	`CodAss` INT AUTO_INCREMENT,
	`CodAllievo` CHAR(16) NOT NULL,
	`Desc` VARCHAR(60) NOT NULL,
	`Quota` DOUBLE NOT NULL,
	`Scadenza` DATE NOT NULL,
	PRIMARY KEY(CodAss),
	FOREIGN KEY(CodAllievo) REFERENCES Allievi(CodAllievo) ON DELETE CASCADE
	)ENGINE=InnoDB;
/* Creazione tabella Richieste */
DROP TABLE IF EXISTS `Richieste`;
CREATE TABLE `Richieste` (
	`CodRichiesta` INT AUTO_INCREMENT,
	`TipoRichiesta` VARCHAR(40) NOT NULL,
	`Descrizione` VARCHAR(40) NOT NULL,
	`CodUtente` CHAR(16) NOT NULL,
	`CodAmm` CHAR(16),
	`DataConvalida` DATE,
	PRIMARY KEY(CodRichiesta),
	FOREIGN KEY(CodUtente) REFERENCES UtentiRegistrati(CodiceFiscale) ON DELETE CASCADE,
	FOREIGN KEY(CodAmm) REFERENCES Amministratori(CodAmm)
	)ENGINE=InnoDB;
/* Creazione tabella Concorsi */
DROP TABLE IF EXISTS `Concorsi`;
CREATE TABLE `Concorsi` (
	`CodConcorso` CHAR(4) NOT NULL,
	`Desc` VARCHAR(30) NOT NULL,
	`DataInizio` DATE NOT NULL,
	`DataFine` DATE NOT NULL,
	`Premio` VARCHAR(15) NOT NULL,
	PRIMARY KEY(CodConcorso)
	)ENGINE=InnoDB;
/* Creazione tabella Interni */
DROP TABLE IF EXISTS `Interni`;
CREATE TABLE `Interni` (
	`CodConcorso` CHAR(4) NOT NULL,
	`CentroIppico` VARCHAR(40) NOT NULL,
	PRIMARY KEY(CodConcorso),
	FOREIGN KEY(CodConcorso) REFERENCES Concorsi(CodConcorso) ON DELETE CASCADE,
	FOREIGN KEY(CentroIppico) REFERENCES CentriIppici(Email)
	)ENGINE=InnoDB;
/* Creazione tabella Esterni */
DROP TABLE IF EXISTS `Esterni`;
CREATE TABLE `Esterni` (
	`CodConcorso` CHAR(4) NOT NULL,
	`Organizzatore` VARCHAR(30) NOT NULL,
	`CodCitta` INT NOT NULL,
	`Indirizzo` VARCHAR(20) NOT NULL,
	`Telefono` CHAR(10),
	`Email` VARCHAR(40) NOT NULL,
	PRIMARY KEY(CodConcorso),
	FOREIGN KEY(CodConcorso) REFERENCES Concorsi(CodConcorso) ON DELETE CASCADE,
	FOREIGN KEY(CodCitta) REFERENCES Citta(CodCitta)
	)ENGINE=InnoDB;
/* Creazione tabella Partecipazioni */
DROP TABLE IF EXISTS `Partecipazioni`;
CREATE TABLE `Partecipazioni` (
	`CodConcorso` CHAR(4) NOT NULL,
	`CodAg` CHAR(16),
	`Vincitore` VARCHAR(40),
	PRIMARY KEY(CodConcorso,CodAg),
	FOREIGN KEY(CodConcorso) REFERENCES Concorsi(CodConcorso) ON DELETE CASCADE,
	FOREIGN KEY(CodAg) REFERENCES Agonistici(CodAg) ON DELETE CASCADE
	)ENGINE=InnoDB;
/* Creazione tabella Citta */
DROP TABLE IF EXISTS `Citta`;
CREATE TABLE `Citta`(
    `CodCitta` INT AUTO_INCREMENT,
    `Nome` VARCHAR(20) NOT NULL,
    `Provincia` CHAR(2),
    PRIMARY KEY(CodCitta)
    )ENGINE=InnoDB;
/* Creazione tabella Errori */
DROP TABLE IF EXISTS `Errori`;
CREATE TABLE `Errori`(
    `CodErrore` INT AUTO_INCREMENT,
    `Descrizione` VARCHAR(50),
    PRIMARY KEY(CodErrore)
    )ENGINE=InnoDB;
SET FOREIGN_KEY_CHECKS=1;
