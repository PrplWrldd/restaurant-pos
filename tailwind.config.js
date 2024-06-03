/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        container: {
            center: true,
            padding: "2rem",
        },
        extend: {},
    },
    plugins: [require("daisyui")],
    daisyui: {
        themes: ["light"],
    },
};
