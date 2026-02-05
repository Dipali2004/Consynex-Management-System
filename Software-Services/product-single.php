
<?php
include("includes/header.php");
?>

<!--page title start-->

<section class="page-title">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8 col-md-12">
        <h1>
          <span>Product</span> Single
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
            <li class="breadcrumb-item active" aria-current="page">Product Single</li>
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
    <div class="row align-items-center">
      <div class="col-lg-5 col-md-6">
        <img class="img-fluid w-100 rounded" src="images/product/01.html" alt="" />
      </div>
      <div class="col-lg-7 col-md-6 mt-5 mt-md-0 ps-lg-5">
        <div class="product-details">
          <h3>3d Iphone</h3>
          <div class="product-price my-4">
            <span class="product-price text-black">
              <del>$85.00</del> $75.00 </span>
            <span class="text-theme">
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
            </span>
          </div>
          <ul class="list-unstyled mb-4">
            <li class="mb-2">
              <span class="text-black"> Availibility: </span> In Stock
            </li>
            <li>
              <span class="text-black"> Categories :</span> Equipment
            </li>
          </ul>
          <p>Combine anything worth nothing that you can combine anything you see on our services. The possibilities are unlimited!Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
          <div class="row my-4">
            <div class="col-lg-5 col-sm-6">
              <h6 class="mb-2 text-black">Size</h6>
              <select class="form-control form-select">
                <option selected>Size</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
              </select>
            </div>
            <div class="col-lg-7 col-sm-6 mt-3 mt-sm-0">
              <div class="widget-color">
                <h6>Color</h6>
                <div class="d-flex">
                  <div class="form-check ps-0 me-3">
                    <input type="radio" class="form-check-input" id="color-filter1" name="Radios">
                    <label class="form-check-label" for="color-filter1" data-bg-color="#3cb371" style="background-color: rgb(60, 179, 113);"></label>
                  </div>
                  <div class="form-check ps-0 me-3">
                    <input type="radio" class="form-check-input" id="color-filter2" name="Radios" checked="">
                    <label class="form-check-label" for="color-filter2" data-bg-color="#4876ff" style="background-color: rgb(72, 118, 255);"></label>
                  </div>
                  <div class="form-check ps-0 me-3">
                    <input type="radio" class="form-check-input" id="color-filter3" name="Radios">
                    <label class="form-check-label" for="color-filter3" data-bg-color="#0a1b2b" style="background-color: rgb(10, 27, 43);"></label>
                  </div>
                  <div class="form-check ps-0">
                    <input type="radio" class="form-check-input" id="color-filter4" name="Radios">
                    <label class="form-check-label" for="color-filter4" data-bg-color="#f94f15" style="background-color: rgb(249, 79, 21);"></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="d-flex align-items-center">
            <h6 class="mb-0 me-3">Quantity:</h6>
            <div class="d-flex align-items-center">
              <button class="btn-product btn-product-up">
                <i class="bi bi-dash"></i>
              </button>
              <input class="form-product" type="number" name="form-product" value="1">
              <button class="btn-product btn-product-down">
                <i class="bi bi-plus"></i>
              </button>
            </div>
          </div>
          <div class="product-link d-flex align-items-center mt-5">
            <button class="themeht-btn me-3" type="button">Add To Cart</button>
            <button class="themeht-btn dark-btn" type="button">Add To Wishlist</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--product end-->


<!--tab start-->

