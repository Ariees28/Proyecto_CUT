<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<link rel="stylesheet" href="../styles/css/slider2.css">
<script src="../js/creados/ContenedorEscritorio.js"></script>
<div class="app-main__inner" id="ContenedorPrincipal" style="background-image: url(../images/nebulosa.jpg);">

    <div class='card-group mt-4 mb-4'>
        <div class='card'>
            <div class="card-body">
                <h3 id="frase"></h3>
                <p id="fuente" style='font-size: 18px;'></p>
            </div>
        </div>
        <div class='card'>
            <?php
            if($_SESSION["verificado"] == "0"){
            ?>
            <div class='card-body'>
                <h1 class="text-danger">TU CORREO NO ESTÁ VERIFICADO</h1>
                <p style='font-size: 20px;'>Para acceder a la funcionalidad de prestamos de libros, es necesario que verifiques tu correo electronico. Para ello, dirijete al apartado de cuenta y solicita la verificación</p>
            </div>
            <?php }else{?>
            <div class='card-body'>
                <h1 class="text-success">CORREO VERIFICADO</h1>
                <p style='font-size: 20px;'>Ya haz verificado tu correo, puedes acceder al módulo de consulta de libros y solicitar el prestamo de un libro</p>
            </div>
            <?php }?>
        </div>
    </div>

    <div class="card mt-4 mb-4">
        <div class="card-body">
        <?php echo "<h1>TE DAMOS LA BIENVENIDA, ".$_SESSION["nombre"].",</h1>" ?>
        <h2>A Biblioteca Andromeda, La Galaxia Del Conocimiento.</h2>
        <p style='font-size: 25px;'>Aquí encontrarás muchos libros de índole tanto de estudio como novelas literarias, puedes acceder a la consulta de libros y a la lista de tus prestamos desde el menú de la izquierda.</p>
        </div>
        
    </div>
    
    <div class="card">
        <div class="slider-container">
            <div class="slider">
                <div class="slide active">
                    <img src="../../files/generos/Literatura.jpg" alt="">
                    <div class="info">
                        <h2>LITERATURA Y NOVELAS</h2>
                        <p>La novela es la obra por excelencia del género narrativo y se distingue por su extensión y profundidad en torno al desarrollo de situaciones, personajes y el uso de recursos literarios.</p>
                        <button type="button" id="btnLit" class="mb-2 mr-2 btn btn-success">Lista de libros</button>
                    </div>
                </div>
                <div class="slide">
                    <img src="../../files/generos/medicina.jpg" alt="">
                    <div class="info">
                        <h2>MEDICINA</h2>
                        <p>Medicina es la 'ciencia de la sanación' o práctica del diagnóstico, tratamiento y prevención de alguna enfermedad, infección o dolencia. Medicina también es sinónimo de medicamento o remedio.</p>
                        <button type="button" id="btnMed" class="mb-2 mr-2 btn btn-success">Lista de libros</button>
                    </div>
                </div>
                <div class="slide">
                    <img src="../../files/generos/Derecho.jpg" alt="">
                    <div class="info">
                        <h2>DERECHO</h2>
                        <p>El derecho es el conjunto de principios y normas, generalmente inspirados en ideas de justicia y orden, que regula las relaciones humanas en toda sociedad y cuya observancia puede ser impuesta de forma coactiva por parte de un poder público.</p>
                        <button id="btnDer" class="mb-2 mr-2 btn btn-success">Lista de libros</button>
                    </div>
                </div>
                <div class="navigation">
                    <i class="fas fa-chevron-left prev-btn"></i>
                    <i class="fas fa-chevron-right next-btn"></i>
                </div>
                <div class="navigation-visibility">
                    <div class="slide-icon active"></div>
                    <div class="slide-icon"></div>
                    <div class="slide-icon"></div>
                </div>
            </div>
        </div>
    </div>

    
</div>

