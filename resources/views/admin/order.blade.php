<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style type="text/css">
                .font_size{
                    text-align:center;
                    font-size: 40px;
                    padding-top: 20px;
                }
                .center {
    margin: auto;
    width: 90%; /* Adjust width as needed */
    text-align: center;
    margin-top: 30px;
}

                .gray-table td {
                    color: rgb(212, 211, 211);
                }
                .img_size{
                    width: 200px !important;
                    height: auto !important;
                }
    </style>

  </head>
  <body>
    <div class="container-scroller">

        <!-- partial:partials/_sidebar.html -->
            @include('admin.side-bar')
        <!-- partial -->

        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->


        <div class="main-panel">
            <div class="content-wrapper">

            <h2 class="font_size">All Orders</h2>
            <br>

            <div style= "padding-left:400px;  margin:auto; padding-bottom:30px;">
                <form method="get" action="{{url('search')}}">
                    <input type="text" style="color:black" name="search" placeholder="Search for something">
                    <input type="submit" name="search" class="btn btn-primary">

                </form>
            </div>

            <div class="table-responsive">
                <Table class="table table-dark center gray-table">
                    <thead>
                        <tr style="font-weight: bold;">
                            <td>Name</td>
                            <td>Email</td>
                            <td>Address</td>
                            <td>Phone</td>
                            <td>Product Title</td>
                            <td>Quantity</td>
                            <td>Price</td>
                            <td>Payment Status</td>
                            <td>Delivery Status</td>
                            <td>Image</td>
                            <td>Delivered</td>
                            <td>Print PDF</td>
                            <td>Send Email</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order as $order)
                            <tr>
                                <td>{{$order->name}}</td>
                                <td>{{$order->email}}</td>
                                <td>{{$order->address}}</td>
                                <td>{{$order->phone}}</td>
                                <td>{{$order->product_title}}</td>
                                <td>{{$order->quantity}}</td>
                                <td>{{$order->price}}</td>
                                <td>{{$order->payment_status}}</td>
                                <td>{{$order->delivery_status}}</td>
                                 
                                <td>
                                    <img class="img_size" src="/product/{{$order->image}}">
                                </td>
                                <td>
                                    @if($order->delivery_status=='processing')
                                        <a class="btn btn-primary" onclick="return confirm('Are you sure this product is delivered?')"
                                        href="{{url('delivered',$order->id)}}">Delivered</a>
                                    @else
                                        <p style="color:green;">Delivered</p>
                                    @endif    
                                </td>
                                <td>
                                    <a href="{{url('print_pdf',$order->id)}}" class="btn btn-secondary">Print PDF</a>
                                </td>
                                <td>
                                    <a href="{{url('send_email',$order->id)}}" class="btn btn-info">Send Email</a>
                                </td>
                            </tr>

                            @empty
                                <tr>
                                    <td clospan="16">
                                    No data found
                                    </td>
                                </tr>

                        @endforelse
                    </tbody>
                </Table>
            </div>

            </div>
        </div>

      

        @include('admin.script')
        <!-- End custom js for this page -->
  </body>
</html>
