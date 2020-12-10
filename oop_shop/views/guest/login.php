<form class="form-signin" method="post">
    <img class="mb-4" src="/public/img/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

    <label for="user-login" class="sr-only">Login</label>
    <input type="text" name="login" class="form-control" placeholder="Enter your login" id="user-login" required>

    <label for="user-password" class="sr-only">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Enter your password" id="user-password" required>

    <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Sign In</button>
    <p class="text-dark">or</p>
    <a href="/guest/registration" class="btn btn-success">Sign Up</a>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-<?= date('Y') ?></p>
</form>