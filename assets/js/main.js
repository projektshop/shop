$(document).ready(function () {
    var search = document.getElementById('search'),
        productsList = document.getElementById('products-list'),
        products = productsList.querySelectorAll('.product');

    search.addEventListener('input', function (e) {
        products.forEach(function (product){
            if (product.dataset.name.toLowerCase().includes(e.target.value.toLowerCase())) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    });

    products.forEach(function (product) {
        product.querySelector('.cart-action').addEventListener('click', function () {
            var formData = new FormData();
            formData.append('product', product.dataset.id);
            formData.append('quantity', product.querySelector('.quantity').value);

            fetch('cart_add.php', {
                method: 'POST',
                mode: 'cors',
                cache: 'no-cache',
                credentials: 'same-origin',
                redirect: 'follow',
                referrer: 'no-referrer',
                body: formData,
            }).then(function (response){
                if (response.status === 200) {
                    var cartLink = document.getElementById('cart-link');

                    if (cartLink && cartLink.classList.contains('hidden')) {
                        cartLink.classList.remove('hidden');
                    }
                }
            });
        });
    });
});