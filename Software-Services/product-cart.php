
<?php
include("includes/header.php");
?>

<!--page title start-->

<section class="page-title">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8 col-md-12">
        <h1>
          <span>Product</span> Cart
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
            <li class="breadcrumb-item active" aria-current="page">Product Cart</li>
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

<!--cart start-->

<section>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="table-responsive mb-5">
          <table class="cart-table table text-center mb-0 table-bordered">
            <thead>
              <tr>
                <th class="h5 mb-0 py-3" scope="col">Product</th>
                <th class="h5 mb-0 py-3" scope="col">Price</th>
                <th class="h5 mb-0 py-3" scope="col">Quantity</th>
                <th class="h5 mb-0 py-3" scope="col">Total</th>
                <th class="h5 mb-0 py-3" scope="col">Remove</th>
              </tr>
            </thead>
            <tbody class="border-top-0">
              <tr>
                <td>
                  <div class="d-md-flex align-items-center">
                    <a href="#">
                      <img class="img-fluid rounded me-lg-3 mb-2 mb-lg-0" src="images/product-thumb/01.html" alt="">
                    </a>
                    <div class="text-start">
                      <a href="product-single.html" class="product-name link-title h6">Robot Arm System</a>
                    </div>
                  </div>
                </td>
                <td>
                  <h6 class="mb-0">$75.00</h6>
                </td>
                <td>
                  <div class="d-flex justify-content-center align-items-center">
                    <button class="btn-product btn-product-up">
                      <i class="bi bi-dash"></i>
                    </button>
                    <input class="form-product" type="number" name="form-product" value="1">
                    <button class="btn-product btn-product-down">
                      <i class="bi bi-plus"></i>
                    </button>
                  </div>
                </td>
                <td>
                  <h6 class="mb-0">$75.00</h6>
                </td>
                <td class="border-right-0">
                  <button type="submit" class="themeht-btn fs-5">
                    <i class="bi bi-x-lg"></i>
                  </button>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="d-md-flex align-items-center">
                    <a href="#">
                      <img class="img-fluid rounded me-lg-3 mb-2 mb-lg-0" src="images/product-thumb/02.html" alt="">
                    </a>
                    <div class="text-start">
                      <a href="product-single.html" class="product-name link-title h6">Assembly Plant</a>
                    </div>
                  </div>
                </td>
                <td>
                  <h6 class="mb-0">$19.00</h6>
                </td>
                <td>
                  <div class="d-flex justify-content-center align-items-center">
                    <button class="btn-product btn-product-up">
                      <i class="bi bi-dash"></i>
                    </button>
                    <input class="form-product" type="number" name="form-product" value="1">
                    <button class="btn-product btn-product-down">
                      <i class="bi bi-plus"></i>
                    </button>
                  </div>
                </td>
                <td>
                  <h6 class="mb-0">$19.00</h6>
                </td>
                <td class="border-right-0">
                  <button type="submit" class="themeht-btn fs-5">
                    <i class="bi bi-x-lg"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-lg-6">
        <div>
          <label class="text-black h4">Coupon</label>
          <p>Enter your coupon code if you have one.</p>
          <div class="input-group">
            <input class="form-control rounded" id="c-code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2" type="text">
            <div class="input-group-append ms-2">
              <button class="themeht-btn" type="button" id="button-addon2">Apply Coupon</button>
            </div>
          </div>
        </div>
        <div class="mt-5">
          <button class="themeht-btn me-2">Update Cart</button>
          <button class="themeht-btn dark-btn">Cancel</button>
        </div>
      </div>
      <div class="col-lg-6 mt-5 mt-lg-0 ps-lg-5">
        <div class="p-5 light-bg rounded">
          <div class="p-5 white-bg rounded">
            <h4 class="text-black text-center mb-2">Cart Totals</h4>
            <div class="d-flex justify-content-between align-items-center border-bottom py-3">
              <span>Subtotal</span>
              <span class="text-black">$94.00</span>
            </div>
            <div class="d-flex justify-content-between align-items-center border-bottom py-3">
              <span>Tax</span>
              <span class="text-black">$00.00</span>
            </div>
            <div class="d-flex justify-content-between align-items-center pt-3 mb-5">
              <span class="text-black h5">Total</span>
              <span class="text-black font-weight-bold h5">$94.00</span>
            </div>
            <a class="themeht-btn w-100 text-center" href="product-checkout.html">Proceed To Checkout</a>
            <a class="themeht-btn dark-btn w-100 text-center mt-3" href="product-grid.html">Continue Shopping</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--cart end-->


</div>

<!--body content end--> 
<?php
include("includes/footer.php");
?>