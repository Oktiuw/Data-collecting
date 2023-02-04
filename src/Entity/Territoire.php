<?php

namespace Entity;

class Territoire
{
    private string $cdTerritoire;
    private string $libTerritoire;

    /**
     * @return string
     */
    public function getCdTerritoire(): string
    {
        return $this->cdTerritoire;
    }

    /**
     * @param string $cdTerritoire
     */
    public function setCdTerritoire(string $cdTerritoire): void
    {
        $this->cdTerritoire = $cdTerritoire;
    }

    /**
     * @return string
     */
    public function getLibTerritoire(): string
    {
        return $this->libTerritoire;
    }

    /**
     * @param string $libTerritoire
     */
    public function setLibTerritoire(string $libTerritoire): void
    {
        $this->libTerritoire = $libTerritoire;
    }
}