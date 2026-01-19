// Dark mode toggle functionality
(function() {
    'use strict';
    
    // Initialize dark mode based on saved preference
    function initDarkMode() {
        const darkMode = localStorage.getItem('darkMode');
        if (darkMode === 'enabled') {
            document.body.classList.add('dark-mode');
            updateToggleButton();
        }
    }
    
    // Toggle dark mode on/off
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
        
        if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('darkMode', 'enabled');
        } else {
            localStorage.setItem('darkMode', 'disabled');
        }
        
        updateToggleButton();
    }
    
    // Update the toggle button icon based on current mode
    function updateToggleButton() {
        const btn = document.getElementById('dark-mode-toggle');
        if (btn) {
            const isDarkMode = document.body.classList.contains('dark-mode');
            // In dark mode, show beach/sun (to indicate clicking will go to light mode)
            // In light mode, show moon/stars (to indicate clicking will go to dark mode)
            btn.setAttribute('data-mode', isDarkMode ? 'dark' : 'light');
        }
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            initDarkMode();
            
            const toggleBtn = document.getElementById('dark-mode-toggle');
            if (toggleBtn) {
                toggleBtn.addEventListener('click', toggleDarkMode);
            }
        });
    } else {
        initDarkMode();
        
        const toggleBtn = document.getElementById('dark-mode-toggle');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', toggleDarkMode);
        }
    }
})();
