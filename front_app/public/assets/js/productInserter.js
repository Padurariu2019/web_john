async function fillProducts(apiUrl, userId, filters) {
    const favoritesResponse = await fetch(`${apiUrl}/users/${userId}/favorites`);
    let favorites = [];
    if (favoritesResponse.status === 200) {
        favorites = await favoritesResponse.json();
    }

    const productsResponse = await fetch(`${apiUrl}/products${filters??''}`);
    const products = await productsResponse.json();
    document.getElementById("product-container").innerHTML =
        products.map(product => `
                    <div class="product" data-product-id="${product.id}">
                        <img src="http://localhost:5050/api/v1/products/${product.id}/image" alt="Product Image">
                        <div class="product-info">
                            <p><strong>Product name:</strong> ${product.name} </p>
                            <p><strong>Product brand:</strong> ${product.brand} </p>
                            <p><strong>Product description:</strong> ${product.description}</p>
                        </div>
                        <button class="favorite-button" onclick="toggleProductLike(${product.id}, ${userId}, '${apiUrl}')">
                            <i class="fa fa-heart ${favorites.includes(product.id) ? 'liked' : ''}"></i>
                        </button>
                    </div>`).join('');

    document.getElementById("product-container").innerHTML = '<div class="product-circle">PRODUCTS</div>' + document.getElementById("product-container").innerHTML;
}

async function toggleProductLike(productId, userId, apiUrl) {
    heartElement = document.querySelector(`.product[data-product-id="${productId}"]>.favorite-button>i`);

    let shouldAdd = heartElement.classList.contains('liked');
    heartElement.classList.toggle('liked');
    let response = 0;
    
    if (shouldAdd) {
        response = await fetch(`${apiUrl}/users/${userId}/favorites/${productId}`, {
            method: 'DELETE'
        });
        if (response.status !== 204) {
            heartElement.classList.toggle('liked');
        }
    } else {
        response = await fetch(`${apiUrl}/users/${userId}/favorites/${productId}`, {
            method: 'POST'
        });
        if (response.status !== 201) {
            heartElement.classList.toggle('liked');
        }
    }

}

window.onload = fillProducts(globalVars.apiUrl, globalVars.userId, globalVars.filters);