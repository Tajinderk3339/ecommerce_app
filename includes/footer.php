</div>
    <footer class="text-center py-3" style="background-color: #f8f9fa; color: #6c757d;">
        <p>© <?php echo date('Y'); ?> E-Shop. All rights reserved.</p>
    </footer>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.sidebar-toggle').click(function() {
                $('.sidebar').toggleClass('sidebar-open');
            });

            $('.item-card').each(function(index) {
                $(this).delay(100 * index).fadeIn(500);
            });

            // Restore login and signup card animations
            $('.login-card').animate({ opacity: 1, top: 0 }, 800);
            $('.signup-card').delay(400).animate({ opacity: 1, top: 0 }, 800);

            setTimeout(() => {
                $('#success-message').fadeOut(500);
            }, 3000);

            // Theme color definitions with dark mode included
            const themes = {
                'blue': { bodyBg: '#e7f1ff', navbarBg: '#0056b3' },
                'red': { bodyBg: '#ffe6e6', navbarBg: '#e65b50' },
                'green': { bodyBg: '#e6ffe6', navbarBg: '#218838' },
                'black': { bodyBg: '#1a1a1a', navbarBg: '#333333' },
                'dark': { bodyBg: '#343a40', navbarBg: '#212529' } // Dark mode theme added
            };

            // Function to apply theme
            function applyTheme(color) {
                const theme = themes[color];
                if (theme) {
                    document.body.style.backgroundColor = theme.bodyBg;
                    document.querySelector('.navbar').style.backgroundColor = theme.navbarBg;
                    document.body.setAttribute('data-theme-color', color);
                    localStorage.setItem('themeColor', color);
                }
            }

            // Theme button event listeners
            const themeButtons = document.querySelectorAll('.theme-btn');
            themeButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const color = button.getAttribute('data-color');
                    applyTheme(color);
                });
            });

            // Apply saved theme on page load
            const savedColor = localStorage.getItem('themeColor');
            if (savedColor) {
                applyTheme(savedColor);
            }
        });
    </script>
</body>
</html>