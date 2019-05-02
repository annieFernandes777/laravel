@extends('layouts.app')

@section('content')
<div class="container">
    @if(!empty($students))
      <div id="product_container">
        <table class="table table-bordered">   
          <tr>
              <th>Name</th>
              <th>Department</th>          
              <th>Total Marks</th>
              <th>Edit</th>
              <th>Delete</th>
          </tr>
          @foreach ($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->dep }}</td>
                <td>{{ $student->total_marks }}</td>
                <td><button id="edit-bt" onclick="editStudent({{ $student->id }});">Edit</button>
                <td><button id="delete-bt" onclick="deleteStudent({{ $student->id }});">Delete</button>
            </tr>
          @endforeach
        </table>
        {!! $students->links() !!}
      </div>
    @else
      <div class="alert alert-success" style="display: none;"></div>
      <a href="{{ url('/student/view') }}">View Student List</a>
      <form id="addStudentForm" onsubmit="addStudent();return false;">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-control required" required>
        </div>
        <div class="form-group">
          <label for="dep">Department</label>
          <input type="text" name="dep" id="dep" class="form-control required" required>
        </div>
        <div class="form-group">
          <label for="total_marks">Total Marks</label>
          <input type="text" name="total_marks" id="total_marks" class="form-control required" required>
        </div>
        <button type="submit" class="btn btn-primary" id="ajaxSubmit">Submit</button>
      </form>
    @endif
</div>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
  $(document).ready(function(){

 $(document).on('click', '.pagination a', function(event){
  event.preventDefault(); 
  var page = $(this).attr('href').split('page=')[1];
  fetch_data(page);
 });

 function fetch_data(page)
 {
  $.ajax({
   url:"/fetch_data?page="+page,
   success:function(data)
   {
    $('#table_data').html(data);
   }
  });
 }
 
});
	function addStudent() {
		jQuery.ajaxSetup({
		  headers: {
		      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
       	jQuery.ajax({
          	url: "{{ url('/student/post') }}",
          	method: 'post',
          	data: {
             	name: jQuery('#name').val(),
             	dep: jQuery('#dep').val(),
             	total_marks: jQuery('#total_marks').val()
          	},
          	success: function(result){
          		$(".alert-success").show();
          		$(".alert-success").html(result.success);
             	console.log(result);
          	}
        });
	}

  function editStudent() {
    jQuery.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
        jQuery.ajax({
            url: "{{ url('/student/edit') }}",
            method: 'post',
            data: {

              name: jQuery('#name').val(),
              dep: jQuery('#dep').val(),
              total_marks: jQuery('#total_marks').val()
            },
            success: function(result){
              $(".alert-success").show();
              $(".alert-success").html(result.success);
              console.log(result);
            }
        });
  }
	
</script>
@endsection