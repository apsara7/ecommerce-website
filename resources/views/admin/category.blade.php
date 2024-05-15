<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        @include('admin.css')

            <style type="text/css">
                .div_center{
                    text-align:center;
                    padding-top:40px;
                }
                .h2font{
                    font-size: 40px;
                    padding-bottom: 40px;
                }
                .input_color{
                    color: black;
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
            </style>
        
    </head>
  <body>
    <div class="container-scroller">

        @include('admin.side-bar')

        @include('admin.header') 


        <div class="main-panel">
            <div class="content-wrapper">

                {{-- successful message category add button  --}}

                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="div_center">
                    <h2 class="h2font">Add Category</h2>

                    <form action="{{ url('/add_category') }}" method="POST">
                        @csrf 
                        <input class="input_color" type="text" name="category" placeholder="Write Category name">
                        <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                    </form>
                    
                </div>  

                {{-- category table------------------------- --}}
                <table class="table table-dark center gray-table">
                    <thead>
                        <tr style="font-weight: bold;">
                            <td>Category Name Data</td>
                            <td>Action Data</td>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($data as $data)
                            <tr>
                                <td>{{ $data->category_name }}</td>
                                <td>
                                    <a onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger" href="{{ url('delete_category',$data->id) }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                
                


            </div>
        </div>


    
        @include('admin.script')
  </body>
</html>
