<?php
namespace App\Controlers\Pages;

use App\Models\Usuario;
use App\Controlers\Pages\Page;

/* 
* Home
* It returns a page with the title "Home" and the content "&lt;h1&gt;Home&lt;/h1&gt;" 
*/

class Home extends Page {

    /**
     * It returns a page with the title "Home" and the content "&lt;h1&gt;Home&lt;/h1&gt;"
     * 
     * @return The return value is the result of the function call.
     */
    public static function getHome() {
        $MUsuario = new Usuario();

        $content = View::render('pages/home', [
            'title' => 'Home',
            'content' => '<h1>Home</h1>'
        ]);

        return parent::getPage('Home', $content);
    }

}

?>