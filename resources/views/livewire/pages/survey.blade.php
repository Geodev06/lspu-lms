<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Survey</h4>

        <div class="row no-gutters h-100">

            <div class="col-lg-12 p-0">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-primary">Pre-Assesment</h3>
                        <p class="card-description">Please take a moment to complete this survey. Your feedback is valuable to us and will help improve the system. All responses will remain confidential. </p>

                        @if(session('error'))
                        <x-message-alert title="Error" message="{{ session('error') }}" type="danger" />
                        @endif

                        <form class="forms-sample material-form">


                            @forelse($questions as $question)
                            <hr>
                            <h5><b>{{ $question->id }}. {{ ucfirst($question->question) }}</b></h5>
                            <div class="row">

                                <div class="col-lg-3 col-md-3 form-check mx-2">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" wire:model="question_{{ $question->id }}_{{ $question->question_c1_val }}" class="form-check-input">{{ $question->question_c1_label }} <i class="input-helper"></i></label>
                                </div>

                                <div class="col-lg-3 col-md-3 form-check mx-2">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" wire:model="question_{{ $question->id }}_{{ $question->question_c2_val }}" class="form-check-input">{{ $question->question_c2_label }} <i class="input-helper"></i></label>
                                </div>

                                <div class="col-lg-3 col-md-3 form-check mx-2">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" wire:model="question_{{ $question->id }}_{{ $question->question_c3_val }}" class="form-check-input"> {{ $question->question_c3_label }} <i class="input-helper"></i></label>
                                </div>

                                <div class="col-lg-3 col-md-3 form-check mx-2">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" wire:model="question_{{ $question->id }}_{{ $question->question_c4_val }}" class="form-check-input"> {{ $question->question_c4_label }} <i class="input-helper"></i></label>
                                </div>
                            </div>
                            @empty

                            @endforelse


                            <div class="button-container">
                                @if(Auth::user()->first_login == 1)
                                <button type="button"
                                    class="btn btn-rounded btn-primary  mt-3"
                                    wire:click="submit"
                                    wire:loading.attr="disabled">
                                    <span wire:loading.remove>Submit</span>
                                    <span wire:loading>
                                        <i class="fa fa-spinner fa-spin"></i> Loading...
                                    </span>
                                </button>
                                @else
                                <a type="button"
                                    href="{{ route('dashboard') }}"
                                    class="btn btn-rounded btn-dark mt-3"
                                    wire:loading.attr="disabled">
                                    <span wire:loading.remove>Survey is expired. Go to dashboard</span>
                                    <span wire:loading>
                                        <i class="fa fa-spinner fa-spin"></i> Loading...
                                    </span>
                                </a>
                                @endif
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