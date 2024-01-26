<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\Task;

class TasksController extends Controller
{
    public function index()
    {
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
            
            
        $tasks=Task::all();
        return view('tasks.index',[    
            'tasks' => $tasks,        
        ]);            

     }
        
        // dashboardビューでそれらを表示
        return view('dashboard');
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

        return view('tasks.show', [
            'task' => $task,
            ]);
    }

    
     public function destroy($id)
    {
        $task = Task::findOrFail($id);
        // メッセージを削除
        $task->delete();

        // トップページへリダイレクトさせる
        return redirect('/');

    }
    
    public function edit($id)
    {
         $task = \App\Models\Task::findOrFail($id);
    
          return view('tasks.edit', [
            'task' => $task,
            ]);
         
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "content"=>"required|max:255",
            "status"=>"required|max:10",
        ]);
         $userId = Auth::id();
        
         $task = Task::findOrFail($id);
         $task->content = $request->content;
         $task->status=$request->status;
         $task->user_id = $userId; 
         $task->save();

        return redirect('/');

    }
}