@extends('layouts.front')

@include('layouts.navbar')

@section('content')
<section class="listing-page">
    <div class="container">
      



 

            <div class="col-lg-12 col-md-12 col-12">
                <div class="row"

                    @if(count($relatedProducts)> 0)
                    <h4>Related Products</h4>
                    <div class="row">
                        @foreach($relatedProducts as $property)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="property-item rounded overflow-hidden">
                                <div class="position-relative overflow-hidden">
                                    <a href=""><img class="img-fluid" src="{{asset('/uploads/product/'.$property->path.'/main/'.$property->image)}}" alt=""></a>
                                    <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For {{$property->segment->title}}</div>
                                    <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{$property->category->title}}</div>
                                </div>
                                <div class="p-4 pb-0">
                                    <h5 class="text-primary mb-3">Rsss {{$property->price}}</h5>
                                    <a class="d-block h5 mb-2" href="{{route('propertyDetails', $property->slug)}}">{{$property->title}}</a>
                                    <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$property->area->name}}, {{$property->city->name}}</p>
                                </div>
                                <div class="d-flex border-top">
                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{$property->land_area}} {{$property->landareatype->title}}</small>
                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$property->bedroom}} Bed</small>
                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-bath text-primary me-2"></i>{{$property->restroom}} Bath</small>
                                    <small class="flex-fill text-center py-2"><i class="fa fa-utensils text-primary me-2"></i>{{$property->kitchen}} Kitchen</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif




                    @if(count($results['products']) > 0)

                    <ul>
                        @foreach($results['products'] as $property)

                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="property-item rounded overflow-hidden">
                                <div class="position-relative overflow-hidden">
                                    <a href=""><img class="img-fluid" src="{{asset('/uploads/product/'.$property->path.'/main/'.$property->image)}}" alt=""></a>
                                    <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For {{$property->segment->title}}</div>
                                    <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{$property->category->title}}</div>
                                </div>
                                <div class="p-4 pb-0">
                                    <h5 class="text-primary mb-3">Rs {{$property->price}}</h5>
                                    <a class="d-block h5 mb-2" href="{{route('propertyDetails', $property->slug)}}">{{$property->title}}</a>
                                    <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$property->area->name}}, {{$property->city->name}}</p>
                                </div>
                                <div class="d-flex border-top">
                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{$property->land_area}} {{$property->landareatype->title}}</small>
                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$property->bedroom}} Bed</small>
                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-bath text-primary me-2"></i>{{$property->restroom}} Bath</small>
                                    <small class="flex-fill text-center py-2"><i class="fa fa-utensils text-primary me-2"></i>{{$property->kitchen}} Kitchen</small>
                                </div>
                            </div>
                        </div>





                        @endforeach
                    </ul>
                    @endif

                    @if(count($results['categories']) == 0 && count($results['products']) == 0)
                    <p>No results found for the given search criteria.</p>
                    @endif
                </div>
            </div>
            @include('front.product.product-body')
    </div>
    </div>
</section>
@endsection