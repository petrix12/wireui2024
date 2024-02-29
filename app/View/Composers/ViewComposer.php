<?php

namespace App\View\Composers;
use Illuminate\View\View;

class ViewComposer {
    public function compose(View $view) {
        $view->with('mi_parametro', 'Valor de mi_parametro');
    }
}