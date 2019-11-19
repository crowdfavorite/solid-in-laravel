<?php

namespace App;

use App\Interfaces\SalaryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model implements SalaryInterface
{
	use SoftDeletes;

    protected $dates = [
    	'created_at',
		'updated_at',
		'deleted_at',
	];

    protected $fillable = [
    	'name',
    	'hours_worked',
		'created_at',
		'updated_at',
		'deleted_at',
	];

    public $hourly_rate = 50;

    public function calculateSalary()
	{
		return $this->hours_worked * $this->hourly_rate;;
	}
}
