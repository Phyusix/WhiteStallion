SET FOREIGN_KEY_CHECKS=0;
INSERT INTO `CentriIppici` (`Email`, `Nome`, `CodCitta`, `Indirizzo`, `Tel`)
VALUES ('centroippico3province@email.it', 'Tre province', '2', 'Via M. Buonarroti, 3', '0422271893'),
('centroippicoiciliegi@email.it', 'I ciliegi', '3', 'Via i ciliegi, 1', '0442675418'),
('centroippicolefarfalle@email.it', 'Le farfalle', '1', 'Via le farfalle, 43', '0422371987'),
('centroippicotrullalla@email.it', 'Trullallà', '6', 'Via Trullallà, 12', '0342875009');

INSERT INTO `Citta`(`Nome`, `Provincia`) VALUES
('Quinto di Treviso', 'TV'),
('Treviso', 'TV'),
('Zimella', 'VR'),
('Soave',  'VR'),
('Livigno',  'SO'),
('Verona',  'VR'),
('Padova',  'PD'),
('Sondrio',  'SO'),
('Abano Terme', 'PD');

INSERT INTO `UtentiRegistrati`(`CodiceFiscale`, `Nome`, `Cognome`, `DataNascita`, `Risiede`, `CAP`, `Indirizzo`, `Email`, `NumTel`, `Password`) VALUES
('BSGMRC91P14I775F', 'Marco', 'Boseggia', '1991-09-14', '3', '37040', 'via random', 'marco@email.com', '34728459128', MD5('CaneGatto')),
('ZNLSML92C09L781Q', 'Samuele', 'Zanella',  '1992-03-09', '4', '37038', 'via castello', 'john@email.com', NULL, MD5('emmawatson')),
('LRSMSS94M60Z132C', 'Melissa', 'Larsson', '1994-08-20', '7', '37121', 'via Dante', 'melissa@email.com', NULL, MD5('ilovecats')),
('MSTGRG83S25L781Z', 'Giorgio', 'Mastrota', '1983-11-25', '4', '37038', 'via dei caduti', 'giorgio@email.com', NULL, MD5('pentole')),
('NSGFLV90B66L781F', 'Flavia', 'Insegno', '1990-02-26', '4', '37038', 'via Roma', 'flavia@email.com', NULL, MD5('teacher')),
('FRLMTT92B07G224L', 'Matteo', 'Furlan', '1992-02-07', '3', '37040', 'via Napoli', 'furly@email.com', NULL, MD5('furlyfurlan')),
('RSSDRD85D27I775R', 'Edoardo', 'Rossi', '1985-04-27', '7', '37044', 'via Roveggio', 'rossi@email.com', '32648312902', MD5('erossi')),
('MNNGNN93C53C890G', 'Giovanna', 'Menna', '1993-03-13', '7', '37044', 'viale del lavoro', 'gmenna@email.com', NULL, MD5('bravagiovanna')),
('NROSRN85H54I829K', 'Sharon', 'Nori', '1985-06-14', '8', '35121', 'via Sicilia', 'sharon@email.com', NULL, MD5('temptation')),
('BRDMHL83L30I829O', 'Michele', 'Bordin', '1983-07-30', '8', '35121', 'via Venezia', 'michele@email.com', NULL, MD5('m1ch3l3')),
('BDNLXA92H06I829I', 'Alex', 'Badan', '1992-06-06', '6', '23030', 'via del monte', 'balex@email.com', NULL, MD5('thegame')),
('ZLNLSN93L43I829X', 'Alessandra', 'Zuliani', '1993-07-03', '6', '23030', 'via del monte', 'alessandra@email.com', NULL, MD5('alexzul')),
('BSNRCR93L06Z225J', 'Riccardo', 'Biasin', '1993-07-06', '6', '23030', 'via Battisti', 'R1ckyTh3B3st@email.com', '3475692837', MD5('iamthebest')),
('DMNNGL93M10I829Q', 'Angelo', 'Damiani', '1993-08-10', '6', '23030', 'via gatto', 'angelo@email.com', NULL, MD5('omglol')),
('NGRDNI85E64G224F', 'Diana', 'Negri', '1985-05-24', '6', '23030', 'via corridore', 'diana@email.com', NULL, MD5('ilovebooks')),
('MRCJNF92M49I829I', 'Jennifer', 'Marcati', '1992-08-09', '8', '35121', 'via Roma', 'jennifer@email.com', NULL, MD5('jmarcer')),
('CHNMGV93H42L407L', 'Maria Giovanna', 'Chinellato', '1993-06-02' , '1', '31055', 'via dei pioppi', 'mery@email.com', NULL, MD5('password')),
('DMANTN83C06L407J', 'Antonio', 'Adami', '1983-03-06', '2', '31100', 'via Rimini', 'antonio@email.com', NULL, MD5('antofacaldo')),
('CBLTMS87L26I775B', 'Tomas', 'Cobalto', '1987-07-26', '1', '31055', 'via stazionaria', 'tomas@email.com', NULL, MD5('iloveps')),
('CSTVLR93M46L407V', 'Valeria', 'Costa', '1993-10-06', '2', '31100', 'via Rimini', 'valeria@email.com', '32746182456', MD5('what')),
('MRCCLD80E07I775J', 'Claudio', 'Maroccolo', '1980-05-07', '1', '31055', 'viale Europa', 'claudio@email.com', NULL, MD5('clacla')),
('FRCNLS94H05L407G', 'Nicolas', 'Fracaro', '1994-06-05', '2', '31100', 'via Abruzzo', 'nicolas@email.com', '34526783921', MD5('nickfra')),
('ZNCSRA92B47L407S', 'Sara', 'Zanconato', '1992-02-07', '1', '31055', 'via Alfieri', 'sara@email.com', NULL, MD5('saretta')),
('BLCGDI91M51L407P', 'Giada', 'Balocco', '1991-10-11', '2', '31100', 'via Bachelet', 'giada@email.com', '34726304829', MD5('giadina')),
('SPGJSC85A44G224V', 'Jessica', 'Spagna', '1985-01-04', '9', '35031', 'via delle acacie', 'jessica@email.com', NULL, MD5('j3ss1ka')),
('RMPFPP93P11L781G','Filippo', 'Rampado', '1993-09-11', '8', '35121', 'via napoli', 'filippo@email.com', NULL, MD5('parapeep')),
('FRRMNL83H02G224R', 'Manuel', 'Ferrari', '1983-06-02', '9', '35031', 'via carota', 'manuel@email.com', NULL, MD5('mferrari')),
('PDLSRG85L23G224X', 'Sergio', 'Pedelini', '1985-07-23', '8', '35121', ' via Vittorio Veneto', 'sergio@email.com', '34728349281', MD5('speede')),
('BLDMSM92D05G224P', 'Massimo', 'Baldassarri', '1992-04-05', '9', '35031', 'via Erizzo', 'massimo@email.com', NULL, MD5('iliketrains')),
('SCHDNL91E61G224U', 'Daniela', 'Schio', '1991-05-21', '8', '35121', 'via romana', 'daniela@email.com', NULL, MD5('Ragdoll')),
('GRDMRA94P41I775G', 'Maria', 'Giardinelli', '1994-09-01', '8', '35121', 'via Paolotti', 'maria@email.com', NULL, MD5('pieflavour')),
('GNTRKE93D50G224U', 'Erika', 'Gentilin', '1993-04-10', '8', '35121', 'via Agrigento', 'erika@email.com', NULL, MD5('utopia'));

