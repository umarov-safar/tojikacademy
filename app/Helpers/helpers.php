<?php

use App\Models\Answer;
use App\Models\Question;

if(!function_exists('upload_image'))
{
    /**
     * @param $file
     * @return string
     */
    function upload_image($file, $configFolderSize) : string
    {
        $userFolder = 'uploads/users/';

        $image = Image::make($file);

        //the user's image size in config
        $sizes = config('filesystems.image_sizes.'.$configFolderSize);

        //doing image file nice
        $nameAndExtension = explode('.', $file->getClientOriginalName()); // to array converting
        $extension = array_pop($nameAndExtension); //getting the lest item (extension) and remove the last item
        $nameSlugged = Str::slug(implode('', $nameAndExtension)); //name to slug
        $readyImage = 'avatar_' . $nameSlugged . uniqid() . '.' . $extension; //the real name for using with extension

        $imageSizes = [];
        foreach ($sizes as $folder => $size) {

            $userImageSizePath = $userFolder . $folder; //folder from config
            !file_exists(public_path($userImageSizePath)) ? mkdir(public_path($userImageSizePath)) : 0; //folder not exists than creat

            $image->resize($size['w'], $size['h']); // size from config filesystem

            $userImage = $userImageSizePath . DIRECTORY_SEPARATOR . $readyImage; // doing real path

            $image->save(public_path($userImage));
            $imageSizes[$folder] = $userImage;
        }

        return json_encode($imageSizes);
    }

    //upload image 64 base
    if(!function_exists('upload_image64')){
        function upload_image64($content, string $uploadFolder)
        {
            $dom = new \DOMDocument();
            @$dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFiles = $dom->getElementsByTagName('img');

            foreach($imageFiles as $item => $image){
                $data = $image->getAttribute('src');
                $exploded = explode(';', $data);
                if(count($exploded) > 1){
                    list($type, $data) = $exploded;
                    list(, $data)      = explode(',', $data);

                    list(, $extension) = explode('/',$type);

                    $imageData = base64_decode($data);
                    $image_name= "/uploads/$uploadFolder/question". time().$item . '.' . $extension;
                    $path = public_path($image_name)  ;
                    file_put_contents($path, $imageData);
                    $image->removeAttribute('src');
                    $image->setAttribute('src', $image_name );
                }
            }
            $content = $dom->saveHTML($dom->documentElement);
            return utf8_decode($content);
        }
    }
}



if(!function_exists('getModelNamespaceName')){
    /**
     * Pass model name to get the namespace name for polymorphism
     * @param string $likeable_type;
     * @return string App\Models\$model_type
     */
    function getModelNamespaceName(string $model_type) : string
    {
        switch (strtolower($model_type)){
            case 'question':
                $model_type = Question::class;
                break;
            case 'answer':
                $model_type  = Answer::class;
                break;
        }
        return $model_type;
    }
}



