# Knižnica zatiaľ nie je dostupná !!!

# Foxentry PHP API

Táto PHP knižnica určená pre Foxentry API umožňuje pristupovať k API veľmi jednoducho pomocou zopár riadkov kódu. Pre správne fungovanie potrebujete mať na serveri nainštalované PHP minimálne vo verzii 5.5 a aktivovanú curl funkcionalitu.

## Inštalácia cez composer
Knižnicu nainštalujte pomocou príkazu:

```
composer install foxentry/foxentry
```

## Inštalácia bez composeru
Stiahnite si obsah knižnice a do svojho PHP súbor načítajte súbor **src/Foxentry.php**

```php
include_once "src/Foxentry.php"
```

## Inicializácia API
Knižnicu inicializujete jednoducho vytvorením jej instancie.
```php
$foxentry = new Foxentry\Foxentry;
```
### Nastavenie API kľúča
Každá požiadavka na API musí obsahovať API kľúč pridelený k vášmu Foxentry projektu. 
```php
$foxentry->setApiKey("fox-IcNXuaeXfcpaXncTmLFS");
```

### Nastavenie krajiny pre údaje
Niektoré funkcionality API umožňujú prácu s CZ alebo s SK údajmi. Jedná sa o databázu adries, databázu firiem a databázu mien/priezvisk. V týchto prípadoch je teda potrebné nastaviť krajinu, pre ktorú chcete získať údaje. Dostupné hodnoty sú "CZ" a "SK".
```php
$foxentry->setRequestCountry("CZ");
```

### Stránkovanie výstupu
Niektoré funkcionality (vyhľadávanie údajov) umožňujú stránkovať výsledky. Na nastavenie počtu výsledkov a ich stránkovanie slúži metóda **setPagination**
```php
$foxentry->setPagination(20, 0);
```
(obmedzí výsledky na prvých 20 výsledkov, 20 je teda limit a 0 je offset)

## Nastavenie požiadavky
Každá požiadavka na API musí obsahovať údaje, na základe ktorých API rozpozná, o aké údaje máte záujem.

### Nastavenie koncového bodu API
Každá funkcionalita má pridelený svoj REST API koncový bod, ktorý nastavíte pomocou metódy **setEndpoint**.

```php
$foxentry->setEndpoint("email/validate");
```

### Nastavenie tela požiadavky
V rámci tela požiadavky je potrebné zadať dotaz, teda údaj alebo údaje, ktoré chcete spracovať/zvalidovať. Telo požiadavky sa u každého koncového bodu líši, podrobnosti nájdete v [REST API dokumentácii](https://foxentry.docs.apiary.io).

Telo požiadavky nastavíte pomocou metódy **setRequestQuery**.
```php
$foxentry->setEndpoint(
  array(
    "email" => "info@foxentry.cz"
  )
);
```





