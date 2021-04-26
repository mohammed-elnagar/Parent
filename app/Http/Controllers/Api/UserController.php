<?php

namespace App\Http\Controllers\Api;

use App\Filters\UserFilter;
use Illuminate\Http\Request;
use App\Helpers\UsersHelpers;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    use UsersHelpers, UserFilter;

    public function index(Request $request)
    {

        if($request->has('provider')){
            // Data from specific file
            $fileName = $request->provider;

            if(!fileExists($fileName))
                return apiResponse(null, null, __('The provider not found.'), 404);

            $data       = $this->ProviderQuery($fileName);
            $collection = collect($data);
        }else{
            // Data merged from all files
            $collection = $this->allProvidersFiles();
        }

        // Apply filters and setup more if need
        $collection = $this->apply($collection, $request);

        return apiResponse($collection, null, __('Data retrieved successfully'));
    }
}
