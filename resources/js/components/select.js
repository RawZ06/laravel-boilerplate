export default (config) => ({
    open: false,
    selected: config.selected,
    selectedLabel: '',
    options: config.options,
    init() {
        const found = this.options.find(o => o.value == this.selected)
        if (found) this.selectedLabel = found.label
    },
    select(option) {
        this.selected = option.value
        this.selectedLabel = option.label
        this.open = false
    }
})
