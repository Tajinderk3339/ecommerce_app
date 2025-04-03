</div>
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
            setTimeout(() => {
                $('#success-message').fadeOut(500);
            }, 3000);
        });

        const themeButtons = document.querySelectorAll('.theme-btn');
        themeButtons.forEach(button => {
            button.addEventListener('click', () => {
                const color = button.getAttribute('data-color');
                document.body.setAttribute('data-theme-color', color);
                localStorage.setItem('themeColor', color);
            });
        });

        const savedColor = localStorage.getItem('themeColor');
        if (savedColor) {
            document.body.setAttribute('data-theme-color', savedColor);
        }
    </script>
</body>
</html>