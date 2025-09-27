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
            <h4 class="mb-2">Forgot Password</h4>
            <p class="mb-4">Please enter your email to reset your password</p>

            @if($status)
            <x-message-alert type="info" message="{{ $status }}" />
            @endif


            <form id="formAuthentication" class="mb-3" action="index.html" method="POST">


                @error('email')
                <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                @enderror
                <div class="mb-3 form-password-toggle">

                    <div class="input-group input-group-merge">
                        <input type="email" wire:model="email" id="email" class="form-control" name="email" placeholder="your-email@domain.com" aria-describedby="email">
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                </div>

                <div class="mb-3">
                    <button
                        class="btn btn-primary d-grid w-100"
                        wire:click.prevent="submit"
                        wire:loading.attr="disabled"
                        wire:target="submit"
                        type="submit">
                        <span wire:loading.remove wire:target="submit">Forgot Password</span>
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
                <span>|</span>
                <a href="{{ route('login') }}">
                    <span>Sign In</span>
                </a>
            </p>
        </div>
    </div>
</div>