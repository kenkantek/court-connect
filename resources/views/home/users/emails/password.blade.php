<div>
    You recently asked to reset your Court Connect password.
    <a href="{{route('auth.resetpassword') . '/' . $token . '?email=' . urlencode($user->getEmailForPasswordReset()) }}" style="cursor: pointer">
        Click here to change your password
    </a>
</div>
