<?php
declare(strict_types=1);
namespace App\Controller;
use App\Model\GestionCommandeModel;
use ReflectionClass;
use App\Exceptions\AppException;
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of GestionClientController
 *
 * @author fabio.borner
 */
class GestionCommandeController {
   
     public function chercheUne(array $params) {
  
        $modele = new GestionCommandeModel();
       
        $id = filter_var(intval($params["id"]), FILTER_VALIDATE_INT);
        $uneCommande = $modele->find($id);
          print_r($uneCommande);
        die();
        if($uneCommande){
            $r = new ReflectionClass($this);
            include_once PATH_VIEW . str_replace('Controller', 'View', $r->getShortName()) . "uneCommande.php";
        } else {
            throw new AppException("Commande " . $id . " inconnu");
        }
    }
    
     public function chercheToutes(){
        $modele = new GestionCommandeModel();
        $commandes = $modele->findAll();
        if($commandes){
            $r = new ReflectionClass($this);
            include_once PATH_VIEW . str_replace('Controller', 'View', $r->getShortName()) . "/plusieursCommandes.php";
            
        } else {
            throw new AppException("Aucune commande afficher");
        }
    }
}
