<?php
/**
 * estudiantes_ind.php
 * Versión optimizada y estilizada para mantener el mismo header/footer que index.html.
 *
 * Cambios principales aplicados:
 * - Uso de consultas preparadas (mysqli) o casting para evitar inyección SQL.
 * - Sanitización de entrada (casting a entero).
 * - Salida escapada con htmlspecialchars para evitar XSS.
 * - Reemplazo de <font> y <center> por HTML semántico y clases de Bootstrap.
 * - Mantengo nombres de variables, rutas e imágenes exactamente como estaban.
 *
 * Observación: este archivo asume que conexion.php define $con como conexión mysqli.
 */

include('conexion.php');

/* Obtener la matrícula enviada por POST (mismo nombre de campo que el original) */
$id = isset($_POST['matricula']) ? (int) $_POST['matricula'] : 0;

/* Consulta preparada (mantengo la variable $datosind usada en el original) */
$datosind = null;
if ($id > 0) {
  $stmt = $con->prepare("SELECT * FROM estudiantes WHERE NCONTROL = ?");
  if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $datosind = $stmt->get_result();
    $stmt->close();
  } else {
    // Fallback: si prepare falla, intentar consulta directa (mantengo variable para compatibilidad)
    $sqlind = "SELECT * FROM estudiantes WHERE ID = " . $id;
    $datosind = $con->query($sqlind);
  }
}

