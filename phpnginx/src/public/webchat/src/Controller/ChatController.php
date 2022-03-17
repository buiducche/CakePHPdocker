<?php
// src/Controller/ArticlesController.php

namespace App\Controller;
use Cake\I18n\Time;

class ChatController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel('T_feed');
        $this->loadComponent('Paginator');
        $this->viewBuilder()->setLayout('chat');
        $this->loadComponent('Flash');
    }
    public function index()
    {   
        $session = $this->request->getSession();
        $email=$session->read('email');
        $name=$session->read('name');
        if(!$email){
            return $this->redirect(['controller'=>'user','action' => 'login']);
        }
        $t_feed =  $this->T_feed->find();
        $this->set(compact('t_feed'));
        $this->set(compact('name'));
    }
    public function feed()
    {   
        $t_feed_new = $this->T_feed->newEmptyEntity();
        if ($this->request->is('post')) {
            $t_feed_new = $this->T_feed->patchEntity($t_feed_new, $this->request->getData());
            $session = $this->request->getSession();
            $image= $this->request->getData('image');
            $image_name=$image->getclientFilename();
            // debug($image);
            // exit;

            $t_feed_new->user_id=$session->read('user_id');
            $t_feed_new->name=$session->read('name');
            $t_feed_new->image_file_name=$image_name;
            
            //Save Image
            if($image_name){
                $targetPath = WWW_ROOT.'img'.DS.$image_name;
                $image->moveTo($targetPath);
            }
            //Save Feed
            if ($this->T_feed->save($t_feed_new)) 
            return $this->redirect(['action' => 'index']);
        }
        
        $this->set('t_feed', $t_feed_new);
    }
}