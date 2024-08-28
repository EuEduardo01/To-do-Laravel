<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $r) {
        return view('tasks.view');
    }
    
    //Tela de Criação da tarefa
    public function create(Request $r) {
        $categories = Category::all()->where('user_id', Auth::user()->id);
        $data['categories'] = $categories;

        return view('tasks.create', $data);
    }
    
    //Inserção no banco de dados
    public function create_action(Request $request) {
    
        $request->validate([
            'title' => 'required',
            'description' => 'max:255|nullable', 
            'due_date' => 'required',
            'category_id' => 'required'
        ]);
    
        $task = $request->only(['title', 'description', 'due_date', 'category_id']);
        
        $task['user_id'] = Auth::user()->id;
        $dbtask = Task::create($task);

        toastr()->success('Task salva com sucesso!');

        return redirect(route('home'));
    }

    //Ação de criação de categorias
    public function create_categories(Request $request) {
        
        $request->validate([
            'title' => 'required',
            'color' => 'required|regex:/^[#][0-9A-F]{3,6}$/i'
        ]);

        $categorie = $request->only(['title', 'color']);
        $categorie['user_id'] = Auth::user()->id;

        Category::create($categorie);

        toastr()->success('Categoria salva com sucesso!');

        return back();
    }

    //Ação de edição de categorias
    public function update_categories(Request $request) {
        $request_data = $request->only(['title', 'color']);
        $category =  Category::find($request->category_modal_id);
        $category->update($request_data);

        toastr()->success('Categoria atualizada com sucesso!');

        return back();
    }
    public function delet_categories(Request $request) {
        $category = Category::findOrFail($request->id);

        if($category) {
            $category->delete();
        }

        return back();
    }

    public function update(Request $request) {
        $task = Task::findOrFail($request->taskId);
        $task->is_done = $request->status;
        $task->save();

        toastr()->success('Task atualizada com sucesso!');

        return['success' => true];
    }

    //Tela de edit
    public function edit(Request $request) {
        $id = $request->id;
        $task = Task::find($id);

        if(!$task) {
            return redirect(route('home'));
        }
        
        $categories = Category::all()->where('user_id', Auth::user()->id);
        $data['categories'] = $categories;

        $data['task'] = $task;
        return view('tasks.edit', $data);
    }

    public function edit_action(Request $request) {

        $request_data = $request->only(['title', 'due_date', 'category_id', 'description', 'is_done']);
        $task = Task::find($request->id);

        $request_data['is_done'] = $request->is_done ? true : false;

        if(!$task) {
            return toastr()->error('Task não existente');;
        }
        $task->update($request_data);
        $task->save();

        toastr()->success('Task atualizada com sucesso!');;

        return redirect(route('home'));
    }

    // Deleta os dados no banco de dados
    public function delete(Request $request) {
        $task = Task::find($request->id);

        if($task) {
            $task->delete();
        }

        return back();
    }

}
