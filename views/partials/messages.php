
<?php if(session()->has('error')): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Error!</strong>   <?= session()->get('error') ?><br>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php session()->clear('error') ?>
<?php endif ?>

<?php if(session()->has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong>   <?= session()->get('success') ?><br>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php session()->clear('success') ?>
<?php endif ?>