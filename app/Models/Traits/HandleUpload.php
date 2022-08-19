<?php

namespace App\Models\Traits;

//use App\Jobs\DeleteImageProcess;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HandleUpload
{
    public static function bootHandleUpload(): void
    {
        static::saving(function (Model $model) {
            if ($model->isDirty($model->imageAttribute())) {
                if (blank($model->{$model->imageAttribute()})) {
                    $model->deleteLatestImage();
                }

                if (($model->{$model->imageAttribute()} instanceof UploadedFile)) {
                    $model->deleteLatestImage();
                    $model->saveImage();
                }
            }
        });

        static::deleting(function (Model $model) {
            $model->{$model->imageAttribute()} = null;
            $model->saveOrFail();
            $model->deleteLatestImage();
        });
    }

    public function imageAttribute(): string
    {
        return 'photo';
    }

    public function deleteLatestImage(): void
    {
        if (blank($this->getOriginalImage())) return;

        $path = $this->getFullImagePath();

        if (Storage::disk($this->getImageDisk())->exists($path)) {
//            DeleteImageProcess::dispatch($path, $this->getImageDisk())->afterCommit();
        }
    }

    public function getOriginalImage()
    {
        return $this->getRawOriginal($this->imageAttribute());
    }

    public function getFullImagePath(): string
    {
        $fileName = $this->getOriginalImage();

        return $this->getImagePath() . '/' . $fileName;
    }

    public function hasImage(): bool
    {
        return !blank($this->{$this->imageAttribute()});
    }

    public function saveImage(): void
    {
        /** @var \Illuminate\Http\UploadedFile $image */
        $image = $this->{$this->imageAttribute()};
        $image->store($this->getImagePath(), $this->getImageDisk());
        $this->setAttribute($this->imageAttribute(), $image->hashName());
    }

    public function download()
    {
        return response()->download(storage_path( '/app/public/' . $this->getFullImagePath()));
    }

    public function getImageDisk(): string
    {
        return 'public';
    }

    public function getImageUrl(): string
    {
        return Storage::disk($this->getImageDisk())->url($this->getFullImagePath());
    }

    public function getImagePath(): string
    {
        return 'images';
    }
}
