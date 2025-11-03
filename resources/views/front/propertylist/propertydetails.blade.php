@extends('layouts.front')

@include('layouts.navbar')

@section('content')
<div class="container my-5">
    <div class="row">
        <!-- Property Image Slider -->
        <div class="col-lg-8 mb-4">
            <div class="col-md-9 mb-6 animated fadeIn">
                <div class="owl-carousel header-carousel">
                    <div class="owl-carousel-item">
                        <img class="img-fluid" src="{{ asset('/assets/front/img/carousel-1.jpg') }}" alt="Property Image">
                    </div>
                    <div class="owl-carousel-item">
                        <img class="img-fluid" src="{{ asset('/assets/front/img/carousel-2.jpg') }}" alt="Property Image">
                    </div>
                </div>
            </div>
        </div>

        <!-- Property Overview -->
        <div class="col-lg-4">
            <h2 class="text-primary">{{ $property->title }}</h2>
            <h6 class="text-danger">Property ID: {{ $property->id }}</h6>
            <p class="text-muted">
                <i class="fa fa-map-marker-alt"></i> {{ $property->area->name }}, {{ $property->city->name }}, {{ $property->municipality->name }}<br>
                <strong>Ward Number:</strong> {{ $property->ward->wardnumber }}
            </p>
            <h3 class="text-danger">Price: Rs. {{ $property->price }}</h3>
            <hr>

           

            <!-- Contact Information -->
            <h5 class="text-secondary">Contact Person</h5>
            <strong>Name:</strong> {{ $property->username }}<br />
            <strong>Mobile:</strong> {{ $property->number1 }}</br />
            <strong>Phone:</strong> {{ $property->number2 }}
            <hr>



             <!-- Property Description -->
             <h5 class="text-secondary">Description</h5>
            <p>{!! $property->description ?? 'No description available.' !!}</p>
            <hr>
        </div>
    </div>

    <!-- Additional Property Details -->
    <div class="row mt-8">
        <div class="col-lg-10">
            <h4 class="text-secondary">Additional Details</h4>
            <div class="row">
                <div class="col-md-6">
                    <strong>Property Type:</strong> {{ $property->category->title }}
                </div>
                <div class="col-md-6">
                    <strong>Land Area:</strong> {{ $property->land_area }} {{ $property->landareatype->title }}
                </div>
                <div class="col-md-6">
                    <strong>Property Face:</strong> {{ $property->propertyface->direction }}
                </div>
                <div class="col-md-6">
                    <strong>Build Year:</strong> {{ $property->year->years }}
                </div>
                <div class="col-md-6">
                    <strong>Floors:</strong> {{ $property->floor }}
                </div>
                <div class="col-md-6">
                    <strong>Bedrooms:</strong> {{ $property->bedroom }}
                </div>
                <div class="col-md-6">
                    <strong>Hall:</strong> {{ $property->hall }}
                </div>
                <div class="col-md-6">
                    <strong>Kitchen:</strong> {{ $property->kitchen }}
                </div>
                <div class="col-md-6">
                    <strong>Bathrooms:</strong> {{ $property->restroom }}
                </div>
                <div class="col-md-6">
                    <strong>Attached Bathrooms:</strong> {{ $property->attachedrestroom }}
                </div>
            </div>
        </div>
        <hr/>

        <!-- Property Amenities -->
        <div class="col-lg-10">
            <h4 class="text-secondary">Amenities</h4>
          
                <li class=""></i> Example Amenity 1</li>
                <li class=""></i> Example Amenity 2</li>
                <li class=""></i> Example Amenity 3</li>
           
        </div>
    </div>
</div>

@endsection
<!-- Owl Carousel -->
<link rel="stylesheet" href="{{ asset('/assets/front/lib/owlcarousel/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/front/lib/owlcarousel/assets/owl.theme.default.min.css') }}">
<!-- Owl Carousel -->
<script src="{{ asset('/assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#property-slider").owlCarousel({
            items: 1, // Show one image at a time
            loop: true,
            nav: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 3000,
            navText: ['<i class="bi bi-chevron-left"></i>', '<i class="bi bi-chevron-right"></i>']
        });
    });
</script>