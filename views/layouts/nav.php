<header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
            <img src="/beejee_footer_new.png" height="50px" alt="">
        </a>

        <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 text-dark text-decoration-none" href="/tasks">Tasks</a>
        <a 
            href="/tasks/new"
            type="button" 
            class="btn btn-primary mx-2"
        >Create task</a>
        <?php if(!session()->has('auth_user')): ?>
            <a 
                href="/auth"
                type="button"
                class="btn btn-outline-primary me-2"
            >Login</a>
        <?php else: ?>
            <a 
                href="/auth/logout"
                type="button"
                class="btn btn-outline-danger me-2"
            >Logout</a>
        <?php endif ?>
        </nav>
    </div>
</header>