<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Įmonių valdymo sistema</a>
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
        <a class="nav-link" href="imones.php">Įmonės<span class="sr-only">(current)</span></p>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="naujaImone.php">Naujos įmonės</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Vartotojai
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Nauja įmonė</a>
          <a class="dropdown-item" href="#">Įmonių sąrašas</a>
          
        </div>
      </li>
      
    </ul>

    <form class="form-inline my-2 my-lg-0" action="imones.php" method="get">
      <input class="form-control mr-sm-2" name="search" type="search" placeholder="Ieškoti įmonės" aria-label="Search Client">
      <button class="btn btn-primary my-2 my-sm-0" name="seach_button" type="submit">Ieškoti</button>
    </form>

  </div>
</nav>