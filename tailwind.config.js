/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: [
                    "Poppins",
                    "Instrument Sans",
                    "ui-sans-serif",
                    "system-ui",
                    "sans-serif",
                ],
            },
            colors: {
                background: "var(--background)",
                foreground: "var(--foreground)",
                card: "var(--card)",
                "card-foreground": "var(--card-foreground)",
                popover: "var(--popover)",
                "popover-foreground": "var(--popover-foreground)",
                primary: "var(--primary)",
                "primary-foreground": "var(--primary-foreground)",
                secondary: "var(--secondary)",
                "secondary-foreground": "var(--secondary-foreground)",
                muted: "var(--muted)",
                "muted-foreground": "var(--muted-foreground)",
                accent: "var(--accent)",
                "accent-foreground": "var(--accent-foreground)",
                destructive: "var(--destructive)",
                "destructive-foreground": "var(--destructive-foreground)",
                border: "var(--border)",
                input: "var(--input)",
                "input-background": "var(--input-background)",
                "switch-background": "var(--switch-background)",
                ring: "var(--ring)",
                sidebar: "var(--sidebar)",
                "sidebar-foreground": "var(--sidebar-foreground)",
                "sidebar-primary": "var(--sidebar-primary)",
                "sidebar-primary-foreground":
                    "var(--sidebar-primary-foreground)",
                "sidebar-accent": "var(--sidebar-accent)",
                "sidebar-accent-foreground": "var(--sidebar-accent-foreground)",
                "sidebar-border": "var(--sidebar-border)",
                "sidebar-ring": "var(--sidebar-ring)",
            },
            borderRadius: {
                DEFAULT: "var(--radius)",
            },
            keyframes: {
                pulse: {
                    "50%": { opacity: "0.5" },
                },
                enter: {
                    from: {
                        opacity: "var(--tw-enter-opacity, 1)",
                        transform:
                            "translate3d(var(--tw-enter-translate-x, 0), var(--tw-enter-translate-y, 0), 0) " +
                            "scale3d(var(--tw-enter-scale, 1), var(--tw-enter-scale, 1), var(--tw-enter-scale, 1)) " +
                            "rotate(var(--tw-enter-rotate, 0))",
                    },
                },
                exit: {
                    to: {
                        opacity: "var(--tw-exit-opacity, 1)",
                        transform:
                            "translate3d(var(--tw-exit-translate-x, 0), var(--tw-exit-translate-y, 0), 0) " +
                            "scale3d(var(--tw-exit-scale, 1), var(--tw-exit-scale, 1), var(--tw-exit-scale, 1)) " +
                            "rotate(var(--tw-exit-rotate, 0))",
                    },
                },
                "accordion-down": {
                    from: { height: "0" },
                    to: {
                        height: "var(--radix-accordion-content-height, var(--bits-accordion-content-height))",
                    },
                },
                "accordion-up": {
                    from: {
                        height: "var(--radix-accordion-content-height, var(--bits-accordion-content-height))",
                    },
                    to: { height: "0" },
                },
                "caret-blink": {
                    "0%, 70%, 100%": { opacity: "1" },
                    "20%, 50%": { opacity: "0" },
                },
            },
            animation: {
                pulse: "pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite",
                enter: "enter 0.2s ease-out",
                exit: "exit 0.2s ease-in",
                "accordion-down": "accordion-down 0.2s ease-out",
                "accordion-up": "accordion-up 0.2s ease-out",
                "caret-blink": "caret-blink 1s step-end infinite",
            },
        },
    },
    plugins: [],
};
