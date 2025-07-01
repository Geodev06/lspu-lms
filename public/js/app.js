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


