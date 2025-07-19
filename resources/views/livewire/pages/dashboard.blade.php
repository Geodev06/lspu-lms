   <div class="content-wrapper">

       @assets
       <script src="https://code.highcharts.com/highcharts.js"></script>
       <script src="https://code.highcharts.com/modules/series-label.js"></script>
       <script src="https://code.highcharts.com/modules/exporting.js"></script>
       <script src="https://code.highcharts.com/modules/export-data.js"></script>
       <script src="https://code.highcharts.com/modules/accessibility.js"></script>
       <script src="https://code.highcharts.com/themes/adaptive.js"></script>
       @endassets

       <style>
           * {
               font-family:
                   -apple-system,
                   BlinkMacSystemFont,
                   "Segoe UI",
                   Roboto,
                   Helvetica,
                   Arial,
                   "Apple Color Emoji",
                   "Segoe UI Emoji",
                   "Segoe UI Symbol",
                   sans-serif;
           }

           .highcharts-figure,
           .highcharts-data-table table {
               min-width: 360px;
               max-width: 800px;
               margin: 1em auto;
           }

           .highcharts-data-table table {
               font-family: Verdana, sans-serif;
               border-collapse: collapse;
               border: 1px solid var(--highcharts-neutral-color-10, #e6e6e6);
               margin: 10px auto;
               text-align: center;
               width: 100%;
               max-width: 500px;
           }

           .highcharts-data-table caption {
               padding: 1em 0;
               font-size: 1.2em;
               color: var(--highcharts-neutral-color-60, #666);
           }

           .highcharts-data-table th {
               font-weight: 600;
               padding: 0.5em;
           }

           .highcharts-data-table td,
           .highcharts-data-table th,
           .highcharts-data-table caption {
               padding: 0.5em;
           }

           .highcharts-data-table thead tr,
           .highcharts-data-table tbody tr:nth-child(even) {
               background: var(--highcharts-neutral-color-3, #f7f7f7);
           }

           .highcharts-description {
               margin: 0.3rem 10px;
           }
       </style>
       <!-- Content -->

       <div class="container-xxl flex-grow-1 container-p-y">

           <div class="row g-6 mb-3">
               @if(Auth::user()->role == ROLE_ADMIN)
               @include('partials.admin_dashboard')
               @endif


               @if(Auth::user()->role == ROLE_TEACHER)
               @include('partials.teacher_dashboard')
               @endif


               @if(Auth::user()->role == ROLE_STUDENT)
               @include('partials.student_dashboard')
               @endif
           </div>



       </div>
       <!-- / Content -->

       <!-- Footer -->
       <livewire:base.footer />
       <!-- / Footer -->

   </div>