INSERT INTO `Allievi`(`CodAllievo`, `CodIstr`, `Orario`, `CentroIppico`) VALUES
('CHNMGV93H42L407L', 'CBLTMS87L26I775B', 'LU ME VE 14:00-15:00','centroippico3province@email.it'),
('CSTVLR93M46L407V', 'CBLTMS87L26I775B', 'MA GI VE 15:00-16:00','centroippico3province@email.it'),
('FRCNLS94H05L407G', 'CBLTMS87L26I775B', 'MA GI VE 15:00-16:00','centroippico3province@email.it'),
('BLCGDI91M51L407P', 'CBLTMS87L26I775B', 'LU ME VE 14:00-15:00','centroippico3province@email.it'),
('ZNLSML92C09L781Q', 'RSSDRD85D27I775R', 'LU ME VE 16:00-17:00','centroippicoiciliegi@email.it'),
('LRSMSS94M60Z132C', 'RSSDRD85D27I775R', 'LU ME VE 16:00-17:00','centroippicoiciliegi@email.it'),
('FRLMTT92B07G224L', 'RSSDRD85D27I775R', 'MA GI SA 17:00-18:00','centroippicoiciliegi@email.it'),
('MNNGNN93C53C890G', 'RSSDRD85D27I775R', 'MA GI SA 17:00-18:00','centroippicoiciliegi@email.it'),
('BDNLXA92H06I829I', 'NROSRN85H54I829K', 'MA GI SA 14:00-15:00', 'centroippicotrullalla@email.it'),
('ZLNLSN93L43I829X', 'NROSRN85H54I829K', 'MA GI SA 14:00-15:00', 'centroippicotrullalla@email.it'),
('BSNRCR93L06Z225J', 'NROSRN85H54I829K', 'LU ME VE 14:00-15:00', 'centroippicotrullalla@email.it'),
('DMNNGL93M10I829Q', 'NROSRN85H54I829K', 'LU ME VE 14:00-15:00', 'centroippicotrullalla@email.it'),
('RMPFPP93P11L781G', 'SPGJSC85A44G224V', 'MA ME GI 14:00-15:00', 'centroippicolefarfalle@email.it'),
('BLDMSM92D05G224P', 'SPGJSC85A44G224V', 'MA ME GI 14:00-15:00', 'centroippicolefarfalle@email.it'),
('GRDMRA94P41I775G', 'SPGJSC85A44G224V', 'LU MA VE 14:00-15:00', 'centroippicolefarfalle@email.it'),
('GNTRKE93D50G224U', 'SPGJSC85A44G224V', 'LU MA VE 14:00-15:00', 'centroippicolefarfalle@email.it');

