<?php

namespace app\controllers;

use app\models\Entretien;

use Flight;

class EntretienController{

	public function __construct() {

	}
    public function accueil() {

		$Entretiens=new Entretien(Flight::db());
		$Entretiens = $Entretiens->getAllEntretiensByDept($_SESSION['idDepartement']);


        Flight::render('Entretien',['Entretiens'=>$Entretiens]);
    
    }

    public function addpage() {
        $departementModel = new Departement(Flight::db());
        $categorieModel = new Categorie(Flight::db());
        
    
        // Récupérer tous les départements
        $departements = $departementModel->getAllDepartement();
        $categories = $categorieModel->getAllCategorieByDept($_SESSION['idDepartement']);
    
        // Vérification si les listes sont vides
        $departements = !empty($departements) ? $departements : [];
        $categories = !empty($categories) ? $categories : [];
    
        // Envoyer toutes les données à la vue
        Flight::render('addEntretien', [
            'data' => [
           
                'categories' => $categories
            ]
        ]);


    }
    public function addpage2() {
        $departementModel = new Departement(Flight::db());
        $categorieModel = new Categorie(Flight::db());

    
        // Récupérer tous les départements
        $departements = $departementModel->getAllDepartement();
        $categories = $categorieModel->getAllCategorieByDept($_SESSION['idDepartement']);
    
        // Vérification si les listes sont vides
        $departements = !empty($departements) ? $departements : [];
        $categories = !empty($categories) ? $categories : [];
    
        // Envoyer toutes les données à la vue
        Flight::render('addmodifier', [
            'data' => [
          
                'categories' => $categories
            ]
        ]);


    }
    public function add() {
        $EntretienModel = new Entretien(Flight::db());
        
        // Récupération des données du formulaire
        $idDepartement = $_SESSION['idDepartement'];
        $idCategorie = $_POST['idCategorie'];
        $idPeriode = $_POST['idPeriode']; // Notez que c'est 'idPeriode' et non 'idPeriode'
        $prevision = $_POST['prevision'];
        $realisation = $_POST['realisation'] ?? null; // Champ optionnel
        $dateEntretien = $_POST['dateEntretien']; // Notez que c'est 'dateEntretien' et non 'dateEntretien'
    
        $EntretienModel->AjoutEntretien(
            $idDepartement,
            $idCategorie,
            $idPeriode,
            $prevision,
            $realisation,
            $dateEntretien
        );
        
        Flight::redirect('EntretienList');
    }
    
  
    public function deleteEntretien(){
        $db = Flight::db();
        $EntretienModel = new Entretien($db);
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $id = $_GET['idEntretien'];
            print($id);
            $success = $EntretienModel->removeEntretien($id);
            if ($success) {
                Flight::redirect('EntretienList');            
                }
            }
    }

    public function update(){
        $db = Flight::db();
        $EntretienModel = new Entretien($db);
        $id = $_POST['save'];
        // Récupération des données du formulaire
        $idDepartement = $_SESSION['idDepartement'];
        $idCategorie = $_POST['idCategorie'];
        $idPeriode = $_POST['idPeriode']; // Notez que c'est 'idPeriode' et non 'idPeriode'
        $prevision = $_POST['prevision'];
        $realisation = $_POST['realisation'] ?? null; // Champ optionnel
        $dateEntretien = $_POST['dateEntretien']; 

     echo   $EntretienModel->update(
            $id,
            $idDepartement,
            $idCategorie,
            $idPeriode,
            $prevision,
            $realisation,
            $dateEntretien
        );
        
        Flight::redirect('EntretienList');

    }





    public function pagevalidation(){
        $db = Flight::db();
        $EntretienModel = new Entretien($db);
        $dept=new Departement(($db));

        
        $crmModel = new CRMModel($db); // On passe la connexion DB au modèle
        
        // Récupérer toutes les périodes
        $periodes = $crmModel->getAllPeriodes();


        if ($dept->isFinance($_SESSION['idDepartement'])==false) {
        
                echo "Seul les membres du finance on accees";            
            }else{
                $Entretiens = $EntretienModel->getAllEntretiens();


                Flight::render('Validation',['Entretiens'=>$Entretiens,'periodes'=>$periodes]);  
            }

            }
    public function validation(){
        $db = Flight::db();
        $EntretienModel = new Entretien($db);
        $dept=new Departement(($db));

    
        $crmModel = new CRMModel($db);

        if (isset($_POST['valide']) && $dept->isFinance($_SESSION['idDepartement'])==false) {
        
                echo "Seul les membres du finance on accees";            
            }else{
                $Entretiens = $EntretienModel->valider($_POST['valide']);
                if(isset(($_POST['crmValide']))){
            $crmModel->validerCRMPeriod($_POST['crmValide']);

                    }
                             if(isset(($_POST['TicketValide']))){
                $ticket = new Ticket(Flight::db());            
    $ticket->validerTicketPeriode($_POST['TicketValide']);

            }    
                header('Location: validation');
                exit;
            
            }
    
         

            }
                public function csv(){
                        $db = Flight::db();
                        $EntretienModel = new Entretien($db);
                       
                
                
                        if (isset($_POST['csv'])) {
                            if($_POST['csv']=="import"){
                                $EntretienModel->importCSV($_SESSION['idDepartement']);

                                header('Location: EntretienList');
                                exit;
                            }
                            if($_POST['csv']=="export"){

                                echo $EntretienModel->exportCSV($_SESSION['idDepartement']);      
                                
                            }
                        
                         
                           
                               
                            }
                
                            }
            
        



    public function welcome(){

        Flight::render('PageAcceuil',[]);



    }

    public function PageEntretien() {
        // Récupérer l'ID du département à partir de la session ou d'autres sources
        $idDepartement = $_SESSION['idDepartement'] ?? null;

        // Si les paramètres de début et de fin de période sont envoyés via POST
        $moisDebut = isset($_POST['debut']) ? $_POST['debut'] : 1;
        $moisFin = isset($_POST['fin']) ? $_POST['fin'] : 1;

      
        $Entretien = new Entretien(Flight::db());
        $dept=new Departement(Flight::db());



        
        $tableau = $Entretien->generateEntretienTable($_SESSION['idDepartement'],$moisDebut , $moisFin);


   if($dept->isFinance($_SESSION['idDepartement'])==false){

    Flight::render('PageEntretien', ['tableau' => $tableau,'debut'=>$moisDebut,'fin'=>$moisFin]);


   // Flight::render('PageEntretien', ['tableau' => $tableau,'tableauTotal'=>$tableauTotal,'debut'=>$moisDebut,'fin'=>$moisFin]);
   }else{
    $tableauTotal=$Entretien->generateEntretienTableTous($moisDebut,$moisFin);
     Flight::render('PageEntretien', ['tableau' => $tableau,'tableauTotal'=>$tableauTotal,'debut'=>$moisDebut,'fin'=>$moisFin]);

   }
        



        
    }
    public function exportPDF()
		{
			// 1. Récupérer les paramètres
			$idDepartement = $_SESSION['idDepartement'];
			$startPeriod = $_GET['debut'] ?? 1;
			$endPeriod = $_GET['fin'] ?? 1;
			$isTotal = isset($_GET['total']);
		
			// 2. Charger le modèle
			$Entretien=new Entretien(Flight::db());
			
			// 3. Générer les données
			if ($isTotal) {
				$data = $Entretien->generateTotalEntretienTable($startPeriod, $endPeriod);
				$title = "Tableau Budgétaire Consolidé";
			} else {
				$data = $Entretien->generateEntretienTable($idDepartement, $startPeriod, $endPeriod);
				$title = "Tableau Budgétaire - Département " . $idDepartement;
			}
		
			// 4. Extraire les périodes
			$periods = array_column($data, 'periode');
		
			// 5. Générer le PDF
            dump(__DIR__.'/../models/Entretienpdf.php') ;
			require_once(__DIR__.'/../models/Entretienpdf.php');
			$pdf = new Entretienpdf($title, $periods, $data, $isTotal);
			$pdf->AliasNbPages();
			$pdf->GenerateTable();
		
			// 6. Envoyer le PDF
			$pdf->Output('D', 'Entretien_'.date('Y-m-d').'.pdf');
			exit; // Important pour arrêter l'exécution après l'envoi du PDF
		}	
		

   
}




