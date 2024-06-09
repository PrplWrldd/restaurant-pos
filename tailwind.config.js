/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    fontFamily: {
      'serif': ['Young Serif'],
      'sans': ['Noto sans'],
    },
    container: {
      center:true,
  padding:{
    DEFAULT: '1rem',
        sm: '1rem',
  }
    },
    extend: {},
  },
  plugins: [
    require('daisyui'),
  ],
  daisyui: {
    themes : ['light']
  }
}

