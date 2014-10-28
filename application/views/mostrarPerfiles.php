<?php include 'header.php' ?>

  <div class="container">

    <div class="row">
      <div class="span5 offset3 well"> <!--span4 offset4-->

        <legend>Bienvenido <?php echo $this->session->userdata('nombre'); ?></legend>
        
        <?php echo form_open('login/asignarPerfilSeleccionado') ?> <!--Controlador login, funcion asignarPerfil -->
                
            <div class="alert alert-error">
            Seleccione un perfil para ingresar al sistema
            </div>
        
            <select name='selectPerfil' class='chosen-select span5' data-placeholder='Seleccionar perfil' >
                
            <?php foreach( $perfiles as $perfil ) : ?>
                <option value=<?php echo $perfil['id_perfil']."-".$perfil['id_empresa']."-".$perfil['empresa'] ?>><?php echo $perfil['perfil'] ?> - <?php echo $perfil['empresa'] ?></option>
            <?php endforeach; ?>
            </select>				
        <BR> 
            <button type="submit" name="submit" class="btn btn-info btn-block">Ingresar</button>
        
       
        

        </form>
      </div>
    </div>
  </div>

<?php include 'footer.php' ?>