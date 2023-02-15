<?php

namespace app\models\form;

use app\models\Station;
use app\models\StationFeature;
use app\models\StationAudio;
use app\models\StationTransfer;
use app\models\StationTranslation;
use Yii;
use yii\base\Model;
class StationCreateForm extends Model
{
    public ?Station $station = null;

    /**
     * @var StationTranslation[]
     */
    public array $translations = [];

    /**
     * @var StationTransfer[]
     */
    public array $transfers = [];

    /**
     * @var StationAudio[]
     */
    public array $audios = [];

    /**
     * @var StationFeature[]
     */
    public array $features = [];

    public function rules()
    {
        return [
            [['Station'], 'required'],
            [['Translations'], 'safe'],
            [['Transfers'], 'safe'],
            [['Audios'], 'safe'],
            [['Features'], 'safe']
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
        if (!$this->station->save()) {
            $transaction->rollBack();
            return false;
        }

        if (!$this->saveTranslations()) {
            $transaction->rollBack();
            return false;
        }

        if (!$this->saveTransfers()) {
            $transaction->rollBack();
            return false;
        }

        if (!$this->saveAudios()) {
            $transaction->rollBack();
            return false;
        }

        if (!$this->saveFeatures()) {
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

        $translationsValid = true;
        foreach ($this->translations as $translation) {
            if (!$translation->validate()) {
                $translationsValid = false;
            }
        }

        $transfersValid = true;
        foreach ($this->transfers as $transfer) {
            if (!$transfer->validate()) {
                $transfersValid = false;
            }
        }

        $audiosValid = true;
        foreach ($this->audios as $audio) {
            if (!$audio->validate()) {
                $audiosValid = false;
            }
        }

        $featuresValid = true;
        foreach ($this->features as $feature) {
            if (!$feature->validate()) {
                $featuresValid = false;
            }
        }

        return $this->station->validate()
            && $translationsValid
            && $transfersValid
            && $audiosValid
            && $featuresValid;
    }

    public function getErrors($attribute = null): array
    {
        if($this->hasErrors())
        {
            return parent::getErrors();
        }

        $errors = [];
        if($this->station->hasErrors()) {
            $errors['Station'] = $this->station->getErrors();
        }

        foreach ($this->translations as $key => $translation) {
            if ($translation->hasErrors()) {
                $errors['Translations'][$key] = $translation->getErrors();
            }
        }

        foreach ($this->transfers as $key => $transfer) {
            if ($transfer->hasErrors()) {
                $errors['Transfers'][$key] = $transfer->getErrors();
            }
        }

        foreach ($this->audios as $key => $audio) {
            if ($audio->hasErrors()) {
                $errors['Audios'][$key] = $audio->getErrors();
            }
        }

        foreach ($this->features as $key => $feature) {
            if ($feature->hasErrors()) {
                $errors['Features'][$key] = $feature->getErrors();
            }
        }

        return $errors;
    }

    /**
     * @throws \Throwable
     */
    private function saveTranslations(): bool
    {
        foreach ($this->translations as $translation) {
            $translation->station_id = $this->station->id;
            if (!$translation->save(false)) {
                return false;
            }
        }
        return true;
    }

    private function saveTransfers(): bool
    {
        foreach ($this->transfers as $transfer) {
            $transfer->station_id = $this->station->id;
            if (!$transfer->save(false)) {
                return false;
            }
        }
        return true;
    }

    private function saveAudios(): bool
    {
        foreach ($this->audios as $audio) {
            $audio->station_id = $this->station->id;
            if (!$audio->save(false)) {
                return false;
            }
        }
        return true;
    }

    private function saveFeatures(): bool
    {
        foreach ($this->features as $feature) {
            $feature->station_id = $this->station->id;
            if (!$feature->save(false)) {
                return false;
            }
        }
        return true;
    }

    public function setStation(array $data)
    {
        if (!$this->station instanceof Station) {
            $this->station = new Station();
        }

        $this->station->setAttributes($data);
    }

    public function setTranslations(array $translations)
    {
        $this->translations = [];
        foreach ($translations as $key => $stationTranslation) {
            $model = new StationTranslation();
            $model->setAttributes($stationTranslation);
            $this->translations[$key] = $model;
        }
    }

    public function setTransfers(array $transfers)
    {
        foreach ($transfers as $key => $stationTransfer) {
            $model = new StationTransfer();
            $model->setAttributes($stationTransfer);
            $this->transfers[$key] = $model;
        }
    }

    public function setAudios(array $audios)
    {
        foreach ($audios as $key => $stationAudio) {
            $model = new StationAudio();
            $model->setAttributes($stationAudio);
            $this->audios[$key] = $model;
        }
    }

    public function setFeatures(array $features)
    {
        foreach ($features as $key => $stationFeature) {
            $model = new StationFeature();
            $model->setAttributes($stationFeature);
            $this->features[$key] = $model;
        }
    }

    public function getStation(): ?Station
    {
        return $this->station;
    }

    public function getTranslations(): array
    {
        return $this->translations;
    }

    public function getTransfers(): array
    {
        return $this->transfers;
    }

    public function getAudios(): array
    {
        return $this->audios;
    }

    public function getFeatures(): array
    {
        return $this->features;
    }
}