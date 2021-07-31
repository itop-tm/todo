<?php require 'views/layouts/top.php' ?>

<div class="d-flex justify-content-center ">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
    <?php require 'views/partials/messages.php' ?>
        <h1>Update task # <?= $task->id?> </h1>
        <form method="post" action="/tasks/edit?id=<?= $task->id ?>" class="pt-4">
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
                    value="<?= $task->get('name') ?>"
                    required
                    disabled
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
                    value="<?= $task->get('email') ?>"
                    required
                    disabled
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
                    required
                    rows="3"
                ><?= $task->get('description') ?></textarea>
            </div>

            <div class="mb-3">
                <div class="form-check">
                <input 
                    class="form-check-input" 
                    type="checkbox" 
                    name="is_completed"
                    id="status"
                    value="1"
                    <?= $task->is_completed ? 'checked' : null ?>
                >
                    <label class="form-check-label" for="status">
                        Completed
                    </label>
                </div>
            </div>

            <div class="d-grid gap-2 mb-3">
                <button type="submit" class="btn btn-success btn-block">
                    Update
                </button>
            </div>

        </form>
    </div>
</div>

<?php require 'views/layouts/bottom.php' ?>