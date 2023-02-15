<?php

namespace app\models\form;

use app\models\Line;
use app\models\LineTranslation;
use Yii;
use yii\base\Model;

class LineCreateForm extends Model
{
    public ?Line $line = null;

    /**
     * @var LineTranslation[]
     */
    public array $translations = [];

    public function rules()
    {
        return [
            [['Line'], 'required'],
            [['Translations'], 'safe'],
        ];
    }

    /**
     * @throws \Throwable
     */
    public function save(): bool
    {
        if (!$this->validate()) {
            return false;
        }
        $transaction = Yii::$app->db->beginTransaction();
        if (!$this->line->save()) {
            $transaction->rollBack();
            return false;
        }

        if (!$this->saveTranslations()) {
            $transaction->rollBack();
            return false;
        }

        $transaction->commit();
        return true;
    }

    public function validate($attributeNames = null, $clearErrors = true)
    {
        if(!parent::validate($attributeNames, $clearErrors))
        {
            return false;
        }

        $translationValid = true;
        foreach ($this->translations as $translation) {
            if (!$translation->validate()) {
                $translationValid = false;
            }
        }

        return $this->line->validate()
            && $translationValid;
    }

    public function getErrors($attribute = null): array
    {
        if($this->hasErrors())
        {
            return parent::getErrors();
        }

        $errors = [];
        if($this->line->hasErrors()) {
            $errors['Line'] = $this->line->getErrors();
        }

        foreach ($this->translations as $key => $translation) {
            if ($translation->hasErrors()) {
                $errors['Translations'][$key] = $translation->getErrors();
            }
        }

        return $errors;
    }

    /**
     * @throws \Throwable
     */
    private function saveTranslations(): bool
    {
        foreach ($this->translations as $lineTranslation) {
            $lineTranslation->line_id = $this->line->id;
            if (!$lineTranslation->save(false)) {
                return false;
            }
        }
        return true;
    }

    public function setLine($data)
    {
        if (!$this->line instanceof Line) {
            $this->line = new Line();
        }

        $this->line->setAttributes($data);
    }

    public function setTranslations($translations)
    {
        $this->translations = [];
        foreach ($translations as $key => $lineTranslation) {
            $model = new LineTranslation();
            $model->setAttributes($lineTranslation);
            $this->translations[$key] = $model;
        }
    }

    public function getLine(): ?Line
    {
        return $this->line;
    }

    public function getTranslations(): array
    {
        return $this->translations;
    }


}