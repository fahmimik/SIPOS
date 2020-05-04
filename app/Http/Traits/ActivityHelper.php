<?php


namespace App\Http\Traits;


trait ActivityHelper
{
    protected function calculateBaseValueByAge($value, $base_data, $age)
    {
        $median = $base_data->where('month', $age)->where('line', 4)->first()->value;
        if ($value >= $median) {
            $line = 5;
        } else {
            $line = 3;
        }

        $divisor = $value > $median ? ($base_data->where('month', $age)
                ->where('line', $line)
                ->first()->value - $median) : ($median - $base_data->where('month', $age)
                ->where('line', $line)
                ->first()->value);

        $final_value = ($value - $median) / $divisor;

        return $final_value;
    }

    protected function getWeightPerAgeStatus($final_value)
    {
        if ($final_value < -3) {
            $status = [
                'type' => 'danger',
                'title' => 'Sangat Kurang'
            ];
        } else if ($final_value < -2) {
            $status = [
                'type' => 'warning',
                'title' => 'Kurang'
            ];
        } else if ($final_value < 1) {
            $status = [
                'type' => 'success',
                'title' => 'Normal'
            ];
        } else {
            $status = [
                'type' => 'danger',
                'title' => 'Berlebih'
            ];
        }

        return $status;
    }

    protected function getHeightPerAgeStatus($final_value)
    {
        if ($final_value < -3) {
            $status = [
                'type' => 'danger',
                'title' => 'Sangat Pendek'
            ];
        } else if ($final_value < -2) {
            $status = [
                'type' => 'warning',
                'title' => 'Pendek'
            ];
        } else if ($final_value < 3) {
            $status = [
                'type' => 'success',
                'title' => 'Normal'
            ];
        } else {
            $status = [
                'type' => 'danger',
                'title' => 'Tinggi'
            ];
        }

        return $status;
    }

    protected function getImtPerAgeStatus($final_value)
    {
        if ($final_value < -3) {
            $status = [
                'type' => 'danger',
                'title' => 'Gizi Buruk'
            ];
        } else if ($final_value < -2) {
            $status = [
                'type' => 'warning',
                'title' => 'Gizi Kurang'
            ];
        } else if ($final_value < 1) {
            $status = [
                'type' => 'success',
                'title' => 'Gizi Baik'
            ];
        } else if ($final_value < 2) {
            $status = [
                'type' => 'warning',
                'title' => 'Resiko Gizi Lebih'
            ];
        } else if ($final_value < 3) {
            $status = [
                'type' => 'danger',
                'title' => 'Gizi Lebih'
            ];
        } else {
            $status = [
                'type' => 'danger',
                'title' => 'Obesitas'
            ];
        }

        return $status;
    }
}
