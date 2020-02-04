<?php

namespace App\Domain\Scale\BusinessLogic\Services;

/**
 * Class ScaleService
 * @package App\Domain\Scale\BusinessLogic\Services
 */
class ScaleService
{
    protected $chromaticScale;

    const WHOLE_STEP = 2;
    const HALF_STEP = 1;
    const MINOR_THIRD = 3;

    public function __construct()
    {
        $this->chromaticScale = [
            'C', 'C+/D-', 'D', 'D+/E-', 'E', 'F',
            'F+/G-', 'G', 'G+/A-', 'A', 'A+/B-', 'B'
        ];
    }

    public function major($key)
    {
        $rules = [
            self::WHOLE_STEP,
            self::WHOLE_STEP,
            self::HALF_STEP,
            self::WHOLE_STEP,
            self::WHOLE_STEP,
            self::WHOLE_STEP,
            self::HALF_STEP
        ];

        return $this->generateScale($key, $rules);
    }

    public function minor($key)
    {
        $rules = [
            self::WHOLE_STEP,
            self::HALF_STEP,
            self::WHOLE_STEP,
            self::WHOLE_STEP,
            self::HALF_STEP,
            self::WHOLE_STEP,
            self::WHOLE_STEP
        ];

        return $this->generateScale($key, $rules);
    }

    public function harmonicMinor($key)
    {
        $rules = [
            self::WHOLE_STEP,
            self::HALF_STEP,
            self::WHOLE_STEP,
            self::WHOLE_STEP,
            self::HALF_STEP,
            self::WHOLE_STEP,
            self::MINOR_THIRD
        ];

        return $this->generateScale($key, $rules);
    }

    private function generateScale($key, $rules)
    {
        //find where to start
        $startingPosition = $this->getStartingNotePosition($key);

        return $this->composeScale($startingPosition, $rules);
    }

    private function getStartingNotePosition($key)
    {
        for ($x=0; $x<count($this->chromaticScale); $x++) {
            if ($key == $this->chromaticScale[$x]) {
                return $x;
            }
        }
    }

    private function composeScale($startingPosition, $rules)
    {
        $composedScale = [];

        $composedScale[] = $this->chromaticScale[$startingPosition];
        $currentPosition = $startingPosition;

        for ($x=0; $x<count($rules); $x++) {
            $currentPosition += $rules[$x];
            $currentPosition = $this->resetCurrentPosition($currentPosition);

            $composedScale[] = $this->chromaticScale[$currentPosition];

        }

        return $composedScale;
    }


    private function resetCurrentPosition($currentPosition)
    {
        //handle the wrap around
        $endHalfStep = count($this->chromaticScale) + 1;
        $endWholeStep = count($this->chromaticScale) + 2;
        $endMinorThird = count($this->chromaticScale) + 3;

        if ($currentPosition == $endHalfStep) {
            return 0;
        }

        if ($currentPosition == $endWholeStep) {
            return 1;
        }

        if ($currentPosition == $endMinorThird) {
            return 2;
        }

        return $currentPosition;
    }
}
