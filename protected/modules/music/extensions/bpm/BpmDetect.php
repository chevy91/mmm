<?php
class BpmDetect extends CComponent
{
	public $file;
	public $dir;
	
	public function __construct($file)
	{
		//putenv('LANG=en_US.UTF-8');
		$command = iconv('UTF-8', 'CP866', "ffmpeg -i \"{$file}\" -acodec pcm_u8 -ar 22050 \"" . dirname(Yii::app()->basePath) . "/temp/\"  2>&1");
		//$command = "php  2>&1";
		putenv("PATH=" . getenv("PATH"));
		//echo getenv("PATH");
		exec($command, $bpm);
	}
	
	public function convertToWav()
	{
		$command = iconv('UTF-8', 'CP866', "ffmpeg -i \"{$file}\" -acodec pcm_u8 -ar 22050 \"" . dirname(Yii::app()->basePath) . "/temp/\"  2>&1");

		putenv("PATH=" . getenv("PATH"));
		exec($command, $bpm);
	}
}