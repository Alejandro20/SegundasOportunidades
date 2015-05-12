<?php

class anunciosController extends Controller
{
    private $_anuncio;
    
    public function __construct() {
        parent::__construct();
        $this->_anuncio = $this->loadModel('anuncios');
    }
    
    public function index()
    {
		if(Session::get('autenticado')){
        
			$this->_view->anuncios = $this->_anuncio->getAnunciosPropios();
			$this->_view->anunciosVendidos = $this->_anuncio->getAnunciosPropiosVendidos();
			$this->_view->titulo = 'Anuncio';
			$this->_view->renderizar('index', 'anuncios');
		
		}else{
			
			$this->_view->anuncios = $this->_anuncio->getAnuncios();
        	$this->_view->titulo = 'Anuncio';
        	$this->_view->renderizar('index', 'anuncios');
		
		}
    }
    
    public function nuevo()
    {
        
        $this->_view->titulo = 'Nuevo Anuncio';
        $this->_view->setJs(array('nuevo'));
        
        if($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST;
            
            if(!$this->getTexto('titulo')){
                $this->_view->_error = 'Debe introducir el titulo del anuncio';
                $this->_view->renderizar('nuevo', 'anuncios');
                exit;
            }
            
            if(!$this->getTexto('descripcion')){
                $this->_view->_error = 'Debe introducir la descripcion del anuncio';
                $this->_view->renderizar('nuevo', 'anuncios');
                exit;
            }
			
			if(!$this->getTexto('precio')){
                $this->_view->_error = 'Debe introducir el precio del producto';
                $this->_view->renderizar('nuevo', 'anuncios');
                exit;
            }
			
			if(!$this->getTexto('imagen')){
                $this->_view->_error = 'Debe introducir la imagen del anuncio';
                $this->_view->renderizar('nuevo', 'anuncios');
                exit;
            }
            
			//$ruta = BASE_URL.IMG_ANUNICIOS;
            //$imagen = $_FILES['imagen']['name'];
			//move_uploaded_file($_FILES["imagen"]["tmp_name"], 'imgs/'.$_FILES['imagen']['name']);
            
            /*if(isset(){
				
                $ruta = BASE_URL.RUTA_IMG_ANUNICIOS.DS;
                
				
			}*/
            
            $this->_anuncio->insertarAnuncio(
                    $this->getTexto('titulo'),
                    $this->getTexto('descripcion'),
					$this->getTexto('precio'),
					$this->getTexto('imagen')
					//$imagen
                    );
            
            $this->redireccionar('anuncios');
        }       
        
        $this->_view->renderizar('nuevo', 'anuncios');
    }
    
    public function editar($id){
        
		if(!$this->filtrarInt($id)){
            $this->redireccionar('anuncios');
        }
        
        if(!$this->_anuncio->getAnuncio($this->filtrarInt($id))){
            $this->redireccionar('anuncios');
        }
        
        $this->_view->titulo = 'Editar Anuncio';
        $this->_view->setJs(array('nuevo'));
        
        if($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST;
            
            if(!$this->getTexto('titulo')){
                $this->_view->_error = 'Debe introducir el titulo del anuncio';
                $this->_view->renderizar('editar', 'anuncios');
                exit;
            }
            
            if(!$this->getTexto('descripcion')){
                $this->_view->_error = 'Debe introducir la descripcion del anuncio';
                $this->_view->renderizar('editar', 'anuncios');
                exit;
            }
			
			if(!$this->getInt('precio')){
                $this->_view->_error = 'Debe introducir el precio del producto';
                $this->_view->renderizar('editar', 'anuncios');
                exit;
            }
            
            /*if(!$this->getTexto('imagen')){
                $this->_view->_error = 'Debe introducir la imagen del anuncio';
                $this->_view->renderizar('editar', 'anuncios');
                exit;
            }*/
            
            $this->_anuncio->editarAnuncio(
                    
					$this->filtrarInt($id),
                    $this->getTexto('titulo'),
                    $this->getTexto('descripcion'),
					$this->getTexto('precio'),
					$this->getTexto('imagen')
					
					
                    );
            
            $this->redireccionar('anuncios');
        }
        
        $this->_view->datos = $this->_anuncio->getAnuncio($this->filtrarInt($id));
        $this->_view->renderizar('editar', 'anuncios');
    }
	
	public function vendido($id){
	
		if(!$this->filtrarInt($id)){
            	$this->redireccionar('anuncios');
        	}
						
			 $this->_anuncio->AnuncioVendido(
                    
					$this->filtrarInt($id)
			);
			
			$this->redireccionar('anuncios');
	
	
	}
    
}

?>

