<?php
namespace AdsCampaign\View\View;

use AdsCampaign\Exception\ViewException;
use AdsCampaign\Detect;

class View
{
    private $data = [];

    private $render = false;

    public function __construct(string $view)
    {
        $file = __DIR__ . '/../' . strtolower($view) . '.php';

        if (file_exists($file)) 
            $this->render = $file;
        else 
            throw new ViewException('view ' . $view . ' not found!');
    }

    public function assign(string $key, array $val) : void
    {
        $this->data[$key] = $val;
    }
    
    public function __destruct()
    {
        extract($this->data);
        include($this->render);
    }
}