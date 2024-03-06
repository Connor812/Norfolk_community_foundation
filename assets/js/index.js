document.addEventListener('DOMContentLoaded', function () {
  var carousel = new bootstrap.Carousel(document.getElementById('carouselExampleFade'));

  // Event listener for when the carousel slides
  carousel._element.addEventListener('slide.bs.carousel', function (event) {
    var activeIndex = event.to;
    updateActiveButton(activeIndex);
  });

  // Function to update the active button
  function updateActiveButton(index) {
    // Remove 'button-active' class from all buttons
    document.querySelectorAll('.carousel-index-button').forEach(function (button) {
      button.classList.remove('button-active');
    });

    // Add 'button-active' class to the corresponding button
    var activeButton = document.getElementById('button-' + (index + 1));
    if (activeButton) {
      activeButton.classList.add('button-active');
    }
  }
});