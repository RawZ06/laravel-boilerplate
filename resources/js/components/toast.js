export default () => ({
    toasts: [],
    add(toast) {
        const id = Date.now()
        this.toasts.push({ id, ...toast, visible: false })
        this.$nextTick(() => {
            const t = this.toasts.find(t => t.id === id)
            if (t) t.visible = true
        })
        if (toast.duration !== 0) {
            setTimeout(() => this.remove(id), toast.duration ?? 4000)
        }
    },
    remove(id) {
        const t = this.toasts.find(t => t.id === id)
        if (t) {
            t.visible = false
            setTimeout(() => this.toasts = this.toasts.filter(t => t.id !== id), 300)
        }
    }
})