INSERT INTO `Agonistici`(`CodAg`, `CodCavallo`, `Patente`) VALUES 
('CHNMGV93H42L407L', '393027592748596', '2638532'),
('ZNLSML92C09L781Q', '123757893755634', '2364678'),
('DMNNGL93M10I829Q', '908231439832433', '2537459'),
('GRDMRA94P41I775G', '123704390859798', '2849567');

INSERT INTO `MezzaFida`(`CodMF`, `CodCavallo`) VALUES
('FRCNLS94H05L407G', '453454765726546'),
('CSTVLR93M46L407V', '453454765726546'),
('FRLMTT92B07G224L', '839284935056896'),
('MNNGNN93C53C890G', '839284935056896'),
('ZLNLSN93L43I829X', '843850968507002'),
('BDNLXA92H06I829I', '843850968507002'),
('BLDMSM92D05G224P', '653879457804357'),
('RMPFPP93P11L781G', '653879457804357');

INSERT INTO `Dipendenti`(`CodDip`, `CentroIppico`, `Stipendio`) VALUES
('BSGMRC91P14I775F' , 'centroippicoiciliegi@email.it','2500.00'),
('RSSDRD85D27I775R' , 'centroippicoiciliegi@email.it','2000.00'),
('MSTGRG83S25L781Z' , 'centroippicoiciliegi@email.it','1500.00'),
('DMANTN83C06L407J' , 'centroippico3province@email.it','2500.00'),
('CBLTMS87L26I775B' , 'centroippico3province@email.it','2000.00'),
('MRCCLD80E07I775J' , 'centroippico3province@email.it','1500.00'),
('NGRDNI85E64G224F' , 'centroippicotrullalla@email.it','2500.00'),
('NROSRN85H54I829K' , 'centroippicotrullalla@email.it','2000.00'),
('BRDMHL83L30I829O' , 'centroippicotrullalla@email.it','1500.00'),
('FRRMNL83H02G224R' , 'centroippicolefarfalle@email.it','2500.00'),
('SPGJSC85A44G224V' , 'centroippicolefarfalle@email.it','2000.00'),
('PDLSRG85L23G224X' , 'centroippicolefarfalle@email.it','1500.00');

