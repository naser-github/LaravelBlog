<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function create()
    {
        return view ('tag.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|unique:tags',
            'description' => 'sometimes'
        ]);

        $tag = new Tag;

        $tag->name = $request->input('name');
        $tag->description = $request->input('description');
        
        $tag->save();

        return redirect('/tag/show') ->with('success','Tag has been added successfully');

    }

    public function index()
    {
        $tags = Tag::all();

        return view('tag.index', compact('tags'));
    }

    public function each_tag($id)
    {
        $tag = Tag::whereId($id)->first();
        
        return view ('tag.each_tag', compact('tag'));
    }

    public function edit($id)
    {
        $tag = Tag::whereId($id)->first();
        
        return view('tag.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::whereId($id)->first();
        request()->validate([
            'name' => 'required|unique:tags,id,{$id}',
            'description' => 'sometimes'
        ]);

        $tag = Tag::whereId($id)->first();
        $tag->name = $request->input('name');
        $tag->description = $request->input('description');
        $tag->save();

        return redirect('/tag/show') ->with('success','Tag has been updated successfully');
    }

    public function delete($id)
    {
        
    }

    
}
