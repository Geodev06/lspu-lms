 <div class="content-wrapper">
     <!-- Content -->

     <div class="container-xxl flex-grow-1 container-p-y">

         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Systen Administration /</span> Organizations </h4>

         <div class="row g-6 mb-3">
             <div class="col-lg-12 mb-3">
                 <div class="card">
                     <div class="card-header">
                         <a href="{{ route('organization_form') }}" class="btn rounded-pill float-end btn-primary text-white">
                             <span class="tf-icons bx bx-plus"></span> Add Organization
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
                                 <h3 class="mx-3">Organizations Table</h3>
                             </div>
                             <div class="col-lg-12">
                                 <div class="table-responsive text-nowrap">
                                     <table class="table table-striped " id="table_orgs">
                                         <thead>
                                             <tr>
                                                 <th>Org Code</th>
                                                 <th>Name</th>
                                                 <th>Department</th>
                                                 <th>Actions</th>
                                             </tr>
                                         </thead>
                                         <tbody class="table-border-bottom-0">

                                         </tbody>
                                     </table>

                                     <script>
                                         const route = "{{ route('datatable.organizations') }}"

                                         const columns = [{
                                                 data: 'org_code',
                                                 name: 'org_code',
                                             },
                                             {
                                                 data: 'name',
                                                 name: 'name',
                                             },
                                             {
                                                 data: 'department',
                                                 name: 'department',
                                             },
                                             {
                                                 data: 'actions',
                                                 name: 'actions',
                                             }
                                         ]

                                         init_datatable('#table_orgs', route, columns)
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