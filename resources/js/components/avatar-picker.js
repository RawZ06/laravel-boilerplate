export default (config) => ({
    currentAvatar: config.initialValue,
    mode: config.mode,
    style: config.style,
    seed: config.seed,
    customUrl: config.customUrl,
    isLoading: false,

    // Draft states for the modal
    draftMode: config.mode,
    draftStyle: config.style,
    draftSeed: config.seed,
    draftCustomUrl: config.customUrl,
    draftAvatar: config.initialValue,

    get generatedUrl() {
        return `https://api.dicebear.com/7.x/${this.draftStyle}/svg?seed=${this.draftSeed || 'default'}`;
    },

    async updateFromGenerator() {
        const url = this.generatedUrl;
        this.isLoading = true;
        await this.preloadImage(url);
        this.draftAvatar = url;
        this.isLoading = false;
        this.preloadExamples();
    },

    updateFromUrl() {
        this.draftAvatar = this.draftCustomUrl;
    },

    async selectExample(exampleSeed) {
        this.draftSeed = exampleSeed;
        await this.updateFromGenerator();
    },

    preloadImage(url) {
        return new Promise((resolve) => {
            const img = new Image();
            img.onload = resolve;
            img.onerror = resolve;
            img.src = url;
        });
    },

    preloadExamples() {
        ['Alex', 'Jordan', 'Taylor', 'Morgan', 'Casey'].forEach(ex => {
            this.preloadImage(`https://api.dicebear.com/7.x/${this.draftStyle}/svg?seed=${ex}`);
        });
    },

    openModal() {
        // Reset drafts to current values when opening
        this.draftMode = this.mode;
        this.draftStyle = this.style;
        this.draftSeed = this.seed;
        this.draftCustomUrl = this.customUrl;
        this.draftAvatar = this.currentAvatar;

        // Sync the select component
        this.$nextTick(() => {
            this.$dispatch('set-selected', { name: 'avatar_style_select', value: this.draftStyle });
            if (this.draftMode === 'generator') {
                this.updateFromGenerator();
            }
        });

        this.$dispatch('open-modal', 'avatar-picker-modal');
    },

    confirm() {
        this.mode = this.draftMode;
        this.style = this.draftStyle;
        this.seed = this.draftSeed;
        this.customUrl = this.draftCustomUrl;
        this.currentAvatar = this.draftAvatar;

        this.$dispatch('close-modal', 'avatar-picker-modal');
    },

    cancel() {
        this.$dispatch('close-modal', 'avatar-picker-modal');
    },

    init() {
        if (this.mode === 'generator') {
            this.preloadExamples();
        }

        this.$watch('draftStyle', () => {
            if (this.draftMode === 'generator') {
                this.updateFromGenerator();
            }
        });
    }
})
