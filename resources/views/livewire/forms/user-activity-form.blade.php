 <div class="content-wrapper">
     <!-- Content -->


     <div class="container-xxl flex-grow-1 container-p-y">

         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Courses / Take Activity</h4>

         <div class="row g-6 mb-3">
             <div class="col-lg-12 mb-3">
                 <div class="card">
                     <div class="card-header">
                         <a href="{{ route('user_view_course', encrypt($activity->course_id)) }}" class="btn rounded-pill float-end btn-secondary text-white">
                             <span class="tf-icons bx bx-left-arrow-circle"></span> Go to course
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
                                 <div class="row bg-dark p-3">


                                     <div class="col-lg-3 mb-2">
                                         <p class="m-0 text-muted">Course</p>
                                         <h6 class="text-white">{{ get_course_name($activity->course_id) }}</h6>
                                     </div>

                                     <div class="col-lg-3 mb-2">
                                         <p class="m-0 text-muted">Module</p>
                                         <h6 class="text-white">{{ get_module_name($activity->module_id) }}</h6>
                                     </div>

                                     <div class="col-lg-3 mb-2">
                                         <p class="m-0 text-muted">Type</p>
                                         <h6 class="text-white">
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
                                         <h6 class="text-white">{{ $total_points }}</h6>
                                     </div>

                                     <div class="col-lg-12 mb-2">
                                         <p class="m-0 text-muted">Title</p>
                                         <h6 class="text-white">{{ $activity->title }}</h6>
                                     </div>
                                 </div>
                             </div>

                             <div class="col-lg-12 mb-2">
                                 <p class="m-0 text-muted">Description</p>
                                 <h6>{!! $activity->description !!}</h6>
                             </div>



                             @forelse($questions as $item)
                             <div class="col-lg-12 mb-2">
                                 @error("answers.{$item->id}")
                                 <div class="text-danger mb-2" style="font-size: 12px;">{{ $message }}</div>
                                 @enderror

                                 <div class="m-0 d-flex text-area">
                                     <b class="mx-2">{{ $loop->iteration }}.</b>
                                     @if($item->image)
                                     <img src="{{ asset('uploads/question_attachments/'. $item->image) }}" alt="" srcset="" class="mx-4">
                                     <br>
                                     @endif
                                     <div>
                                         <p> {!! $item->question !!}</p>
                                     </div>
                                 </div>



                                 @if($activity->type == MULTIPLE_CHOICE)
                                 <div class="row mt-4">
                                     @forelse($item->choices as $choice)
                                     <div class="col-lg-3 mb-2">
                                         @if($choice->image)
                                         <img src="{{ asset('uploads/question_attachments/'. $choice->image) }}" alt="" class="mb-2 mx-5" srcset="" style="max-height: 100px; max-width: 100px;">
                                         @endif
                                         <div class="form-check mx-5">
                                             <input wire:model="answers.{{$item->id}}" name="default-radio{{$item->id}}" class="form-check-input" type="radio" value="{{ $choice->key }}" id="defaultRadio1">
                                             <label class="form-check-label" for="defaultRadio1"> {{ $choice->choice }} </label>

                                         </div>

                                     </div>

                                     @empty

                                     @endforelse
                                 </div>

                                 @else
                                 <div class="row mt-3">
                                     <div class="col-lg-12 mb-2 p-4">
                                         <textarea wire:model="answers.{{$item->id}}" class="form-control" placeholder="Enter your answer" aria-label="With textarea" style="height: 135px;"></textarea>
                                         <label for="">or Insert image</label>
                                         <div class="custom-file-upload mb-2">
                                             <div wire:loading wire:target="answer_images.{{$item->id}}">
                                                 <p class="text-success">File Getting ready to upload ... Please wait.</p>
                                             </div>
                                             <input class="form-control" type="file" wire:model="answer_images.{{$item->id}}" id="image_d" accept="image/*">
                                         </div>
                                     </div>
                                 </div>
                                 @endif


                             </div>
                             @empty
                             <div class="col-lg-12">
                                 No Questions Available
                             </div>
                             @endforelse

                             @if($activity->ide_id)
                             <div wire:ignore>
                                 <h2 class="text-primary">{{ render_ide($activity->ide_id)->ide_name ?? '' }}</h2>
                                 {!! render_ide($activity->ide_id)->embed_code ?? '' !!}
                             </div>
                             @endif

                             <div class="col-lg-10"></div>
                             <div class="col-lg-2 mt-4">
                                 <div class="mb-3">
                                     @if($action == ACTION_ADD AND count($questions) > 0)
                                     <button
                                         class="btn btn-success d-grid w-100"
                                         wire:click.prevent="submit"
                                         wire:loading.attr="disabled"
                                         wire:target="submit"
                                         type="submit">
                                         <span wire:loading.remove wire:target="submit">Submit</span>
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