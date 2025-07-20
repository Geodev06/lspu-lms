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
            <h4 class="mb-2">Reset Password</h4>
            <p class="mb-4">Please enter your new password.</p>

            @if(session('status'))
            <x-message-alert type="success" message="{{ session('success') }}" />
            @endif

            <form id="formAuthentication" class="mb-3" action="#" method="POST">

                <x-message-alert type="dark" message="Enter new password for {{ $email }}" />


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
                    <button
                        class="btn btn-primary d-grid w-100"
                        wire:click.prevent="submit"
                        wire:loading.attr="disabled"
                        wire:target="submit"
                        type="submit">
                        <span wire:loading.remove wire:target="submit">Change Password</span>
                        <span wire:loading wire:target="submit">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Saving ...
                        </span>
                    </button>
                </div>
            </form>


        </div>
    </div>
</div>