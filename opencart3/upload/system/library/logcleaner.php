<?php
/**
 * @package     Log Cleaner
 * @version     v1.0.0
 * @author      Szabó Levente
 * @link        https://levente.net
 */
class LogCleaner {

    /**
     * @var int
     */
    private $chance;
    /**
     * @var int
     */
    private $size;

    public function __construct($chance, $size) {
        $this->chance = (int)$chance;
        $this->size = (int)$size * 1024 * 1024;
    }

    /**
     * @return void
     */
    public function clean() {
        if (rand(1, 100) <= $this->chance) {
            $logFiles = glob(DIR_LOGS . '*.{log,Log,LOG,txt,Txt,TXT}', GLOB_BRACE);
            foreach ($logFiles as $file) {
                if (is_file($file) && filesize($file) > $this->size) {
                    @file_put_contents($file, '');
                }
            }
        }
    }
}
