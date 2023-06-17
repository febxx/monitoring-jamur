<?php

include_once 'config/database.php';
include_once 'objects/datajamur.php';

$database = new Database();
$db = $database->getConnection();

$jamur = new DataJamur($db);

$data = $jamur->read();

?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.112.5">
  <title>Monitoring Jamur</title>

  <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <style>
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
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
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

    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #6528e0;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
      z-index: 1500;
    }
  </style>
</head>

<body>
  <main>
    <div class="container py-4">
      <header class="mb-4 border-bottom">
        <h1 class="fs-4 font-weight-bold text-center">Monitoring Jamur</h1>
      </header>

      <div class="p-md-5 p-sm-2 rounded-3"></div>
      <table class="table table-responsive">
        <thead class="table-primary">
          <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Jam</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Suhu</th>
            <th scope="col">Kelembapan</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          foreach ($data as $row) {
            echo '<tr>';
            echo '<td>' . $no . '</td>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['tanggal'] . '</td>';
            echo '<td>' . $row['jam'] . '</td>';
            echo '<td>' . $row['suhu'] . '</td>';
            echo '<td>' . $row['kelembapan'] . '</td>';
            echo '</tr>';
            $no++;
          }
          ?>
        </tbody>
      </table>
      <!-- <div class="row">
        <div class="col-6">
          <a href="">
            <div class="h-100 py-5 text-bg-primary rounded-3">
              <h2 class="text-center">Suhu</h2>
            </div>
          </a>
        </div>
        <div class="col-6">
          <a href="">
            <div class="h-100 py-5 text-bg-primary border rounded-3">
              <h2 class="text-center">Kelembapan</h2>
            </div>
          </a>
        </div>
      </div> -->
    </div>
  </main>
  <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>