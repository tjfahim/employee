@extends('backend.layouts.master')


@section('main_content')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">


<!-- Button trigger modal -->

<div id="successMessageContainer" class="test-success"></div>

  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addemployeemodal">
    Add Employee
  </button>
  
  <div class="modal fade" id="addemployeemodal" class="modalhideclass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" id="employeeForm">
            <div class="error_message mb-3"></div>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
            </div>
            <div class="form-group">
              <label for="password_confirmation">Confirm Password</label>
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required>
            </div>
         
            <div class="form-group">
              <label for="employee_id">Employee ID</label>
              <input type="text" class="form-control" id="employee_id" name="employee_id" placeholder="Enter employee ID">
            </div>
            <div class="form-group">
              <label for="image">Image</label>
              <input type="file" class="form-control-file" id="image" name="image">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary addEmployeedata">Submit</button>
        </div>
      </div>
    </div>
  </div>



<!-- Modal -->
<div class="modal fade" id="editemployeemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="updateemployeeform">
          <input type="hidden" id="u_id">
          <div class="error_message mb-3"></div>
          <div class="form-group">
            <label for="u_name">Name</label>
            <input type="text" class="form-control" id="u_name" name="u_name" placeholder="Enter name" required>
          </div>
          <div class="form-group">
            <label for="u_email">Email</label>
            <input type="email" class="form-control" id="u_email" name="u_email" placeholder="Enter email" required>
          </div>
          <div class="form-group">
            <label for="u_phone">Phone</label>
            <input type="text" class="form-control" id="u_phone" name="u_phone" placeholder="Enter phone" required>
          </div>
          <div class="form-group">
            <label for="u_password">Password</label>
            <input type="password" class="form-control" id="u_password" name="u_password" placeholder="Enter password" required>
          </div>
          <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required>
          </div>
       
          <div class="form-group">
            <label for="u_employee_id">Employee ID</label>
            <input type="text" class="form-control" id="u_employee_id" name="u_employee_id" placeholder="Enter employee ID">
          </div>
          <div class="form-group">
            <label for="u_image">Image</label>
            <input type="file" class="form-control-file" id="u_image" name="u_image">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary updateemployee">Update</button>
      </div>
    </div>
  </div>
</div>

{!! Toastr::message() !!}


  <table class="table">
    <thead class="thead-light">

      <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Employee Id</th>
        <th scope="col">Image</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($employees as $item)
      <a href=""></a>
        <tr>
          <th scope="row"  >{{ $item->id}}</th>
          <th scope="row">{{ $item->name}}</th>
          <th scope="row">{{ $item->email}}</th>
          <th scope="row">{{ $item->employee_id}}</th>
          <th scope="row">{{ $item->image}}</th>

          <th scope="row">
            <a 
            href="" 
            class="btn btn-success editmodalemployee" 
            data-toggle="modal" 
            data-target="#editemployeemodal"
            data-id="{{ $item->id }}"
            data-name="{{ $item->name }}"
            data-email="{{ $item->email }}"
            data-phone="{{ $item->phone }}"
            data-password="{{ $item->password }}"
            data-employee_id="{{ $item->employee_id }}"
            data-image="{{ $item->image }}"  
            > 
              <i class="las la-edit"></i></a>
            <a href="" class="btn btn-danger deletemployee"  
            data-id="{{ $item->id }}"
            data-name="{{ $item->name }}"
            ><i class="las la-times"></i></a>
            
          </th>
       
        </tr>
      @endforeach
      
    </tbody>
  </table>
      {!! $employees->links('pagination::bootstrap-4') !!}





      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>




<script>
  $(document).ready(function() {
    $(document).on('click', '.addEmployeedata', function(e) {
      e.preventDefault();

      let name = $('#name').val();
      let email = $('#email').val();
      let phone = $('#phone').val();
      let password = $('#password').val();
      let image = $('#image').val();
      let employee_id = $('#employee_id').val();


      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      $.ajax({
        url: "{{ route('employees.store') }}",

        method: 'post',
        data: {
          name: name,
          email: email,
          phone: phone,
          password: password,
          image: image,
          employee_id: employee_id,
        },
        success: function(res) {
          if (res.status === "success") {
            $('#employeeForm')[0].reset();
            $('#addemployeemodal').modal('hide'); // Corrected line to hide the modal
            $('.table').load(location.href+' .table');
            Command: toastr["success"]("Employee Added Successfully")

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
    $(document).on('click','.editmodalemployee',function(){
     
      let id=$(this).data('id');
      let name=$(this).data('name');
      let email=$(this).data('email');
      let password=$(this).data('password');
      let image=$(this).data('image');
      let phone=$(this).data('phone');
      let employee_id=$(this).data('employee_id');

      $('#u_id').val(id);
      $('#u_name').val(name);
      $('#u_email').val(email);
      $('#u_password').val(password);
      $('#u_image').val(image);
      $('#u_phone').val(phone);
      $('#u_employee_id').val(employee_id);


      
    });
    $(document).on('click', '.updateemployee', function(e) {
      e.preventDefault();

      let u_id = $('#u_id').val();
      let u_name = $('#u_name').val();
      let u_email = $('#u_email').val();
      let u_phone = $('#u_phone').val();
      let u_password = $('#u_password').val();
      let u_image = $('#u_image').val();
      let u_employee_id = $('#u_employee_id').val();


      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      $.ajax({
        url: "{{ route('employees.update') }}",
        method: 'post',
        data: {
          u_id: u_id,
          u_name: u_name,
          u_email: u_email,
          u_phone: u_phone,
          u_password: u_password,
          u_image: u_image,
          u_employee_id: u_employee_id,
        },
        success: function(res) {
          if (res.status === "update") {
            $('#updateemployeeform')[0].reset();
            $('#editemployeemodal').modal('hide'); // Corrected line to hide the modal
            $('.table').load(location.href+' .table');
            Command: toastr["success"]("Employee Update Successfully")

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
    $(document).on('click', '.deletemployee', function(e) {
      e.preventDefault();
      let id = $(this).data('id');
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    if(confirm("Are you sure to delete ??")){
      $.ajax({
        url: "{{ route('employees.destroy') }}",
        method: 'post',
        data: {
          id: id,
        
        },
        success: function(res) {
          if (res.status === "deleted") {
            Command: toastr["success"]("Employee Deleted Successfully")

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

<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

@endsection
