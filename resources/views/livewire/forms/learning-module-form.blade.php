<div class="content-wrapper">
    <!-- Content -->

    @assets
    <link rel="stylesheet" type="text/css" href="{{ asset('simditor/styles/simditor.css') }}" />
    <script type="text/javascript" src="{{ asset('simditor/site/assets/scripts/module.js') }}"></script>
    <script type="text/javascript" src="{{ asset('simditor/site/assets/scripts/hotkeys.js') }}"></script>
    <script type="text/javascript" src="{{ asset('simditor/site/assets/scripts/simditor.js') }}"></script>
    @endassets

    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Management /</span> <span class="text-muted fw-light">Course </span> / Module </h4>

        <div class="row g-6 mb-3">
            <div class="col-lg-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('learning_course_form', [encrypt($course_id), encrypt(ACTION_MANAGE)]) }}" class="btn rounded-pill float-end btn-secondary text-white">
                            <span class="tf-icons bx bx-left-arrow-circle"></span> Back
                        </a>
                    </div>



                    @if($action == ACTION_EDIT OR $action == null)

                    <div class="card-body">
                        <h2>Module Form</h2>
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
                                </div>
                            </div>

                            <div class="col-lg-12 mb-2">

                                <div class="mb-3">

                                    <div class="d-flex justify-content-between">
                                        <label for="email" class="form-label">Title</label>
                                        @error('title')
                                        <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <input type="text" wire:model="title" class="form-control" id="x" name="email-username" placeholder="Enter Module Title" autofocus="">
                                </div>
                            </div>

                            <div class="col-lg-12 mb-2">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label for="email" class="form-label">Description </label>
                                        @error('description')
                                        <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div wire:ignore>
                                        <textarea id="editor" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-12 mb-2">
                                <div class="mb-3 float-end">
                                    <div class="d-flex">

                                        @if($module_id)
                                        <button
                                            class="btn btn-danger mx-2 d-grid w-100"
                                            wire:click.prevent="delete"
                                            wire:loading.attr="disabled"
                                            wire:target="delete"
                                            type="submit">
                                            <span wire:loading.remove wire:target="delete">Delete</span>
                                            <span wire:loading wire:target="delete">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                Deleting data ...
                                            </span>
                                        </button>
                                        @endif
                                        <button
                                            class="btn btn-primary d-grid w-100"
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
                            </div>
                        </form>
                    </div>
                    @elseif($action == ACTION_VIEW)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                                <div class="row">


                                    <div class="col-lg-12 mb-2">
                                        <p class="m-0">Title</p>
                                        <b>{{ $title }}</b>
                                    </div>

                                    <div class="col-lg-12 mb-2">
                                        <b>{!! $description !!}</b>
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

    @if(in_array($action, [ACTION_VIEW, ACTION_EDIT, NULL]))
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
            $wire.dispatch('update_description_value', {
                data: editor.getValue()
            });
        });

        const savedContent = `{!! addslashes($description) !!}`; // Laravel Blade escaping

        editor.setValue(savedContent);
    </script>
    @endscript
    @endif

</div>