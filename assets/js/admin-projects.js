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

document.addEventListener('DOMContentLoaded', function () {
    var collapseElements = document.querySelectorAll('.collapse');

    collapseElements.forEach(function (collapseEl) {
        collapseEl.addEventListener('show.bs.collapse', function () {
            collapseElements.forEach(function (el) {
                if (el !== collapseEl) {
                    var bsCollapse = new bootstrap.Collapse(el, {toggle: false});
                    bsCollapse.hide();
                }
            });
        });
    });
});