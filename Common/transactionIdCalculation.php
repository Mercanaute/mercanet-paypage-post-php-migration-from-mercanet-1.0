<?php
// Only useful for migration from Mercanet V1 to Mercanet V2
// This file is used to calculate a default transactionId in case a merchant does not want to provide a transactionId from her/his own system
// Mercanet will return this transactionId in the field "transactionReference", with format: YYYYMMDD999999, where 999999 is the transactionId.
// The generation of transactionId reproduces the behaviour of Mercanet 1 APIs distributed after 2018.

// Uniquement utile pour la migration de Mercanet V1 vers Mercanet V2
// Ce fichier est utilisé pour calculer un transactionId par défaut au cas où un commerçant ne souhaite pas fournir un transactionId de son propre système
// Mercanet renverra ce transactionId dans le champ "transactionReference", au format : AAAAMMJJ999999, où 999999 est le transactionId.
// La génération de transactionId reproduit le comportement des API Mercanet V1 distribuées après 2018.

function get_s10TransactionReference()
{
   $calculatedId=compute_transactionId();

   $s10TransactionReference = array(
   "s10TransactionId" => $calculatedId,
   );

   return $s10TransactionReference;
}


function compute_transactionId()
{
   // this distributes an Id from 000000 to 999999 along the day, based on typical distribution of transaction during the day.
   // cela distribue un identifiant de 000000 à 999999 tout au long de la journée, en fonction de la distribution typique des transactions au cours de la journée.
   $currentDateHour = date('H');
   $currentDateMin = date('i');
   $currentDateSec = date('s');
   $currentDateMillArr = explode(' ', microtime());
   $currentDateMill = (int)round($currentDateMillArr[0] * 1000);
   $intPeriodeMs = 0;
   $intPeriodeMs += $currentDateHour * 60 * 60 * 1000;
   $intPeriodeMs += $currentDateMin * 60 * 1000;
   $intPeriodeMs += $currentDateSec * 1000;
   $intPeriodeMs += $currentDateMill;

   $dblProjectionTid = 0;
   $dblProjectionTid += (-5.636E-26 * pow($intPeriodeMs, 4));
   $dblProjectionTid += (7.061E-18 * pow($intPeriodeMs, 3));
   $dblProjectionTid += (-6.692E-11 * pow($intPeriodeMs, 2));
   $dblProjectionTid += (8.566E-4 * pow($intPeriodeMs, 1));
   $dblProjectionTid = floor($dblProjectionTid);
   $intProjectionTid = (int) $dblProjectionTid;

   if ($intProjectionTid > 999999)
      $intProjectionTid = 999999;
   if ($intProjectionTid < 0)
      $intProjectionTid = 0;

   // Padding - Remplissage
   $strProjectionTid = $intProjectionTid;
   $strProjectionTid=str_pad($strProjectionTid, 6, "0", STR_PAD_LEFT);

   return $strProjectionTid;
}

?>
