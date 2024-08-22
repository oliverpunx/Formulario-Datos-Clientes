<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización de datos</title>
    <script src="js/utilidades.js"></script>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <style>
        h1,h2{
            border-left: solid 10px #ff8c00;
            margin: 10px;
            padding: 10px;
            color:  #ff8c00;
            font-weight: bold;
            margin: 2px;
        }

        #mensaje{
            margin: 2px;
        }

        #lblCodigo{
            font-weight: bold;
        }
            
        #btnCodigo{
            color: white;
            font-weight: bold;
        }

        #mensaje,#btnSubmit,#lblCodigo,#codigo,#msgError{
            display: none;
        }

        #msgBusqueda{
            text-align: center;
            font-weight: bold;
            margin-top:20px;
            color: red;
        }

        #msgOk{
            color: green;
        }

        .imgLogo{
            max-width: 150px;
            min-width: 60px;
            aspect-ratio: 16/9;
            margin: 2px;
        }

        input:invalid { border-color: red; } input, input:valid { border-color: #ccc; }        
    </style>
<div class="container-fluid">
    <div class="container-sm w-50">
        <div class="row">
            <div class="col-xs-12 col-sm-4 p-4">
                <img class="imgLogo" src="imagenes/lhlogo.png" />
            </div>

            <div class="col-xs-12 col-sm-8 p-4">
                <h2 align="center">Actualización de Datos</h2>
            </div>
        </div>
    </div>

    <div class="container-sm" id="msgBusqueda">
         <div class="col w-100">
              <p align='center' id="msgOk"> 
                <?php 
                    if(isset($vars["mensajeOk"])){
                       echo $vars["mensajeOk"];
                    }
                ?>
              </p>
              <p align='center' id="msgconsulta"> 
              <?php 
                if(isset($vars["mensaje"])){
                  echo $vars["mensaje"];
                }

                if(isset($vars["enviado"])){
                    echo $vars["enviado"];
                  }                
              ?>
              </p>

              <?php
                if(isset($vars["link"])){
                    echo $vars["link"];
                  }               
              ?>
         </div> 
    </div>   

    <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']."?controlador=frmdatos"); ?>">
        <div class="container-sm w-50">
            <div class="row">
                <label class="label-control m-2" for="ruc" ># Identificación:</label>
                <input class="form-control m-2" name="ruc" required id="ruc" type="number" min="0000000000000" max="9999999999999" />
            </div>
            
            <div class="row">
                <label class="label-control m-2" for="correo">Correo:</label>
                <input class="form-control m-2" name="correo" id="correo" type="email" required />  
            </div>
   
            <div class="row">
                <label class="label-control m-2" id="lblCodigo" for="codigo">Clave de acceso:</label>
                <input class="form-control m-2" name="codigo" id="codigo" type="number" size="5" min="00000" max="99999" placeholder="Ingrese la clave de acceso que se envió a su correo" />              
            </div>

            <div class="row" id="mensaje">
                <div class="alert alert-success w-100">
                    <p id="respCorreo">
                        <?php 
                            if(isset($vars["enviado"])){
                                echo "<p align='center'>".$vars["enviado"]."</p>";
                            }
                        ?>                    
                    </p>
                </div> 
            </div>

            <div class="row w-100" id="msgError">
                <div class="alert alert-danger w-100">
                    Debe ingresar los campos obligatorios.
                </div> 
            </div>            
        </div>    

        <div class="container-sm w-50">
            <div class="container-fluid">
                 <div class="row"> 
                      <button class="btn btn-info m-2" href="#" id="btnCodigo">Enviar código</button>
                 </div>
                 
                 <div class="row">
                    <input type="submit" class="btn btn-success m-2" id="btnSubmit" value="Ir a Formulario" />                    
                </div>
            </div>
        </div>
    </form>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
    <script src="js/home.js"></script>    
</body>
</html>