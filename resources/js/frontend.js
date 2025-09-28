function formatDateTime(dateTimeString) {
    const options = {
        year: 'numeric',
        month: 'short',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit'
    }
    const formatedDateTime = new Intl.DateTimeFormat('en-Us', options).format(new Date(dateTimeString));
    return formatedDateTime;
}

function scrollTobottom() {
    mainChatInbox.scrollTop(mainChatInbox.prop("scrollHeight"));
}

window.Echo.private('message.'+ USER.id).listen(
    "MessageEvent",
    (e) => {
        console.log(e);
        let mainChatBox = $('.wsus__chat_area_body');
        if(mainChatBox.attr('data-inbox') == e.sender_id) {
            var message = `<div class="wsus__chat_single">
                <div class="wsus__chat_single_img">
                    <img src="${e.sender_image}"
                        alt="user" class="img-fluid">
                </div>
                <div class="wsus__chat_single_text">
                    <p>${e.message}</p>
                    <span>${formatDateTime(e.date_time)}</span>
                </div>
            </div>`
        }

        mainChatBox.append(message);
        scrollTobottom()


        // add notification circle in profile
        $('.chat-user-profile').each(function() {
            let profileUserId = $(this).data('id');
            if(profileUserId == e.sender_id) {
                $(this).find('.wsus_chat_list_img').addClass('msg-notification');
            }
        })
    }
)

// Compare Products Functionality
class ProductCompare {
    constructor() {
        this.compareItems = JSON.parse(localStorage.getItem('compareItems')) || [];
        this.maxItems = 4; // Maximum number of products to compare
        this.init();
    }

    init() {
        this.updateCompareCount();
        this.bindEvents();
    }

    bindEvents() {
        // Compare button click in product cards
        document.addEventListener('click', (e) => {
            if (e.target.matches('.add-to-compare') || e.target.closest('.add-to-compare')) {
                e.preventDefault();
                const button = e.target.matches('.add-to-compare') ? e.target : e.target.closest('.add-to-compare');
                const productId = button.dataset.productId;
                const productName = button.dataset.productName;
                const productImage = button.dataset.productImage;
                const productPrice = button.dataset.productPrice;
                
                this.toggleCompare({
                    id: productId,
                    name: productName,
                    image: productImage,
                    price: productPrice
                });
            }
        });

        // Compare icon in header
        const compareIcon = document.getElementById('compare-icon');
        if (compareIcon) {
            compareIcon.addEventListener('click', (e) => {
                e.preventDefault();
                this.showCompareModal();
            });
        }

        // Compare link in top bar
        const compareLink = document.getElementById('compare-products-link');
        if (compareLink) {
            compareLink.addEventListener('click', (e) => {
                e.preventDefault();
                this.showCompareModal();
            });
        }
    }

    toggleCompare(product) {
        const index = this.compareItems.findIndex(item => item.id === product.id);
        
        if (index === -1) {
            // Add to compare
            if (this.compareItems.length >= this.maxItems) {
                alert(`You can only compare up to ${this.maxItems} products at once.`);
                return;
            }
            
            this.compareItems.push(product);
            this.showToast(`${product.name} added to compare list`);
        } else {
            // Remove from compare
            this.compareItems.splice(index, 1);
            this.showToast(`${product.name} removed from compare list`);
        }
        
        localStorage.setItem('compareItems', JSON.stringify(this.compareItems));
        this.updateCompareCount();
    }

    updateCompareCount() {
        const compareCount = document.getElementById('compare-count');
        if (compareCount) {
            compareCount.textContent = this.compareItems.length;
        }
    }

    showCompareModal() {
        if (this.compareItems.length === 0) {
            alert('You have no products to compare.');
            return;
        }

        // Get the existing modal
        const modal = new bootstrap.Modal(document.getElementById('compareModal'));
        
        // Update the modal content
        const container = document.getElementById('compare-products-container');
        container.innerHTML = '';
        
        // Create comparison cards
        this.compareItems.forEach(item => {
            const productCol = document.createElement('div');
            productCol.className = 'col-md-3 mb-4';
            productCol.innerHTML = `
                <div class="card h-100 compare-product-card">
                    <div class="position-relative">
                        <button class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 remove-compare" 
                                data-product-id="${item.id}">×</button>
                        <img src="${item.image}" alt="${item.name}" class="card-img-top p-3" style="height: 200px; object-fit: contain;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">${item.name}</h5>
                        <p class="card-text">${item.price}</p>
                        <a href="/product/${item.id}" class="btn btn-primary btn-sm">View Details</a>
                        <button class="btn btn-sm btn-success add-to-cart" data-product-id="${item.id}">Add to Cart</button>
                    </div>
                </div>
            `;
            container.appendChild(productCol);
        });

        // Show the modal
        modal.show();

        // Handle remove button clicks
        document.querySelectorAll('.remove-compare').forEach(button => {
            button.addEventListener('click', (e) => {
                const productId = e.target.dataset.productId;
                const product = this.compareItems.find(item => item.id === productId);
                if (product) {
                    this.toggleCompare(product);
                    if (this.compareItems.length === 0) {
                        modal.hide();
                    } else {
                        this.showCompareModal(); // Refresh the modal
                    }
                }
            });
        });
    }

