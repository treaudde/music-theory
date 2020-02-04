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
        $scaleService = new ScaleService();
        $cMinorScaleResultToCompare = json_encode([
            'C', 'D', 'D+/E-', 'F', 'G', 'G+/A-', 'B'
        ]);
        $cMinorScale = $scaleService->harmonicMinor('C');

        $this->assertEquals($cMinorScaleResultToCompare, json_encode($cMinorScale));
    }

    public function testMelodicMinorScale()
    {
        $scaleService = new ScaleService();
        $cMinorScaleResultToCompare = json_encode([
            'C', 'D', 'D+/E-', 'F', 'G', 'A', 'B'
        ]);
        $cMinorScale = $scaleService->melodicMinor('C');

        $this->assertEquals($cMinorScaleResultToCompare, json_encode($cMinorScale));
    }

    public function testMajorPentatonicScale()
    {
        $scaleService = new ScaleService();
        $cPentatonicScaleResultToCompare = json_encode([
            'C', 'D', 'E', 'G', 'A'
        ]);
        $cPentatonicScale = $scaleService->majorPentatonic('C');

        $this->assertEquals($cPentatonicScaleResultToCompare, json_encode($cPentatonicScale));
    }

    public function testMinorPentatonicScale()
    {
        $scaleService = new ScaleService();
        $cMinorPentatonicScaleResultToCompare = json_encode([
            'C', 'D+/E-', 'F', 'G', 'A+/B-'
        ]);
        $cMinorPentatonicScale = $scaleService->minorPentatonic('C');

        $this->assertEquals($cMinorPentatonicScaleResultToCompare, json_encode($cMinorPentatonicScale));
    }
}


