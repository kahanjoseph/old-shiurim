<?php
    //setCookie('page', "/Shiurim/Hilchos Yichud", time() + (60 * 60));

    $categoryList = getList('shiurim');
    //echo '<pre>'; print_r($categoryList);  echo '</pre>'; 
    //Creating array for navbar menu
    $tempArray = [];

    foreach ($categoryList as $key => $value) {
      if($value['level'] == '1'){
        $tempArray[$value['id']] = [];
        $tempArray[$value['id']]['topMenu'] = $value;  
      }
    }
    foreach ($categoryList as $key => $value) {
      if($value['level'] == '2'){
        $tempArray[$value['parent']]['children'][$value['title']] = $value;
      }
    }
    //Sort navbar array
    $categoryList = [];
    foreach ($tempArray as $value) { 
      usort($value['children'], function($a, $b) {
        return strcmp($a['title'], $b['title']);
      });
      $categoryList[] = $value;
      
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=$file_padder?>/bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=$file_padder?>/UI/style.css">
    <link rel="apple-touch-icon" sizes="57x57" href="<?=$file_padder?>/icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?=$file_padder?>/icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?=$file_padder?>/icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?=$file_padder?>/icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?=$file_padder?>/icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?=$file_padder?>/icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?=$file_padder?>/icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?=$file_padder?>/icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=$file_padder?>/icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?=$file_padder?>/icons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=$file_padder?>/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?=$file_padder?>/icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=$file_padder?>/icons/favicon-16x16.png">
    <link rel="manifest" href="<?=$file_padder?>/icons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>Document</title>
</head>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="<?=$file_padder?>/UI/style.js"></script>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top ">
  <a class="navbar-brand" href="#">Toronto Shiurim</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
    <?php
        foreach ($categoryList as  $value):
    ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?=$value['topMenu']['title']?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <?php foreach($value['children'] as $value1) : ?>
              <a class="dropdown-item dropboxItem" href="#" dropboxurl="<?=$value1['url']?>"><?=$value1['title']?></a>
            <?php endforeach; ?>
        </div>
      </li>
    <?php endforeach; ?>
    </ul>
  </div>
  <div class="col-lg-4 mt-lg-0 mt-1">
    <div class="input-group" id="searchAudios">
      <input type="text" class="form-control"  type="search" placeholder="Search"  aria-label="Search" required>
      <div class="input-group-append">
        <button class="btn btn-outline-success">SEARCH</button>
      </div>
    </div>
  </div>
</nav>