<?php

class perfilController extends Controller
{
	private $_perfil;
	
    public function __construct() {
        parent::__construct();
		$this->_perfil = $this->loadModel('perfil');
    }
    
    public function index(){
		
		if(Session::get('autenticado')){
			
            $this->_view->titulo = 'Perfil';
			$this->_view->renderizar('index', 'perfil');
        
		}
	}
		
	public function editar($id){
		        
		if(!$this->filtrarInt($id)){
            $this->redireccionar('perfil');
        }
        
        if(!$this->_perfil->getUsuario($this->filtrarInt($id))){
            $this->redireccionar('perfil');
        }
        
        $this->_view->titulo = 'Editar Perfil';
       
        
        if($this->getInt('guardar') == 1){
            
			$this->_view->datos = $_POST;
        
				if(!$this->getSql('nombre')){
					$this->_view->_error = 'Debe introducir su nuevo nombre';
					$this->_view->renderizar('editar', 'perfil');
					exit;
				}
				
				 if(!$this->getSql('apellido')){
					$this->_view->_error = 'Debe introducir su nuevo nombre';
					$this->_view->renderizar('editar', 'perfil');
					exit;
				}
				
				if(!$this->validarEmail($this->getPostParam('email'))){
					$this->_view->_error = 'La direccion de email es invalida';
					$this->_view->renderizar('editar', 'perfil');
					exit;
				}
				
				$this->getLibrary('class.phpmailer');
				$mail = new PHPMailer();
				
				
				if(!$this->getSql('pass')){
					$this->_view->_error = 'Debe introducir su  nueva password';
					$this->_view->renderizar('editar', 'perfil');
					exit;
				}
				
				if($this->getPostParam('pass') != $this->getPostParam('confirmar')){
					$this->_view->_error = 'Los passwords no coinciden';
					$this->_view->renderizar('editar', 'perfil');
					exit;
				}
				
				if(Session::get('level')==1){
					
				if(!$this->getPostParam('rol')){
					$this->_view->_error = 'Indica el Rol';
					$this->_view->renderizar('editar', 'perfil');
					exit;
				}
				
					$this->_perfil->editarPerfil(
						
						$this->filtrarInt($id),
						$this->getSql('nombre'),
						$this->getSql('apellido'),
						$this->getPostParam('email'),
						$this->getSql('pass'),
						$this ->getPostParam('rol')					
						
						);
				
				}else{
				
					$this->_perfil->editarPerfil(
							
							$this->filtrarInt($id),
							$this->getSql('nombre'),
							$this->getSql('apellido'),
							$this->getPostParam('email'),
							$this->getSql('pass')					
							
							);
				}
				
				 
				
				$usuario = $this->_perfil->verificarUsuario($this->getAlphaNum('usuario'));
				
				if(Session::get('level')==1){
				
					$this->redireccionar('administrador');
				
				}else{
				
					$this->redireccionar('perfil');
				
				}
				
				if(!$usuario){
					$this->_view->_error = 'Error al actualizar el usuario';
					$this->_view->renderizar('editar', 'perfil');
					exit;
		
				}
        
    	}
		
        $this->_view->datos = $this->_perfil->getUsuario($this->filtrarInt($id));
        $this->_view->renderizar('editar', 'perfil');

	}
}

?>