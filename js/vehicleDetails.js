document.querySelectorAll('.images-thumbnail img').forEach(el => {
    el.addEventListener('click', function(e) {
        document.getElementById('imageVehicleSelected').setAttribute('src', e.target.getAttribute('data-src'));
    });
});