<?php

if (!function_exists('transformer')) {
    function transformer($data, $method = 'main')
    {
        $result = null;
        if ($data instanceof \Illuminate\Database\Eloquent\Model) {
            $data = getTransformerClass($data, $method);
        } else if ($data instanceof \Illuminate\Support\Collection) {
            $result = $data->map(function ($item) use ($method) {
                if ($item instanceof \Illuminate\Database\Eloquent\Model) {
                    return getTransformerClass($item, $method);
                }

                return $item;
            });
        } else if (is_array($data)) {
            $result = array_map(function ($item) use ($method) {
                if ($item instanceof \Illuminate\Database\Eloquent\Model) {
                    return getTransformerClass($item, $method);
                }
                return $item;
            }, $data);
        }

        return $result;
    }
}

if (!function_exists('getTransformerClass')) {
    function getTransformerClass($model, $method = 'main')
    {
        $transformer_name = config('transformer.namespace') . class_basename($model) . config('transformer.filter_postfix');
        if (class_exists($transformer_name)) {
            if (method_exists($transformer_name, $method)) {
                return $transformer_name::$method($model);
            }
        }

        return $model;
    }
}
    