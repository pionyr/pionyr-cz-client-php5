# PHP 5.6 API klient pro Pionyr.cz

**Toto je transpilovaná verze [původního klienta pro PHP 7.1+](https://github.com/pionyr/pionyr-cz-client/).**

Pokud používáte PHP 7 a vyšší, tuto knihovnu nepoužívejte, ale použijte původní verzi.

## Instalace

Viz [návod](https://github.com/pionyr/pionyr-cz-client/#instalace) v původní knihovně.

Jediný rozdíl je, že při instalaci přes Composer se jako jméno knihovny použije `pionyr/pionyr-cz-client-php5` místo `pionyr/pionyr-cz-client`. 

Tedy celý instalační příkaz (včetně nezbytné HTTP knihovny - v tomto případě Guzzle 6) bude vypadat takto:

```sh
composer require pionyr/pionyr-cz-client-php5 php-http/guzzle6-adapter
```

## Changelog - seznam změn
Pro seznam změn viz soubor [CHANGELOG.md](https://github.com/pionyr/pionyr-cz-client/blob/master/CHANGELOG.md) v původní knihovně.

Dodržujeme [sémantické verzování](http://semver.org/).

## Licence
Knihovna je zveřejněna jako open-source pod licencí [MIT](LICENCE.md).
