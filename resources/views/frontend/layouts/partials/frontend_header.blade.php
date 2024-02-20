<a href="" class="navbar-brand p-0">
    <h1 class="m-0">MRTpos</h1>
    <!-- <img src="img/logo.png" alt="Logo"> -->
</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
    <span class="fa fa-bars"></span>
</button>
<div class="collapse navbar-collapse" id="navbarCollapse">
    <div class="navbar-nav mx-auto py-0">
        <a href="index.html" class="nav-item nav-link active">Home</a>
        <a href="about.html" class="nav-item nav-link">About</a>
        <a href="service.html" class="nav-item nav-link">Service</a>
        <a href="project.html" class="nav-item nav-link">Project</a>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
            <div class="dropdown-menu m-0">
                <a href="team.html" class="dropdown-item">Our Team</a>
                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                <a href="404.html" class="dropdown-item">404 Page</a>
            </div>
        </div>
        <a href="contact.html" class="nav-item nav-link">Contact</a>
    </div>
    @guest
        @if (Route::has('login'))
            <a href="{{ route('login') }}" class="btn rounded-pill py-2 px-4 ms-3 d-none d-lg-block">Login</a>
        @endif
    @else
        <a href="{{ route('backend.home') }}" class="btn rounded-pill py-2 px-4 ms-3 d-none d-lg-block">Dashoard</a>
    @endguest
</div>
