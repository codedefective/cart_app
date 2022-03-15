
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://easycep.com/wp-content/uploads/2020/02/easycep_fav.ico">

    <title>Product List</title>


    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/product/product.css" rel="stylesheet">
</head>

<body>

<nav class="site-header sticky-top py-1">
    <div class="container d-flex flex-column flex-md-row justify-content-between">
        <a class="py-2" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="d-block mx-auto"><circle cx="12" cy="12" r="10"></circle><line x1="14.31" y1="8" x2="20.05" y2="17.94"></line><line x1="9.69" y1="8" x2="21.17" y2="8"></line><line x1="7.38" y1="12" x2="13.12" y2="2.06"></line><line x1="9.69" y1="16" x2="3.95" y2="6.06"></line><line x1="14.31" y1="16" x2="2.83" y2="16"></line><line x1="16.62" y1="12" x2="10.88" y2="21.94"></line></svg>
        </a>
        <a class="py-2 d-none d-md-inline-block" href="{{route('cart')}}">Cart</a>
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit" class="my-2 d-md-inline-block btn btn-outline-secondary btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
    <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 font-weight-normal">Product List</h1>
        <p class="lead font-weight-normal">You can add products to your cart, see the number of added products and go to the cart.</p>
    </div>
    <div class="product-device box-shadow d-none d-md-block"></div>
    <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
</div>

@php $type=false @endphp
@foreach($products->chunk(2) as $key => $ch)
    <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
        @foreach($ch as $product)
            <div class="bg-{{$type ? 'dark' : 'light'}} mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center {{$type ? ' text-white' :''}} overflow-hidden">
                <div class="my-3 py-3">
                    <h2 class="display-5">{{$product['name']}}</h2>
                    <p class="lead">${{$product['price']}}</p>
                    <form action="{{route('cart-product-update')}}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{base64_encode($product['id'])}}">
                        <button name="process" value="add" class="btn btn-outline-secondary">{{__('Add To Cart')}}
                            <span class="badge badge-{{!$type ? 'dark' : 'light'}}">{{$product['has_on_cart']}}</span>
                        </button>
                    </form>
                </div>
                <div class="bg-{{!$type ? 'dark' : 'light'}} box-shadow mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;">
                    <img src="{{$product['cover']}}" alt="">
                </div>
            </div>
            @php $type = !$type @endphp
        @endforeach
    </div>
    @php $type = !$type @endphp
@endforeach




<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/holder.min.js"></script>
<script>
    Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
    });
</script>
</body>
</html>
