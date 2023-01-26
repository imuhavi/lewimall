@extends('frontend.master')
@section('header_css')
<link rel="stylesheet" href="{{ asset('/frontend/assets/') }}/css/price-range.css">
@endsection
@section('content')
<main>
  <section class="container" id="category-shop">
    <!-- Bradcum Here -->
    <div class="d-flex justify-content-between my-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Category</a></li>
          <li class="breadcrumb-item active" aria-current="page">

            @if(isset($page) && $page == 'subCategoryShop')
            {{ $subcategory->name }}
            @elseif(isset($page) && $page == 'categoryShop')
            {{ $category->name }}
            @endif
          </li>
        </ol>
      </nav>

      <button class="btn btn-outline-secondary d-lg-none" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#filter" aria-controls="filter"><i class="fas fa-filter"></i></button>
    </div>

    <!-----------------------------
            Filter For Mobile 
      ------------------------------>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="filter" aria-labelledby="offcanvasRightLabel"
      data-bs-scroll="true">
      <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Filter By</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div class="col-md-12 siderbar">
          <aside>
            <div class="filter-container border p-3 rounded">
              <h4>Filter By</h4>

              <div class="accordion mt-4" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="filter-button" type="button" data-bs-toggle="collapse"
                      data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                      aria-controls="panelsStayOpen-collapseOne">
                      Filter By Price <i class="fas fa-caret-down text-right"></i>
                    </button>
                  </h2>
                  <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                      <div class="price-range-wraper">
                        <div class="price-input">
                          <div class="field">
                            <span>Min</span>
                            <input type="number" onchange="filter()" id="input-min-sm" value="{{ $min }}"
                              min="{{ $min }}" max="{{ $max }}">
                          </div>
                          <div class="field">
                            <span>Max</span>
                            <input type="number" onchange="filter()" id="input-max-sm" value="{{ $max }}"
                              min="{{ $min }}" max="{{ $max }}">
                          </div>
                        </div>
                        <div class="slider">
                          <div class="progress"></div>
                        </div>
                        <div class="range-input">
                          <input type="range" id="range-min" min="{{ $min }}" max="{{ $max }}" value="{{ $min }}"
                            step="5" oninput="minPrice()" onchange="filter()">
                          <input type="range" id="range-max" min="{{ $min }}" max="{{ $max }}" value="{{ $max }}"
                            step="10" oninput="maxPrice()" onchange="filter()">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="accordion-item mt-3">
                  <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button class="filter-button" type="button" data-bs-toggle="collapse"
                      data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true"
                      aria-controls="panelsStayOpen-collapseTwo">
                      Filter By Color <i class="fas fa-caret-down text-right"></i>
                    </button>
                  </h2>
                  <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">

                      <ul class="filter-color" id="filter-color">

                        @foreach($colorAttributesArr as $item)
                        <li>
                          <div class="form-check">
                            <input class="form-check-input filter-select"
                              onchange="setCurrentValue('color', this.value)" value="{{ $item }}" type="radio"
                              name="color" id="color-{{ $item }}">
                            <label class="form-check-label" for="color-{{ $item }}">
                              {{ ucfirst($item) }}
                            </label>
                          </div>
                        </li>
                        @endforeach

                      </ul>

                    </div>
                  </div>
                </div>

                <div class="accordion-item mt-3">
                  <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                    <button class="filter-button" type="button" data-bs-toggle="collapse"
                      data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="true"
                      aria-controls="panelsStayOpen-collapseThree">
                      Filter By Size <i class="fas fa-caret-down text-right"></i>
                    </button>
                  </h2>
                  <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body">
                      <ul class="filter-size">

                        @foreach($sizeAttributesArr as $item)
                        <li>
                          <div class="form-check">
                            <input class="form-check-input filter-select" onchange="setCurrentValue('size', this.value)"
                              value="{{ $item }}" type="radio" name="size" id="size-{{ $item }}">
                            <label class="form-check-label" for="size-{{ $item }}">
                              {{ ucfirst($item) }}
                            </label>
                          </div>
                        </li>
                        @endforeach

                      </ul>
                    </div>
                  </div>
                </div>




              </div>

            </div>
          </aside>
        </div>
      </div>
    </div>


    <div class="row">
      <!---------------------------------
                Left Sidebar
        -------------------------------->

      <div class="col-lg-3 siderbar d-none d-sm-none d-md-none d-lg-block">
        <aside>
          <div class="filter-container border p-3 rounded">
            <h4>Filter By</h4>
            <div class="accordion mt-4" id="accordionPanelsStayOpenExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                  <button class="filter-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                    aria-controls="panelsStayOpen-collapseOne">
                    Filter By Price <i class="fas fa-caret-down text-right"></i>
                  </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                  aria-labelledby="panelsStayOpen-headingOne">
                  <div class="accordion-body">
                    <div class="price-range-wraper">
                      <div class="price-input">
                        <div class="field">
                          <span>Min</span>
                          <input type="number" onchange="filter()" id="input-min-lg" value="{{ $min }}" min="{{ $min }}"
                            max="{{ $max }}">
                        </div>
                        <div class="field">
                          <span>Max</span>
                          <input type="number" onchange="filter()" id="input-max-lg" value="{{ $max }}" min="{{ $min }}"
                            max="{{ $max }}">
                        </div>
                      </div>
                      <div class="slider">
                        <div class="progress"></div>
                      </div>
                      <div class="range-input">
                        <input type="range" id="range-min-lg" min="{{ $min }}" max="{{ $max }}" value="{{ $min }}"
                          step="5" oninput="minPrice()" onchange="filter()">
                        <input type="range" id="range-max-lg" min="{{ $min }}" max="{{ $max }}" value="{{ $max }}"
                          step="10" oninput="maxPrice()" onchange="filter()">
                      </div>
                      <small class="price-range-error text-danger mt-1"></small>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="accordion-item mt-3">
              <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                <button class="filter-button" type="button" data-bs-toggle="collapse"
                  data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true"
                  aria-controls="panelsStayOpen-collapseTwo">
                  Filter By Color <i class="fas fa-caret-down text-right"></i>
                </button>
              </h2>
              <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
                aria-labelledby="panelsStayOpen-headingTwo">
                <div class="accordion-body">
                  <input type="hidden" id="selectedColor" value="">
                  <ul class="filter-color" id="filter-color">
                    @foreach($colorAttributesArr as $item)
                    <li>
                      <div class="form-check">
                        <input class="form-check-input filter-select" onchange="setCurrentValue('color', this.value)"
                          value="{{ $item }}" type="radio" name="color" id="color-{{ $item }}">
                        <label class="form-check-label" for="color-{{ $item }}">
                          {{ ucfirst($item) }}
                        </label>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>

            <div class="accordion-item mt-3">
              <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                <button class="filter-button" type="button" data-bs-toggle="collapse"
                  data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="true"
                  aria-controls="panelsStayOpen-collapseThree">
                  Filter By Size <i class="fas fa-caret-down text-right"></i>
                </button>
              </h2>
              <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show"
                aria-labelledby="panelsStayOpen-headingThree">
                <div class="accordion-body">
                  <input type="hidden" id="selectedSize" value="">
                  <ul class="filter-size" id="filter-size">
                    @foreach($sizeAttributesArr as $item)
                    <li>
                      <div class="form-check">
                        <input class="form-check-input filter-select" onchange="setCurrentValue('size', this.value)"
                          value="{{ $item }}" type="radio" name="size" id="size-{{ $item }}">
                        <label class="form-check-label" for="size-{{ $item }}">
                          {{ ucfirst($item) }}
                        </label>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>

          </div>
        </aside>
      </div>

      <!---------------------------------
                    Products
        -------------------------------->

      <div class="col-md-12 col-lg-9">
        <div class="row mb-5">
          <div class="col-12 d-flex justify-content-between">
            @if(isset($page))
            <h2>{{ $page == 'subCategoryShop' ? $subcategory->name : $category->name}}</h2>
            @endif
            <div class="filter">
              <select id="select_js" onchange="filter()">
                <option value="">Filter By</option>
                <option value="desc" selected>New to Old</option>
                <option value="asc">Old to New</option>
              </select>
              <a href="" class="btn btn-md btn-dark ms-3">Clear filter</a>
            </div>
          </div>
        </div>

        <div class="row gy-5" id="content"></div>

        <div class="d-flex justify-content-center">
          <button type="button" onclick="loadMore()" style="display: none;" id="loadMoreBtn"
            class="btn btn-md btn-dark mt-2">Load more...</button>
          <button type="button" id="noDataBtn" style="display: none;"
            class="btn btn-md btn-dark mt-2">Loading...</button>
        </div>
      </div>

    </div>

  </section>
