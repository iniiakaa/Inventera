import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "on-tertiary": "#ffffff",
                    "surface": "#fcf8fb",
                    "on-secondary-container": "#00732a",
                    "tertiary-fixed-dim": "#ffb595",
                    "surface-bright": "#fcf8fb",
                    "on-tertiary-fixed-variant": "#7c2e00",
                    "inverse-on-surface": "#f3f0f2",
                    "secondary": "#006e28",
                    "on-primary-container": "#fefcff",
                    "secondary-fixed-dim": "#53e16f",
                    "surface-container-high": "#eae7ea",
                    "primary": "#0058bc",
                    "background": "#fcf8fb",
                    "secondary-fixed": "#72fe88",
                    "error-container": "#ffdad6",
                    "on-background": "#1b1b1d",
                    "tertiary-container": "#c64f00",
                    "surface-dim": "#dcd9dc",
                    "primary-container": "#0070eb",
                    "tertiary-fixed": "#ffdbcc",
                    "on-tertiary-container": "#fffbff",
                    "surface-container-lowest": "#ffffff",
                    "on-primary-fixed": "#001a41",
                    "error": "#ba1a1a",
                    "on-primary": "#ffffff",
                    "on-secondary": "#ffffff",
                    "outline": "#717786",
                    "secondary-container": "#6ffb85",
                    "surface-tint": "#005bc1",
                    "on-error-container": "#93000a",
                    "primary-fixed": "#d8e2ff",
                    "surface-container": "#f0edef",
                    "inverse-surface": "#303032",
                    "on-error": "#ffffff",
                    "on-surface-variant": "#414755",
                    "on-primary-fixed-variant": "#004493",
                    "on-surface": "#1b1b1d",
                    "surface-container-low": "#f6f3f5",
                    "on-secondary-fixed-variant": "#00531c",
                    "surface-variant": "#e4e2e4",
                    "on-secondary-fixed": "#002107",
                    "inverse-primary": "#adc6ff",
                    "outline-variant": "#c1c6d7",
                    "primary-fixed-dim": "#adc6ff",
                    "tertiary": "#9e3d00",
                    "on-tertiary-fixed": "#351000",
                    "surface-container-highest": "#e4e2e4"
            },
            "borderRadius": {
                    "DEFAULT": "1rem",
                    "lg": "2rem",
                    "xl": "3rem",
                    "full": "9999px"
            },
            "spacing": {
                    "gutter": "24px",
                    "margin-mobile": "20px",
                    "margin-desktop": "48px",
                    "unit": "4px",
                    "container-max": "1640px"
            },
            "fontFamily": {
                    "headline-lg-mobile": ["Inter"],
                    "display": ["Inter"],
                    "body-lg": ["Inter"],
                    "body-md": ["Inter"],
                    "label-sm": ["Inter"],
                    "headline-lg": ["Inter"],
                    "headline-md": ["Inter"],
                    "label-md": ["Inter"]
            },
            "fontSize": {
                    "headline-lg-mobile": ["28px", {"lineHeight": "1.2", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                    "display": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "600"}],
                    "body-lg": ["18px", {"lineHeight": "1.5", "letterSpacing": "-0.005em", "fontWeight": "500"}],
                    "body-md": ["16px", {"lineHeight": "1.5", "letterSpacing": "0", "fontWeight": "500"}],
                    "label-sm": ["12px", {"lineHeight": "1.4", "letterSpacing": "0.02em", "fontWeight": "600"}],
                    "headline-lg": ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.015em", "fontWeight": "600"}],
                    "headline-md": ["24px", {"lineHeight": "1.3", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                    "label-md": ["14px", {"lineHeight": "1.4", "letterSpacing": "0.01em", "fontWeight": "600"}]
            }
          }
        },
    plugins: [forms],
};
