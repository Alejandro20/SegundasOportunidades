<?php

class indexController extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        $anuncio = $this->loadModel('anuncios');
        
        $this->_view->anuncios = $anuncio->getAnuncios();
        
        $this->_view->titulo = 'Portada';
        $this->_view->renderizar('index', 'inicio');
    }
}

?>