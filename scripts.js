document.addEventListener('DOMContentLoaded', function() {
    const addToOrderButtons = document.querySelectorAll('.add-to-order');

    addToOrderButtons.forEach(button => {
        button.addEventListener('click', function() {
            const itemName = this.previousElementSibling.previousElementSibling.textContent;
            alert(`${itemName} added to your order!`);
            // Here you can add more code to actually add the item to the order list
        });
    });
});

function addToOrder(productName) {
    const url = new URL('customer_order.html', window.location.origin);
    url.searchParams.append('product_name', productName);
    window.location.href = url;
}

