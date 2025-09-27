 <div class="content-wrapper">
     <!-- Content -->

     <div class="container-xxl flex-grow-1 container-p-y">

         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Management /</span> Learning Course </h4>

         <div class="row g-6 mb-3">
             <div class="col-lg-12 mb-3">
                 <div class="card">
                     <div class="card-header">
                         <a href="{{ route('learning_course_form') }}" class="btn rounded-pill float-end btn-primary text-white">
                             <span class="tf-icons bx bx-plus"></span> Add Course
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
                                 <h3 class="mx-3">Courses Table</h3>
                             </div>
                             <div class="col-lg-12">
                                 <div class="table-responsive text-nowrap">
                                     <table class="table table-striped " id="learning_courses">
                                         <thead>
                                             <tr>
                                                 <th>Course Code</th>
                                                 <th>Title</th>
                                                 <th>Department</th>
                                                 <th>Status</th>
                                                 <th>Actions</th>
                                             </tr>
                                         </thead>
                                         <tbody class="table-border-bottom-0">

                                         </tbody>
                                     </table>

                                     <script>
                                         const route = "{{ route('datatable.learning_courses') }}"

                                         const columns = [{
                                                 data: 'course_code',
                                                 name: 'course_code',
                                             },
                                             {
                                                 data: 'title',
                                                 name: 'title',
                                             },
                                             {
                                                 data: 'org_code',
                                                 name: 'org_code',
                                             },
                                             {
                                                 data: 'active_flag',
                                                 name: 'active_flag',
                                             },
                                             {
                                                 data: 'actions',
                                                 name: 'actions',
                                             }
                                         ]

                                         init_datatable('#learning_courses', route, columns)
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