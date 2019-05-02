@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
  
  <div id="product_container">
         <table class="table table-bordered">   
      <tr>
          <th>Name</th>
          <th>Department</th>          
          <th>Total Marks</th>
      </tr>
      @foreach ($students as $student)
      <tr>
          <td>{{ $student->name }}</td>
          <td>{{ $student->dep }}</td>
          <td>{{ $student->total_marks }}</td>
      </tr>
      @endforeach
   </table>
      {!! $students->links() !!}
  </div>
</div>
</div>
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
</script>
<!-- <script>
 $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });
$(document).ready(function()
{
     $(document).on('click', '.pagination a',function(event)
    {
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        event.preventDefault();
        var myurl = $(this).attr('href');
       var page=$(this).attr('href').split('page=')[1];
       getData(page);
    });
});
function getData(page){
        $.ajax(
        {
            url: '?page=' + page,
            type: "get",
            datatype: "html",
            // beforeSend: function()
            // {
            //     you can show your loader 
            // }
        })
        .done(function(data)
        {
            console.log(data);
            
            $("#product_container").empty().html(data);
            location.hash = page;
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
              alert('No response from server');
        });
}
  </script> -->
@endsection