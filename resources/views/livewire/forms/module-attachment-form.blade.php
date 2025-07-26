<div class="content-wrapper">
    <!-- Content -->


    @assets
    <link href="https://unpkg.com/video.js/dist/video-js.min.css" rel="stylesheet">
    <link href="https://unpkg.com/videojs-theme-forest@1.0.6/dist/videojs-theme-forest.min.css" rel="stylesheet" />

    <script src="https://unpkg.com/video.js/dist/video.min.js"></script>

    @endassets
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Management /</span> <span class="text-muted fw-light">Course </span> / <span class="text-muted fw-light">Module </span> / Attachment </h4>

        <div class="row g-6 mb-3">
            <div class="col-lg-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('learning_module_form', [encrypt($course_id), encrypt($module_id), encrypt(ACTION_MANAGE)]) }}" class="btn rounded-pill float-end btn-secondary text-white">
                            <span class="tf-icons bx bx-left-arrow-circle"></span> Back
                        </a>
                    </div>



                    @if($action == ACTION_EDIT OR $action == null)

                    <div class="card-body">
                        <h2>Upload</h2>
                        <form id="formAuthentication" class="mb-3 row" method="POST">



                            <div class="col-lg-12 mx-auto mb-3">
                                <div class="row bg-dark p-3">

                                    <div class="col-lg-2 mb-2">
                                        <p class="m-0 text-muted">Course Code</p>
                                        <b class="text-white">{{ $course_code }}</b>
                                    </div>

                                    <div class="col-lg-2 mb-2">
                                        <p class="m-0 text-muted">Title</p>
                                        <b class="text-white">{{ $course_title }}</b>
                                    </div>

                                    <div class="col-lg-8 mb-2">
                                        <p class="m-0 text-muted">For Department</p>
                                        <b class="text-white">{{ get_org_name($course_org_code) }}</b>
                                    </div>

                                    <div class="col-lg-8 mb-2">
                                        <p class="m-0 text-muted">Module</p>
                                        <b class="text-white">{{ get_module_name($module_id) }}</b>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <p class="text-dark">System will automatically assign modality applied per category. except <span class="text-danger">(kinesthetic)</span></p>
                                    <ul class="text-success">
                                        <li>PDF - Reading & Writing | Visual</li>
                                        <li>AUDIO - Auditory</li>
                                        <li>VIDEO - Auditory | Visual </li>
                                        <li>LINK - Auditory | Visual | Reading & Writing </li>
                                        <li>IMAGE - Visual</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-2">

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label for="email" class="form-label">Category</label>
                                        @error('category')
                                        <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <select wire:model="category" id="defaultSelect" class="form-select">
                                        <option value="PDF">PDF</option>
                                        <option value="VIDEO">VIDEO</option>
                                        <option value="AUDIO">AUDIO</option>
                                        <option value="LINK">LINK</option>
                                        <option value="IMAGE">IMAGE</option>
                                    </select>
                                </div>
                            </div>



                            @error('file')
                            <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                            @enderror


                            <!-- Loading Spinner -->
                            <div wire:loading wire:target="file">
                                <p>File Getting ready to upload ... Please wait.</p>
                                {{-- Optional: Replace with a spinner --}}
                                <div class="spinner-border spinner-border-lg text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>



                            </div>

                            <div
                                x-data="{ uploading: false, progress: 0 }"
                                x-on:livewire-upload-start="uploading = true"
                                x-on:livewire-upload-finish="uploading = false"
                                x-on:livewire-upload-cancel="uploading = false"
                                x-on:livewire-upload-error="uploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <!-- File Input -->

                                <!-- Progress Bar -->
                                <div x-show="uploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>

                                @if(in_array($category, [F_PDF, F_VIDEO, F_AUDIO, F_IMAGE]))
                                <div class="col-lg-12 mb-2">
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <label for="formFile" class="form-label">Attachment</label>
                                        </div>
                                        <input
                                            class="form-control"
                                            type="file"
                                            wire:loading.attr="disabled"
                                            wire:target="file"
                                            wire:model.live="file"
                                            id="formFile"
                                            @if($category==F_PDF) accept=".pdf"
                                            @elseif($category==F_VIDEO) accept="video/mkv*"
                                            @elseif($category==F_AUDIO) accept="audio/*"
                                            @elseif($category==F_IMAGE) accept="image/*"
                                            @endif>
                                    </div>
                                </div>

                                @elseif($category == F_LINK)
                                <div class="col-lg-12 mb-2">
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <label for="linkInput" class="form-label">Link (paste here)</label>
                                        </div>
                                        <input type="text" wire:model="file" class="form-control" id="linkInput" name="file" placeholder="Enter your Link" autofocus>
                                    </div>
                                </div>
                                @endif

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" wire:model="kinesthetic" value="1" type="checkbox" id="kinesthetic-me">
                                            <label class="form-check-label" for="kinesthetic-me">Applied Kinesthetic ? </label>
                                        </div>
                                    </div>
                                </div>




                                <div class="col-lg-12 mb-2">
                                    <div class="mb-3">
                                        <b class="text-success"> {{ $record->file_name ?? '' }} </b>
                                    </div>




                                    <div class="col-lg-12 mb-2">
                                        <div class="mb-3 float-end">
                                            <div class="d-flex">

                                                @if($attachment_id)
                                                <button
                                                    class="btn btn-danger mx-2 d-grid w-100"
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
                                                    class="btn btn-primary d-grid w-100"
                                                    wire:click.prevent="process"

                                                    wire:loading.attr="disabled"
                                                    wire:target="file"



                                                    type="submit">
                                                    <span wire:loading.remove wire:target="process">Submit</span>
                                                    <span wire:loading wire:target="process">
                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                        Submitting form ...
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                        </form>
                    </div>
                    @elseif($action == ACTION_VIEW)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                                <div class="row">


                                    <div class="col-lg-12 mb-2">
                                        <p class="m-0">Category</p>
                                        <b>{{ $record->category }}</b>
                                    </div>

                                    <div class="col-lg-12 mb-2">
                                        <p class="m-0">File Name</p>
                                        <b>{{ $record->file_name }}</b>

                                        @switch($record->category)
                                        @case(F_IMAGE)
                                        <div class="mt-2">
                                            <img src="{{ asset('uploads/attachments/' . $record->sys_file_name) }}" alt="Image" class="img-fluid" style="max-height: 300px;">
                                        </div>
                                        @break

                                        @case(F_AUDIO)
                                        <div class="mt-2">
                                            <audio controls>
                                                <source src="{{ asset('uploads/attachments/' . $record->sys_file_name) }}" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        </div>
                                        @break

                                        @case(F_VIDEO)
                                        <div class="mt-2">
                                            <video
                                                id="my-video"
                                                class="video-js vjs-forest"
                                                controls
                                                preload="auto"
                                                style="max-width: 100%; max-height: 100%;"
                                                data-setup='{}'>
                                                <source src="{{ asset('uploads/attachments/' . $record->sys_file_name) }}" type="video/mp4" />
                                                <p class="vjs-no-js">
                                                    To view this video please enable JavaScript, and consider upgrading to a
                                                    web browser that
                                                    <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                                                </p>
                                            </video>
                                        </div>

                                        <script>
                                            var player = videojs('my-video');
                                            // You can add player options or event handlers here if needed
                                        </script>
                                        @break

                                        @case(F_PDF)
                                        <div class="mt-2">
                                            <iframe src="{{ asset('uploads/attachments/' . $record->sys_file_name) }}" width="100%" height="900"></iframe>
                                        </div>
                                        @break

                                        @case(F_LINK)
                                        <div class="mt-2">
                                            <a href="{{ $record->file_name }}" target="_blank" class="btn btn-sm btn-primary">
                                                Open Link
                                            </a>
                                        </div>
                                        @break

                                        @default
                                        <div class="mt-2 text-muted">
                                            <i>No preview available for this file type.</i>
                                        </div>
                                        @endswitch

                                    </div>

                                    <div class="col-lg-12 mb-2">
                                        <p class="m-0">Date Uploaded</p>
                                        <b>{{ $record->created_at }}</b>
                                    </div>



                                </div>
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