 <div class="content-wrapper">
     <!-- Content -->

     <div class="container-xxl flex-grow-1 container-p-y">

         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account /</span> Notifications </h4>

         <div class="row g-6 mb-3">
             <div class="col-lg-12 mb-3">
                 <div class="card">
                     <div class="card-header">

                     </div>
                     <div class="card-body">


                         <div class="row">
                             <div class="col-lg-12 mb-2">
                                 @if(session('success'))
                                 <x-message-alert type="success" message="{{ session('success') }}" />
                                 @endif
                             </div>

                             <div class="col-lg-12 mb-2">
                                 <h3 class="mx-3">Notifications Table</h3>
                             </div>
                             <div class="col-lg-12">
                                 <div class="table-responsive text-nowrap">
                                     <table class="table table-striped " id="notifications">
                                         <thead>
                                             <tr>
                                                 <th  width="5%">Icon</th>
                                                 <th width="16%">Title</th>
                                                 <th>Message</th>
                                                 <th width="10%">Status</th>
                                                 <th width="10%">Actions</th>
                                             </tr>
                                         </thead>
                                         <tbody class="table-border-bottom-0">

                                         </tbody>
                                     </table>

                                     <script>
                                         const route = "{{ route('datatable.notifications') }}"

                                         const columns = [{
                                                 data: 'icon',
                                                 name: 'icon',
                                             },
                                             {
                                                 data: 'title',
                                                 name: 'title',
                                             },
                                             {
                                                 data: 'message',
                                                 name: 'message',
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

                                         init_datatable('#notifications', route, columns)
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