<?php
$ch = curl_init();
$path_url = "http://127.0.0.1:8000/emprunt/emprunt-list/"; //lien de votre api a consomée

try {
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Cache-Control: no-cache",
        "content-type:application/json;charset=utf-8"
      ));

    curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8001/emprunt/emprunt-list/");
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);   
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);         
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 1); #nbre de redirections qu'il doit suivre
    #curl_setopt($ch, CURLOPT_NOBODY, true); #use le protocle head et not export resouces retournées
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false); #verifie ou non la validité du certificat
    
    $response = curl_exec($ch); //recupere la resource call et telecharge par le curl initié

    if (curl_errno($ch)) { // curl_erno permet de controler la presence d'une erreur fatale
        echo curl_error($ch); // curl_error permet de connaître le message d'erreur
        die();
    }
    
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); //curl_getinfo recupere les informations d'une requete curl
    //il prend en par le curl_init et CURLINFO_HTTP_CODE(represente le code de retour)
    if($http_code == intval(200)){
       // echo " Ressource valide <br >" ;
    }
    else{
        echo "Ressource introuvable : " . $http_code;
    }
} catch (\Throwable $th) {
    throw $th;
} 
finally {
    curl_close($ch); //fermeture de la requete
    $data = json_decode($response);

    //print_r($response);
   //var_dump(["date_emprunt"]);
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=ul, initial-scale=1.0">
    <title>Affichage Api List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</head>
<body>
    <!--<ul>
    
    <li>
    <th 1></th>
    <tr> <td> </td></tr>
    <td> </td>
    <td> </td>
    <td> </td>
    <td> </td>
    </li>
   
    </ul>-->
<div class = "container"> 
    <div class="jumbotron"> 
       <div class="card">
          <h5 class="card-header">Liste de emprunts</h5>
<div class="card-body">
    <table class="table table-dark table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">date_emprunt</th>
      <th scope="col">date_retour</th>
      <th scope="col">Nom-emprunteur</th>
      <th scope="col">Type de la chaise</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($data as $list):?>
    <tr>
      <th scope="row"><?php echo $list->id; ?></th>
      <td><?php echo $list->date_emprunt; ?></td>
      <td><?php echo $list->date_retour; ?></td>
      <td><?php echo $list->id_personnes->nom; ?></td>
      <td><?php echo $list->id_chaises->type;?></td>
    </tr>
    <?php endforeach;?>
    <tbody>

    <tbody>
  </tbody>
</table>


</div>
  </div>
    
    </div> 
    </div>
</body>
</html>