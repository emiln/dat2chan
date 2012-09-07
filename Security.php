<?php
class UserLevel {
    const GUEST = 'guest';
    const USER = 'user';
    const MOD = 'mod';
    const ADMIN = 'admin';
}

class Security {
    static function login($username, $password) {
        Security::logout();
        $query = 'SELECT * FROM Users WHERE username=? AND password=?';
        $result = DB::query($query, array($username,
            Security::get_hash($password)));
        if (count($result) > 0) {
            $_SESSION['userlevel'] = $result[0]['userlevel'];
            return true;
        } else {
            return false;
        }
    }

    static function logout() {
        unset($_SESSION['userlevel']);
    }

    static function get_hash($string) {
        return hash("sha512", $string);
    }

    static function is_logged_in() {
        return isset($_SESSION['userlevel']);
    }

    static function meets_level($userlevel) {
        $cur = (isset($_SESSION['userlevel'])) ? $_SESSION['userlevel'] :
            UserLevel::GUEST;
        return (Security::userlevel_to_int($cur) >=
            Security::userlevel_to_int($userlevel));
    }

    static function userlevel_to_int($userlevel) {
        switch ($userlevel) {
        case UserLevel::GUEST:
            return 0;
        case UserLevel::USER:
            return 1;
        case UserLevel::MOD:
            return 2;
        case UserLevel::ADMIN:
            return 3;
        }
        return 0;
    }
}
