<?php

namespace App\Controllers;
use App\App\App;
use App\App\Request;
use App\Models\Task;
use JasonGrimes\Paginator;

class TaskController
{
    public static function index()
    {
        $request = new Request;

        $sortBy = Request::get('sort_by') ?? 'created_at';

        $totalItems = Task::count();
        $itemsPerPage = 3;
        $currentPage = Request::get('page') ?? 1;
        
        $urlPattern = "?sort_by={$sortBy}&page=(:num)";
     
        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

        $tasks = Task::paginate($itemsPerPage, ($currentPage-1) * $itemsPerPage, $sortBy);

        $title = 'Tasks';

        return view('tasks.index', compact('tasks', 'title', 'paginator', 'request'));
    }

    public static function showCreateForm()
    {
        $title = 'Create Tasks';

        return view('tasks.create', compact('title'));
    }

    public static function store()
    {  
        try {

            Task::create([
                'name'        => $_POST['name'],
                'email'       => $_POST['email'],
                'description' => $_POST['description']
            ]);

            return redirect('tasks');

        } catch (Exception $e) {
            require "views/500.php";
        }
    }

    public static function showUpdateForm()
    {
        $title = 'Update Tasks';

        $task = Task::fetchFirst(['id' => request()->get('id')]);

        return view('tasks.update', compact('title', 'task'));
    }

    public static function update()
    {  
        try {

            Task::update(request()->get('id'), [
                'is_completed' => (int)request()->get('is_completed'),
                'description'  => request()->get('description')
            ]);

            return redirect('tasks');

        } catch (Exception $e) {
            require "views/500.php";
        }
    }


    public static function completeTask()
    {  
        try {

            Task::markAsCompleted(request()->get('id'));

            return redirect('tasks');

        }catch (Exception $e) {
            require "views/500.php";
        }

    }
}