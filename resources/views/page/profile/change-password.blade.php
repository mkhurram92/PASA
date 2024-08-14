@include('layout.header')
@include('layout.sidebar')
<style>
    body {
        padding-top: 70px;
    }
</style>
<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">

            <!-- Display message -->
            <div id="message-container"></div>

            <div class="card">
                <div class="card-header">
                    <h4>Change Password</h4>
                </div>
                <div class="card-body">
                    <form id="change-password-form" method="POST">
                        @csrf

                        <!-- Current Password -->
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input id="current_password" type="password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                name="current_password" required>
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" required>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">
                                Change Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@include('layout.footer')

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#change-password-form').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{ route('password.update') }}",
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status) {
                        $('#message-container').html('<div class="alert alert-success">' +
                            response.message + '</div>');
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = '<div class="alert alert-danger">';
                    $.each(errors, function(key, value) {
                        errorMessages += '<p>' + value[0] +
                        '</p>'; // Assuming each key has an array of messages
                    });
                    errorMessages += '</div>';
                    $('#message-container').html(errorMessages);
                }
            });
        });
    });
</script>
