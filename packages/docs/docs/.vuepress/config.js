import { defaultTheme } from '@vuepress/theme-default'
import { searchPlugin } from '@vuepress/plugin-search'
export default {
    lang: 'pl-PL',
    title: 'Motyw ZHP',
    head: [['link', { rel: 'icon', type: 'image/png', href: '/images/logo.png' }]],
    plugins: [
        searchPlugin({
            searchMaxSuggestions: 10
        }),
    ],
    theme: defaultTheme({
        lastUpdatedText: 'Zaktualizowano',
        contributors: false,
        darkMode: false,
        sidebar: [
            '/README.md',
            '/nawigacja.md', 
            '/dostosowanie-motywu.md',
            '/typy-tresci.md',
            '/wymagane-podstrony.md',
            '/strona-glowna.md',
            '/bloki-gutenberg.md',
            '/dodatkowe-funkcje.md',
            '/rozwiazywanie-problemow.md',
            '/bledy.md',
        ],
        themePlugins: {
            backToTop: false
        },
    }),
}
