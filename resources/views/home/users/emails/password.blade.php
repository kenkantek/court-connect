Click here to reset your password: <a href="{{ $link = route('auth.resetpassword') . '/' . $token . '?email=' . urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
