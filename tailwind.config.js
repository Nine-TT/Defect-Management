/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    themes: ["light"],
    plugins: [require("daisyui")],
};
