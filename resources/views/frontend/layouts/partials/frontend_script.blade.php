<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('frontend/lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('frontend/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/lib/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/lib/isotope/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/lib/lightbox/js/lightbox.min.js') }}"></script>
<!-- Template Javascript -->
<script src="{{ asset('frontend/js/main.js') }}"></script>


<script>
    $(document).ready(function() {
        $(".submitNewsletter").submit(function(e) {
            e.preventDefault();
            var formData = {
                email: $(".newsletter_email").val(),
                _token: CSRF_TOKEN,
            };
            if (formData) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('frontend.newsletter') }}",
                    data: formData,
                    success: function(response) {
                        if (response.status == true) {
                            $(".newsletter_email").val('');
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(error) {
                        console.log(error.responseJSON.errors);
                    }
                });
            } else {
                alert('Email not write for newsletter');
            }
        });
    });
</script>
