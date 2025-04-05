<?php
namespace Opencart\Catalog\Controller\Extension\LogCleaner\Startup;
/**
 * Class LogCleaner
 *
 * @package Opencart\Catalog\Controller\Extension\LogCleaner\Startup
 */
class LogCleaner extends \Opencart\System\Engine\Controller {
    /**
     * Index
     *
     * @return void
     */
    public function index(): void {
        if ($this->config->get("module_log_cleaner_status")) {
            $chance = $this->config->get("module_log_cleaner_chance") ?? 5;
            $size = $this->config->get("module_log_cleaner_size") ?? 50;
            $this->registry->set('log_cleaner', new \Opencart\System\Library\Extension\LogCleaner\LogCleaner((int)$chance, (int)$size));
            $this->log_cleaner->clean();
        }
    }
}
