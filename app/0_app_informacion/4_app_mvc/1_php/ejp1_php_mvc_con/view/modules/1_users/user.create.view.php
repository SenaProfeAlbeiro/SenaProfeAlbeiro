<!-- Migas de Pan -->
<div class="row">
	<div class="col p-0">
		<div aria-label="breadcrumb">
			<ol class="breadcrumb rounded-0 m-0 p-2">
				<li class="breadcrumb-item"><a href="?c=DashboardAdmin">Inicio</a></li>
				<li class="breadcrumb-item">Módulo Usuarios</li>
				<li class="breadcrumb-item active" aria-current="page">Crear Usuario</li>
			</ol>
		</div>
	</div>
</div>

<!-- Título -->
<div class="titulo row">
	<div class="col p-2 border-bottom d-flex">
		<div class="col-7 p-0 d-flex justify-content-start align-items-center">
			<h5 class="m-0">Crear Usuario</h5>
		</div>
		<div class="col-5 d-flex justify-content-end align-items-center p-0">
			<a href="?c=Users&a=consultar" class="btn btn-primary">Consultar Usuarios</a>
		</div>				
	</div>
</div>

<!-- Área Principal -->
<div class="section-pg row">
	<div class="col p-2 bg-light">
		<form id="crear_usuario" class="card p-3 bg-white d-lg-flex justify-content-center w-100 border rounded p-2">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="doc_identidad">Documento de Identidad</label>
					<input type="text" class="form-control" id="doc_identidad" placeholder="123456789">
				</div>
				<div class="form-group col-md-6">
					<label for="correo">E-Mail</label>
					<input type="email" class="form-control" id="correo" placeholder="usuario@correo.com">							
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="nombres">Nombres</label>
					<input type="text" class="form-control" id="nombres" placeholder="Nombres">
				</div>
				<div class="form-group col-md-6">
					<label for="apellidos">Apellidos</label>
					<input type="text" class="form-control" id="apellidos" placeholder="Apellidos">
				</div>
			</div>										
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="contrasena_us">Contraseña</label>
					<input type="password" class="form-control" id="contrasena_us" placeholder="Entre 5 y 8 caracteres">
				</div>
				<div class="form-group col-md-6">
					<label for="confirmacion">Confirmación</label>
					<input type="password" class="form-control" id="confirmacion" placeholder="Confirmar contraseña">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="perfil_usuario">Perfil</label>
					<select class="form-control" id="perfil">
				      <option>administrador</option>
				      <option>empleado</option>
				      <option>cliente</option>
				    </select>
				</div>
				<div class="form-group col-md-6">
					<label for="estado">Estado</label>
					<select class="form-control" id="estado">
				      <option>activo</option>
				      <option>inactivo</option>
				    </select>
				</div>
			</div>
			<button type="submit" class="btn btn-primary mb-2">Enviar</button>
			<button type="button" class="btn btn-dark" data-dismiss="modal" id="cerrar">Cerrar</button>						
		</form>
	</div>
</div>