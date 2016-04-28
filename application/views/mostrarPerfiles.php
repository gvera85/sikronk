<?php include 'header.php' ?>

  <div class="container">

    <div class="row">
      <div class="span5 offset3 well"> <!--span4 offset4-->

        
        <h2 class="form-signin-heading">Bienvenido <?php echo $this->session->userdata('nombre'); ?></h2>
        
        <?php echo form_open('login/asignarPerfilSeleccionado') ?> <!--Controlador login, funcion asignarPerfil -->
                
            <label for="sel1" style="margin-bottom: 20px; margin-top: 15px;">Seleccione un perfil para ingresar al sistema</label>
            <select style="margin-bottom: 10px;" name='selectPerfil' class="form-control">
              <?php foreach( $perfiles as $perfil ) : ?>
                <option value=<?php echo $perfil['id_linea']."-".$perfil['id_perfil']."-".$perfil['id_empresa']."-".$perfil['empresa'] ?>><?php echo $perfil['perfil'] ?> - <?php echo $perfil['empresa'] ?></option>
                <?php endforeach; ?>
            </select>    
                
            
            
            
            <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block">Ingresar</button>
        
       
        

        </form>
      </div>
    </div>
  </div>

<?php include 'footer.php' ?>