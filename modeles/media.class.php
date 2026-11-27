<?php

class Media
{
    private ?int $idmedia;
    private ?string $url;
    private ?bool $type;

    public function __construct(?int $id = null, ?string $u = null, ?bool $t = null)
    {
        $this->setId($id);
        $this->setUrl($u);
        $this->setType($t);
    }

    public function getIdmedia(): ?int
    {
        return $this->idmedia;
    }

    public function setId(?int $idmedia): void
    {
        $this->idmedia = $idmedia;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function getType(): ?bool
    {
        return $this->type;
    }

    public function setType(?bool $type): void
    {
        $this->type = $type;
    }
}