</main>

<script>
  let min = getElement('input-min-lg'),
    max = getElement('input-max-lg'),
    filterBy = getElement('select_js'),
    color = getElement('selectedColor'),
    size = getElement('selectedSize'),
    skip = 0,
    category = location.pathname.split('/')[3],
    catOrSub = "{{ isset($page) ? $page : '' }}",
    content = getElement('content'),
    mode = 'filter',
    loadMoreBtn = getElement('loadMoreBtn'),
    noDataBtn = getElement('noDataBtn')

  function loadMore() {
    skip += 12
    mode = 'loadmore'
    fetchProduct()
  }
  function filter() {
    skip = 0
    mode = 'filter'
    fetchProduct()
  }
  function fetchProduct() {
    loadMoreBtn.style.display = 'none'
    noDataBtn.style.display = 'block'
    fetch(`/filter/products?min=${min.value}&max=${max.value}&filterBy=${filterBy.value}&color=${color.value}&size=${size.value}&skip=${skip}&category=${category}&cat_or_sub=${catOrSub}`)
      .then(response => response.text())
      .then(data => {
        if (data.length != 0) {
          if (mode == 'filter') {
            content.innerHTML = data
          } else if (mode == 'loadmore') {
            content.innerHTML += data
          }
          loadMoreBtn.style.display = 'block'
          noDataBtn.style.display = 'none'
        } else {
          noDataBtn.textContent = 'No more product..'
        }
      })
      .catch(error => console.log(error))
  }
  onload = () => {
    filter()
    getCart()
  }
  function setCurrentValue(field, value) {
    switch (field) {
      case 'color':
        color.value = value
        break;
      case 'size':
        size.value = value
        break;
    }
    filter()
  }
  function getElement(id) {
    return document.getElementById(id)
  }
</script>

@endsection

@section('footer_js')
<script src="{{ asset('/frontend/assets/') }}/js/price-range.js" type="text/javascript"></script>

<script src="{{ asset('/frontend/assets/') }}/js/price-range-sm.js" type="text/javascript"></script>
@endsection