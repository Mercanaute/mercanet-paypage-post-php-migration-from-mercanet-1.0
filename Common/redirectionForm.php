<?php
//This file automatically redirects to the payment pages - Ce fichier redirige automatiquement vers les pages de paiement

session_start();

?>

<!DOCTYPE html>
<html lang = "en">
<head>
   <meta charset = "UTF-8">
   <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
   <meta http-equiv = "X-UA-Compatible" content = "ie=edge">
   <title>Redirection Form - Formulaire de redirection</title>
</head>
<body>
   <form id = "form" method = "POST" action = "https://payment-webinit.simu.mercanet.bnpparibas.net/paymentInit">
      <input type = "hidden" name = "Data" value = "<?php echo  $_SESSION['data']; ?>"/>
      <input type = "hidden" name = "InterfaceVersion" value = "HP_2.24"/>
      <input type = "hidden" name = "Seal" value = "<?php echo  $_SESSION['seal']; ?>"/>
      <input type = "hidden" name = "SealAlgorithm" value = "<?php echo  $_SESSION['sealAlgorithm']; ?>"/>
      <input type = "hidden" name = "Encode" value = "base64"/>
      <input type = "submit" value = "SUBMIT">
   </form>
   <script type = "text/javascript">
      document.getElementById("form").submit();
   </script>
</body>
</html>
