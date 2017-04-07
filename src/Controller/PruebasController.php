<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Pruebas Controller
 *
 * @property \App\Model\Table\PruebasTable $Pruebas
 */
class PruebasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $pruebas = $this->paginate($this->Pruebas);

        $this->set(compact('pruebas'));
        $this->set('_serialize', ['pruebas']);
    }

    /**
     * View method
     *
     * @param string|null $id Prueba id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $prueba = $this->Pruebas->get($id, [
            'contain' => []
        ]);

        $this->set('prueba', $prueba);
        $this->set('_serialize', ['prueba']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $prueba = $this->Pruebas->newEntity();
        if ($this->request->is('post')) {
            $prueba = $this->Pruebas->patchEntity($prueba, $this->request->data);
            if ($this->Pruebas->save($prueba)) {
                $this->Flash->success(__('The prueba has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The prueba could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('prueba'));
        $this->set('_serialize', ['prueba']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Prueba id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $prueba = $this->Pruebas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $prueba = $this->Pruebas->patchEntity($prueba, $this->request->data);
            if ($this->Pruebas->save($prueba)) {
                $this->Flash->success(__('The prueba has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The prueba could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('prueba'));
        $this->set('_serialize', ['prueba']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Prueba id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $prueba = $this->Pruebas->get($id);
        if ($this->Pruebas->delete($prueba)) {
            $this->Flash->success(__('The prueba has been deleted.'));
        } else {
            $this->Flash->error(__('The prueba could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
