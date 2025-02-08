<?php

namespace App\Services;

use App\Models\Device;
use App\Models\Monitoring;
use App\Models\Parameter;

class MonitoringService
{
  public static function fetchLast30daysAjax(): array
  {
    $currentDate = date('Y-m-d');
    $dateStart = date('Y-m-d', strtotime($currentDate . "-30 days"));
    return self::fetchByDateRange($dateStart, $currentDate);
  }

  public static function fetchByDateRange($dateStart, $dateEnd)
  {
    $device = Device::first();
    $parameters = Parameter::select('id', 'name', 'label')->get()->toArray();

    $dateStart = date('Y-m-d 00:00:00', strtotime($dateStart));
    $dateEnd = date('Y-m-d 23:59:59', strtotime($dateEnd));

    $results = [];
    foreach ($parameters as $indexParameter => $parameter) {
      $logs = Monitoring::where('parameter_id', $parameter['id'])
        ->where('device_id', $device->id)
        ->whereBetween('created_at', [$dateStart, $dateEnd])
        ->orderBy('created_at', 'desc')
        ->get();
      $results[$indexParameter] = $parameter;
      $results[$indexParameter]['labels'] = [];
      $results[$indexParameter]['values'] = [];
      foreach ($logs as $log) {
        $results[$indexParameter]['labels'][] = date('d F Y', strtotime($log->created_at));
        $results[$indexParameter]['values'][] = $log->nilai;
      }
    }

    return $results;
  }
}
