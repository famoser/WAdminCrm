<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 16.08.2015
 * Time: 22:11
 */

namespace famoser\phpFrame\Helpers;


use DateTime;
use Famoser\phpFrame\Core\Logging\Logger;
use Famoser\phpFrame\Models\Locale\Language;
use famoser\phpFrame\Services\LocaleService;
use famoser\phpFrame\Services\SettingsService;

class FormatHelper extends HelperBase
{
    private $formats;

    public function __construct()
    {
        $this->formats = LocaleService::getInstance()->getFormats();
    }

    public function textOrPlaceholder($input)
    {
        if ($input == "")
            return "-";
        return $input;
    }

    public function dateTimeShort($input)
    {
        $res = "";
        $time = $this->parseDateTimeObject($input);
        if ($time !== false) {
            $res .= $time->format(DATETIME_FORMAT_DISPLAY);
        }
        return $res;
    }

    public function dateTimeText($input, $input2 = null)
    {
        $res = "";
        $time = $this->parseDateTimeObject($input);
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

    public function dateText($input)
    {
        $time1 = $this->parseDateTimeObject($input);
        if ($time1 !== false) {
            $days = unserialize(LOCALE_DAYS_SER);
            $months = unserialize(LOCALE_MONTHS_SER);
            $res = $days[$time1->format("w")] . ", " . $time1->format("d") . " " . $months[$time1->format("n")] . " " . $time1->format("Y");
            return $res;
        }
        return "-";
    }

    public function format_TimeSpanText($input1, $input2)
    {
        $time1 = $this->parseDateTimeObject($input1);
        $time2 = $this->parseDateTimeObject($input2);

        if ($time1 == false || $time2 == false)
            return "";

        return (abs($time1->getTimestamp() - $time2->getTimestamp()) / 60) . " minutes";
    }

    public function format_TimeSpanMinutes($input1, $input2)
    {
        $time1 = $this->parseDateTimeObject($input1);
        $time2 = $this->parseDateTimeObject($input2);

        if ($time1 == false || $time2 == false)
            return 0;

        return abs($time1->getTimestamp() - $time2->getTimestamp()) / 60;
    }

    public function format_Money($money, $isZeroValid = true)
    {
        if ($money == 0)
            if ($isZeroValid)
                return "- " . CURRENCY;
            else
                return "-";
        return number_format($money, 2) . " " . CURRENCY;
    }

    public function format_WorkingTime($timeSpan)
    {
        $std = $timeSpan / 60;
        $min = $timeSpan % 60;
        return number_format($std, 0) . " Stunden, " . $min . " Minuten";
    }


    public function format_Percentage($value, $total)
    {
        $percentage = $value / $total * 100;
        return number_format($percentage, 0);
    }

    public function parseDateTimeObject($input)
    {
        $time = DateTime::createFromFormat($this->formats["DateTime"]["Database"], $input);
        if ($time == false)
            $time = DateTime::createFromFormat(DATE_FORMAT_DATABASE, $input);
        if ($time == false)
            $time = DateTime::createFromFormat(TIME_FORMAT_DATABASE, $input);
        return $time;
    }
}