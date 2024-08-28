<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request) {
        if($request->date) {
            $filtered_date = $request->date;
        } else {
            $filtered_date = date('Y-m-d');
        }

        $carbon_date = Carbon::createFromDate($filtered_date);
        
        $data['date_as_string'] = $carbon_date->translatedFormat('d \d\e M');

        $data['date_prev_button'] = $carbon_date->addDay(-1)->format('Y-m-d');
        $data['date_next_button'] = $carbon_date->addDay(2)->format('Y-m-d');
        

        $data['auth_user'] = Auth::user();
        $data['tasks'] = Task::whereDate('due_date', $filtered_date)
                                ->where('user_id', $data['auth_user']->id)
                                ->get();

        $data['task_count'] = $data['tasks']->count();
        $data['undone_tasks_count'] = $data['tasks']->where('is_done', false)->count();
        
        $data['task_count'] = $data['tasks']->count();
        $data['done_tasks_count'] = $data['tasks']->where('is_done', true)->count();
        

        return view('home', $data);
    }
}
