<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UsersCursos Controller
 *
 * @property \App\Model\Table\UsersCursosTable $UsersCursos
 */
class UsersCursosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Cursos']
        ];
        $usersCursos = $this->paginate($this->UsersCursos);

        $this->set(compact('usersCursos'));
        $this->set('_serialize', ['usersCursos']);
    }

    /**
     * View method
     *
     * @param string|null $id Users Curso id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersCurso = $this->UsersCursos->get($id, [
            'contain' => ['Users', 'Cursos']
        ]);

        $this->set('usersCurso', $usersCurso);
        $this->set('_serialize', ['usersCurso']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usersCurso = $this->UsersCursos->newEntity();
        if ($this->request->is('post')) {
            $usersCurso = $this->UsersCursos->patchEntity($usersCurso, $this->request->data);
            if ($this->UsersCursos->save($usersCurso)) {
                $this->Flash->success(__('The users curso has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The users curso could not be saved. Please, try again.'));
            }
        }
        $users = $this->UsersCursos->Users->find('list', ['limit' => 200]);
        $cursos = $this->UsersCursos->Cursos->find('list', ['limit' => 200]);
        $this->set(compact('usersCurso', 'users', 'cursos'));
        $this->set('_serialize', ['usersCurso']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Curso id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usersCurso = $this->UsersCursos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersCurso = $this->UsersCursos->patchEntity($usersCurso, $this->request->data);
            if ($this->UsersCursos->save($usersCurso)) {
                $this->Flash->success(__('The users curso has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The users curso could not be saved. Please, try again.'));
            }
        }
        $users = $this->UsersCursos->Users->find('list', ['limit' => 200]);
        $cursos = $this->UsersCursos->Cursos->find('list', ['limit' => 200]);
        $this->set(compact('usersCurso', 'users', 'cursos'));
        $this->set('_serialize', ['usersCurso']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Curso id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersCurso = $this->UsersCursos->get($id);
        if ($this->UsersCursos->delete($usersCurso)) {
            $this->Flash->success(__('The users curso has been deleted.'));
        } else {
            $this->Flash->error(__('The users curso could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
