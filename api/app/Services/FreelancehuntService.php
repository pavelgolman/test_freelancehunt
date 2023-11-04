<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FreelancehuntService
{

    public function __construct(){
        if(!config('freelancehunt.api.key')){
            throw new \Exception('Empty freelancehunt api key.');
        }
    }

    public static function boot(){
        Http::macro('freelancehunt', function () {
            return Http::withToken(config('freelancehunt.api.key'))
                ->baseUrl(config('freelancehunt.api.host'));
        });
    }

    public function index(array $input = []){
        return Http::freelancehunt()->get('/projects', [
            'page[number]' => $input['page'] ?? 1,
        ]);
    }

    public function info(int $id){
        return Http::freelancehunt()->get('/projects/'.$id);
    }
}
