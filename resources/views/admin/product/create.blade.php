@extends('layouts.admin')
@section('page_title') {{ ($product_info) ? "Update" : "Add"}} Product @endsection

@section('content')

<div class="page-heading">
    <h1 class="page-title"> Product</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}"><i class="la la-home font-20"></i> Home</a>
        </li>
        <li class="breadcrumb-item"> {{ ($product_info) ? "Update" : "Add"}} Product</li>
    </ol>

</div>
@include('admin.section.notifications')
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">{{ ($product_info) ? "Update" : "Add"}} Product</div>
            <div>
                <a class="btn btn-info btn-md" href="{{route('product.index')}}">All Products</a>
            </div>
        </div>
    </div>

    {{--dd($product_info)--}}
    @if(@$product_info == null)
    <form class="form form-responsive form-horizontal" action="{{route('product.store')}}" enctype="multipart/form-data" method="post">
        @else
        <form class="form form-responsive form-horizontal" action="{{route('product.update', $product_info->id)}}" enctype="multipart/form-data" method="post">
            <input type="hidden" name="_method" value="PUT">
            @endif
            {{csrf_field()}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-12">
                            <div class="ibox">
                                <div class="ibox-head">
                                    <div class="ibox-title">Product Information</div>
                                </div>
                                <div class="ibox-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 form-group">
                                            <label><strong>Product Title</strong></label>
                                            <input class="form-control" type="text" value="{{ (@$product_info->title) ?  @$product_info->title: old('title')}}" name="title" placeholder="Product Title Here">

                                            @if($errors->has('title'))
                                            <div class="error alert-danger">{{$errors->first('title')}}</div>
                                            @endif
                                        </div>

                                        <div class="col-lg-4 col-sm-12 form-group">
                                            <label><strong>Segment</strong></label>
                                            <select name="segment_id" id="segment_id" class="form-control">
                                                <option disabled selected>--Select Any One--</option>
                                                @if(isset($segments) && $segments->count())
                                                @foreach($segments as $segment => $segment_data)
                                                <option value="{{@$segment_data->id}}" {{((@$seg_info[0]->id == @$segment_data->id) ? 'selected' : '')}}>{{$segment_data->title}}</option>
                                                @endforeach
                                                @endif
                                            </select>


                                            @if($errors->has('segment_id'))
                                            <div class="error alert-danger">{{$errors->first('segment_id')}}</div>
                                            @endif
                                        </div>


                                        <div class="col-lg-4 col-sm-12 form-group">
                                            <label><strong>Category</strong></label>
                                            <select name="cat_id" id="cat_id" class="form-control">
                                                <option disabled selected>--Select Any One--</option>
                                                @if(isset($category_info) && $category_info->count())
                                                @foreach($category_info as $cat_key => $cat_data)
                                                <option value="{{@$cat_data->id}}" {{((@$cat_info[0]->id == @$cat_data->id) ? 'selected' : '')}}>{{$cat_data->title}}</option>
                                                @endforeach
                                                @endif
                                            </select>


                                            @if($errors->has('cat_id'))
                                            <div class="error alert-danger">{{$errors->first('cat_id')}}</div>
                                            @endif
                                        </div>

                                        <div class="col-lg-12 col-sm-12 form-group {{(((@$child_cat[0]->id) && ($child_cat[0]->id)) ? '' : 'd-none')}}" id="child_option">
                                            <label><strong>Sub Category</strong></label>
                                            <select name="cat_id" id="child_cat_id" class="form-control">
                                                @if(isset($sub_cat_info) && ($sub_cat_info->count()))
                                                @foreach($sub_cat_info as $sub_cat_data)
                                                <option value="{{$sub_cat_data->id}}" {{(($child_cat) && ($child_cat[0]->id == $sub_cat_data->id) ? 'selected' : '')}}>{{$sub_cat_data->title}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @if($errors->has('child_cat_id'))
                                            <div class="error alert-danger">{{$errors->first('child_cat_id')}}</div>
                                            @endif
                                        </div>

                                        <div class="col-lg-12 col-sm-12 form-group {{($grand_child_cat == null) ? 'd-none' : ''}}" id="grand_child_option">
                                            <label><strong>Grand Sub Category</strong></label>
                                            <select name="cat_id" id="grand_cat_id" class="form-control">
                                                @if(isset($grand_cat_info) && ($grand_cat_info->count()))
                                                @foreach($grand_cat_info as $grand_cat_data)
                                                <option value="{{$grand_cat_data->id}}" {{((@$grand_child_cat) && (@$grand_child_cat[0]->id == $grand_cat_data->id) ? 'selected' : '')}}>{{$grand_cat_data->title}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @if($errors->has('child_cat_id'))
                                            <div class="error alert-danger">{{$errors->first('child_cat_id')}}</div>
                                            @endif
                                        </div>

                                        {{--
                                <div class="col-lg-12 col-sm-12 form-group">
                                    <label><strong>Summary</strong></label>
                                    <textarea name="summary" id="summary"   rows="5" placeholder="Summary Here" class="form-control" style="resize: none;">{{ (@$product_info->summary) ?  @$product_info->summary: old('summary')}}</textarea>
                                        @if($errors->has('summary'))
                                        <div class="error alert-danger">{{$errors->first('summary')}}</div>
                                        @endif
                                    </div>
                                    --}}
                                    <div class="col-lg-4 col-sm-12 form-group">
                                        <label><strong> Prices</strong></label>
                                        <input class="form-control" type="text" id="" value="{{ (@$product_info->prices) ?  @$product_info->prices: old('prices')}}" name="prices" placeholder="Product Price">

                                        @if($errors->has('prices'))
                                        <div class="error alert-danger">{{$errors->first('prices')}}</div>
                                        @endif
                                    </div>



                                    <div class="col-lg-4 col-sm-12 form-group">
                                        <label>City</label>
                                        <select name="city_id" id="city_id" class="form-control">
                                            <option disabled selected>--Select Any One--</option>
                                            @if(isset($cities) && $cities->count())
                                            @foreach($cities as $city_key => $city_data)
                                            <option value="{{@$city_data->id}}" {{((@$city_info[0]->id == @$city_data->id) ? 'selected' : '')}}>{{$city_data->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>


                                        @if($errors->has('city_id'))
                                        <div class="error alert-danger">{{$errors->first('city_id')}}</div>
                                        @endif
                                    </div>

                                    <div class="col-lg-4 col-sm-12 form-group">
                                        <label>Area</label>
                                        <select name="area_id" id="area_id" class="form-control">
                                            <option disabled selected>--Select Any One--</option>
                                            @if(isset($areas) && $areas->count())
                                            @foreach($areas as $area_key => $area_data)
                                            <option value="{{@$area_data->id}}" {{((@$area_info[0]->id == @$area_data->id) ? 'selected' : '')}}>{{$area_data->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>


                                        @if($errors->has('city_id'))
                                        <div class="error alert-danger">{{$errors->first('city_id')}}</div>
                                        @endif
                                    </div>


                                    <div class="col-lg-4 col-sm-12 form-group">
                                        <label>Municipality</label>
                                        <select name="municipality_id" id="municipality_id" class="form-control">
                                            <option disabled selected>--Select Any One--</option>
                                            @if(isset($municipalities) && $municipalities->count())
                                            @foreach($municipalities as $municipality_key => $municipality_data)
                                            <option value="{{@$municipality_data->id}}" {{((@$municipality_info[0]->id == @$municipality_data->id) ? 'selected' : '')}}>{{$municipality_data->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>


                                        @if($errors->has('municipality_id'))
                                        <div class="error alert-danger">{{$errors->first('municipality_id')}}</div>
                                        @endif
                                    </div>



                                    <div class="col-lg-4 col-sm-12 form-group">
                                        <label>Ward</label>
                                        <select name="ward_id" id="ward_id" class="form-control">
                                            <option disabled selected>--Select Any One--</option>
                                            @if(isset($wards) && $wards->count())
                                            @foreach($wards as $ward_key => $ward_data)
                                            <option value="{{@$ward_data->id}}" {{((@$ward_info[0]->id == @$ward_data->id) ? 'selected' : '')}}>{{$ward_data->wardnumber}}</option>
                                            @endforeach
                                            @endif
                                        </select>


                                        @if($errors->has('ward_id'))
                                        <div class="error alert-danger">{{$errors->first('ward_id')}}</div>
                                        @endif
                                    </div>

                                    <div class="col-lg-4 col-sm-12 form-group">
                                        <label>Property Build Year</label>
                                        <select name="year_id" id="year_id" class="form-control">
                                            <option disabled selected>--Select Any One--</option>
                                            @if(isset($property_years) && $property_years->count())
                                            @foreach($property_years as $property_year_key => $property_year_data)
                                            <option value="{{@$property_year_data->id}}" {{((@$property_year_info[0]->id == @$property_year_data->id) ? 'selected' : '')}}>{{$property_year_data->years}}</option>
                                            @endforeach
                                            @endif
                                        </select>


                                        @if($errors->has('year_id'))
                                        <div class="error alert-danger">{{$errors->first('year_id')}}</div>
                                        @endif
                                    </div>


                                    <div class="col-lg-4 col-sm-12 form-group">
                                        <label>Property Face Direction</label>
                                        <select name="propertyface_id" id="propertyface_id" class="form-control">
                                            <option disabled selected>--Select Any One--</option>
                                            @if(isset($property_faces) && $property_faces->count())
                                            @foreach($property_faces as $property_face_key => $property_face_data)
                                            <option value="{{@$property_face_data->id}}" {{((@$property_face_info[0]->id == @$property_face_data->id) ? 'selected' : '')}}>{{$property_face_data->direction}}</option>
                                            @endforeach
                                            @endif
                                        </select>


                                        @if($errors->has('propertyface_id'))
                                        <div class="error alert-danger">{{$errors->first('propertyface_id')}}</div>
                                        @endif
                                    </div>




                                    <div class="col-lg-4 col-sm-12 form-group">

                                        <label>Land Area </label>
                                        <input class="form-control" type="text" id="land_area" value="{{ (@$product_info->land_area) ?  @$product_info->land_area: old('land_area')}}" name="land_area" placeholder="Land Area">




                                        @if($errors->has('land_area'))
                                        <div class="error alert-danger">{{$errors->first('land_area')}}</div>
                                        @endif
                                    </div>


                                    <div class="col-lg-4 col-sm-12 form-group">

                                        <label>Land Area Unit</label>

                                        <select name="landareatype_id" id="landarea_id" class="form-control">
                                            <option disabled selected>--Select Any One--</option>
                                            @if(isset($landareatypes) && $landareatypes->count())
                                            @foreach($landareatypes as $landareatype_key => $landareatype_data)
                                            <option value="{{@$landareatype_data->id}}" {{((@$landareatype_info[0]->id == @$landareatype_data->id) ? 'selected' : '')}}>{{$landareatype_data->title}}</option>
                                            @endforeach
                                            @endif
                                        </select>


                                        @if($errors->has('landareatype_id'))
                                        <div class="error alert-danger">{{$errors->first('landareatype_id')}}</div>
                                        @endif
                                    </div>


                                    <div class="col-lg-4 col-sm-12 form-group">
                                        <label><strong> Bed Room</strong></label>
                                        <input class="form-control" type="text" id="bedroom" value="{{ (@$product_info->bedroom) ?  @$product_info->bedroom: old('bedroom')}}" name="bedroom" placeholder="Bed Room">

                                        @if($errors->has('bedroom'))
                                        <div class="error alert-danger">{{$errors->first('bedroom')}}</div>
                                        @endif
                                    </div>

                                    <div class="col-lg-4 col-sm-12 form-group">
                                        <label><strong> Hall</strong></label>
                                        <input class="form-control" type="text" id="hall" value="{{ (@$product_info->hall) ?  @$product_info->hall: old('hall')}}" name="hall" placeholder="Hall">

                                        @if($errors->has('hall'))
                                        <div class="error alert-danger">{{$errors->first('hall')}}</div>
                                        @endif
                                    </div>

                                    <div class="col-lg-4 col-sm-12 form-group">
                                        <label><strong> Kitchen</strong></label>
                                        <input class="form-control" type="text" id="kitchen" value="{{ (@$product_info->kitchen) ?  @$product_info->kitchen: old('kitchen')}}" name="kitchen" placeholder="Kitchen">

                                        @if($errors->has('kitchen'))
                                        <div class="error alert-danger">{{$errors->first('kitchen')}}</div>
                                        @endif
                                    </div>



                                    <div class="col-lg-4 col-sm-12 form-group">
                                        <label><strong>Floor</strong></label>
                                        <input class="form-control" type="text" id="floor" value="{{ (@$product_info->floor) ?  @$product_info->floor: old('floor')}}" name="floor" placeholder="Floor">

                                        @if($errors->has('floor'))
                                        <div class="error alert-danger">{{$errors->first('floor')}}</div>
                                        @endif
                                    </div>


                                    <div class="col-lg-4 col-sm-12 form-group">
                                        <label><strong>Rest Room</strong></label>
                                        <input class="form-control" type="text" id="restroom" value="{{ (@$product_info->restroom) ?  @$product_info->restroom: old('restroom')}}" name="restroom" placeholder="Restroom">

                                        @if($errors->has('restroom'))
                                        <div class="error alert-danger">{{$errors->first('restroom')}}</div>
                                        @endif
                                    </div>


                                    <div class="col-lg-4 col-sm-12 form-group">
                                        <label><strong>Attached Rest Room</strong></label>
                                        <input class="form-control" type="text" id="attachedrestroom" value="{{ (@$product_info->attachedrestroom) ?  @$product_info->attachedrestroom: old('attachedrestroom')}}" name="attachedrestroom" placeholder="Attached Restroom">

                                        @if($errors->has('attachedrestroom'))
                                        <div class="error alert-danger">{{$errors->first('attachedrestroom')}}</div>
                                        @endif
                                    </div>









                                    <div class="form-group">
                                        <label for="description">Product Description</label>
                                        <textarea id="description" class="form-control" value="{{ (@$product_info->description) ?  @$product_info->description: old('description')}}" name="description" rows="3">{{(@$product_info->description) ?  @$product_info->description: old('description')}}</textarea>
                                    </div>

                                    <!--{{-- <div class="col-lg-4 col-sm-12 form-group">-->
                                    <!--    <label><strong>   discount</strong></label>-->
                                    <!--    <input class="form-control" type="text" id="discount_bx" value="{{ (@$product_info->discount) ?  @$product_info->discount: old('discount')}}" name="discount" placeholder="discount">-->

                                    <!--    @if($errors->has('discount'))-->
                                    <!--    <div class="error alert-danger">{{$errors->first('discount')}}</div>-->
                                    <!--    @endif-->
                                    <!--</div>-->

                                    <div class="col-lg-4 col-sm-12 form-group">
                                        <label><strong> Brand</strong></label>
                                        <input class="form-control" type="text" value="{{ (@$product_info->brand) ?  @$product_info->brand: old('brand')}}" name="brand" placeholder="Product Brand">

                                        @if($errors->has('brand'))
                                        <div class="error alert-danger">{{$errors->first('brand')}}</div>
                                        @endif
                                    </div>

                                    <div class="col-lg-4 col-sm-12 form-group">
                                        <label><strong> Model</strong></label>
                                        <input class="form-control" type="text" value="{{ (@$product_info->model) ?  @$product_info->model: old('model')}}" name="model" placeholder="Product Model">

                                        @if($errors->has('model'))
                                        <div class="error alert-danger">{{$errors->first('model')}}</div>
                                        @endif
                                    </div> --}}

                                </div>

                                <div class="row">

                                    {{-- <div class="col-lg-4 col-sm-12 form-group">
                                    <label class="ui-checkbox ui-checkbox-primary" style="margin-top: 35px;">
                                        <input type="checkbox" id="is_other" name="is_other" value="1" {{((@$product_info->is_other == 1) ? 'checked' : '')}}>
                                    <span class="input-span"></span><strong>Shipping Available</strong>
                                    </label>
                                </div> --}}

                                <!--<div class="col-lg-4 col-sm-12 form-group">-->
                                <!--    <label class="ui-checkbox ui-checkbox-primary" style="margin-top: 35px;">-->
                                <!--        <input type="checkbox" id="sale" name="sale" value="1" {{((@$product_info->sale == 1) ? 'checked' : '')}}>-->
                                <!--        <span class="input-span"></span><strong>Sale Offer</strong>-->
                                <!--    </label>-->
                                <!--</div>-->


                            </div>

                        </div>
                    </div>
                    <!-- <div class="ibox">
                        <div class="ibox-body">
                            <h5>SEO Tools</h5>
                            <div class="row">
                                <div class="col-lg-12 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for=""><strong>Meta Title</strong></label>
                                        <textarea name="meta_title" id="meta_title" rows="3" class="form-control" placeholder="Meta Title" style="resize:none;" >{{ (@$product_info->meta_title) ?  @$product_info->meta_title: old('meta_title')}}</textarea>
                                        @if($errors->has('meta_title'))
                                            <div class="error alert-danger">{{$errors->first('meta_title')}}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for=""><strong>Meta Description</strong></label>
                                        <textarea name="meta_description" id="meta_description" rows="3" class="form-control" placeholder="Meta Description here" style="resize:none;">{{ (@$product_info->meta_description) ?  @$product_info->meta_description: old('meta_description')}}</textarea>
                                        @if($errors->has('meta_description'))
                                        <div class="error alert-danger">{{$errors->first('meta_description')}}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for=""><strong>Keyword</strong></label>
                                        <textarea name="meta_keyword" id="meta_keyword" rows="3" class="form-control" placeholder="Meta Keyword here" style="resize:none;">{{ (@$product_info->meta_keyword) ?  @$product_info->meta_keyword: old('meta_keyword')}}</textarea>
                                        @if($errors->has('meta_keyword'))
                                        <div class="error alert-danger">{{$errors->first('meta_keyword')}}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for=""><strong>Meta Keyphrase</strong></label>
                                        <textarea name="meta_keyphrase" id="meta_keyphrase" rows="3" class="form-control" placeholder="Meta Keyphrase here" style="resize:none;">{{ (@$product_info->meta_keyphrase) ?  @$product_info->meta_keyphrase: old('meta_keyphrase')}}</textarea>
                                        @if($errors->has('meta_keyphrase'))
                                        <div class="error alert-danger">{{$errors->first('meta_keyphrase')}}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  -->
                </div>
                <div class="col-lg-3">

                    <div class="ibox">
                        <div class="ibox-body">


                            <div class="form-group">
                                <label> Upload Main Banner </label>
                                {{--
                                <div class=" alert-danger p-a3" style="padding:10px;"> [ Image size: width:765px, height:1020px ]</div>
                                --}}
                                <input class="form-control" type="file" name="image" id="image" accept="image/*" onchange="showThumbnail(this);">
                                @if($errors->has('image'))
                                <div class="error alert-danger">{{$errors->first('image')}}</div>
                                @endif
                            </div>
                            @php
                            $thumbnail = asset('assets/admin/images/default.png');
                            @endphp
                            @if(isset($product_info->image) && !empty($product_info->image) && file_exists(public_path().'/uploads/product/'.$product_info->path.'/thumbnail/'.$product_info->image))
                            @php
                            $thumbnail = asset('/uploads/product/'.$product_info->path.'/thumbnail/'.$product_info->image);
                            @endphp
                            @endif
                            <div class="form-group">
                                <div class="m-r-10">
                                    <img src="{{$thumbnail}}" alt="No Image" class=" img img-thumbnail  img-sm rounded" id="thumbnail">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Status:</label>
                                <select class="form-control" name="status">
                                    <option value="Publish" {{@($product_info->status == "Publish") ? "selected" :""}}>Publish</option>
                                    <option value="Unpublish" {{@($product_info->status == "Unpublish") ? "selected" :""}}>Unpublish</option>
                                </select>
                            </div>
                            @if($errors->has('status'))
                            <span class=" alert-danger">{{$errors->first('status')}}</span>
                            @endif
                            <div class="form-group">



                                <!-- Preview Section -->
                                <div id="image-preview"></div>
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit"> <span class="fa fa-send"></span> Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
</form>
@if($product_info)
<hr>
<h4>Upload Product Images</h4>

<form method="POST" action="{{ route('productimages.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product_info->id }}">

    <div class="form-group">
        <label>Select Images</label>
        <input type="file" name="images[]" multiple class="form-control" accept="image/*" onchange="previewImages(event)">
    </div>

    <div id="image-preview" class="d-flex flex-wrap mb-3"></div>

    <button type="submit" class="btn btn-success">Upload Images</button>
</form>
@if($product_info->images && $product_info->images->count())
<div class="row mt-4">
    @foreach($product_info->images as $img)
    <div class="col-md-2 text-center mb-3">
        
		
        <img src="{{ asset('images/listing/'.$img->images) }}" width="100" class="img-thumbnail">
        <form action="{{ route('productimages.destroy', $img->id) }}" method="POST" style="margin-top:5px;">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this image?')">Delete</button>
        </form>
    </div>
    @endforeach
</div>
@endif

@endif

@endsection
@section('scripts')

<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script type="text/javascript" src="{{asset('/assets/admin/js/laravel-file-manager-ck-editor.js')}}"></script>
<script src="{{asset('/assets/admin/js/sweetalert.js')}}" type="text/javascript"></script>
<script>
    // Ckeditor('highlight');
    // Ckeditor('description');
    function preventAlph(className) {
        $(className).keypress(function(event) {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
    }
    var class_name = $('#price_box, #discount_bx, #land_area');
    preventAlph(class_name);


    function showThumbnail(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
        }
        reader.onload = function(e) {
            $('#thumbnail').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
    $(document).ready(function() {
        $('#cat_id').on('change', function(e) {
            e.preventDefault();
            var cat_id = $(this).val();

            $.ajax({
                url: "{{route('getChildCategoryByCatId')}}",
                method: "POST",
                data: {
                    cat_id: cat_id,
                    _token: "{{csrf_token()}}"
                },
                success: function(response) {
                    // console.log(response);
                    if (response.status == true) {
                        $('#child_option').removeClass('d-none');
                        $('#child_cat_id').html(response.html);
                    }
                    if (response.status == false) {
                        if (response.type == null) {
                            FailedResponseFromDatabase(response.message);
                        }
                        $('#child_option').addClass('d-none');
                        $('#child_cat_id').html('');
                        $('#grand_child_option').addClass('d-none');
                        $('#grand_cat_id').html('');
                    }
                }
            })
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
</script>

<script>
    Ckeditor('description', 250);

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


<script>
    function showThumbnails(input) {
        var preview = document.getElementById('image-preview');
        preview.innerHTML = ""; // Clear previous previews

        if (input.files) {
            for (let i = 0; i < input.files.length; i++) {
                let file = input.files[i];
                let reader = new FileReader();

                reader.onload = function(e) {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '150px';
                    img.style.margin = '5px';
                    img.style.border = '1px solid #ddd';
                    img.style.padding = '5px';
                    img.style.borderRadius = '5px';
                    preview.appendChild(img);
                }

                reader.readAsDataURL(file);
            }
        }
    }
</script>

@endsection