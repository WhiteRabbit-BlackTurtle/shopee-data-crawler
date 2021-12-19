<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

<?php
include('/home/master/lib/crawler/autoload.php');
?>
<head> 
  <title>Shopee Categories Analysis</title>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Shopee Analysis</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="shopee_BestCat.php">Best Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="shopee_WeakCat.php">Weak Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="shopee_BestProd.php">Best Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="shopee_WeakProd.php">Weak Products</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</head> 