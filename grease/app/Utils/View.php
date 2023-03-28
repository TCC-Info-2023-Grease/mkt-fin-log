<?php

namespace App\Utils\Page;


/**
 * View
 * It takes a view name, and returns the view's content with the variables replaced by their values
 */
class View {

    
   /**
    * It checks if the file exists, and if it does, it returns the contents of the file.
    * 
    * @param view The name of the view file to be loaded.
    * 
    * @return The file contents of the view.
    */
    public static function getContentView($view) {
        $file = __DIR__.'../../resources/views/'.$view.'.php';

        return file_exists($file) ? file_get_contents($file) : '';
    }

    
    /**
     * It takes a view name, and returns the view's content with the variables replaced by their
     * values.
     * 
     * @param view The name of the view to be rendered.
     * @param data an array of data to be used in the view
     * 
     * @return The content of the view file.
     */
    public static function render($view, $data = []) {
        $contentView = self::getContentView($view);
        $contentFinal = null;
    
        if ($contentView) {
            $contentFinal = preg_replace_callback(
                '/{{\s*(.*?)\s*}}/', 
                function ($matches) use ($vars) {
                  return isset($vars[$matches[1]]) ? $vars[$matches[1]] : '';
                }, 
                $contentView
            );

            
        }

        return $contentFinal;
    }

}