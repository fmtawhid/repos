<?php

namespace App\View\Components\Common;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PaginationComponent extends Component
{
    /**
     * Create a new component instance.
     */
    private $list;
    public function __construct($list)
    {
        $this->list = $list;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data['list'] = $this->list;
        return view('components.common.pagination-component', $data);
    }
}
