/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                montserrat: ["Montserrat", "cursive"],
                greatvibes: ["GreatVibes", "cursive"],
            },
            width: {
                a4: "210mm",
            },
            height: {
                a4: "297mm",
            },
        },
    },
    plugins: [],
};
