<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Tablelist extends Component
{
    public $header;
    public $data;
    public $pagina;

    public function __construct($header, $data, $pagina) {
        $this->header = $header;
        $this->data = $data;
        $this->pagina = $pagina;
    }

    public function render() {

        return view('components.tablelist');
    }
}
