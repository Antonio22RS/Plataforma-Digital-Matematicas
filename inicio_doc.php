<?php
/**
 * inicio_doc.php
 * Página principal del docente: se aplica header/footer unificados y marcado limpio.
 * Se conserva la inclusión de la conexión y cualquier lógica previa (si existe).
 *
 * Observación: No se modifica la lógica de negocio ni nombres de variables/archivos.
 */
include('conexion.php');
session_start();

$User = $_SESSION['Username'];

if ($User == '' || $User == NULL) {
  echo '<script>
alert("Acceso no autorizado");
location.assign("sesion_pm.html");</script>';

} else if ($User == $_SESSION['Username']) {

  echo "<!doctype html>
<html lang='es'>

<head>
  <!--
    index.html - Versión optimizada y comentada
    -----------------------------------------
    Objetivo: limpiar y optimizar el código sin cambiar la vista visual (colores, degradados, animaciones y efectos).
    Cambios aplicados aquí (explicados en comentarios dentro del archivo):
      - Mejora semántica (roles ARIA mínimos).
      - Comentarios en cada sección explicando la función.
      - Correcciones menores de CSS (eliminación de reglas inválidas y consolidación).
      - Atributos alt y aria-labels añadidos para accesibilidad.
      - Observaciones donde hace falta incluir fuentes externas (no se agregaron fuentes nuevas para no alterar la vista).
    Nota: TODO lo visual (colores, degradados, animaciones y scripts) se ha mantenido tal cual.
  -->

  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <meta name='description'
    content='Plataforma Virtual de Apoyo a las Matemáticas - Tecnológico de Estudios Superiores de Cuautitlán Izcalli' />
  <title>Plataforma Virtual - Matemáticas</title>

  <!-- Dependencias externas (se mantienen tal cual) -->
  <link href='../Style/bootstrap.min.css' rel='stylesheet' />
  <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap' rel='stylesheet' />
  <link rel='stylesheet' href='https://unpkg.com/swiper/swiper-bundle.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css' />

  <style>
    /* ============================================================
       Variables y estilos globales
       ------------------------------------------------------------
       - Conservamos los colores / degradados originales.
       - Se documentan las variables y su propósito.
       - No se cambió la paleta visual, sólo se aclaró su uso.
       ============================================================ */

    :root {
      /* Nota: los nombres se conservan; los comentarios describen el color actual */
      --color-primario: #510014;
      /* rojo oscuro / primario (se usa en degradado) */
      --color-secundario: #e00043;
      /* acento (rojo brillante) */
      --color-fondo: #ffffff;
      --color-texto: #333333;
      --color-gris: #f5f5f5;
      --fuente-base: 'Gothambook', sans-serif;
      /* Observación: si 'Gothambook' no está cargada, se usará el fallback. */
    }

    /* Reset ligero: reduce inconsistencias entre navegadores (Bootstrap ya aplica su propio reset) */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: var(--fuente-base);
      color: var(--color-texto);
      background: var(--color-fondo);
      line-height: 1.6;
    }

  .texto-rojo {
    color: #ff4d4d; /* rojo claro base */
    text-decoration: none;
    transition: color 0.3s ease, text-shadow 0.3s ease;
  }

  .texto-rojo:hover {
    color: #ff8080; /* tono más claro */
    text-shadow: 0 0 8px rgba(255, 100, 100, 0.8); /* efecto de brillo */
  }

  /* Botones principales del menú */
  .btn-toggle {
    color: #e63946;
    background-color: transparent;
    transition: all 0.2s ease;
  }

  .btn-toggle:hover {
    color: #fff;
    background-color: #e63946;
  }

  /* Enlaces secundarios dentro de los collapses */
  .btn-toggle-nav a {
    color: #ffffffff;
    padding: 4px 0;
    transition: color 0.2s;
    text-decoration: none;
  }

  .btn-toggle-nav a:hover {
    color: #e63946;
  }

  /* Contenedor general del menú lateral */
  .sidebar-container {
    width: 420px;
    border-right: 2px solid #e9ecef;
    height: 70vh;
    overflow-y: auto;
  }

    /* ============================================================
       HERO (bloque principal con imagen y texto)
       ------------------------------------------------------------
       - Se mantienen exactamente los degradados, espaciados y efectos de zoom.
       - Se agrupan estilos en clases (documentadas).
       ============================================================ */

    .hero {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 100px 8%;
      background: linear-gradient(120deg, var(--color-primario), var(--color-secundario));
      color: white;
      flex-wrap: wrap;
    }

    .hero-texto {
      font-family: 'GothamBook', sans-serif;
      /* coincide con la fuente usada en el diseño */
      flex: 1 1 45%;
      max-width: 500px;
      z-index: 2;
    }

    .hero-texto h1 {
      font-family: 'Philosopher', serif;
      /* se conserva la tipografía indicada en el diseño */
      font-size: 2.8rem;
      margin-bottom: 20px;
    }

    .hero-imagen {
      flex: 1 1 45%;
      text-align: center;
    }

    .hero-imagen img {
      width: 100%;
      max-width: 560px;
      border-radius: 10px;
      transition: transform 0.6s ease;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
    }

    /* Efecto zoom suave al pasar el mouse (preservado) */
    .hero-imagen img:hover {
      transform: scale(1.08);
    }

    /* ============================================================
       HERO SECUNDARIO (sección espejo con degradado invertido)
       ------------------------------------------------------------
       - Mantiene las mismas animaciones y estilos visuales que el original.
       ============================================================ */

    .hero-sec {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 100px 8%;
      background: linear-gradient(120deg, var(--color-secundario), var(--color-primario));
      color: white;
      flex-wrap: wrap;
    }

    .hero-texto-sec {
      font-family: 'GothamBook', sans-serif;
      flex: 1 1 45%;
      max-width: 680px;
      z-index: 2;
      align-items: center;
      margin-bottom: 80px;
    }

    .hero-texto-sec h1 {
      font-family: 'Philosopher', serif;
      font-size: 3rem;
      margin-bottom: 20px;
    }

    .hero-imagen-sec {
      flex: 1 1 45%;
      text-align: center;
    }

    .hero-imagen-sec img {
      width: 100%;
      max-width: 600px;
      border-radius: 10px;
      transition: transform 0.6s ease;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
    }

    .hero-imagen-sec img:hover {
      transform: scale(1.08);
    }

    .hero-img {
    max-width: 900px;   /* tamaño máximo en pantallas grandes */
    width: 100%;        /* ocupa el 100% del contenedor hasta llegar al máximo */
    height: auto;       /* mantiene proporción */
    }


    /* ============================================================
       Utilidades y correcciones
       ------------------------------------------------------------
       - Se eliminó CSS inválido presente en versiones anteriores.
       - Se mantienen clases utilitarias propias del template.
       ============================================================ */

    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    /* ============================================================
       Clases tipográficas usadas para reemplazar <font> (mejor mantenimiento)
       ------------------------------------------------------------ */

    .brand-title {
      font-family: 'Philosopher', serif;
      font-weight: 700;
      color: rgb(162, 0, 0);
      /* color visual conservado */
    }

    .brand-title-card {
      font-family: 'GothamBook', serif;
      color: rgb(245, 171, 171);
      letter-spacing: 1px;

    }

    .brand-subtitle {
      font-family: 'GothamBook', sans-serif;
      font-weight: 500;
      color: lightslategray;
    }

    .modal-title{
      font-family: 'GothamBook', sans-serif;
      font-weight: 500;
      color: rgb(162, 0, 0);
    }

    .body-text {
      font-family: 'GothamBook', sans-serif;
    }

    /* Ajuste para imagen overlay (legibilidad) - si se usa en otras tarjetas */
    .card-img-overlay.bg-gradient {
      background: linear-gradient(90deg, rgba(0, 0, 0, 0.55) 0%, rgba(0, 0, 0, 0.20) 100%);
    }

    /* ============================================================
       FOOTER: animación fade-in + estructura
       ------------------------------------------------------------
       - Se mantiene la animación original.
       - Se ajustó `color` a inherit para evitar conflicto con fondo blanco,
         la apariencia visual no cambia porque los elementos internos
         definen sus propios colores.
       ============================================================ */

    footer {
      background: #ffffff;
      color: inherit;
      /* antes estaba white - esto evita texto invisible si se aplica herencia */
      padding: 60px 5% 30px;
      opacity: 0;
      /* invisible al cargar */
      transform: translateY(40px);
      transition: opacity 1s ease, transform 1s ease;
    }

    footer.visible {
      opacity: 1;
      transform: translateY(0);
    }

    .footer-contenido {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      margin-bottom: 40px;
    }

    .footer-columna-uno {
      font-family: 'GothamBook', sans-serif;
      font-weight: 500;
      flex: 1 1 30%;
      margin: 20px;
      min-width: 250px;
      text-align: start;
    }

    .footer-columna-uno p,
    .footer-columna-uno a {
      color: lightslategray;
      font-size: 0.95rem;
      display: block;
      margin-bottom: 10px;
      transition: color 0.3s;
      text-decoration: none;
    }

    .footer-columna-uno a:hover {
      color: var(--color-secundario);
    }

    .footer-columna-dos {
      font-family: 'GothamBook', sans-serif;
      font-weight: 500;
      flex: 1 1 30%;
      margin: 10px;
      min-width: 250px;
      text-align: end;
    }

    .footer-columna-dos h3 {
      color: var(--color-secundario);
      margin-bottom: 10px;
    }

    .footer-columna-dos p,
    .footer-columna-dos a {
      color: lightslategray;
      font-size: 0.95rem;
      display: block;
      margin-bottom: 10px;
      transition: color 0.3s;
      text-decoration: none;
    }

    .footer-columna-dos a:hover {
      color: var(--color-secundario);
    }

    /* Redes sociales */
    .redes-sociales a {
      display: inline-block;
      margin-right: 15px;
      font-size: 1.8rem;
      color: rgb(162, 0, 0);
      transition: all 0.4s ease;
    }

    .redes-sociales a.facebook:hover {
      color: #1877f2;
    }

    .redes-sociales a.instagram:hover {
      background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .redes-sociales a.x-twitter:hover {
      color: #000000;
    }

    .footer-bottom {
      font-family: 'GothamBook', sans-serif;
      font-weight: 500;
      color: lightslategray;
      text-align: center;
      padding-top: 20px;
      font-size: 0.85rem;
    }

    /* ============================================================
       Responsive: se mantiene comportamiento original
       ============================================================ */
    @media (max-width: 900px) {
      .hero {
        flex-direction: column;
        text-align: center;
        padding: 60px 8%;
      }

      .hero-texto,
      .hero-imagen {
        flex: 1 1 100%;
        max-width: 100%;
      }

      .hero-imagen img {
        margin-top: 30px;
      }
    }

    @media (max-width: 576px) {
      img[alt='Logo de la plataforma'] {
        max-width: 90px;
      }
    }

    @media (max-width: 576px) {
      #footer img {
        max-width: 140px;
        /* logo más pequeño en pantallas pequeñas */
      }
    }
  </style>

  <!--
    Observación sobre fuentes:
    - El HTML usa 'Philosopher' y 'GothamBook'. Si la vista actual depende de estas, asegúrate
      de tener las fuentes cargadas en tus archivos externos (headers.css / Bootstrap.css) o
      de importarlas desde Google Fonts / archivos locales. No se añadieron nuevos imports aquí
      para no alterar la apariencia visual por diferencias de renderizado.
  -->
