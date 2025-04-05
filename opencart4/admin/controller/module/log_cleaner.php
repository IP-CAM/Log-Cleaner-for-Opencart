<?php
namespace Opencart\Admin\Controller\Extension\LogCleaner\Module;
/**
 * Class LogCleaner
 *
 * @package Opencart\Admin\Controller\Extension\LogCleaner\Module
 */
class LogCleaner extends \Opencart\System\Engine\Controller {
    /**
     * Index
     *
     * @return void
     */
    public function index(): void {
        $this->load->language('extension/log_cleaner/module/log_cleaner');

        $this->document->setTitle($this->language->get('heading_title'));

        $data['breadcrumbs'] = [];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
        ];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module')
        ];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/log_cleaner/module/log_cleaner', 'user_token=' . $this->session->data['user_token'])
        ];

        $data['save'] = $this->url->link('extension/log_cleaner/module/log_cleaner.save', 'user_token=' . $this->session->data['user_token']);
        $data['back'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module');

        if (isset($this->request->post['module_log_cleaner_status'])) {
            $data['module_log_cleaner_status'] = $this->request->post['module_log_cleaner_status'];
        } else {
            $data['module_log_cleaner_status'] = $this->config->get('module_log_cleaner_status');
        }

        if (isset($this->request->post['module_log_cleaner_chance'])) {
            $data['module_log_cleaner_chance'] = $this->request->post['module_log_cleaner_chance'];
        } else if ($this->config->get('module_log_cleaner_chance')) {
            $data['module_log_cleaner_chance'] = $this->config->get('module_log_cleaner_chance');
        } else {
            $data['module_log_cleaner_chance'] = 5;
        }

        if (isset($this->request->post['module_log_cleaner_size'])) {
            $data['module_log_cleaner_size'] = $this->request->post['module_log_cleaner_size'];
        } else if ($this->config->get('module_log_cleaner_size')) {
            $data['module_log_cleaner_size'] = $this->config->get('module_log_cleaner_size');
        } else {
            $data['module_log_cleaner_size'] = 50;
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/log_cleaner/module/log_cleaner', $data));
    }

    /**
     * Save
     *
     * @return void
     */
    public function save(): void {
        $this->load->language('extension/log_cleaner/module/log_cleaner');

        $json = [];

        if (!$this->user->hasPermission('modify', 'extension/log_cleaner/module/log_cleaner')) {
            $json['error'] = $this->language->get('error_permission');
        }

        if (!$json) {
            $this->load->model('setting/setting');

            $this->model_setting_setting->editSetting('module_log_cleaner', $this->request->post);

            $json['success'] = $this->language->get('text_success');
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    /**
     * Install
     *
     * @return void
     */
    public function install(): void {
        $this->load->model('setting/startup');
        $startup_data = [
            'code'        => 'log_cleaner',
            'description' => 'OpenCart Log Cleaner. This extension cleans OpenCart logs if they are larger than the configured size.',
            'action'      => 'catalog/extension/log_cleaner/startup/log_cleaner',
            'status'      => 1,
            'sort_order'  => 0
        ];
        $this->model_setting_startup->addStartup($startup_data);
    }

    /**
     * Uninstall
     *
     * @return void
     */
    public function uninstall(): void {
        $this->load->model('setting/startup');
        $this->model_setting_startup->deleteStartupByCode('log_cleaner');
    }
}
