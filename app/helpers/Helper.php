<?php

    use Intervention\Image\ImageManagerStatic;

    /* =============================================================================== */
    /**
     * Changing URL Pattern
     * @param $url
     * @return string|string[]|null
     */
    if (!function_exists('change_http')){
        function change_http($url){
            $pattern = "/www\.|https?:\/\/(?:www\.|(?!www))/";

            $url = preg_replace($pattern, '*.', $url);
            return $url;
        }
    }

    /**
     * Generate Image for empty field
     * @param $imageText
     * @return \Intervention\Image\Image
     */
    if (!function_exists('GenerateAlphaImage')){
        function GenerateAlphaAvatar($imageText){
            $img = ImageManagerStatic::canvas(200, 200, '#000');
            $img->text($imageText, 100, 60, function($font) {
                $font->file(public_path('fonts/Poppins-SemiBold.ttf'));
                $font->size(120);
                $font->color('#43C324');
                $font->align('center');
                $font->valign('top');
            });
            return $img;
        }

        /**
         * For Production
         * $font->file('fonts/Poppins-SemiBold.ttf');
         *
         * For Localhost
         * $font->file(public_path('fonts/Poppins-SemiBold.ttf'));
         * */
    }


    /**
     * Parse Markdown
     * @param $arg
     * @return array
     */
    function parseInfo($arg){
        $markdown = new \Parsedown();
        return [
            'desc' => $markdown->setSafeMode(true)->text($arg->desc),
            'impact' => $markdown->setSafeMode(true)->text($arg->impact),
            'steps_of_reproduce' => $markdown->setSafeMode(true)->text($arg->steps_of_reproduce),
            'exploitation' => $markdown->setSafeMode(true)->text($arg->exploitation),
            'fixation' => $markdown->setSafeMode(true)->text($arg->fixation)
        ];
    }
