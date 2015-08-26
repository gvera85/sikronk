<?php $this->load->view('header') ?>
  
  <!--/.navbar -->
  <div class='w1024'>
  <div class='w980'>
      
  <div>

               
    <?php if ($hayMenu)
    {
    
        foreach( $menues as $menu ) : ?> 
                
                
        <div class="imagenes" >
            <a href="
                <?php if ($menu['cant_hijos'] == 0) 
                            echo base_url()."index.php/main/redireccionarControlador/".$menu['controlador']; 
                      else 
                            echo base_url()."index.php/main/recargarMenu/".$menu['id_menu'];  ?>">
            <img src="<?php echo base_url()."assets/img/".$menu['path_icono']?>" title="<?php echo $menu['descripcion']?>" width="158" height="158" />
            </a>
            <p></p>
            <p><?php echo $menu['descripcion']; ?>   </p>
        </div>
      
    <?php 
        endforeach; 
    }
    else 
    {?>
        <div class="imagenes" >
            <p> No tiene permisos para acceder a ningún punto de este menú</p>            
        </div>
    <?php
    }
    ?>   
    
        

  </div>
      
  <div id="navcontainer" style="display:none;">    
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
      
    <div class="imagenes">
         <a href="<?php echo base_url() ?>index.php/tipo_empresa">
        <img src="../../assets/img/tipoEmpresaAzul.png" title="Tipos de empresa" width="158" height="158" />
        </a>
        <p></p>
        <p>Tipos de empresas</p>
    </div>    
            
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
    
    
    <div class="imagenes">
        <a href="<?php echo base_url() ?>index.php/producto">
            <img src="../../assets/img/cajonFrutasAzul.png" title="Productos" width="158" height="158" />
        </a>
        <p></p>
        <p>Productos</p>
    </div>      
    

     
    <div class="imagenes">
         <a href="<?php echo base_url() ?>index.php/perfil_proveedor">
        <img src="../../assets/img/perfilProveedorAzul.png" title="Perfiles de proveedores" width="158" height="158" />
        </a>
        <p></p>
        <p>Perfiles de proveedores</p>
    </div>  
     
    <div class="imagenes">
         <a href="<?php echo base_url() ?>index.php/perfil_cliente">
        <img src="../../assets/img/perfilClienteAzul.png" title="Perfiles de clientes" width="158" height="158" />
        </a>
        <p></p>
        <p>Perfiles de clientes</p>
    </div>  
     
    <div class="imagenes">
         <a href="<?php echo base_url() ?>index.php/perfil_distribuidor">
        <img src="../../assets/img/perfilDistribuidorAzul.png" title="Perfiles de distribuidor" width="158" height="158" />
        </a>
        <p></p>
        <p>Perfiles de distribuidores</p>
    </div>   
     
    <div class="imagenes">
         <a href="<?php echo base_url() ?>index.php/usuario_perfil_proveedor">
        <img src="../../assets/img/UsuarioperfilProveedorAzul.png" title="Usuarios/Perfiles/Proveedores" width="158" height="158" />
        </a>
        <p></p>
        <p>Usuarios / Perfiles / Proveedores</p>
    </div>  
     
    <div class="imagenes">
         <a href="<?php echo base_url() ?>index.php/usuario_perfil_cliente">
        <img src="../../assets/img/UsuarioperfilClienteAzul.png" title="Usuarios/Perfiles/Clientes" width="158" height="158" />
        </a>
        <p></p>
        <p>Usuarios / Perfiles / Clientes</p>
    </div>  
     
    <div class="imagenes">
         <a href="<?php echo base_url() ?>index.php/usuario_perfil_distribuidor">
        <img src="../../assets/img/UsuarioperfilDistribuidorAzul.png" title="Usuarios/Perfiles/Distribuidores" width="158" height="158" />
        </a>
        <p></p>
        <p>Usuarios / Perfiles / Distribuidores</p>
    </div>       

    <div class="imagenes">
         <a href="<?php echo base_url() ?>index.php/viaje">
        <img src="../../assets/img/viajeAzul.png" title="Viajes" width="158" height="158" />
        </a>
        <p></p>
        <p>Viajes</p>
    </div>      
     
    <div class="imagenes">
         <a href="<?php echo base_url() ?>index.php/viajeVL">
        <img src="../../assets/img/viajeProductoAzul.png" title="Viajes/VL" width="158" height="158" />
        </a>
        <p></p>
        <p>Viajes/VL</p>
    </div>  
     
    <div class="imagenes">
         <a href="<?php echo base_url() ?>index.php/menu">
        <img src="../../assets/img/menuAzul.png" title="Menu" width="158" height="158" />
        </a>
        <p></p>
        <p>Menu</p>
    </div> 
     
      
  </div>    
   
  </div> <!--  <div class='w980'> -->
  </div> <!--  <div class='w1024'> -->
  
<?php $this->load->view('footer') ?>