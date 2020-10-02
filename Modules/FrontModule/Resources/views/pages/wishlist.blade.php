@extends('frontmodule::layouts.master')

@section('content')
    <div class="super_container">


        <div class="cart_section">
            <div class="container">
                <div class="row">

                    <div class="col-lg-10 offset-lg-1">
                        @if($favorites->count()>0)
                            <div class="cart_container">
                                <div class="cart_title">{{$config['title']}}</div>
                                <div class="cart_items">
                                    <ul class="cart_list">

                                        <table id="cart" class="table  table-bordered text-bold text-center">
                                            <thead>

                                            <tr>

                                                <td>product</td>
                                                <td>image</td>
                                                <td>price</td>
                                                <td>operations</td>

                                            </tr>

                                            </thead>

                                            <tbody>


                                            @foreach($favorites as $fav)
                                                <tr id="tr">


                                                    <td>{{$fav->title}}</td>
                                                    <td>
                                                        <img src="{{asset('/images/products/'.$fav->photo)}}" alt="" style="max-width: 200px; max-height: 200px;">

                                                    </td>
                                                    <td>$ {{$fav->sell_price}}</td>
                                                    <td>

                                                        <a onClick="return(confirm('are you sure !'))" class="btn btn-danger" href="{{route('wishlist.add',$fav->id)}}">


                                                            <i class="fa fa-close">remove</i>


                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach


                                            </tbody>

                                        </table>

                                    </ul>
                                </div>


                            </div>
                        @else
                            <div class="alert alert-danger">
                                <h1 class="text-danger text-center text-bold ">" Sorry , WishList Is Empty "</h1>

                            </div>
                        @endif
                    </div>


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

@endsection


