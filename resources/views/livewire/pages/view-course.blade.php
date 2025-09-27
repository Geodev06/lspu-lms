 <div class="content-wrapper">
     <!-- Content -->
     @assets
     <link href="https://unpkg.com/video.js/dist/video-js.min.css" rel="stylesheet">
     <link href="https://unpkg.com/videojs-theme-forest@1.0.6/dist/videojs-theme-forest.min.css" rel="stylesheet" />

     <script src="https://unpkg.com/video.js/dist/video.min.js"></script>

     @endassets

     <div class="container-xxl flex-grow-1 container-p-y">

         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Courses / View</h4>

         <div class="row g-6 mb-3">
             <div class="col-lg-12 mb-3">
                 <div class="card">
                     <div class="card-header">
                         <a href="{{ route('user_courses') }}" class="btn rounded-pill float-end btn-secondary text-white">
                             <span class="tf-icons bx bx-left-arrow-circle"></span> Back
                         </a>
                     </div>
                     <div class="card-body">
                         <div class="row">
                             <div class="col-lg-12 mb-2">
                                 @if(session('success'))
                                 <x-message-alert type="success" message="{{ session('success') }}" />
                                 @endif
                             </div>

                             <div class="col-xl-12">
                                 <h6 class="text-muted">Course Content</h6>
                                 <div class="nav-align-top mb-4">
                                     <ul class="nav nav-tabs nav-fill" role="tablist">
                                         <li class="nav-item">
                                             <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true">
                                                 <i class="tf-icons bx bx-info-circle"></i> Overview
                                             </button>
                                         </li>
                                         <li class="nav-item">
                                             <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile" aria-selected="false">
                                                 <i class="tf-icons bx bx-list-ul"></i> Modules
                                             </button>
                                         </li>
                                         <li class="nav-item">
                                             <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-messages" aria-controls="navs-justified-messages" aria-selected="false">
                                                 <i class="tf-icons bx bx-star"></i> Activities
                                             </button>
                                         </li>
                                     </ul>
                                     <div class="tab-content">
                                         <div class="tab-pane fade active show" id="navs-justified-home" role="tabpanel">
                                             <div class="row">
                                                 <div class="col-lg-3">
                                                     <p class="m-0 text-muted">Title</p>
                                                     <h6>{{ ucfirst($course->title) }}</h6>
                                                 </div>

                                                 <div class="col-lg-3">
                                                     <p class="m-0 text-muted">Course Code</p>
                                                     <h6>{{ ucwords($course->course_code) }}</h6>
                                                 </div>

                                                 <div class="col-lg-3">
                                                     <p class="m-0 text-muted">Created Date</p>
                                                     <h6>{{ $course->created_at }}</h6>
                                                 </div>

                                                 <div class="col-lg-3">
                                                     <p class="m-0 text-muted">Uploaded By</p>
                                                     <h6>{{ get_user_fullname($course->created_by)}}</h6>
                                                 </div>

                                                 <div class="col-lg-12">
                                                     <p class="m-0 text-muted">Designated For</p>
                                                     <h6>{{ get_org_name($course->org_code)}}</h6>
                                                 </div>

                                                 <div class="col-lg-12">
                                                     <p class="m-0 text-muted">Description</p>
                                                     {!! $course->description !!}
                                                 </div>

                                             </div>
                                         </div>
                                         <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                                             <div class="row">
                                                 <div class="col-md mb-4 mb-md-0">
                                                     <small class="text-light fw-semibold">Module List</small>
                                                     <div class="accordion mt-3" id="accordionExample">

                                                         @forelse($course_modules as $module)
                                                         <div class="card accordion-item">
                                                             <h2 class="accordion-header" id="heading{{ $module->id }}">
                                                                 <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion{{ $module->id }}" aria-expanded="false" aria-controls="accordion{{ $module->id }}">
                                                                     {{ ucfirst($module->title) }}
                                                                 </button>
                                                             </h2>

                                                             <div id="accordion{{ $module->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                                 <div class="accordion-body">
                                                                     <div class="row">
                                                                         <div class="col-lg-12 mb-3">
                                                                             {!! $module->description !!}
                                                                         </div>
                                                                         <p>All learning materials for this module is uploaded here.<a class="btn btn-link" href="{{ route('user_view_course_files', [encrypt($id), encrypt($module->id)]) }}">Browse Files</a></p>
                                                                         
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                         @empty
                                                         <p>No available modules found.</p>
                                                         @endforelse

                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                                             <p>
                                                 Available Activities
                                             </p>
                                             <div class="row">
                                                 <div class="col-lg-12">
                                                     <div class="table-responsive text-nowrap">
                                                         <table class="table table-striped " id="course_activities">
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
                                                             const route = "{{ route('datatable.course_activities', encrypt($course->id)) }}"

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

                                                             init_datatable('#course_activities', route, columns)
                                                         </script>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
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

     <script>
         document.addEventListener('DOMContentLoaded', function() {

             var player = videojs('my-video');

             // =======================
             // Save/Restore Tab State
             // =======================
             const tabButtons = document.querySelectorAll('.nav-tabs .nav-link');
             const activeTabId = localStorage.getItem('activeTabId');

             if (activeTabId) {
                 const triggerEl = document.querySelector(`.nav-link[data-bs-target="${activeTabId}"]`);
                 if (triggerEl) {
                     new bootstrap.Tab(triggerEl).show();
                 }
             }

             tabButtons.forEach(button => {
                 button.addEventListener('shown.bs.tab', function(event) {
                     const tabTarget = event.target.getAttribute('data-bs-target');
                     localStorage.setItem('activeTabId', tabTarget);
                 });
             });

             // ==========================
             // Save/Restore Accordion State
             // ==========================
             const accordion = document.getElementById('accordionExample');

             // Restore accordion state
             const openAccordionId = localStorage.getItem('openAccordionId');
             if (openAccordionId) {
                 const collapseEl = document.getElementById(openAccordionId);
                 if (collapseEl) {
                     const bsCollapse = new bootstrap.Collapse(collapseEl, {
                         toggle: true
                     });
                 }
             }

             // Listen for accordion toggle events
             accordion.addEventListener('shown.bs.collapse', function(event) {
                 localStorage.setItem('openAccordionId', event.target.id);
             });

             accordion.addEventListener('hidden.bs.collapse', function(event) {
                 // Only clear if the hidden one is the one saved
                 if (localStorage.getItem('openAccordionId') === event.target.id) {
                     localStorage.removeItem('openAccordionId');
                 }
             });
         });
     </script>

     <!-- / Footer -->

 </div>