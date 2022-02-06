<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TaskController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $tasks = Task::where( 'user_id', Auth::user()->id )->with( 'client' )->orderBy( 'id', 'DESC' )->paginate( 10 );

        return view( 'task.index' )->with( [
            'tasks' => $tasks,
        ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view( 'task.create' )->with( [
            'clients' => Client::all(),
        ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {

        $this->taskValidation( $request );

        Task::create( [
            'name'        => $request->name,
            'slug'        => Str::slug( $request->name ),
            'price'       => $request->price,
            'description' => $request->description,
            'client_id'   => $request->client_id,
            'user_id'     => Auth::user()->id,
        ] );

        return redirect()->route( 'task.index' )->with( 'success', 'Task Added Successfull!' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show( $slug ) {

        $task = Task::where( 'slug', $slug )->get()->first();

        return view( 'task.show' )->with( 'task', $task );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit( Task $task ) {

        return view( 'task.edit' )->with( [
            'task'    => $task,
            'clients' => Client::all(),
        ] );
    }

    public function taskValidation( Request $request ) {

        return $request->validate( [
            'name'        => ['required', 'max:255', 'string'],
            'price'       => ['required', 'integer'],
            'client_id'   => ['required', 'max:255', 'not_in:none'],
            'description' => ['required'],
        ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Task $task ) {

        $this->taskValidation( $request );

        $task->update( [
            'name'        => $request->name,
            'slug'        => Str::slug( $request->name ),
            'price'       => $request->price,
            'description' => $request->description,
            'client_id'   => $request->client_id,
            'user_id'     => Auth::user()->id,
        ] );

        return redirect()->route( 'task.index' )->with( 'success', 'Task Update Successfull!' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy( Task $task ) {

        $task->delete();

        return redirect()->route( 'task.index' )->with( 'success', 'Task Delete Successfull!' );
    }

    public function markAsComplete( Task $task ) {

        $task->update( [
            'status' => 'complete',
        ] );

        return redirect()->back()->with( 'success', 'Mark as Completed' );
    }
}
