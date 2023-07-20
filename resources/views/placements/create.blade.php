@extends('layouts.app')
@section('styles')
<style>
  #dropArea {
    border: 2px dashed #ccc;
    padding: 20px;
    text-align: center;
    font-size: 18px;
    cursor:grab;
  }
  #dropArea:hover{
    border: 2px dashed #0344ab;
  }
  .file-preview {
      display: inline-block;
      margin: 5px;
    }

    .file-preview img {
      max-width: 100px;
      max-height: 100px;
    }
</style>
@endsection
@section('content')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Home</a></li>
      <li class="breadcrumb-item"><a href="/placements">Placements</a></li>
      <li class="breadcrumb-item active" aria-current="page">Create</li>
    </ol>
  </nav>
<div class="row">
    <form action="{{route('placements.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-8 col-12">
            <div class="row">
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="title">Title of placement</label>
                  <input name="title" class="form-control" required placeholder="title" maxlength="30"/>
                </div>
                <div class="form-group">
                  <label for="description">Short description</label>
                  <textarea rows="9" name="description" class="form-control" style="resize: none" required placeholder="description"></textarea>
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group ">
                    <label for="countrySelector">Placement country</label>
                    <select class="selectpicker form-control" name='country' data-live-search="true" id="countrySelector"></select>
                </div>
                <div class="form-group ">
                  <label for="region">Placement region</label>
                  <input name="region" class="form-control" required placeholder="region"/>
                </div>
                <div class="form-group ">
                  <label for="city">Placement city</label>
                  <input name="city" class="form-control" required placeholder="city"/>
                </div>
                <div class="form-group ">
                  <label for="street">Placement street</label>
                  <input name="street" class="form-control" required placeholder="street"/>
                </div>
                <div class="form-group ">
                  <label for="home">Placement home</label>
                  <input name="home" class="form-control" required placeholder="home"/>
                </div>
              </div>
              <div class="col-12">
                <div id="dropArea">
                  <p>Drag and drop photos here, or click to select files</p>
                  <input type="file" id="fileInput" name="placement_photo[]" accept="image/*" multiple style="display: none;">
                </div>
                <div id="filePreviews"></div> <!-- Container for file previews -->
              </div>
            </div>
          </div>
          <div class="col-md-4 col-12">
            <div class="form-group ">
              <label for="longitude">Placement longitude</label>
              <input id="longitude" readonly name="longitude" class="form-control" required placeholder="longitude"/>
            </div>
            <div class="form-group ">
              <label for="latitude">Placement latitude</label>
              <input id="latitude" readonly name="latitude" class="form-control" required placeholder="latitude"/>
            </div>
            <div id="map" class="mt-1" style="width: 100%; height: 400px;"></div>
          </div>
        </div>
          <input type="submit" class="btn btn-outline-primary" value="Add Placement"/>
      </form>
    </div>


@endsection

@section('script')
 
 <script>
     const dropArea = document.getElementById('dropArea');
    const fileInput = document.getElementById('fileInput');
    const filePreviews = document.getElementById('filePreviews'); // Reference to the container for previews

    // Prevent default behavior for drag and drop events
    dropArea.addEventListener('dragenter', preventDefault, false);
    dropArea.addEventListener('dragleave', preventDefault, false);
    dropArea.addEventListener('dragover', preventDefault, false);
    dropArea.addEventListener('drop', preventDefault, false);

    // Handle file drop
    dropArea.addEventListener('drop', handleDrop, false);

    // Function to prevent default behavior
    function preventDefault(event) {
      event.preventDefault();
      event.stopPropagation();
    }

    // Function to handle file drop
    function handleDrop(event) {
      event.preventDefault();
      event.stopPropagation();

      const files = event.dataTransfer.files;
      handleFiles(files);
    }

    // Function to handle selected files
    function handleFiles(files) {
      filePreviews.innerHTML = ''; // Clear existing previews

      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const fileReader = new FileReader();

        fileReader.onload = function(event) {
          const dataURL = event.target.result;
          const miniPicture = document.createElement('div');
          miniPicture.classList.add('file-preview');
          miniPicture.innerHTML = `<img src="${dataURL}" alt="Preview">`;
          filePreviews.appendChild(miniPicture);
        };

        fileReader.readAsDataURL(file);
      }
    }

    // Function to trigger file input when the drop area is clicked
    dropArea.addEventListener('click', function() {
      fileInput.click();
    });

    // Function to handle file input change
    fileInput.addEventListener('change', function() {
      const files = fileInput.files;
      handleFiles(files);
    });

    // Function to handle file upload
    function uploadFiles() {
      const files = fileInput.files;
      // Handle the selected files here (e.g., upload to a server or process them)
      console.log(files);
    }

  $(document).ready(function() {
    // URL for fetching countries data
    const countriesUrl = '/countries.json';

    // Function to load countries data using AJAX
    function loadCountries() {
      $.ajax({
        url: countriesUrl,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          // Populate the selector with country names and codes
          data.forEach(function(country) {
            const option = `<option value="${country.name}">${country.name}</option>`;
            $('#countrySelector').append(option);
          });
        },
        error: function(error) {
          console.error('Error fetching countries data:', error);
        }
      });
    }
    // Call the function to load countries when the page loads
    loadCountries();
  })
  
    const map = L.map('map').setView([51.505, -0.09], 3);

    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    const popup = L.popup();
    function onMapClick(e) {
      popup
        .setLatLng(e.latlng)
        .setContent(`Your location is here`)
        .openOn(map)
        document.getElementById("latitude").value = e.latlng.lat;
        document.getElementById("longitude").value = e.latlng.lng;
    }
    map.on('click', onMapClick);
  </script>
@endsection