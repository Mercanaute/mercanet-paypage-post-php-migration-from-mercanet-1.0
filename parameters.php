<?php
/*
This file includes customized information shared accross PHP files
For more information on simulation environment and simulation merchant and keys, please refer to:
    https://documentation.mercanet.bnpparibas.net/index.php?title=Boutique_de_test

Ce fichier comprend des informations personnalisées partagées entre les fichiers PHP
Pour plus d'informations sur l'environnement de simulation et le marchand de simulation et les clés, veuillez vous référer à :
    https://documentation.mercanet.bnpparibas.net/index.php?title=Boutique_de_test
*/

//You can change the values in session according to your needs and architecture - Vous pouvez modifier les valeurs en session en fonction de vos besoins et de votre architecture
$_SESSION['merchantId'] = "002001000000001";
$_SESSION['secretKey'] = "002001000000001_KEY1";
$_SESSION['sealAlgorithm'] = "HMAC-SHA-256";

// following lines refer to your own servers - les lignes suivantes font référence à vos propres serveurs
$_SESSION['normalReturnUrl'] = "http://localhost/mercanet-paypage-json-php/Common/paymentResponse.php";
$_SESSION["automaticResponseUrl"] = "http://localhost/mercanet-paypage-json-php/Common/automPaymentResponse.php";

?>
