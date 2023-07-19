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

  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
  <style>
    a:link {
      text-decoration: none;
      color: black
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

  .image-container {
    width: 70vw;
    height: 35vh;
    background-image: url('https://rezdy.com//wp-content/uploads/2021/11/Blog-Photos-26.png');
    background-size: cover;
    background-position: center;
    justify-content: center;
    display: flex;
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

      <div class="image-container">
      </div>
      <br/>
      <p style="font-size: 40px" class="text-center"><b>Where to next?</b></p>
      <div class="input-group mb-3">
        <input type="text" placeholder="Enter country..." class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
      </div>
      <button name="btn1" id="btn1">Button1</button>
      <button name="btn2" id="btn2">Button2</button>
      <div class="container">
        <div class="row" id="items">
          @foreach ($placements as $item)
          <a class="card shadow col-12 p-0 me-2 ms-2" href="{{URL::to('/placements/' . $item->id)}}">
            <div id="carouselId" class="carousel slide card-img-top" data-bs-ride="carousel">
              <div class="carousel-inner" role="listbox">
                @for ($i = 0; $i < count($item->photos()->get()); $i++)
                  <div class="carousel-item {{$i == 0 ? "active" : ""}}">
                    <img src="{{asset($item->photos()->get()[$i]->path)}}" class="w-100 d-block" alt="Second slide">
                  </div> 
                @endfor
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
                </button>
            </div>
            {{-- <img style="border-radius: 5px" src="{{asset($item->photos()->get()[0]->path)}}" class="card-img-top" alt="..."> --}}
            <div class="card-body">
              <h5 class="card-title">{{$item->title}}</h5>
              <p class="card-text">Hello World!</p>
            </div>
            {{-- <div class="card-footer">
              <small class="text-muted">Last updated 3 mins ago</small>
            </div> --}}
          </a>
          @endforeach
          
        </div> 
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