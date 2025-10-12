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
                                <label class="form-check-label" for="remember-me"> Modality Applied</label>

                                <div class="mb-3 d-flex">
                                    <div class="form-check mx-2">
                                        <input class="form-check-input" wire:model="v_flag" {{ $v_flag == 1 ? 'checked' : '' }} type="checkbox" id="v_flag-me">
                                        <label class="form-check-label" for="v_flag-me">Visual</label>
                                    </div>

                                    <div class="form-check mx-2">
                                        <input class="form-check-input" wire:model="a_flag" {{ $a_flag == 1 ? 'checked' : '' }} type="checkbox" id="a_flag-me">
                                        <label class="form-check-label" for="a_flag-me">Auditory</label>
                                    </div>

                                    <div class="form-check mx-2">
                                        <input class="form-check-input" wire:model="r_flag" {{ $r_flag == 1 ? 'checked' : '' }} type="checkbox" id="r_flag-me">
                                        <label class="form-check-label" for="r_flag-me">Reading and Writing</label>
                                    </div>

                                    <div class="form-check mx-2">
                                        <input class="form-check-input" wire:model="k_flag" {{ $k_flag == 1 ? 'checked' : '' }} type="checkbox" id="k_flag-me">
                                        <label class="form-check-label" for="k_flag-me">Kinesthetics</label>
                                    </div>
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

                        <div class="row">
                            <div class="card-header">
                                Submissions
                            </div>

                            <div class="col-lg-12">
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Student Name</th>
                                                <th>Student Section</th>
                                                <th>Score</th>
                                                <th>Date</th>
                                                <th>Action</th>

                                            </tr>
                                            <tr>
                                                <td> <input type="text" wire:model.live.debounce.500ms="search" class="form-control" placeholder="Search by name"></td>
                                                <td> <input type="text" wire:model.live.debounce.500ms="section" class="form-control" placeholder="Search by Section"></td>
                                                <td><input type="text" wire:model.live.debounce.500ms="score" class="form-control" placeholder="Search by Score"></td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @forelse($submissions as $item)
                                            <tr>

                                                <td>
                                                    {{ get_user_fullname($item->created_by)}}
                                                </td>
                                                <td>
                                                    {{ $item->section_name }}
                                                </td>
                                                <td>
                                                    {{ $item->grade }} %
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($item->created_at) }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('user_activity_response', ['submission_id'=> encrypt($item->id), 'action' => encrypt(ACTION_EDIT)]) }}">View</a>
                                                </td>


                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="4">No Data</td>
                                            </tr>

                                            @endforelse

                                        </tbody>
                                    </table>

                                    {{ $submissions->links() }}
                                </div>
                            </div>
                        </div>
                    </div>

                    @elseif($action == ACTION_MANAGE)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mx-auto  ">
                                <div class="row bg-dark p-4">
                                    <div class="col-lg-4 mb-2">
                                        <p class="m-0">Title</p>
                                        <b class="text-white">{{ $record->title }}</b>
                                    </div>

                                    <div class="col-lg-8 mb-2">
                                        <p class="m-0">Department</p>
                                        <b class="text-white">{{ get_org_name($org_code)}}</b>
                                    </div>

                                    <div class="col-lg-4 mb-2">
                                        <p class="m-0">Course</p>
                                        <b class="text-white">{{ get_course_name($course)}}</b>
                                    </div>

                                    <div class="col-lg-4 mb-2">
                                        <p class="m-0">Module</p>
                                        <b class="text-white">{{ get_module_name($module)}}</b>
                                    </div>

                                    <div class="col-lg-4 mb-2">
                                        <p class="m-0">Total Points</p>
                                        <b class="text-white">{{ get_total_activity_points($id)}}</b>
                                    </div>

                                </div>


                                <div class="row g-6 mb-3 mt-3">
                                    <div class="col-lg-12 mb-3">
                                        <div class="card-header">
                                            <a href="{{ route('activity_question_form', encrypt($id)) }}" class="btn rounded-pill float-end btn-primary text-white">
                                                <span class="tf-icons bx bx-plus"></span> Add Question
                                            </a>

                                        </div>


                                        <div class="col-lg-12 mb-2">
                                            <h3 class="mx-3">Questions Table</h3>
                                            <div class="col-lg-12 mb-2">
                                                @if(session('success'))
                                                <x-message-alert type="success" message="{{ session('success') }}" />
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="table-responsive text-nowrap">
                                                <table class="table table-striped " id="setup_questions">
                                                    <thead>
                                                        <tr>
                                                            <th>Question</th>
                                                            <th width="10%">Answer</th>
                                                            <th width="10%">Points</th>
                                                            <th width="15%">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0">

                                                    </tbody>
                                                </table>

                                                <script>
                                                    const route = "{{ route('datatable.setup_questions', encrypt($id)) }}"

                                                    const columns = [{
                                                            data: 'question',
                                                            name: 'question',
                                                        },
                                                        {
                                                            data: 'answer',
                                                            name: 'answer',
                                                        },
                                                        {
                                                            data: 'points',
                                                            name: 'points',
                                                        },
                                                        {
                                                            data: 'actions',
                                                            name: 'actions',
                                                        }
                                                    ]

                                                    init_datatable('#setup_questions', route, columns)
                                                </script>
                                            </div>
                                        </div>
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


    @if(in_array($action, [ACTION_EDIT, NULL]))
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