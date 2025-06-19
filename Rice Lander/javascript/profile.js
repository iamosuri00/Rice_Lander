document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const firstNameInput = document.getElementById('fullname');
    const phoneInput = document.getElementById('Phone');
    const uploadPicInput = document.getElementById('upload-pic');
    const profilePic = document.getElementById('profile-pic');

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        alert('Form submitted!');
        console.log('Name:', firstNameInput.value);
        console.log('Phone:', phoneInput.value);
    });

    uploadPicInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                profilePic.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    document.querySelectorAll('.reorder').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            alert('Reordering item...');
        });
    });

    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            alert('Item added to cart');
        });
    });
});
