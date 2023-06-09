<?php 
use lib\BaseController;
use models\Usuario;
use repository\implementacion\Model;

class UsuarioController extends BaseController
{
    private Model $ModelUser;

    private string $DirectorioTxt = "public/";
    public function __construct()
    {
        parent::__construct();
        $this->NoAuth();
    }
    public function create()
    {
       //$data = "hola desde create, VISTA $saludo" ;

       $this->ModelUser = new Usuario;

       $this->View("usuario.Create");
    }

    /** Contador de vistas  */

    public function Visitas()
    {
        /// creamos el nombre del archivo txt visitas

        $NameArchivoVisitas = "visitas.txt";

        $this->DirectorioTxt.=$NameArchivoVisitas;

        /// verificar si existe el archivo visitas

        if(!file_exists($this->DirectorioTxt))
        {
            /// creamos el archivo txt visitas
            touch($this->DirectorioTxt);
        }

        /// obtener el contenido del archivo txt

        $Contenido = file_get_contents($this->DirectorioTxt);

        /// verificamos si el archivo txt esta vacio

        if(!empty($Contenido)) /// si no esta vacio
        {
          $Visitas = intval($Contenido);
        }
        else
        {
            $Visitas = 0;
        }

        /// incrementamos las vistas

        $Visitas++;

        /// actualizamos el archivo txt con el nuevo contenido

        file_put_contents($this->DirectorioTxt,$Visitas);
        
        echo file_get_contents($this->DirectorioTxt);
    }

    /// mostrar el formulario de usuarios

    public function index()
    {
        $this->ModelUser = new Usuario;
        $Usuarios = $this->ModelUser->Query()->get();
        $this->View("usuarios.index",["listado_usuarios"=>$Usuarios]);
    }

    
}