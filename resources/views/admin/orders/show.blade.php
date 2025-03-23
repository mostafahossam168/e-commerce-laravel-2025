@extends('admin.layouts.admin', [
    'title' => 'عرض الطلب',
])

@section('content')
    <div class="main-side">
        <div class="header-order ">
            <h1 class="title   ">
                الطلب
                {{ $item->number }}
            </h1>
            <div class="d-flex gap-3">
                <div class="date">
                    {{ format_date_time($item->created_at) }}
                </div>
            </div>
        </div>
        <div class="row mt-4 g-3">
            <div class="col-12 col-md-6 col-lg-8">
                <div class="box-order">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="title m-0">
                            المنتجات المطلوبة
                        </div>
                        <div class="badge  bg-{{ $item->status->color() }} rounded-3">
                            {{ $item->status->name() }}
                        </div>
                    </div>
                    <div class="cart-product">
                        @foreach ($item->products as $product)
                            <div class="product">
                                <img loading="lazy" width="50" src="{{ display_file($product->product?->main_image) }}"
                                    alt="img">
                                <div class="content d-flex justify-content-between align-items-center">
                                    <div class="top">
                                        <div class="text">
                                            {{ $product->product?->name }}
                                        </div>
                                    </div>
                                    <div class="bottom d-flex flex-column align-items-start gap-2 p-0">
                                        <div class="items-holder">
                                            <span class="item">الكمية :</span>
                                            <span class="count">{{ $product->qty }}</span>
                                        </div>
                                        <div class="items-holder">
                                            <span class="item">السعر :</span>
                                            <span class="count">{{ $product->price }} </span>
                                        </div>
                                        <div class="items-holder">
                                            <span class="item"> الاجمالى
                                                :</span>
                                            <span class="count">{{ $product->qty * $product->price }} </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="side-info-bar mb-3 box-order">
                            <div class="title">
                                ملخص الطلب
                            </div>
                            <ul class="sum-list mb-0">
                                <li>
                                    <div class="key">
                                        <span class="name">المجموع قبل الضريبة</span>
                                    </div>
                                    <p class="value"> {{ $item->subtotal }}</p>
                                </li>
                                <li>
                                    <div class="key">
                                        <span class="name">الضريبة</span>
                                    </div>
                                    <p class="value"> {{ $item->tax }}</p>
                                </li>
                                <li>
                                    <div class="key">
                                        <span class="name">تخفيض</span>
                                    </div>
                                    <p class="value"> {{ $item->offer }}</p>
                                </li>
                                <li>
                                    <div class="key">
                                        <span class="name fw-bold">المجموع الكلي</span>
                                    </div>
                                    <p class="value fw-bold"> {{ $item->total }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="box-order">
                    <div class="title">
                        العميل
                    </div>

                    <div class="customer-box">
                        <div class="info">
                            {{ $item->user?->name }}

                            <div class="top">
                                <img loading="lazy" width="50"
                                    src="{{ $item->user?->image?->path ? display_file($item->user->image->path) : asset('admin-asset/img/no-image.jpeg') }}"
                                    alt="img">
                                <div class="content">
                                    <div class="name">
                                        {{ $item->user?->name }}
                                    </div>
                                    <div class="desc">
                                        عدد الطلبات :
                                        {{ $item->user?->orders->count() }}
                                    </div>
                                    <div class="desc">
                                        <i class="fa-solid fa-phone me-2"></i>
                                        {{ $item->phone }}
                                    </div>
                                    <div class="desc">
                                        <i class="fa-regular fa-envelope me-3 fs-6"></i>
                                        {{ $item->user?->email }}
                                    </div>
                                </div>
                            </div>
                            <div class="md border-bottom-0 m-0">
                                <div class="d-flex justify-content-between ">
                                    <div class="text fs-12px">
                                        <span>عنوان التوصيل : </span>
                                        {{ $item->address }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-12 col-lg-12 col-xl-12 mb-3">


                                <div class="map">

                                    <div id="map" style="width: 100%; height: 400px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASM7VEAkM0XHKds0Tlp7w--Hqd24k0BSo&callback=initMap" async
    defer></script>

<script>
    function initMap() {
        const latitude = {{ $item->latitude ?? 24 }};
        const longitude = {{ $item->longitude ?? 31.2357 }};
        var map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: latitude,
                lng: longitude
            },
            zoom: 7,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var marker;
        map.addListener("click", function(event) {
            placeMarker(event.latLng);
        });

        function placeMarker(location) {
            if (marker) {
                marker.setMap(null);
            }

            marker = new google.maps.Marker({
                position: location,
                map: map
            });

            // Round the latitude and longitude values to six decimal places and keep them as numbers
            // var lat = Math.round(location.lat() * 1000000) / 1000000;
            //var lng = Math.round(location.lng() * 1000000) / 1000000;

            document.getElementById("latitude").value = location.lat().toFixed(6);
            document.getElementById("longitude").value = location.lng().toFixed(6);
        }

        placeMarker(new google.maps.LatLng(latitude, longitude));
    }
</script>


{{-- <script>
    function initMap() {
        // Use PHP values correctly
        const latitude = {{ $item->latitude ?? 24 }};
        const longitude = {{ $item->longitude ?? 31.2357 }};

        // Initialize the map
        var map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: latitude,
                lng: longitude
            },
            zoom: 7,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var marker;

        // Place a marker on click
        map.addListener("click", function(event) {
            placeMarker(event.latLng);
        });

        function placeMarker(location) {
            if (marker) {
                marker.setMap(null);
            }

            marker = new google.maps.Marker({
                position: location,
                map: map
            });

            // Update the hidden inputs
            document.getElementById("latitude").value = location.lat().toFixed(6);
            document.getElementById("longitude").value = location.lng().toFixed(6);
        }

        // Place initial marker
        placeMarker(new google.maps.LatLng(latitude, longitude));
    }
</script> --}}
