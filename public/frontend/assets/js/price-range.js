let minValueLg = document.getElementById("range-min-lg")
let maxValueLg = document.getElementById("range-max-lg")
let minDisplayLg = document.getElementById("input-min-lg")
let maxDisplayLg = document.getElementById("input-max-lg")
let sliderTrack = document.querySelector(".progress")
let priceRangeErr = document.querySelector(".price-range-error")

function minPrice() {
  priceRangeErr.textContent = ''
  if(Number(minValueLg.value) < Number(maxValueLg.value)){
    minDisplayLg.value = minValueLg.value
    fillColor()
  }else{
    priceRangeErr.textContent = 'Minimum price can not be greater than maximum price.'
  }
}

function maxPrice() {
  priceRangeErr.textContent = ''
  if(Number(maxValueLg.value) > Number(minValueLg.value)){
    maxDisplayLg.value = maxValueLg.value
    fillColor()
  }else{
    priceRangeErr.textContent = 'Maximum price can not be greater than minumum price.'
  }
}

function fillColor() {
  percent1 = (minValueLg.value / maxValueLg.max) * 100
  percent2 = (maxValueLg.value / maxValueLg.max) * 100
  sliderTrack.style.background = `linear-gradient(to right, #dadae5 ${percent1}% , #3264fe ${percent1}% , #3264fe ${percent2}%, #dadae5 ${percent2}%)`
}