module.exports = {
    lang: 'pl-PL',
    title: 'Motyw ZHP',
    head: [['link', { rel: 'icon', type: 'image/png', href: '/images/logo.png' }]],
    plugins: [
        ['@vuepress/search', {
            searchMaxSuggestions: 10
        }],
    ],
    themeConfig: {
        lastUpdatedText: 'Zaktualizowano',
        contributors: false,
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
