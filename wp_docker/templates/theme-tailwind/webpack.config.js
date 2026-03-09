const path = require('path');

module.exports = {
    entry: './assets/js/app.js', // główny plik JS
    output: {
        filename: 'app.js',
        path: path.resolve(__dirname, 'assets/dist'),
    },
    mode: 'production', // lub 'development'
    module: {
        rules: [
            // tu nie ładujemy SCSS, bo tailwind to robi osobno
        ]
    }
};