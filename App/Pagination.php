<?php

namespace App;

class Pagination
{
    private $actualPage;
    private $totalPage;
    private $nbPerPage;

    public function __construct(array $data, $nbPerPage = 10)
    {
        (isset($_GET["page"]) && $_GET["page"] > 0) ? $actualPage = (int) $_GET["page"] : $actualPage = 0;
        $totalPage = floor(count($data) / $nbPerPage);

        $this->setActualPage($actualPage);
        $this->setTotalPage($totalPage);
        $this->setNbPerPage($nbPerPage);
    }

    /**
     * Receives a data array as a parameter and returns the paginated data.
     * @param array $data
     * @return array|void
     */
    public function pagine(array $data)
    {
        $paginatedData = [];

        $offset = ($this->getActualPage() * $this->getNbPerPage());

        if($this->getActualPage() > $this->getTotalPage()) {
            return header("Location: /articles?page=" . $this->getTotalPage());
        }

        if($this->getActualPage() < 0) {
            return header("Location: /articles?page=1");
        }

        $paginatedData["data"] = array_slice($data, $offset, $this->getNbPerPage());
        $paginatedData["navigation"] = $this->createNavigation();

        return $paginatedData;
    }

    /**
     * Creates navigation and returns it as a table.
     * @return array
     */
    protected function createNavigation()
    {
        $navigation = range(0, $this->getTotalPage());

        $actualPage = $this->getActualPage();

        $start = 3;

        $offset = $actualPage - $start;
        $length = $start * 2;

        if ($offset < 0) {
            return array_slice($navigation, 0, $length);
        }

        return array_slice($navigation, $offset, $length);
    }

    /**
     * Get the previous page.
     * @return bool|int
     */
    public function previous()
    {
        if($this->getActualPage() < 1) {
            return false;
        }

        return (int) $this->getActualPage() - 1;
    }

    /**
     * Get the next page.
     * @return bool|int
     */
    public function next()
    {
        if(($this->getActualPage() + 1) > $this->getTotalPage()) {
            return false;
        }

        return (int) $this->getActualPage() + 1;
    }

    /**
     * Get the first page.
     * @return bool|int
     */
    public function first()
    {
        if($this->getActualPage() <= 0) {
            return false;
        }

        return (int) 0;
    }

    /**
     * Get the last page.
     * @return bool|int
     */
    public function end()
    {
        if($this->getActualPage() >= $this->getTotalPage()) {
            return false;
        }

        return (int) $this->getTotalPage();
    }

    protected function setActualPage($actualPage)
    {
        $this->actualPage = $actualPage;
    }

    protected function setTotalPage($totalPage)
    {
        $this->totalPage = $totalPage;
    }

    protected function setNbPerPage($nbPerPage)
    {
        $this->nbPerPage = $nbPerPage;
    }

    public function getActualPage()
    {
        return $this->actualPage;
    }

    public function getTotalPage()
    {
        return $this->totalPage;
    }

    public function getNbPerPage()
    {
        return $this->nbPerPage;
    }
}