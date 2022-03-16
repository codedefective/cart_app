
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://easycep.com/wp-content/uploads/2020/02/easycep_fav.ico">

    <title>Cart</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/checkout/form-validation.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/4.0/examples/product/product.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="site-header sticky-top py-1">
    <div class="container d-flex flex-column flex-md-row justify-content-between">
        <a class="py-2" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="d-block mx-auto"><circle cx="12" cy="12" r="10"></circle><line x1="14.31" y1="8" x2="20.05" y2="17.94"></line><line x1="9.69" y1="8" x2="21.17" y2="8"></line><line x1="7.38" y1="12" x2="13.12" y2="2.06"></line><line x1="9.69" y1="16" x2="3.95" y2="6.06"></line><line x1="14.31" y1="16" x2="2.83" y2="16"></line><line x1="16.62" y1="12" x2="10.88" y2="21.94"></line></svg>
        </a>
        <a class="py-2 d-none d-md-inline-block" href="{{route('products')}}">{{__('Product List')}}</a>
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit" class="my-2 d-md-inline-block btn btn-outline-secondary btn-sm">Logout</button>
        </form>
    </div>
</nav>
<div class="container">
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="https://easycep.com/wp-content/uploads/2022/01/header-easycep-moto-logo.png.webp" alt=""  height="72">
        <h2>Cart</h2>
    </div>
    <div class="row">
        <div class="col-md-12 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <a class="text-muted" href="{{route('products')}}">{{__('Go to Product List')}}</a>
                <span class="text-muted">{{__('Your cart')}} <span class="badge badge-secondary badge-pill">{{$totals['cart_count']}}</span></span>
            </h4>
            <ul class="list-group mb-3">
                @foreach($cart as $item)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{$item['name']}}</h6>
                            <small class="text-muted">{{$item['quantity']}} x ${{$item['price']}}</small>

                        </div>
                        <div class="d-flex flex-column align-items-end">
                            <span class="text-muted">${{$item['total']}}</span>
                            <form action="{{route('cart-product-update')}}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{base64_encode($item['id'])}}">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                    <button type="submit" name="process" value="add" class="btn btn-secondary">+</button>
                                    <button type="submit" name="process" value="remove" class="btn btn-secondary">-</button>
                                    <button type="submit" name="process" value="drop" class="btn btn-secondary">x</button>
                                </div>
                            </form>
                        </div>
                    </li>
                @endforeach

                @foreach($cartPromos as $promo)
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small>{{$promo['name']}}</small>
                        </div>
                        <div class="d-flex flex-column align-items-end">
                            <span class="text-success">${{$promo['promo']}}</span>
                            <form action="{{route('cart-promo-update')}}" method="POST">
                                @csrf
                                <input type="hidden" name="promo" value="{{base64_encode($promo['name'])}}">
                                <button type="submit" name="process" value="unset" class="btn btn-secondary btn-sm">x</button>
                            </form>
                        </div>
                    </li>
                @endforeach


                <li class="list-group-item d-flex justify-content-between">
                    <span>Total Promos</span>
                    <strong>${{$totals['promos']}}</strong>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>${{$totals['products']}}</strong>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                    <span>Sub Total (USD)</span>
                    <strong>${{$totals['subtotal']}}</strong>
                </li>

            </ul>

            <form class="card p-2" method="POST" action="{{route('cart-promo-update')}}">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" name="promo" placeholder="{{__('Promo code')}}">
                    <div class="input-group-append">
                        <button type="submit" name="process" value="set" class="btn btn-secondary">Redeem</button>
                    </div>
                </div>
                <small class="badge mt-1">Easy or/and EasyCep</small>
            </form>
        </div>

    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/holder.min.js"></script>

</body>
</html>
