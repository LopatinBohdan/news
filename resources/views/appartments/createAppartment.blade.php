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
<h2>Add appartment to placement: <u>{{$placement->title}}</u></h2>
<form action="{{route('appartments.store')}}" class="form" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row mb-1">
        <input name="placement_id" hidden value={{$placement_id}} readonly/>
        <div class="col-md-8 col-12">
            <div class="form-group">
                <label for="title" class="form-label">Title of appartment</label>
                <input name="title" class="form-control" required placeholder="title"/>
            </div>
            <div class="form-group">
                <label for="personAmount" class="form-label">Number of person</label>
                <div class="d-flex">
                    <button type="button" class="decrement btn btn-danger" onclick="decrementValue('personAmountInput')"><i class="fa-solid fa-circle-minus"></i></button>
                    <input type="number" id="personAmountInput" name="personAmount" class="form-control" placeholder="persons amount" value="1" min="1" max="100">
                    <button type="button" class="increment btn btn-success" onclick="incrementValue('personAmountInput')"><i class="fa-solid fa-circle-plus"></i></button>
                </div>
            </div>
            <div class="form-group">
                <label for="personAmount" class="form-label">Number of rooms</label>
                <div class="d-flex">
                    <button type="button" class="decrement btn btn-danger" onclick="decrementValue('roomAmountInput')"><i class="fa-solid fa-circle-minus"></i></button>
                    <input type="number" id="roomAmountInput" name="roomAmount" class="form-control" placeholder="rooms amount" value="1" min="1" max="100">
                    <button type="button" class="increment btn btn-success" onclick="incrementValue('roomAmountInput')"><i class="fa-solid fa-circle-plus"></i></button>
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="form-label">Title of appartment</label>
                <input name="price" id="moneyInput" class="form-control" placeholder="price"/>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div id="dropArea">
                <p>Drag and drop photos here, or click to select files</p>
                <input type="file" id="fileInput" name="appartment_photo[]" accept="image/*" multiple style="display: none;">
            </div>
            <div id="filePreviews"></div> <!-- Container for file previews -->
        </div>
    </div>
    
    <input type="submit" class="form-control btn btn-primary" value="Add Appartment">
</form>
@endsection

@section('script')
 <script>
    const moneyInput = document.getElementById('moneyInput');
    
    // Function to format the money value as the user types
    moneyInput.addEventListener('input', function(event) {
      const input = event.target;
      const value = input.value.replace(/\D/g, '');
      const formattedValue = (value / 100).toFixed(2);
      input.value = formattedValue;
    });

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

    
    function incrementValue(id) {
      var customNumberInput = document.getElementById(id);
      const currentValue = parseInt(customNumberInput.value);
      const maxValue = parseInt(customNumberInput.max);
      if (currentValue < maxValue) {
          customNumberInput.value = currentValue + 1;
        }
    }
    
    function decrementValue(id) {
      var customNumberInput = document.getElementById(id);
      const currentValue = parseInt(customNumberInput.value);
      const minValue = parseInt(customNumberInput.min);
      if (currentValue > minValue) {
        customNumberInput.value = currentValue - 1;
      }
    }
 </script>
@endsection