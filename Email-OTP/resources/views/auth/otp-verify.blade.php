<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Document</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">OTP Verification</div>

                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <p>Your email is not verified. Please enter the OTP below:</p>
                            <form method="POST" action="{{ url('otp-verify', ['user' => $user]) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="otp">Enter OTP:</label>
                                    <input type="text" name="otp" id="otp" class="form-control">
                                </div>
                                <div id="countdown-timer" class="alert alert-info"></div>

                                <button type="submit" class="btn btn-primary">Verify OTP</button>

                                <!-- Add a button for resending OTP -->
                                @if (!$user->email_verified_at)
                                    <a href="{{ route('otp.resend', ['user' => $user]) }}" class="btn btn-secondary">Resend OTP</a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                var remainingTime = {{ $user->otp_expires_at->diffInSeconds(now()) }};
                var countdownTimer = $('#countdown-timer');
        
                function updateTimer() {
                    if (remainingTime > 0) {
                        var minutes = Math.floor(remainingTime / 60);
                        var seconds = remainingTime % 60;
                        countdownTimer.html('Time remaining: ' + minutes + 'm ' + seconds + 's');
                        remainingTime--;
                    } else {
                        countdownTimer.html('Time is up!');
                        clearInterval(timerInterval);
                    }
                }
        
                var timerInterval = setInterval(updateTimer, 1000);
                updateTimer(); // Call initially to avoid a 1-second delay in displaying the timer
            });
        </script>
                
    </body>
</html>