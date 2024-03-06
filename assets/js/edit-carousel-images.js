const collapseBtns = document.querySelectorAll(".collapse-btn");

collapseBtns.forEach(button => {
    button.addEventListener("click", () => {
        if (document.querySelector(".show")) {
            const activeImg = document.querySelector(".show");
            activeImg.classList.remove("show");
            activeImg.classList.add("collapsing");
            console.log(activeImg);
            setTimeout(() => {
                activeImg.classList.remove("collapsing");
                activeImg.classList.add("collapse")
            }, 500);
        }
    })
});

// Function to handle file input change
var fileInputs = document.querySelectorAll('.carousel-img');

fileInputs.forEach(function (fileInput) {
    fileInput.addEventListener('change', function () {
        var imgNum = this.getAttribute('data-img-num');
        var imgPreview = document.getElementById(imgNum);
        var submitButton = document.getElementById('edit-image-' + imgNum + '-container').querySelector('.submit-btn');

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imgPreview.src = e.target.result;
                submitButton.disabled = false; // Enable the corresponding submit button
            };

            reader.readAsDataURL(this.files[0]);
        }
    });
});