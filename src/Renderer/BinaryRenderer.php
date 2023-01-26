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
     * BinaryRenderer constructor.
     *
     * @param string $bin
     * @param string $args
     */
    public function __construct(string $bin, string $args = '--config.validationLevel --config.minify')
    {
        $this->bin = $bin;
        $this->setArgs($args);
    }

    /**
     * Set arguments used to run mjml.
     *
     * @link https://documentation.mjml.io/#command-line-interface
     * @param string $args
     * @return void
     */
    public function setArgs(string $args): void
    {
        $this->command = "{$this->bin} -i -s {$args}";
    }

    /**
     * @inheritDoc
     */
    public function render(string $content): string
    {
        $process = new Process($this->command, $content);
        $process->run();

        return $process->getOutput();
    }
}
