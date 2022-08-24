<?php

return [
  'middleware' => [
    'web',
    'auth:admin'
  ],
  'prefix' => 'admin',
  'layout' => 'layouts.admin',
];
