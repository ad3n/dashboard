<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Util;

use Symfony\Component\Validator\Exception\OutOfBoundsException;

class BulanIndonesia
{
    public static $BULAN = array(
        1 => 'Jan',
        2 => 'Feb',
        3 => 'Mart',
        4 => 'Apr',
        5 => 'Mei',
        6 => 'Jun',
        7 => 'Jul',
        8 => 'Agu',
        9 => 'Sep',
        10 => 'Okt',
        11 => 'Nov',
        12 => 'Des',
    );

    public static function convertToText($integer)
    {
        $integer = (int) $integer;

        if ($integer > 0 && $integer <= 12) {
            return self::$BULAN[(int) $integer];
        } else {
            throw new OutOfBoundsException('unaccepted index');
        }
    }

    public static function allText()
    {
        return array_values(self::$BULAN);
    }

    public static function allNumeric()
    {
        return array_keys(self::$BULAN);
    }

    public static function convertToNumber($text)
    {
        return array_search($text, self::$BULAN);
    }
}