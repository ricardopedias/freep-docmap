<?php

declare(strict_types=1);

namespace Freep\Docmap\i18n;

interface Lang
{
    public function translate(string $word): string;
}
