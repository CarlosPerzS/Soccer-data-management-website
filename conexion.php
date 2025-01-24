<?PHP
    class BaseDeDatos
    {
        private $conexion;
        public function __construct($user, $password)
        {
            $this->conexion= new mysqli('localhost','root','','integrador2');
            
        }
        public function getConexion()
        {
            return $this->conexion;
        }
        
        public function cerrarConexion()
        {
            $this->conexion->close();
        }
        
    }
?>