<?php

namespace Qferrer\Mjml\Renderer;

/**
 * Interface RendererInterface
 */
interface RendererInterface
{
    /**
     * Renderer MJML to HTML content
     *
     * @param string $content The MJML content
     *
     * @return string The generated HTML
     */
    public function render(string $content): string;
}
