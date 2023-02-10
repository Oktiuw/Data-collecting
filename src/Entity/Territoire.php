<?php

namespace Entity;

class Territoire
{
    private string $codeTerritoire;
    private string $libelleTerritoire;
    private string $codeTypeTerritoire;

    /**
     * @return string
     */
    public function getCodeTerritoire(): string
    {
        return $this->codeTerritoire;
    }

    /**
     * @param string $codeTerritoire
     */
    public function setCodeTerritoire(string $codeTerritoire): void
    {
        $this->codeTerritoire = $codeTerritoire;
    }

    /**
     * @return string
     */
    public function getLibelleTerritoire(): string
    {
        return $this->libelleTerritoire;
    }

    /**
     * @param string $libelleTerritoire
     */
    public function setLibelleTerritoire(string $libelleTerritoire): void
    {
        $this->libelleTerritoire = $libelleTerritoire;
    }

    /**
     * @return string
     */
    public function getCodeTypeTerritoire(): string
    {
        return $this->codeTypeTerritoire;
    }

    /**
     * @param string $codeTypeTerritoire
     */
    public function setCodeTypeTerritoire(string $codeTypeTerritoire): void
    {
        $this->codeTypeTerritoire = $codeTypeTerritoire;
    }
}
