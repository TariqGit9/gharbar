@extends('layouts.admin')

@section('content')
  <!-- Page Heading -->

<div class="col-xl-12">
  <div class="card">
    <div class="card-header pb-0">
      <div class="d-flex justify-content-between">
        <h4 class="card-title user-titles">Users </h4>
        <i class="mdi ">

            <span class="float-right ml-3" >
                <select class="form-control selectpicker @if(Auth::user()|| auth()->guard('admin')->check()) d-none @endif" data-live-search="true" name="user_roles" id="user_roles" >
                        <option value="blogger">Blogger</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                </select>
            </span>
            <span class="float-right " >
                <button type="button" id="add_admin" class="btn btn-secondary" data-toggle="modal" data-target=".addUser">Add <span class="user-titles"></span> </button>
            </span>
        </i>

      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table datatable" id="table_data" width="100%" cellspacing="0">
          <tbody>  
              <thead class=" text-primary" >
                  <tr>
                      <th class="all" width="2"></th>
                      <th >Name</th>
                      <th >Email</th>
                      <th >Action</th>
                  </tr>
              </thead>
          </tbody>
      </table>
      </div>
    </div>
  </div>
</div>



<div class="modal fade addUser" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add  <span class="user-titles"></span> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="addUserForm">
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col ">
              <label class="bmd-label-floating form-required">Name </label>
              <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
            </div>
            <div class="form-group col">
              <label class="bmd-label-floating ">Email</label>
              <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary add-user">Add </button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="modal fade editUser" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit <span class="user-titles"></span> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editUserForm">
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col ">
              <label class="bmd-label-floating form-required">Name </label>
              <input type="text" class="form-control" id="edit_name" name="edit_name" aria-describedby="emailHelp">
            </div>
            <div class="form-group col">
              <label class="bmd-label-floating ">Email</label>
              <input type="text" class="form-control" id="edit_email" name="edit_email" aria-describedby="emailHelp">
              <input type="hidden" class="form-control" id="edit_id" name="edit_id" aria-describedby="emailHelp">
              <input type="hidden" class="form-control" id="edit_type" name="edit_type" aria-describedby="emailHelp">

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary add-user">Add </button>
        </div>
      </form>

    </div>
  </div>
</div>

@push('javascript')
<script>

var table;
var active_user = 'blogger';
$('.user-titles').text($("#user_roles option:selected").text());
dataTableData(active_user);
function dataTableData(user_type){
    $("#table_data").dataTable().fnDestroy();
    table=$('#table_data').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{route('get-all-users')}}", type: 'post',
            data: {
            user_type: user_type,
            "_token": "{{ csrf_token() }}",
        }
        },
        columns: [
        {
            'className': 'details-control',
            'orderable': false,
            'data': null,
            'defaultContent': ''
        },
    
        {
            data: 'name',
            name: 'name',
          
        },
        {
            data: 'email',
            name: 'email',
          
        },
        {
            data: 'action',
            name: 'action',
            orderable: false
        }
        ]
});
}


$('#user_roles').on('change', function() {
    active_user = $('#user_roles').val();
    dataTableData($('#user_roles').val());
    $('.user-titles').text($("#user_roles option:selected").text());
});

$(document).on('click', '.update-user', function() {
  var id = $(this).data('id');
  var type = $(this).data('type');
  var name = $(this).data('name');
  var email = $(this).data('email');
  $('#edit_email').val(email);
  $('#edit_name').val(name);
  $('#edit_id').val(id);
  $('#edit_type').val(type);
  $('#editUser').modal('show');
});
$(document).on('click', '.delete', function() {
  var color='#ca0b00';
  Swal.fire({
        title: 'Are you sure?',
        text: 'Are you sure you want to delete this user?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: color,
        cancelButtonText: "Cancel",
        confirmButtonText: "Delete",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

        }
    });
});
</script>
@endpush
@endsection