INSERT INTO `Istruttori`(`CodIstr`) VALUES
('CBLTMS87L26I775B'),
('RSSDRD85D27I775R'),
('NROSRN85H54I829K'),
('SPGJSC85A44G224V');

INSERT INTO `Amministratori`(`CodAmm`) VALUES
('BSGMRC91P14I775F'),
('NGRDNI85E64G224F'),
('DMANTN83C06L407J'),
('FRRMNL83H02G224R');

INSERT INTO `Cavalli` (`CodPassaporto`, `Nome`, `Razza`, `AnnoNascita`, `Tipo`, `CentroIppico`)
VALUES ('453454765726546', 'Uzzano', 'Arabo-Sardo', '1993', 'Salto ostacoli', 'centroippico3province@email.it'),
('393027592748596', 'Utopia', 'Sardo', '1988', 'Salto ostacoli', 'centroippico3province@email.it'),
('198305439589089', 'Tell', 'Andaluso', '1895', 'Dressage', 'centroippicotrullalla@email.it'),
('908231439832433', 'Ramino', 'Akhal-Teke', '1994', 'Dressage', 'centroippicotrullalla@email.it'),
('843850968507002', 'Canaris', 'Shire', '1994', 'Endurance', 'centroippicotrullalla@email.it'),
('123704390859798', 'Odille', 'Lipizzano', '1993', 'Reining', 'centroippicolefarfalle@email.it'),
('123757893755634', 'Crisos', 'Purosangue inglese', '1986', 'Polo', 'centroippicoiciliegi@email.it'),
('839284935056896', 'Lion Heart', 'Falabella', '1989', 'Salto ostacoli', 'centroippicoiciliegi@email.it'),
('653879457804357', 'Green More', 'Arabo-Sardo', '1995', 'Endurance', 'centroippicolefarfalle@email.it');

INSERT INTO `Concorsi` (`CodConcorso`, `Desc`, `DataInizio`, `DataFine`, `Premio`)
VALUES ('CSO1', 'Salto ostacoli', '2013-02-01', '2013-02-02', 'Finimenti'),
('CSO2', 'Salto ostacoli', '2013-02-01', '2013-02-02', 'Finimenti'),
('CEN1', 'Endurance', '2013-06-17', '2013-06-18', '200,00 €'),
('CSO3', 'Salto ostacoli', '2013-07-08', '2013-07-08', 'Finimenti'),
('CDR1', 'Dressage', '2013-07-21', '2013-07-22', 'Coppa'),
('CRE1', 'Reining', '2013-08-12', '2013-08-12', 'Coppa'),
('CDR2', 'Dressage', '2013-09-11', '2013-09-12', 'Finimenti'),
('CPO1', 'Polo', '2014-01-21', '2014-01-22', '100,00 €'),
('CSO4', 'Salto ostacoli', '2014-06-20', '2014-06-20', 'Coppa'),
('CSO5', 'Salto ostacoli', '2014-07-28', '2014-07-28', '300,00 €');

