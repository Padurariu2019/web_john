document.addEventListener('DOMContentLoaded', () => {
    fillProducts();

    document.getElementById('category').addEventListener('change', function() {
        var category = this.options[this.selectedIndex].text;  // Get the text instead of the value
        var occasionsField = document.getElementById('occasions');
        var timeOfDayField = document.getElementById('times-of-day');

        const categoriesForTimeOfDay = ['Facemask', 'Cleanser', 'Toner', 'Serum', 'Moisturizer', 'Eye cream', 'Lipbalm', 'Lipoil', 'Lipmask', 'Sunscreen', 'Face oil', 'Face scrub', 'Vitamins', 'Eye mask', 'Illuminator'];
        const categoriesForOccasions = ['Foundation', 'Concealer', 'Powder', 'Blush', 'Bronzer', 'Highlighter', 'Eyeshadow', 'Eyeliner', 'Mascara', 'Lipstick', 'Lipgloss', 'Lipstain', 'Lipliner', 'Eyebrow pencil', 'Eyebrow gel', 'Primer', 'Setting spray', 'Setting powder'];

        if (categoriesForTimeOfDay.includes(category)) {
            occasionsField.style.display = 'none';
            timeOfDayField.style.display = 'block';
            clearCheckboxes(occasionsField);
        } else if (categoriesForOccasions.includes(category)) {
            timeOfDayField.style.display = 'none';
            occasionsField.style.display = 'block';
            clearCheckboxes(timeOfDayField);
        } else {
            occasionsField.style.display = 'none';
            timeOfDayField.style.display = 'none';
            clearCheckboxes(occasionsField);
            clearCheckboxes(timeOfDayField);
        }
    });
});

function clearCheckboxes(field) {
    let checkboxes = field.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => checkbox.checked = false);
}

function fillProducts() {
    return fetch('http://localhost:5050/api/v1/products')
        .then(response => response.json())
        .then(products => {
            document.getElementById("products-table").innerHTML =
                products.map(product => `
                    <tr>
                        <td data-label="ID">${product.id}</td>
                        <td data-label="Name">${product.name}</td>
                        <td data-label="Brand">${product.brand}</td>
                        <td><button class="round-button" onclick="deleteProduct(${product.id})"><i class="fa-solid fa-trash"></i></button></td>
                    </tr>`).join('');
        });
}

function deleteProduct(id) {
    fetch(`http://localhost:5050/api/v1/products/${id}`, {
        method: 'DELETE'
    }).then(() => {
        fillProducts();
    });
}
