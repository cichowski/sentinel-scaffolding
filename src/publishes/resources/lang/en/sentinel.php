<?php

return [
            
    'pages' => [
        'login' => 'Log in',
        'register' => 'Sign in',
        'password-retrieve' => 'Forgot Your password?',
        'password-set' => 'Set a new password',
    ],
    
    'emails' => [
        'activate' => 'Activate Your Account',
        'retrieve' => 'Set a new password for Your Account',
    ],    
    
    'fields' => [
        'role' => 'role',
        'username' => 'username',
        'email' => 'e-mail address',
        'password' => 'password',
        'password_confirmation' => 'confirm password',
        'remember' => 'remember me',
    ],
    
    'buttons' => [
        'retrieve' => 'send password retrieve link',
        'password-set' => 'set password',
        'toggel-navigation' => 'toggle navigation',
    ],
    
    'errors' => [
        'credentials' => 'Invalid login or password.',
        'activation' => 'Account is not activated.',
        'throttle' => 'Your account is blocked for :delay second(s).',
        'send' => 'Failed to send You an e-mail.',
        'register' => 'Failed to register.',
        'link' => 'This address is incorrect or expired.',
        'password-set' => 'Failed to set new password.',
    ],
    
    'messages' => [
        'account-created' => 'Your accout was successfully created. Please waint for activation e-mail.',
        'activated' => 'Your accout has been activated. You might login now.',
        'password-set' => 'New password has been set',
        'retrieve' => 'Please check Your email. We sent You further instructions.',
        'success' => 'Your changes have been saved.',
    ],    
];