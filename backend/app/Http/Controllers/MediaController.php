<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Media;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'http://api.themoviedb.org/3/movie/popular?language=fr-FR&page=1', [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxNTc4ZTQ0ZGQzZTJkNTQ2OWEzMzY0ZTYzMDUwNzJhNSIsInN1YiI6IjY1NGJhNThiNDFhNTYxMzM2ODg1ZWU0NiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.56ySPH5oZXFU3X1fbVinWQ4KajECgrRcrKjPq1nwIzA',
                'accept' => 'application/json',
            ],
        ]);

        $body = $response->getBody()->getContents();

        $medias = json_decode($body)->results;
        // var_dump(json_decode($body)->results);

        foreach($medias as $media){
            $this->getWatchProvidersFromMedia($media->id);
        }
        // $this->getProvider();
        // $this->getGenre(); 
        
        // $dataQuery = [
        //     "original_title" => $medias->original_title,
        //     "title" => $medias->title,
        //     "overview" => $medias->overview,
        //     "release_date" => $medias->release_date,
        //     "provider_vote_average" => $medias->vote_average,
        //     "provider_vote_count" => $medias->vote_count,
        //     "poster_path" => $medias->backdrop_path
        // ];

        // Media::create($dataQuery);
    }

    public function getWatchProvidersFromMedia(int $id)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://api.themoviedb.org/3/movie/'.strval($id).'/watch/providers', [
            'headers' => [
              'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxNTc4ZTQ0ZGQzZTJkNTQ2OWEzMzY0ZTYzMDUwNzJhNSIsInN1YiI6IjY1NGJhNThiNDFhNTYxMzM2ODg1ZWU0NiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.56ySPH5oZXFU3X1fbVinWQ4KajECgrRcrKjPq1nwIzA',
              'accept' => 'application/json',
            ],
        ]);

        dump(json_decode($response->getBody()->getContents())->results);

    }
    public function getGenre()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://api.themoviedb.org/3/genre/movie/list?language=fr', [
            'headers' => [
              'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxNTc4ZTQ0ZGQzZTJkNTQ2OWEzMzY0ZTYzMDUwNzJhNSIsInN1YiI6IjY1NGJhNThiNDFhNTYxMzM2ODg1ZWU0NiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.56ySPH5oZXFU3X1fbVinWQ4KajECgrRcrKjPq1nwIzA',
              'accept' => 'application/json',
            ],
        ]);

        $genres = json_decode($response->getBody()->getContents())->genres;
        foreach ($genres as $genre) {
            Genre::create([
                'provider_id' => $genre->id,
                'content' => $genre->name
            ]);
        }
    }

    public function getProvider()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://api.themoviedb.org/3/watch/providers/movie?language=fr-FR&watch_region=FR', [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxNTc4ZTQ0ZGQzZTJkNTQ2OWEzMzY0ZTYzMDUwNzJhNSIsInN1YiI6IjY1NGJhNThiNDFhNTYxMzM2ODg1ZWU0NiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.56ySPH5oZXFU3X1fbVinWQ4KajECgrRcrKjPq1nwIzA',
                'accept' => 'application/json',
            ],
        ]);

        $providers = json_decode($response->getBody()->getContents())->results;
        foreach ($providers as $provider) {
            // var_dump($provider->provider_name);
            // var_dump($provider->provider_id);
            // var_dump($provider->logo_path);
            Provider::create([
                'provider_id' => $provider->provider_id,
                'provider_name' => $provider->provider_name,
                'logo_path' => $provider->logo_path
            ]);
        }
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
