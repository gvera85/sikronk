<?php include 'header.php' ?>

  <div class="container">

    <div class="row">
      <div class="span5 offset3 well"> <!--span4 offset4-->

        <legend>Bienvenido <?php echo $this->session->userdata('nombre'); ?></legend>

        <?php if (isset($error) && $error): ?>
          <div class="alert alert-error">
            <a class="close" data-dismiss="alert" href="#">×</a><?php echo $mensaje; ?>
          </div>
        <?php endif; ?>

        <?php echo form_open('login/login_user') ?> <!--Controlador login, funcion login_user -->

            <input type="text" id="email" class="span5" name="email" placeholder="Correo electronico">
            <input type="password" id="password" class="span5" name="password" placeholder="Contraseña">
            <button type="submit" name="submit" class="btn btn-info btn-block">Ingresar</button>
        <!--<label class="checkbox">
          <input type="checkbox" name="remember" value="1"> Remember Me
        </label>-->
        
        </form>
      </div>
    </div>
  </div>

<?php include 'footer.php' ?>