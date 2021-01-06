<?php

namespace app\models\forms;

use app\models\entities\ProductImageEntity;
use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use app\models\entities\ProductEntity;

class AddProductImagesForm extends Model
{
    public ?int $productId = null;

    /**
     * @var UploadedFile[]
     */
    public array $imageFiles = [];

    public function rules(): array
    {
        return [
            [['productId', 'imageFiles'], 'required'],
            [
                ['productId'],
                'exist',
                'targetClass' => ProductEntity::class,
                'targetAttribute' => ['productId' => 'id']
            ],
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 3],
        ];
    }

    public function upload(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $storage = Yii::getAlias('@storage');
        FileHelper::createDirectory("{$storage}/products/{$this->productId}");

        foreach ($this->imageFiles as $file) {
            $fileName = sprintf('%s_%s_%d.%s', time(), md5($file->baseName), mt_rand(), $file->extension);
            $rout = "products/{$this->productId}/{$fileName}";

            if (!$file->saveAs("{$storage}/{$rout}")) {
                $this->addError(
                    'imageFiles',
                    Yii::t('app', 'File {file}. can not be loaded', ['file' => "{$file->baseName}.{$file->extension}"])
                );
                continue;
            }

            $image = new ProductImageEntity();
            $image->product_id = $this->productId;
            $image->url = $rout;
            $image->save();
        }

        return true;
    }
}