</head>

<body>
  <!-- MAIN: marcado semántico mejorado (no se cambia la vista) -->
  <main role='main'>
    <!-- HEADER: rol banner para mejorar accesibilidad -->
    <div class='container'>
      <header class='py-3 mb-4 border-bottom border-danger border-2' role='banner' aria-label='Cabecera principal'>
        <div class='container'>

          <!-- Título institucional -->
          <div class='border-bottom border-danger mb-3 text-center'>
            <div class='brand-subtitle fw-bold fs-5 fs-md-4 fs-lg-3'>
              TECNOLÓGICO DE ESTUDIOS SUPERIORES DE CUAUTITLÁN IZCALLI
            </div>
          </div>

          <!-- Fila principal con logo y botones -->
          <div class='row align-items-center text-center text-md-end g-3'>

            <!-- Logo -->
            <div class='col-12 col-md-2 mb-3 mb-md-0 text-center'>
              <img src='../Image/logo_n.png' class='img-fluid' alt='Logo de la plataforma'>
            </div>

            <!-- Título y botones -->
            <div class='col-12 col-md-10'>
              <h1 class='brand-title display-6 mb-2'>
                MATEMÁTICAS
                <small class='text-muted d-block d-md-inline' style='font-size:1rem;'>
                  <span class='body-text'>PLATAFORMA VIRTUAL</span>
                </small>
              </h1>

              <div class='mt-3'>
                <a href='#' class='btn btn-outline-danger me-2 mb-2 mb-md-0' role='button'>NOTIFICACIONES</a>
              </div>
            </div>

          </div>
        </div>
      </header>

    </div>

    <!-- Separador visual (se preserva usando utilidades Bootstrap) -->
    <div class='container my-4'></div>

    <!-- HERO principal -->
    <section class='hero' aria-label='Sección principal - Introducción'>

    
