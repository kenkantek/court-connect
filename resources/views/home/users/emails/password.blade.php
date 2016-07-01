<div>
    You recently asked to reset your Court Connect password. One a new link:
    <a href="{{route('auth.resetpassword') . '/' . $token . '?email=' . urlencode($user->getEmailForPasswordReset()) }}" style="cursor: pointer">
        Click here to change your password
    </a>
</div>
