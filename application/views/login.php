<?php include 'header.php' ?>

  <div class="container">

        <h2 class="form-signin-heading">Bienvenido</h2>

        <?php if (isset($error) && $error): ?>
          
          <div class="alert alert-danger">
          <?php echo $mensaje; ?>
          </div>              
            
        <?php endif; ?>

        <?php echo form_open('login/login_user') ?> <!--Controlador login, funcion login_user -->

            <label for="inputEmail" class="sr-only">Email address</label>    
            <input type="email" id="email" class="form-control" name="email" placeholder="Correo electronico" required autofocus>
            
            <label for="inputPassword" class="sr-only">Contraseña</label>
            <input type="password" id="password" class="form-control" name="password" placeholder="Contraseña" required>
            
            <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Recordarme
              </label>
            </div>
            
            <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block">Ingresar</button>
            
             
            
        <!--<label class="checkbox">
          <input type="checkbox" name="remember" value="1"> Remember Me
        </label>-->
        
        </form>
      
  </div>

<?php include 'footer.php' ?>