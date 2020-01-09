<?php

namespace App\Transformers;

use Illuminate\Support\Facades\Storage;

/**
 * Class ImageTransformer.
 */
class ImageTransformer extends BaseTransformer
{
    /**
     * Transform the custom field entity.
     *
     * @return array
     */
    public function customAttributes($model): array
    {
        return [
            'url'       => Storage::url($model->pathname),
            'thumb_url' => Storage::url('thumbnails/'.$model->filename),
        ];
    }
}
