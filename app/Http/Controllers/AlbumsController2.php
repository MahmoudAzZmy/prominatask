<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Picture;
use App\Models\Pictures;
use Illuminate\Http\Request;

class AlbumsController2 extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::with('pics')->get();

        return view('admin.albums2.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.albums2.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $album = Album::create([
            'name'  => $request['name'],
            'user_id'   => Auth()->user()->id
        ]);

        foreach ($request['pic_name'] as $key => $pic_name) {

            $picture = Picture::create([
                'album_id'  => $album->id,
                'name' =>   $pic_name,
                'pic' =>   $request['pics'][$key]->getClientOriginalName() ?? null,
            ]);
            $picture->addMedia($request['pics'][$key])->toMediaCollection('pics_js');
        }


        return redirect()->route('albums2.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        $album->load('pics');
        return view('admin.albums2.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        $album->load('pics');
        return view('admin.albums2.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {

        $album->update($request->all());
        foreach ($album->pics as $key => $pic) {

            $pic->update([
                'album_id'  => $album->id,
                'name' =>   $request['pic_name'][$key],
                'pic' =>   isset($request['pics']) && array_key_exists($key, $request['pics'])  ? $request['pics'][$key]->getClientOriginalName() : $pic->pic,
            ]);
            if (isset($request['pics']) &&  array_key_exists($key, $request['pics'])) {
                $pic->pic()->delete();
                $pic->addMedia($request['pics'][$key])->toMediaCollection('pics_js');
            }
        }

        return redirect()->route('albums2.index');
    }

    public function destroy(Album $album)
    {
        $album->pics()->delete();
        $album->delete();
        return redirect()->route('albums1.index');
    }

    // public function transferPicsBlade($id)
    // {

    //     $albums = Album::where('id', '!=', $id)->pluck('name', 'id')->prepend('Please Select', '');
    //     return view('admin.albums2.transfer_to_another_album', compact('albums', 'id'));
    // }
    // public function transferPic(Request $request, $id)
    // {
    //     $old_album = Album::find($id);
    //     foreach ($old_album->pictures as $picture) {
    //         Media::where('id', $picture->id)->update(['model_id' => $request['model_id']]);
    //     }
    //     $old_album->delete();

    //     return redirect()->route('albums2.index');
    // }
}
