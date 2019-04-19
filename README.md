# XyzzyCP
Jest to prosty panel napisany w języku PHP przy pomocy frameworku Laravel. Panel działa z wydanym kilka lat wcześniej gamemode [XyzzyRP](https://github.com/lpiob/MTA-XyzzyRP), struktura bazy danych pozostała bez zmian. Skrypt zostanie rozbudowany, jeśli wzbudzi zainteresowanie społeczności. Kod został udostępniony na licencji MIT

## Funkcje panelu
- Tworzenie kont
- Podgląd podstawowych informacji o koncie
- Tworzenie postaci
- Podgląd podstawowych informacji o postaci

Jeśli panel zyska zainteresowanie społeczności, zostanie rozbudowany o dodatkowe opcje

## Cele projektu
- Zapoznanie się z frameworkiem Laravel
- Oddanie społeczności panelu, który będzie łatwy w użytkowaniu oraz konfiguracji
- Zachęcenie społęczności do wykorzystywania skryptu XyzzyRP zamiast ciągle powielanych niskiej jakości skryptów

## Informacje techniczne
### Wymagania

Panel do poprawnego działania wymaga bazy danych MySQL z wgraną strukturą dostarczoną ze skryptem XyzzyRP, PHP w wersji przynajmniej 7.1.3 oraz serwera z zainstalowanym Apache2 (w przypadku innych silników moze być wymagane dostosowanie przekierowań na własną rękę)

---
### Zmiana szyfrowania 
Jeśli zgodnie z zaleceniami zmieniłeś sól używaną przy procesie tworzenia oraz autoryzacja konta, możesz ją łatwo dostosować w tym miejscu: https://github.com/madvalue/PHP-XyzzyCP/blob/master/app/Accounts.php#L68

---
### Konfiguracja panelu
Po wrzuceniu zawartości repozytorium na swój hosting otwórz plik ``.env`` ulubionym edytorem. Zmień ustawienia DB_HOST, DB_DATABASE, DB_USERNAME i DB_PASSWORD na kolejne wartości: adres pod którym działa baza danych, nazwa bazy danych, nazwa użytkonika oraz hasło użytkownika. Dodatkowo jeśli Twoja baza danych używa niestandardowego portu, edytuj również wartość DB_PORT. Po wykonaniu tych czynności edytuj wartość APP_URL, wstawiając adres url pod którym będzie działać Twój panel. Dodatkowo, jeśli chcesz zmienić nazwę wyświetlaną w panelu, możesz edytować wartość APP_NAME, wstawiając swoją nazwę projektu (domyślnie XyzzyCP)

## Wsparcie techniczne
Jeśli podczas użytkowania panelu napotkasz problemy, skorzystaj z zakładki ``Issues`` aby zgłosić błąd. Jeśli natomiast nie radzisz sobie z jego konfiguracją, zajrzyj koniecznie na mój serwer discord (https://discord.gg/9xjQ4S) a ja postaram się Ci pomóc, możesz tam też zgłaszać swoje sugestie dotyczące rozbudowy panelu