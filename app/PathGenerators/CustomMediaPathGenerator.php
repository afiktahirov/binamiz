<?php

namespace App\PathGenerators;

use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CustomMediaPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        return $this->getFolderName($media) . '/' . $media->model_id . '/';
    }

    public function getPathForConversions(Media $media): string
    {
        return $media->collection_name . '/' . $media->model_id . '/conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $media->collection_name . '/' . $media->model_id . '/responsive/';
    }

    public function getFolderName(Media $media)
    {
        $model = $media->model;
        if(!isset($model->mediaPath))
        {
            throw new \Exception("Model path not found for model: " . get_class($model) . "\n Please define the \$mediaPath in the model class.");
        }
        return "uploads/" . $model->mediaPath;
    }
}
