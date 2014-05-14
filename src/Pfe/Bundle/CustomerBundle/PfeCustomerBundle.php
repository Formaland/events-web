<?php

namespace Pfe\Bundle\CustomerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PfeCustomerBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
