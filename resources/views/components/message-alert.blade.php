<div>

    @php
    $icons = [
    'success' => 'bx bx-check-circle',
    'danger' => 'bx bx-error-circle',
    'warning' => 'bx bx-error',
    'info' => 'bx bx-info-circle',
    ];

    $headers = [
    'success' => 'Success!',
    'danger' => 'Error!',
    'warning' => 'Warning!',
    'info' => 'Notice:',
    ];

    $iconClass = $icons[$type] ?? 'bx bx-info-circle';
    $header = $headers[$type] ?? 'System Message';
    @endphp


    <div class="alert alert-{{ $type }} alert-dismissible d-flex align-items-start" role="alert">
        <i class="{{ $iconClass }} me-2 mt-1"></i>
        <div class="flex-grow-1">
            <strong>{{ $header }}</strong> <br> {{ $message }}
        </div>
        <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>


</div>