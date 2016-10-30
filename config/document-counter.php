<?php

return [
	'pdf' => [
		'driver' => env('PDF_COUNTER_DRIVER', 'ghostscript'),

		'ghostscript' => [
			'bin' => env('PDF_COUNTER_BIN', '/usr/bin/gs'),
			'handler' => Ptsilva\DocumentCounter\PDFGhostScriptCounter::class
		]
	]
];