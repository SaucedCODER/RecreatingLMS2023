<footer>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Toggle the navbar collapse
            $('#login-button').click(function() {
                $('#loginModal').modal('show');
            });
            $('.navbar-toggler').click(function() {
                $('.navbar-collapse').toggleClass('show');
            });

            // Open the login modal
            $('#loginModalButton').click(function() {
                $('#loginModal').modal('show');
            });

            // Close the login modal and clear input fields on dismiss
            $('#loginModal').on('hidden.bs.modal', function() {
                $('#loginForm')[0].reset();
                $('#message').hide();
            });

            // Handle login form submission
            $('#loginForm').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: 'loginlogic.php',
                    type: 'post',
                    data: $('#loginForm').serialize(),
                    success: function(response) {
                        if (response == 'success') {
                            window.location.href = 'home.php';
                        } else {
                            $('#message').html(response).show();
                        }
                    }
                });
            });
        });
    </script>
</footer>