INSERT INTO `Interni` (`CodConcorso`, `CentroIppico`)
VALUES ('CSO1', 'centroippicoiciliegi@email.it'),
('CSO2', 'centroippicotrullalla@email.it'),
('CEN1', 'centroippicoiciliegi@email.it'),
('CSO3', 'centroippico3province@email.it'),
('CDR1', 'centroippico3province@email.it'),
('CRE1', 'centroippicolefarfalle@email.it');

INSERT INTO `Esterni` (`CodConcorso`, `Organizzatore`, `CodCitta`, `Indirizzo`, `Telefono`, `Email`)
VALUES ('CDR2', 'Centro ippico Vieni a cavalcar', '1', 'Via C. Battisti, 3', NULL, 'centroippicovieniacavalcar@email.it'),
('CPO1', 'Centro ippico The horses', '7', 'Via Trieste, 2', NULL, 'centroippicothehorses@email.it'),
('CSO4', 'Centro ippico Le castagne', '6', 'Via G. Leopardi, 23', NULL, 'centroippicocastagne@email.it'),
('CSO5', 'Centro ippico Cavallo Pazzo', '8', 'Via J. Riccati, 8', NULL, 'centroippicocavallopazzo@email.it');

INSERT INTO `Partecipazioni` (`CodConcorso`, `CodAg`, `Vincitore`)
VALUES ('CSO1', 'CHNMGV93H42L407L', 'Chinellato Maria Giovanna'),
('CSO1', 'ZNLSML92C09L781Q', 'Chinellato Maria Giovanna'),
('CSO1', 'DMNNGL93M10I829Q', 'Chinellato Maria Giovanna'),
('CSO2', 'ZNLSML92C09L781Q', 'Zanella Samuele'),
('CSO2', 'DMNNGL93M10I829Q', 'Zanella Samuele'),
('CEN1', 'ZNLSML92C09L781Q', 'Sardi Filippa, esterno'),
('CEN1', 'CHNMGV93H42L407L', 'Sardi Filippa, esterno'),
('CSO3', 'DMNNGL93M10I829Q', 'Damiani Angelo'),
('CSO3', 'SCHDNL91E61G224A', 'Damiani Angelo'),
('CDR1', 'DMNNGL93M10I829Q', 'Giardinelli Maria'),
('CDR1', 'SCHDNL91E61G224A', 'Giardinelli Maria'),
('CDR1', 'GRDMRA94P41I775G', 'Giardinelli Maria'),
('CDR1', 'CHNMGV93H42L407L', 'Giardinelli Maria'),
('CRE1', 'DMNNGL93M10I829Q', 'Giardinelli Maria'),
('CDR2', 'GRDMRA94P41I775G', 'Giardinelli Maria'),
('CDR2', 'DMNNGL93M10I829Q', 'Giardinelli Maria');

INSERT INTO `Assicurazioni` (`CodAss`, `CodAllievo`, `Desc`, `Quota`, `Scadenza`)
VALUES ('ASS1', 'CHNMGV93H42L407L', 'Ass. ann. infortuni','20,00', '2014-10-05'),
('ASS2', 'CSTVLR93M46L407V', 'Ass. ann. infortuni', '20,00', '2014-06-10'),
('ASS3', 'FRCNLS94H05L407G', 'Ass. ann. infortuni', '20,00', '2014-06-23'),
('ASS4', 'BLCGDI91M51L407P', 'Ass. ann. infortuni', '20,00', '2014-07-14'),
('ASS5', 'ZNLSML92C09L781Q', 'Ass. ann. infortuni', '20,00', '2014-07-19'),
('ASS6', 'LRSMSS94M60Z132C', 'Ass. ann. infortuni', '20,00', '2014-07-22'),
('ASS7', 'FRLMTT92B07G224L', 'Ass. ann. infortuni', '20,00', '2014-08-23'),
('ASS8', 'MNNGNN93C53C890G', 'Ass. ann. infortuni', '20,00', '2014-09-01'),
('ASS9', 'BDNLXA92H06I829I', 'Ass. ann. infortuni', '20,00', '2014-09-11'),
('AS10', 'ZLNLSN93L43I829X', 'Ass. ann. infortuni', '20,00', '2014-09-20'),
('AS11', 'BSNRCR93L06Z225J', 'Ass. ann. infortuni', '20,00', '2014-10-13'),
('AS12', 'DMNNGL93M10I829Q', 'Ass. ann. infortuni', '20,00', '2014-11-24'),
('AS13', 'RMPFPP93P11L781G', 'Ass. ann. infortuni', '20,00', '2014-12-3'),
('AS14', 'BLDMSM92D05G224P', 'Ass. ann. infortuni', '20,00', '2014-12-10'),
('AS15', 'GRDMRA94P41I775G', 'Ass. ann. infortuni', '20,00', '2015-01-08'),
('AS16', 'GNTRKE93D50G224U', 'Ass. ann. infortuni', '20,00', '2015-01-16');

