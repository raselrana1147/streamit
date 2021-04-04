@extends('layouts.backend.app')
@section('title','Streamit | Category Edit')
@section('content')
<div id="alert_section"></div>
@include('admin.helper.success_error')
<div class="row">
   <div class="col-sm-12">
      <div class="iq-card">
         <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">

               <h4 class="card-title">Edit Category</h4>
            </div>
         </div>
         <div class="iq-card-body">
            <div class="row">
               <div class="col-lg-12">
                 <form data-action="{{ route('category.update') }}" method="post" id="update_category_form">
                  	@csrf
                     <div class="form-group">
                        <input type="text" class="form-control" name="category_name" value="{{$category->category_name}}">
                     </div>
                     <input type="hidden" name="category_id" value="{{$category->id}}">
                     <div class="form-group">
                        <textarea id="text" name="description" rows="5" class="form-control">{{$category->description}}</textarea>
                     </div>
                   
                     <div class="form-group ">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="javascript:history.back();" class="btn btn-danger">Back</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
	
@endsection

@section('admin_js')

   <script>
    

     $(document).on('submit', '#update_category_form', function(e){
        e.preventDefault();
      let formDta = new FormData(this);
      $.ajax({
        url: $(this).attr('data-action'),
        method: "POST",
        data: formDta,
        cache: false,
        contentType: false,
        processData: false,
        success:function(response){
          let data=JSON.parse(response);
          if (data.status===200) {
            $('#alert_section').html('<div class="alert alert-success"> <i class="fas fa-check-circle"></i>'+data.message+'</div>').show();
          }else{
            $('#alert_section').html('<div class="alert alert-success"> <i class="fas fa-check-circle"></i>'+data.message+'</div>').show();
          }
         
         
         
        },
        error:function(response){
          console.log(response);

            $('#alert_section').html('<div class="alert alert-primary"> <i class="fas fa-check-circle"></i>'+response.responseJSON.errors['category_name'][0]+'</div>').show();
        }
      });
     });

   </script>
@endsection

