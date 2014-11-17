<?php
/**
 * This file is part of Males Bundle
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Twig;

class ArrayToStringFilter extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('to_string', array($this, 'toString')),
        );
    }

    public function toString(array $array)
    {
        $output = '[';
        foreach ($array as $key => $value) {
            $output .= sprintf('%s, ', $value);
        }
        $output = rtrim($output, ', ');
        $output .= ']';

        return $output;
    }

    public function getName()
    {
        return 'array_to_string';
    }
} 