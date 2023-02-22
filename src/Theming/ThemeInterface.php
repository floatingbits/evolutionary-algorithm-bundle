<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Theming;

interface ThemeInterface
{
    public function getParentTheme(): ?ThemeInterface;
    public function getPath(): string;
    public function getPriority(): int;
}