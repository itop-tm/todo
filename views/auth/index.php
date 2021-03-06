<?php require 'views/layouts/top.php' ?>
<?php require 'views/partials/messages.php' ?>

<div class="d-flex justify-content-center ">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
        <h1 class="text-center">Admin login</h1>
        <form method="post" action="/auth" class="pt-4">
            <div class="mb-3">
                <label 
                    for="login" 
                    class="form-label"
                >Login</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="login" 
                    name="login" 
                    required
                    autocomplete="off"
                >
            </div>
            <div class="mb-3">
                <label 
                    for="password" 
                    class="form-label"
                >Password</label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="password"
                    required
                    name="password" 
                >
            </div>

            <div class="d-grid gap-2 mb-3">
                <button type="submit" class="btn btn-success btn-block">
                    Login
                </button>
            </div>

        </form>
    </div>
</div>

<?php require 'views/layouts/bottom.php' ?>