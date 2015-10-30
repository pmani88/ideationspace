<?php

// Controller/AttributesController.php
class UsersController extends AppController
{

    public $uses = array('Session', 'User');

    public function beforeFilter()
    {
        $this->Auth->allow('login', 'logout', 'add');
    }

    public function login()
    {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                // use the MD5 of the users password as the key to encrypt all user data
                $this->Session->write("cryptkey", md5($this->request->data['User']['password']));

                //print_r($this->request->data['User']['password']);
                //print_r($this->Session->read());
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid email or password, try again'));
            }
        }
    }

    public function home()
    {
        $Sessions = $this->Session->find('all', array(
            'conditions' => array('Session.user_id' => $this->Auth->user('id'))));
        $this->set(compact('Sessions'));
    }

    public function logout()
    {
        $this->redirect($this->Auth->logout());
        $this->Session->write("cryptkey", "");
    }

    public function add()
    {
        // check if a post request
        if ($this->request->is('post')) {
            //print_r($this->request->data);
            if (isset($this->request->data['User']['agree']) && $this->request->data['User']['agree'] == 1) {

                // create new user
                $this->User->create();

                // check if user saved successfully
                if ($this->User->save($this->request->data)) {

                    // log the user manually into their created account
                    $id = $this->User->id;
                    $this->request->data['User'] = array_merge($this->request->data['User'], array('id' => $id));
                    $this->Auth->login($this->request->data['User']);

                    // use the MD5 of the users password to encrypt all user information
                    $this->Session->write("cryptkey", md5($this->request->data['User']['password']));

                    // set message letting user know their user account has beenc reated
                    $this->Session->setFlash(__('The user has been saved'));
                    // redirect the user to the index page
                    $this->redirect(array('controller' => 'UserSessions', 'action' => 'index'));

                } else {
                    // let the user know their user account could not be created.
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('To create an account you must agree to the terms of use.'));
            }

        }
    }
}