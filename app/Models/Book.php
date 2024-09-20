<?php

namespace App\Models;

use PixelFix\Framework\Database\Connection;

class Book
{
	private ?int $id = null;
	private string $title = '';
	private string $body = '';

	public function save(): void
	{
		$connection = Connection::getConnection();

		$statement = $connection->pdo->prepare("
			INSERT INTO books (title, body)
			values (:title, :body)
		");

		$statement->bindValue(':title', $this->getTitle());
		$statement->bindValue(':body', $this->getBody());

		$statement->execute();

		$id = $connection->pdo->lastInsertId();

		$this->setId($id);
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getTitle(): string
	{
		return $this->title;
	}

	public function getBody(): string
	{
		return $this->body;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}

	public function setTitle(string $title): void
	{
		$this->title = $title;
	}

	public function setBody(string $body): void
	{
		$this->body = $body;
	}
}
