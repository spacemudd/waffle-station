<!-- resources/views/components/login-modal.blade.php -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="border-color: transparent;">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Logo Section -->
        <div class="text-center mb-4">
          <img src="{{ asset('assets/logowaffle.png') }}" alt="Logo" class="logo">
        </div>

        <form action="{{ url('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="form-label text-muted">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
                </div>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label text-muted">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
                </div>
            </div>
            <div class="mb-4 d-flex justify-content-between">
                <div>
                    <input type="checkbox" id="rememberMe" name="remember">
                    <label for="rememberMe" class="form-check-label text-muted">Remember me</label>
                </div>
                <a href="#" class="text-primary" style="text-decoration: none; color:#ffaf3d;">Forgot password?</a>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary w-100 py-2" style="background-color: #ffaf3d;">Login</button>
            </div>
            <div class="mt-3 text-center">
                <span>Don't have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#signupModal" class="sign-up-button">Sign up</a></span>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
