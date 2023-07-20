@extends('layouts.app')

@section('styles')
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
@endsection
  
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

@section('script')
  <script>
    const button1 = document.getElementById('btn1');
    const button2 = document.getElementById('btn2');
    const myDiv = document.getElementById('items');
  
    button1.addEventListener('click', () => {
      Array.from(myDiv.children).forEach(child => {
        child.classList.remove('col-12');
        child.classList.add('col-3');
      });
    });
  
    button2.addEventListener('click', () => {
      Array.from(myDiv.children).forEach(child => {
        child.classList.remove('col-3');
        child.classList.add('col-12');
      });
    });
  
  </script>
@endsection