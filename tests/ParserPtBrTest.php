<?php

declare(strict_types=1);

namespace Tests;

use Freep\DocsMapper\i18n\EnUs;
use Freep\DocsMapper\i18n\Lang;
use Freep\DocsMapper\i18n\PtBr;
use Freep\DocsMapper\Parser;

class ParserPtBrTest extends TestCase
{
    private function parserFactory(): Parser
    {
        $instance = new Parser(new PtBr(), __DIR__ . '/docs-dist');
        $instance->addDirectory(__DIR__ . '/docs-src/pt-br', 'test');
        $instance->addFile(__DIR__ . '/docs-src/en/index.md', 'test/leiame.md');
        $instance->analyse();

        return $instance;
    }

    /** @test */
    public function getSummary(): void
    {
        $instance = $this->parserFactory();

        // nao tem o arquivo indice.md, identificado como sumário
        $this->assertEquals([
            __DIR__ . "/docs-src/pt-br/01-pagina-um.md" => "Primeiro título",
            __DIR__ . "/docs-src/pt-br/02-pagina-dois.md" => "Segundo título",
            __DIR__ . "/docs-src/pt-br/03-pagina-tres.md" => "Terceiro título",
            __DIR__ . "/docs-src/en/index.md" => "Test index",
        ], $instance->getSummaryItems());
    }

    /** @test */
    public function getSummaryFile(): void
    {
        $instance = $this->parserFactory();

        $this->assertEquals(
            __DIR__ . "/docs-src/pt-br/indice.md",
            $instance->getSummaryFile()
        );
    }
}