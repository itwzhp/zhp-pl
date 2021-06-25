module.exports = {
    lang: 'pl-PL',
    title: 'Motyw ZHP',
    description: 'This is my first VuePress site',
    plugins: [
        ['@vuepress/search', {
            searchMaxSuggestions: 10
        }],
    ],
    themeConfig: {
        darkMode: false,
        sidebar: [
            '',
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
    },
}
