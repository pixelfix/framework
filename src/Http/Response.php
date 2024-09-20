<?php

namespace PixelFix\Framework\Http;

class Response
{
	public function __construct(
		private ?string $content = '',
		private int $status = 200,
		private array $headers = [],
	) {
		http_response_code($status);
	}

	public function send(): void
	{
		echo $this->content;
	}
}
