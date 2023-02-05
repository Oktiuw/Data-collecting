<?php

namespace Entity;

class TypeActivite
{
    private string $codeTypeActivite;
    private string $libelleTypeActivite;

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

    /**
     * @return string
     */
    public function getLibelleTypeActivite(): string
    {
        return $this->libelleTypeActivite;
    }

    /**
     * @param string $libelleTypeActivite
     */
    public function setLibelleTypeActivite(string $libelleTypeActivite): void
    {
        $this->libelleTypeActivite = $libelleTypeActivite;
    }
}