<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', 1800); //30 minutes
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
        // $this->getGenre();
        // $this->getProvider();
        die();
        for ($i = 351; $i <= 500; $i++) {
            $response = $client->request('GET', 'http://api.themoviedb.org/3/movie/popular?language=fr-FR&page=' . $i, [
                'headers' => [
                    'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxNTc4ZTQ0ZGQzZTJkNTQ2OWEzMzY0ZTYzMDUwNzJhNSIsInN1YiI6IjY1NGJhNThiNDFhNTYxMzM2ODg1ZWU0NiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.56ySPH5oZXFU3X1fbVinWQ4KajECgrRcrKjPq1nwIzA',
                    'accept' => 'application/json',
                ],
            ]);

            $body = $response->getBody()->getContents();

            $medias = json_decode($body)->results;
            // var_dump($medias);
            // die();

            foreach ($medias as $media) {
                $dataQuery = [
                    "original_title" => $media->original_title,
                    "title" => $media->title,
                    "overview" => $media->overview,
                    "release_date" => $media->release_date,
                    "provider_vote_average" => $media->vote_average,
                    "provider_vote_count" => $media->vote_count,
                    "poster_path" => $media->backdrop_path ?? ''
                ];
                Media::create($dataQuery);
                $wp = $this->getWatchProvidersFromMedia($media->id);
                $wpIds = [];
                if (isset($wp->FR)) {
                    foreach ($wp->FR as $wp_type) {
                        if (is_array($wp_type)) {
                            foreach ($wp_type as $provider) {
                                $db_id_provider = Provider::where('provider_id', $provider->provider_id)->first()->id;
                                if (!in_array($db_id_provider, $wpIds)) {
                                    $wpIds[] = $db_id_provider;
                                }
                            }
                        }
                    }
                }
                $media_id = Media::where('title', $media->title)->first()->id;
                $mediaModel = Media::findOrFail($media_id);
                $mediaModel->providers()->attach($wpIds);
                $id_db_genre = [];
                foreach ($media->genre_ids as $genre_id) {
                    $id_db_genre[] = Genre::where('provider_id', $genre_id)->first()->id;
                }
                $mediaModel->genres()->attach($id_db_genre);
                // dump($media->id);
                // dump($media_id);
                // dump($wpIds);
            }
            dump($i);
            dump($media_id);
        }
    }

    public function getWatchProvidersFromMedia(int $id)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://api.themoviedb.org/3/movie/' . strval($id) . '/watch/providers', [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxNTc4ZTQ0ZGQzZTJkNTQ2OWEzMzY0ZTYzMDUwNzJhNSIsInN1YiI6IjY1NGJhNThiNDFhNTYxMzM2ODg1ZWU0NiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.56ySPH5oZXFU3X1fbVinWQ4KajECgrRcrKjPq1nwIzA',
                'accept' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody()->getContents())->results;
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
