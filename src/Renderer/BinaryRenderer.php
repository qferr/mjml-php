<?php

namespace Qferrer\Mjml\Renderer;

use Qferrer\Mjml\Process\Process;
use Qferrer\Mjml\RendererInterface;

/**
 * Class BinaryRenderer
 */
class BinaryRenderer implements RendererInterface
{
    /**
     * The MJML CLI path.
     *
     * @var string
     */
    private $bin;

    /**
     * @var string
     */
    private $command;

    /**
     * @var string
     */
    private $mjmlFilePath;

    /**
     * BinaryRenderer constructor.
     *
     * @param string $bin
     * @param string $mjmlFilePath if set, reads this mjml file and creates a mjml.html file which will be read and return on render
     */
    public function __construct(string $bin, string $mjmlFilePath = "")
    {
        $this->bin = $bin;
        $this->mjmlFilePath = $mjmlFilePath;
        if ($mjmlFilePath !== "") {
            $this->command = "{$this->bin} --config.validationLevel 'skip' --config.minify true {$mjmlFilePath} -o  {$mjmlFilePath}.html";
        } else {
            $this->command = "{$this->bin} -i -s --config.validationLevel --config.minify";
        }
    }

    /**
     * @inheritDoc
     */
    public function render(string $content): string
    {
        $returnValue = "";

        if ($this->mjmlFilePath !== "") {
            passthru($this->command);
            $returnValue = file_get_contents("{$this->mjmlFilePath}.html");
        } else {
            $process = new Process($this->command, $content);
            $process->run();
            $returnValue = $process->getOutput();
        }

        return $returnValue;
    }
}
