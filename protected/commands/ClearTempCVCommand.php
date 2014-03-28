<?php

class ClearTempCVCommand extends CConsoleCommand
{

    public function actionIndex()
    {
        $folder = getcwd() . '/../web/uploads/temp_cv/';

        $files = glob($folder."*");
        foreach ($files as $file) {
            if(time() - filemtime($file) > 24*3600) {
                unlink($file);
            }

        }

    }

}