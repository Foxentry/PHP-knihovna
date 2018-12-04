# Foxentry PHP API

Táto PHP knižnica určená pre Foxentry API umožňuje pristupovať k API veľmi jednoducho pomocou zopár riadkov kódu. Pre správne fungovanie potrebujete mať na serveri nainštalované PHP minimálne vo verzii 5.5 a aktivovanú curl funkcionalitu.

V prípade, že sa vám nedarí implementovať knižnicu do vášho webu alebo si myslíte, že nejaká časť API alebo knižnice nefunguje správne, ozvite sa nám na **info@foxentry.cz** a my vám s implementáciou radi pomôžeme.

## Inštalácia cez composer
Knižnicu nainštalujte pomocou príkazu:

```
composer install foxentry/foxentry
```
Následne musíte knižnicu načítať do svojho PHP súboru pomocou:
```
require 'vendor/autoload.php';
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
$foxentry->setApiKey("your-api-key");
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

### Nastavenie rôznych parametrov požiadavky
Umožňuje nastaviť požiadavke rôzne parametre, ktoré majú vplyv na spracovanie požiadavky a jej výstup. Napr. u validácie emailových adries a telefónnych čísiel je možné nastaviť typ validácie (basic - základná, extended - rozšírená).
```
$foxentry->setRequestOption("validationType", "basic");
```

### Nastavenie tela požiadavky
V rámci tela požiadavky je potrebné zadať dotaz, teda údaj alebo údaje, ktoré chcete spracovať/zvalidovať. Telo požiadavky sa u každého koncového bodu líši, podrobnosti nájdete v [REST API dokumentácii](https://foxentry.docs.apiary.io).

Telo požiadavky nastavíte pomocou metódy **setRequestQuery**.
```php
$foxentry->setRequestQuery(
  array(
    "email" => "info@foxentry.cz"
  )
);
```

### Odoslanie požiadavky na API
Požiadavku na API je potrebné v niektorých prípadoch odoslať použitím metódy **run**.
```php
$foxentry->run();
```
Týka sa to hlavne prípadoch, keď pre prácu s API nepoužívate preddefinované metódy, ale vytvárate vlastnú požiadavku. Hlavne sa jedná o prípady, kedy sa na zadanie tela požiadavky používajú metódy *setRequestQuery* a *addQueryParam*. Využitie týchto metód nájdete v príkladoch nižšie alebo v ukážkových kódoch v priečinku **examples**.

### Získanie API odpovede
Pre získanie odpovede od API je potrebné zavolať špeciálnu metódu, ktorá vráti objekt s odpoveďou od API servera.
```php
$validationResult = $api->getResults();
```
Formát výstupu sa líši podľa použitého koncového bodu API a môže to byť *object* (napr. v prípade validácie údaju) alebo *array* (napr. pri vyhľadávaní adresných bodov aleb firiem, kedy výstup obsahuje viac vyhovujúcich položiek).

### Získanie počtu použitých kreditov
Väčšina API požiadaviek spotrebúva Foxentry kredity, ktoré máte vo svojom projekte. Po každej API požiadavke je možné získať informáciu, koľko kreditov daná požiadavka spotrebovala. Zároveň dostanete informáciu, koľko kreditov ste mali v projekte pred a po požiadavke.
```php
$creditsUsage = $api->getCreditsUsage();
```

## Ukážkové príklady použitia API
Nižšie sú uvedené príklady použitia tejto knižnice. Ďalšie nájdete v priečinku **examples**. Pre vyššiu prehľadnosť nie sú nižšie uvádzané všeobecné časti kódu (inicializácia knižnice, nastavenie API kľúča, získanie odpovede od API a podobne).

### Práca s emailovými adresami
#### Validácia emailovej adresy
Pre validáciu emailovej adresy použite metódu **$api->email->validate**, ktorej prvý parameter musí obsahovať validovaný údaj (teda emailovú adresu, resp. reťazec, u ktorého chcete zistiť, či je validnou emailovou adresou) a druhý parameter obsahuje typ (spôsob) validácie (basic - základná, extended - rozšírená)

```php
$api->email->validate("info@foxentry.cz", "basic"); // nastavenie emailovej adresy, ktorú chcete zvalidovať
```

### Práca s telefónnymi číslami
#### Validácia telefónneho čísla
Pre validáciu telefónneho čísla použite metódu **$api->phone->validate** s nasledovnými parametrami:
- phonePrefix (medzinárodná predvoľba tel. čísla, napr. +420)
- phoneNumber (tel. číslo, napr. 607123456)
- typ validácie (basic - základná, extended - rozšírená)

```php
$api->phone->validate("+420", "607123456", "basic"); // medz. predvoľba, tel. číslo, typ validácie
```

V prípade, ak nemáte tel. číslo rozdelené na predvoľbu a samotné číslo (napr. +420607123456), ponechajte prvý parameter (phonePrefix) prázdny ("" alebo null) a zadajte celé tel. číslo ako hodnotu druhého parametra (phoneNumber).

```php
$api->phone->validate("", "+420607123456", "basic"); // prázdna hodnota predvoľby, celé tel. číslo, typ validácie
```
### Práca s našeptávačom/validátorom adresných bodov

Pri práci s databázou adries je možné pri vyhľadávaní v niektorých prípadoch nastaviť tzv. vyhľadávacie módy. [Bližšie informácie o vyhľadávacích módoch](https://foxentry.docs.apiary.io/#introduction/vyhladavacie-mody).

#### Našeptávanie adresných bodov
Umožňuje využiť Foxentry algoritmus našeptávača adresných bodov. Stačí zadať typ vyhľadávania (čo hľadáte, napr. ulicu s číslom) a samotný dotaz (text, ktorý má výsledný adresný bod obsahovať v názve ulice). Nepodporuje vyhľadávacie módy.

```php
$api->address->hint(
    array(
        "searchType" => "streetWithNumber", // type of search, probably type of input which is end user filling
        "streetWithNumber" => "Václav", // find streets or streets with numbers that has some type of match with string "Václav" (match, prefix, fulltext, fuzzy)
        "city" => "Praha", // limit results to streets or streets with numbers located in city that has some type of match with string "Praha" (match, prefix, fulltext, fuzzy) 
    )
); 
```
Táto požiadavka na API vráti v prvom rade vyhovujúce ulice (ulice v Prahe so zhodou s dotazom "Václav"). Následne, ak je počet vyhovujúcich ulíc menší ako 10 (maximálny počet výsledkov), doplní zvyšok výsledkov konkrétnymi adresnými bodmi, ktoré sa nachádzajú v meste Praha na ulici so zhodou s dotazom "Václav".

Dôležitý je parameter searchType, ten určuje v prvom rade typ údajov, ktoré sa vyhľadávajú, vo vyššie uvedenom prípade sa vyhľadávajú ulice (napr. Václavská) a ulice s číslom (napr. Václavská 1). Od tohto parametru závisí aj formát výstupu (obsiahnuté údaje vo výstupe).

#### Vyhľadávanie adresných bodov
Narozdiel od našeptávania adresných bodov (vyššie) toto vyhľadávanie nevyužíva žiaden špeciálny interný algoritmus vyhľadávania a radenia výsledkov, ale iba jednoducho vráti vyhovujúce adresné body.

```php
$api->setEndpoint("locations/points/search");