    showToast(message) {
        // Simple toast notification
        const toast = document.createElement('div');
        toast.className = 'toast-notification';
        toast.textContent = message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('show');
        }, 100);

        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                toast.remove();
            }, 500);
        }, 3000);
    }
}

// Recently Viewed Products Functionality
class RecentlyViewed {
    constructor() {
        this.viewedItems = JSON.parse(localStorage.getItem('recentlyViewed')) || [];
        this.maxItems = 10; // Maximum number of recently viewed products to store
        this.init();
    }

    init() {
        this.bindEvents();
        this.trackCurrentProduct();
    }

    bindEvents() {
        // Recently viewed link in top bar
        const recentlyViewedLink = document.getElementById('recently-viewed-link');
        if (recentlyViewedLink) {
            recentlyViewedLink.addEventListener('click', (e) => {
                e.preventDefault();
                this.showRecentlyViewedModal();
            });
        }
    }

    trackCurrentProduct() {
        // Check if we're on a product page
        const productContainer = document.querySelector('.wsus__pro_details_area');
        if (!productContainer) return;

        // Try to get product info from the page
        try {
            const productId = productContainer.dataset.productId;
            const productName = document.querySelector('.wsus__pro_details_text h4')?.textContent.trim();
            const productImage = document.querySelector('.exzoom_img_box img')?.src;
            const productPrice = document.querySelector('.wsus__pro_details_text h4 + p')?.textContent.trim();

            if (productId) {
                this.addToRecentlyViewed({
                    id: productId,
                    name: productName || 'Product',
                    image: productImage || '',
                    price: productPrice || '',
                    url: window.location.href
                });
            }
        } catch (error) {
            console.error('Error tracking product view:', error);
        }
    }

    addToRecentlyViewed(product) {
        // Remove if already exists
        const existingIndex = this.viewedItems.findIndex(item => item.id === product.id);
        if (existingIndex !== -1) {
            this.viewedItems.splice(existingIndex, 1);
        }

        // Add to the beginning of the array
        this.viewedItems.unshift(product);

        // Limit the number of items
        if (this.viewedItems.length > this.maxItems) {
            this.viewedItems = this.viewedItems.slice(0, this.maxItems);
        }

        // Save to localStorage
        localStorage.setItem('recentlyViewed', JSON.stringify(this.viewedItems));
    }

    showRecentlyViewedModal() {
        if (this.viewedItems.length === 0) {
            alert('You have no recently viewed products.');
            return;
        }

        // Get the existing modal
        const modal = new bootstrap.Modal(document.getElementById('recentlyViewedModal'));
        
        // Update the modal content
        const container = document.getElementById('recently-viewed-container');
        container.innerHTML = '';
        
        // Create product cards
        this.viewedItems.forEach(item => {
            const productCol = document.createElement('div');
            productCol.className = 'col-md-3 mb-4';
            productCol.innerHTML = `
                <div class="card h-100 recently-viewed-card">
                    <img src="${item.image}" class="card-img-top p-3" alt="${item.name}" style="height: 200px; object-fit: contain;">
                    <div class="card-body">
                        <h5 class="card-title">${item.name}</h5>
                        <p class="card-text">${item.price}</p>
                        <a href="${item.url}" class="btn btn-primary btn-sm">View Product</a>
                    </div>
                </div>
            `;
            container.appendChild(productCol);
        });

        // Show the modal
        modal.show();

        // Handle clear button click
        document.getElementById('clearRecentlyViewed').addEventListener('click', () => {
            this.viewedItems = [];
            localStorage.removeItem('recentlyViewed');
            modal.hide();
        });
    }
}

// Initialize features when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize product compare functionality
    new ProductCompare();
    
    // Initialize recently viewed functionality
    new RecentlyViewed();
});
