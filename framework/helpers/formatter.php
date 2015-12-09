<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 16.08.2015
 * Time: 22:11
 */

function format_Text($input)
{
    if ($input == "")
        return "-";
    return $input;
}

function format_DateTimeNumbers($input)
{
    $res = "";
    $time = GetDateObject($input);
    if ($time !== false) {
        $res .= $time->format(DATETIME_FORMAT_DISPLAY);
    }
    return $res;
}

function format_DateTimeText($input, $input2 = null)
{
    $res = "";
    $time = GetDateObject($input);
    if ($time !== false) {
        $date = format_DateText($input);
        $res = $date . " um " . $time->format("H:i");
        if ($input2 != null) {
            $date2 = format_DateText($input2);
            if ($date2 != $date) {
                $date2text = format_DateTimeText($input2);
                if ($date2text != "")
                    $res .= " bis " . $date2text;
            } else
                $res .= " bis ca " . $time->format("H:i");
        }
    }
    return $res;
}

function format_DateText($input)
{
    $time1 = GetDateObject($input);
    if ($time1 !== false) {
        $days = unserialize(LOCALE_DAYS_SER);
        $months = unserialize(LOCALE_MONTHS_SER);
        $res = $days[$time1->format("w")] . ", " . $time1->format("d") . " " . $months[$time1->format("n")] . " " . $time1->format("Y");
        return $res;
    }
    return "-";
}

function format_TimeSpanText($input1, $input2)
{
    $time1 = GetDateObject($input1);
    $time2 = GetDateObject($input2);

    if ($time1 == false || $time2 == false)
        return "";

    return (abs($time1->getTimestamp() - $time2->getTimestamp()) / 60) . " minutes";
}

function format_TimeSpanMinutes($input1, $input2)
{
    $time1 = GetDateObject($input1);
    $time2 = GetDateObject($input2);

    if ($time1 == false || $time2 == false)
        return 0;

    return abs($time1->getTimestamp() - $time2->getTimestamp()) / 60;
}

function format_Money($money, $isZeroValid = true)
{
    if ($money == 0)
        if ($isZeroValid)
            return "- ".CURRENCY;
        else
            return "-";
    return number_format($money, 2) . " ". CURRENCY;
}

function format_Percentage($value, $total)
{
    $percentage = $value / $total * 100;
    return number_format($percentage, 0);
}

function GetDateObject($input)
{
    $time = DateTime::createFromFormat(DATETIME_FORMAT_DATABASE, $input);
    if ($time == false)
        $time = DateTime::createFromFormat(DATE_FORMAT_DATABASE, $input);
    if ($time == false)
        $time = DateTime::createFromFormat(TIME_FORMAT_DATABASE, $input);
    return $time;
}