// limit results to only address points in city with exact name "Praha"
$api->addQueryParam(
    array(
        "searchModes" => array("match"),
        "key" => "city.name",
        "value" => "Praha"
    )
);   

// limit results to only address points with exact street name "Vác" or street name starting with "Vác"
$api->addQueryParam(
    array(
        "searchModes" => array("match", "prefix"),
        "key" => "street.name",
        "value" => "Vác"
    )
);  

// limit results to only address points with exact ZIP "11000"
$api->addQueryParam(
    array(
        "searchModes" => array("match"),
        "key" => "zip",
        "value" => "11000"
    )
);      

$api->run();
```

#### Vyhľadávanie ulíc
API umožňuje vyhľadávať aj samostatné ulice (teda nie priamo adresné body). Nižšie uvedených príklad vráti zoznam ulíc v meste Praha, ktoré sa zhodujú alebo začínajú textom "Václ".

```php
// limit results to streets
$api->setEndpoint("locations/streets/search");

// limit results to streets with name "Václ" (match) or with name starting with "Václ" (prefix)
$api->addQueryParam(
    array(
        "searchModes" => array("match", "prefix"),
        "key" => "street.name",
        "value" => "Václ"
    )
);

// limit results to streets in city with name "Praha" (match)
$api->addQueryParam(
    array(
        "searchModes" => array("match"),
        "key" => "city.name",
        "value" => "Praha"
    )
);      

$api->run();
```


#### Vyhľadávanie miest
API umožňuje vyhľadávať aj samostatné mestá (teda nie priamo adresné body). Nižšie uvedených príklad vráti zoznam miest, ktorých názov s sa zhoduje alebo začína textom "Pra". Dôležitý filtračný parameter je "type", ktorý umožňuje nastaviť jeden alebo viacero typov adresných prvkov, v ktorých sa má vyhľadávať:

- **city** - názvy miest
- **cityPart** - názvy častí miest
- **cityDistrict** - názvy mestských obvodov

```php
// limit results to streets
$api->setEndpoint("locations/cities/search");

// limit results to only cities, excluding city parts and city districts
$api->addQueryParam(
    array(
        "key" => "type",
        "value" => array("city")
    )
); 

// limit results to streets in city with name "Praha" (match)
$api->addQueryParam(
    array(
        "searchModes" => array("match", "prefix"),
        "key" => "city.name",
        "value" => "Pra"
    )
);     

$api->run();
```

#### Validácia adresného bodu
Umožňuje zistiť, či existuje adresný bod, ktorý vyhovujeme zadaným kritériám (dopytu).

```php
$api->address->validate(
    array(
      "streetWithNumber" => "Jeseniova 1151",  // je možné rozdeliť na parametre street a number
      "city" => "Praha",
      "zip" => "13000"
    )
);
```
Uvedený kód spustí validáciu, teda overenie, či existuje adresný bod na ulici "Jeseniova" s číslom "1151", v meste "Praha" a s PSČ "13000". V prípade, že áno, je možné cez metódu **getResults** možné získať detaily adresného bodu (všetky informácie, ktoré o ňom Foxentry má dispozícii).

### Práca s databázou firiem

#### Vyhľadávanie firiem
Firmy je možné vyhľadať na základe ich názvu alebo ich IČ, pričom sa uprednostňujú výsledky s presnou alebo prefixovo zhodou. V prípade, že nie nájdených dostatočný počet vyhovujúcich výsledkov, doplnia sa (do požadovaného počtu výsledkov) výsledky s fuzzy zhodou.
```php
$api->company->search(
    array(
      "name" => "Web"
    )
);
```

#### Získanie informácií o firme
API umožňuje získať základné informácie o firme na základe zadaného IČ.
```php
$api->company->get(
    array(
      "registrationNumber" => "06190570"
    )
);
```

### Práca s databázou mien a priezvisk

#### Validácia mena
```php
$api->name->validateName("Petr");
```

#### Validácia priezviska
```php
$api->name->validateSurname("Novák");
```

#### Validácia mena a priezviska
```php
$api->name->validateNameSurname("Petr Novák");
```








