 <div class="content-wrapper">
     <!-- Content -->
     @assets
     <link rel="stylesheet" type="text/css" href="{{ asset('simditor/styles/simditor.css') }}" />
     <script type="text/javascript" src="{{ asset('simditor/site/assets/scripts/module.js') }}"></script>
     <script type="text/javascript" src="{{ asset('simditor/site/assets/scripts/hotkeys.js') }}"></script>
     <script type="text/javascript" src="{{ asset('simditor/site/assets/scripts/simditor.js') }}"></script>
     @endassets
     <div class="container-xxl flex-grow-1 container-p-y">

         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Manage /</span> Questions </h4>

         <div class="row g-6 mb-3">
             <div class="col-lg-12 mb-3">
                 <div class="card">
                     <div class="card-header">
                         <a href="{{ route('activity_form', [encrypt($activity_id), encrypt(ACTION_MANAGE)]) }}" class="btn rounded-pill float-end btn-secondary text-white">
                             <span class="tf-icons bx bx-left-arrow-circle"></span> Back
                         </a>
                     </div>


                     @if($action == ACTION_EDIT OR $action == null)
                     <div class="card-body">
                         <h2>Question Form</h2>
                         <form id="formAuthentication" class="mb-3 row" method="POST">

                             <div class="col-lg-12 mb-2">
                                 @if(session('success'))
                                 <x-message-alert type="success" message="{{ session('success') }}" />
                                 @endif
                             </div>

                             <div class="col-lg-12 mb-2">
                                 @if(session('error'))
                                 <x-message-alert type="danger" message="{{ session('error') }}" />
                                 @endif
                             </div>
                             <div class="col-lg-12 mb-2">
                                 <img src="{{ asset($this->image) }}" alt="" class="mb-2" srcset="" style="max-height: 150px; max-width: 150px;">
                             </div>

                             <div class="col-lg-3 mb-2">
                                 <div class="mb-3">
                                     <div class="d-flex justify-content-between">
                                         <label for="email" class="form-label">Points</label>
                                         @error('points')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                     </div>
                                     <input type="text" wire:model="points" class="form-control" id="x" name="email-username" placeholder="Enter Points" autofocus="">
                                 </div>
                             </div>
                             <div class="col-lg-4 mb-2">
                                 <div class="mb-3">


                                     <div class="d-flex justify-content-between">
                                         <label for="email" class="form-label">Image (optional)</label>
                                         @error('image')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                         <div wire:loading wire:target="image">
                                             <p class="text-success">File Getting ready to upload ... Please wait.</p>
                                         </div>
                                     </div>
                                     <input class="form-control" type="file" wire:model="image" id="image">
                                 </div>
                             </div>



                             <div class="col-lg-12 mb-2">
                                 <div class="mb-3">
                                     <div class="d-flex justify-content-between">
                                         <label for="email" class="form-label">Question </label>
                                         @error('question')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                     </div>
                                     <div wire:ignore>
                                         <textarea id="editor" placeholder=""></textarea>
                                     </div>
                                 </div>
                             </div>

                             @if($activity->type == MULTIPLE_CHOICE)



                             <div class="col-lg-6 mb-2">
                                 <div class="mb-3">
                                     <div class="d-flex justify-content-between">
                                         <label for="email" class="form-label">Choice A</label>
                                         @error('choice_a')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                         <div wire:loading wire:target="image_a">
                                             <p class="text-success">File Getting ready to upload ... Please wait.</p>
                                         </div>
                                     </div>
                                     <input type="text" wire:model="choice_a" class="form-control" id="x" name="email-username" placeholder="Enter Value" autofocus="">
                                     @if($id)
                                     <div class="custom-file-upload">
                                         <input class="form-control" type="file" wire:model="image_a" id="image_a" accept="image/*">
                                         @if($image_a)
                                         <img src="{{ asset('uploads/question_attachments/'. $image_a) }}" alt="" srcset="" style="max-height: 100px; max-width: 100px;">
                                         @endif
                                     </div>
                                     @endif
                                 </div>
                             </div>

                             <div class="col-lg-6 mb-2">
                                 <div class="mb-3">
                                     <div class="d-flex justify-content-between">
                                         <label for="email" class="form-label">Choice B</label>
                                         @error('choice_b')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                         <div wire:loading wire:target="image_b">
                                             <p class="text-success">File Getting ready to upload ... Please wait.</p>
                                         </div>
                                     </div>
                                     <input type="text" wire:model="choice_b" class="form-control" id="x" name="email-username" placeholder="Enter Value" autofocus="">
                                     @if($id)
                                     <div class="custom-file-upload">

                                         <input class="form-control" type="file" wire:model="image_b" id="image_b" accept="image/*">
                                         @if($image_b)
                                         <img src="{{ asset('uploads/question_attachments/'. $image_b) }}" alt="" srcset="" style="max-height: 100px; max-width: 100px;">
                                         @endif
                                     </div>
                                     @endif
                                 </div>
                             </div>

                             <div class="col-lg-6 mb-2">
                                 <div class="mb-3">
                                     <div class="d-flex justify-content-between">
                                         <label for="email" class="form-label">Choice C</label>
                                         @error('choice_c')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                         <div wire:loading wire:target="image_c">
                                             <p class="text-success">File Getting ready to upload ... Please wait.</p>
                                         </div>
                                     </div>
                                     <input type="text" wire:model="choice_c" class="form-control" id="x" name="email-username" placeholder="Enter Value" autofocus="">
                                     @if($id)
                                     <div class="custom-file-upload">

                                         <input class="form-control" type="file" wire:model="image_c" id="image_c" accept="image/*">
                                         @if($image_c)
                                         <img src="{{ asset('uploads/question_attachments/'. $image_c) }}" alt="" srcset="" style="max-height: 100px; max-width: 100px;">
                                         @endif
                                     </div>
                                     @endif
                                 </div>
                             </div>

                             <div class="col-lg-6 mb-2">
                                 <div class="mb-3">
                                     <div class="d-flex justify-content-between">
                                         <label for="email" class="form-label">Choice D</label>
                                         @error('choice_d')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                         <div wire:loading wire:target="image_d">
                                             <p class="text-success">File Getting ready to upload ... Please wait.</p>
                                         </div>
                                     </div>
                                     <input type="text" wire:model="choice_d" class="form-control" id="x" name="email-username" placeholder="Enter Value" autofocus="">
                                     @if($id)
                                     <div class="custom-file-upload">
                                         <input class="form-control" type="file" wire:model="image_d" id="image_d" accept="image/*">
                                         @if($image_d)
                                         <img src="{{ asset('uploads/question_attachments/'. $image_d) }}" alt="" srcset="" style="max-height: 100px; max-width: 100px;">
                                         @endif
                                     </div>
                                     @endif
                                 </div>
                             </div>

                             <div class="col-lg-6 mb-2">

                                 <div class="mb-3">
                                     <div class="d-flex justify-content-between">
                                         <label for="email" class="form-label text-success">Answer (choose the right one)</label>
                                         @error('answer')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                     </div>
                                     <select wire:model="answer" id="defaultSelect" class="form-select">
                                         <option value="">Choose One</option>
                                         <option value="A">Choice A</option>
                                         <option value="B">Choice B</option>
                                         <option value="C">Choice C</option>
                                         <option value="D">Choice D</option>\

                                     </select>
                                 </div>
                             </div>

                             @endif

                             @if($activity->type == IDENTIFICATION)

                             <div class="col-lg-12 mb-2">
                                 <div class="mb-3">
                                     <div class="d-flex justify-content-between">
                                         <label for="email" class="form-label">Answer</label>
                                         @error('answer')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                     </div>
                                     <input type="text" wire:model="answer" class="form-control" id="x" name="email-username" placeholder="Enter Value" autofocus="">
                                 </div>
                             </div>
                             @endif



                             <div class="col-lg-12 mb-2">
                                 <div class="mb-3 float-end">


                                     @if($id)
                                     <button
                                         class="btn btn-danger "
                                         wire:click.prevent="delete"
                                         wire:loading.attr="disabled"
                                         wire:target="delete"
                                         type="submit">
                                         <span wire:loading.remove wire:target="delete">Delete</span>
                                         <span wire:loading wire:target="delete">
                                             <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                             Deleting ...
                                         </span>
                                     </button>
                                     @endif

                                     <button
                                         class="btn btn-primary "
                                         wire:click.prevent="process"
                                         wire:loading.attr="disabled"
                                         wire:target="process"
                                         type="submit">
                                         <span wire:loading.remove wire:target="process">Submit</span>
                                         <span wire:loading wire:target="process">
                                             <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                             Submitting form ...
                                         </span>
                                     </button>
                                 </div>
                             </div>
                         </form>

                         @script
                         <script>
                             Simditor.locale = 'en-US';
                             const editor = new Simditor({
                                 textarea: $('#editor'),
                                 toolbar: [
                                     'title', 'bold', 'italic', 'underline',
                                     'strikethrough', 'fontScale', 'color',
                                     'ol', 'ul', 'blockquote',
                                     'code', 'table', 'link', // ✅ No 'image' here
                                     'hr', 'indent', 'outdent',
                                     'alignment'
                                 ]
                                 //optional options
                             });


                             editor.on('valuechanged', (e, src) => {
                                 $wire.dispatch('update_textarea_value', {
                                     data: editor.getValue()
                                 });
                             });

                             const savedContent = `{!! addslashes($question) !!}`; // Laravel Blade escaping
                             editor.setValue(savedContent);
                         </script>
                         @endscript
                     </div>

                     @elseif($action == ACTION_VIEW)
                     <div class="card-body">
                         <div class="row">
                             <div class="col-lg-12 mb-2">
                                 <b class="mb-2">Points : </b>
                                 <b class="text-success">{{ $points }}</b>
                             </div>
                             <div class="col-lg-12 mb-2">
                                 <img src="{{ asset('uploads/question_attachments/'. $current_image) }}" alt="" class="mb-2" srcset="" style="max-height: 100%; max-width: 100%;">

                             </div>

                             <div class="col-lg-12 mb-2 text-area">
                                 <b class="mb-2">Question</b>

                                 <style>

                                 </style>
                                 <b>{!! $question !!}</b>
                             </div>



                             @if($activity->type == MULTIPLE_CHOICE)
                             <div class="col-lg-12 mb-2">
                                 <ul class="list-group fw-bold">
                                     <li class="list-group-item">A : {{ $choice_a }}
                                         @if($image_a)
                                         <br>
                                         <img src="{{ asset('uploads/question_attachments/'. $image_a) }}" alt="" class="mb-2" srcset="" style="max-height: 100px; max-width: 100px;">
                                         @endif
                                     </li>
                                     <li class="list-group-item">B : {{ $choice_b }}
                                         @if($image_b)
                                         <br>
                                         <img src="{{ asset('uploads/question_attachments/'. $image_b) }}" alt="" class="mb-2" srcset="" style="max-height: 100px; max-width: 100px;">
                                         @endif
                                     </li>
                                     <li class="list-group-item">C : {{ $choice_c }}
                                         @if($image_c)
                                         <br>
                                         <img src="{{ asset('uploads/question_attachments/'. $image_c) }}" alt="" class="mb-2" srcset="" style="max-height: 100px; max-width: 100px;">
                                         @endif
                                     </li>
                                     <li class="list-group-item">D : {{ $choice_d }}
                                         @if($image_d)
                                         <br>
                                         <img src="{{ asset('uploads/question_attachments/'. $image_d) }}" alt="" class="mb-2" srcset="" style="max-height: 100px; max-width: 100px;">
                                         @endif
                                     </li>
                                 </ul>

                             </div>
                             @endif

                             <div class="col-lg-12 mb-2">
                                 <b class="mb-2">Answer</b>
                                 <b class="text-success">{{ $answer }}</b>
                             </div>

                         </div>
                     </div>
                     @endif
                 </div>
             </div>

         </div>



     </div>
     <!-- / Content -->

     <!-- Footer -->
     <livewire:base.footer />
     <!-- / Footer -->

 </div>