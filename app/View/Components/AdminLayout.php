<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AdminLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     * x-admin-layout → layouts/admin.blade.php
     */
    public function render(): View
    {
        return view('layouts.admin');
    }
}
