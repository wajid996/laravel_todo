<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('home');
    }//index

    public function store(Request $request)
    {
        $input = $request->all();

        $task_fields = [
            'task_title' => $input['task_name'],
            'created_at' => date('Y-m-d H:i:s')
        ];

        \DB::table('tasks')->insert($task_fields);

        return back()->with('status', 'Form Data Has Been inserted');
    }//store

    public function list()
    {
        $tasks = \DB::table('tasks')->get();

        return response()->json([
            'task_title' => $tasks
        ]);
    }//list

    public function edit($id)
    {
        $task = \DB::table('tasks')->where('id', $id)->first();

        return response()->json([
            'task_title' => $task
        ]);
    }//edit

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $task_fields = [
            'task_title' => $input['task_name'],
            'updated_at' => date('Y-m-d H:i:s')
        ];

        \DB::table('tasks')->where('id', $id)->update($task_fields);

        return back()->with('status', 'Form Data Has Been Updated');
    }//update

    public function delete($id)
    {
        \DB::table('tasks')->where('id', $id)->delete();

        return back()->with('status', 'Form Data Has Been Deleted');
    }//delete
}
