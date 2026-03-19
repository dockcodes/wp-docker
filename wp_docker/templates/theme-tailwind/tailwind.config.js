module.exports = {
    content: [
        "./*.php",
        "./template-parts/**/*.php",
        "./assets/js/**/*.js"
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['"General Sans Variable"', 'sans-serif']
            }
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/aspect-ratio'),
    ]
}