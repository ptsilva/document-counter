<?php

namespace Ptsilva\DocumentCounter\Factory;

use Ptsilva\DocumentCounter\Documents\Contracts\CountableDocumentInterface;
/**
* 
*/
class DocumentCounterFactory
{
	protected $counters = [];


	public function registerCounter($mime, $class)
	{
		$this->counters[$mime] = $class;

		return $this;
	}

	public function registerCounters($list = [])
	{
		foreach ($list as $mime => $class) {
			$this->registerCounter($mime, $class);
		}

		return $this;
	}

	public function getCounterFromExtension($extension)
	{
		if(!isset($this->counters[$extension])) {
			throw new \Exception("Counter not registered for extension: {$extension}");
		}

		return $this->counters[$extension]();
	}
	
	public function getTotalPages(CountableDocumentInterface $countable)
	{
		$extension = $countable->getExtension();

		$counter = $this->getCounterFromExtension($extension);

		return $counter->process($countable);
	}
}