<?php
// src/Controller/ArticlesController.php

namespace App\Controller;

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
        $t_feed = $this->T_feed->newEmptyEntity();
        if ($this->request->is('post')) {
            $t_feed = $this->T_feed->patchEntity($t_feed, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            if ($this->T_feed->save($t_feed)) 
            return $this->redirect(['action' => 'index']);
        }
        
        $this->set('t_feed', $t_feed);
    }
}