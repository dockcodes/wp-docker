module.exports = {
    content: [
        "./*.php",
        "./template-parts/**/*.php",
        "./src/js/**/*.js"
    ],
    theme: {
        extend: {}
    },
    plugins: [
        require('@tailwindcss/typography')
    ]
}