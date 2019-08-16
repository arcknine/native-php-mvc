<?php
$autoLoadDirectories = array(
  'config',
  'helpers',
  'lib'
);

foreach ($autoLoadDirectories as $directoy)
{
  foreach (glob($directoy . '/*.php') as $filename)
  {
    include_once $filename;
  }
}