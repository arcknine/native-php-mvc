<?php
include_once '_autoload.php';
include_once 'models/user.php';

$data = array(
  'username' => 'arcknine1245',
  'name' => 'keenan',
  'email' => 'keenan.iban@gmail.com'
);

$user = new User($data);
$user->create();

$data = array('description' => "lorem ipsum");
view('home/index', $data);