<html>
<body>
<?php $link = url("/password/reset") . '/' . $token . '?email=' . urlencode($user->getEmailForPasswordReset()) ?>
<div>
    You recently asked to reset your Court Connect password. One a new link:
    <a href="{{$link}}" style="cursor: pointer">
        Click here to change your password
    </a>

</div>
</body>
</html>