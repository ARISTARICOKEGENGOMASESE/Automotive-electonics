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
    window.location.href = 'cart.html';
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
        item.quantity = Math.max(1, parseInt(newQuantity));
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
    const cartIcons = document.querySelectorAll('.cart-icon');
    
    if (cartItemsContainer) {
        cartItemsContainer.innerHTML = cart.map(item => `
            <tr>
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
            </tr>
        `).join('');
    }
    
    if (totalElement) {
        const subtotal = calculateTotal();
        const tax = subtotal * 0.1;
        const total = subtotal + tax;
        
        totalElement.innerHTML = `
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>Ksh ${subtotal.toFixed(2)}</td>
                </tr>
                <tr>
                    <td>Tax (10%)</td>
                    <td>Ksh ${tax.toFixed(2)}</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>Ksh ${total.toFixed(2)}</strong></td>
                </tr>
            </table>
        `;
    }
    
    cartIcons.forEach(icon => {
        icon.textContent = cart.reduce((sum, item) => sum + item.quantity, 0);
    });

    localStorage.setItem('cart', JSON.stringify(cart));
}

// Function to handle "Add to Cart" button clicks
function handleAddToCart(event) {
    if (event.target.classList.contains('add-to-cart')) {
        const { id, name, price, image } = event.target.dataset;
        addToCart(parseInt(id), name, parseFloat(price), image);
    }
}

// Event delegation for "Add to Cart" buttons
document.addEventListener('click', handleAddToCart);

// Initialize cart on page load
document.addEventListener('DOMContentLoaded', updateCart);