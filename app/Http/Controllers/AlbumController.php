<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::get();

        return view('admin.albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.albums.create');
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

        foreach ($request->input('picture', []) as $file) {
            $album->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('pictures');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $album->id]);
        }
        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        return view('admin.albums.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        return view('admin.albums.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {

        $album->update($request->all());

        if (count($album->pictures) > 0) {
            foreach ($album->pictures as $media) {
                if (!in_array($media->file_name, $request->input('pictures', []))) {
                    $media->delete();
                }
            }
        }
        $media = $album->pictures->pluck('file_name')->toArray();
        foreach ($request->input('pictures', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $album->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('pictures');
            }
        }
        return redirect()->route('albums.index');
    }

    public function destroy(Album $album)
    {
        $album->delete();
        return redirect()->route('albums.index');
    }

    public function transferPicsBlade($id)
    {

        $albums = Album::where('id', '!=', $id)->pluck('name', 'id')->prepend('Please Select', '');
        return view('admin.albums.transfer_to_another_album', compact('albums', 'id'));
    }
    public function transferPic(Request $request, $id)
    {
        $old_album = Album::find($id);
        foreach ($old_album->pictures as $picture) {
            Media::where('id', $picture->id)->update(['model_id' => $request['model_id']]);
        }
        $old_album->delete();

        return redirect()->route('albums.index');
    }
    public function storeCKEditorImages(Request $request)
    {

        $model         = new Album();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}
