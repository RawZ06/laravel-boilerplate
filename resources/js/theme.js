Alpine.data('themeHandler', () => ({
    theme: 'system',

    init() {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            if (this.theme === 'system') {
                this.applyTheme();
            }
        });

        this.$watch('theme', () => {
            this.applyTheme();
        });

        this.theme = localStorage.getItem('theme') || 'system';
        this.applyTheme();
    },

    setTheme(theme) {
        this.theme = theme;
        localStorage.setItem('theme', theme);
        this.applyTheme();
    },

    applyTheme() {
        let isDark = false;

        if (this.theme === 'dark') {
            isDark = true;
        } else if (this.theme === 'light') {
            isDark = false;
        } else {
            isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        }

        if (isDark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
}));
