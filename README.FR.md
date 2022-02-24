[Read this page in English](README.md)

## Exemples de Mercanet Paypage POST en PHP pour les clients Mercanet V1

Les exemples de code PHP de ce repository sont destinés aux **clients Mercanet V1 (utilisation d'API) migrant vers [Mercanet Paypage POST](https://documentation.mercanet.bnpparibas.net/index.php?title=Connecteur_POST) en gardant leur merchantId**.

Divers cas d'usage sont donnés en exemple : paiement à la commande, paiement différé...

Pour rendre votre migration vers Mercanet V2 la plus simple possible, le code de ce repository est configuré par défaut pour ré-utiliser une référence de type Mercanet V1 : le transactionId sur 6 chiffres. Elle est appelée s10TransactionReference sur Mercanet V2.

Si vous utilisez un nouveau merchantId nativement avec Mercanet V2, reportez-vous plutôt sur la documentation en ligne Mercanet V2 et le repository suivant: [https://github.com/Mercanaute/mercanet-paypage-post-php](https://github.com/Mercanaute/mercanet-paypage-post-php)


### Contenu

 **1. répertoire Common**

Ce répertoire contient des fichiers utilisés par plusieurs cas d'usage.

- sealCalculationPaypageJson.php : Ce fichier contient des fonctions pour calculer le sceau (seal) avec 2 algorithmes: [HMAC-SHA-256](https://documentation.mercanet.bnpparibas.net/index.php?title=Connecteur_POST#Outil_de_calcul_de_la_signature) and [SHA-256](https://documentation.mercanet.bnpparibas.net/index.php?title=Connecteur_POST#Outil_de_calcul_de_la_signature)
- paymentResponse.php : Affiche la réponse manuelle après la requête de paiement, après avoir vérifié le seal reçu
- flatten.php : Contient différentes fonctions pour retourner une chaine de caractères à envoyer au serveur Mercanet V2 pour initier un paiement avec Mercanet Paypage POST
- redirectionForm.php : Formulaire de redirection vers Mercanet Paypage en version POST
- transactionIdCalculation.php : Génère si besoin un transactionId (s10TransactionReference pour Mercanet V2) du même format que le faisait l'API Mercanet V1.

 **2. Autres fichiers**

Chaque fichier correspond à un type de paiement. Il contient le code qui initie la requête de paiement et l'envoie au serveur Mercanet V2.

Les exemples sont configurés pour travailler avec le transactionId (s10TransactionReference) généré par le PHP. Si vous générez un transactionId depuis votre système d'information, éditez le fichier de requête de paiement que vous souhaitez utiliser et remplacer "s10TransactionReference" par "s10TransactionId" :

```php
// Merchants migrating from Mercanet V1 to Mercanet V2 simplifiée must provide a transactionId. This easily done below. (second example used as default).
// Example with the merchant's own transactionId (typically when you increment Ids from your database)
 $s10TransactionReference=array(
    "s10TransactionId" => "000001",
// //   "s10TransactionIdDate" => "not needed",   Please note that the date is not needed, Mercanet server will apply its date.
 );
//
// Example with transactionId automatic generation, like the Mercanet V1 API was doing.
// $s10TransactionReference=get_s10TransactionReference();
```

### Démarrer les tests

- Cloner le repository et gardez la structure de répertoires comme sur GitHub
- Changer la valeur de normalReturnUrl dans parameters.php selon votre architecture
- Vérifier l'unicité des valeurs s10TransactionReference si la référence est calculée par vos soins
- En cas de paiement en plusieurs fois (installments), changer les dates et la référence de transaction si nécessaire
- Exécuter la requête de paiement de votre choix sur un serveur web local

### Version

Ces exemples ont été validés sur un serveur WAMP avec PHP 7.3.12,
ainsi que sur un serveur Linux/Debian avec serveur nginx et PHP 8.0.0

### Documentation

Ces exemples de code sont basés sur notre documentation en ligne ainsi que le guide de migration vers Mercanet V2 pour marchands conservant leur merchantId Mercanet V1.

Pour utiliser votre merchantId sur nos serveurs de production Mercanet V2, merci de contacter préalablement de le support Mercanet par email [assistance.mercanet@bnpparibas.com](mailto:assistance.mercanet@bnpparibas.com) ou au 0 825 843 414.

Pour de plus amples informations, veuillez vous référer à la documentation: [Mercanet Paypage POST documentation](https://documentation.mercanet.bnpparibas.net/index.php?title=Connecteur_POST)

### License

Ce repository est open source et disponible sous licence MIT. Pour plus d'information, veuillez consulter le fichier [LICENSE](LICENSE).
