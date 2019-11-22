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
	
	// Often directors/founders/board members dont get monthly salaries but get their revenue in yearly dividents and they
	// reinvest their revenue in the company.
	// However, the Director model is forced by the SalaryInterface to implement a method that is not used by this model.
	// This violates the Interface segregation principle.
	// To avoid this, the payMonthlySalary should be in a different interface and make our class implement both interfaces.

	public function payMonthlySalary()
	{
		return null;
	}
}
