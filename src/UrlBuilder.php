<?php

namespace FrozenLeaves\Support;

class UrlBuilder
{
    private string $query = '';

    public function __construct(
        private readonly string $path,
    ) {
    }

    /**
     * @param array<string,mixed> $params
     */
    public static function create(string $path, array $params = []): self
    {
        return (new self($path))->addQueryParams($params);
    }

    /**
     * @param array<string,mixed> $params
     */
    public function addQueryParams(array $params = []): self
    {
        if ($params !== []) {
            if ($this->query === '') {
                $this->query = '?';
            }
            $this->query .= http_build_query($params);
        }

        return $this;
    }

    public function toUrl(string $basePath): string
    {
        return $basePath . $this->path . $this->query;
    }
}
