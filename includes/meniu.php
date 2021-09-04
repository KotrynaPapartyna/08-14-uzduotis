<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <a class="navbar-brand" href="#">Klientų valdymo sistema</a>
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
        <a class="nav-link" href="klientai.php">Klientai<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="naujasKlientas.php">Nauji klientai</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" 
        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Vartotojas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Naujas vartotojas</a>
          <a class="dropdown-item" href="#">Vartotojų sąrašas</a>
          
        </div>
      </li>
      
    </ul>

    <form class="form-inline my-2 my-lg-0" action="klientai.php" method="get">
      <input class="form-control mr-sm-2" name="search" type="search" placeholder="Ieškoti kliento" aria-label="Search Client">
      <button class="btn btn-primary my-2 my-sm-0" name="seach_button" type="submit">Ieškoti</button>
    </form>

  </div>
</nav>