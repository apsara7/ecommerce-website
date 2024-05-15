<style>
        .container-input {
    position: relative;
    }

    .input {
    width: 150px;
    padding: 10px 0px 10px 40px;
    border-radius: 9999px;
    border: solid 1px #333;
    transition: all .2s ease-in-out;
    outline: none;
    opacity: 0.8;
    }

    .container-input svg {
    position: absolute;
    top: 20%;
    left: 10px;
    transform: translate(0, -50%);
    }

    .input:focus {
    opacity: 1;
    width: 250px;
    }
    .option1 {
                display: inline-block;
                background-color: black;
                border: 1px solid black;
                color: #ffffff;
                border-radius: 9999px;
                padding: 8px 16px; /* Adjust padding to increase height */
                line-height: 1.2; /* Adjust line height for vertical centering */
            }

            .option1:hover {
                background-color: transparent;
                color: black;
            }
</style>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>Our <span>products</span></h2>
        
            <br>
                <form id="searchForm" action="{{ url('product_search') }}" method="GET">
                    <div class="container-input">
                        <input id="searchInput" type="text" placeholder="" name="search" class="input">
                        <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
                            <path d="M790.588 1468.235c-373.722 0-677.647-303.924-677.647-677.647 0-373.722 303.925-677.647 677.647-677.647 373.723 0 677.647 303.925 677.647 677.647 0 373.723-303.924 677.647-677.647 677.647Zm596.781-160.715c120.396-138.692 193.807-319.285 193.807-516.932C1581.176 354.748 1226.428 0 790.588 0S0 354.748 0 790.588s354.748 790.588 790.588 790.588c197.647 0 378.24-73.411 516.932-193.807l516.028 516.142 79.963-79.963-516.142-516.028Z" fill-rule="evenodd"></path>
                        </svg>
                        <input id="searchButton" class="option1" type="submit" value="Search">
                    </div>
                    <br>
                </form>
        </div>
        


        <div class="row">

        @foreach($product as $singleProduct)
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="box">
                    <div class="option_container">
                        <div class="options">
                            <a href="{{ url('product_details', $singleProduct->id) }}" class="option1">Product Details</a>

                           <form action="{{url('add_cart', $singleProduct->id)}}" method="Post">
                             @csrf
                                <div class="row">
                                <div class="col-md-4">
                                    <input type="number" name="quantity" value="1" min="1" max="5" style="width:100px;" onchange="checkQuantity(this)">
                                    <span id="quantityError" style="color:red; display:none;">Maximum quantity allowed is 5</span>
                                </div>                                    <div class="col-md-4">
                                        <input type="submit" value="Add to Cart">
                                    </div>
                                </div>
                           </form>


                        </div>
                    </div>
                    <div class="img-box">
                        <img src="product/{{ $singleProduct->image }}" alt="Product Image">
                    </div>
                    <div class="detail-box" style="display:flex; justify-content:center; align-items:center;">
                        <h5>{{ $singleProduct->title }}</h5>
                    </div>
                    <div class="detail-box" style="display:flex; justify-content:center; align-items:center;">
                        @if($singleProduct->discount_price != null)
                            <h6 style="color: red; margin-right: 5px;">Discount Rs.{{ $singleProduct->discount_price }}.00</h6>
                            <h6 style="text-decoration: line-through; color: blue;">Price Rs.{{ $singleProduct->price }}.00</h6>
                        @else
                            <h6 style="color: blue;">Rs.{{ $singleProduct->price }}.00</h6>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach



        </div>

        <!-- Anchor tag to maintain position after pagination -->
        <a id="pagination-anchor"></a>

         <div class="d-flex justify-content-center" id="pagination">
            {{ $product->withQueryString()->links('pagination::bootstrap-5') }}
         </div>

        <div class="btn-box">
            <a href="#">View All products</a>
        </div>
    </div>
</section>





<script>
    function checkQuantity(input) {
        var quantity = parseInt(input.value);
        var errorMessage = document.getElementById('quantityError');

        if (quantity > 5) {
            errorMessage.style.display = 'block';
            input.value = 5; // Reset quantity to 5
        } else {
            errorMessage.style.display = 'none';
        }
    }
</script>

@push('scripts')
    <script>
        function submitForm() {
            var searchInputValue = document.getElementById('searchInput').value;
            if (searchInputValue.trim() === '') {
                // Prevent form submission if search input is empty
                return false;
            }
            // Otherwise, allow form submission
            return true;
        }
    </script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let paginationLinks = document.querySelectorAll('#pagination a');
            paginationLinks.forEach(link => {
                link.addEventListener('click', function() {
                    window.scrollTo({ top: document.getElementById('pagination-anchor').offsetTop, behavior: 'smooth' });
                });
            });
        });
    </script>

@endpush
