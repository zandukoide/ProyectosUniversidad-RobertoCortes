
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Universidad</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710;
}
.background{
    width: 650px; 
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
    margin: 0 auto; 
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    display: inline-block; 
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
    width: 30%; 
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
select{
    display: block;
    color: #cccccc; 
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
button[type="submit"] {
    display: block;
    width: 100%;
    height: 50px;
    background-color: #23a2f6; 
    color: #ffffff;
    border-radius: 3px;
    font-size: 14px;
    font-weight: 500;
    margin-top: 20px;
    cursor: pointer;
}
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
    color: #cccccc; 
}
::placeholder{
    color: #e5e5e5;
}
}
button{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}

.social i{
  margin-right: 4px;
}
</style>
</head>
<body>
    <div class="background" style="display: flex;">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="procesar_registro.php" method="POST">
        <h3>Regístrate</h3>
        <label for="nombre">Nombre:</label>
        <input type="text" placeholder="Nombre del Individuo" name="nombre" required><br>

        <label for="usuario">Usuario:</label>
        <input type="text" placeholder="Usuario" name="usuario" required><br>

        <label for="contraseña">Contraseña:</label>
        <input type="password" placeholder="Contraseña" name="contraseña" required><br> 

        <label for="rol">Rol:</label>
        <select name="rol" required>
            <option value="1">Profesor</option>
            <option value="2">Estudiante</option>
        </select><br>
        <button type="submit">Regístrate</button>
        <div class="social">
            <p>¿Ya tienes cuenta? </p>
            <span style="margin-right: 5px;"></span><a href="login.php">Inicia Sesión</a>
        </div>
    </form>
</body>
    </html>
