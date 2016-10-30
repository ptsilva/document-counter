<?php

namespace Ptsilva\DocumentCounter;

use Ptsilva\DocumentCounter\Documents\Contracts\CountableDocumentInterface;

interface CounterInterface
{
	public function process(CountableDocumentInterface $document);
}