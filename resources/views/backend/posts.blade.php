@extends('backend.layouts.master')


@section('main_content')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addpost">
   Add Post
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="addpost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="postform">
                    @csrf
                    <label for="employee_id">Employee</label>
                    <select class="form-control" id="employee_id" name="employee_id" required>
                        <option value="">Select an Employee</option>
                        @foreach($employee as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                        @endforeach
                    </select>
                    <div class="form-group">
                        <label for="CompanyName">Company Name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" >
                    </div>
                    <div class="form-group">
                        <label for="Description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" ></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="Latitude">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" >
                    </div>
                    <div class="form-group">
                        <label for="Longitude">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" >
                    </div>
                    <div class="form-group">
                        <label for="Image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image" >
                    </div>
                   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary addpostdata">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editemployeepost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="postformupdate">
                @csrf
                <input type="hidden" id="u_id">

                <div class="form-group">
                    <label for="CompanyName">Company Name</label>
                    <input type="text" class="form-control" value="" id="u_company_name" name="u_company_name" >
                </div>
                <div class="form-group">
                    <label for="Description">Description</label>
                    <textarea class="form-control" id="u_description" name="u_description" rows="4" ></textarea>
                </div>
                
                <div class="form-group">
                    <label for="Latitude">Latitude</label>
                    <input type="text" class="form-control" id="u_latitude" name="u_latitude" >
                </div>
                <div class="form-group">
                    <label for="Longitude">Longitude</label>
                    <input type="text" class="form-control" id="u_longitude" name="u_longitude" >
                </div>
                <div class="form-group">
                    <label for="Image">Image</label>
                    <input type="file" class="form-control-file" id="u_image" name="u_image" >
                </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary updatepostdata">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  


<table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Employee</th>
        <th scope="col">Company Name</th>
        <th scope="col">Description</th>
        <th scope="col">Image</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $item)
      <a href=""></a>
        <tr>
          <th scope="row"  >{{ $item->id}}</th>
          <th scope="row">Test</th>
          <th scope="row">{{ $item->company_name}}</th>
          <th scope="row">{{ $item->description}}</th>
          <th scope="row">{{ $item->image}}</th>
          <th scope="row">
            <a 
            href="" 
            class="btn btn-success edit_post_emp" 
            data-toggle="modal" 
            data-target="#editemployeepost"
            data-id="{{ $item->id }}"
            data-id="{{ $item->employee_id }}"
            data-company_name="{{ $item->company_name }}"
            data-description="{{ $item->description }}"
            data-latitude="{{ $item->latitude }}"
            data-longitude="{{ $item->longitude }}"
            data-image="{{ $item->image }}"
            > 
              <i class="las la-edit"></i></a>
            <a href="" class="btn btn-danger deletepost"  
            data-id="{{ $item->id }}"
            ><i class="las la-times"></i></a>
            
          </th>
       
        </tr>
      @endforeach
      
    </tbody>
  </table>

  {!! Toastr::message() !!}



  <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
  <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>








  <script>
    $(document).ready(function() {
      $(document).on('click', '.addpostdata', function(e) {
        e.preventDefault();
  
        let employee_id = $('#employee_id').val();
        let company_name = $('#company_name').val();
        let description = $('#description').val();
        let latitude = $('#latitude').val();
        let longitude = $('#longitude').val();
        let image = $('#image').val();
  
  
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
        $.ajax({
          url: "{{ route('post.store') }}",
          method: 'post',
          data: {
            employee_id: employee_id,
            company_name: company_name,
            description: description,
            latitude: latitude,
            longitude: longitude,
            image: image,
          },
          success: function(res) {
            if (res.status === "success") {
              $('#postform')[0].reset();
              $('#addpost').modal('hide'); 
              $('.table').load(location.href+' .table');
              Command: toastr["success"]("Post Added Successfully")
              toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
              }
            }
          },
          error: function(err) {
            let error = err.responseJSON;
            $('.error_message').empty(); // Clear previous error messages
            $.each(error.errors, function(index, value) {
              $('.error_message').append('<span class="text-danger">' + value + '</span>' + '</br>')
            });
          },
        });
      });
      $(document).on('click', '.edit_post_emp', function () {
        let id = $(this).data('id');
        let employee_id = $(this).data('employee_id');
        let company_name = $(this).data('company_name');
        let description = $(this).data('description');
        let latitude = $(this).data('latitude');
        let longitude = $(this).data('longitude');
        let image = $(this).data('image');

        $('#u_id').val(id);
        $('#u_company_name').val(company_name);
        $('#u_description').val(description);
        $('#u_latitude').val(latitude);
        $('#u_longitude').val(longitude);
        $('#u_image').val(image);  
  
        
      });
      $(document).on('click', '.updatepostdata', function(e) {
        e.preventDefault();
  
        let u_id = $('#u_id').val();
        let u_company_name = $('#u_company_name').val();
        let u_description = $('#u_description').val();
        let u_latitude = $('#u_latitude').val();
        let u_longitude = $('#u_longitude').val();
        let u_image = $('#u_image').val();
  
  
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
        $.ajax({
          url: "{{ route('post.update') }}",
          method: 'post',
          data: {
            u_id: u_id,
            u_company_name: u_company_name,
            u_description: u_description,
            u_latitude: u_latitude,
            u_longitude: u_longitude,
            u_image: u_image,
          },
          success: function(res) {
            if (res.status === "update") {
              
              $('#postformupdate')[0].reset();
              $('#editemployeepost').modal('hide'); // Corrected line to hide the modal
              $('.table').load(location.href+' .table');
              Command: toastr["success"]("Post Update Successfully")
  
              toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
              }
            }
          },
          error: function(err) {
            let error = err.responseJSON;
            $('.error_message').empty(); // Clear previous error messages
            $.each(error.errors, function(index, value) {
              $('.error_message').append('<span class="text-danger">' + value + '</span>' + '</br>')
            });
          },
        });
      });
      $(document).on('click', '.deletepost', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      if(confirm("Are you sure to delete ??")){
        $.ajax({
        url: "{{ route('post.destroy') }}",
          method: 'post',
          data: {
            id: id,
          
          },
          success: function(res) {
            if (res.status === "deleted") {
                $('.table').load(location.href+' .table');

              Command: toastr["success"]("Post Deleted Successfully")
  
              toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
              }
            }
          },
         
        });
      }
      });
    });
  </script>
  

@endsection



