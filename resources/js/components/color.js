export default (config) => ({
    open: false,
    selected: config.selected,
    custom: config.selected,
    swatches: config.swatches,
    pick(color) {
        this.selected = color
        this.custom   = color
    },
    onCustom(e) {
        this.selected = e.target.value
        this.custom   = e.target.value
    }
})
