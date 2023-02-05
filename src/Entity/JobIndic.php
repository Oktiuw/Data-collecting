<?php

namespace Entity;

class JobIndic
{
    private string $codeActivite;
    private string $codeTerritoire;
    private string $libelleIndicateur;
    private float $valeurIndicateur;

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
    public function getLibelleIndicateur(): string
    {
        return $this->libelleIndicateur;
    }

    /**
     * @param string $libelleIndicateur
     */
    public function setLibelleIndicateur(string $libelleIndicateur): void
    {
        $this->libelleIndicateur = $libelleIndicateur;
    }

    /**
     * @return float
     */
    public function getValeurIndicateur(): float
    {
        return $this->valeurIndicateur;
    }

    /**
     * @param float $valeurIndicateur
     */
    public function setValeurIndicateur(float $valeurIndicateur): void
    {
        $this->valeurIndicateur = $valeurIndicateur;
    }
}