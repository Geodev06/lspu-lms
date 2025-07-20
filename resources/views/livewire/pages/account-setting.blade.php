 <div class="content-wrapper">
     <!-- Content -->

     <div class="container-xxl flex-grow-1 container-p-y">

         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account /</span> Settings </h4>

         <div class="row g-6 mb-3 ">

             <div class="col-sm-6 col-xl-6 mb-3 h-100">
                 <div class="card">
                     <div class="card-body">
                         <h3>Change Basic Information</h3>
                         <form id="" class="mb-3" action="#" method="POST">

                             <div class="row">
                                 @if(session('success_profile'))
                                 <x-message-alert type="success" message="{{ session('success_profile') }}" />
                                 @endif

                                 @if(session('error_profile'))
                                 <x-message-alert type="danger" message="{{ session('error_profile') }}" />
                                 @endif

                                 <div>
                                     @error('first_name')
                                     <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                     @enderror
                                     <div class="mb-3">
                                         <label for="" class="form-label">First Name</label>
                                         <input type="text" wire:model="first_name" class="form-control" placeholder="Enter your first name" autocomplete="off">
                                     </div>
                                 </div>

                                 <div>
                                     @error('middle_name')
                                     <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                     @enderror
                                     <div class="mb-3">
                                         <label for="" class="form-label">Middle Name</label>
                                         <input type="text" wire:model="middle_name" class="form-control" placeholder="Enter your middle name" autocomplete="off">
                                     </div>
                                 </div>

                                 <div>
                                     @error('last_name')
                                     <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                     @enderror
                                     <div class="mb-3">
                                         <label for="" class="form-label">Last Name</label>
                                         <input type="text" wire:model="last_name" class="form-control" placeholder="Enter your last name" autocomplete="off">
                                     </div>
                                 </div>

                                 <div>
                                     @error('name_ext')
                                     <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                     @enderror
                                     <div class="mb-3">
                                         <label for="" class="form-label">Ext</label>
                                         <input type="text" wire:model="name_ext" class="form-control" placeholder="Enter your ext name" autocomplete="off">
                                     </div>
                                 </div>

                                 <div>
                                     @error('student_no')
                                     <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                     @enderror
                                     <div class="mb-3">
                                         <label for="" class="form-label">Ext</label>
                                         <input type="text" wire:model="student_no" class="form-control" placeholder="Enter your Student/Teacher No." autocomplete="off">
                                     </div>
                                 </div>

                                

                                 <div class="col-lg-4">
                                     <button
                                         class="btn btn-primary d-grid w-100"
                                         wire:click.prevent="change_basic"
                                         wire:loading.attr="disabled"
                                         wire:target="change_basic"
                                         type="submit">
                                         <span wire:loading.remove wire:target="change_basic">Save Changes</span>
                                         <span wire:loading wire:target="change_basic">
                                             <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                             Saving ...
                                         </span>
                                     </button>
                                 </div>
                             </div>
                         </form>

                     </div>
                 </div>
             </div>

             <div class="col-sm-6 col-xl-6 mb-3 ">
                 <div class="card h-100">
                     <div class="card-body">
                         <h3>Change Password</h3>
                         <form id="" class="mb-3" action="#" method="POST">

                             <div class="row">
                                 @if(session('success_password'))
                                 <x-message-alert type="success" message="{{ session('success_password') }}" />
                                 @endif

                                 @if(session('error_password'))
                                 <x-message-alert type="danger" message="{{ session('error_password') }}" />
                                 @endif

                                 <div>
                                     @error('old_password')
                                     <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                     @enderror
                                     <div class="mb-3">
                                         <label for="old_password" class="form-label">Old Password</label>
                                         <input type="password" wire:model="old_password" class="form-control" id="old_password" name="old_password" placeholder="Enter your old password" autocomplete="off">
                                     </div>
                                 </div>

                                 <hr>
                                 <div>
                                     @error('password')
                                     <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                     @enderror
                                     <div class="mb-3">
                                         <label for="password" class="form-label">New Password</label>
                                         <input type="password" wire:model="password" class="form-control" id="password" name="password" placeholder="Enter your new password" autocomplete="off">
                                     </div>
                                 </div>

                                 <div>
                                     @error('password_confirmation')
                                     <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                     @enderror
                                     <div class="mb-3">
                                         <label for="password_confirmation" class="form-label">Confirm Password</label>
                                         <input type="password" wire:model="password_confirmation" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" autocomplete="off">
                                     </div>
                                 </div>

                                 <div class="col-lg-4">
                                     <button
                                         class="btn btn-primary d-grid w-100"
                                         wire:click.prevent="change_password"
                                         wire:loading.attr="disabled"
                                         wire:target="change_password"
                                         type="submit">
                                         <span wire:loading.remove wire:target="change_password">Save Changes</span>
                                         <span wire:loading wire:target="change_password">
                                             <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                             Saving ...
                                         </span>
                                     </button>
                                 </div>
                             </div>
                         </form>

                     </div>
                 </div>
             </div>
         </div>



     </div>
     <!-- / Content -->

     <!-- Footer -->
     <livewire:base.footer />
     <!-- / Footer -->

 </div>