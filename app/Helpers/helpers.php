<?php
use Intervention\Image\Facades\Image;
use Nette\Utils\Json;
use App\Models\Answer;
use App\Models\Question;
use Backpack\MenuCRUD\app\Models\MenuItem;

// menu for header
if(!function_exists('menuHeader')) {
    function menuHeader() {
        $menu = MenuItem::find(1);
        return $menu->children;
    }

}


if(!function_exists('upload_images')){
    /**
     * @param $file
     * @return array
     */
    function upload_images($file, $configFolderSize, $folder = '/'): array
    {
        $userFolder = 'uploads/' . $folder;



        //the user's image size in config
        $sizes = config('filesystems.image_sizes.'.$configFolderSize);

        //doing image file nice
        $nameAndExtension = explode('.', $file->getClientOriginalName()); // to array converting
        $extension = array_pop($nameAndExtension); //getting the lest item (extension) and remove the last item
        $nameSlugged = Str::slug(implode('', $nameAndExtension)); //name to slug
        $readyImage = 'avatar_' . $nameSlugged . uniqid() . '.' . $extension; //the real name for using with extension

        $imageSizes = [];
        foreach ($sizes as $folder => $size) {
            $image = Image::make($file);


            $userImageSizePath = $userFolder . $folder; //folder from config


            !file_exists(public_path($userImageSizePath)) ? mkdir(public_path($userImageSizePath)) : null; //folder not exists than creat

            $image->resize($size['w'], $size['h']);// size from config filesystem

            if($size['w'] > 400) {
                $waterMark = Image::make(public_path('images/watermark.png'));
                $waterMark->resize(200, 100);
                $image->insert($waterMark, 'bottom-right');
            }


            $userImage = $userImageSizePath . '/' . $readyImage; // doing real path

            $image->save(public_path($userImage), 100, 'webp');
            $imageSizes[$folder] = $userImage;
        }

        return $imageSizes;
    }




    if(!function_exists('saveImageSizes'))
    {
        /**
         * this function is for saveing multiple images like gallery
         * @param $mainImage
         * @param $galleries
         * @param string $model
         * @return string
         * @throws \Nette\Utils\JsonException
         */
        function saveImageSizes($mainImage, $galleries, string $model)
        {
            // создать размер картинки для главная картинка
            $mainPaths = imageResizer($mainImage, $model);

            // массив на джейсон
            $galleries = is_array($galleries)  ? $galleries : Json::decode($galleries);

            //перемена каторая все галлерий будет сохранено
            $galleriesPaths = [];

            //loop для каждый картинки из галлерия чтобы сделать необходимый размеры
            foreach ($galleries as $gallery)
            {
                $galleriesPaths[] = imageResizer($gallery, $model);
            }

            if(count($galleriesPaths) > 0) {
                $imageSizes = [
                    'main' => $mainPaths,
                    'gallery' => $galleriesPaths
                ];
            } else {
                $imageSizes = [
                    'main' => $mainPaths
                ];
            }


            $imageSizes = Json::encode($imageSizes);

            return $imageSizes;

        }
    }



    if(!function_exists('imageResizer'))
    {
        /**
         * Paths to image
         * @param string $imagePath
         * @param string $configSizes
         * @return array;
         */
        function imageResizer(string $imagePath, string $configSizes, string $toFolder = '', string $prefix = null) : array
        {

            $paths = [];

            // конфиг размер картинки
            $imageSizes = config('filesystems.image_sizes.'.$configSizes);


            $folder = explode('/', $imagePath);
            $imageName = end($folder);

            foreach ($imageSizes as $key => $size)
            {
                if(!file_exists(public_path($imagePath))) {
                    return [];
                }
                $img =  Image::make(public_path($imagePath));
                $img->resize($size['w'], $size['h']);
                if($size['w'] > 400) {
                    $waterMark = Image::make(public_path('images/watermark.png'));
                    $waterMark->resize(200, 100);
                } else {
                    $waterMark = Image::make(public_path('images/watermark.png'));
                    $waterMark->resize(100, 50);
                }

                $img->insert($waterMark, 'bottom-right');

                $newImageName = date('ymHs') . '-' . $imageName;
                $uploadFolder = 'uploads/' . $toFolder . '/' . $key . '/';
                $publicPath = public_path($uploadFolder);

                if($prefix)
                {
                    $newImageName = $prefix . $newImageName;
                }

                if(!file_exists($publicPath) && mkdir($publicPath))
                {
                    $img->save($publicPath  . $newImageName);
                    $paths[$key] = $uploadFolder  . $newImageName ;
                }
                else
                {
                    $img->save($publicPath  . $newImageName);
                    $paths[$key] = $uploadFolder . $newImageName ;
                }
            }

            return $paths;

        }
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
                    $path = public_path($image_name);
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



if(!function_exists('getModelNamespace')){
    /**
     * Pass model name to get the namespace name for polymorphism
     * @param string $likeable_type;
     * @return string App\Models\$model_type
     */
    function getModelNamespace(string $model_type) : string
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



