<?php

	class administradorController extends Controller{
		
		private $_administrador;
		
		public function __construct(){
			
			parent::__construct();
			
			$this->_administrador = $this->loadModel('administrador');
			
		}
		
		public function index(){
			
			if(Session::get('autenticado')){
			
				$this->_view->administradorUsuarios = $this->_administrador->getUsuarios();
				$this->_view->administradorAnuncios = $this->_administrador->getAnuncios();
				$this->_view->titulo = 'Anuncio';
				$this->_view->renderizar('index', 'administrador');
			
			}
    	}
		
		public function eliminarUsuario($id){
			
			if(!$this->filtrarInt($id)){
            	$this->redireccionar('administrador');
        	}
						
			 $this->_administrador->eliminarUsuario(
                    
					$this->filtrarInt($id)
			);
			
			$this->redireccionar('administrador');
		
		}
		
		public function eliminarAnuncio($id){
			
			if(!$this->filtrarInt($id)){
            	$this->redireccionar('administrador');
        	}
						
			 $this->_administrador->eliminarAnuncio(
                    
					$this->filtrarInt($id)
			);
			
			$this->redireccionar('administrador');
		
		}
	}
	
