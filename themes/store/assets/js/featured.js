 // Toggle feature details
        function toggleDetails(button) {
            const card = button.closest('.feature-card');
            card.classList.toggle('active');
            
            const span = button.querySelector('span');
            if (card.classList.contains('active')) {
                span.textContent = 'إخفاء التفاصيل';
            } else {
                span.textContent = 'عرض التفاصيل';
            }
        }
        
        // For showing modal (alternative approach)
        function showModal(title, details) {
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalBody').textContent = details;
            document.getElementById('detailsModal').classList.add('active');
        }
        
        function closeModal() {
            document.getElementById('detailsModal').classList.remove('active');
        }
        
        // Close modal when clicking outside
        document.getElementById('detailsModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
        
        // Animate cards on load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.feature-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
            
            // Activate second card by default
            if (cards.length > 1) {
                cards[1].classList.add('active');
                const toggleBtn = cards[1].querySelector('.feature-toggle span');
                if (toggleBtn) {
                    toggleBtn.textContent = 'إخفاء التفاصيل';
                }
            }
        });
        
        // Simple hover effect
        const cards = document.querySelectorAll('.feature-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });
            
            card.addEventListener('mouseleave', function() {
                if (!this.classList.contains('active')) {
                    this.style.transform = 'translateY(0)';
                }
            });
        });