/* Guardar el registro principal en $rind para usar en el formulario de edición (como en el original) */
$rind = $datosind ? $datosind->fetch_assoc() : null;
?>
<!doctype html>
<html lang="es">

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

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description"
    content="Plataforma Virtual de Apoyo a las Matemáticas - Tecnológico de Estudios Superiores de Cuautitlán Izcalli" />
  <title>Plataforma Virtual - Matemáticas</title>

  <!-- Dependencias externas (se mantienen tal cual) -->
  <link href="../Style/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

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
      /* Observación: si "Gothambook" no está cargada, se usará el fallback. */
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
    font-size: 1.5rem;
    color: #ff4d4d; /* rojo claro base */
    text-decoration: none;
    transition: color 0.3s ease, text-shadow 0.3s ease;
  }

  .texto-rojo:hover {
    color: #ff8080; /* tono más claro */
    text-shadow: 0 0 8px rgba(255, 100, 100, 0.8); /* efecto de brillo */
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
      font-family: "GothamBook", sans-serif;
      /* coincide con la fuente usada en el diseño */
      flex: 1 1 45%;
      max-width: 600px;
      z-index: 2;
    }

    .hero-texto h1 {
      font-family: "Philosopher", serif;
      /* se conserva la tipografía indicada en el diseño */
      font-size: 2.8rem;
      margin-bottom: 20px;
    }

    .hero-texto p {
      font-size: 1.1rem;
      margin-bottom: 30px;
      opacity: 0.9;
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
      font-family: "GothamBook", sans-serif;
      flex: 1 1 45%;
      max-width: 550px;
      z-index: 2;
    }

    .hero-texto-sec h3 {
      font-family: "GothamBook", serif;
      font-size: 2rem;
      margin-bottom: 20px;
      color: #ff8080;
    }

    .hero-texto-sec p {
      font-size: 1.1rem;
      margin-bottom: 30px;
      opacity: 0.9;
    }

    .hero-imagen-sec {
      flex: 1 1 45%;
      text-align: center;
    }

    .hero-imagen-sec img {
      width: 100%;
      max-width: 500px;
      border-radius: 10px;
      transition: transform 0.6s ease;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
    }

    .hero-imagen-sec img:hover {
      transform: scale(1.08);
    }

    .table {
    font-size: 1rem;
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
      font-family: "Philosopher", serif;
      font-weight: 700;
      color: rgb(162, 0, 0);
      /* color visual conservado */
    }

    .brand-title-card {
      font-family: "Philosopher", serif;
      font-weight: 700;
      color: rgb(245, 171, 171);
    }

    .brand-subtitle {
      font-family: "GothamBook", sans-serif;
      font-weight: 500;
      color: lightslategray;
    }

    .body-text {
      font-family: "GothamBook", sans-serif;
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
      font-family: "GothamBook", sans-serif;
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
      font-family: "GothamBook", sans-serif;
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
      font-family: "GothamBook", sans-serif;
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
      img[alt="Logo de la plataforma"] {
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
    - El HTML usa "Philosopher" y "GothamBook". Si la vista actual depende de estas, asegúrate
      de tener las fuentes cargadas en tus archivos externos (headers.css / Bootstrap.css) o
      de importarlas desde Google Fonts / archivos locales. No se añadieron nuevos imports aquí
      para no alterar la apariencia visual por diferencias de renderizado.
  -->
</head>

<body>
  <!-- MAIN: marcado semántico mejorado (no se cambia la vista) -->
  <main role="main">
    <!-- HEADER: rol banner para mejorar accesibilidad -->
    <div class="container">
      <header class="py-3 mb-4 border-bottom border-danger border-2" role="banner" aria-label="Cabecera principal">
        <div class="container">

          <!-- Título institucional -->
          <div class="border-bottom border-danger mb-3 text-center">
            <div class="brand-subtitle fw-bold fs-5 fs-md-4 fs-lg-3">
              TECNOLÓGICO DE ESTUDIOS SUPERIORES DE CUAUTITLÁN IZCALLI
            </div>
          </div>

          <!-- Fila principal con logo y botones -->
          <div class="row align-items-center text-center text-md-end g-3">

            <!-- Logo -->
            <div class="col-12 col-md-2 mb-3 mb-md-0 text-center">
              <img src="../Image/logo_n.png" class="img-fluid" alt="Logo de la plataforma">
            </div>

            <!-- Título y botones -->
            <div class="col-12 col-md-10">
              <h1 class="brand-title display-6 mb-2">
                MATEMÁTICAS
                <small class="text-muted d-block d-md-inline" style="font-size:1rem;">
                  <span class="body-text">PLATAFORMA VIRTUAL</span>
                </small>
              </h1>

              <div class="mt-3">
                <a href="inicio_doc.php" class="btn btn-danger" role="button">ATRAS</a>
              </div>
            </div>

          </div>
        </div>
      </header>
    </div>

    <!-- HERO principal -->
    <section class="hero py-5 text-center" aria-label="Información del estudiante">
      <div class="container hero-texto">
        <hr class="my-4">
        <h1>LISTADO DE ESTUDIANTES</h1>
        <hr class="my-4">
      </div>

      <!-- Contenido principal: tabla y formulario de edición -->
      <div class="container">
        <?php if ($rind): ?>
          <!-- Tabla con información (se mantiene la misma información visible que el original) -->
          <div class="table-responsive mb-4">
            <table class='table table-bordered align-middle shadow-sm mx-auto w-100 w-md-75 w-lg-50'>
              <thead class="table-light">
                <tr>
                  <th>MATRICULA</th>
                  <th>NOMBRE</th>
                  <th>APELLIDO</th>
                  <th>CORREO</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="texto-rojo"><?php echo htmlspecialchars($rind["NCONTROL"], ENT_QUOTES, 'UTF-8'); ?></td>
                  <td class="texto-rojo"><?php echo htmlspecialchars($rind["NAME"], ENT_QUOTES, 'UTF-8'); ?></td>
                  <td class="texto-rojo"><?php echo htmlspecialchars($rind["LASTNAME"], ENT_QUOTES, 'UTF-8'); ?></td>
                  <td class="texto-rojo"><?php echo htmlspecialchars($rind["USER"], ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Bloque con imagen y formulario de modificación -->
          <div class="row g-4 align-items-start">
            <div class="col-md-7 text-center hero-imagen-sec">
              <img src="../Image/foto.jpeg" class="img-fluid student-card-img" alt="Foto del estudiante">
            </div>

            <div class="col-md-5">
              <div class="hero-texto-sec p-3 h-100 rounded-3 text-center">
                <h3 class="fw-bold">Modificar Registro</h3>

                <!-- Formulario de actualización: mantiene action y nombres de campos originales -->
                <form action="update.php" method="POST" class="mt-3">
                  <div class="mb-3">
                    <label for="field" class="form-label">Seleccionar Campo</label>
                    <select class="form-select text-center" id="field" name="field" required>
                      <option value="" selected></option>
                      <option value="ID">Matrícula</option>
                      <option value="Name">Nombre</option>
                      <option value="Last">Apellido</option>
                      <option value="User">Correo</option>
                      <option value="Pass">Contraseña</option>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="dato" class="form-label">Ingresar Dato</label>
                    <input type="text" class="form-control text-center" id="dato" name="dato" placeholder="Dato" required>
                  </div>

                  <!-- Campo oculto para enviar la matrícula al update.php (mantengo el nombre $mat usado en el original) -->
                  <input type="hidden" name="matricula"
                    value="<?php echo htmlspecialchars($rind['NCONTROL'], ENT_QUOTES, 'UTF-8'); ?>">

                  <button class="w-100 btn btn-lg btn-outline-light" type="submit">Actualizar</button>
                </form>

                <!-- Botón de eliminar (sin cambiar rutas/funcionalidad visual) -->
                <form action="eliminar_est.php" method="POST" class="mt-3">
                  <!-- Mantengo la estructura pero envío POST para evitar eliminar vía GET si así se desea -->
                  <input type="hidden" name="matricula"
                    value="<?php echo htmlspecialchars($rind['NCONTROL'], ENT_QUOTES, 'UTF-8'); ?>">
                  <button class="w-100 btn btn-lg btn-danger" type="submit">Eliminar Registro de Estudiante</button>
                </form>

              </div>
            </div>
          </div>
        </section>

        <?php else: ?>
          <div class="alert alert-warning" role="alert">
            Matrícula no encontrada o no se envió ningún valor. Por favor vuelva atrás y seleccione una matrícula válida.
          </div>
        <?php endif; ?>
      </div>

      <!-- FOOTER: se preserva estructura y animaciones -->
      <footer id="footer" role="contentinfo" aria-label="Pie de página" class="py-4 mt-5">
        <div class="container">
          <div class="row text-center text-md-start align-items-center gy-4">

            <!-- Columna 1: Enlaces -->
            <div class="col-12 col-md-4 footer-columna-uno fw-bold text-center" aria-label="Enlaces">
              <nav
                class="d-flex flex-column flex-md-row flex-wrap justify-content-center justify-content-md-center gap-2 fw-bold">
                <a href="#">NOSOTROS</a>
                <a href="#">ACERCA DE</a>
                <a href="#">CONTACTO</a>
                <a href="#">SERVICIOS</a>
              </nav>
            </div>

            <!-- Columna 2: Logo -->
            <div class="col-12 col-md-4 text-center footer-columna">
              <img src="../Image/m_logo.png" class="img-fluid" style="max-width:200px;" alt="Logo institucional">
            </div>

            <!-- Columna 3: Redes sociales -->
            <div class="footer-columna-dos col-12 col-md-4 text-center text-md-center" aria-label="Redes sociales">
              <div class="redes-sociales">
                <!-- Se añadieron aria-labels para accesibilidad sin cambiar apariencia -->
                <a href="#" class="facebook" title="Facebook" aria-label="Facebook"><i
                    class="fab fa-facebook-f"></i></a>
                <a href="#" class="instagram" title="Instagram" aria-label="Instagram"><i
                    class="fab fa-instagram"></i></a>
                <a href="#" class="x-twitter" title="X (Twitter)" aria-label="X (Twitter)"><i
                    class="fab fa-x-twitter"></i></a>
              </div>

            </div>

            <!-- Línea inferior -->
            <div class="footer-bottom text-center border-top border-danger border-2 mt-4 pt-3 fw-bold">
              &copy; 2025 DIVISIÓN DE INGENIERÍA EN SISTEMAS COMPUTACIONALES.
            </div>
          </div>
      </footer>


      <!-- Scripts (se mantienen exactamente como en el original) -->
      <script src="../Style/bootstrap.bundle.min.js"></script>
      <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
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

</html>