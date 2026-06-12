<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;
use Illuminate\View\View;

class Retail extends Component
{
    public function render(): View
    {
        return view('components.layouts.admin');
    }
}
