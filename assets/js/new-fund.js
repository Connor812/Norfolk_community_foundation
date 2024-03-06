function updateImagePreview(imageInputId, imagePreviewId) {
    var imageInput = document.getElementById(imageInputId);
    var imagePreview = document.getElementById(imagePreviewId);

    // Check if a file is selected
    if (imageInput.files && imageInput.files[0]) {
        var imageBlobUrl = URL.createObjectURL(imageInput.files[0]);

        // Update the 'src' attribute of the image tag
        imagePreview.src = imageBlobUrl;
    }
}

const newCategoryBtn = document.getElementById("new-category");

newCategoryBtn.addEventListener("click", function (event) {

    const categoryInput = document.getElementById("category-input");
    const categorySelect = document.getElementById("category-select");
    const categoryDescription = document.getElementById("category-description-container");
    // I also need the text to change in the newCategoryBtn to "Cancel"
    if (newCategoryBtn.textContent === "Cancel") {
        newCategoryBtn.textContent = "New Category";
        categoryInput.style.display = "none";
        categorySelect.style.display = "block";
        categoryDescription.style.display = "none";
    } else {
        newCategoryBtn.textContent = "Cancel";
        categoryInput.style.display = "block";
        categorySelect.style.display = "none";
        categoryDescription.style.display = "block";
    }
});