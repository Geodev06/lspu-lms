<div class="container-xxl">
    <div class="row" style="height: 100vh;">
        <div class="col-lg-4 mx-auto my-auto p-5 col-sm-9 col-md-6">
            <!-- Logo -->
            <div class="app-brand justify-content-center mb-5">
                <a href="/" class="app-brand-link gap-2">
                    <img src="{{ asset('img/cert_lspu.png') }}" alt="" sizes="" srcset="" height="100">
                </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Welcome to LMS!</h4>
            <p class="mb-4">Please sign-in to your account and start learning.</p>

            @if(session('success'))
            <x-message-alert type="success" message="{{ session('success') }}" />
            @endif

            @if(session('error'))
            <x-message-alert type="danger" message="{{ session('error') }}" />
            @endif

            <form id="formAuthentication" class="mb-3" action="index.html" method="POST">

                @error('email')
                <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                @enderror
                <div class="mb-3">
                    <label for="email" class="form-label">Institutional Email</label>
                    <input type="text" wire:model="email" class="form-control" id="email" name="email-username" placeholder="Enter your email or username" autofocus="">
                </div>
                @error('password')
                <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                @enderror
                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">Password</label>
                        <a href="{{ route('forgot_password') }}">
                            <small>Forgot Password?</small>
                        </a>
                    </div>
                    <div class="input-group input-group-merge">
                        <input type="password" wire:model="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password">
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" wire:model="remember" type="checkbox" id="remember-me">
                        <label class="form-check-label" for="remember-me"> Remember Me </label>
                    </div>
                </div>

                <div class="mb-3">
                    <button
                        class="btn btn-primary d-grid w-100"
                        wire:click.prevent="submit"
                        wire:loading.attr="disabled"
                        wire:target="submit"
                        type="submit">
                        <span wire:loading.remove wire:target="submit">Sign In</span>
                        <span wire:loading wire:target="submit">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Signing In ...
                        </span>
                    </button>
                </div>
            </form>

            <p class="text-center">
                <span>New on our platform?</span>
                <a href="{{ route('register') }}">
                    <span>Create an account</span>
                </a>
            </p>
        </div>
    </div>
</div>