<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        // paginasi
        $maxdata = 5;
        // response
        if(request('search')){
            $data = Todo::where('task','like','%'.request('search').'%')->paginate($maxdata)->withQueryString();
        }else{
            $data = Todo::orderBy('task','asc')->paginate($maxdata);
        }
        return view('todo.app', compact('data'));

    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|min:5',
        ],[
            'task.required' => 'Input Harus di Isi !',
            'task.min' => 'Input Minimal 5 Karakter !',
        ]);

        $data = [
            'task' => $request->input('task')
        ];

        Todo::create($data);
        return redirect()->route('todo.post')->with('success','Task Berhasil Di Simpan !');

    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'task' => 'required|min:5',
        ],[
            'task.required' => 'Input Harus di Isi !',
            'task.min' => 'Input Minimal 5 Karakter !',
        ]);

        $data = [
            'task' => $request->input('task'),
            'is_done' => $request->input('is_done'),
        ];

        Todo::where('id',$id)->update($data);
        return redirect()->route('todo')->with('success','Task Berhasil Di Update !');
    }

    public function destroy(string $id)
    {
        Todo::where('id',$id)->delete();
        return redirect()->route('todo')->with('success','Task Berhasil Di Hapus !');
    }
}
