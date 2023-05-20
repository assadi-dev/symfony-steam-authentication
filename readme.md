
## Mise en place d'une authentification avec steam sur Symfony

**Bundle utilisées**:

- **knojector/SteamAuthenticationBundle** - [Lien](https://github.com/knojector/SteamAuthenticationBundle)


**Documentation de l'Api**
[https://partner.steamgames.com/doc/webapi_overview]()

**Liens de l'obtention de la clé Api**
[https://steamcommunity.com/dev/apikey]()


Config

Inserer la clé générer depuis le site dans le fichier env

```php
STEAM_API_KEY=XXXXXXXXXXXXXXXX
```
rempaler le "XXXXXXXXXXXXXXXX" par votre clé.

Générer l'entité User avec la command 

```bash
php bin/console make:user
```

et choisisser username comment proprieté unique

Si vous shouaitez personnaliser les donnée stockée rendez-vous dans le fichier **Subscriber/FirstLoginSubscriber.php**

