<?php 
	// Clase
	class Person {
		// Atributos
		public $firstName = 'Juan';
		public $lastName = 'Ramírez';
		private $dateOfBirth = '1990-12-01';

		// Métodos
		# Devuelve el Nombre y el Apellido
		public function fullName() { 
			return $this->firstName . ' ' . $this->lastName; 
		}
		# Devuelve la edad calculando el año de nacimiento
		public function age() { 
			$age = ''; 
			// Calcular la edad usando $this->dateOfBirth...
			return $age; 
		}
	}
?>