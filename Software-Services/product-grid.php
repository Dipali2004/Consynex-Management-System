
<?php
include("includes/header.php");
?>

<!--page title start-->

<section class="page-title">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8 col-md-12">
        <h1>
          <span>Product</span> Grid
        </h1>
        <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">
                <i class="bi bi-house-door me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="#">Shop</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Product Grid</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <div class="wave-shape">
    <svg width="100%" height="150px" fill="none">
      <path fill="white">
        <animate repeatCount="indefinite" fill="freeze" attributeName="d" dur="10s" values="
          M0 25.9086C277 84.5821 433 65.736 720 25.9086C934.818 -3.9019 1214.06 -5.23669 1442 8.06597C2079 45.2421 2208 63.5007 2560 25.9088V171.91L0 171.91V25.9086Z;
          M0 86.3149C316 86.315 444 159.155 884 51.1554C1324 -56.8446 1320.29 34.1214 1538 70.4063C1814 116.407 2156 188.408 2560 86.315V232.317L0 232.316V86.3149Z;
          M0 53.6584C158 11.0001 213 0 363 0C513 0 855.555 115.001 1154 115.001C1440 115.001 1626 -38.0004 2560 53.6585V199.66L0 199.66V53.6584Z;
          M0 25.9086C277 84.5821 433 65.736 720 25.9086C934.818 -3.9019 1214.06 -5.23669 1442 8.06597C2079 45.2421 2208 63.5007 2560 25.9088V171.91L0 171.91V25.9086Z"></animate>
      </path>
    </svg>
  </div>
</section>

<!--page title end-->


<!--body content start-->

<div class="page-content">

<!--product start-->

