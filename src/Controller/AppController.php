<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    var $directorioadom = '/analfe/';

    var $json=array();
        
    var $logged_in = 0;
    var $idLogged = 0;
    var $nameLogged = "";
    var $lastnameLogged = "";
//    var $rolLogged = 2;
    
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
                
        $this->set('dir',$this->directorioadom);
                
        $this->Auth->loginRedirect = array('controller'=> 'Users', 'action' => 'account');
        $this->Auth->logoutRedirect = array('controller' => 'Users', 'action' => 'login');
        
        $logged_in = 0;
        $idLogged = 0;
        $nameLogged = "";
        $lastnameLogged = "";
        $type_user_id = 2; //Administrador de la pagina mas no el super admin por defecto
        
        if($this->Auth->user()!=null){
            $logged_in = 1;
            $idLogged = $this->Auth->user('id');
            $nameLogged = $this->Auth->user('name');
            $lastnameLogged = $this->Auth->user('lastname');
            $type_user_id = $this->Auth->user('type_user_id');            
        }
        
        $this->set('logged_in', $logged_in);
        $this->set('idLogged', $idLogged);
        $this->set('nameLogged', $nameLogged);
        $this->set('lastnameLogged', $lastnameLogged);
        $this->set('type_user_id', $type_user_id);        
                        
        if($this->Cookie->read('User')!=null){
            //Dio recordar contraseña
            $this->loadModel('Users');
            $users = $this->Users->get($this->Cookie->read('User.id'))->toArray();
            $this->Auth->setUser($users);
            
            $this->logged_in = 1;
            $this->idLogged = $this->Cookie->read('User.id');
            $this->request->session()->write('User', $users);
        }
        
        $this->logged_in = $logged_in; 
        $this->idLogged = $idLogged;
        $this->nameLogged = $nameLogged;
        $this->lastnameLogged = $lastnameLogged;
        $this->type_user_id = $type_user_id;
                
        $this->Auth->allow(['login', 'loginN', 'invite', 'validexistbydocumentnumber', 'diplomas']);
    }
    
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie', ['expiry' => '+10 days']);
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => ['email', 'user'], 'password' => 'password']
                ],
            ],
            'loginAction' => [
              'controller' => 'Users',
              'action' => 'login'
            ]
        ]);
        $this->loadComponent('Paginator');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
    
    public function loginRedirect(){
        return $this->redirect(array('controller'=> 'Users', 'action' => 'account'));
    }

    public function logoutRedirect(){
        return $this->redirect(array('controller'=> 'Users', 'action' => 'login'));
    }
    
    function ramdoncharacters($longitudPass){
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena = strlen($cadena);
        $pass = "";
        if($longitudPass==null){
            $longitudPass = 6;
        }
        for ($i = 1; $i <= $longitudPass; $i++) {
            $pos = rand(0, $longitudCadena - 1);
            $pass .= substr($cadena, $pos, 1);
        }

        return $pass;
    }
}
