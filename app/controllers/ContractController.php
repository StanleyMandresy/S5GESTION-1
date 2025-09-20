<?php
namespace app\controllers;

use Flight;
use app\models\ContractModel;
use Exception;

class ContractController {

    public function __construct() {}

    // Affiche formulaire avec les listes
    public function ContractSaisie() {
        try {
            $db = Flight::db();
            $contractModel = new ContractModel($db);
            
            // Récupérer les candidats et types de contrat
            $candidats = $contractModel->listeCandidats();
            $typesContrat = $contractModel->listeTypesContrat();
            
            // Passer les données à la vue
            Flight::render('ContractSaisie', [
                'candidats' => $candidats,
                'typesContrat' => $typesContrat
            ]);
            
        } catch (Exception $e) {
            Flight::json([
                'success' => false,
                'message' => 'Erreur chargement formulaire: ' . $e->getMessage()
            ]);
        }
    }
    // Dans ContractController

// Récupérer la liste des candidats avec jointure
public function getCandidates() {
    try {
        $db = Flight::db();
        $contractModel = new ContractModel($db);
        
        // Récupérer tous les candidats reçus avec leurs noms
        $candidates = $contractModel->listeCandidats();
        
        Flight::json($candidates);
    } catch (Exception $e) {
        Flight::json(['error' => $e->getMessage()], 500);
    }
}

// Récupérer les types de contrat
public function getContractTypes() {
    try {
        $db = Flight::db();
        $contractModel = new ContractModel($db);
        $types = $contractModel->listeTypesContrat();
        
        Flight::json($types);
    } catch (Exception $e) {
        Flight::json(['error' => $e->getMessage()], 500);
    }
}

    // Sauvegarde contrat avec missions et clauses
    public function ContractStore() {
        try {
            $db = Flight::db();
            $contractModel = new ContractModel($db);

            // ======================
            // Insertion contrat
            // ======================
            $idContract = $contractModel->ContractSaisieParRH([
                'idCandidatRecu' => Flight::request()->data->idCandidatRecu,
                'idEmploye' => Flight::request()->data->idEmploye ?? null,
                'contract_type' => Flight::request()->data->contract_type,
                'start_date' => Flight::request()->data->start_date,
                'end_date' => Flight::request()->data->end_date,
                'probation_duration' => Flight::request()->data->probation_duration,
                'probation_renewable' => Flight::request()->data->probation_renewable,
                'remuneration' => Flight::request()->data->remuneration,
                'remuneration_hourly' => Flight::request()->data->remuneration_hourly,
                'work_hours_per_week' => Flight::request()->data->work_hours_per_week,
                'idStatut' => Flight::request()->data->idStatut,
                'idType' => Flight::request()->data->idType
            ]);

            // ======================
            // Insertion missions
            // ======================
            if (!empty(Flight::request()->data->missions)) {
                foreach (Flight::request()->data->missions as $mission) {
                    if (!empty(trim($mission))) {
                        $contractModel->AjouterMission($idContract, $mission);
                    }
                }
            }

            // ======================
            // Insertion clauses
            // ======================
            if (!empty(Flight::request()->data->clauses)) {
                foreach (Flight::request()->data->clauses as $clause) {
                    if (!empty(trim($clause['title'])) && !empty(trim($clause['text']))) {
                        $idClause = $contractModel->AjouterClause($clause['title'], $clause['text']);
                        $contractModel->AssocierClauseAuContrat($idContract, $idClause);
                    }
                }
            }

            // ======================
            // Insertion nouveau type de contrat si fourni
            // ======================
            if (!empty(Flight::request()->data->new_contract_type)) {
                $newTypeId = $contractModel->AjouterTypeContrat(Flight::request()->data->new_contract_type);
            }

            Flight::json([
                'success' => true,
                'message' => 'Contrat et données associées insérés avec succès',
                'idContract' => $idContract
            ]);
        } catch (Exception $e) {
            Flight::json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }// Dans app/controllers/ContractController.php
public function showContract($idCandidat) {
    try {
        $db = Flight::db();
        $contractModel = new ContractModel($db);
        
        // Récupérer les détails du contrat
        $contract = $contractModel->getContractDetailsByCandidat($idCandidat);
        
        if (!$contract) {
            Flight::json([
                'success' => false,
                'message' => 'Aucun contrat trouvé pour ce candidat.'
            ]);
            return;
        }
        
        // Afficher la vue du contrat
        Flight::render('ContractDisplay', [
            'contract' => $contract
        ]);
        
    } catch (Exception $e) {
        Flight::json([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
}

}