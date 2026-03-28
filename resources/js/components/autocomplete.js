export default (config) => ({
    open: false,
    query: '',
    selected: config.selected,
    selectedLabel: '',
    options: config.options,
    get filtered() {
        if (this.query === '') return this.options
        return this.options.filter(o =>
            o.label.toLowerCase().includes(this.query.toLowerCase())
        )
    },
    init() {
        const found = this.options.find(o => o.value == this.selected)
        if (found) {
            this.selectedLabel = found.label
            this.query = found.label
        }
    },
    select(option) {
        this.selected = option.value
        this.selectedLabel = option.label
        this.query = option.label
        this.open = false
    },
    clear() {
        this.selected = ''
        this.selectedLabel = ''
        this.query = ''
        this.open = false
    }
})
