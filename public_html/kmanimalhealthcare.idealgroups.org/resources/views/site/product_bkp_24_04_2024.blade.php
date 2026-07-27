@extends('layouts.guest')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@section('content')
    <section class="page-header  padding-tb"
        style="background-image:url(siteassets/images/banner/bg-images/main_banner.jpg); ">
        <div class=""></div>
        <div class="container">
            <div class="page-header-content-area">
                <h4 class="ph-title">Our Products</h4>
                <ul class="lab-ul">
                    <li><a href="">Home</a></li>
                    <li><a class="active"><b>Our Products</b></a></li>
                </ul>
            </div>
        </div>
    </section>
    <section style="background-image:url(siteassets/images/banner/bg-images/background.jpg);">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10 p-5">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body">
                            <div class="row p-3">
                                <div class="col-md-3 category-section shadow-sm">
                                    <h3 class="productTitleCategory">CATEGORIES</h3>
                                    <ul class="list-unstyled productTitleCategoryDetails">
                                        <li class="active">All</li>
                                        <li>Stresso-Lite</li>
                                        <li>KM Tonic</li>
                                        <li>Im Grosty</li>
                                        <li>The Vit Premix - B</li>
                                        <li>The Vit Premix - L</li>
                                    </ul>
                                    <div class=" mt-2 price-section shadow-sm">
                                        <h3 class="productTitleCategory">PRICE</h3>
                                        <input type="range" class="mt-3" id="priceRange" name="priceRange"
                                            min="0" max="100" value="50">
                                        <div class="price-range-labels">
                                            <span>Min Price: $<span id="minPrice">1</span></span>
                                            <span>Max Price: $<span id="maxPrice">99</span></span>
                                        </div>
                                    </div>
                                    <div class="mt-3 weight-section shadow-sm">
                                        <h3 class="productTitleCategory">WEIGHT</h3>
                                        <ul class="list-unstyled productTitleCategoryDetails">
                                            <li class="active">1kg</li>
                                            <li>2kg</li>
                                            <li>5kg</li>
                                            <li>10kg</li>
                                            <li>20kg</li>
                                            <li>25kg</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="p-2">
                                            <h6 class="allcategoryText d-inline">ALL CATEGORY</h6>
                                            <span class="d-inline"><b>168 Result</b></span>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Sort by
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#">Price low to high</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-2">
                                        <div class="col-md-4">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <p class="card-title">Lorem ipsum dolor sit amet consectetur</p>
                                                    <img src="siteassets/images/banner/bg-images/product_5.png"
                                                        alt="Small Image" class="img-fluid">
                                                    <div class="text-center">
                                                        <div class="price">
                                                            <span class="text-orange font-weight-bold">$99.99</span>
                                                        </div>
                                                        <div class="rating mt-2">
                                                            <span class="filled-stars" style="color: #fd7e14;">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2">
                                                        <div class="row g-0">
                                                            <div class="col-6 p-0">
                                                                <button type="button"
                                                                    class="btn btn-warning btn-sm btn-block mb-2">
                                                                    Add to Cart
                                                                </button>
                                                            </div>
                                                            <div class="col-6 p-0">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm btn-block">
                                                                    Buy Now
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-3">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Add your JavaScript code here
        document.getElementById("priceRange").addEventListener("input", function() {
            var minPrice = document.getElementById("priceRange").value;
            var maxPrice = 100 - minPrice;
            document.getElementById("minPrice").textContent = minPrice;
            document.getElementById("maxPrice").textContent = maxPrice;
        });
    </script>
@endsection
