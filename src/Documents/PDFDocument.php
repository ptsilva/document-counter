<?php

namespace Ptsilva\DocumentCounter\Documents;

use Ptsilva\DocumentCounter\Documents\Contracts\CountableDocumentInterface;
use Ptsilva\DocumentCounter\CounterInterface;

/**
* 
*/
class PDFDocument extends \SplFileObject implements CountableDocumentInterface
{
	protected $filePath;

	public function __construct($filePath)
	{
		$this->filePath = $filePath;

		parent::__construct($filePath);
	}

	public function getFullPath()
	{
		return $this->getRealPath();
	}

	public function count(CounterInterface $service)
	{
		return $service->process($this);
	}
}