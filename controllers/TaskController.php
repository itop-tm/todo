<?php

namespace App\Controllers;
use App\App\App;
use App\Models\Task;
use JasonGrimes\Paginator;

class TaskController
{
    public static function index()
    {
        $sortBy = request()->sortBy();
   
        $currentPage = request()->get('page');

        $totalItems = Task::count();
        $itemsPerPage = 3;
        $currentPage =  $currentPage > 0 ? $currentPage : 1;
        $urlPattern = "?sort_by={$sortBy}&page=(:num)";
     
        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

        $tasks = Task::paginate($itemsPerPage, ($currentPage-1) * $itemsPerPage, $sortBy);

        $title = 'Tasks';

        return view('tasks.index', compact('tasks', 'paginator', 'title'));
    }

    public static function showCreateForm()
    {
        $title = 'Create Tasks';

        return view('tasks.create', compact('title'));
    }

    public static function store()
    {  
        $data = [
            'name'        => $_POST['name'],
            'email'       => $_POST['email'],
            'description' => $_POST['description']
        ];

       if(!self::validate($data)) {
            session()
                ->put('error', 'Please provide a valid data');

            return back();
       }

        try {

            Task::create($data);

            session()
                ->put('success', 'Task created');

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
        if(!session()->has('auth_user')) {
            session()
                ->put('error', 'Unauthorized action');

            return back();
        }

        if(!self::validate(['description' => request()->get('description')])) {
            session()
                ->put('error', 'Task description cannot be null');
                
            return back();
        }

        $task = Task::fetchFirst(['id' => request()->get('id')]);

        try {

            $task->update([
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

            return back();

        } catch (Exception $e) {
            require "views/500.php";
        }
    }

    public static function validate(array $data)
    {  
        return empty(
            array_filter($data, function ($v) { 
                return $v == null;
            })
        );
    }
}