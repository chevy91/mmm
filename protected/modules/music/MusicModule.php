<?php

/**
 * MusicModule основной класс модуля music
 */

use yupe\components\WebModule;

class MusicModule extends WebModule
{
    const VERSION = '0.1';
	
	public $uploadPath = 'uploads/tracks';
	public $analyzeDir = 'upload';

    public function getDependencies()
    {
        return [
            'category',
            'user',
        ];
    }

    public function getAdminPageLink()
    {
        return '/music/musicBackend/index';
    }

    public function getNavigation()
    {
        return [
			['label' => Yii::t('MusicModule.music', 'Tracks')],
            [
                'icon'  => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('MusicModule.music', 'Track list'),
                'url'   => ['/music/trackBackend/index']
            ],
			
			[
				'icon'  => 'fa fa-fw fa-plus-square',
				'label' => Yii::t('MusicModule.music', 'Detect new tracks'),
				'url'   => ['/music/trackBackend/analyze']
			],
           /* [
                'icon'  => 'fa fa-fw fa-plus-square',
                'label' => Yii::t('MusicModule.music', 'Add new track'),
                'url'   => ['/music/trackBackend/create']
            ],
			*/
			['label' => Yii::t('MusicModule.music', 'Genres')],
			[
				'icon'  => 'fa fa-fw fa-list-alt',
				'label' => Yii::t('MusicModule.music', 'List genres'),
				'url'   => ['/music/genreBackend/index']
			],
			
			[
				'icon'  => 'fa fa-fw fa-plus-square',
				'label' => Yii::t('MusicModule.music', 'Add new genre'),
				'url'   => ['/music/genreBackend/create']
			],
        ];
    }

    public function getName()
    {
        return Yii::t('MusicModule.music', 'Music');
    }

    public function getCategory()
    {
        return Yii::t('FeedbackModule.feedback', 'Content');
    }

    public function getDescription()
    {
        return Yii::t('MusicModule.music', 'Module for manage MP3 on site');
    }

    public function getVersion()
    {
        return self::VERSION;
    }

    public function getAuthor()
    {
        return Yii::t('FeedbackModule.feedback', 'Wipple');
    }

    public function getAuthorEmail()
    {
        return 'webnwork.developer@gmail.com';
    }

    public function getIcon()
    {
        return 'fa fa-fw fa-music';
    }

    public function init()
    {
        parent::init();

        $this->setImport(
            [
                'music.models.*',
                'music.components.*'
            ]
        );
    }

}
