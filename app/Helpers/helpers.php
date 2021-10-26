<?php

if(!function_exists('upload_image'))
{
    /**
     * @param $file
     * @return string
     */
    function upload_user_image($file) : string
    {
        $userFolder = 'uploads/users/';

        $image = Image::make($file);

        //the user's image size in config
        $sizes = config('filesystems.image_sizes.users');

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
}
