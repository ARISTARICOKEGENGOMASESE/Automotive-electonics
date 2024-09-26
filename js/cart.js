// Cart state
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Function to add a product to the cart
function addToCart(productId, name, price, image) {
    const existingItem = cart.find(item => item.id === productId);
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ id: productId, name, price, image, quantity: 1 });
    }
    updateCart();
}

// Function to remove a product from the cart
function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    updateCart();
}

// Function to update cart quantity
function updateQuantity(productId, newQuantity) {
    const item = cart.find(item => item.id === productId);
    if (item) {
        item.quantity = Math.max(1, newQuantity);
        updateCart();
    }
}

// Function to calculate total price
function calculateTotal() {
    return cart.reduce((total, item) => total + item.price * item.quantity, 0);
}

// Function to update cart display
function updateCart() {
    const cartItemsContainer = document.getElementById('cart-items');
    const totalElement = document.querySelector('.total-price');
    
    if (cartItemsContainer) {
        // Clear current cart display
        cartItemsContainer.innerHTML = '';
        
        // Add each item to the cart display
        cart.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="cart-info">
                    <img src="${item.image}" alt="${item.name}">
                    <div>
                        <p>${item.name}</p>
                        <small>Price: Ksh ${item.price.toFixed(2)}</small><br>
                        <a href="#" onclick="removeFromCart(${item.id}); return false;">Remove</a>
                    </div>
                </td>
                <td><input type="number" value="${item.quantity}" min="1" onchange="updateQuantity(${item.id}, this.value)"></td>
                <td>Ksh ${(item.price * item.quantity).toFixed(2)}</td>
            `;
            cartItemsContainer.appendChild(row);
        });
    }
    
    if (totalElement) {
        // Update total price
        const total = calculateTotal();
        totalElement.innerHTML = `
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>Ksh ${total.toFixed(2)}</td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>Ksh ${(total * 0.1).toFixed(2)}</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>Ksh ${(total * 1.1).toFixed(2)}</td>
                </tr>
            </table>
        `;
    }
    
    // Update cart icon
    const cartIcons = document.querySelectorAll('.cart-icon');
    cartIcons.forEach(icon => {
        icon.textContent = cart.reduce((sum, item) => sum + item.quantity, 0);
    });

    // Save cart to localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Event listener for "Add to Cart" buttons
document.addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('add-to-cart')) {
        const productId = parseInt(e.target.dataset.id);
        const name = e.target.dataset.name;
        const price = parseFloat(e.target.dataset.price);
        const image = e.target.dataset.image;
        addToCart(productId, name, price, image);
    }
});

// Initial cart update
updateCart();