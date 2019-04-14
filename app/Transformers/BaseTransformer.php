<?php

namespace App\Transformers;

/**
 * Include League\Fractal\ParamBag
 */
use League\Fractal\ParamBag;
use League\Fractal\TransformerAbstract;

/**
 * Class BaseTransformer.
 *
 * @package namespace App\Transformers;
 */
class BaseTransformer extends TransformerAbstract
{
    /**
     * Array attribute doesn't parse.
     */
    public $ignoreAttributes = [];

    /**
     * Transform the all fillable entity.
     *
     * @param $model
     *
     * @return array
     */
    public function fromFillable($model)
    {
        $hiddens = array_merge($model->getHidden(), $this->ignoreAttributes);
        $fillableValues = array_only($model->toArray(), array_diff($model->getFillable(), $hiddens));

        return array_merge($fillableValues, $this->customAttributes($model), [
            'id' => (int) $model->id,
            'created_at' => $model->created_at ? $model->created_at->toIso8601String() : null,
            'updated_at' => $model->updated_at ? $model->updated_at->toIso8601String() : null,
            'deleted_at' => $model->deleted_at ? $model->deleted_at->toIso8601String() : null,
        ]);
    }

    /**
     * Transform the custom field entity.
     *
     * @return array
     */
    public function customAttributes($model): array
    {
        return [];
    }

    /**
     * Transform the entity.
     *
     * @param $model
     *
     * @return array
     */
    public function transform($model)
    {
        return $this->fromFillable($model);
    }
}
