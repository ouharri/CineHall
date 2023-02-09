<?php

/**
 * This file is part of FPDI
 *
 * @package   setasign\Fpdi
 * @copyright Copyright (c) 2020 Setasign GmbH & Co. KG (https://www.setasign.com)
 * @license   http://opensource.org/licenses/mit-license The MIT License
 */

namespace setasign\Fpdi;

use FPDF;

/**
 * Class FpdfTpl
 *
 * This class adds a templating feature to FPDF.
 */
class FpdfTpl extends FPDF
{
    use FpdfTplTrait;
}
