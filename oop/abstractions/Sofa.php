<?php

/**
 * Class Sofa
 */
class Sofa
{
    /**
     * @param ScratchableInterface $animal
     * @return string
     */
    public function beScratched(ScratchableInterface $animal): string
    {
        return get_class($animal) . ' makes ' . $animal->scratch();
    }
}
