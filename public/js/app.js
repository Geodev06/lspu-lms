function init_datatable(selector, route, columns) {
    if (!selector || !route || !columns) {
        console.error("Selector, route, and columns are required.");
        return;
    }

    $(selector).DataTable({
        processing: true,
        serverSide: true,
        ajax: route,
        columns: columns,
        responsive: true,
        ordering: false, // Disable client-side ordering
        language: {
            emptyTable: "No data available",
            loadingRecords: "Loading...",
            processing: "Processing..."
        }
    });
}

  document.querySelectorAll('a').forEach(el => {
    el.setAttribute('data-bs-toggle', 'tooltip');
    el.setAttribute('title', el.getAttribute('title') || 'Click here'); // Default title if not set
});