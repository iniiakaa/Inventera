<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;
use Illuminate\View\View;

class Admin extends Component // <-- Pastikan ini tertulis Admin
{
    public function render(): View
    {
        return view('components.layouts.admin');
    }
}