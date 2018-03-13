<h3>you have registered successfully! Please click the button below to activate your account</h3>
<a href="{{ route('sendEmailDone', ["email" => $user->email, "verify_token" => $user->verify_token]) }}"
 class="btn btn-success btn-lg">Click Here</a>