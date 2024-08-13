@extends('layouts.member-form')

@section('title', 'M3 Member')
@section('head')
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('submitFriendMembershipAccount') }}" id="membership_form"
                            onsubmit="return false;">
                            <div id="wizard2">
                                @include('page.friend-member-form-wizard.account')
                                @include('page.friend-member-form-wizard.payment')
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        window.addEventListener("DOMContentLoaded", function() {
            setTimeout(() => {
                $("#state").select2();
                $("#title").select2();
                $("#country").select2();
                $("#journal_preferred_delivery").select2();
            }, 1500);
        })
        var return_url = "{{ route('confirmPaymentIntent') }}"
    </script>
    <script src="{{ asset('js/form-wizard2.js') }}"></script>
@endsection
