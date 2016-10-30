<?php

namespace Ptsilva\DocumentCounter\Documents\Contracts;

use Ptsilva\DocumentCounter\CounterInterface;

interface CountableInterface
{
	public function count(CounterInterface $service);
}