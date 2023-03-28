<?php
namespace App\Controlers\Pages;

use App\Utils\View;

/* 
* Page
* It's a class that returns a page with a header, footer, and content. 
*/
class Page {

    /**
     * It returns the rendered view of the header.
     * 
     * @return The return value of the render method.
     */
    public static function getHeader() {
        return View::render('layout/header');
    }


    /**
     * It returns the rendered footer.
     * 
     * @return The return value of the render method.
     */
    public static function getFooter() {
        return View::render('layout/footer');
    }


    /**
     * It takes a title and content, and returns a page with a header, footer, and the title and
     * content.
     * 
     * @param title The title of the page
     * @param content The content of the page.
     * 
     * @return the rendered view of the page.
     */
    public static function getPage($title, $content) {
        return View::render('layout/page', [
            'header' => self::getHeader(),
            'title' => $title,
            'content' => $content,
            'footer' => self::getFooter()
        ]);
    }

}

?>