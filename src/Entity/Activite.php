<?php

namespace Entity;

class Activite
{
    private string $codeActivite;
    private string $libelleActivite;
    private string $codeTypeActivite;

    /**
     * @return string
     */
    public function getCodeActivite(): string
    {
        return $this->codeActivite;
    }

    /**
     * @param string $codeActivite
     */
    public function setCodeActivite(string $codeActivite): void
    {
        $this->codeActivite = $codeActivite;
    }

    /**
     * @return string
     */
    public function getLibelleActivite(): string
    {
        return $this->libelleActivite;
    }

    /**
     * @param string $libelleActivite
     */
    public function setLibelleActivite(string $libelleActivite): void
    {
        $this->libelleActivite = $libelleActivite;
    }

    /**
     * @return string
     */
    public function getCodeTypeActivite(): string
    {
        return $this->codeTypeActivite;
    }

    /**
     * @param string $codeTypeActivite
     */
    public function setCodeTypeActivite(string $codeTypeActivite): void
    {
        $this->codeTypeActivite = $codeTypeActivite;
    }
}