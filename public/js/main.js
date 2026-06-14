/**
 * Main JavaScript - Event Handlers and Utilities
 */

// Utility function to format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD'
    }).format(amount);
}

// Utility function to format date
function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}

// Show notification
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type}`;
    notification.textContent = message;
    document.body.insertBefore(notification, document.body.firstChild);
    
    setTimeout(() => {
        notification.remove();
    }, 5000);
}

// Export to CSV
function exportToCSV(filename, tableId) {
    const table = document.getElementById(tableId);
    let csv = [];
    
    // Get headers
    const headers = table.querySelectorAll('thead th');
    const headerRow = [];
    headers.forEach(header => headerRow.push(header.textContent));
    csv.push(headerRow.join(','));
    
    // Get rows
    const rows = table.querySelectorAll('tbody tr');
    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        const rowData = [];
        cells.forEach(cell => rowData.push('"' + cell.textContent + '"'));
        csv.push(rowData.join(','));
    });
    
    // Create download
    const csvContent = 'data:text/csv;charset=utf-8,' + csv.join('\n');
    const link = document.createElement('a');
    link.href = encodeURI(csvContent);
    link.download = filename || 'export.csv';
    link.click();
}

// Initialize tooltips
function initTooltips() {
    const tooltips = document.querySelectorAll('[data-tooltip]');
    tooltips.forEach(el => {
        el.addEventListener('mouseover', function() {
            const tooltip = document.createElement('div');
            tooltip.className = 'tooltip';
            tooltip.textContent = this.getAttribute('data-tooltip');
            document.body.appendChild(tooltip);
        });
    });
}

// Document ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('Electric Build Information System loaded');
    initTooltips();
});
