<?php

class View
{
    private $_controlador;
    private $_js;
    
    public function __construct(Request $peticion) {
        $this->_controlador = $peticion->getControlador();
        $this->_js = array();
    }
    
    public function renderizar($vista, $item = false)
    {
        $menu = array(
            array(
                'id' => 'inicio',
                'titulo' => 'Inicio',
                'enlace' => BASE_URL
                ),
        );
        
        if(Session::get('autenticado')){
			
			if(Session::get('level') == 1){
				
				$menu[] = array(
                'id' => 'administrador',
                'titulo' => 'Administrar',
                'enlace' => BASE_URL . 'administrador'
                );
				
			}else{
				
				$menu[] = array(
					'id' => 'anuncios',
					'titulo' => 'Mis Anuncios',
					'enlace' => BASE_URL . 'anuncios'
					);
					
			}
				
            $menu[] = array(
                'id' => 'login',
                'titulo' => 'Cerrar Sesion',
                'enlace' => BASE_URL . 'login/cerrar'
                );
			
			$menu[] = array(
                'id' => 'Perfil',
                'titulo' => 'Mi Perfil',
                'enlace' => BASE_URL . 'perfil'
                );
				
        }else{
							
            $menu[] = array(
                'id' => 'login',
                'titulo' => 'Iniciar Sesion',
                'enlace' => BASE_URL . 'login'
                );

			$menu[] = array(
			'id' => 'registro',
			'titulo' => 'Registrar',
			'enlace' => BASE_URL . 'registro'
			);
        }
        
        $js = array();
        
        if(count($this->_js)){
            $js = $this->_js;
        }
        
        $_layoutParams = array(
            'ruta_css' => BASE_URL . 'Templates/' . DEFAULT_LAYOUT . '/css/',
            'ruta_img' => BASE_URL . 'Templates/' . DEFAULT_LAYOUT . '/img/',
            'ruta_js' => BASE_URL . 'Templates/' . DEFAULT_LAYOUT . '/js/',
            'menu' => $menu,
            'js' => $js
        );
        
        $rutaView = ROOT . 'app' . DS. 'views' . DS . $this->_controlador . DS . $vista . '.php';
        
        if(is_readable($rutaView)){
            include_once ROOT . 'Templates' . DS . DEFAULT_LAYOUT . DS . 'header.php';
            include_once $rutaView;
            include_once ROOT . 'Templates' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
        } 
        else {
            throw new Exception('Error de vista');
        }
    }
    
    public function setJs(array $js)
    {
        if(is_array($js) && count($js)){
            for($i=0; $i < count($js); $i++){
                $this->_js[] = BASE_URL . 'views/' . $this->_controlador . '/js/' . $js[$i] . '.js';
            }
        } else {
            throw new Exception('Error de js');
        }
    }
}

?>
