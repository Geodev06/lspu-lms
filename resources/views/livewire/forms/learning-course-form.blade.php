<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Management /</span> Course </h4>


        @assets
        <link rel="stylesheet" type="text/css" href="{{ asset('simditor/styles/simditor.css') }}" />
        <script type="text/javascript" src="{{ asset('simditor/site/assets/scripts/module.js') }}"></script>
        <script type="text/javascript" src="{{ asset('simditor/site/assets/scripts/hotkeys.js') }}"></script>
        <script type="text/javascript" src="{{ asset('simditor/site/assets/scripts/simditor.js') }}"></script>
        @endassets

        <div class="row g-6 mb-3">
            <div class="col-lg-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('manage_learning_course') }}" class="btn rounded-pill float-end btn-secondary text-white">
                            <span class="tf-icons bx bx-left-arrow-circle"></span> Back
                        </a>
                    </div>

                    @if($action == ACTION_EDIT OR $action == null)
                    <div class="card-body">
                        <h2> Course Details</h2>
                        <form id="formAuthentication" class="mb-3 row" method="POST">


                            <div class="col-lg-6 mb-2">

                                <div class="mb-3">

                                    <div class="d-flex justify-content-between">
                                        <label for="email" class="form-label">Title</label>
                                        @error('title')
                                        <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <input type="text" wire:model="title" class="form-control" id="x" name="email-username" placeholder="Enter your Title." autofocus="">
                                </div>
                            </div>

                            <div class="col-lg-4 mb-2">

                                <div class="mb-3">

                                    <div class="d-flex justify-content-between">
                                        <label for="email" class="form-label">Course Code</label>
                                        @error('course_code')
                                        <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <input type="text" wire:model="course_code" class="form-control" id="x" name="email-username" placeholder="Enter your Course code." autofocus="">
                                </div>
                            </div>



                            <div class="col-lg-4 mb-2">

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

                                    <div class="col-lg-12 mb-2">
                                        <p class="m-0">Title</p>
                                        <b>{{ $title }}</b>
                                    </div>

                                    <div class="col-lg-4 mb-2">
                                        <p class="m-0">Course Code</p>
                                        <b>{{ $course_code }}</b>
                                    </div>

                                    <div class="col-lg-4 mb-2">
                                        <p class="m-0">Department</p>
                                        <b>{{ $org_code }}</b>
                                    </div>

                                    <div class="col-lg-4 mb-2">
                                        <p class="m-0">Status</p>
                                        <b>{{ $active_flag == 'Y' ? 'Active' : 'Inactive' }}</b>
                                    </div>

                                    <div class="col-lg-4 mb-2">
                                        <p class="m-0">Date Created</p>
                                        <b>{{ $record->created_at }}</b>
                                    </div>

                                    <div class="col-lg-12">
                                        <h6 class="">Details</h6>
                                        <div class="nav-align-top mb-4">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                                                        Overview
                                                    </button>
                                                </li>
                                                <li class="nav-item">
                                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">
                                                        Modules
                                                    </button>
                                                </li>
                                               
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                                                    {!! $description !!}
                                                </div>
                                                <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                                                    @forelse($modules as $module)

                                                    <b>{{ $module->title }}</b>

                                                    {!! $module->description !!}
                                                    <hr>

                                                    @empty
                                                    <p>No Modules Available.</p>
                                                    @endforelse
                                                </div>
                                             
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                    @elseif($action == ACTION_MANAGE)
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-12">
                                <h4><b>Manage Modules</b></h4>
                            </div>
                            <div class="col-lg-12 mx-auto mb-3">
                                <div class="row bg-dark p-3">

                                    <div class="col-lg-2 mb-2">
                                        <p class="m-0 text-muted">Course Code</p>
                                        <b class="text-white">{{ $course_code }}</b>
                                    </div>

                                    <div class="col-lg-2 mb-2">
                                        <p class="m-0 text-muted">Title</p>
                                        <b class="text-white">{{ $title }}</b>
                                    </div>

                                    <div class="col-lg-8 mb-2">
                                        <p class="m-0 text-muted">For Department</p>
                                        <b class="text-white">{{ get_org_name($org_code) }}</b>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <a href="{{ route('learning_module_form', [encrypt($id), null, null]) }}" class="btn rounded-pill float-end btn-success text-white">
                                    <span class="tf-icons bx bx-plus"></span> Add Module
                                </a>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <div class="col-lg-12 mb-2">
                                    @if(session('success'))
                                    <x-message-alert type="success" message="{{ session('success') }}" />
                                    @endif
                                </div>

                                <div class="col-lg-12 mb-2">
                                    <h3 class="mx-3">Modules</h3>
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-striped " id="learning_modules">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th width="30%" class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">

                                            </tbody>
                                        </table>

                                        <script>
                                            const route = "{{ route('datatable.learning_modules', encrypt($id)) }}"

                                            const columns = [{
                                                    data: 'title',
                                                    name: 'title',
                                                },
                                                {
                                                    data: 'actions',
                                                    name: 'actions',
                                                }
                                            ]

                                            init_datatable('#learning_modules', route, columns)
                                        </script>
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




    <!-- Footer -->
    <livewire:base.footer />
    <!-- / Footer -->

</div>