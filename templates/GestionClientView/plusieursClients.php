<?php

include_once PATH_VIEW . "header.html";
echo "<br>Nombre de clients trouvés : ".count($clients) . "<p>";
foreach ($clients as $client) {
    echo $client->getId() . " " ." ". $client->getNomCli() . "<br>";
}
include_once PATH_VIEW . "footer.html";
