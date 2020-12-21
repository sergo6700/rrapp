<?php


namespace App\Services\Web;

use App\Models\Slider\Slider;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SliderService
 *
 * @package App\Services\Web
 */
class SliderService
{
    /**
     * @return Collection
     */
    public function get(): Collection
    {
        return Slider::with(['picture_desktop', 'picture_mobile'])
            ->orderBy('sort', 'asc')->get();
    }
}