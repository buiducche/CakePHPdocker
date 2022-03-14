<?php
namespace App\Controller;
use App\Controller\AppController;

class BlogController extends AppController{
public function index(){
    $this->viewBuilder()->setLayout('ajax');
}
}
?>