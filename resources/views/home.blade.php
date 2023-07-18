@extends('layouts.app')
<!doctype html>
<html lang="en">

<head>
    <title>Booking KR</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="styles.css">

  <style>
     a:link {
      text-decoration: none;
    }

    a:visited {
      text-decoration: none;
    }

    a:hover {
      text-decoration: none;
      color: #494949;
    }
    a:hover img{
      opacity: 0.9;
    }

    a:active {
      text-decoration: none;
    }
  </style>
</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>
    @section('content')
    <div class="container">

      <div class="justify-content-center d-flex shadow-lg">
        <img style="" width="70%" src="https://rezdy.com//wp-content/uploads/2021/11/Blog-Photos-26.png">
      </div>
      <br/>
      <br/>
      <p style="font-size: 40px"><b>Where to next?</b></p>
      
      <div class="container">
        <div class="row">
        <a class="card shadow col-4" href="#"><div>
          <img style="border-radius: 5px" src="http://surl.li/jcovl" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          </div>
          {{-- <div class="card-footer">
            <small class="text-muted">Last updated 3 mins ago</small>
          </div> --}}
        </div></a>
        <a class="card shadow col-4" href="#"><div>
          <img style="border-radius: 5px" src="http://surl.li/jcovl" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
          </div>
        </div></a>
        <a class="card shadow col-4" href="#"><div>
          <img style="border-radius: 5px" src="http://surl.li/jcovl" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
          </div>
        </div></a>
        <a class="card shadow col-4" href="#"><div>
          <img style="border-radius: 5px" src="http://surl.li/jcovl" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
          </div>
        </div></a>
        
    </div>
  </div>
    @endsection
  </main>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>