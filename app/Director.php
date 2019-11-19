<?php

namespace App;

use App\Interfaces\SalaryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Director extends Model implements SalaryInterface
{
	use SoftDeletes;

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
		'start_date',
	];

	protected $fillable = [
		'name',
		'start_date',
		'created_at',
		'updated_at',
		'deleted_at',
	];

	public $fixed_month = 5000;
	public $monthly_percentage = 0.02;

	public function calculateSalary()
	{
		return $this->fixed_month * (1 + $this->start_date->diffInMonths(now()) * $this->monthly_percentage);
	}
}
