<!DOCTYPE html>
    <html lang="en">
 <head>

    <!-- to find css  -->
    <base href="/public">
    
    @include('admin.css')

        <style>
            .div_center{
                text-align: center;
                padding-top:40px;
            }
            .font_size{
                font-size: 40px;
                padding-bottom: 40px;
            }
            .text_color{
                color:black;
                padding-bottom:20px;
            }
            label{
                display: inline-block;
                width:200px;
            }
            .div_design{
                padding:8px;
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

                <div class="div_center">
                    <h1 class="font_size">Update Product</h1>

                    <form action="{{url('/update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">

                    @csrf
                        <div class="div_design">
                            <label>Product Title</label>
                            <input class="text_color" type="text" name="title" placeholder="Write a title" required=""
                            value="{{$product->title}}">
                        </div>
                        <div class="div_design">
                            <label>Product Description</label>
                            <input class="text_color" type="text" name="description" required="" placeholder="Write a description"
                            value="{{$product->description}}">
                        </div>
                        <div class="div_design">
                            <label>Product Price</label>
                            <input class="text_color" type="number" name="price" required="" placeholder="Write the price"
                            value="{{$product->price}}">
                        </div>
                        <div class="div_design">
                            <label>Discount Price</label>
                            <input class="text_color" type="number" name="dis_price" placeholder="Write the Discount"
                            value="{{$product->discount_price}}">
                        </div>
                        <div class="div_design">
                            <label>Product Quantity</label>
                            <input class="text_color" type="number" name="quantity" required="" min="0" placeholder="Write the Quantity"
                            value="{{$product->quantity}}">
                        </div>
                        <div class="div_design">
                            <label>Product Category</label>
                            <select class="text_color" name="category" required="" >
                                <option value="{{$product->category}}" selected="">{{$product->category}}</option>

                                @foreach($category as $category)
                                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="div_design">
                            <label>Current Product Image Here</label>
                            <input type="file" name="image" min="0" placeholder="Write a title">
                        </div>
                        <div class="div_design">
                            <label>Change Product Image Here</label>
                            <img height="auto" width="150" style="margin:auto;"
                            src="/product/{{$product->image}}">
                        </div>
                        <div class="div_design">
                            <input type="submit" value="Update Product" class="btn btn-primary">
                        </div>
                    </form>

                </div>

            </div>
        </div>


        @include('admin.script')
  </body>
</html>
