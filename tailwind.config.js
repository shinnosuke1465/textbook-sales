import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/*.js',
        './resources/scss/*.scss',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            spacing: {
                25: "6.25rem",
                30: "7.5rem",
                50: "12.5em",
                100: "25rem",
              },
              fontSize: {
                xxs: ["0.625rem", null] /* 10px */,
                xs: ["0.75rem", null] /* 12px */,
                sm: ["0.875rem", null] /* 14px */,
                md: ["1rem", null] /* 16px */,
                lg: ["1.125rem", null] /* 18px */,
                xl: ["1.25rem", null] /* 20px */,
                "2xl": ["1.5rem", null] /* 24px */,
                "3xl": ["1.75rem", null] /* 28px */,
                "4xl": ["2rem", null] /* 32px */,
                "5xl": ["2.25rem", null] /* 36px */,
                "6xl": ["2.5rem", null] /* 40px */,
                "7xl": ["2.75rem", null] /* 44px */,
                "8xl": ["3rem", null] /* 48px */,
                "9xl": ["3.5rem", null] /* 56px */,
                "10xl": ["4rem", null] /* 64px */,
                "11xl": ["5rem", null] /* 80px */,
                "12xl": ["10rem", null] /* 160px */,
              },
              lineHeight: {
                0.8: "0.8",
                1.2: "1.2",
                1.3: "1.3",
                1.5: "1.5",
                1.8: "1.8",
                2: "2",
                2.5: "2.5",
              },
            screens: {
                xs: "390px",
                sm: "640px",
                md: "768px",
                lg: "1024px",
                xl: "1280px",
                "2xl": "1536px",
                "3xl": "1920px",
                "4xl": "2560px",
              },
        },
    },
    plugins: [forms],
};
