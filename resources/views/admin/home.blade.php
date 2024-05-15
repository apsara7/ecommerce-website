<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

  </head>
  <body>
    <div class="container-scroller">

        <!-- partial:partials/_sidebar.html -->
            @include('admin.side-bar')
        <!-- partial -->

        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->

        @include('admin.body')
        <!-- container-scroller -->
        <!-- plugins:js -->
    
        @include('admin.script')
        <!-- End custom js for this page -->

        <script>
          document.addEventListener("DOMContentLoaded", function(event) { 
              var scrollpos = localStorage.getItem('scrollpos');
              if (scrollpos) window.scrollTo(0, scrollpos);
          });

          window.onbeforeunload = function(e) {
              localStorage.setItem('scrollpos', window.scrollY);
          };
      </script>
  </body>
</html>
