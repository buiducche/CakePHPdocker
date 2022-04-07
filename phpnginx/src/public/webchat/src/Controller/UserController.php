<?php
// src/Controller/UserController.php

namespace App\Controller;

class UserController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('T_user');
        $this->loadComponent('Flash');
    }
    public function index()
    {
        return $this->redirect(['action' => 'login']);
    }
    public function login()
    {
        $t_user = $this->T_user->newEmptyEntity();
        if ($this->request->is('post')) {
            $t_user = $this->T_user->patchEntity($t_user, $this->request->getData());
            $user =  $this->T_user->find()->where(['T_user.name =' => $t_user->name, 'T_user.password =' => $t_user->password])->first();
            if ($user) {
                $session = $this->getRequest()->getSession();
                $session->write('email', $user->email);
                $session->write('name', $user->name);
                $session->write('user_id', $user->id);
                return $this->redirect(['controller' => 'chat', 'action' => 'index']);
            } else {
                $this->Flash->error(__('Login false'));
                return $this->redirect(['action' => 'login']);
            }
        }
    }
    public function regist()
    {
        $t_user = $this->T_user->newEmptyEntity();
        if ($this->request->is('post')) {
            $t_user = $this->T_user->patchEntity($t_user, $this->request->getData());

            if ($this->T_user->find()->where(['T_user.email =' => $t_user->email])->first()) {
                $this->Flash->error(__('email has already existed'));
                return $this->redirect(['action' => 'regist']);
            }
            if ($this->T_user->find()->where(['T_user.name =' => $t_user->name])->first()) {
                $this->Flash->error(__('name has already existed'));
                return $this->redirect(['action' => 'regist']);
            }
            if ($this->T_user->save($t_user)) {
                $this->Flash->success(__('Register successfully'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Unable to add your user.'));
        }
    }
    public function edit()
    {
        $session = $this->request->getSession();
        $email = $session->read('email');
        $name = $session->read('name');
        $user_id = $session->read('user_id');
        $t_user = $this->T_user->find()->where(['T_user.email =' => $email])->first();
        if (!$email) {
            return $this->redirect(['controller' => 'user', 'action' => 'login']);
        }
        $this->set(compact('name'));

        if ($this->request->is('post')) {
            $t_user = $this->T_user->patchEntity($t_user, $this->request->getData());
            if ($this->T_user->find()->where(['T_user.name =' => $t_user->name])->first()) {
                debug($this->T_user->find()->where(['T_user.name =' => $t_user->name])->first());
                exit;
                $this->Flash->error(__('Name has already existed'));
                return $this->redirect(['action' => 'edit']);
            }
            if ($this->T_user->save($t_user)) {
                $this->Flash->success(__('ReName successfully'));
                $session = $this->getRequest()->getSession();
                $session->delete('name');
                $session->write('name', $t_user->name);
                return $this->redirect(['action' => 'chat']);
            }
            $this->Flash->error(__('Unable to rename .'));
        }
    }
    public function logout()
    {
        $session = $this->getRequest()->getSession();
        $session->delete('email');
        $session->delete('name');
        $session->delete('user_id');
        return $this->redirect(['action' => 'login']);
    }
}
