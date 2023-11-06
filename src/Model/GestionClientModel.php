<?php
declare(strict_types=1);
namespace App\Model;

use PDO;
use App\Entity\Client;
use Tools\Connexion;
use Exception;
use App\Exceptions\AppException;
class GestionClientModel {
   public function find(int $id) : Client {
       try {
           $unObjetPdo = Connexion::getConnexion();
           $sql = "select * from CLIENT where id=:id";
           $ligne = $unObjetPdo->prepare($sql);
           $ligne->bindValue(':id',$id,PDO::PARAM_INT);
           $ligne->execute();
           return $ligne->fetchObject(Client::class);
       } catch(Exception $ex){
           throw new AppException("Erreur technique inattendue");
           
       }
   }
   public function findAll(): array {
       $unObjetPdo = Connexion::getConnexion();
       $sql = "select * from CLIENT";
       $lignes = $unObjetPdo->query($sql);
       return $lignes->fetchAll(PDO::FETCH_CLASS,Client::class);
   }
   public function enregistreClient(Client $client){
       try {
           $unObjetPdo = Connexion::getConnexion();
           $sql = "insert into client(titreCli, nomCli, prenomCli, adresseRue1Cli, adresseRue2Cli, cpCli, villeCli, telCli)"
                   . "value(:titreCli, :nomCli, :prenomCli, :adresseRue1Cli, :adresseRue2Cli, :cpCli, :villeCli, :telCli )";
           $s= $unobjetPdo->prepare($sql);
           $s->bindValue(':titreCli', $client->getTitrecli (), PDO:: PARAM_STR); $s->bindValue(':nomCli', $client->getNomCli (), PDO:: PARAM_STR);
           $s->bindValue(':prenomCli', $client->getPrenomCli(), PDO:: PARAM_STR);
           $s->bindValue(': adresseRuelcli', $client->getAdresseRuelCli (), PDO:: PARAM_STR);
           $s->bindValue(': adresseRue2cli', ($client->getAdresseRue2Cli() == "") ? (null): ($client->getAdresseRue2Cli ()), PDO:: PARAM_STR); $s->bindValue(': cpCli', $client->getCpCli(), PDO:: PARAM_STR);
           $s->bindValue(':villeCli', $client->getVilleCli(), PDO:: PARAM_STR); $s->bindValue(':telCli', $client->getTelcli (), PDO:: PARAM_STR);
           $s->execute();
           
       } catch (Exception $ex) {
           throw new AppExceptions("Erreur technique innatendue");
       }
       
   }
   public function findIds(){
       try {
           $unObjetPdo = Connexion::getConnexion();
           $sql = "select id from CLIENT";
           $lignes = $unObjetPdo->query($sql);
           if($lignes->rowCount()> 0) {
               $t = $lignes->fetchAll(PDO::FETCH_ASSOC);
               return $t;
           } else {
               throw new AppExceptions('Aucun client trouvé');
           }
       } catch (Exception $ex) {

           throw new AppExceptions("Erreur technique inattendue");
           
       }
           
       
   }
}
