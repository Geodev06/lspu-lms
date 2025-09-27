 <div class="content-wrapper">
     <!-- Content -->

     <div class="container-xxl flex-grow-1 container-p-y">

         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Systen Administration /</span> Users </h4>

         <div class="row g-6 mb-3">
             <div class="col-lg-12 mb-3">
                 <div class="card">
                     <div class="card-header">
                         <a href="{{ route('users') }}" class="btn rounded-pill float-end btn-secondary text-white">
                             <span class="tf-icons bx bx-left-arrow-circle"></span> Back
                         </a>
                     </div>

                     @if($action == ACTION_EDIT OR $action == null)
                     <div class="card-body">
                         <h2>User Form</h2>
                         <form id="formAuthentication" class="mb-3 row" method="POST">

                             <div class="col-lg-12 mb-2">
                                 <img src="{{ asset($this->profile) }}" alt="" class="mb-2" srcset="" style="max-height: 150px; max-width: 150px;">
                             </div>
                             <div class="col-lg-4 mb-2">

                                 <div class="mb-3">

                                     <div class="d-flex justify-content-between">
                                         <label for="email" class="form-label">Profile</label>
                                         @error('profile')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                     </div>
                                     <input class="form-control" type="file" wire:model="profile" id="formFile">
                                 </div>
                             </div>

                             <div class="col-lg-4 mb-2">

                                 <div class="mb-3">

                                     <div class="d-flex justify-content-between">
                                         <label for="email" class="form-label">Student/Teacher ID</label>
                                         @error('control_no')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                     </div>
                                     <input type="text" wire:model="control_no" class="form-control" id="x" name="email-username" placeholder="Enter your Control No." autofocus="">
                                 </div>
                             </div>

                             <div class="col-lg-4 mb-2">
                             </div>


                             <div class="col-lg-3 mb-2">

                                 <div class="mb-3">
                                     <div class="d-flex justify-content-between">
                                         <label for="email" class="form-label">First Name</label>
                                         @error('first_name')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                     </div>
                                     <input type="text" wire:model="first_name" class="form-control" id="email" name="email-username" placeholder="Enter your First Name" autofocus="">
                                 </div>
                             </div>

                             <div class="col-lg-3 mb-2">

                                 <div class="mb-3">
                                     <div class="d-flex justify-content-between">
                                         <label for="email" class="form-label">Middle Name</label>
                                         @error('middle_name')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                     </div>
                                     <input type="text" wire:model="middle_name" class="form-control" id="email" name="email-username" placeholder="Enter your Middle Name" autofocus="">
                                 </div>

                             </div>


                             <div class="col-lg-3 mb-2">

                                 <div class="mb-3">
                                     <div class="d-flex justify-content-between">
                                         <label for="email" class="form-label">Last Name</label>
                                         @error('last_name')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                     </div>
                                     <input type="text" wire:model="last_name" class="form-control" id="email" name="email-username" placeholder="Enter your Last Name" autofocus="">
                                 </div>
                             </div>

                             <div class="col-lg-3 mb-2">

                                 <div class="mb-3">
                                     <div class="d-flex justify-content-between">
                                         <label for="email" class="form-label">Ext Name</label>
                                         @error('name_ext')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                     </div>
                                     <input type="text" wire:model="name_ext" class="form-control" id="email" name="email-username" placeholder="Enter your Name ext (optional)" autofocus="">
                                 </div>
                             </div>
                             <div class="col-lg-12 mb-2">
                                 <hr>

                                 <div class="mb-3">
                                     <div class="d-flex justify-content-between">
                                         <label for="email" class="form-label">Sex</label>
                                         @error('sex')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                     </div>
                                     <div class="d-flex align-items-center">
                                         <div class="form-check mx-5">
                                             <input wire:model="sex" name="default-radio-1" class="form-check-input" type="radio" value="M" id="defaultRadio1" checked>
                                             <label class="form-check-label" for="defaultRadio1"> Male </label>
                                         </div>
                                         <div class="form-check">
                                             <input wire:model="sex" name="default-radio-1" class="form-check-input" type="radio" value="F" id="defaultRadio1">
                                             <label class="form-check-label" for="defaultRadio2"> Female </label>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <hr>
                             <div class="col-lg-6 mb-2">

                                 <div class="mb-3">
                                     <div class="d-flex justify-content-between">
                                         <label for="email" class="form-label">Organization</label>
                                         @error('course')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                     </div>
                                     <select wire:model="course" id="defaultSelect" class="form-select" @change="$dispatch('on-filter-section', { org_code : $event.target.value})">
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
                                         <label for="email" class="form-label">Section</label>
                                         @error('section')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                     </div>
                                     <select wire:model="section" id="defaultSelect" class="form-select">
                                         <option value="">Select One</option>
                                         @forelse($sections as $item)
                                         <option value="{{ $item->id }}">{{$item->section_name}}</option>
                                         @empty
                                         @endforelse
                                     </select>
                                 </div>
                             </div>

                             <div class="col-lg-6 mb-2">

                                 <div class="mb-3">
                                     <div class="d-flex justify-content-between">
                                         <label for="email" class="form-label">Role</label>
                                         @error('role')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                     </div>
                                     <select wire:model="role" id="defaultSelect" class="form-select">
                                         <option value="">Select One</option>
                                         <option value="{{ ROLE_STUDENT }}">Student</option>
                                         <option value="{{ ROLE_TEACHER }}">Teacher</option>
                                         <option value="{{ ROLE_ADMIN }}">Administrator</option>

                                     </select>
                                 </div>
                             </div>


                             <div class="col-lg-6 mb-2">

                                 <div class="mb-3">
                                     <div class="d-flex justify-content-between">
                                         <label for="email" class="form-label">Status</label>
                                         @error('active_status')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                     </div>
                                     <select wire:model="active_status" id="defaultSelect" class="form-select">
                                         <option value="">Choose One</option>
                                         <option value="1">Active</option>
                                         <option value="0">Inactive</option>
                                     </select>
                                 </div>
                             </div>

                             <hr>

                             <div class="col-lg-6 mb-2">

                                 <div class="mb-3">
                                     <div class="d-flex justify-content-between">
                                         <label for="email" class="form-label">Email</label>
                                         @error('email')
                                         <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                         @enderror
                                     </div>
                                     <input type="email" wire:model="email" class="form-control" id="email" name="email-username" placeholder="Enter your email or username" autofocus="">
                                 </div>

                             </div>

                             <div class="col-lg-6 mb-2">

                                 <div class="mb-3 form-password-toggle">
                                     <div class="">

                                         <div class="d-flex justify-content-between">
                                             <label for="email" class="form-label">Password</label>
                                             @error('password')
                                             <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                             @enderror
                                         </div>

                                     </div>
                                     <div class="input-group input-group-merge">
                                         <input wire:model="password" type="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password">
                                         <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
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
                             <div class="col-lg-6 mx-auto">
                                 <div class="row">

                                     <div class="col-lg-12 text-center mb-3">
                                         @if($profile)
                                         <img src="{{ asset($profile) }}" alt="" srcset="" height="150" width="150">
                                         @else
                                         <img src="{{ asset('img/user.png') }}" alt="" srcset="" height="150" width="150">

                                         @endif
                                     </div>
                                     <hr>
                                     <div class="col-lg-3 mb-2">
                                         <p class="m-0">First Name</p>
                                         <b>{{ $first_name }}</b>
                                     </div>

                                     <div class="col-lg-3 mb-2">
                                         <p class="m-0">Middle Name</p>
                                         <b>{{ $middle_name }}</b>
                                     </div>

                                     <div class="col-lg-3 mb-2">
                                         <p class="m-0">Last Name</p>
                                         <b>{{ $last_name }}</b>
                                     </div>

                                     <div class="col-lg-3 mb-2">
                                         <p class="m-0">Ext Name</p>
                                         <b>{{ $name_ext ?? 'N/A' }}</b>
                                     </div>

                                     <hr>

                                     <div class="col-lg-12 mb-2">
                                         <p class="m-0">Sex</p>
                                         <b>{{ $sex == 'M' ? 'Male' : 'Female' }}</b>
                                     </div>

                                     <div class="col-lg-6 mb-2">
                                         <p class="m-0">Organization Code</p>
                                         <b>{{ get_org_name($course) }}</b>
                                     </div>

                                     <div class="col-lg-6 mb-2">
                                         <p class="m-0">Section</p>
                                         <b>{{ get_section_name($section) }}</b>
                                     </div>

                                     <div class="col-lg-6 mb-2">
                                         <p class="m-0">Role</p>
                                         <b>{{ get_role($role) }}</b>
                                     </div>
                                     <hr>

                                     <div class="col-lg-6 mb-2">
                                         <p class="m-0">Email</p>
                                         <b>{{ $email }}</b>
                                     </div>

                                     <div class="col-lg-6 mb-2">
                                         <p class="m-0">Student/Teacher ID</p>
                                         <b>{{ $control_no }}</b>
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