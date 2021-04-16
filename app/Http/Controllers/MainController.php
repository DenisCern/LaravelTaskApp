<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\TaskModel;

class MainController extends Controller
{
    public function home()
    {
        $tasks = new TaskModel();

        /*
              $itemsArray = TaskModel::sortable()
        ->join('user_models', 'user_models.id', '=', 'task_models.userId')
        ->select('user_models.name', 'user_models.email', 'task_models.task','task_models.status')
        ->paginate(3); 
        */

        $query= $tasks->join('user_models', 'user_models.id', '=', 'task_models.userId'); 

        $itemsArray = $query->sortable()->paginate(3,['user_models.name', 'user_models.email', 'task_models.task','task_models.status','task_models.id']);


        //dd($interactions);
                
        
        return view('home', compact('itemsArray'));
        
    }

    private function checkUser($email)
    {
        $user = UserModel::where('email', '=', $email)->first();
        
        return $user;
    }

    public function addTask(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:4|max:50',
            'email' => 'required|min:4|max:50',
            'task' => 'required|min:1|max:255',
        ]);
        
        $checkedUser = $this->checkUser($request->email); 
        
        if ($checkedUser != null) {
           $userId = $checkedUser->id;
        }else{      
            $addUser = new UserModel();
            $addUser->name = $request->input('name');
            $addUser->email = $request->input('email');
            $addUser->save();
            
            $checkedUser = $this->checkUser($request->email);
            $userId = $checkedUser->id;
        }

        $addTask = new TaskModel();
        $addTask->userId = $userId;
        $addTask->status = false;
        $addTask->task = $request->input('task');
        $addTask->save();       

        return redirect()->route('home');
    }

    public function changeTask(Request $request)
    {
        $task = TaskModel::where('id', '=', $request->id)->first();
        $task->task = $request->task;
        $task->status = true;
        $task->save();

        return redirect()->route('home');
    }
}


