<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Survey</h4>

        <div class="row no-gutters h-100">

            <div class="col-lg-12 p-0">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-primary">Pre-Assesment</h3>
                        <p class="card-description">
                            Research Questionnaire: Learning Styles of 1st year and 2nd year Information Technology Students in Laguna State Polytechnic University San Pablo City Campus
                        </p>
                        <p>
                            The goal of this questionnaire is to know the preferred learning style method of Information Technology Student in Laguna State Polytechnic University San Pablo City Campus. All responses will be kept confidential and only used for research purposes. Your individual responses will not be shared with anyone outside of the research team. We will not reveal your identity or any other personal information in any reports or publications based on this research.
                        </p>
                        <p>
                            Please indicate your level of agreement for each statement.
                        </p>
                        <ul>
                            <li>1 - Strongly Disagree</li>
                            <li>2 - Disagree</li>
                            <li>3 - Agree</li>
                            <li>4 - Strongly Agree</li>

                        </ul>
                        <p>
                            Scoring and Interpretation:
                            item Learners (V): High scores in the item section. Prefer diagrams, flowcharts, and other item aids.
                            Auditory Learners (A): High scores in the Auditory section. Prefer verbal explanations, podcasts, and discussions.
                            Reading/Writing Learners (R): High scores in the Reading/Writing section. Prefer reading textbooks, writing notes, and creating written summaries.
                            Kinesthetic Learners (K): High scores in the Kinesthetic section. Prefer hands-on activities like coding, building, and other practical tasks.
                        </p>

                        @if(session('error'))
                        <x-message-alert title="Error" message="{{ session('error') }}" type="danger" />
                        @endif




                        <form class="forms-sample material-form">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="80%">(item) Question</th>
                                        <th width="5%" class="text-center">1</th>
                                        <th width="5%" class="text-center">2</th>
                                        <th width="5%" class="text-center">3</th>
                                        <th width="5%" class="text-center">4</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse($question_v as $item)
                                    <tr>
                                        <td>{{$item->id}}. {{ $item->question }} <br> @error('question_'.$item->id) <div class="text-danger">{{ $message }}</div> @enderror</td>
                                        <td>
                                            <div class="form-check mx-5">
                                                <input wire:model="question_{{$item->id}}" name="question_{{$item->id}}" class="form-check-input" type="radio" value="1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check mx-5">
                                                <input wire:model="question_{{$item->id}}" name="question_{{$item->id}}" class="form-check-input" type="radio" value="2">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check mx-5">
                                                <input wire:model="question_{{$item->id}}" name="question_{{$item->id}}" class="form-check-input" type="radio" value="3">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check mx-5">
                                                <input wire:model="question_{{$item->id}}" name="question_{{$item->id}}" class="form-check-input" type="radio" value="4">
                                            </div>
                                        </td>
                                    </tr>
                                    @empty

                                    @endforelse

                                </tbody>
                            </table>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="80%">(Auditory) Question</th>
                                        <th width="5%" class="text-center">1</th>
                                        <th width="5%" class="text-center">2</th>
                                        <th width="5%" class="text-center">3</th>
                                        <th width="5%" class="text-center">4</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse($question_a as $item)
                                    <tr>
                                        <td>{{$item->id}}. {{ $item->question }} <br> @error('question_'.$item->id) <div class="text-danger">{{ $message }}</div> @enderror</td>
                                        <td>
                                            <div class="form-check mx-5">
                                                <input wire:model="question_{{$item->id}}" name="question_{{$item->id}}" class="form-check-input" type="radio" value="1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check mx-5">
                                                <input wire:model="question_{{$item->id}}" name="question_{{$item->id}}" class="form-check-input" type="radio" value="2">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check mx-5">
                                                <input wire:model="question_{{$item->id}}" name="question_{{$item->id}}" class="form-check-input" type="radio" value="3">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check mx-5">
                                                <input wire:model="question_{{$item->id}}" name="question_{{$item->id}}" class="form-check-input" type="radio" value="4">
                                            </div>
                                        </td>
                                    </tr>
                                    @empty

                                    @endforelse

                                </tbody>
                            </table>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="80%">(Reading and Writing) Question</th>
                                        <th width="5%" class="text-center">1</th>
                                        <th width="5%" class="text-center">2</th>
                                        <th width="5%" class="text-center">3</th>
                                        <th width="5%" class="text-center">4</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse($question_r as $item)
                                    <tr>
                                        <td>{{$item->id}}. {{ $item->question }} <br> @error('question_'.$item->id) <div class="text-danger">{{ $message }}</div> @enderror</td>
                                        <td>
                                            <div class="form-check mx-5">
                                                <input wire:model="question_{{$item->id}}" name="question_{{$item->id}}" class="form-check-input" type="radio" value="1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check mx-5">
                                                <input wire:model="question_{{$item->id}}" name="question_{{$item->id}}" class="form-check-input" type="radio" value="2">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check mx-5">
                                                <input wire:model="question_{{$item->id}}" name="question_{{$item->id}}" class="form-check-input" type="radio" value="3">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check mx-5">
                                                <input wire:model="question_{{$item->id}}" name="question_{{$item->id}}" class="form-check-input" type="radio" value="4">
                                            </div>
                                        </td>
                                    </tr>
                                    @empty

                                    @endforelse

                                </tbody>
                            </table>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="80%">(Kinesthetics) Question</th>
                                        <th width="5%" class="text-center">1</th>
                                        <th width="5%" class="text-center">2</th>
                                        <th width="5%" class="text-center">3</th>
                                        <th width="5%" class="text-center">4</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse($question_k as $item)
                                    <tr>
                                        <td>{{$item->id}}. {{ $item->question }} <br> @error('question_'.$item->id) <div class="text-danger">{{ $message }}</div> @enderror</td>
                                        <td>
                                            <div class="form-check mx-5">
                                                <input wire:model="question_{{$item->id}}" name="question_{{$item->id}}" class="form-check-input" type="radio" value="1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check mx-5">
                                                <input wire:model="question_{{$item->id}}" name="question_{{$item->id}}" class="form-check-input" type="radio" value="2">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check mx-5">
                                                <input wire:model="question_{{$item->id}}" name="question_{{$item->id}}" class="form-check-input" type="radio" value="3">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check mx-5">
                                                <input wire:model="question_{{$item->id}}" name="question_{{$item->id}}" class="form-check-input" type="radio" value="4">
                                            </div>
                                        </td>
                                    </tr>
                                    @empty

                                    @endforelse

                                </tbody>
                            </table>




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