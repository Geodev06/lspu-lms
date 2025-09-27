 <div class="content-wrapper">
     <!-- Content -->
     @assets
     <link href="https://unpkg.com/video.js/dist/video-js.min.css" rel="stylesheet">
     <link href="https://unpkg.com/videojs-theme-forest@1.0.6/dist/videojs-theme-forest.min.css" rel="stylesheet" />

     <script src="https://unpkg.com/video.js/dist/video.min.js"></script>

     @endassets

     <div class="container-xxl flex-grow-1 container-p-y">

         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Courses / Files / View</h4>

         <div class="row g-6 mb-3">
             <div class="col-lg-12 mb-3">
                 <div class="card">
                     <div class="card-header">
                         <a href="{{ route('user_view_course', encrypt($id)) }}" class="btn rounded-pill float-end btn-secondary text-white">
                             <span class="tf-icons bx bx-left-arrow-circle"></span> Back
                         </a>
                     </div>

                     <div class="card-body">
                         <h2>{{ $module->title ?? '' }}</h2>
                         <div class="row">
                             <div class="col-lg-3">
                                 <div class="mb-3">
                                     <input type="text" wire:model.live="search" class="form-control" name="search" placeholder="Search" autofocus="">
                                 </div>
                             </div>
                         </div>
                         <div class="row">
                             @forelse($attachtments as $item)

                             <div class="col-lg-4 col-md-3 col-sm-6 mb-2">
                                 <div class="card h-100">
                                     <div class="card-body">
                                         <p>{{ $item->file_name }}</p>
                                         @if($item->category == 'PDF')
                                         <span class="tf-icons bx bxs-file-pdf fs-1"></span>
                                         @elseif($item->category == 'VIDEO')
                                         <span class="tf-icons bx bxs-movie-play fs-1"></span>
                                         @elseif($item->category == 'AUDIO')
                                         <span class="tf-icons bx bxs-music fs-1"></span>
                                         @elseif($item->category == 'LINK')
                                         <span class="tf-icons bx bx-link fs-1"></span>
                                         @elseif($item->category == 'IMAGE')
                                         <span class="tf-icons bx bx-image fs-1"></span>
                                         @endif

                                         <a href="{{ route('user_view_course_files_open', [encrypt($id), encrypt($module_id), encrypt($item->id)]) }}" class="btn btn-sm btn-success">View File</a>
                                     </div>
                                 </div>
                             </div>
                             @empty
                             <p>No Data</p>
                             @endforelse
                         </div>
                         {{ $attachtments->links() }}
                     </div>

                 </div>
             </div>

         </div>



     </div>
     <!-- / Content -->

     <!-- Footer -->
     <livewire:base.footer />



 </div>