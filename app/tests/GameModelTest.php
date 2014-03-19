<?php

class ProblemAreaModelTest extends TestCase
{

    /**
     * Test voor het model ProblemArea
     * @group problemarea
     */
    public function testProblemAreaModel()
    {

        $area1 = new ProblemArea();
        $area1->problemarea_name_nl = 'longen';
        $area1->problemarea_name_en = 'lungs';

        $area2 = new ProblemArea();
        $area2->problemarea_name_nl = 'neus';
        $area2->problemarea_name_en = 'nose';

        $area1->save();
        $area2->save();

        $this->assertGreaterThan(0, $area1->problemarea_id);
        $this->assertGreaterThan(0, $area2->problemarea_id);

    }
}