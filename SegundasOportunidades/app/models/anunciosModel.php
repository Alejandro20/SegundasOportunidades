<?php

class anunciosModel extends Model
{
	
    public function __construct() {
        parent::__construct();
		
    }
    
    public function getAnuncios()
    {
        $anuncio = $this->_db->query("select * from anuncios");
        return $anuncio->fetchall();
    }
	
	public function getAnunciosPropios()
    {
		$user = Session::get('id_usuario');						
        $anuncio = $this->_db->query("select * from anuncios where usuario = $user and vendido !='Vendido'");
        return $anuncio->fetchall();
    }
	
	public function getAnunciosPropiosVendidos()
    {
		$user = Session::get('id_usuario');						
        $anuncio = $this->_db->query("select * from anuncios where usuario = $user and vendido = 'Vendido'");
        return $anuncio->fetchall();
    }
    
    public function getAnuncio($id)
    {
        $id = (int) $id;
        $anuncio = $this->_db->query("select * from anuncios where id_anuncio = $id");
        return $anuncio->fetch();
    }
    
    public function insertarAnuncio($titulo, $descripcion,$precio,$imagen)
    {
        
		$user = Session::get('id_usuario');	
		$this->_db->prepare("INSERT INTO anuncios VALUES
							(null, :titulo, :descripcion,:precio,:imagen,now(),$user,' ')")
                ->execute(
                        array(
                           ':titulo' => $titulo,
                           ':descripcion' => $descripcion,
						   ':precio'=>$precio,
						   ':imagen'=>$imagen
                        ));
									
    }
    
    public function editarAnuncio($id, $titulo, $descripcion,$precio,$imagen)
    {
		$id = (int) $id;
        //$user = Session::get('id_usuario');	
        $this->_db->prepare("UPDATE anuncios SET Titulo = :titulo, Descripcion = :descripcion, Precio = :precio, Imagen = :imagen, Fecha = now() WHERE id_anuncio = :id")
                ->execute(
                        array(
                           ':id' => $id,
                           ':titulo' => $titulo,
                           ':descripcion' => $descripcion,
						   ':precio'=>$precio,
						   ':imagen'=>$imagen,
						   
                        ));
    }
	
	public function AnuncioVendido($id){
	
		$id = (int) $id;
		$vendido = "Vendido";
		
		 $this->_db->prepare("UPDATE anuncios SET Vendido = :vendido WHERE id_anuncio = :id")
		 					->execute(
									array(
									
										':id'=>$id,
										':vendido' =>$vendido
									
									)
							   );
									
	}
    
}

?>
