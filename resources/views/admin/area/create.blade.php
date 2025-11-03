@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Area</h1>
                    <a href="{{route('area.index')}}" class="float-end btn btn-info">Back</a>

                </div>

                <div class="card-body">

                    <form action="{{route('area.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Area</label>
                            <input id="title" class="form-control" type="text" name="name" placeholder="enter area">
                        </div>



                        <div class="form-group">
                            <label>City</label>
                            <select name="city_id" id="city_id" class="form-control">
                                <option disabled selected>--Select Any One--</option>
                                @if(isset($cities) && $cities->count())
                                @foreach($cities as $city_key => $city_data)
                                <option value="{{@$city_data->id}}" {{((@$city_data[0]->id == @$city_data->id) ? 'selected' : '')}}>{{$city_data->name}}</option>
                                @endforeach
                                @endif
                            </select>


                            @if($errors->has('city_id'))
                            <div class="error alert-danger">{{$errors->first('city_id')}}</div>
                            @endif
                        </div>


                        <!-- <div class="form-group">
                            <label for="title">City</label>
                            <input id="title" class="form-control" type="text" name="name" placeholder="enter area">
                        </div> -->

                        <button type="submit" class="btn btn-info">Submit</button>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script src="//cdn.ckeditor.com/4.9.1/full/ckeditor.js"></script>
<script type="text/javascript" src="{{asset('/assets/admin/js/laravel-file-manager-ck-editor.js')}}"></script>
<script type="text/javascript" src="{{asset('/assets/admin/js/datepicker.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>




@endsection