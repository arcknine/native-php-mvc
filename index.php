<?php
include_once '_autoload.php';
include_once 'models/user.php';

$data = array(
  'username' => 'arcknine12451',
  'name' => 'keenan1',
  'email' => 'keenan.iban@gmail1.com'
);

// $user = new User($data);
// $user->create();

$user = new User();
dd($user->all()->limit());
// dd($user);
// dd($user->all());

$data = array('description' => "lorem ipsum");
view('home/index', $data);