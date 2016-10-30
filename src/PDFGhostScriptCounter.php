<?php

namespace Ptsilva\DocumentCounter;

use Symfony\Component\Process\Process;
use Ptsilva\DocumentCounter\Documents\Contracts\CountableDocumentInterface;

/**
* 
*/
class PDFGhostScriptCounter implements CounterInterface
{
	private $binPath;

	public function __construct($binPath = null)
	{
		$this->binPath = $binPath ?: 'gs';
	}

	public function process(CountableDocumentInterface $document)
	{
		$cmd = sprintf('%s -q -dNODISPLAY -c "(%s) (r) file runpdfbegin pdfpagecount = quit";', $this->binPath, $document->getFullPath());

		($process = new Process($cmd))->run();

		return (int) $process->getOutput();
	}
}