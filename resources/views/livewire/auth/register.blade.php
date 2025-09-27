<div class="container-xxl">
    <div class="row" style="height: 100vh;">
        <div class="col-lg-4 mx-auto my-auto p-5 col-sm-9 col-md-6">
            <!-- Logo -->
            <!-- /Logo -->
            <h4 class="mb-2">Register to LMS!</h4>
            <p class="mb-4">Please sign-up to create your account.</p>

            <form id="formAuthentication" class="mb-3" method="POST">

                @error('first_name')
                <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                @enderror
                <div class="mb-3">
                    <label for="email" class="form-label">First Name</label>
                    <input type="text" wire:model="first_name" class="form-control" id="email" name="email-username" placeholder="Enter your First Name" autofocus="">
                </div>
                @error('middle_name')
                <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                @enderror
                <div class="mb-3">
                    <label for="email" class="form-label">Middle Name</label>
                    <input type="text" wire:model="middle_name" class="form-control" id="email" name="email-username" placeholder="Enter your Middle Name" autofocus="">
                </div>
                @error('last_name')
                <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                @enderror
                <div class="mb-3">
                    <label for="email" class="form-label">Last Name</label>
                    <input type="text" wire:model="last_name" class="form-control" id="email" name="email-username" placeholder="Enter your Last Name" autofocus="">
                </div>
                @error('name_ext')
                <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                @enderror
                <div class="mb-3">
                    <label for="email" class="form-label">Name ext.</label>
                    <input type="text" wire:model="name_ext" class="form-control" id="email" name="email-username" placeholder="Enter your Name ext (optional)" autofocus="">
                </div>
                <hr>
                @error('sex')
                <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                @enderror
                <div class="mb-3">
                    <small class="text-light fw-semibold">Gender</small>
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
                <hr>
                @error('course')
                <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                @enderror
                <div class="mb-3">
                    <label for="defaultSelect" class="form-label">Organization</label>
                    <select wire:model="course" id="defaultSelect" class="form-select" @change="$dispatch('on-filter-section', { org_code : $event.target.value})">
                        <option value="">Select One</option>
                        @forelse($courses as $course)
                        <option value="{{ $course->org_code }}">{{$course->name}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                @error('section')
                <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                @enderror
                <div class="mb-3">
                    <label for="defaultSelect" class="form-label">Section</label>
                    <select wire:model="section" id="defaultSelect" class="form-select">
                        <option value="">Select One</option>
                        @forelse($sections as $item)
                        <option value="{{ $item->id }}">{{$item->section_name}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <hr>

                @error('control_no')
                <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                @enderror
                <div class="mb-3">
                    <label for="email" class="form-label">Student No.</label>
                    <input type="email" wire:model="control_no" class="form-control" id="email" name="email-username" placeholder="Enter your Student No." autofocus="">
                </div>

                @error('email')
                <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                @enderror
                <div class="mb-3">
                    <label for="email" class="form-label">Institutional Email</label>
                    <input type="email" wire:model="email" class="form-control" id="email" name="email-username" placeholder="Enter your email" autofocus="">
                </div>

                @error('password')
                <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                @enderror
                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">Password</label>
                        <a href="auth-forgot-password-basic.html">
                        </a>
                    </div>
                    <div class="input-group input-group-merge">
                        <input wire:model="password" type="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password">
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                </div>

                <input type="hidden" wire:model.live="recaptchaToken" id="recaptcha_token" />
                <div class="mb-3">

                    <button
                        class="btn btn-primary d-grid w-100"
                        wire:click.prevent="register"
                        wire:loading.attr="disabled"
                        wire:target="register"
                        type="submit">
                        <span wire:loading.remove wire:target="register">Register</span>
                        <span wire:loading wire:target="register">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Submitting form ...
                        </span>
                    </button>
                </div>
             

            </form>

            <p class="text-center">
                <span>I have an account</span>
                <a href="{{ route('login') }}">
                    <span>Sign in</span>
                </a>
            </p>
        </div>
    </div>
</div>