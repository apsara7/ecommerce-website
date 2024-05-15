<!DOCTYPE html>
<html>
   <head>

    <base href="/public">


      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/logo.png" type="">
      <title>Cloz-Gallery</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />


      <style>
        .card {
            --font-color: #323232;
        --font-color-sub: #666;
        --bg-color: #fff;
        --main-color: #323232;
        --main-focus: #2d8cf0;
        width: 530px;
        height: 400px;
        background: var(--bg-color);
        border: 2px solid var(--main-color);
        box-shadow: 4px 4px var(--main-color);
        border-radius: 5px;
        display: flex;
        flex-direction: column;
        padding: 20px;
        gap: 10px;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        margin-bottom: -160px;
    }

        .card:last-child {
        justify-content: flex-end;
        }

        .card-img {
            /* clear and add new css */
        transition: all 0.5s;
        display: flex;
        justify-content: center;
        }

        .card-img .img {
        /* delete */
        transform: scale(1);
        position: relative;
        width: 250px;
        height: auto;
        }

        .card-img .img::before {
        /* delete */
        content: '';
        position: absolute;
        width: 65px;
        height: 110px;
        margin-left: -32.5px;
        left: 50%;
        bottom: -4px;
        background-repeat: no-repeat;
        background-size: 60% 10%,100% 100%,100% 65%,100% 65%,100% 50%;
        background-position: center 3px,center bottom,center bottom,center bottom,center bottom;
        border-radius: 0 0 4px 4px;
        z-index: 2;
        }

        .card-img .img::after {
        /* delete */
        content: '';
        position: absolute;
        box-sizing: border-box;
        width: 28px;
        height: 28px;
        margin-left: -14px;
        left: 50%;
        top: -13px;
        background-repeat: no-repeat;
        background-position: center center;
        border-top-left-radius: 120px;
        border-top-right-radius: 10px;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 70px;
        border-top: 2px solid black;
        border-left: 2px solid black;
        transform: rotate(45deg);
        z-index: 1;
        }

        .card-title {
        font-size: 20px;
        font-weight: 500;
        text-align: center;
        color: var(--font-color);
        }

        .card-subtitle {
        font-size: 14px;
        font-weight: 400;
        color: var(--font-color-sub);
        }

        .card-divider {
        width: 100%;
        border: 1px solid var(--main-color);
        border-radius: 50px;
        }

        .card-footer {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        }

        .card-price {
        font-size: 20px;
        font-weight: 500;
        color: var(--font-color);
        }

        .card-price span {
        font-size: 20px;
        font-weight: 500;
        color: var(--font-color-sub);
        }

        .card-img:hover {
        transform: translateY(-3px);
        }

        .buy {
        padding: 1.3em 3em;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 2.5px;
        font-weight: 600;
        color: #000;
        background-color: #fff;
        border: none;
        border-radius: 45px;
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease 0s;
        cursor: pointer;
        outline: none;
        }

        .buy:hover {
        background-color: #1480D1;
        box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
        color: #fff;
        transform: translateY(-7px);
        }

        .buy:active {
        transform: translateY(-1px);
        }
        </style>

   </head>

   <body>

      <div class="hero_area">

         <!-- header section starts -->
         @include('home.header')
         <!-- end header section -->

      

         <div style="margin-bottom: 50px; display: flex; justify-content: center; align-items: center; height: 80vh;">
            <div class="card">
                <div class="card-img"><div class="img">
                <img src="product/{{$product->image}}" alt="Product Image" style="max-width: 100%; max-height: 70vh;">

                </div></div>
                <div class="card-title">
                    Product : {{$product->title}}
                </div>
                <div class="card-subtitle">
                    Product description : {{$product->description}}
                </div>
                <div class="card-subtitle">
                    Category : {{$product->category}}

                </div>
                <div class="card-subtitle">
                    Quantity : {{$product->quantity}}
                </div>

                <hr class="card-divider">
                <div class="card-footer">
                            @if($product->discount_price != null)
                                <div style="margin-top: 10px;">
                                    <h6 style="color: red; display: inline;">Discount Price Rs.{{$product->discount_price}}.00</h6>
                                    <span style="margin: 0 10px;">|</span>
                                    <h6 style="text-decoration: line-through; color: blue; display: inline;">Price Rs.{{$product->price}}.00</h6>
                                </div>
                            @else
                                <h6 style="color: blue; margin-top: 10px;">Price Rs.{{$product->price}}.00</h6>
                            @endif

                            <form action="{{url('add_cart', $product->id)}}" method="Post">
                             @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" name="quantity" value="1" min="1" style="width:100px;">
                                    </div>
                                    <div class="col-md-8">
                                    <button class="buy">Add to Cart</button>
                                    </div>
                                </div>
                           </form>

                           
                </div>
            </div>
            
        </div>

        
         <!-- <div style="display: flex; justify-content: center; align-items: center; height: 80vh;">
            <div class="card">
                <div class="" style="margin:auto; width:100%;">
                    <div class="box" style="padding: 15px; border-radius: 8px; display: flex; flex-direction: column; align-items: center;">
                        <div class="detail-box" style="text-align: center;">
                            
                           
                            <hr style="margin-top: 15px;">
                            <button>Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->


         <!-- footer start -->
         @include('home.footer')
         <!-- footer end -->

         <div class="cpy_" style="position: fixed; bottom: 0; width: 100%;">
         <p class="mx-auto">© All Rights Reserved <br>

         <h5 style="color:#fff;">Cloz Gallery</h5>

         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>


     
   

   </body>
</html>
 