<section>
  <div class="container">
    <div class="row mb-5">
      <div class="col">
        <div class="border p-3">
          <div class="row align-items-center">
            <div class="col-md-5 mb-3 mb-md-0"> <span>Showing 1 to 18 of 20 total</span>
            </div>
            <div class="col-md-7 d-flex align-items-center justify-content-md-end">
              <div class="view-filter"> <a class="active align-middle me-2 text-theme" href="product-grid.html"><i class="fs-3 bi bi-grid-3x2"></i></a>
                <a class="text-black" href="product-list.html"><i class="fs-3 bi bi-card-list"></i></a>
              </div>
              <div class="sort-filter ms-3 d-flex align-items-center">
                <select class="form-select">
                  <option selected>Sort By</option>
                  <option value="1">Newest Item</option>
                  <option value="2">Populer</option>
                  <option value="3">Best Match</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-9 col-md-12 order-lg-1 ps-lg-5">
        <div class="row text-center">
          <div class="col-lg-4 col-md-6">
            <div class="product-item">
              <div class="product-img">
                <img class="img-fluid" src="images/product/01.html" alt="">
              </div>
              <div class="product-desc">
                <a href="product-single.html" class="product-name mt-4 mb-2 d-block link-title h6">3d Iphone</a>
                <span class="product-price text-black">
                  <del>$85.00</del> $75.00 </span>
                <div class="product-link mt-3">
                  <a class="add-cart" href="#">
                    <i class="bi bi-bag me-2"></i>Add To Cart </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mt-5 mt-md-0">
            <div class="product-item">
              <div class="product-img">
                <img class="img-fluid" src="images/product/02.jpg" alt="">
              </div>
              <div class="product-desc">
                <a href="product-single.html" class="product-name mt-4 mb-2 d-block link-title h6">Abstract Innovation</a>
                <span class="product-price text-black">
                  <del>$24.00</del> $19.00 </span>
                <div class="product-link mt-3">
                  <a class="add-cart" href="#">
                    <i class="bi bi-bag me-2"></i>Add To Cart </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mt-5 mt-lg-0">
            <div class="product-item">
              <div class="product-img">
                <img class="img-fluid" src="images/product/03.html" alt="">
              </div>
              <div class="product-desc">
                <a href="product-single.html" class="product-name mt-4 mb-2 d-block link-title h6">Refreshing Cold</a>
                <span class="product-price text-black">
                  <del>$76.00</del> $65.00 </span>
                <div class="product-link mt-3">
                  <a class="add-cart" href="#">
                    <i class="bi bi-bag me-2"></i>Add To Cart </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mt-5">
            <div class="product-item">
              <div class="product-img">
                <img class="img-fluid" src="images/product/04.html" alt="">
              </div>
              <div class="product-desc">
                <a href="product-single.html" class="product-name mt-4 mb-2 d-block link-title h6">Coffee Bags</a>
                <span class="product-price text-black">
                  <del>$54.00</del> $50.00 </span>
                <div class="product-link mt-3">
                  <a class="add-cart" href="#">
                    <i class="bi bi-bag me-2"></i>Add To Cart </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mt-5">
            <div class="product-item">
              <div class="product-img">
                <img class="img-fluid" src="images/product/05.html" alt="">
              </div>
              <div class="product-desc">
                <a href="product-single.html" class="product-name mt-4 mb-2 d-block link-title h6">Specialist Asian</a>
                <span class="product-price text-black">
                  <del>$12.00</del> $10.00 </span>
                <div class="product-link mt-3">
                  <a class="add-cart" href="#">
                    <i class="bi bi-bag me-2"></i>Add To Cart </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mt-5">
            <div class="product-item">
              <div class="product-img">
                <img class="img-fluid" src="images/product/06.html" alt="">
              </div>
              <div class="product-desc">
                <a href="product-single.html" class="product-name mt-4 mb-2 d-block link-title h6">Colorful Gadgets</a>
                <span class="product-price text-black">
                  <del>$62.00</del> $48.00 </span>
                <div class="product-link mt-3">
                  <a class="add-cart" href="#">
                    <i class="bi bi-bag me-2"></i>Add To Cart </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <nav aria-label="Page navigation" class="mt-8 text-center">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link" href="#">
                <i class="bi bi-arrow-left"></i>
              </a>
            </li>
            <li class="page-item active">
              <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">
                <i class="bi bi-arrow-right"></i>
              </a>
            </li>
          </ul>
        </nav>
      </div>
      <div class="col-lg-3 col-md-12 mt-8 mt-lg-0">
        <div class="themeht-sidebar">
          <div class="widget widget-categories mb-4 pb-4 border-bottom border-light">
            <h4 class="widget-title">Categories</h4>
            <ul class="widget-categories list-unstyled">
            <li> <a href="#"><i class="bi bi-chevron-right me-1"></i> All</a>
            </li>
            <li> <a href="#"><i class="bi bi-chevron-right me-1"></i>Software</a>
            </li>
            <li> <a href="#"><i class="bi bi-chevron-right me-1"></i>Accessories</a>
            </li>
            <li> <a href="#"><i class="bi bi-chevron-right me-1"></i>Dynamic</a>
            </li>
            <li> <a href="#"><i class="bi bi-chevron-right me-1"></i>Technology</a>
            </li>
          </ul>
          </div>
          <div class="widget widget-price mb-4 pb-4 border-bottom border-light">
            <h4 class="widget-title">Price</h4>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input" id="priceCheck1">
              <label class="form-check-label" for="priceCheck1">$10 - $100</label>
            </div>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input" id="priceCheck2">
              <label class="form-check-label" for="priceCheck2">$100 - $200</label>
            </div>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input" id="priceCheck3">
              <label class="form-check-label" for="priceCheck3">$200 - $300</label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="priceCheck4">
              <label class="form-check-label" for="priceCheck4">$300 - $400</label>
            </div>
          </div>
          <div class="widget widget-color mb-4 pb-4 border-bottom border-light">
            <h4 class="widget-title">Color</h4>
            <ul class="list-inline">
              <li>
                <div class="form-check ps-0">
                  <input type="radio" class="form-check-input" id="color-filter1">
                  <label class="form-check-label" for="color-filter1" data-bg-color="#3cb371"></label>
                </div>
                <small>Green</small>
              </li>
              <li>
                <div class="form-check ps-0">
                  <input type="radio" class="form-check-input" id="color-filter2" checked>
                  <label class="form-check-label" for="color-filter2" data-bg-color="#4876ff"></label>
                </div>
                <small>Blue</small>
              </li>
              <li>
                <div class="form-check ps-0">
                  <input type="radio" class="form-check-input" id="color-filter3">
                  <label class="form-check-label" for="color-filter3" data-bg-color="#0a1b2b"></label>
                </div>
                <small>Black</small>
              </li>
              <li>
                <div class="form-check ps-0">
                  <input type="radio" class="form-check-input" id="color-filter4">
                  <label class="form-check-label" for="color-filter4" data-bg-color="#f94f15"></label>
                </div>
                <small>Orange</small>
              </li>
              <li class="mb-0">
                <div class="form-check ps-0">
                  <input type="radio" class="form-check-input" id="color-filter5">
                  <label class="form-check-label" for="color-filter5" data-bg-color="#FF00FF"></label>
                </div>
                <small>Fuchsia</small>
              </li>
              <li class="mb-0">
                <div class="form-check ps-0">
                  <input type="radio" class="form-check-input" id="color-filter6">
                  <label class="form-check-label" for="color-filter6" data-bg-color="#ffc300"></label>
                </div>
                <small>Yellow</small>
              </li>
              <li class="mb-0">
                <div class="form-check ps-0">
                  <input type="radio" class="form-check-input" id="color-filter7">
                  <label class="form-check-label" for="color-filter7" data-bg-color="#808080"></label>
                </div>
                <small>Gray</small>
              </li>
              <li class="mb-0">
                <div class="form-check ps-0">
                  <input type="radio" class="form-check-input" id="color-filter8">
                  <label class="form-check-label" for="color-filter8" data-bg-color="#008080"></label>
                </div>
                <small>Teal</small>
              </li>
            </ul>
          </div>
          <div class="widget widget-size">
            <h4 class="widget-title">Size</h4>
            <ul class="list-inline clearfix mb-0">
              <li>
                <input name="sc" id="xs-size" type="radio">
                <label for="xs-size">XS</label>
              </li>
              <li>
                <input name="sc" id="s-size" type="radio">
                <label for="s-size">S</label>
              </li>
              <li>
                <input name="sc" id="m-size" checked="" type="radio">
                <label for="m-size">M</label>
              </li>
              <li>
                <input name="sc" id="l-size" type="radio">
                <label for="l-size">L</label>
              </li>
              <li>
                <input name="sc" id="xl-size" type="radio">
                <label for="xl-size">XL</label>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--product end-->


</div>

<!--body content end--> 

<?php
include("includes/footer.php");
?>