document.addEventListener("DOMContentLoaded", function() {
    
    
    const navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.style.padding = "5px 0";
            navbar.style.transition = "0.3s";
        } else {
            navbar.style.padding = "10px 0";
        }
    });

    
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('mouseenter', function() {
            this.classList.add('show');
            this.querySelector('.dropdown-menu').classList.add('show');
        });
        dropdown.addEventListener('mouseleave', function() {
            this.classList.remove('show');
            this.querySelector('.dropdown-menu').classList.remove('show');
        });
    });

    
    const cartButtons = document.querySelectorAll('.btn-add-cart');
    cartButtons.forEach(button => {
        button.addEventListener('click', function() {
            
            console.log("Product added to cart!");
        });
    });

});