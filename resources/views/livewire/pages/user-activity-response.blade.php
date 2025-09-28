 <div class="content-wrapper">
     <!-- Content -->

     <div class="container-xxl flex-grow-1 container-p-y">

         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Activity</h4>

         <div class="row g-6 mb-3">
             <div class="col-lg-12 mb-3">
                 <div class="card">
                     <div class="card-body">
                         <div class="row bg-dark p-3">
                             <div class="col-lg-12 mb-2">
                                 @if(session('success'))
                                 <x-message-alert type="success" message="{{ session('success') }}" />
                                 @endif
                             </div>

                             <div class="col-lg-3 mb-2">
                                 <p class="m-0 text-muted">Course</p>
                                 <h5 class="text-white">{{ $submission->course_name }}</h5>
                             </div>

                             <div class="col-lg-3 mb-2">
                                 <p class="m-0 text-muted">Module</p>
                                 <h5 class="text-white">{{ $submission->module_name }}</h5>
                             </div>

                             <div class="col-lg-3 mb-2">
                                 <p class="m-0 text-muted">Activity</p>
                                 <h5 class="text-white">{{ $submission->activity_name }}</h5>
                             </div>

                             <div class="col-lg-3 mb-2">
                                 <p class="m-0 text-muted">Submitted Date</p>
                                 <h5 class="text-white">{{ $submission->created_at }}</h5>
                             </div>

                             <div class="col-lg-3 mb-2">
                                 <p class="m-0 text-muted">Type</p>
                                 <h5 class="text-white">{{ get_modality_type($submission->activity_type) }}</h5>
                             </div>

                             @if($submission->checked_flag == 1 OR $submission->activity_type == 'I')
                             <div class="col-lg-3 mb-2">
                                 <p class="m-0 text-muted">Points</p>
                                 <h5 class="text-white">{{ $submission->points }}</h5>
                             </div>

                             <div class="col-lg-3 mb-2">
                                 <p class="m-0 text-muted">Grade</p>
                                 <h5 class="text-white">{{ $submission->grade }}</h5>
                             </div>

                             <div class="col-lg-3 mb-2">
                                 <p class="m-0 text-muted">Checked Date</p>
                                 <h5 class="text-white">{{ $submission->updated_at }}</h5>
                             </div>

                             @endif
                         </div>

                         <div class="row">

                             @foreach($submission_details as $item)
                             <div class="col-lg-12 mb-3 border p-3 mt-2">
                                 <div class="mt-4">
                                     <b class="text-dark">Item no. {{ $loop->iteration }}</b>
                                     <p>{!! $item->question !!}</p>
                                 </div>
                                 <hr>
                                 <div class="d-flex justify-content-between align-items-center">
                                     <div class="d-flex flex-column">
                                         <p class="text-muted m-0">User Answer : </p>
                                         <p class="text-success">Correct Answer : {{ $item->correct_answer }}</p>
                                     </div>

                                     @if($action == ACTION_EDIT AND $submission->checked_flag == 0 )

                                     <div class="mb-3">
                                         @if($submission->activity_type == 'I' OR $submission->activity_type == 'HO')
                                         <div class="d-flex">
                                             <b class="text-dark">{{ $item->points }}</b>
                                             @if($item->points != 0)
                                             <i class="bx bx-check text-success"></i>
                                             @else
                                             <i class="bx bx-x text-danger"></i>
                                             @endif
                                         </div>
                                         @error("answers.{$item->id}")
                                         <div class="text-danger mb-2" style="font-size: 12px;">{{ $message }}</div>
                                         @enderror
                                         <input type="text" wire:model="answers.{{$item->id}}" class="form-control" name="answers.{{$item->id}}" value="{{ $item->points }}" placeholder="Enter your points" autofocus="true">
                                     </div>


                                     @endif

                                     @else
                                     <div class="d-flex">
                                         <b class="text-dark">{{ $item->points }}</b>
                                         @if($item->points != 0)
                                         <i class="bx bx-check text-success"></i>
                                         @else
                                         <i class="bx bx-x text-danger"></i>
                                         @endif
                                     </div>

                                     @endif
                                 </div>
                                 <div class="bg-dark p-4 text-white" style="border-radius: 20px;">
                                     {{ $item->answer }}

                                     @if($item->image)
                                     <br>
                                     <img src="{{ asset('uploads/answer_files/'. $item->image) }}" class="mt-2 mb-2" style="max-height: 100%; max-width: 100%;">
                                     @endif
                                 </div>


                             </div>
                             @endforeach

                             <div class="col-lg-10">

                             </div>
                             <div class="col-lg-2 mt-4">
                                 <div class="mb-3">
                                     @if($action == ACTION_EDIT AND $submission->checked_flag == 0)
                                     <button
                                         class="btn btn-success d-grid w-100"
                                         wire:click.prevent="submit"
                                         wire:loading.attr="disabled"
                                         wire:target="submit"
                                         type="submit">
                                         <span wire:loading.remove wire:target="submit">Finish Checking</span>
                                         <span wire:loading wire:target="submit">
                                             <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                             Submitting Form ...
                                         </span>
                                     </button>
                                     @endif
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