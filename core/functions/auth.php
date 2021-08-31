<?php
function auth($login, $password, $db) {
    if(isset($login) && isset($password)) {
        $auth = new Auth($login, $password, $db);
        $check_user = $auth->auth();
        if($check_user) {
            header('Location: ../?method=show');
        } else {
            header('Location: ../?method=wrong');
        }
    }
}