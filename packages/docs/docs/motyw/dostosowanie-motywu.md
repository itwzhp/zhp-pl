# Konfiguracja WordPressa

## Bezpośrednie odnośniki
Motyw wspiera tylko jeden format “odnośników” `/rok/nazwa-wpisu`, dlatego należy wprowadzić zmiany w bezpośrednich odnośnikach WordPress

Ustawienia > Bezpośrednie odnośniki, wybieramy Własny format i w polu wpisujemy `/%year%/%postname%/`

## Dostosowanie motywu

Wygląd > Dostosuj, tutaj też możesz utworzyć menu :)

## Ustawienia motywu

### Główne
1. Żałoba - strona zostaje “pokolorowana” na czarno
2. Logo - pozwala ustawić logotyp jednostki na stronie głównej
![An image](/images/settings.png)  
3. Placeholder - obrazek, który zostanie wyświetlony kiedy nie ustawimy “Obrazek wyróżniony”
4. Adres witryny (URL) - nie dotyczy motywu dla Chorągwi / Hufców

### Wydarzenia
1. Dodawanie wydarzeń - zaznaczona opcja umożliwia dodawanie wydarzeń przez niezalogowanych użytkowników
2. Dozwolone domeny - domeny z maile mogą być użyte do potwierdzenia dodania Wydarzenia
3. Tytuł maila z linkiem potwierdzającym
4. Treść maila z linkiem do potwierdzenia
* WP Mail SMTP powinna zostać skonfigurowana w celu umożliwienia wysyłania maili WordPressowi, funkcja natywna mail nie działa na wielu serwerach.
