export default (config) => ({
    open: false,
    x: 0,
    y: 0,
    align: config.align,
    toggle(el) {
        const rect = el.getBoundingClientRect();
        this.y = rect.bottom + 8;
        if (this.align === 'right') {
            this.x = rect.right;
        } else if (this.align === 'center') {
            this.x = rect.left + rect.width / 2;
        } else {
            this.x = rect.left;
        }
        this.open = !this.open;
    }
})
