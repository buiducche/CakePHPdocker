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
        $t_feed =  $this->Paginator->paginate($this->T_feed->find());
        $this->set(compact('t_feed')); 
        // echo json_encode($t_feed);
        // echo "hello";
    }
    public function feed()
    { 
        $t_feed_new = $this->T_feed->newEmptyEntity();
        if ($this->request->is('post')) {
            $t_feed_new = $this->T_feed->patchEntity($t_feed_new, $this->request->getData());
            // $time = Time::now();
            // $t_feed_new->create_at=$time;
            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            if ($this->T_feed->save($t_feed_new)) 
            return $this->redirect(['action' => 'index']);
        }
        
        $this->set('t_feed', $t_feed_new);
    }
}