<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->

    <base href="/public">

    @include('admin.css')

    <style type="text/css">
        label{
            display: inline-block;
            width:300px;
            font-size: 15px;
            font-weight: bold;
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

        <h2 style="text-align:center; font-size:25px;">Send Email to {{$order->email}}</h2>

            <form action="{{url('send_user_email',$order->id)}}" method="POST">
                @csrf
                <div style="padding-top:30px; padding-left:35%;">
                    <label>Email greeting: </label>
                    <input style="color:black;" type="text" name="greeting">
                </div>
                <div style="padding-top:30px; padding-left:35%;">
                    <label>Email first line: </label>
                    <input style="color:black;" type="text" name="firstline">
                </div>
                <div style="padding-top:30px; padding-left:35%;">
                    <label>Email body: </label>
                    <input style="color:black;" type="text" name="body">
                </div>
                <div style="padding-top:30px; padding-left:35%;">
                    <label>Email button name: </label>
                    <input style="color:black;" type="text" name="button">
                </div>
                <div style="padding-top:30px; padding-left:35%;">
                    <label>Email url: </label>
                    <input style="color:black;" type="text" name="url">
                </div>
                <div style="padding-top:30px; padding-left:35%;">
                    <label>Email last line: </label>
                    <input style="color:black;" type="text" name="lastline">
                </div>
                <div style="padding-top:30px; padding-left:35%;">
                    <input type="submit" value="Send Email" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>


        
    
        @include('admin.script')
        <!-- End custom js for this page -->
  </body>
</html>
