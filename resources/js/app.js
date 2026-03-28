import './bootstrap';
import './theme';
import "@hotwired/turbo"
import toast from './components/toast';
import autocomplete from './components/autocomplete';
import select from './components/select';
import dropdown from './components/dropdown';
import date from './components/date';
import color from './components/color';

window.Alpine.data('toast', toast);
window.Alpine.data('autocomplete', autocomplete);
window.Alpine.data('select', select);
window.Alpine.data('dropdown', dropdown);
window.Alpine.data('date', date);
window.Alpine.data('color', color);

window.Alpine.start();
