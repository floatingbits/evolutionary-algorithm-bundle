<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Theming;

class Theme implements ThemeInterface
{
    private ?ThemeInterface $parentTheme = null;
    private string $path = '';
    private int $priority = 0;
    public function __construct(string $path, int $priority = 0, ThemeInterface $parentTheme = null)
    {
        $this->parentTheme = $parentTheme;
        $this->path = $path;
        $this->priority = $priority;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function getParentTheme(): ?ThemeInterface
    {
        return $this->parentTheme;
    }

    public function getPath(): string
    {
        return $this->path;
    }


}