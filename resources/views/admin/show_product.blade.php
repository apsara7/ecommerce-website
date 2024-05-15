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
                .center{
                    margin:auto;
                    width: 50%;
                    text-align: center;
                    margin-top: 30px;                   
                }
                .gray-table td {
                    color: rgb(212, 211, 211);
                }
                .img_size {
                    width: 200px !important;
                    height: auto !important;
                }
            </style>
  </head>

  <body>
    <div class="container-scroller">

        @include('admin.side-bar')

        @include('admin.header')
      
        <div class="main-panel">
            <div class="content-wrapper">

            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <h2 class="font_size">All Products</h2>

            <Table class="table table-dark center gray-table">
                <thead>
                    <tr style="font-weight: bold;">
                        <td>Product Title</td>
                        <td>Description</td>
                        <td>Quantity</td>
                        <td>Category</td>
                        <td>Price</td>
                        <td>Discount Price</td>
                        <td>Product Image</td>
                        <td>Delete</td>
                        <td>Edit</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product as $product)
                        <tr>
                            <td>{{$product->title}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->category}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->discount_price}}</td>
                            <td>
                                <img class="img_size" src="/product/{{$product->image}}">
                            </td>
                            <td>
                                <a class="btn btn-danger" onclick="return confirm('Are you sure delete this?')" href="{{url('delete_product',$product->id)}}">Delete</a>
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{url('/update_product',$product->id)}}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </Table>

            </div>
        </div>
    
        @include('admin.script')
  </body>
</html>
