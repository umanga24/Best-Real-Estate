@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Cities</h1>
                    <a href="{{route('area.index')}}" class="float-end btn btn-info">Back</a>

                </div>

                <div class="card-body">

                    <form action="{{route('area.update', $area->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="name">Name of City</label>
                            <input id="title" class="form-control" type="text" name="name" value="{{$area->name}}" placeholder="enter area">
                        </div>

                        
                        <div class="form-group">
                            <label>City</label>
                            <select name="city_id" id="city_id" class="form-control">
                                <option disabled selected>--Select Any One--</option>
                                @if(isset($cities) && $cities->count())
                                @foreach($cities as $city_key => $city_data)
                                <option value="{{@$city_data->id}}" {{((@$city_info[0]->id == @$city_info->id) ? 'selected' : '')}}>{{$city_data->name}}</option>
                                @endforeach
                                @endif
                            </select>


                            @if($errors->has('city_id'))
                            <div class="error alert-danger">{{$errors->first('city_id')}}</div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-info">Update</button>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    function showThumbnail(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
        }
        reader.onload = function(e) {
            $('#thumbnail').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
</script>
<script src="//cdn.ckeditor.com/4.9.1/full/ckeditor.js"></script>
<script type="text/javascript" src="{{asset('/assets/admin/js/laravel-file-manager-ck-editor.js')}}"></script>
<script type="text/javascript" src="{{asset('/assets/admin/js/datepicker.js')}}"></script>
<script>
    Ckeditor('description', 250);

    $(document).ready(function() {
        $('#published_date').datepicker({
            theme: 'green',
            outputFormat: 'y-MM-dd'
        });
        $('#published_date').keypress(function(event) {
            event.preventDefault();
        })
    });


    $(document).ready(function() {
        $('#create_url').keyup(function(e) {
            var url = "{{route('homepage')}}";
            if (e.shiftKey || e.altKey || e.keyCode == 32) {
                e.preventDefault();
            } else {
                var key = e.keyCode;
                if ((key >= 48 && key <= 58) || (key >= 66 && key <= 90) || key == 189 || key == 8) {
                    var slug = $(this).val();
                    $.ajax({
                        method: "post",
                        url: "{{route('checkBlogSlug')}}",
                        data: {
                            slug: slug,
                            _token: "{{csrf_token()}}",
                            id: "{{@$post_info->id}}",
                        },
                        success: function(response) {
                            if (response.status == true) {
                                url = url + '/blog/' + response.slug;
                                $('.message_for_slug_error').addClass('display_none');
                                $('.message_for_slug').removeClass('display_none').html('<p> <i class="fa fa-check"></i> ' + response.message + '</p>');
                                $('#updated_url').html(url);
                            }
                            if (response.status == false) {
                                $('.message_for_slug').addClass('display_none');
                                $('.message_for_slug_error').removeClass('display_none').html('<p> <i class="fa fa-times"></i> ' + response.message + '</p>');
                                $('#updated_url').html(url + '/blog/' + "{{@$post_info->slug}}");
                                $('#create_url').val("{{@$post_info->slug}}");
                                FailedResponseFromDatabase(response.message);
                            }
                        }
                    })


                } else {
                    e.preventDefault();
                }
            }
        })

    })

    function FailedResponseFromDatabase(message) {
        html_error = "";
        $.each(message, function(index, message) {
            html_error += '<p class ="error_message text-left"> <span class="fa fa-times"></span> ' + message + '</p>';
        });
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            html: html_error,
            confirmButtonText: 'Close',
            timer: 10000
        });
    }

    function DataSuccessInDatabase(message) {
        Swal.fire({
            // position: 'top-end',
            type: 'success',
            title: 'Done',
            html: message,
            confirmButtonText: 'Close',
            timer: 10000
        });
    }
</script>

@endsection