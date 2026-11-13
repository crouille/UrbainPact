<?php

class Photo
{
    private ?int $id;
    private ?string $url;

    public function __construct(?int $id = null, ?string $u = null)
    {
        $this->setId($id);
        $this->setUrl($u);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }
}
