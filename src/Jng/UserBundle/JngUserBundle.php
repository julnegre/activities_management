<?php

namespace Sdz\UserBundle;
 
use Symfony\Component\HttpKernel\Bundle\Bundle;
 
class JngUserBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}