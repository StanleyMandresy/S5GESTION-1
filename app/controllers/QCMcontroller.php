<?php

namespace app\controllers;
use app\models\QCMmodel;

use Flight;

class QCMcontroller{

	public function __construct() {

	}
    public function accueil() {

		$QCMmodel=new QCMmodel(Flight::db());
		$QCMmodel = $QCMmodel->GetQCMDepartement(2);
        Flight::render('QCMmodel',['QCMmodel'=>$QCMmodel]);
    
    }
    
}