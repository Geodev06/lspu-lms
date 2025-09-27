  <div class="content-wrapper">
      <!-- Content -->

      <div class="container-xxl flex-grow-1 container-p-y">

          <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Systen Administration /</span> Organization </h4>

          <div class="row g-6 mb-3">
              <div class="col-lg-12 mb-3">
                  <div class="card">
                      <div class="card-header">
                          <a href="{{ route('sections') }}" class="btn rounded-pill float-end btn-secondary text-white">
                              <span class="tf-icons bx bx-left-arrow-circle"></span> Back
                          </a>
                      </div>

                      @if($action == ACTION_EDIT OR $action == null)
                      <div class="card-body">
                          <h2>Section Form</h2>
                          <form id="formAuthentication" class="mb-3 row" method="POST">


                              <div class="col-lg-4 mb-2">

                                  <div class="mb-3">
                                      <div class="d-flex justify-content-between">
                                          <label for="email" class="form-label">Organization</label>
                                          @error('course')
                                          <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                          @enderror
                                      </div>
                                      <select wire:model="course" id="defaultSelect" class="form-select">
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
                                          <label for="email" class="form-label">Name</label>
                                          @error('name')
                                          <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                          @enderror
                                      </div>
                                      <input type="text" wire:model="section_name" class="form-control" id="x" name="email-username" placeholder="Enter your Org name." autofocus="">
                                  </div>
                              </div>

                              <div class="col-lg-4 mb-2">

                                  <div class="mb-3">
                                      <div class="d-flex justify-content-between">
                                          <label for="email" class="form-label">School Year</label>
                                          @error('course')
                                          <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                          @enderror
                                      </div>
                                      <select wire:model="school_year" id="defaultSelect" class="form-select">
                                          <option value="">Select One</option>
                                          @forelse($school_years as $year)
                                          <option value="{{ $year }}">{{$year}}</option>
                                          @empty
                                          @endforelse
                                      </select>
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
                                          <p class="m-0">Org code</p>
                                          <b>{{ get_org_name($course) }}</b>
                                      </div>

                                      <div class="col-lg-12 mb-2">
                                          <p class="m-0">Organization Name</p>
                                          <b>{{ $section_name }}</b>
                                      </div>

                                      <div class="col-lg-12 mb-2">
                                          <p class="m-0">Department</p>
                                          <b>{{ $school_year }}</b>
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