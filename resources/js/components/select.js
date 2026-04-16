export default (config) => ({
    open: false,
    selected: config.selected,
    selectedLabel: '',
    options: config.options,
    init() {
        this.$watch('selected', (value) => {
            const found = this.options.find(o => o.value == value)
            if (found) {
                this.selectedLabel = found.label
            } else {
                this.selectedLabel = ''
            }
        })

        const found = this.options.find(o => o.value == this.selected)
        if (found) this.selectedLabel = found.label
    },
    select(option) {
        this.selected = option.value
        this.selectedLabel = option.label
        this.open = false
        this.$dispatch('change', option.value)
    }
})
