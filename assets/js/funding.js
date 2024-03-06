document.addEventListener('DOMContentLoaded', function () {
    var checkboxes = document.querySelectorAll('.form-check-input');
    var applicationButton = document.getElementById('application-start');

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            var allChecked = Array.from(checkboxes).every(function (checkbox) {
                return checkbox.checked;
            });

            applicationButton.disabled = !allChecked;
        });
    });
});