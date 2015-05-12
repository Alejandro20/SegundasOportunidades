<?php

	class administradorModel extends Model{
		
		public function __construct(){
			
			parent::__construct();
			
		}
		
		public function getAnuncios(){
        	
			$administrar = $this->_db->query("select * from anuncios");
        
			return $administrar->fetchall();
    	}
		
		public function getUsuarios(){
        	
			$administrar = $this->_db->query("select * from usuarios");
        
			return $administrar->fetchall();
    	}
		
		public function eliminarUsuario($id){
			
			$id = (int) $id;
			
			$this->_db->query("DELETE FROM usuarios WHERE id_user = $id");
			
		}
		
		public function eliminarAnuncio($id){
			
			$id = (int) $id;
			
			$this->_db->query("DELETE FROM anuncios WHERE id_anuncio = $id");
			
		}
		
		
		
	}
