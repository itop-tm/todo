<?php require 'views/layouts/top.php' ?>

<div class="d-flex justify-content-center ">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
    <?php require 'views/partials/messages.php' ?>
        <h1>Add new task</h1>
        <form method="post" action="/tasks" class="pt-4">
            <div class="mb-3">
                <label 
                    for="name" 
                    class="form-label"
                >Your name</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="name" 
                    name="name" 
                    placeholder="Mohamed"
                    autocomplete="off"
                >
            </div>
            <div class="mb-3">
                <label 
                    for="email" 
                    class="form-label"
                >Email address</label>
                <input 
                    type="email" 
                    class="form-control" 
                    id="email" 
                    name="email" 
                    placeholder="name@example.com"
                    autocomplete="off"
                >
            </div>
            <div class="mb-3">
                <label 
                    for="description" 
                    class="form-label"
                >description</label>
                <textarea 
                    class="form-control" 
                    id="description" 
                    name="description" 
                    rows="3"
                ></textarea>
            </div>
            <div class="d-grid gap-2 mb-3">
                <button type="submit" class="btn btn-success btn-block">
                    Create
                </button>
            </div>

        </form>
    </div>
</div>

<?php require 'views/layouts/bottom.php' ?>