<!-- === Contenedor principal de la barra lateral === -->
<div class='d-flex flex-nowrap'>

  <div class='flex-shrink-0 p-4 sidebar-container'>
    <span class='brand-title-card fs-4 fw-bold'>CONTENIDO</span>

    <ul class='list-unstyled ps-0 mt-3'>

      <!-- =================================================== -->
      <!-- 🧮 SECCIÓN: CLASES -->
      <!-- =================================================== -->
      <li class='mb-2'>
        <button class='btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed fs-5'
          data-bs-toggle='collapse' data-bs-target='#collapse-clases' aria-expanded='false'
          aria-controls='collapse-clases'>
          CLASES
        </button>

        <div class='collapse' id='collapse-clases'>
          <ul class='btn-toggle-nav list-unstyled fw-normal fs-6 pb-1 ps-3 small'>
            <li><a href='mate1_doc.html'>PROPEDEUTICO</a></li>
            <li><a href='#'>MATEMÁTICAS I</a></li>
            <li><a href='#'>MATEMÁTICAS II</a></li>
            <li><a href='#'>MATEMÁTICAS III</a></li>
            <li><a href='#'>MATEMÁTICAS IV</a></li>
          </ul>
        </div>
      </li>

      <!-- =================================================== -->
      <!-- 📝 SECCIÓN: EVALUACIONES -->
      <!-- =================================================== -->
      <li class='mb-2'>
        <button class='btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed fs-5'
          data-bs-toggle='collapse' data-bs-target='#collapse-evaluaciones' aria-expanded='false'
          aria-controls='collapse-evaluaciones'>
          EVALUACIONES
        </button>

        <div class='collapse' id='collapse-evaluaciones'>
          <ul class='btn-toggle-nav list-unstyled fw-normal fs-6 pb-1 ps-3 small'>

            <!-- Submenú: PROPEDEUTICO -->
            <li>
              <button class='btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed'
                data-bs-toggle='collapse' data-bs-target='#collapse-eval-propedeutico'
                aria-expanded='false' aria-controls='collapse-eval-propedeutico'>
                PROPEDEUTICO
              </button>
              <div class='collapse' id='collapse-eval-propedeutico'>
                <ul class='btn-toggle-nav list-unstyled fw-normal fs-6 pb-1 ps-3 small'>
                  <li><a href='https://forms.gle/JBRfFvBerC7jUXXL9'>TEMA 01 – Ley de Signos</a></li>
                  <li><a href='#'>TEMA 02 – Jerarquía de Operaciones</a></li>
                  <li><a href='#'>TEMA 03 – Fracciones</a></li>
                  <li><a href='#'>TEMA 04 – Ecuaciones Lineales</a></li>
                  <li><a href='#'>TEMA 05 – Polinomios</a></li>
                </ul>
              </div>
            </li>

            <!-- Submenús vacíos para futuras materias -->
            <li><button class='btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed'
                data-bs-toggle='collapse' data-bs-target='#collapse-eval-m1' aria-expanded='false'
                aria-controls='collapse-eval-m1'>MATEMÁTICAS I</button>
              <div class='collapse' id='collapse-eval-m1'>
                <ul class='btn-toggle-nav list-unstyled fw-normal fs-6 pb-1 ps-3 small'></ul>
              </div>
            </li>

            <li><button class='btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed'
                data-bs-toggle='collapse' data-bs-target='#collapse-eval-m2' aria-expanded='false'
                aria-controls='collapse-eval-m2'>MATEMÁTICAS II</button>
              <div class='collapse' id='collapse-eval-m2'>
                <ul class='btn-toggle-nav list-unstyled fw-normal fs-6 pb-1 ps-3 small'></ul>
              </div>
            </li>

            <li><button class='btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed'
                data-bs-toggle='collapse' data-bs-target='#collapse-eval-m3' aria-expanded='false'
                aria-controls='collapse-eval-m3'>MATEMÁTICAS III</button>
              <div class='collapse' id='collapse-eval-m3'>
                <ul class='btn-toggle-nav list-unstyled fw-normal fs-6 pb-1 ps-3 small'></ul>
              </div>
            </li>

            <li><button class='btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed'
                data-bs-toggle='collapse' data-bs-target='#collapse-eval-m4' aria-expanded='false'
                aria-controls='collapse-eval-m4'>MATEMÁTICAS IV</button>
              <div class='collapse' id='collapse-eval-m4'>
                <ul class='btn-toggle-nav list-unstyled fw-normal fs-6 pb-1 ps-3 small'></ul>
              </div>
            </li>
          </ul>
        </div>
      </li>

      <!-- =================================================== -->
      <!-- 🧰 SECCIÓN: HERRAMIENTAS -->
      <!-- =================================================== -->
      <li class='mb-2'>
        <button class='btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed fs-5'
          data-bs-toggle='collapse' data-bs-target='#collapse-herramientas' aria-expanded='false'
          aria-controls='collapse-herramientas'>
          HERRAMIENTAS
        </button>

        <div class='collapse' id='collapse-herramientas'>
          <ul class='btn-toggle-nav list-unstyled fw-normal fs-6 pb-1 ps-3 small'>
            <li><a href='videos_doc.html'>VIDEOS</a></li>
            <li><a href='https://www.geogebra.org/'>GEOGEBRA</a></li>
            <li><a href='#'>EJERCICIOS</a></li>
          </ul>
        </div>
      </li>

      <!-- =================================================== -->
      <!-- 👩‍🎓 SECCIÓN: ESTUDIANTES -->
      <!-- =================================================== -->
      <li class='mb-2'>
        <button class='btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed fs-5'
          data-bs-toggle='collapse' data-bs-target='#collapse-estudiantes' aria-expanded='false'
          aria-controls='collapse-estudiantes'>
          ESTUDIANTES
        </button>

        <div class='collapse' id='collapse-estudiantes'>
          <ul class='btn-toggle-nav list-unstyled fw-normal fs-6 pb-1 ps-3 small'>
            <li><a href='estudiantes_gral.php'>GENERAL</a></li>

            <!-- Botón que activa el modal -->
            <li>
              <a class='d-inline-flex text-decoration-none rounded' role='button' data-bs-toggle='modal'
                data-bs-target='#modalMatricula'>
                INDIVIDUAL
              </a>
            </li>
          </ul>
        </div>
      </li>

      <!-- =================================================== -->
      <!-- 👤 NUEVA SECCIÓN: PERFIL -->
      <!-- =================================================== -->
      <li class='mb-2'>
        <button class='btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed fs-5'
          data-bs-toggle='collapse' data-bs-target='#collapse-perfil' aria-expanded='false'
          aria-controls='collapse-perfil'>
          PERFIL
        </button>

        <div class='collapse' id='collapse-perfil'>
          <ul class='btn-toggle-nav list-unstyled fw-normal fs-6 pb-1 ps-3 small'>
            <li><a href='#'>CONFIGURACIÓN</a></li>
            <li><a href='cerrar.php' type='submit' onclick=cerrar();>CERRAR SESION</a></li>
          </ul>
        </div>
      </li>

    </ul>
  </div>
