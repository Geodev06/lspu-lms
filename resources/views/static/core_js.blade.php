<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script data-navigate-once src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
<script data-navigate-once src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
<script data-navigate-once src="{{ asset('vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->

<!-- Main JS -->
<script src="{{ asset('js/main.js') }}"></script>

<!-- Page JS -->

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script>
  function init_table(table_name, route, columns) {
    $(table_name).DataTable({
      responsive: true,
      buttons: [{
          extend: 'copy',
          className: 'dt-button buttons-copy'
        },
        {
          extend: 'excel',
          className: 'dt-button buttons-excel'
        },
        {
          extend: 'pdf',
          className: 'dt-button buttons-pdf'
        }
      ],
      layout: {
        topStart: 'buttons'
      },
      processing: true,
      serverSide: true,
      ajax: route, // Set the route to your getData method
      columns: columns,
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ], // Dropdown for number of records
      pageLength: 10, // Default number of records
      dom: 'Blfrtip', // 'l' is the length menu, 'B' is for the buttons
    });
  }

  function getSelectedMDCValue(selectElement) {
    // Get the value of the hidden input inside the MDC select
    var selectedValue = $(selectElement).find('input[type="hidden"]').val();

    // Return the selected value from the hidden input
    return selectedValue;
  }

  $(document).ready(function() {
    // Listen for MDCSelect change event to get the selected value
    $('.mdc-select').on('MDCSelect:change', function() {
      var selectedValue = getSelectedMDCValue(this);

      // Set the wire:model attribute for the hidden input
      // $('#campus').attr("wire:model", "campus");

      // Update the value of the hidden input based on the selected value
      $('#campus').val(selectedValue);

      console.log('Selected Value for Wire Model:', selectedValue);



    });
  });



</script>