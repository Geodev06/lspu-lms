 <div class="content-wrapper">
     <!-- Content -->
     @assets
     <link href="https://unpkg.com/video.js/dist/video-js.min.css" rel="stylesheet">

     <script src="https://unpkg.com/video.js/dist/video.min.js"></script>

     @endassets

     <script>
         function trackResource(resourceElement, fileId, fileType) {
             let startTime = 0;
             let totalTime = 0;
             let isActive = false;
             let intervalId = null; // for setInterval reference

             function startTracking() {
                 if (!isActive) {
                     startTime = Date.now();
                     isActive = true;

                     // Start interval to log time every second
                     intervalId = setInterval(() => {
                         const elapsed = Math.floor((Date.now() - startTime + totalTime) / 1000);
                         console.log(`Elapsed seconds for file ${fileId}:`, elapsed);
                     }, 1000);
                 }
             }

             function stopTracking(eventType) {
                 if (!isActive) return;

                 let sessionTime = Date.now() - startTime;
                 totalTime += sessionTime;
                 isActive = false;

                 // Clear the interval timer
                 if (intervalId) {
                     clearInterval(intervalId);
                     intervalId = null;
                 }

                 navigator.sendBeacon("/save-engagement", JSON.stringify({
                     fileId: fileId,
                     type: fileType,
                     event: eventType,
                     sessionTime: sessionTime,
                     totalTime: totalTime,
                     timestamp: Date.now(),
                     _token: '{{ csrf_token() }}'
                 }));

                  totalTime = 0;
             }

             if (fileType === "VIDEO" || fileType === "AUDIO") {
                 resourceElement.addEventListener("play", () => startTracking());
                 resourceElement.addEventListener("pause", () => stopTracking("pause"));
                 resourceElement.addEventListener("ended", () => stopTracking("ended"));

                 document.addEventListener("visibilitychange", () => {
                     if (document.visibilityState === "hidden" && isActive) {
                         stopTracking("hidden");
                     } else if (document.visibilityState === "visible" && !isActive && !resourceElement.paused) {
                         startTracking();
                     }
                 });
             }

             if (fileType === "IMAGE" || fileType === "PDF") {
                 startTracking();

                 document.addEventListener("visibilitychange", () => {
                     if (document.visibilityState === "hidden") {
                         stopTracking("hidden");
                     } else if (document.visibilityState === "visible") {
                         startTracking();
                     }
                 });
             }

             window.addEventListener("beforeunload", () => stopTracking("exit"));
         }
     </script>

     <div class="container-xxl flex-grow-1 container-p-y">

         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Courses / Files / Open</h4>

         <div class="row g-6 mb-3">
             <div class="col-lg-12 mb-3">
                 <div class="card">
                     <div class="card-header">
                         <a href="{{ route('user_view_course_files', [encrypt($id), encrypt($module_id)]) }}" class="btn rounded-pill float-end btn-secondary text-white">
                             <span class="tf-icons bx bx-left-arrow-circle"></span> Back
                         </a>
                     </div>

                     <div class="card-body">
                         <p>{{ $file->file_name ?? '' }}</p>

                         <div class="row">
                             @if($file->category == 'VIDEO')
                             <video
                                 id="my-video"
                                 class="video-js vjs-theme-forest"
                                 controls
                                 preload="auto"
                                 width="640"
                                 height="560"
                                 data-setup='{}'>
                                 <source src="{{ asset('uploads/attachments/'. $file->sys_file_name) }}" type="video/mp4" />
                                 <p class="vjs-no-js">
                                     To view this video please enable JavaScript, and consider upgrading to a
                                     web browser that
                                     <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                                 </p>
                             </video>
                             <script>
                                 document.addEventListener('DOMContentLoaded', function() {
                                     const player = videojs('my-video');
                                     // Get the native HTML5 video element managed by Video.js
                                     const nativeVideoElement = player.el().querySelector('video');

                                     if (nativeVideoElement) {
                                         trackResource(nativeVideoElement, '{{ $file->id }}', 'VIDEO');
                                     }
                                 });
                             </script>
                             @endif

                             @if($file->category == 'PDF')
                             <iframe
                                 src="{{ asset('uploads/attachments/' . $file->sys_file_name) }}"
                                 width="100%"
                                 height="800px"
                                 style="border: none;">
                             </iframe>
                             <script>
                                 let pdfElement = document.querySelector('iframe');
                                 if (pdfElement) {
                                     trackResource(pdfElement, '{{ $file->id }}', 'PDF');
                                 }
                             </script>
                             @endif

                             @if($file->category === 'AUDIO')
                             <audio controls style="width: 100%;">
                                 <source src="{{ asset('uploads/attachments/' . $file->sys_file_name) }}" type="audio/mpeg">
                                 Your browser does not support the audio element.
                             </audio>
                             <script>
                                 let audioElement = document.querySelector('audio');
                                 if (audioElement) {
                                     trackResource(audioElement, '{{ $file->id }}', 'AUDIO');
                                 }
                             </script>
                             @endif

                             @if($file->category === 'IMAGE')
                             <img
                                 src="{{ asset('uploads/attachments/' . $file->sys_file_name) }}"
                                 alt="{{ $file->original_file_name }}"
                                 style="max-width: 100%; height: auto; border: 1px solid #ccc; padding: 5px;">
                             <script>
                                 let imgElement = document.querySelector('img');
                                 if (imgElement) {
                                     trackResource(imgElement, '{{ $file->id }}', 'IMAGE');
                                 }
                             </script>
                             @endif

                         </div>

                     </div>

                 </div>
             </div>

         </div>



     </div>
     <!-- / Content -->

     <!-- Footer -->
     <livewire:base.footer />

     <div>





     </div>



 </div>