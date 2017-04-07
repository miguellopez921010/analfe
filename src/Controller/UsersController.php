<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;

//include VENDOR.'PHPExcel'.DS.'Classes'.DS.'PHPExcel.php';
//require VENDOR.'phpoffice'.DS.'phpexcel'.DS.'Classes'.DS.'PHPExcel.php';

require(ROOT .DS. 'vendor' . DS  . 'phpoffice'. DS .'phpexcel'. DS .'Classes'. DS .'PHPExcel.php');
require(ROOT .DS. 'vendor' . DS  . 'phpoffice'. DS .'phpexcel'. DS .'Classes'. DS .'PHPExcel'.DS.'IOFactory.php');
//require(ROOT .DS. 'vendor' . DS  . 'fpdf'. DS .'fpdf.php');
require(ROOT .DS. 'vendor' . DS .'WriteHTML.php');
//require(ROOT .DS. 'vendor' . DS  . 'phpoffice'. DS .'phpexcel'. DS .'Classes'. DS .'PHPExcel'.DS.'Style'.DS.'NumberFormat.php');
//
//use PHPExcel;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    public function excel(){
        $this->layout='ajax';
        $this->response->type('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    }
  
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['TypeUsers']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['TypeUsers']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add(){
        $this->viewBuilder()->layout('analfe2');
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $typeUsers = $this->Users->TypeUsers->find('list', ['limit' => 200]);
        $this->set(compact('user', 'typeUsers'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function login(){
        $this->viewBuilder()->layout('analfe');
        
        if($this->logged_in == 1){
            return $this->redirect(['action' => 'account']);
        }
    }
    
    function loginN() {
        $this->viewBuilder()->layout('ajax');
        $this->autoRender = false;
        $id = 0;
        $emailusuario = "";
        $passwordusuario = "";
        $remember_me = 0;
        $estado = 0;
        $mensaje = "";
        $passencript = 0;
        $direccion = $this->directorioadom.'Users/account';
        if(isset($_POST['vista'])){
            if($_POST['vista'] == 2){
                $direccion = $this->directorioadom.'Products/cart';
            }
        }
        
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $result = $this->Users->get($id);
            if ($result != null) {
                $emailusuario = $result->email;
                $passwordusuario = $result->password;
                $passencript = 1;
            }
        } else {
            $emailusuario = $_POST['email'];
            $passwordusuario = rtrim(ltrim(trim($_POST['password'])));
            $remember_me = 0;
            if(isset($_POST['remember_mehidden'])){
                $remember_me = $_POST['remember_mehidden'];
            }            
        }

        $infouser = $this->Users->find('all', ['conditions' => ['Users.email LIKE' => $emailusuario]]);
        
        if ($infouser->first() != null) {
            if ($passencript == 0) {
                $passwordusuario = sha1($passwordusuario);
            }

            if($infouser->first() != null){
                //Logueo por email
                if ($passwordusuario == $infouser->first()->password) {
                    if ($infouser->first()->active == 1) {
                        $arrayusuario = $infouser->first()->toArray();
                        $this->Auth->setUser($arrayusuario);
                        $estado = 1;
                        $this->json['user'] = $arrayusuario;

                        $mensaje = "Bienvenido " . $arrayusuario['name']. ' '.$arrayusuario['lastname'];

                        if ($remember_me == 1) {
                            $this->Cookie->write('User', $arrayusuario);
                        }
                        $this->logged_in = 1;
                        $this->idLogged = $infouser->first()->id;

                        $this->request->session()->write('User', $arrayusuario);
                        
                        if($infouser->first()->change_password == 1){
                            $direccion = $this->directorioadom.'Users/changepass';
                        }                      
                    } else {
                        $mensaje = "Usuario o contraseña incorrecta.";
                    }
                } else {
                    $mensaje = "Usuario o contraseña incorrecta.";
                }
            }
        } else {
            //Usuario no se encuentra registrado en la bd
            $mensaje = "Usuario no se encuentra registrado.";
        }

        $this->json['direccion'] = $direccion;
        $this->json['estado'] = $estado;
        $this->json['mensaje'] = $mensaje;
        $encoded = json_encode($this->json);
        echo ($encoded);
    }
    
    function save() {
        $this->viewBuilder()->layout('ajax');
        $this->autoRender = false;
        $estado = 0;
        $mensaje = "";

        $password_encrypt = "";
        $password = "";
        if(isset($_POST['password'])){
            $password = trim($_POST['password']);
            $password_encrypt = sha1($password);
        }        
        $document_type = "CC";
        if(isset($_POST['document_type'])){
            $document_type = trim($_POST['document_type']);
        }
        $document_number = "";
        if(isset($_POST['document_number'])){
            $document_number = str_replace('.', '', trim($_POST['document_number']));
        }
        $name = "";
        if(isset($_POST['name'])){
            $name = trim($_POST['name']);
        }
        $lastname = "";
        if(isset($_POST['lastname'])){
            $lastname = trim($_POST['lastname']);
        }
        $email = "";
        if(isset($_POST['email'])){
            $email = trim($_POST['email']);
        }
        $type_user_id = "";
        if(isset($_POST['type_user_id'])){
            $type_user_id = $_POST['type_user_id'];
        }
        
        $data = [
            'document_type' => $document_type,
            'document_number' => $document_number,
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password_encrypt,
            'active' => 1,
            'change_password' => 0,
            'type_user_id' => $type_user_id
        ];

        $usersTable = TableRegistry::get('Users');
                
        if (isset($_POST['id'])) {
            //Editar usuario             
            $user = $this->Users->get($_POST['id']);
            $user->document_type = $document_type;
            $user->document_number = $document_number;
            $user->name = $name;          
            $user->lastname = $lastname;
            $user->email = $email;
                    
            if ($usersTable->save($user)) {
                $id = $_POST['id'];
                $this->json['id'] = $id;
                $estado = 1;
                $mensaje = "Se edito usuario con exito.";
            } else {
                $mensaje = "Error al editar usuario.";
            }
        } else {
            //Insertar nuevco usuario
            $user = $usersTable->newEntity($data, ['validate' => false]);            
            if ($usersTable->save($user)) {
                $id = $user->id;
                $this->json['id'] = $id;
                $estado = 1;
                $mensaje = "Se registro usuario con exito.";                   
            } else {
                $mensaje = "Error al registrar usuario.";
            }
        }

        $this->json['estado'] = $estado;
        $this->json['mensaje'] = $mensaje;
        $encoded = json_encode($this->json);
        echo ($encoded);
    }
    
    function logout() {
        $this->viewBuilder()->layout('ajax');
        $this->autoRender = false;
        $estado = 0;
        $mensaje = "";

        if ($this->Auth->logout()) {
            if ($this->Cookie->read('User') != null) {
                $this->Cookie->delete('User');
            }
            $estado = 1;
            $mensaje = "Se ha cerrado sesi&oacute;n.";
        }

        return $this->redirect(['action' => 'login']);
        
//        $this->json['estado'] = $estado;
//        $this->json['mensaje'] = $mensaje;
//        $encoded = json_encode($this->json);
//        echo ($encoded);
    }
    
    function account() {
        $this->viewBuilder()->layout('analfe2');
    }
    
    function massiveusers(){
        $this->viewBuilder()->layout('analfe2');
    }
    
    function downloadtemplate(){
        $this->viewBuilder()->layout('ajax');
        $this->autoRender = false;
        $objPHPExcel = new \PHPExcel();   
        $objPHPExcel->createSheet(0)->setTitle('Plantilla Analfe');//creamos la pestaña
        $objPHPExcel->getProperties()->setCreator("Miguel lopez")->setLastModifiedBy("Miguel lopez")->setTitle("Analfe")->setDescription("Plantilla Analfe");
    
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Número de indentificación')->getStyle('A1')->getFont()->setBold(true)->setSize(12);            
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'Nombres')->getStyle('B1')->getFont()->setBold(true)->setSize(12);        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'Apellidos')->getStyle('C1')->getFont()->setBold(true)->setSize(12);        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Email')->getStyle('D1')->getFont()->setBold(true)->setSize(12); 
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'Curso')->getStyle('E1')->getFont()->setBold(true)->setSize(12);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'Fecha de diplomado')->getStyle('F1')->getFont()->setBold(true)->setSize(12);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'Ciudad')->getStyle('G1')->getFont()->setBold(true)->setSize(12);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel; charset=utf-8');
        header('Content-Disposition: attachment;filename="Plantilla analfe.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');        
    }
    
    function saveusersmasivo(){
        $this->viewBuilder()->layout('ajax');
        $this->autoRender = false;
        
        $cursosTable = TableRegistry::get('Cursos');
        $userscursosTable = TableRegistry::get('Users_cursos');
        
        $temporal_archivo = $_FILES['archivo']['tmp_name'];
        $nombre_archivo = $_FILES['archivo']['name'];            
        $arraynombre = explode('.', $nombre_archivo);            
        $extension_archivo = $arraynombre[count($arraynombre)-1];
            
        $directorio = $temporal_archivo;
        
        $objPHPExcel = new \PHPExcel();
        $objReader =  \PHPExcel_IOFactory::createReader('Excel2007');
        $objReader->setReadDataOnly(true);

        $objPHPExcel = $objReader->load($directorio);
        $objWorksheet = $objPHPExcel->getActiveSheet();

        $cantidadFilasHoja = $objWorksheet->getHighestRow(); //Cantidad de filas de laa hoja actual
        $cantidadColumnasHoja = $objWorksheet->getHighestColumn(); //Cantidad de columnas de la hoja actual (muestra string EJ: A B AM BC)          
        $cantidadColumnasHoja2 = \PHPExcel_Cell::columnIndexFromString($objWorksheet->getHighestColumn()); //Muestra la cantidad de columnas (numeros) que tiene la hoja actual

        $arraymostrar = array();
        
        //Fila empieza en 1 Y columna en 0
        $fila = 1;
        foreach ($objWorksheet->getRowIterator() as $row) {            
            if($fila==1){
                $fila++;
            }else{
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);

                $columna = 0;
                foreach ($cellIterator as $cell) {
                    if($columna == 5){
                        $dateValue = \PHPExcel_Shared_Date::ExcelToPHP(trim($cell->getValue()));                       
                        $dateh = date('Y-m-d',$dateValue);
                        
                        $arraymostrar[$fila][$columna] = $dateh;                        
                    }else{
                        $arraymostrar[$fila][$columna] = trim($cell->getValue());
                    }
        
                    if($columna==($cantidadColumnasHoja2-1)){
                        $columna = 0;
                        $fila++;
                    }else{
                        $columna++;
                    }
                }
            }
        }
        
        $arrayexisteregistro = array();
        foreach ($arraymostrar AS $arr){
            $agregararegistro = false;
            if($arr[0] != '' && $arr[1] != '' && $arr[2] != '' && $arr[3] != '' && $arr[4] != '' && $arr[5] != '' && $arr[6] != ''){
                $agregararegistro = true;
            }
            
            if($agregararegistro){
                array_push($arrayexisteregistro, $arr);
            }          
        }
        
        if(!empty($arrayexisteregistro)){
            foreach ($arrayexisteregistro AS $reg){
                $numero_documento = trim($reg[0]);
                //Obtener el usuario con el numero de documento
                $informacionuser  = $this->Users->find('all', [
                                        'conditions' => [
                                            'Users.document_number =' => $numero_documento
                                        ],
                                        'order' => 'Users.id ASC'
                                    ])->first();
                
                $user_id = 0;                
                if(!empty($informacionuser)){
                    //Existe el usuario en la BD
                    $user_id = $informacionuser->id;
                }else{
                    //Se crea primero el usuario
                    $usersTable = TableRegistry::get('Users');
                    
                    $user = $usersTable->newEntity();
                    $user->document_type = 'CC';
                    $user->document_number = $numero_documento;
                    $user->name = strtoupper ($reg[1]);
                    $user->lastname = strtoupper ($reg[2]);          
                    $user->email = $reg[3];                    
                    $passwordgeenrate = $this->ramdoncharacters(10);
                    $passwordhasheada = sha1($passwordgeenrate);
                    $user->password = $passwordhasheada;    
                    $user->type_user_id = 3;
                    $user->active = 1;
                    $user->change_password = 0;
                    
                    if ($usersTable->save($user)) {
                        $user_id = $user->id;
                    }
                }
                
                //Obtener el curso, si no esta, crear el curso                
                $nombre_curso = trim(strtoupper($reg[4]));
                //Obtener el usuario con el numero de documento
                $informacioncurso  = $cursosTable->find('all', [
                                        'conditions' => [
                                            'Cursos.curso LIKE ' => $nombre_curso
                                        ],
                                        'order' => 'Cursos.id ASC'
                                    ])->first();
                
                $curso_id = 0;                
                if(!empty($informacioncurso)){
                    //Existe el curso en la BD
                    $curso_id = $informacioncurso->id;
                }else{
                    //Se crea primero el curso                    
                    $curso = $cursosTable->newEntity();
                    $curso->curso = $nombre_curso;
                    
                    if ($cursosTable->save($curso)) {
                        $curso_id = $curso->id;
                    }
                }
                
                $informacionusercodigodedescarga = $this->Users->find('all', [
                                                        'conditions' => [
                                                            'Users.id =' => $user_id
                                                        ],
                                                        'order' => 'Users.id ASC'
                                                    ])->first();
                $informacioncursocodigodedescarga = $cursosTable->find('all', [
                                                        'conditions' => [
                                                            'Cursos.id =' => $curso_id
                                                        ],
                                                        'order' => 'Cursos.id ASC'
                                                    ])->first();
                              
                $fechadiplomado = trim($reg[5]);
                
                $codigo_de_descarga = "";
                $codigo_de_descarga.='document_type='.$informacionusercodigodedescarga->document_type.'&';
                $codigo_de_descarga.='document_number='.$informacionusercodigodedescarga->document_number.'&';
                $codigo_de_descarga.='name='.$informacionusercodigodedescarga->name.'&';
                $codigo_de_descarga.='lastname='.$informacionusercodigodedescarga->lastname.'&';
                $codigo_de_descarga.='curso='.$informacioncursocodigodedescarga->curso.'&';
                $codigo_de_descarga.='fecha_diplomado='.$fechadiplomado.'&';
                $codigo_de_descarga.='ciudad='.trim(ucwords($reg[6]));
                                
                $codificacioncodigo_de_descarga = base64_encode($codigo_de_descarga);
                
                //Asociar el usuario con el curso
                $userscurso = $userscursosTable->newEntity();
                $userscurso->user_id = $user_id;
                $userscurso->curso_id = $curso_id;
                $userscurso->ciudad = trim(ucwords($reg[6]));
                $userscurso->fecha_diplomado = $fechadiplomado;
                $userscurso->codigo_de_descarga = $codificacioncodigo_de_descarga;
                      
                if ($userscursosTable->save($userscurso)) {
                    $userscurso_id = $userscurso->id;
                }
                
            }
        }
        
        $this->json['estado'] = 1;
        $this->json['mensaje'] = 'Se cargo archivo correctamente';
        $encoded = json_encode($this->json);
        echo ($encoded);        
    }
    
    function invite(){
        $this->viewBuilder()->layout('analfe');
    }
    
    function validexistbydocumentnumber(){
        $this->viewBuilder()->layout('ajax');
        $this->autoRender = false;
        
        $estado = 0;
        $mensaje = "Usuario no existe";
        
        $document_number = str_replace('.', '', $_POST['document_number']);
        
        $infouser = $this->Users->find('all', ['conditions' => ['Users.document_number ' => $document_number]]);
        
        if ($infouser->first() != null) {
            $estado = 1;
            $mensaje = "Si existe el usuario.";            
            $arrayusuario = $infouser->first()->toArray();            
            $this->json['informacionusuario'] = $arrayusuario;            
        }        
        
        $this->json['estado'] = $estado;
        $this->json['mensaje'] = $mensaje;
        $encoded = json_encode($this->json);
        echo ($encoded);
    }
    
    function diplomas(){
        $this->viewBuilder()->layout('ajax');
        
        $cursosTable = TableRegistry::get('Cursos');
        $userscursosTable = TableRegistry::get('Users_cursos');
        
        $user_id = $_REQUEST['u'];
        
        $infouser = $this->Users->find('all', ['conditions' => ['Users.id ' => $user_id]]);
        
        if ($infouser->first() != null) {
            $arrayusuario = $infouser->first()->toArray(); 
            
            //Vursos del usuario actual
            $cursosdelusuario = $userscursosTable->find('all', ['conditions' => ['Users_cursos.user_id ' => $arrayusuario['id']], 'order' => ['Users_cursos.id DESC']]);
            $arraycurso = $cursosdelusuario->first()->toArray(); 
            
            $informacioncurso = $cursosTable->find('all', ['conditions' => ['Cursos.id ' => $arraycurso['curso_id']]]);
            $arrayinformacioncurso = $informacioncurso->first()->toArray(); 
            
            $pdf= new \PDF_HTML('l');
            $pdf->AddPage();

    /* Cuerpo del Diploma */
            $pdf->Image(WWW_ROOT.'img'.DS.'logos'.DS.'logos.png',0,0,-300);//Imagen de fondo	
            $pdf->SetFont('Arial');//Tipo de fuente
            $pdf->Ln(30);//Salto de linea
            $pdf->WriteHTML(utf8_decode('<p align="center">REPÚBLICA DE COLOMBIA</p><br>'));
            $pdf->WriteHTML(utf8_decode('<p align="center">ASOCIACIÓN NACIONAL DE FONDOS DE EMPLEADOS - ANALFE</p>'));
            $pdf->WriteHTML(utf8_decode('<p align="center">Nit. 860 504 495 - 6</p><br>'));
            
            $pdf->WriteHTML(utf8_decode('<p align="center">Acreditada y autorizada por la Unidad Administrativa Especial de Organizaciones Solidarias, mediante Resolución N°680 del 22 de</p>'));
            $pdf->WriteHTML(utf8_decode('<p align="center">Noviembre de 2013 "por medio de la cual se acredita y se da autorización para impartir Educación en Economia Solidaria y se</p>'));
            $pdf->WriteHTML(utf8_decode('<p align="center">otorga aval al programa de Educación Solidaria con énfasis en Trabajo Asociado".</p><br>'));
            
            $pdf->WriteHTML(utf8_decode('<p align="center"><b>Certifica la participación activa de</b></p>'));
            
            $pdf->SetFont('Arial', 'B', 20);//tTpo de fuente
            $pdf->Ln(8); //Salto de linea
            $pdf->Cell(00,00,utf8_decode($arrayusuario['name'].' '.$arrayusuario['lastname']),0,1,'C');//Nombre


            $pdf->Ln(10); //Salto de linea
                            $pdf->SetFont('Arial', '', 15);//Tipo de fuente
            $pdf->Cell(00,00,utf8_decode("Identificado con la Cédula de Ciudadanía N°\n".number_format ($arrayusuario['document_number'],0,',','.')),0,1,'C');//Cedula

            $pdf->Ln(10); //Salto de linea
            $pdf->SetFont('Arial', '', 12);//Tipo de fuente		
            $pdf->WriteHTML(utf8_decode('<p align="center">En el Curso de</p><br>'));//Texto

            $pdf->SetFont('Arial', 'b', 20);//Tipo de fuente		
            $pdf->WriteHTML(utf8_decode('<p align="center">'.$arrayinformacioncurso['curso'].'</p><br>'));//Texto

            $pdf->SetFont('Arial', '', 12);//tipo de fuente
            $pdf->Ln(5); //Salto de linea		
            
            $fecha_diplomado = date("Y-m-d", strtotime($arraycurso['fecha_diplomado']));
            $arrayfechadiplomado = explode('-', $fecha_diplomado);           
            
            $arraymeses = [
                '01'=>'Enero', 
                '02'=>'Febrero', 
                '03'=>'Marzo', 
                '04'=>'Abril', 
                '05'=>'Mayo', 
                '06'=>'Junio', 
                '07'=>'Julio', 
                '08'=>'Agosto', 
                '09'=>'Septiembre', 
                '10'=>'Octubre', 
                '11'=>'Noviembre', 
                '12'=>'Diciembre'
                ];
            
            $pdf->Cell(00,00,utf8_decode("Celebrado en\n".$arraycurso['ciudad']."\nel\n".$arrayfechadiplomado[2].' de '.$arraymeses[$arrayfechadiplomado[1]].' de '.$arrayfechadiplomado[0]),0,1,'C');//Ciudad-Fecha

            $pdf->Ln(8); //Salto de linea
            $pdf->WriteHTML(utf8_decode('<p align="center">Con una Intensidad de 20 Horas Académicas</p>'));//Texto

            $pdf->Ln(8); //Salto de linea            
            $pdf->Cell(00,00,utf8_decode("Segun Folio 003 Expedido el día\n".date('d').' de '.$arraymeses[date('m')].' de '.date('Y')),0,1,'C');//fecha		
            $pdf->SetFont('Arial', '', 10);//tipo de fuente
            $pdf->Ln(15); //Salto de linea
            $pdf->Cell(263,00,utf8_decode("DIRECTOR INSTITUTO DE EDUCACIÓN"),0,1,'R');

            $pdf->Output("Certificado.pdf",'D');//Descarga
        
        }else{
            echo 'ERROR: USUARIO NO EXISTE EN NUESTRA BASE DE DATOS.';
        }
    }
}
