
<?php
include("includes/header.php");
?>
<!--page title start-->

<section class="page-title">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8 col-md-12">
        <h1>
          <span>Product</span> Checkout
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
            <li class="breadcrumb-item active" aria-current="page">Product Checkout</li>
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

<!--checkout start-->

<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-12">
        <div class="checkout-form box-shadow white-bg rounded p-5">
          <h2 class="mb-4">Billing Details</h2>
          <form class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>First Name</label>
                <input type="text" id="fname" class="form-control" placeholder="Your firstname">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" id="lname" class="form-control" placeholder="Your lastname">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>E-mail Address</label>
                <input type="text" id="email" class="form-control" placeholder="State Province">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Phone Number</label>
                <input type="text" id="phone" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Company Name</label>
                <input type="text" id="companyname" class="form-control" placeholder="Company Name">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Select Country</label>
                <select class="form-control form-select">
                  <option value="#">Select country</option>
                  <option value="#">Alaska</option>
                  <option value="#">China</option>
                  <option value="#">Japan</option>
                  <option value="#">Korea</option>
                  <option value="#">Philippines</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Address</label>
                <input type="text" id="address" class="form-control" placeholder="Enter Your Address">
              </div>
              <div class="form-group">
                <input type="text" id="address2" class="form-control" placeholder="Second Address">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Town/City</label>
                <input type="text" id="towncity" class="form-control" placeholder="Town or City">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-md-0">
                <label>State/Province</label>
                <input type="text" id="statename" class="form-control" placeholder="State Province">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-md-0">
                <label>Zip/Postal Code</label>
                <input type="text" id="zippostalcode" class="form-control" placeholder="Zip / Postal">
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-lg-4 col-md-12 mt-7 mt-lg-0 ps-lg-8">
        <div class="row mb-5">
          <div class="col-md-12">
            <h5 class="mb-3 text-theme">Coupon Code</h5>
            <div>
              <label class="mb-3">Enter your coupon code if you have one</label>
              <div class="input-group">
                <input class="form-control rounded" id="c-code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2" type="text">
                <div class="input-group-append ms-2">
                  <button class="themeht-btn" type="button" id="button-addon2">Apply</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div>
          <h5 class="mb-3 text-theme">Your Order</h5>
          <ul class="list-unstyled">
            <li class="mb-3 border-bottom pb-3"><span> 1 x Product Name </span> $ 2404.00</li>
            <li class="mb-3 border-bottom pb-3"><span> 1 x Product Name </span> $ 498.00</li>
            <li class="mb-3 border-bottom pb-3"><span> Shipping </span> $ 0.00</li>
            <li class="mb-3 border-bottom pb-3"><span> Subtotal </span> $ 2830.00</li>
            <li class="text-black"><span><strong class="cart-total"> Total :</strong></span>  <strong class="cart-total">$ 2830.00 </strong>
            </li>
          </ul>
        </div>
        <div class="cart-detail my-5">
          <h5 class="mb-3 text-theme">Payment Method</h5>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio1">
              <label class="form-check-label" for="customRadio1">Direct Bank Tranfer</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio2">
              <label class="form-check-label" for="customRadio2">Check Payment</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio3">
              <label class="form-check-label" for="customRadio3">Paypal Account</label>
            </div>
          </div>
          <div class="form-group mb-0">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">I have read and accept the terms and conditions</label>
            </div>
          </div>
        </div>
        <button class="themeht-btn">Proceed to Payment</button>
      </div>
    </div>
  </div>
</section>

<!--checkout end-->


</div>

<!--body content end--> 
<?php
include("includes/footer.php");
?>