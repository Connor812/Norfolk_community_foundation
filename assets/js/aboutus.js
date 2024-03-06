function updateVideoPreview(videoInputId, videoPreviewId) {
    var videoInput = document.getElementById(videoInputId);
    var videoPreview = document.getElementById(videoPreviewId);

    // Check if a file is selected
    if (videoInput.files && videoInput.files[0]) {
        var videoBlobUrl = URL.createObjectURL(videoInput.files[0]);

        // Update the 'src' attribute of the video tag
        videoPreview.src = videoBlobUrl;
    }
}

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