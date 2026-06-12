<?php

namespace App\View\Components\Liquid;

use Illuminate\View\Component;
use Illuminate\View\View;

class Topbar extends Component
{
    public function render(): View
    {
        return view('components.topbar');
    }
}
