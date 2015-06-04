<?php

namespace Tkuska\GeneratorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TkuskaGeneratorBundle extends Bundle
{
    public function getParent() {
        return 'SensioGeneratorBundle';
    }
}
