<?php
function dd($arr)
{
  echo '<pre>';
  print_r($arr);
  echo '</pre>';
  die;
}

function view($path, $data,  $layout = 'application')
{
  $template = include('views/' . $path . '.html.php');
  include('views/layout/'.$layout.'.html.php');
}

function pluralize($str)
{
  $last_letter = strtolower($str[strlen($str) - 1]);
  switch($last_letter)
  {
    case 'y':
      return substr($str, 0, -1) . 'ies';
    case 's';
      return $str . 'es';
    default:
      return $str . 's';
  }
}