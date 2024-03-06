// document.addEventListener('DOMContentLoaded', function () {
//     // Get the form element by its ID
//     const form = document.getElementById('application-form');

//     // Check if the form exists
//     if (form) {
//         // Add a 'beforeunload' event listener to the window
//         window.addEventListener('beforeunload', function (event) {
//             // Check if the event is a form submission
//             const isFormSubmission = event.target === form || (event.target.nodeName === 'INPUT' && event.target.form === form);

//             // Check if any input in the form has a value and it's not a form submission
//             const unsavedChanges = !isFormSubmission && Array.from(form.elements).some(function (element) {
//                 return element.nodeName === 'INPUT' && element.value.trim() !== '';
//             });

//             // If there are unsaved changes, display the confirmation message
//             if (unsavedChanges) {
//                 const confirmationMessage = 'You have unsaved information. Do you want to leave and lose progress?';
//                 event.returnValue = confirmationMessage; // Standard for most browsers
//                 return confirmationMessage; // For some older browsers
//             }
//         });

//         // Add a submit event listener to the form
//         form.addEventListener('submit', function () {
//             // Remove the 'beforeunload' event listener when the form is submitted
//             window.removeEventListener('beforeunload');
//         });
//     }
// });