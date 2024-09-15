<?php
include "../layout/link2.html";
?>


<script src="./js/dashboard.js"></script>
<script>
    $(document).ready(() => {
        $(".logout-form").submit((event) => {
            event.preventDefault();

            const form = $(event.currentTarget);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Logout",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        success: (response) => {
                            let result = JSON.parse(response)
                            Swal.fire(
                                'Logged Out!',
                                'You have been logged out.',
                                'success'
                            ).then(() => {
                                window.location.href = result.url;
                            });
                        },
                    })
                }
            });
        });
    });
</script>

</html>