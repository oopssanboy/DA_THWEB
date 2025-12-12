<?php 
function clientGoogle(){
        $client_id ='929628426936-mcu12r63sn02t0l3j84t0vuofcle2lle.apps.googleusercontent.com'; 
        $client_secret ='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'; 
        $redirect_uri = 'http://localhost:3000/controler/google_controler.php'; 
        $client = new Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope("email");
        $client->addScope("profile");
        return $client;
   
}


?>