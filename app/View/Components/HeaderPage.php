<?php

namespace App\View\Components;

use Closure;
use App\Models\Page;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class HeaderPage extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data['pages'] = Page::where('is_active', 1)->get();
        return view('components.header-page', $data);
    }
}
