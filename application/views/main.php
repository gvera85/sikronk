<?php $this->load->view('header') ?>
  
  <!--/.navbar -->
  <div class='w1024'>
  <div class='w980'>
      
  <div id="navcontainer">

    <div class="imagenes">
        <a href="<?php echo base_url() ?>index.php/usuario">
        <img src="../../assets/img/usuarioAzul.png" title="Usuarios" width="158" height="158" />
        </a>
        <p></p>
        <p>Usuarios</p>
    </div>

    <div class="imagenes">
        <a href="<?php echo base_url() ?>index.php/perfil">
        <img src="../../assets/img/perfilAzul.png" title="Perfiles" width="158" height="158" />
        </a>
        <p></p>
        <p>Perfiles</p>
    </div> 
      
    <div class="imagenes">
        <a href="<?php echo base_url() ?>index.php/UsuarioPerfil">
        <img src="../../assets/img/perfilUsuarioAzul.png" title="Viajes" width="158" height="158" />
        </a>
        <p></p>
        <p>Perfil/Usuario</p>
    </div>   
      
    
    <!--<div class="imagenes">
        <a href="<?php echo base_url() ?>index.php/distribuidor">
        <img src="../../assets/img/distribuidorAzul.png" title="Distribuidor" width="158" height="158" />
        </a>
        <p></p>
        <p>Distribuidor</p>
    </div>
    -->
    
    <div class="imagenes">
         <a href="<?php echo base_url() ?>index.php/cliente">
        <img src="../../assets/img/clienteAzul.png" title="Clientes" width="158" height="158" />
        </a>
        <p></p>
        <p>Clientes</p>
    </div>  
    
    <div class="imagenes">
        <a href="<?php echo base_url() ?>index.php/proveedor">
        <img src="../../assets/img/proveedorAzul.png" title="Proveedores" width="158" height="158" />
        </a>
        <p></p>
        <p>Proveedores</p>
    </div>  
    
    <!--
    <div class="imagenes">
        <a href="<?php echo base_url() ?>index.php/permiso">
        <img src="../../assets/img/permisoAzul.png" title="Permisos" width="158" height="158" />
        </a>
        <p></p>
        <p>Permisos</p>
    </div>  
    
    <div class="imagenes">
        <a href="<?php echo base_url() ?>index.php/perfilPermiso">
        <img src="../../assets/img/permisoPerfilAzul.png" title="Permisos/Perfil" width="158" height="158" />
        </a>
        <p></p>
        <p>Permisos/Perfil</p>
    </div>    
    -->
    
    <div class="imagenes">
        <a href="<?php echo base_url() ?>index.php/producto">
            <img src="../../assets/img/cajonFrutasAzul.png" title="Productos" width="158" height="158" />
        </a>
        <p></p>
        <p>Productos</p>
    </div>      
    
    <!--
    <div class="imagenes">
        <a href="<?php echo base_url() ?>index.php/vl">
            <img src="../../assets/img/vlAzul.png" title="Variables logisticas" width="158" height="158" />
        </a>
        <p></p>
        <p>Variables logisticas</p>
    </div>        
     --> 

        
      
  </div>    
   
  </div> <!--  <div class='w980'> -->
  </div> <!--  <div class='w1024'> -->



  <!-- ****************************************************************** -->
  <!--                        NEW USER Modal Window                       -->
  <!-- ****************************************************************** -->
  
  <div class="modal hide" id="myModal">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">x</button>
      <h3>Nuevo usuario</h3>
    </div>
    <div class="modal-body">
        <p><input type="text" class="span4" name="first_name" id="first_name" placeholder="Nombre"></p>
        <p><input type="text" class="span4" name="last_name" id="last_name" placeholder="Apellido"></p>
        <p><input type="text" class="span4" name="email" id="email" placeholder="Correo electrónico"></p>
        <p><input type="password" class="span4" name="password" id="password" placeholder="Contraseña"></p>
        <p><input type="password" class="span4" name="password2" id="password2" placeholder="Confirme contraseña"></p>
        
    
    </div>
    
    <div class="modal-footer">
      <a href="#" class="btn btn-warning" data-dismiss="modal">Cancelar</a>
      
      <a href="<?php echo base_url() ?>/index.php/usuario/agregar_usuario" id="btnModalSubmit" class="btn btn-primary">Crear</a>
    
    </div>
  </div>
  
  
  
<?php $this->load->view('footer') ?>