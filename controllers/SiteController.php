<?php

namespace app\controllers;

use app\models\UrlRequest;
use LevNevinitsin\Service\UrlService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\StringHelper;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($shortUrl = '')
    {
        $model = new UrlRequest();
        $request = Yii::$app->request;

        if ($request->getIsPost()) {
            $model->sourceUrl = $request->post('sourceUrl');

            if (!$model->validate('sourceUrl')) {
                return;
            }

            do {
                $model->shortUrl = UrlService::getRandomString();
            } while (UrlRequest::find()->where(['shortUrl' => $model->shortUrl])->exists());

            $model->save(false);
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $model;
        }

        if ($shortUrl !== '') {
            $urlRequest = UrlRequest::findOne(['shortUrl' => $shortUrl]);

            if ($urlRequest) {
                $urlRequest->usesCount++;
                $urlRequest->save(false);

                $sourceUrl = $urlRequest->sourceUrl;
                $redirectUrl = StringHelper::startsWith($sourceUrl, 'http')
                    ? $sourceUrl
                    : "https://$sourceUrl";

                return $this->redirect($redirectUrl);
            }

            return $this->redirect("/");
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionHistory()
    {
        $query = UrlRequest::find();

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'dateCreated' => SORT_DESC,
                ],
            ],
        ]);

        return $this->render('history', [
            'provider' => $provider,
        ]);
    }
}
