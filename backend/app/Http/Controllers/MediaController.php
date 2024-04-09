<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', 3600); //30 minutes
use App\Models\Genre;
use App\Models\Media;
use App\Models\Provider;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    public function getMediaByGenreAndProvider(Request $request)
    {
        $medias_id_genre = [];
        foreach ($request->genres as $genre) {
            $genresFounded = Genre::findOrFail($genre)->media->pluck('id');
            foreach ($genresFounded as $media) {
                if(in_array($media, $medias_id_genre)) {
                    continue;
                }
                array_push($medias_id_genre, $media);
            }
        }

        $medias_id_provider = [];
        foreach ($request->providers as $provider) {
            $providersFounded = Provider::findOrFail($provider)->media->pluck('id');
            foreach ($providersFounded as $media) {
                if(in_array($media, $medias_id_provider)) {
                    continue;
                }
                array_push($medias_id_provider, $media);
            }
        }

        $medias_id = array_intersect($medias_id_genre, $medias_id_provider);

        $medias = Media::find($medias_id);
        $medias = $medias->take(20);
        return response()->json($medias);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $media = Media::create($request->all());
        return response()->json($media, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $media = Media::findOrFail($id);
        $media->delete();

        return response()->json();
    }
}
