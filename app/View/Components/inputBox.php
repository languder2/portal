<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\User;
class inputBox extends Component
{
    public function __construct(
        ?string $type,
        ?string $id,
        ?string $label,
        ?string $name,
        ?string $fill,
        ?string $required,
    )
    {
    }

    public function render(): View|Closure|string
    {
        return view('components.input-box');
    }
}
