<?php require 'views/layouts/top.php' ?>

<div class="col-12">

    <div class="d-flex justify-content-end">
        <div>
            <p class="text-end">Sort By</p>
            <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                <a 
                    href="<?= setQueryString(['sort_by' => 'name']) ?>"
                    type="button" 
                    class="btn btn-outline-primary <?= request()->get('sort_by') == 'name' ? 'active' : null ?>"
                >Name</a>
                <a 
                    href="<?= setQueryString(['sort_by' => 'email']) ?>"
                    type="button" 
                    class="btn btn-outline-primary <?= request()->get('sort_by') == 'email' ? 'active' : null ?>"
                >Email</a>
                <a 
                    href="<?= setQueryString(['sort_by' => 'is_completed']) ?>"
                    type="button" 
                    class="btn btn-outline-primary <?= request()->get('sort_by') == 'is_completed' ? 'active' : null ?>"
                >Status</a>
            </div>
        </div>
    </div>
</div>

<?php foreach ($tasks as $task) : ?>
    <div class="card my-4">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                   <?= $task->name ?> | <?= $task->email ?> 
                </div>
                <div>
                    <?php if($task->is_completed): ?>
                        <span class="badge bg-success">Completed</span>
                    <?php else: ?>
                        <span class="badge bg-secondary"> On proccess</span>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?= $task->description; ?>
        </div>
        <?php if(session()->has('auth_user')): ?>
            <div class="text-end card-footer">
                <a href="tasks/edit?id=<?= $task->id ?>" class="">Edit</a>
            </div>
        <?php endif ?>
    </div>
<?php endforeach; ?>

<div class="d-flex justify-content-center">
    <?php require 'views/partials/pagination.php' ?>
</div>

<?php require 'views/layouts/bottom.php' ?>