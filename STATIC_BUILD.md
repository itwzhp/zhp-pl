# Generowanie motywu WordPress

Aby wygenerować działający motyw na WP trzeba wykonać następujące czynności:

1. Wygenerować statyczny kod nuxt
   1. Przejść do `packages/app`, zainstalować zależności (`yarn install`) i wygenerować statyczną wersję projektu (`yarn generate`).
2. Zbudować bloki Gutenberga
   1. Po kolei wejść do każdego folderu w `packages/themes/blocks/`, w każdym zainstalować zależności (`yarn install`) i zbudować (`yarn build`)
3. Skopiować wszystkie pliki wymagane do działania motywu do jednego (nowego) folderu:
   1. Pliki `favicon.png`, `functions.php`, `icon.png`, `page-full.php`, `page-gutenberg.php`, `screenshot.png`, `style.css`, `sw.js` z folderu `packages/theme/`
   2. Folder `plugin-update-checker-4.11` z folderu `packages/theme/`
   3. Plik `index.html` z folderu `packages/app/dist` (wygenerowanego w kroku 1), któremu należy zmienić nazwę na `index.php`
   4. Folder `_nuxt` z folderu `packages/app/dist/wp-content/themes/zhp-pl` (wygenerowanego w kroku 1)
   5. Skopiować z każdego bloku (`/packages/theme/blocks/*`) plik bloku `<nazwa bloku>.php` i folder `build` do odpowiedniego folderu `<folder motywu>/blocks/<nazwa bloku>`
      1. (PRZYKLAD) dla bloku `accordion` skopiować z `/packages/theme/blocks` plik `accordion.php` i folder `build` do folderu `blocks/accordion`
4. Stworzyć folder `includes` i wrzucić do niego folder pluginu ACF Pro

Wszystkie te kroki (z wyjątkiem ostatniego) są zautomatyzowane w skrypcie

## `.github/zipTheme.sh`

Skrypt należy uruchamiać z głównego folderu projektu.

```shell
chmod +x .github/zipTheme.sh
./zipTheme.sh
```

Jako argument można podać package manager, który ma zostać użyty (`yarn`, `npm` lub `pnpm`).
