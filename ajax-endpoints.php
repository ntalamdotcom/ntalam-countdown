<?php 
if (!defined('NTALAM_COUNTDOWN__API_NAMESPACE')) {
  include('config.php'); 
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  echo 'nice post';
}else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  echo 'nice get';
}
