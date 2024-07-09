<?php

namespace Blomstra\SaveSortingPreferences;

use Flarum\Api\Serializer\AbstractSerializer;

class PreferredSortingSerializer extends AbstractSerializer
{
    public function getId($model)
    {
        return null;
    }

    protected function getDefaultAttributes($model)
    {
        return $model;
    }

    public function getType($model)
    {
        return 'sort';
    }
}