</div>

<!-- ===================================================
     🧾 MODAL DE MATRÍCULA
     ---------------------------------------------------
     🔹 Mantenido el mismo botón 'INDIVIDUAL' para activarlo.
     🔹 Movido fuera de la lista para evitar errores estructurales.
=================================================== -->
<div class='modal fade' id='modalMatricula' data-bs-backdrop='static' data-bs-keyboard='false'
  tabindex='-1' aria-labelledby='modalMatriculaLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>

      <div class='modal-header'>
        <h1 class='modal-title fs-5' id='modalMatriculaLabel'>MATRÍCULA DEL ESTUDIANTE</h1>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>

      <form action='estudiantes_ind.php' method='POST'>
        <div class='modal-body'>
          <div class='form-floating'>
            <input name='matricula' type='text' class='form-control text-center' id='floatingMatricula'
              placeholder='12345'>
            <label for='floatingMatricula'>Matrícula</label>
          </div>
        </div>
        <div class='modal-footer'>
          <button class='w-100 btn btn-lg btn-danger' type='submit'>Buscar</button>
        </div>
      </form>

    </div>
  </div>
</div>
  
<div class='hero-texto-sec py-4 text-center'>
  <h1 class='fw-bold mb-4'>".$User."</h1>
    <div class='container text-center my-4'>
	    <div class='row justify-content-center'>
		    <div class=' hero-imagen-sec col-12 col-md-10 col-lg-8'>
			    <img src='../Image/portada.png' class='img-fluid hero-img rounded shadow-sm' alt='Imagen de portada'>
		    </div>
	    </div>
    </div>
