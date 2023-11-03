<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FreelancehuntService;

class ProjectsController extends Controller
{

    public function index(Request $request, FreelancehuntService $service){
        $index = $service->index($request->all())->json();
        foreach(['self', 'last', 'next', 'prev'] as $link){
            if(empty($index['links'][$link])){
                continue;
            }
            $index['links'][$link] = str_replace(
                [config('freelancehunt.api.host').'/projects', '[number]'],
                ['/projects', ''],
                $index['links'][$link]
            );
        }
        return $index;
    }

    public function info(Request $request, FreelancehuntService $service, $id){
        return $service->info((int) $id);
    }
}
