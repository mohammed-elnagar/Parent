<?php
namespace App\Helpers;

trait UsersHelpers{

    public function ProviderQuery($fileName)
    {
        $data = getDataFromFile($fileName);
        return $data;
    }

    public function allProvidersFiles()
    {
        $path   = base_path('jsons'); // in the test case, I checked this directory should be in the application, phpunit.xml
        $files  = \File::files($path);
        $users  = [];

        foreach ($files as $key => $file){
            $fileName   = $file->getFilenameWithoutExtension();
            $data       = getDataFromFile($fileName);
            $users      = array_merge($users, $data);
        }

        $collection = collect($users);
        return $collection;
    }
}
