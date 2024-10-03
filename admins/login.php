<?php
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link href="css/Login.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  </head>
  <body>
      
    

    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form id="loginForm" method="POST" class="sign-in-form">
            <h2 class="title">Iniciar Sesion</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required />
    
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" class="form-control" id="clave" name="clave" placeholder="Contraseña" required />
    
            </div>
         
            <button class="btn solid w-100 btn-lg btn-primary" type="button" onclick="login();">Iniciar</button>
          </form>
          
          
          <form action="" class="sign-up-form">
            <h2 class="title">Sign Up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" />
            </div>
            <input type="submit" value="Sign Up" class="btn solid" />
            <p class="social-text">Or Sign up with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
              <a href="#" class="social-icon"><i class="fab fa-google"></i></a>
              <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
            </div>
          </form>
        </div>
          
          
      </div>
      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3> </h3>
            <p></p>
            <!-- <button class="btn transparent" id="sign-up-btn">Sign Up</button> --> 
          </div>
          <img src="./img/log.png" class="image" alt="">
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us?</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio minus natus est.</p>
            <button class="btn transparent" id="sign-in-btn">Sign In</button>
          </div>
          <img src="./img/register.svg" class="image" alt="">
        </div>
      </div>
    </div>
    <script src="./js/app.js"></script>

    <script src="./js/jquery-3.6.0.js" type="text/javascript"></script>
    <script src="./js/funciones.js" type="text/javascript"></script>
  </body>
</html>