<section class="pt-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="tab">
          <!-- Nav tabs -->
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active ms-0" id="nav-tab1" data-bs-toggle="tab" href="#tab3-1" role="tab" aria-selected="true">Description</a>
              <a class="nav-item nav-link" id="nav-tab2" data-bs-toggle="tab" href="#tab3-2" role="tab" aria-selected="false">Additional information</a>
              <a class="nav-item nav-link" id="nav-tab3" data-bs-toggle="tab" href="#tab3-3" role="tab" aria-selected="false">Reviews (3)</a>
            </div>
          </nav>
          <!-- Tab panes -->
          <div class="tab-content p-0 pt-5">
            <div role="tabpanel" class="tab-pane fade show active" id="tab3-1">
              <h5 class="mb-3">Product Description</h5>
              <p class="mb-0">Automate Task Creation: Lorem Ipsum is simply of the printing typesetting has been the industry’s standard dummy text. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat Praesent pharetra, justo ut scelerisque mattis, leo quam aliquet diam, congue laoreet elit metus eget diam. Proin ac metus diam. In quis scelerisque velit. Proin pellentesque neque ut scelerisque dapibus. Praesent elementum feugiat dignissim. Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque mattis, leo quam aliquet diam, nisi interdum mollis. Praesent pharetra, justo ut scelerisque mattis.</p>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab3-2">
              <h5 class="mb-3">Additional information</h5>
              <table class="table table-bordered mb-0">
                <tbody>
                  <tr>
                    <td>Size</td>
                    <td>Small, Medium, Large &amp; Extra Large</td>
                  </tr>
                  <tr>
                    <td>Color</td>
                    <td>Black, Green, Blue</td>
                  </tr>
                  <tr>
                    <td>Chest</td>
                    <td>38 inches</td>
                  </tr>
                  <tr>
                    <td>Waist</td>
                    <td>20 cm</td>
                  </tr>
                  <tr>
                    <td>Length</td>
                    <td>35 cm</td>
                  </tr>
                  <tr>
                    <td>Fabric</td>
                    <td>Cotton, Silk &amp; Synthetic</td>
                  </tr>
                  <tr>
                    <td>Warranty</td>
                    <td>6 Months</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab3-3">
              <div class="row total-rating align-items-center">
                <div class="col-md-6">
                  <div class="dark-bg rounded text-center p-5">
                    <h5 class="text-white">Overall</h5>
                    <h4 class="text-white">4.0</h4>
                    <h6 class="text-white">(03 Reviews)</h6>
                  </div>
                </div>
                <div class="col-md-6 mt-3 mt-lg-0">
                  <div class="rating-list">
                    <div class="d-flex align-items-center mb-2">
                      <div class="text-nowrap me-3">5 Star</div>
                      <div class="w-100">
                        <div class="progress" style="height: 5px;">
                          <div class="progress-bar bg-success" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <span class="text-grey ms-3">90%</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                      <div class="text-nowrap me-3">4 Star</div>
                      <div class="w-100">
                        <div class="progress" style="height: 5px;">
                          <div class="progress-bar bg-success" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <span class="text-grey ms-3">60%</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                      <div class="text-nowrap me-3">3 Star</div>
                      <div class="w-100">
                        <div class="progress" style="height: 5px;">
                          <div class="progress-bar bg-success" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <span class="text-grey ms-3">40%</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                      <div class="text-nowrap me-3">2 Star</div>
                      <div class="w-100">
                        <div class="progress" style="height: 5px;">
                          <div class="progress-bar bg-warning" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <span class="text-grey ms-3">20%</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                      <div class="text-nowrap me-3">1 Star</div>
                      <div class="w-100">
                        <div class="progress" style="height: 5px;">
                          <div class="progress-bar bg-danger" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <span class="text-grey ms-3">10%</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-5">
                <div class="col-md-7">
                  <div class="review-list border border-light p-5 rounded">
                    <div class="row border-bottom border-light pb-5 mb-5">
                      <div class="mb-4 mb-md-0 col-md-auto">
                        <img class="img-fluid rounded" alt="image" src="images/thumbnail/01.jpg">
                      </div>
                      <div class="col-md">
                        <h6 class="mb-2">Saina Paul</h6>
                        <p>Donec viverra sodales arcu gravida nibh at. Neque lobortis quis porta integer et placerat lectus scelerisque. Velit eget malesuada morbi faucibus at sed euismod. Tortor, eu ut id tincidunt leo placerat luctus</p>
                        <span class="text-theme">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                        </span>
                      </div>
                    </div>
                    <div class="row border-bottom border-light pb-5 mb-5">
                      <div class="mb-4 mb-md-0 col-md-auto">
                        <img class="img-fluid rounded" alt="image" src="images/thumbnail/02.html">
                      </div>
                      <div class="col-md">
                        <h6 class="mb-2">Nicole Lana</h6>
                        <p>Donec viverra sodales arcu gravida nibh at. Neque lobortis quis porta integer et placerat lectus scelerisque. Velit eget malesuada morbi faucibus at sed euismod. Tortor, eu ut id tincidunt leo placerat luctus</p>
                        <span class="text-theme">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                        </span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="mb-4 mb-md-0 col-md-auto">
                        <img class="img-fluid rounded" alt="image" src="images/thumbnail/03.html">
                      </div>
                      <div class="col-md">
                        <h6 class="mb-2">Abela Lust</h6>
                        <p>Donec viverra sodales arcu gravida nibh at. Neque lobortis quis porta integer et placerat lectus scelerisque. Velit eget malesuada morbi faucibus at sed euismod. Tortor, eu ut id tincidunt leo placerat luctus</p>
                        <span class="text-theme">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="post-comments white-bg box-shadow rounded p-4">
                    <h4 class="mb-4">Add Review</h4>
                    <form id="contact-form" method="post" action="https://themeht.com/template/soften/ltr/contact.php">
                      <div class="messages"></div>
                      <div class="form-group">
                        <input id="form_name" type="text" name="name" class="form-control" placeholder="Name" required="required" data-error="Name is required.">
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                        <input id="form_email" type="email" name="email" class="form-control" placeholder="Email Address" required="required" data-error="Valid email is required.">
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group clearfix">
                        <select class="form-control form-select">
                          <option value="">Rating -- Select</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <input id="form_number" type="text" name="name" class="form-control" placeholder="Phone Number" required="required">
                      </div>
                      <div class="form-group">
                        <textarea id="form_message" name="message" class="form-control" placeholder="Type Comment" rows="4" required="required" data-error="Please,leave us a message."></textarea>
                        <div class="help-block with-errors"></div>
                      </div>
                      <button class="themeht-btn mt-3">Post Review</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--tab end-->

</div>

<!--body content end--> 
<?php
include("includes/footer.php");
?>