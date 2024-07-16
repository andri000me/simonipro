<?php

use Dompdf\Dompdf;
use Dompdf\Options;

class PDF
{
    protected $dompdf;

    public function __construct()
    {
        // Load Composer's autoloader
        require_once APPPATH . '../vendor/autoload.php';

        // Initialize Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Times New Roman');
        $this->dompdf = new Dompdf($options);
    }

    public function load_html($html)
    {
        $this->dompdf->loadHtml($html);
    }

    public function render()
    {
        $this->dompdf->render();
    }

    public function stream($filename)
    {
        $this->dompdf->stream($filename, array('Attachment' => 0)); // 0 means show in browser
    }

    public function output()
    {
        return $this->dompdf->output();
    }
}
