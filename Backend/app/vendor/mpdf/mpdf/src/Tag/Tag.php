<?php

namespace Mpdf\Tag;

use Mpdf\Cache;
use Mpdf\Color\ColorConverter;
use Mpdf\CssManager;
use Mpdf\Form;
use Mpdf\Image\ImageProcessor;
use Mpdf\Language\LanguageToFontInterface;
use Mpdf\Mpdf;
use Mpdf\Otl;
use Mpdf\SizeConverter;
use Mpdf\Strict;
use Mpdf\TableOfContents;

abstract class Tag
{

    use Strict;

    const ALIGN = [
        'left' => 'L',
        'center' => 'C',
        'right' => 'R',
        'top' => 'T',
        'text-top' => 'TT',
        'middle' => 'M',
        'baseline' => 'BS',
        'bottom' => 'B',
        'text-bottom' => 'TB',
        'justify' => 'J'
    ];
    /**
     * @var Mpdf
     */
    protected $mpdf;
    /**
     * @var Cache
     */
    protected $cache;
    /**
     * @var CssManager
     */
    protected $cssManager;
    /**
     * @var Form
     */
    protected $form;
    /**
     * @var Otl
     */
    protected $otl;
    /**
     * @var TableOfContents
     */
    protected $tableOfContents;
    /**
     * @var SizeConverter
     */
    protected $sizeConverter;
    /**
     * @var ColorConverter
     */
    protected $colorConverter;
    /**
     * @var ImageProcessor
     */
    protected $imageProcessor;
    /**
     * @var LanguageToFontInterface
     */
    protected $languageToFont;

    public function __construct(
        Mpdf                    $mpdf,
        Cache                   $cache,
        CssManager              $cssManager,
        Form                    $form,
        Otl                     $otl,
        TableOfContents         $tableOfContents,
        SizeConverter           $sizeConverter,
        ColorConverter          $colorConverter,
        ImageProcessor          $imageProcessor,
        LanguageToFontInterface $languageToFont
    )
    {

        $this->mpdf = $mpdf;
        $this->cache = $cache;
        $this->cssManager = $cssManager;
        $this->form = $form;
        $this->otl = $otl;
        $this->tableOfContents = $tableOfContents;
        $this->sizeConverter = $sizeConverter;
        $this->colorConverter = $colorConverter;
        $this->imageProcessor = $imageProcessor;
        $this->languageToFont = $languageToFont;
    }

    public function getTagName()
    {
        $tag = get_class($this);
        return strtoupper(str_replace('Mpdf\Tag\\', '', $tag));
    }

    abstract public function open($attr, &$ahtml, &$ihtml);

    abstract public function close(&$ahtml, &$ihtml);

    protected function getAlign($property)
    {
        $property = strtolower($property);
        return array_key_exists($property, self::ALIGN) ? self::ALIGN[$property] : '';
    }

}
