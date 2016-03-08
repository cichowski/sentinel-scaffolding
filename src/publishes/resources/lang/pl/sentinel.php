<?php

return [
            
    'pages' => [
        'login' => 'Logowanie',
        'register' => 'Rejestracja',
        'password-retrieve' => 'Zapomniałem hasła',
        'password-set' => 'Ustaw nowe hasło',
    ],
    
    'emails' => [
        'activate' => 'Aktywuj swoje konto',
        'retrieve' => 'Ustaw nowe hasło',
    ],    
    
    'fields' => [
        'role' => 'rola',
        'username' => 'nazwa użytkownika',
        'email' => 'adres e-mail',
        'password' => 'hasło',
        'password_confirmation' => 'powtórz hasło',
        'remember' => 'zapamiętaj mnie',
    ],
    
    'buttons' => [
        'retrieve' => 'wyślij link do odzyskania hasła',
        'password-set' => 'ustaw hasło',
        'toggel-navigation' => 'włącz panel nawigacyjny',
    ],
    
    'errors' => [
        'credentials' => 'Nieprawidłowy użytkownik lub hasło.',
        'activation' => 'Konto nie jest aktywne.',
        'throttle' => 'Twoje konto zostało zablokowane na :delay sekund(y).',
        'send' => 'Nie udało się wysłać wiadomości e-mail.',
        'register' => 'Nieudana próba rejestracji konta.',
        'link' => 'Ten link jest niepoprawny lub wygasły.',
        'password-set' => 'Nieudało się ustawić nowego hasła.',
    ],
    
    'messages' => [
        'account-created' => 'Konto zostało utworzone. Niedługo otrzymasz e-mail z linkiem aktywacyjnym.',
        'activated' => 'Twoje konto jest teraz aktywno. Możesz się zalogować.',
        'password-set' => 'Nowe hasło zostało ustawione.',
        'retrieve' => 'Na Twój adres e-mail wysłaliśmy dalsze instrukcje.',
        'success' => 'Twoje zmiany zostały zapisane.',
    ],    
];