</div>

</div>

</div>

<div class='container'>
  <hr>
</div>

    </section>

  </main>

  <!-- FOOTER: se preserva estructura y animaciones -->
<footer id='footer' role='contentinfo' aria-label='Pie de página' class='py-4 mt-5'>
  <div class='container'>
    <div class='row text-center text-md-start align-items-center gy-4'>

      <!-- Columna 1: Enlaces -->
      <div class='col-12 col-md-4 footer-columna-uno fw-bold text-center' aria-label='Enlaces'>
        <nav class='d-flex flex-column flex-md-row flex-wrap justify-content-center justify-content-md-center gap-2 fw-bold'>
          <a href='#'>NOSOTROS</a>
          <a href='#'>ACERCA DE</a>
          <a href='#'>CONTACTO</a>
          <a href='#'>SERVICIOS</a>
        </nav>
      </div>

      <!-- Columna 2: Logo -->
      <div class='col-12 col-md-4 text-center footer-columna'>
        <img src='../Image/m_logo.png' class='img-fluid' style='max-width:200px;' alt='Logo institucional'>
      </div>

      <!-- Columna 3: Redes sociales -->
      <div class='footer-columna-dos col-12 col-md-4 text-center text-md-center' aria-label='Redes sociales'>
        <div class='redes-sociales'>
          <!-- Se añadieron aria-labels para accesibilidad sin cambiar apariencia -->
          <a href='#' class='facebook' title='Facebook' aria-label='Facebook'><i class='fab fa-facebook-f'></i></a>
          <a href='#' class='instagram' title='Instagram' aria-label='Instagram'><i class='fab fa-instagram'></i></a>
          <a href='#' class='x-twitter' title='X (Twitter)' aria-label='X (Twitter)'><i
              class='fab fa-x-twitter'></i></a>
        </div>

    </div>

    <!-- Línea inferior -->
    <div class='footer-bottom text-center border-top border-danger border-2 mt-4 pt-3 fw-bold'>
      &copy; 2025 DIVISIÓN DE INGENIERÍA EN SISTEMAS COMPUTACIONALES.
    </div>
  </div>
</footer>


  <!-- Scripts (se mantienen exactamente como en el original) -->
  <script src='../Style/bootstrap.bundle.min.js'></script>
  <script src='https://unpkg.com/swiper/swiper-bundle.min.js'></script>
  <script>

    /* ============================================================
       Observador para animar el footer (fade-in)
       ------------------------------------------------------------
       - Añade la clase .visible cuando el footer entra en el viewport.
       - Se deja la misma lógica que en el original.
       ============================================================ */
    (function () {
      const footer = document.getElementById('footer');
      if (!footer) return;

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            footer.classList.add('visible');
            observer.unobserve(footer);
          }
        });
      }, { threshold: 0.2 });

      observer.observe(footer);
    })();
  </script>
</body>

</html>";

}

?>

<script>

  function cerrar() {
    alert('<?php echo 'Se ha cerrado la sesión exitosamente'; ?>');
  }

</script>