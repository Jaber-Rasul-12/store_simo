        // Add hover effect to category cards
        document.querySelectorAll('.cat-item').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-15px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
        
        // Simulate loading animation for demo
        document.addEventListener('DOMContentLoaded', function() {
            const categoryItems = document.querySelectorAll('.cat-item');
            
            // Staggered animation on load
            categoryItems.forEach((item, index) => {
                item.style.animationDelay = `${index * 0.1}s`;
            });
        });
