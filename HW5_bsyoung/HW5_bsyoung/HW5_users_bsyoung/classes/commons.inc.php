<?php

class Commons {
    /* Function to validate email addresses */

    public function check_email($email) {
        return preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email) ? TRUE : FALSE;
    }

    /* Function to update user details */

    public function hash_pass($pass) {
        $passsalt = 'salt';
        $hashed = md5(sha1($pass));
        $hashed = crypt($hashed, $passsalt);
        $hashed = sha1(md5($hashed));
        return $hashed;
    }

}
