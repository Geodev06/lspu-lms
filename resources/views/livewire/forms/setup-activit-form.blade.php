<div class="content-wrapper">
    <!-- Content -->
    @assets
    <link rel="stylesheet" type="text/css" href="{{ asset('simditor/styles/simditor.css') }}" />
    <script type="text/javascript" src="{{ asset('simditor/site/assets/scripts/module.js') }}"></script>
    <script type="text/javascript" src="{{ asset('simditor/site/assets/scripts/hotkeys.js') }}"></script>
    <script type="text/javascript" src="{{ asset('simditor/site/assets/scripts/simditor.js') }}"></script>
    @endassets

    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Management /</span> Activity </h4>

        <div class="row g-6 mb-3">
            <div class="col-lg-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('manage_activity') }}" class="btn rounded-pill float-end btn-secondary text-white">
                            <span class="tf-icons bx bx-left-arrow-circle"></span> Back
                        </a>
                    </div>

                    @if($action == ACTION_EDIT OR $action == null)
                    <div class="card-body">
                        <h2>Setup Activity Form</h2>
                        <form id="formAuthentication" class="mb-3 row" method="POST">



                            <div class="col-lg-4 mb-2">

                                <div class="mb-3">

                                    <div class="d-flex justify-content-between">
                                        <label for="email" class="form-label">Title</label>
                                        @error('title')
                                        <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <input type="text" wire:model="title" class="form-control" id="x" name="title" placeholder="Enter your Title." autofocus="">
                                </div>
                            </div>




                            <div class="col-lg-8 mb-2">

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label for="email" class="form-label">Organization</label>
                                        @error('org_code')
                                        <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <select wire:model="org_code" id="defaultSelect" class="form-select">
                                        <option value="">Select One</option>
                                        @forelse($courses as $course)
                                        <option value="{{ $course->org_code }}">{{$course->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-2">

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label for="email" class="form-label">Course</label>
                                        @error('course')
                                        <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <select wire:model="course" id="defaultSelect" class="form-select" @change="$dispatch('on-filter-module', { learning_course_id : $event.target.value})">
                                        <option value="">Choose One</option>
                                        @forelse($learning_courses as $item)
                                        <option value="{{ $item->id }}">{{$item->title}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-2">

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label for="email" class="form-label">Module</label>
                                        @error('module')
                                        <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <select wire:model="module" id="defaultSelect" class="form-select">
                                        <option value="">Choose One</option>
                                        @forelse($learning_modules as $item)
                                        <option value="{{ $item->id }}">{{$item->title}}</option>
                                        @empty
                                        @endforelse
                                    </select>
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





                            <div class="col-lg-4 mb-2">

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label for="email" class="form-label">Type</label>
                                        @error('type')
                                        <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <select wire:model="type" id="defaultSelect" class="form-select">
                                        <option value="">Choose One</option>
                                        <option value="MC">Multiple Choice</option>
                                        <option value="I">Identification</option>
                                        <option value="E">Essay</option>
                                        <option value="HO">Hands On</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 mb-2">

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label for="email" class="form-label">Status</label>
                                        @error('active_flag')
                                        <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <select wire:model="active_flag" id="defaultSelect" class="form-select">
                                        <option value="">Choose One</option>
                                        <option value="Y">Active</option>
                                        <option value="N">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-2">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.live="include_ide" {{ $include_ide == 1 ? 'checked' : '' }} type="checkbox" id="remember-me">
                                        <label class="form-check-label" for="remember-me"> Include IDE ?</label>
                                    </div>
                                </div>
                            </div>

                            @if($include_ide == 1)
                            <div class="col-lg-4 mb-2">

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label for="email" class="form-label">IDE</label>
                                        @error('ide_id')
                                        <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <select wire:model="ide_id" id="defaultSelect" class="form-select">
                                        <option value="">Choose One</option>
                                        @forelse($param_ides as $item)
                                        <option value="{{ $item->id }}">{{$item->ide_name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            @endif


                            <div class="col-lg-12 mb-2">
                                <div class="mb-3 float-end">
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
                        </form>
                    </div>
                    @elseif($action == ACTION_VIEW)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                                <div class="row">


                                    <div class="col-lg-4 mb-2">
                                        <p class="m-0">Title</p>
                                        <b>{{ $record->title }}</b>
                                    </div>

                                   

                                    <div class="col-lg-8 mb-2">
                                        <p class="m-0">Department</p>
                                        <b>{{ get_org_name($org_code)}}</b>
                                    </div>

                                    <div class="col-lg-4 mb-2">
                                        <p class="m-0">Course</p>
                                        <b>{{ get_course_name($course)}}</b>
                                    </div>

                                    <div class="col-lg-4 mb-2">
                                        <p class="m-0">Module</p>
                                        <b>{{ get_module_name($module)}}</b>
                                    </div>

                                     <div class="col-lg-12 mb-2">
                                        <p class="m-0">Description</p>
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