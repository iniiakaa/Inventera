<?php

namespace App\View\Components\Liquid;

use Illuminate\View\Component;
use Illuminate\View\View;

class Sidebar extends Component
{
    public function render(): View
    {
        return view('components.sidebar');
    }
}
