@extends('layouts.admin')

@section('content')
  <!-- Page Heading -->

  <div class="col-xl-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between">
          <h4 class="card-title user-titles">Blogs </h4>
          <i class="mdi ">

    
              <span class="float-right " >
                  <button type="button" id="add" class="btn btn-secondary" data-toggle="modal" data-target=".addBlog">Add Blogs<span class="user-titles"></span> </button>
              </span>
          </i>
       
        </div>
      </div>
    
      <div class="my-blogs">
      </div>

  </div>

<div class="modal fade addBlog" id="addBlog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add  <span class="user-titles"></span> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="addBlogForm">
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col">
              <label class="bmd-label-floating">Blog </label>
              <textarea  class=" summernote" name="description"
              id="description"  ></textarea>
            </div>
            <input class="user_id" name="id" type="hidden" >
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary add-blog">Add </button>
        </div>
      </form>

    </div>
  </div>
</div>



@push('javascript')
<script src="{{asset('admin-assets/js/summernote.js')}}"></script>

<script>


$(document).ready(function() {
    $('.summernote').summernote();
});
    	

console.log( getCookie('name'));
  function setupUserData(){
      console.log( getCookie('name'));
  }

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



$(document).on('click', '.add-blog', function() {
  
  $('.user_id').val(getCookie('id'));
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': getCookie('token'),
        }
    });
    var form = $('#addBlogForm');
    $.ajax({
          type: "POST",
          url: "{{route('add-blogs')}}",
          data: form.serialize(),// serializes the form's elements.
          success: function(data)
          {
             
                $('#addBlog').modal('hide');
                location.reload();
          },

      });
});
getBlogs();
function getBlogs(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': getCookie('token'),
            }
        });
        $.ajax({
            type: "POST",
            url: "{{route('get-blogs')}}",
            data : { id : getCookie('id') }, // serializes the form's elements.
            success: function(data)
            {
              
                
                  console.log( data);
                  for (i = 0; i < data.length; i++) {
               
                    $html = ' <div class="card-body">' + data[i].description +'</div>';
                    $(".my-blogs").append($html)
                  } 
                 
          
      
            }
        });
}
</script>
@endpush
@endsection
