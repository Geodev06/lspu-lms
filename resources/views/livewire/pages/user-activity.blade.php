 <div class="content-wrapper">
    

     <div class="container-xxl flex-grow-1 container-p-y">

         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Activities</h4>

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
                             <div class="col-lg-12">
                                 <div class="table-responsive text-nowrap">
                                     <table class="table table-striped " id="course_activities_all">
                                         <thead>
                                             <tr>
                                                 <th>Title</th>
                                                 <th>Module</th>
                                                 <th width="9%">Type</th>
                                                 <th width="8%">Total Points</th>
                                                 <th width="12%">Grade</th>
                                                 <th width="16%">Actions</th>
                                             </tr>
                                         </thead>
                                         <tbody class="table-border-bottom-0">
                                         </tbody>
                                     </table>

                                     <script>
                                         const route = "{{ route('datatable.course_activities_all') }}"

                                         const columns = [{
                                                 data: 'title',
                                                 name: 'title',
                                             },
                                             {
                                                 data: 'module',
                                                 name: 'module',
                                             },
                                             {
                                                 data: 'type',
                                                 name: 'type',
                                             },
                                             {
                                                 data: 'items',
                                                 name: 'items',
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

                                         init_datatable('#course_activities_all', route, columns)
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