export default (config) => ({
    open: false,
    selected: config.selected,
    viewYear: null,
    viewMonth: null,
    today: null,
    min: config.min,
    max: config.max,
    init() {
        const base = this.selected ? new Date(this.selected) : new Date()
        this.today = new Date().toISOString().slice(0,10)
        this.viewYear  = base.getFullYear()
        this.viewMonth = base.getMonth()
    },
    get monthLabel() {
        return new Date(this.viewYear, this.viewMonth, 1)
            .toLocaleString('en-US', { month: 'long', year: 'numeric' })
            .replace(/^\w/, c => c.toUpperCase())
    },
    get days() {
        const firstDay = new Date(this.viewYear, this.viewMonth, 1).getDay()
        const offset   = (firstDay + 6) % 7
        const total    = new Date(this.viewYear, this.viewMonth + 1, 0).getDate()
        const cells    = []
        for (let i = 0; i < offset; i++) cells.push(null)
        for (let d = 1; d <= total; d++) {
            const iso = this.viewYear + '-' + String(this.viewMonth+1).padStart(2,'0') + '-' + String(d).padStart(2,'0')
            cells.push({ d, iso })
        }
        return cells
    },
    prevMonth() {
        if (this.viewMonth === 0) { this.viewMonth = 11; this.viewYear-- }
        else this.viewMonth--
    },
    nextMonth() {
        if (this.viewMonth === 11) { this.viewMonth = 0; this.viewYear++ }
        else this.viewMonth++
    },
    isDisabled(iso) {
        if (this.min && iso < this.min) return true
        if (this.max && iso > this.max) return true
        return false
    },
    pick(cell) {
        if (!cell || this.isDisabled(cell.iso)) return
        this.selected = cell.iso
        this.open = false
    },
    get displayValue() {
        if (!this.selected) return ''
        const [y, m, d] = this.selected.split('-')
        return m + '/' + d + '/' + y
    },
    clear() {
        this.selected = ''
    }
})
