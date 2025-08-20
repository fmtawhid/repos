<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ChangeLanguage extends Component
{
    private $lang_key;

    /**
     * Create a new component instance.
     */
    public function __construct($langkey)
    {
        $this->lang_key = $langkey;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data['lang_key'] = $this->lang_key;
        $data['languages'] = languages();
        return view('components.change-language', $data);
    }
}
