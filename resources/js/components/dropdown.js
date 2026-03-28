export default (config) => ({
    open: false,
    x: 0,
    y: 0,
    align: config.align,
    toggle(el) {
        const rect = el.getBoundingClientRect();
        this.y = rect.bottom + window.scrollY + 8;
        if (this.align === 'right') {
            this.x = rect.right + window.scrollX;
        } else if (this.align === 'center') {
            this.x = rect.left + window.scrollX + rect.width / 2;
        } else {
            this.x = rect.left + window.scrollX;
        }
        this.open = !this.open;
    }
})
