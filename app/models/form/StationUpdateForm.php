<?php

namespace app\models\form;

use app\models\StationAudio;
use app\models\StationFeature;
use app\models\StationTransfer;
use app\models\StationTranslation;
use Yii;
class StationUpdateForm extends StationCreateForm
{
    /**
     * @throws \Throwable
     */
    private function saveTranslations(): bool
    {
        foreach ($this->translations as $translation) {
            if (!$translation->save(false)) {
                return false;
            }
        }
        return true;
    }

    private function saveTransfers(): bool
    {
        foreach ($this->transfers as $transfer) {
            if (!$transfer->save(false)) {
                return false;
            }
        }
        return true;
    }

    private function saveAudios(): bool
    {
        foreach ($this->audios as $audio) {
            if (!$audio->save(false)) {
                return false;
            }
        }
        return true;
    }

    private function saveFeatures(): bool
    {
        foreach ($this->features as $feature) {
            if (!$feature->save(false)) {
                return false;
            }
        }
        return true;
    }

    public function setStation(array $data)
    {
        $this->station->setAttributes($data);
    }

    public function setTranslations(array $translations)
    {
        foreach ($translations as $key => $stationTranslationData) {
            $translationModel = StationTranslation::findOne($stationTranslationData['id']);
            if($translationModel instanceof StationTranslation)
            {
                $translationModel->setAttributes($stationTranslationData);
                $this->translations[$key] = $translationModel;
            }
        }
    }

    public function setTransfers(array $transfers)
    {
        foreach ($transfers as $key => $stationTransferData) {
            $transferModel = StationTransfer::findOne($stationTransferData['id']);
            if($transferModel instanceof StationTransfer)
            {
                $transferModel->setAttributes($stationTransferData);
                $this->transfers[$key] = $transferModel;
            }
        }
    }

    public function setAudios(array $audios)
    {
        foreach ($audios as $key => $stationAudioData) {
            $audioModel = StationAudio::findOne($stationAudioData['id']);
            if($audioModel instanceof StationAudio)
            {
                $audioModel->setAttributes($stationAudioData);
                $this->audios[$key] = $audioModel;
            }
        }
    }

    public function setFeatures(array $features)
    {
        foreach ($features as $key => $stationFeatureData) {
            $featureModel = StationFeature::findOne($stationFeatureData['id']);
            if($featureModel instanceof StationFeature)
            {
                $featureModel->setAttributes($stationFeatureData);
                $this->features[$key] = $featureModel;
            }
        }
    }
}