<?php

require "class.bpm.php";

echo "detecting bpm for the file test.mp3 with no predefined length using ffmpeg:\n";
$bpm_detect = new bpm_detect("folder/test.mp3",DETECT_LENGTH,USE_FFMPEG, getenv('PATH'));
echo "average track bpm is ".$bpm_detect->detectBPM()."\n";

?>