INSERT INTO `Richieste` (`TipoRichiesta`, `Descrizione`, `CodUtente`, `CodAmm`, `DataConvalida`)
VALUES ('Iscrizione', 'centroippicotrullalla@email.it', 'DMNNGL93M10I829Q', 'NGRDNI85E64G224F', '2012-01-10'),
('Iscrizione', 'centroippico3province@email.it', 'CHNMGV93H42L407L', 'DMANTN83C06L407J', '2012-01-23'),
('Iscrizione', 'centroippico3province@email.it', 'CSTVLR93M46L407V', 'DMANTN83C06L407J', '2012-02-20'),
('Iscrizione', 'centroippico3province@email.it', 'FRCNLS94H05L407G', 'DMANTN83C06L407J', '2012-03-28'),
('Iscrizione', 'centroippico3province@email.it', 'BLCGDI91M51L407P', 'DMANTN83C06L407J', '2012-06-13'),
('Iscrizione', 'centroippicoiciliegi@email.it', 'ZNLSML92C09L781Q', 'BSGMRC91P14I775F', '2012-06-15'),
('Iscrizione', 'centroippicoiciliegi@email.it', 'LRSMSS94M60Z132C', 'BSGMRC91P14I775F', '2012-07-14'),
('Iscrizione', 'centroippicoiciliegi@email.it', 'FRLMTT92B07G224L', 'BSGMRC91P14I775F', '2012-09-10'),
('Iscrizione', 'centroippicoiciliegi@email.it', 'MNNGNN93C53C890G', 'BSGMRC91P14I775F', '2012-10-01'),
('Iscrizione', 'centroippicotrullalla@email.it', 'BDNLXA92H06I829I', 'NGRDNI85E64G224F', '2012-10-03'),
('Iscrizione', 'centroippicotrullalla@email.it', 'ZLNLSN93L43I829X', 'NGRDNI85E64G224F', '2012-12-04'),
('Iscrizione', 'centroippicotrullalla@email.it', 'BSNRCR93L06Z225J', 'NGRDNI85E64G224F', '2013-01-08'),
('Iscrizione', 'centroippicolefarfalle@email.it', 'RMPFPP93P11L781G', 'FRRMNL83H02G224R', '2013-02-16'),
('Iscrizione', 'centroippicolefarfalle@email.it', 'BLDMSM92D05G224P', 'FRRMNL83H02G224R', '2013-05-12'),
('Iscrizione', 'centroippicolefarfalle@email.it', 'GRDMRA94P41I775G', 'FRRMNL83H02G224R', '2013-05-29'),
('Iscrizione', 'centroippicolefarfalle@email.it', 'GNTRKE93D50G224U', 'FRRMNL83H02G224R', '2013-05-30'),
('Iscrizione', 'centroippico3province@email.it', 'SCHDNL91E61G224U', NULL, NULL),
('Cambio orario', 'MA ME GI 14:00-15:00', 'RMPFPP93P11L781G', 'FRRMNL83H02G224R', '2014-06-01');
SET FOREIGN_KEY_CHECKS=1;
