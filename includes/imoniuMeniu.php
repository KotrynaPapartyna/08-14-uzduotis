<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Imoniu valdymo sistema</a>
  <button class="navbar-toggler" type="button" 
        data-toggle="collapse" data-target="#navbarSupportedContent" 
        aria-controls="navbarSupportedContent" 
        aria-expanded="false" 
        aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="klientai.php">Imones<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="naujasKlientas.php">Naujos imones</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" 
        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Vartotojas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Nauja imone</a>
          <a class="dropdown-item" href="#">Imoniu sarasas</a>
          
        </div>
      </li>
      
    </ul>

    <form class="form-inline my-2 my-lg-0" action="imones.php" method="get">
      <input class="form-control mr-sm-2" name="search" type="search" placeholder="Ieskoti imones" aria-label="Search Client">
      <button class="btn btn-primary my-2 my-sm-0" name="seach_button" type="submit">Ieskoti</button>
    </form>

  </div>
</nav>