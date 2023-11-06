<?php
declare(strict_types=1);
namespace App\Controller;
use App\Model\GestionClientModel;
use ReflectionClass;
use App\Exceptions\AppException;
use Tools\MyTwig;
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of GestionClientController
 *
 * @author fabio.borner
 */
class GestionClientController {
    public function chercheUn(array $params) {
  
        $modele = new GestionClientModel();
        
        $ids = $modele->findIds();
        $params['lesId'] = $ids;
        
        if(array_key_exists('id',$params)){
        $id = filter_var(intval($params["id"]), FILTER_VALIDATE_INT);
        $unClient = $modele->find($id);
        
         if($unClient){
            $params['unClient'] =$unClient;
            
            
           
        } else {
            $params['message'] = "Client" . $id . "inconnu";
        }
            
        }
       
       
  
       
         $r = new ReflectionClass($this);
           $vue = str_replace('Controller', 'View', $r->getShortName()) . "/unClient.html.twig";
            MyTwig::afficheVue($vue,  array('unClient' => $unClient));
    }
    
    
     
    
    public function chercheTous(){
        $modele = new GestionClientModel();
        $clients = $modele->findAll();
        if($clients){
            $r = new ReflectionClass($this);
            $vue = str_replace('Controller', 'View', $r->getShortName()) . "/tousClients.html.twig";
             MyTwig::afficheVue($vue,  array('clients' => $clients,count($clients)));
            
        } else {
            throw new AppException("Aucun client afficher");
        }
    }
    public function creerClient(array $params){
        $vue = "GestionClientView\\creerClient.html.twig";
        MyTwig::afficheVue($vue, array());
        
        
    }
    
      public function enregistreClient($params){
          try{
              $client = new Client($params);
              $modele = new GestionClientModel();
              $modele->enregistreClient($client);
          } catch (Exception $ex) {
              throw new AppExceptions("Erreur à l'enregistrement d'un nouveau client");

          }
        
    }
    
}
