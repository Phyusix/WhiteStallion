/* Ritorna true se il cavallo non è in affidamento altrimenti ritorna false */
DELIMITER $
DROP FUNCTION IF EXISTS `CavalloSenzaFida`$
CREATE FUNCTION CavalloSenzaFida(CodPassaporto INT(15))
RETURNS BOOLEAN
BEGIN
	DECLARE Allievi INT;
	SELECT COUNT(CodAg) INTO Allievi
	FROM Agonistici
	WHERE CodCavallo=CodPassaporto;
	IF (NOT Allievi) THEN
		SELECT COUNT(CodMF) INTO Allievi
		FROM MezzaFida
		WHERE CodCavallo=CodPassaporto;
	END IF;
	IF (NOT Allievi) THEN
		RETURN TRUE;
	ELSE
		RETURN FALSE;
	END IF;
END $
/* Ritorna true se il cavallo è in affidamento ad un solo mezzafida altrimenti ritorna false */
DROP FUNCTION IF EXISTS `CavalloMezzaFida`$
CREATE FUNCTION CavalloMezzaFida(CodPassaporto CHAR(15))
RETURNS BOOLEAN
BEGIN
	DECLARE Allievi INT;
	SELECT COUNT(CodMF) INTO Allievi
	FROM MezzaFida
	WHERE CodCavallo=CodPassaporto;
	IF (Allievi=1) THEN
		RETURN TRUE;
	ELSE
		RETURN FALSE;
	END IF;
END $

/* Cerca l'istruttore con il minor numero di allievi */
DROP FUNCTION IF EXISTS `MinAllievi`$
CREATE FUNCTION MinAllievi(Centro VARCHAR(40)) RETURNS CHAR(16)
BEGIN
	DECLARE Istr CHAR(16);
	SELECT CodIstr INTO Istr
	FROM (SELECT CodIstr, MIN(count)
	FROM (SELECT CodIstr,COUNT(CodIstr) AS count
		FROM Allievi WHERE CentroIppico=Centro
		GROUP BY CodIstr) AS Query1‏) AS Query2;
	RETURN Istr;
END $

/* Cambio orario */
DROP PROCEDURE IF EXISTS  `CambioO`$
CREATE PROCEDURE CambioO(OrarioN VARCHAR(36), CodUtente CHAR(16))
BEGIN
	UPDATE `Allievi`
	SET Orario=OrarioN
	WHERE CodAllievo=CodUtente;
END $

/* Aggiorna patente*/
DROP PROCEDURE IF EXISTS  `AggPat`$
CREATE PROCEDURE AggPat(PatenteN VARCHAR(36), CodUtente CHAR(16))
BEGIN
	UPDATE `Agonistici`
	SET Patente=PatenteN
	WHERE CodAg=CodUtente;
END $

/* Iscrizione ad allievi senza fida */
DROP PROCEDURE IF EXISTS `Iscrizione`$
CREATE PROCEDURE Iscrizione(CentroN VARCHAR(36), CodUtente CHAR(16))
BEGIN
	INSERT INTO `Allievi` (`CodAllievo`, `CodIstr`, `Orario`, `CentroIppico`)
	VALUES (CodUtente,MinAllievi(CentroN),'Da definire',CentroN);
	INSERT INTO `Assicurazioni`(`CodAllievo`, `Desc`, `Quota`, `Scadenza`)
	VALUES (CodUtente,'Ass. ann infortuni', 20,CURDATE());
END $

/* Cambio abbonamento da Agonistici o MezzaFida ad Allievi senza fida */
DROP PROCEDURE IF EXISTS `CaabAllievi`$
CREATE PROCEDURE CaabAllievi(CodUtente CHAR(16), Abb VARCHAR(10))
BEGIN
	IF (Abb='agonistici') THEN
		DELETE FROM `Agonistici`
		WHERE CodAg=CodUtente;
	ELSE
		DELETE FROM `MezzaFida`
		WHERE CodMF=CodUtente;
	END IF;
END $

/* Cambio abbonamento da Allievi senza fida ad Agonistici o MezzaFida */
DROP PROCEDURE IF EXISTS `CaabMForAG`$
CREATE PROCEDURE CaabMForAG(CodUtente CHAR(16), Abb VARCHAR(10),CentroI VARCHAR(40))
BEGIN
	DECLARE Cavallo CHAR(15);
	IF (Abb='agonistici') THEN
		SELECT CodPassaporto INTO Cavallo
		FROM Cavalli
		WHERE CentroIppico=CentroI AND CavalloSenzaFida(CodPassaporto)>0;
		IF (Cavallo) THEN
			INSERT INTO `Agonistici`(`CodAg`, `CodCavallo`, `Patente`)
			VALUES (CodUtente,Cavallo,'Dadefinire');
		END IF;
	ELSE
		IF (Abb='mezzafida') THEN
			SELECT CodPassaporto INTO Cavallo
			FROM Cavalli
			WHERE CentroIppico=CentroI AND CavalloMezzaFida(CodPassaporto)>0;
			IF (Cavallo) THEN
				INSERT INTO `MezzaFida`(`CodMF`, `CodCavallo`)
				VALUES (CodUtente,Cavallo);
			ELSE
				SELECT CodPassaporto INTO Cavallo
				FROM Cavalli
				WHERE CentroIppico=CentroI AND CavalloSenzaFida(CodPassaporto)>0;
				IF (Cavallo) THEN
					INSERT INTO `MezzaFida`(`CodMF`, `CodCavallo`)
					VALUES (CodUtente,Cavallo);
				END IF;
			END IF;
		END IF;
	END IF;
END $

