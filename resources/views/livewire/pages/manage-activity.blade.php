 <div class="content-wrapper">
     <!-- Content -->

     <div class="container-xxl flex-grow-1 container-p-y">

         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Management /</span> Activity </h4>

         <div class="row g-6 mb-3">
             <div class="col-lg-12 mb-3">
                 <div class="card">
                     <div class="card-header">
                         <a href="{{ route('activity_form') }}" class="btn rounded-pill float-end btn-primary text-white">
                             <span class="tf-icons bx bx-plus"></span> Add Activity
                         </a>
                     </div>
                     <div class="card-body">


                         <div class="row">
                             <div class="col-lg-12 mb-2">
                                 @if(session('success'))
                                 <x-message-alert type="success" message="{{ session('success') }}" />
                                 @endif
                             </div>

                             <div class="col-lg-12 mb-2">
                                 <h3 class="mx-3">Activity Table</h3>
                             </div>
                             <div class="col-lg-12">
                                 <div class="table-responsive text-nowrap">
                                     <table class="table table-striped " id="setup_activities">
                                         <thead>
                                             <tr>
                                                 <th>Title</th>
                                                 <th>Department</th>
                                                 <th>Type</th>
                                                 <th>Status</th>
                                                 <th width="15%">Actions</th>
                                             </tr>
                                         </thead>
                                         <tbody class="table-border-bottom-0">

                                         </tbody>
                                     </table>

                                     <script>
                                         const route = "{{ route('datatable.setup_activities') }}"

                                         const columns = [{
                                                 data: 'title',
                                                 name: 'title',
                                             },
                                             {
                                                 data: 'org_code',
                                                 name: 'org_code',
                                             },
                                             {
                                                 data: 'type',
                                                 name: 'type',
                                             },
                                             {
                                                 data: 'status',
                                                 name: 'status',
                                             },
                                             {
                                                 data: 'actions',
                                                 name: 'actions',
                                             }
                                         ]

                                         init_datatable('#setup_activities', route, columns)
                                     </script>
                                 </div>
                             </div>
                         </div>

                     </div>
                 </div>
             </div>

         </div>



     </div>
     <!-- / Content -->

     <!-- Footer -->
     <livewire:base.footer />
     <!-- / Footer -->

 </div>