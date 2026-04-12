  // Pure JavaScript - No jQuery needed
    (function() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
        
        function init() {
            const searchInput = document.getElementById('searchInput');
            const dropdown = document.getElementById('searchSuggestions');
            
            if (!searchInput || !dropdown) {
                console.error('Elements not found');
                return;
            }
            
            // Hide dropdown initially
            dropdown.style.display = 'none';
            dropdown.classList.remove('show');
            
            function toggleDropdown() {
                const searchValue = searchInput.value.trim();
                
                if (searchValue === '') {
                    dropdown.style.display = 'none';
                    dropdown.classList.remove('show');
                } else if (dropdown.children.length > 0) {
                    dropdown.style.display = 'block';
                    dropdown.classList.add('show');
                }
            }
            
            // Listen for input events
            searchInput.addEventListener('input', toggleDropdown);
            
            // Listen for focus events
            searchInput.addEventListener('focus', function() {
                if (this.value.trim() !== '' && dropdown.children.length > 0) {
                    dropdown.style.display = 'block';
                    dropdown.classList.add('show');
                }
            });
            
            // Hide dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!searchInput.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.style.display = 'none';
                    dropdown.classList.remove('show');
                }
            });
            
            // Optional: Clear dropdown when input is empty
            searchInput.addEventListener('keyup', function() {
                if (this.value.trim() === '') {
                    dropdown.innerHTML = '';
                    dropdown.style.display = 'none';
                    dropdown.classList.remove('show');
                }
            });
            
            // Escape key handler
            searchInput.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    this.value = '';
                    dropdown.innerHTML = '';
                    dropdown.style.display = 'none';
                    dropdown.classList.remove('show');
                }
            });
        }
    })();
    
    // Handle search response from WinterCMS
    function handleSearchResponse(data) {
        const dropdown = document.getElementById('searchSuggestions');
        const searchInput = document.getElementById('searchInput');
        
        if (!dropdown || !searchInput) return;
        
        if (data && data['#searchSuggestions']) {
            const searchValue = searchInput.value.trim();
            
            // Show dropdown only if there's search text
            if (searchValue !== '') {
                dropdown.style.display = 'block';
                dropdown.classList.add('show');
            } else {
                dropdown.style.display = 'none';
                dropdown.classList.remove('show');
            }
        }
    }