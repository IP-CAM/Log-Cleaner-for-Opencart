<?php
/**
 * @package     Log Cleaner
 * @version     v1.0.0
 * @author      Szabó Levente
 * @link        https://levente.net
 */
namespace Opencart\System\Library\Extension\LogCleaner;
/**
 * Class LogCleaner
 */
class LogCleaner {

    /**
     * @var int
     */
    private int $chance;
    /**
     * @var int
     */
    private int $size;

    /**
     * Constructor
     *
     * @param int $chance
     * @param int $size
     */
    public function __construct(int $chance, int $size) {
        $this->chance = $chance;
        $this->size = $size;
    }

    /**
     * @return void
     */
    public function clean(): void
    {
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