/* Cambio abbonamento da MezzaFida ad agonistici */
DROP PROCEDURE IF EXISTS `CaabMFtoAG`$
CREATE PROCEDURE CaabMFtoAG(CodUtente CHAR(16), CentroI VARCHAR(40))
BEGIN
	DECLARE Cavallo CHAR(15);
	DECLARE C CHAR(15);
	DECLARE Cod CHAR(16);
	DECLARE cur CURSOR FOR SELECT CodPassaporto	FROM Cavalli WHERE CentroIppico=CentroI AND CavalloSenzaFida(CodPassaporto)>0;
	OPEN cur;
	SELECT CodCavallo INTO Cavallo
	FROM MezzaFida
	WHERE CodMF=CodUtente;
	DELETE FROM `MezzaFida`
	WHERE CodMF=CodUtente;
	SELECT CodUtente INTO Cod
	FROM MezzaFida
	WHERE CodCavallo=Cavallo;
	IF (NOT Cod) THEN
		INSERT INTO `Agonistici`(`CodAg`, `CodCavallo`, `Patente`)
		VALUES (CodUtente,Cavallo,'Dadefinire');
	ELSE
		FETCH cur INTO C;
		IF (C) THEN
			INSERT INTO `Agonistici`(`CodAg`, `CodCavallo`, `Patente`)
			VALUES (CodUtente,C,'Dadefinire');
		END IF;
		CLOSE cur;
	END IF;
END $

/* Cambio abbonamento da Agonistici a MezzaFida */
DROP PROCEDURE IF EXISTS `CaabAGtoMF`$
CREATE PROCEDURE CaabAGtoMF(CodUtente CHAR(16))
BEGIN
	DECLARE Cavallo CHAR(15);
	SELECT CodCavallo INTO Cavallo
	FROM Agonistici
	WHERE CodAg=CodUtente;
	DELETE FROM `Agonistici`
	WHERE CodAg=CodUtente;
	INSERT INTO `MezzaFida`(`CodMF`, `CodCavallo`)
	VALUES (CodUtente,Cavallo);
END $

/* Trigger che gestisce le richieste */
DROP TRIGGER IF EXISTS ConfermaRichiesta$
CREATE TRIGGER ConfermaRichiesta
BEFORE UPDATE ON Richieste
FOR EACH ROW
BEGIN
	DECLARE Codice CHAR(16);
	DECLARE CentroI VARCHAR(40);
	SELECT CentroIppico INTO CentroI
	FROM Allievi
	WHERE CodAllievo=OLD.CodUtente;
	IF (NEW.DataConvalida IS NOT NULL) THEN
		IF (OLD.TipoRichiesta='Cambio orario') THEN
			CALL CambioO(OLD.Descrizione,OLD.CodUtente);
		ELSE
			IF (OLD.TipoRichiesta='Iscrizione') THEN
				CALL Iscrizione(OLD.Descrizione,OLD.CodUtente);
			ELSE
				IF (OLD.TipoRichiesta='Aggiorna patente') THEN
					CALL AggPat(OLD.Descrizione,OLD.CodUtente);
				ELSE
					IF (OLD.TipoRichiesta='Cambio abbonamento') THEN
						SELECT CodAg INTO Codice FROM Agonistici WHERE CodAg=OLD.CodUtente;
						IF (Codice IS NULL) THEN
							SELECT CodMF INTO Codice FROM MezzaFida WHERE CodMF=OLD.CodUtente;
							IF (Codice IS NULL) THEN
								IF (OLD.Descrizione='mezzafida') THEN
									CALL CaabMForAG(OLD.CodUtente,'mezzafida',CentroI);
								ELSE
									IF (OLD.Descrizione='agonistici') THEN
										CALL CaabMForAG(OLD.CodUtente,'agonistici',CentroI);
									END IF;
								END IF;
							ELSE
								IF (OLD.Descrizione='allievi') THEN
									CALL CaabAllievi(OLD.CodUtente,'mezzafida');
								ELSE
									IF (OLD.Descrizione='agonistici') THEN
										CALL CaabMFtoAG(OLD.CodUtente,CentroI);
									END IF;
								END IF;
							END IF;
						ELSE
							IF (OLD.Descrizione='allievi') THEN
								CALL CaabAllievi(OLD.CodUtente,'agonistici');
							ELSE
								IF (OLD.Descrizione='mezzafida') THEN
									CALL CaabAGtoMF(OLD.CodUtente);
								END IF;
							END IF;
						END IF;
					END IF;
				END IF;
			END IF;
		END IF;
	END IF;
END $

/* Trigger che controlla l'età di un utente che si vuole registrare */
DROP TRIGGER IF EXISTS ControlloEta$
CREATE TRIGGER ControlloEta
BEFORE INSERT ON UtentiRegistrati
FOR EACH ROW
BEGIN
	IF (YEAR(CURDATE())-YEAR(NEW.DataNascita)<8) THEN
		INSERT INTO `Errori` (`CodErrore`,`Descrizione`)
		VALUE (NULL,NULL);
	ELSE
		IF (MONTH(CURDATE())>MONTH(NEW.DataNascita) && YEAR(CURDATE())-YEAR(NEW.DataNascita)=7) THEN
			INSERT INTO `Errori` (`CodErrore`,`Descrizione`)
			VALUE (NULL,NULL);
		ELSE
			IF (DAY(CURDATE())>DAY(NEW.DataNascita) && MONTH(CURDATE())=MONTH(NEW.DataNascita) && YEAR(CURDATE())-YEAR(NEW.DataNascita)=7) THEN
				INSERT INTO `Errori` (`CodErrore`,`Descrizione`)
				VALUE (NULL,NULL);	
			END IF;
		END IF;	
	END IF;
END $
