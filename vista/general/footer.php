<footer id="footer">
        <div class="row informacion-footer">

            <div class="col-d4">
                <h3>Gracias por hacer parte de esta institución</h3>
                <img src="assets/imagenes/jesusrey.jpg" width="80px" height="80px" class="circulo">
            </div>
               
            <div class="caja">
                <div class="icon"><i class="fa fa-home"></i></div>
                <div class="detalles"><h3><a href="http://www.iejesusrey.edu.co/index.php">Jesus Rey</a></h3></div>
            </div>
            <div class="caja">
                <div class="icon"><i class="fa fa-phone"></i></div>
                <div class="detalles"><h3>3044327974</h3></div>
            </div>
            <div class="caja">
                <div class="icon"><i class="fa fa-envelope"></i></div>
                <div class="detalles"><h5><a>ignaciomarin@gmail.com</a></h5></div>
            </div>

        </div>
           

        <div class="icon-pack2">
                <ul>
                    <li><a><i class="fab fa-facebook-f" aria-hidden="true"></i> </a> </li>
                    <li><a><i class="fab fa-google" aria-hidden="true"></i></a> </li>
                    <li><a><i class="fab fa-instagram" aria-hidden="true"></i></a> </li>
                    <li><a><i class="fab fa-twitter" aria-hidden="true"></i></a> </li>   
                    <li><a><i class="fab fa-tumblr" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        <div class="copy">
            <i class="fa fa-copyright"></i> DJR Juan Mosquera
        </div>
    </footer>

    <script src="assets/js/js.js"></script> 
    <script>
        if(document.getElementById('iniciar-sesion')){
            formL(0,0);
            formL(1,1);
        }
        ScrollMenu();

    </script>

    <?php 
    if(isset($menuActivate) && !empty($menuActivate)){
        switch($menuActivate['numberMenu']){
            case 2: echo "<script>menu_2(".$menuActivate['numberLink'].")</script>";
            break;
            case 3: echo "<script>menu_3(".$menuActivate['numberLink'].")</script>";
        }
    }
    
    ?>

    </body>
    </html>