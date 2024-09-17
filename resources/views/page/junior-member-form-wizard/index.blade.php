@include('layout.header')
@include('layout.sidebar')

@section('title', 'M7 Member')
<script src="https://js.stripe.com/v3/"></script>

<div class="app-content main-content">
    <div class="side-app">
        <div class="container main-container mt-5">
            <div class="row ">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('submitJuniorMembershipAccount') }}" id="membership_form"
                                onsubmit="return false;">
                                <input type="hidden" id="stripe_key" value="{{ env('STRIPE_KEY') }}">
                                <div id="wizard2">
                                    @include('page.junior-member-form-wizard.account')
                                    @include('page.junior-member-form-wizard.payment')
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="clone" style="display: none">
            <div class="col-md-4 my-2">
                <label class="form-control-label">Sibling {count} Name: <span class="tx-danger">*</span></label>
                <input class="form-control" id="sibling_{count}_name" name="sibling[name][]" value=""
                    placeholder="Enter sibling name" required="" type="text">
            </div>
            <div class="col-md-4 my-2">
                <label class="form-control-label">Gender: <span class="tx-danger">*</span></label>
                <select name="sibling[gender][]" class="form-control form-select select2" id="gender{count}">
                    @forelse ($genders as $gender)
                        <option value="{{ $gender->id }}">{{ Str::ucfirst($gender->name) }}</option>
                    @empty
                        <option value="">Select option</option>
                    @endforelse
                </select>
            </div>
            <div class="col-md-4 my-2">
                <label class="form-control-label">Birth Date:</label>
                <input class="form-control" id="date_of_birth" name="sibling[date_of_birth][]"
                    value="{{ old('date_of_birth') }}" placeholder="Enter Date of Birth" required="" type="date">
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script>
        var return_url = "{{ route('confirmPaymentIntent') }}"
    </script>
    <script src="{{ asset('js/form-wizard2.js') }}"></script>
@endsection
@include('layout.footer')
