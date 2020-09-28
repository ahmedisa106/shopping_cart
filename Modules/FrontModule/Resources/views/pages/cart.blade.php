@extends('frontmodule::layouts.master')

@section('content')
    <div class="super_container">


        <div class="cart_section">
            <div class="container">
                <div class="row">
                    @if($cartContent->count() > 0)
                        <div class="col-lg-10 offset-lg-1">
                            <div class="cart_container">
                                <div class="cart_title">{{$config['title']}}</div>
                                <div class="cart_items">
                                    <ul class="cart_list">
                                        <table class="table  table-bordered text-bold text-center">
                                            <thead>

                                            <tr>

                                                <td>image</td>
                                                <td>name</td>
                                                <td>quantity</td>
                                                <td>price</td>
                                                <td>total</td>
                                                <td>operation</td>
                                            </tr>

                                            </thead>
                                            <tbody>

                                            @foreach($cartContent as $index => $product)
                                                <tr id="tr">


                                                    <td>
                                                        <img src="{{getProductImage($product->id)}}" alt="" style="max-width: 200px; max-height: 200px;">
                                                    </td>

                                                    <td>{{$product->name}}</td>
                                                    <td>
                                                        <input class="quantity" type="hidden" value="{{$product->quantity}}">
                                                        <input id="quantity" type="number" min="1" max="{{getProductQuantity($product->id)}}" value="{{$product->quantity}}">
                                                    </td>
                                                    <td>
                                                        <input class="price" type="hidden" value="{{$product->price}}">
                                                        $ {{$product->price}}
                                                    <td>
                                                        <input class="total" type="hidden" value=" {{$product->price * $product->quantity}}">
                                                        <span class="value">$ {{$product->price * $product->quantity}}</span>

                                                    <td>
                                                        <a onclick="return (confirm('are you sure !')) " class="btn btn-danger fa fa-close" href="{{route('cart.removeItem',$product->id)}}">remove</a>
                                                        <a hidden class="  updateItem btn btn-warning fa fa-close" href="{{route('cart.updateItem')}}">update</a>
                                                        <input id="id" type="hidden" value="{{$product->id}}">
                                                    </td>
                                                </tr>

                                            @endforeach


                                            </tbody>

                                        </table>

                                    </ul>
                                </div>

                                <!-- Order Total -->
                                <div class="order_total">
                                    <div class="order_total_content text-md-right">
                                        <div class="order_total_title">Order Total:</div>
                                        <div class="order_total_amount">
                                            <input class="total_amount" type="hidden" value="{{Cart::getTotal()}}">
                                            <span id="total">$ {{Cart::getTotal()}}</span>

                                        </div>
                                    </div>
                                </div>

                                <div class="cart_buttons">
                                    <button type="button" class="button cart_button_checkout">Checkout</button>
                                </div>
                            </div>
                        </div>
                    @else

                        <div class="alert alert-danger">
                            <h1 class="text-danger text-bold ">" Sorry , Cart Is Empty "</h1>

                        </div>


                    @endif
                </div>
            </div>
        </div>

        <!-- Newsletter -->

        <div class="newsletter">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                            <div class="newsletter_title_container">
                                <div class="newsletter_icon"><img src="{{asset('/assets/front')}}/images/send.png" alt=""></div>
                                <div class="newsletter_title">Sign up for Newsletter</div>
                                <div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
                            </div>
                            <div class="newsletter_content clearfix">
                                <form action="#" class="newsletter_form">
                                    <input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
                                    <button class="newsletter_button">Subscribe</button>
                                </form>
                                <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('js')
    <script>

        $(document).on('change', '#quantity', function (e) {

            quantity = $(this).val();

            e.preventDefault();
            var tr = $(this).closest('tr');
            price = tr.find('.price').val();
            total = $(this).val() * price;

            value = tr.find('.value');
            html = `<span> $ ` + total + `</span>`;
            value.empty();

            value.append(html);


            e.preventDefault();
            tr = $(this).closest('tr');
            id = tr.find('#id').val();
            url = $('.updateItem').attr('href');


            $.ajax({

                'type': 'get',
                url: url,
                data: {
                    'id': id,
                    'quantity': quantity,

                },
                'statusCode': {
                    200: function (response) {
                        $('#total').empty();
                        $('#total').append('$ ' + response.data);
                    },
                    404: function (response) {
                    },
                }
            });

        });

    </script>
@endsection


