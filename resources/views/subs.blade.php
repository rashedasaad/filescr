<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- all.min.css -->
    <link rel="stylesheet" href="{{ URL::asset('all.min.css') }}">
    <!-- style.css -->
    <link rel="stylesheet" href="{{ URL::asset('scss/price/price.css') }}">
    <!-- Font-Googel -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,500;1,500&family=Open+Sans:ital,wght@0,600;1,500;1,600&display=swap"
        rel="stylesheet">
</head>

<body>

    <!--  -->
    <div class="effect_container">
        <div class="effect">
            <span style="--i:23;"></span>
            <span style="--i:13;"></span>
            <span style="--i:10;"></span>
            <span style="--i:24;"></span>
            <span style="--i:3;"></span>
            <span style="--i:27;"></span>
            <span style="--i:30;"></span>
            <span style="--i:37;"></span>
            <span style="--i:13;"></span>
            <span style="--i:16;"></span>
            <span style="--i:9;"></span>
            <span style="--i:51;"></span>
            <span style="--i:21;"></span>
            <span style="--i:44;"></span>
            <span style="--i:6;"></span>
            <span style="--i:2;"></span>
            <span style="--i:5;"></span>
            <span style="--i:23;"></span>
            <span style="--i:13;"></span>
            <span style="--i:4;"></span>
            <span style="--i:7;"></span>
            <span style="--i:2;"></span>
            <span style="--i:27;"></span>
        </div>
    </div>
    <!--  -->

    <!-- Start Pricing  -->
    <div class="Pricing">
        <div class="backgraond">
            <div class="container">
                @foreach ($prods as $product)

                <div class="box">
                    <div class="text-titel">
                        <h1> {{ $product["intervalue"] }} </h1>
                        <h2> {{ $product["price"] }} </h2>
                    </div>
                    <ul>
                        <div class="botten">
                            <ul>
                                <li> 10GB HDD Space </li>
                                <li> 10GB HDD Space </li>
                                <li> 10GB HDD Space </li>
                            </ul>
                            <a href="/buy/{{ $product["product_id"] }}/{{ $product["plan_id"] }}"> Choose Plan </a>
                        </div>
                </div>
                @endforeach
            
            </div>
        </div>
    </div>
    <!-- End Pricing  -->


</body>

</html>