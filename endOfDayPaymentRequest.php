<?php
/*This file generates the payment request and sends it to the Mercanet server
For more information on this use case, please refer to the following documentation:
Ce fichier génère la demande de paiement et l'envoie au serveur Mercanet
Pour plus d'informations sur ce cas d'utilisation, veuillez consulter la documentation suivante :
   
https://documentation.mercanet.bnpparibas.net/index.php?title=Connecteur_POST#Paiement_en_fin_de_journ.C3.A9e */

session_start();

include('Common/sealCalculationPaypagePost.php');
include('Common/flatten.php');
include('Common/transactionIdCalculation.php');


//PAYMENT REQUEST - REQUETE DE PAIEMENT

// parameters.php initializes some session data like $_SESSION['merchantId'], $_SESSION['secretKey'], $_SESSION['normalReturnUrl'] and $_SESSION["urlForPaymentInitialisation"]
// You can change these values in parameters.php according to your needs and architecture
// parameters.php initialise certaines données de session comme $_SESSION['merchantId'], $_SESSION['secretKey'], $_SESSION['normalReturnUrl'] et $_SESSION["urlForPaymentInitialisation"]
// Vous pouvez modifier ces valeurs dans parameters.php selon vos besoins et votre architecture

include('parameters.php');

// Merchants migrating from Mercanet  V1 to Mercanet V2 must provide a transactionId. This easily done below. (second example used as default).

// Example with the merchant's own transactionId (typically when you increment Ids from your database)
// $s10TransactionReference=array(
//    "s10TransactionId" => "000001",
// //   "s10TransactionIdDate" => "not needed",   Please note that the date is not needed, Mercanet server will apply its date.
// );
//
// Example with transactionId automatic generation, like the Mercanet V1 API was doing.

// Les marchands migrant de Mercanet V1 vers Mercanet V2 simplifiée doivent fournir un transactionId. Cela se fait facilement ci-dessous. (deuxième exemple utilisé par défaut).

// Exemple avec le transactionId du marchand (généralement lorsque vous incrémentez les identifiants de votre base de données)
// $s10TransactionReference=tableau(
// "s10TransactionId" => "000001",
// // "s10TransactionIdDate" => "non nécessaire", Veuillez noter que la date n'est pas nécessaire, le serveur Mercanet appliquera sa date.
// );
//
// Exemple avec génération automatique de transactionId, comme le faisait l'API Mercanet V1.

$s10TransactionReference=get_s10TransactionReference();


$requestData = array(
   "normalReturnUrl" => $_SESSION['normalReturnUrl'],
   "merchantId" =>  $_SESSION['merchantId'],
   "amount" => "2000",           //Note that the amount entered in the "amount" field is in cents - Notez que le montant saisi dans le champ "montant" est en centimes
   "orderChannel" => "INTERNET",
   "currencyCode" => "978",
   "keyVersion" => "1",
   "responseEncoding" => "base64",

   "s10TransactionReference" => $s10TransactionReference,

   "captureMode" => "AUTHOR_CAPTURE",
   "captureDay" => "0",
);

$dataStr = flatten_to_mercanet_payload($requestData);

$dataStrEncode = base64_encode($dataStr);

$_SESSION['seal'] = compute_seal_from_string($_SESSION['sealAlgorithm'], $dataStrEncode, $_SESSION['secretKey']);

$_SESSION['data'] = $dataStrEncode;

header('Location: Common/redirectionForm.php');

?>
