 <div class="content-wrapper">
     <!-- Content -->


     <div class="container-xxl flex-grow-1 container-p-y">

         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Courses / Take Activity</h4>

         <div class="row g-6 mb-3">
             <div class="col-lg-12 mb-3">
                 <div class="card">
                     <div class="card-header">
                         <a href="{{ route('user_view_course', encrypt($activity->course_id)) }}" class="btn rounded-pill float-end btn-secondary text-white">
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

                             <div class="col-lg-3 mb-2">
                                 <p class="m-0 text-muted">Course</p>
                                 <h6>{{ get_course_name($activity->course_id) }}</h6>
                             </div>

                             <div class="col-lg-3 mb-2">
                                 <p class="m-0 text-muted">Module</p>
                                 <h6>{{ get_module_name($activity->module_id) }}</h6>
                             </div>

                             <div class="col-lg-3 mb-2">
                                 <p class="m-0 text-muted">Type</p>
                                 <h6>
                                     @switch($activity->type)
                                     @case('MC')
                                     Multiple Choice
                                     @break

                                     @case('I')
                                     Identification
                                     @break

                                     @case('HO')
                                     Hands On
                                     @break

                                     @case('E')
                                     Essay
                                     @break

                                     @default
                                     Unknown Type
                                     @endswitch
                                 </h6>
                             </div>

                             <div class="col-lg-3 mb-2">
                                 <p class="m-0 text-muted">Total Points</p>
                                 <h6>{{ $total_points }}</h6>
                             </div>

                             <div class="col-lg-12 mb-2">
                                 <p class="m-0 text-muted">Title</p>
                                 <h6>{{ $activity->title }}</h6>
                             </div>

                             <div class="col-lg-12 mb-2">
                                 <p class="m-0 text-muted">Description</p>
                                 <h6>{!! $activity->description !!}</h6>
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