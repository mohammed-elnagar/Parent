<?php


use App\Models\FleetDispatcherRequiredDocument;

if (!function_exists('apiResponse')) {
    function apiResponse($data = null, $error = null, $msg = null, $code = 200)
    {
        $array = [
            'data' => $data,
            'status' => in_array($code, successResponse()) ? true : false,
            'code' => $code,
            'error' => $error,
            'message' => $msg,
        ];
        return response()->json($array, $code); //$code
    }
}

if (!function_exists('successResponse')) {
    function successResponse()
    {
        return [
            200,   //OK. The standard success code and default option.
            201,   //Object created. Useful for the store actions.
            202,   //The request has been accepted for processing, but the processing has not been completed.
            204,   //No content. When an action was executed successfully, but there is no content to return.
            206,    //Partial content. Useful when you have to return a paginated list of resources.
        ];
    }
}
    /************** another http request codes **************/
    /**
    *  400: Bad request. The standard option for requests that fail to pass validation.
    *  401: Unauthorized. The user needs to be authenticated.
    *  403: Forbidden. The user is authenticated, but does not have the permissions to perform an action.
    *  404: Not found. This will be returned automatically by Laravel when the resource is not found.
    *  405: Method Not Allowed.
    *  419: Authentication Timeout.
    *  422: Unprocessable Entity. validation failed.
    *  500: Internal server error. Ideally you're not going to be explicitly returning this, but if something unexpected breaks, this is what your user is going to receive.
    *  503: Service unavailable. Pretty self explanatory, but also another code that is not going to be returned explicitly by the application.
    **/

if (!function_exists('fileExists')) {
    function fileExists($fileName)
    {
        return \File::exists(base_path('jsons/'.$fileName.'.json'));
    }
}

if (!function_exists('getDataFromFile')) {
    function getDataFromFile($fileName)
    {
        $path = base_path('jsons/'.$fileName.'.json');
        $data = json_decode(file_get_contents($path), true);
        return $data;
    }
}

