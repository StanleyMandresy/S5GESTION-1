ALTER TABLE contracts DROP FOREIGN KEY contracts_ibfk_2; 
ALTER TABLE contracts CHANGE idCandidat idCandidatRecu INT NOT NULL;
ALTER TABLE contracts 
ADD CONSTRAINT fk_contracts_candidatRecu 
FOREIGN KEY (idCandidatRecu) REFERENCES candidates_recus(id);