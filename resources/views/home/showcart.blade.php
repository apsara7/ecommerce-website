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
            .gray-table td {
            color: rgb(212, 211, 211);
            }
            .center{
            margin:auto;
            width: 60%;
            text-align: center;
            margin-top: 100px;                   
            }
            .img_cart{
                width:110px;
                height:auto;
            }
            .total_cart {
                font-size: 24px; /* Adjust font size as needed */
                color: #333; /* Set text color */
                text-align: center; /* Center align the text */
                margin-top: 20px; /* Add some top margin for spacing */
            }

            .total_cart div {
                background-color: #f8f8f8; /* Set background color for the parent div */
                padding: 20px; /* Add padding to the parent div */
                border-radius: 10px; /* Add border radius to the parent div */
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
            }

            .option1 {
                display: inline-block;
                background-color: #f7444e;
                border: 1px solid #f7444e;
                color: #ffffff;
                border-radius: 20px;
                padding: 8px 16px; /* Adjust padding to increase height */
                line-height: 1.5; /* Adjust line height for vertical centering */
            }

            .option1:hover {
                background-color: transparent;
                color: #f7444e;
            }
           

      </style>
   </head>
   <body>
      <div class="hero_area">

         <!-- header section starts -->
         @include('home.header')
         <!-- end header section -->


         @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
        @endif


      <div style="padding-bottom:22px;">
        <table class="table table-dark text-align:center;  center gray-table" >
            <tr style="font-weight: bold;">
                <th>Product Title</th>
                <th>Product Quantity</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>

            <?php $totalprice = 0; ?>
            <?php $totalproduct=0;  ?>

                @foreach($cart as $cart)

                <tr class="td">
                    <td>{{$cart->product_title}}</td>
                    <td>{{$cart->quantity}}</td>
                    <td>Rs.{{$cart->price}}.00</td>
                    <td><img class="img_cart" src="/product/{{$cart->image}}"></td>
                    <td>
                        <a class="option1" onclick="return confirm('Are you sure to remove this product>')" 
                        href="{{url('remove_cart',$cart->id)}}">Remove</a>
                    </td>
                </tr>

                <?php $totalproduct++; ?>

                <?php $totalprice=$totalprice + $cart->price ?>

                @endforeach

            </table>

            <div class="">
                <h1 class="total_cart">Total Price: Rs. {{$totalprice}}.00</h1>
            </div>
            <div style="text-align: center;">
                <h2 style="font-size:25px; padding-bottom:2px;">Proceed to Order</h2>
                <a href="{{url('cash_order', $totalproduct)}}" class="option1">Cash on Delivery</a>
                <a href="{{url('stripe',$totalprice)}}" class="option1">Pay using a Card</a>
            </div>

      </div>


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
