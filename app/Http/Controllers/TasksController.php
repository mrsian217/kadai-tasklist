<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\Task;

class TasksController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
           
             $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'user' => $user,
                'tasks' => $tasks,
        ];
        // dashboardビューでそれらを表示
        return view('tasks.index',$data);
        }
        else {
        return view('dashboard');
  
        }       
    }
      
    public function create()
    {
        $task = new Task;
    
        // メッセージ作成ビューを表示
        return view('tasks.create', [
            'task' => $task,
        ]);
    }
     public function store(Request $request)
    {
        $request->validate([
        "content"=>"required|max:255",
        "status"=>"required|max:10",
        ]);
        
        $userId = Auth::id();
        
        $task = new Task;
        $task->content = $request->content;
        $task->status=$request->status;
        $task->user_id = $userId;
        $task->save();
        
        return redirect('/');

    }
    
    public function show($id)
    {
        $task= Task::findOrFail($id);
        
           if (\Auth::id() === $task->user_id) {
            return view('tasks.show', [
            'task' => $task,
            ]);
      }
      else {
        // 所有者でない場合、リダイレクトなどの処理を追加するか、エラーを表示するなどの対応を行う
        return redirect('/')->with('error', 'You do not have permission to view this task.');
  
    }   
    }
     public function destroy($id)
{
     $task = Task::findOrFail($id);

    // ログインユーザーがタスクの所有者であるかどうかを確認
    if (\Auth::id() === $task->user_id) {
        // タスクを削除
        $task->delete();

        // トップページへリダイレクトさせる
        return redirect()->route('tasks.index')->with('success', 'Delete Successful');
    } else {
        // 所有者でない場合、リダイレクトなどの処理を追加するか、エラーを表示するなどの対応を行う
        return redirect('/')->with('error', 'You do not have permission to delete this task.');
    }
}
    
    public function edit($id)
    {
        $task = \App\Models\Task::findOrFail($id);

    if (\Auth::id() === $task->user_id) {
        // タスクの編集画面を表示
        return view('tasks.edit', ['task' => $task]);
    } else {
        // タスクの所有者でない場合はリダイレクトまたはエラーメッセージを表示
        return redirect('/')->with('error', 'You do not have permission to edit this task.');
    }
    
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            "content"=>"required|max:255",
            "status"=>"required|max:10",
        ]);
         $userId = Auth::id();
        
         $task = \App\Models\Task::findOrFail($id);
        
        if (\Auth::id() === $task->user_id) {
        
         $task->content = $request->content;
         $task->status=$request->status;
         $task->user_id = $userId; 
         $task->save();

        return redirect()->route('tasks.index')->with('success', 'Delete Successful');
        } else {
        // タスクの所有者でない場合はリダイレクトまたはエラーメッセージを表示
        return redirect('/')->with('error', 'You do not have permission to update this task.');
        }
    }
}