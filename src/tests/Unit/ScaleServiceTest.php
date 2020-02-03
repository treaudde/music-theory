<?php

namespace Tests\Unit;

use App\Domain\Scale\BusinessLogic\Services\ScaleService;

use PHPUnit\Framework\TestCase;

class ScaleServiceTest extends TestCase
{
    public function testMajorScale()
    {
        $scaleService = new ScaleService();
        $cMajorScaleResultToCompare = json_encode([
            'C', 'D', 'E', 'F', 'G', 'A', 'B'
        ]);
        $cMajorScale = $scaleService->major('C');

        $this->assertEquals($cMajorScaleResultToCompare, json_encode($cMajorScale));
    }

    public function testNaturalMinorScale()
    {
        $scaleService = new ScaleService();
        $cMinorScaleResultToCompare = json_encode([
            'C', 'D', 'D+/E-', 'F', 'G', 'G+/A-', 'A+/B-'
        ]);
        $cMinorScale = $scaleService->minor('C');

        $this->assertEquals($cMinorScaleResultToCompare, json_encode($cMinorScale));
    }

    public function testHarmonicMinorScale()
    {

    }

    public function testMajorPentatonicScale()
    {

    }

    public function testMinorPentatonicScale()
    {

    }
}


