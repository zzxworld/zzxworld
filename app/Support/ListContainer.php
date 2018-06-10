<?php

namespace App\Support;

class ListContainer
{
    protected $paginator;
    protected $iterator;
    protected $listName;

    public function __construct($paginator, $iterator=null, $listName='items')
    {
        $this->paginator = $paginator;
        $this->iterator = $iterator;
        $this->listName = $listName;
    }

    public function getItems()
    {
        if (!is_callable($this->iterator)) {
            return $this->paginator->items();
        }

        return array_map($this->iterator, $this->paginator->items());
    }

    public function getPagination()
    {
        return [
            'total' => $this->paginator->total(),
            'limit' => $this->paginator->perPage(),
            'page' => $this->paginator->currentPage(),
            'page_total' => $this->paginator->lastPage(),
        ];
    }

    public function toArray(array $appends = null)
    {
        return array_merge([
            $this->listName => $this->getItems(),
            'pagination' => $this->getPagination(),
        ], $appends ?: []);
    }
}
