<?php

// public API for user code - API publique pour le code utilisateur
// returns a string that can be submitted to mercanet API to initiate a payment on - renvoie une chaîne qui peut être soumise à l'API mercanet pour initier un paiement sur
// Paypage Post interface - L'Interface de publication de la page de paiement
function flatten_to_mercanet_payload($input)
{
   $keyStack = array();
   return implode("|", flatten_undefined($input, $keyStack));
}

// utility method called by flatten_to_mercanet_payload and flatten_array - méthode utilitaire appelée par flatten_to_mercanet_payload et flatten_array
// returns a single dimensional array that can be imploded as a string with the - renvoie un tableau unidimensionnel qui peut être implosé sous forme de chaîne avec le
// required separator - séparateur requis
function flatten_undefined($object, $keyStack)
{
   $result = array();
   if(is_array($object)){
      $result = array_merge($result, flatten_array($object, $keyStack));
   }else if(!empty($keyStack)){
      $result[] = implode('.', $keyStack) . '=' . $object;
   }else{
      $result[] = $object;
   }
   return $result;
}

// utility method called by flatten_undefined or by itself - méthode utilitaire appelée par flatten_undefined ou par elle-même
// returns a single dimensional array representing this array - retourne un tableau unidimensionnel représentant ce tableau
function flatten_array($array, $keyStack)
{
   $simpleValues = array();$result = array();
   
   foreach($array as $key => $value){
      if(is_int($key)){
         // Values without keys are added to results after ones having keys - Les valeurs sans clés sont ajoutées aux résultats après celles qui ont des clés
         if(is_array($value)){
            $noKeyStack = array();
            $simpleValues = array_merge($simpleValues, flatten_array($value, $noKeyStack));
         }else{
            $simpleValues[] = $value;
         }
      }else{
         $keyStack[] = $key;
         $result = array_merge($result, flatten_undefined($value, $keyStack));
         array_pop($keyStack);
      }
   }
   
   if(!empty($simpleValues)){
      if(empty($keyStack)){
         $result = array_merge($result, $simpleValues);
      }else{
         $result[] = implode(".", $keyStack) . '=' . implode(",", $simpleValues);
      }
   }
   return $result;
}

?>
