 <div class="content-wrapper">
     <!-- Content -->

     <div class="container-xxl flex-grow-1 container-p-y">

         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Courses</h4>

         <div class="row g-6 mb-3">
             <div class="col-lg-12 mb-3">
                 <div class="card">
                     <div class="card-header">
                         <div class="row">
                             <div class="col-lg-8"></div>
                             <div class="col-lg-4">
                                 <div class="mb-3">
                                     <label for="search" class="form-label">Search</label>
                                     <input type="text" wire:model.live="search" class="form-control" id="search" name="search" placeholder="Search Course" autofocus="">
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="card-body">


                         <div class="row">
                             <div class="col-lg-12 mb-2">
                                 @if(session('success'))
                                 <x-message-alert type="success" message="{{ session('success') }}" />
                                 @endif
                             </div>

                             @forelse($courses as $course)
                             <div class="col-md-6 col-lg-4 mb-3 ">
                                 <div class="card h-100">
                                     <img class="card-img-top h-100" src="{{ asset('img/undraw/'.$course->banner.'.png') }}" style="" alt="Card image cap">
                                     <div class="card-body">
                                         <h5 class="card-title">{{ ucfirst($course->title) }}</h5>
                                         <p class="card-text">
                                             <span class="badge bg-label-primary mb-0">No. of Modules. {{ get_number_of_modules($course->id)}}</span>
                                             <p>Uploaded By : {{ get_user_fullname($course->created_by)}}</p>
                                         </p>
                                         <a href="{{ route('user_view_course', encrypt($course->id)) }}" class="btn btn-primary">Learn</a>
                                     </div>
                                 </div>
                             </div>
                             @empty
                             <div class="col-lg-12">
                                 <p>No Course Available</p>
                             </div>
                             @endforelse

                             <div class="col-lg-12">
                                 {{ $courses->links() }}
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