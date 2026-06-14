import Alpine from 'alpinejs';
import './components/slider';
import './components/countdown';
import './components/payment-selector';
import './components/form-validation';

// Initialize Alpine
window.Alpine = Alpine;
Alpine.start();

// Global utilities
window.showToast = function(message, type = 'success') {
    // Implementation will be in the toast component
    console.log(`[${type.toUpperCase()}] ${message}`);
};

window.formatCurrency = function(value) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
    }).format(value);
};

window.formatDate = function(date) {
    if (typeof date === 'string') {
        date = new Date(date);
    }
    return new Intl.DateTimeFormat('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    }).format(date);
};

// Console log for development
console.log('ShowTix Frontend Initialized');
