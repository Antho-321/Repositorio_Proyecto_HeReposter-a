<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <!-- Logo o Inicio de la barra -->
    <a class="navbar-brand" href="#">
      <img src="{{ asset('images/LOGO_PANKEY1.png') }}" alt="Logo" style="height: 40px;"> <!-- Cambia la ruta al logo de tu proyecto -->
    </a>

    <!-- Botón para dispositivos móviles -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Elementos de la barra -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <!-- Dropdown del perfil de usuario -->
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Administrador
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Perfil</a></li>
            <li><a class="dropdown-item" href="#">Cambiar contraseña</a></li>
            <li><a class="dropdown-item" href="#">Salir</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
