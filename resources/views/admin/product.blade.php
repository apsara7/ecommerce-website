<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
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
        .half-width-container {
    width: 50%;
    margin: 0 auto;
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
                <div class="row justify-content-center">
                    <div class="col-md-6"> <!-- Adjust the number based on your preference -->
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
            


                <div class="div_center">
                    <h1 class="font_size">Add Product</h1>

                    <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">

                    @csrf
                        <div class="div_design">
                            <label>Product Title</label>
                            <input class="text_color" type="text" name="title" placeholder="Write a title" required="">
                        </div>
                        <div class="div_design">
                            <label>Product Description</label>
                            <input class="text_color" type="text" name="description" required="" placeholder="Write a description">
                        </div>
                        <div class="div_design">
                            <label>Product Price</label>
                            <input class="text_color" type="number" name="price" required="" placeholder="Write the price">
                        </div>
                        <div class="div_design">
                            <label>Discount Price</label>
                            <input class="text_color" type="number" name="dis_price" placeholder="Write the Discount">
                        </div>
                        <div class="div_design">
                            <label>Product Quantity</label>
                            <input class="text_color" type="number" name="quantity" required="" min="0" placeholder="Write the Quantity">
                        </div>
                        <div class="div_design">
                            <label>Product Category</label>
                            <select class="text_color" name="category" required="">
                                <option value="" selected="">Add a category here</option>

                                @foreach($category as $category)
                                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="div_design">
                            <label>Product Image Here</label>
                            <input type="file" name="image" min="0" placeholder="Write a title" required="">
                        </div>
                        <div class="div_design">
                            <input type="submit" value="Add Product" class="btn btn-primary">
                        </div>
                    </form>

                </div>

            </div>
        </div>


        @include('admin.script')
  </body>
</html>
