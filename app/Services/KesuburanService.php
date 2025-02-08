<?php

namespace App\Services;

use App\Models\Device;
use App\Models\Monitoring;
use App\Models\Parameter;

class KesuburanService
{

  static function cekKesuburan()
  {
    $deviceId = Device::first()->id;

    $parameters = Parameter::select('id', 'name', 'label')->get()->toArray();

    $result = [];
    foreach ($parameters as $indexParameter => $parameter) {
      $log = Monitoring::where('parameter_id', $parameter['id'])
        ->where('device_id', $deviceId)
        ->orderBy('created_at', 'desc')
        ->first();
      $result[$parameter['name']] = $log->nilai;
    }

    return self::cekKesuburanPerparameter($result['N'], $result['P'], $result['K']);
  }

  static function klasifikasi($result)
  {
    $res['low'] = 0;
    $res['medium'] = 0;
    $res['high'] = 0;
    foreach ($result as $item) {
      if ($item == 'low') {
        $res['low'] += 1;
      } else if ($item == 'medium') {
        $res['medium'] += 1;
      } else if ($item == 'high') {
        $res['high'] += 1;
      }
    }

    if ($res['low'] == 2 && $res['high'] == 1) {
      return 'medium';
    } else {
      return array_search(max($res), $res);
    }
  }

  static function cekKesuburanPerparameter($N, $P, $K)
  {
    $N = $N / 1000000; // ppm
    $K = $K / 1000000; // ppm

    $fertilityLevels = [
      'low' => [
        'N' => 0.2,
        'P' => 10,
        'K' => 0.2
      ],
      'medium' => [
        'N' => 0.5,
        'P' => 20,
        'K' => 0.4
      ]
    ];

    $NLevel = 'high';
    $PLevel = 'high';
    $KLevel = 'high';

    if ($N < $fertilityLevels['low']['N']) {
      $NLevel = 'low';
    } elseif ($N < $fertilityLevels['medium']['N']) {
      $NLevel = 'medium';
    }

    if ($P < $fertilityLevels['low']['P']) {
      $PLevel = 'low';
    } elseif ($P < $fertilityLevels['medium']['P']) {
      $PLevel = 'medium';
    }

    if ($K < $fertilityLevels['low']['K']) {
      $KLevel = 'low';
    } elseif ($K < $fertilityLevels['medium']['K']) {
      $KLevel = 'medium';
    }

    return [
      'N' => $NLevel,
      'P' => $PLevel,
      'K' => $KLevel
    ];
  }
}
