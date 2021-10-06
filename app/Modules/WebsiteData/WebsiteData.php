<?php

namespace App\Modules\WebsiteData;

class WebsiteData
{
    protected string $name;

    protected int $trustFlowScore;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getTrustFlowScore(): int
    {
        return $this->trustFlowScore;
    }

    /**
     * @param int $trustFlowScore
     */
    public function setTrustFlowScore(int $trustFlowScore): void
    {
        $this->trustFlowScore = $trustFlowScore;
    }
}
