<?php 

	class User {

		private $idRol = 2;
		private $idUsuario;
		private $docIdUsuario = 0;
	    private $nombresUsuario;
    	private $apellidosUsuario;
    	private $correoUsuario;
    	private $passUsuario;
    	private $estadoUsuario = false;

    	private $pdo;

    	function __construct(){
			$a = func_get_args();
			$i = func_num_args();
			if (method_exists($this, $f='__construct'.$i)) {
				call_user_func_array(array($this, $f), $a);
			}
		}

    	public function __construct0(){
			try {
				$this->pdo = DataBase::conexion();
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		function __construct2($correo, $pass){			
	    	$this->correoUsuario = $correo;			
	    	$this->passUsuario = sha1($pass);
		}

		function __construct8($id, $doc, $correo, $nombres, $apellidos,  
			$pass, $perfil, $estado){
			$this->idUsuario = $id;
			$this->docIdUsuario = $doc;
		    $this->nombresUsuario = $nombres;
	    	$this->apellidosUsuario = $apellidos;
	    	$this->correoUsuario = $correo;
			$this->idRol = $perfil;
	    	$this->passUsuario = $pass;
	    	$this->estadoUsuario = $estado;
		}

		public function getIdRol(){
    		return $this->idRol;
    	}

    	public function setIdRol($idRol){
    		$this->idRol = $idRol;
    	}

    	public function getIdUsuario(){
    		return $this->idUsuario;
    	}

    	public function setIdUsuario($idUsuario){
    		$this->idUsuario = $idUsuario;
    	}

    	public function getDocIdUsuario(){
    		return $this->docIdUsuario;
    	}

    	public function setDocIdUsuario($docIdUsuario){
    		$this->docIdUsuario = $docIdUsuario;
    	}

    	public function getNombresUsuario(){
    		return $this->nombresUsuario;
    	}

    	public function setNombresUsuario($nombresUsuario){
    		$this->nombresUsuario = $nombresUsuario;
    	}

    	public function getApellidosUsuario(){
    		return $this->apellidosUsuario;
    	}

    	public function setApellidosUsuario($apellidosUsuario){
    		$this->apellidosUsuario = $apellidosUsuario;
    	}

    	public function getCorreoUsuario(){
    		return $this->correoUsuario;
    	}

    	public function setCorreoUsuario($correoUsuario){
    		$this->correoUsuario = $correoUsuario;
    	}

    	public function getPassUsuario(){
    		return $this->passUsuario;
    	}

    	public function setPassUsuario($passUsuario){
    		$this->passUsuario = $passUsuario;
    	}

    	public function getEstadoUsuario(){
    		return $this->estadoUsuario;
    	}

    	public function setEstadoUsuario($estadoUsuario){
    		$this->estadoUsuario = boolval($estadoUsuario);
    	}

		/******************************************************************/
		
		// Iniciar Sesión
		public function iniciarSesion($usuario){
			try {
				# Consulta
				$sql = 'SELECT * FROM usuarios WHERE 
						usuario_correo = :usuario_correo AND
						usuario_pass = :usuario_pass';

				# Prepara la BBDD
				$dbh = $this->pdo->prepare($sql);

				// # Vincula Datos
				$dbh->bindValue('usuario_correo', $usuario->getCorreoUsuario());
				$dbh->bindValue('usuario_pass', $usuario->getPassUsuario());

				// # Ejecuta la Consulta
				$dbh->execute();

				// # Encontrar en la BBDD
				$userDb = $dbh->fetch();

				if ($userDb) {					
					# Crear Objeto
					$user = new User(
						$userDb['id_usuario'],
						$userDb['usuario_doc_identidad'],
						$userDb['usuario_correo'],
						$userDb['usuario_nombres'],
						$userDb['usuario_apellidos'],
						$userDb['usuario_pass'],
						$userDb['id_rol'],
						$userDb['usuario_estado']
					);
					return $user;
				} else {
					return false;
				}

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// Cerrar Sesión

		// Registrar
		public function registrar($usuario){
			try {
				# Consulta
				$sql = 'INSERT INTO usuarios VALUES (
							:id_rol,
							null,
							:usuario_doc_identidad,
							:usuario_nombres,
							:usuario_apellidos,
							:usuario_correo,
							:usuario_pass,
							:usuario_estado
						)';

				# Prepara la BBDD
				$dbh = $this->pdo->prepare($sql);

				# Vincula datos
				$dbh->bindValue('id_rol', $usuario->getIdRol());
				$dbh->bindValue('usuario_doc_identidad', $usuario->getDocIdUsuario());
				$dbh->bindValue('usuario_nombres', $usuario->getNombresUsuario());
				$dbh->bindValue('usuario_apellidos', $usuario->getApellidosUsuario());
				$dbh->bindValue('usuario_correo', $usuario->getCorreoUsuario());
				$dbh->bindValue('usuario_pass', $usuario->getPassUsuario());
				$dbh->bindValue('usuario_estado', $usuario->getEstadoUsuario());

				# Ejecuta la Consulta
				$stmt = $dbh->execute();
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		// Consultar
		public function listar(){
			try {
				# Crear Arreglo
				$userList = [];

				# Consulta
				$sql = $this->pdo->query('CALL mostrarUsuarios()');

				# Recorre la BBDD
				foreach ($sql->fetchAll() as $user) {
					$userList[] = new User(
						$user['id_usuario'],
						$user['usuario_doc_identidad'],
						$user['usuario_correo'],
						$user['usuario_nombres'],
						$user['usuario_apellidos'],
						$user['usuario_pass'],
						$user['id_rol'],
						$user['usuario_estado']
					);
				}

				# Retorna la Lista 
				return $userList;				

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// Actualizar I: Captura el ID del Usuario
		public function getById($id){
			try {
				# Consulta
				$sql = 'CALL obtenerUsuario(:id_usuario)';
				# Prepara la BBDD
				$dbh = $this->pdo->prepare($sql);
				# Vincula Datos
				$dbh->bindValue('id_usuario', $id);
				# Ejecuta la Consulta
				$dbh->execute();
				# Encontrar en la BBDD
				$userDb = $dbh->fetch();
				# Crear Objeto
				$user = new User(
					$userDb['id_usuario'],
					$userDb['usuario_doc_identidad'],
					$userDb['usuario_correo'],
					$userDb['usuario_nombres'],
					$userDb['usuario_apellidos'],
					$userDb['usuario_pass'],
					$userDb['id_rol'],
					$userDb['usuario_estado']
				);
				return $user;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// Actualizar II: Recibe el Objeto Usuario
		public function actualizar($usuario){
			try {
				# Consulta
				$sql = "CALL actualizarUsuario(
					:id_rol, 
					:id_usuario, 
					:usuario_doc_identidad, 
					:usuario_nombres, 
					:usuario_apellidos, 
					:usuario_correo, 
					:usuario_pass, 
					:usuario_estado 
				)";				 

				# Prepara la BBDD
				$dbh = $this->pdo->prepare($sql);

				# Vincula datos
				$dbh->bindValue('id_rol', $usuario->getIdRol());
				$dbh->bindValue('id_usuario', $usuario->getIdUsuario());
				$dbh->bindValue('usuario_doc_identidad', $usuario->getDocIdUsuario());
				$dbh->bindValue('usuario_nombres', $usuario->getNombresUsuario());
				$dbh->bindValue('usuario_apellidos', $usuario->getApellidosUsuario());
				$dbh->bindValue('usuario_correo', $usuario->getCorreoUsuario());
				$dbh->bindValue('usuario_pass', $usuario->getPassUsuario());
				$dbh->bindValue('usuario_estado', $usuario->getEstadoUsuario());

				# Ejecuta la Consulta
				$stmt = $dbh->execute();

			} catch (Exception $e) {
				die($e->getMessage());	
			}
		}

		// Eliminar
		public function eliminar($id){
			try {
				# Consulta
				$sql = 'CALL eliminarUsuario(:id_usuario)';

				# Prepara la BBDD
				$dbh = $this->pdo->prepare($sql);

				# Vincula datos
				$dbh->bindValue('id_usuario', $id);

				# Ejecuta la Consulta
				$stmt = $dbh->execute();
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
	}

?>