<?php
function userLogin()
{
    $db = \Config\Database::connect();
    return $db->table('user_tb')->where('id_user', session('id_user'))->get()->getRow();
}
