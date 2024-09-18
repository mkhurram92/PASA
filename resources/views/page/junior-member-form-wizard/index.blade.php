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
    </div>
</div>
@section('scripts')
    <script>
        var return_url = "{{ route('confirmPaymentIntent') }}"
    </script>
    <script src="{{ asset('js/form-wizard2.js') }}"></script>
@endsection
@include('layout.footer')
