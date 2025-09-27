<link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">

<script src="{{ asset('js/toastr.min.js') }}"></script>

<script>
    // Set toastr options once (e.g., on page load)
    toastr.options = {
        closeButton: true,
        debug: true,
        newestOnTop: true,
        progressBar: true,
        positionClass: "toast-bottom-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    };

    // Reusable toast function
    function toast(toast_type, title, message) {
        if (typeof toastr[toast_type] === "function") {
            toastr[toast_type](message, title);
        } else {
            // console.warn(`Invalid toast type: ${toast_type}`);
        }
    }
</script>