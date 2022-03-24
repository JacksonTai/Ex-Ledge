<?php

namespace Controller;

if (!empty($_GET) || !empty($_POST)) {
     session_start();
     include '../helper/autoloader.php';
}

class Bookmark extends \Model\Bookmark
{
     public function __construct($postData = null)
     {
          $postData ? parent::__construct($postData) : '';
     }

     public function read($criteria)
     {
          return $this->readBookmark($criteria);
     }
}

if (isset($_GET['id'])) {
     $_GET['userId'] = $_SESSION['userId'];
     $bookmark = new \Controller\Bookmark($_GET);
}

if (isset($_GET['criteria'])) {
     $bookmark = new \Controller\Bookmark();
     echo json_encode($bookmark->read($_GET['criteria']));
}
