<?php
namespace App\Service;


use App\Director;
use App\Employee;

class SalaryCalculator
{
	public function calculateTotalSalaries($employees)
	{
		$total_salary = 0;

		foreach($employees as $employee) {
			if($employee instanceof Employee) {
				$total_salary += $employee->hours_worked * $employee->hourly_rate;
			} elseif ($employee instanceof  Director) {
				$total_salary += $employee->fixed_month * (1 + $employee->start_date->diffInMonths(now()) * $employee->monthly_percentage);
			}
		}

		return $total_salary;
	}

	public function calculateTotalSalariesSolid($employees)
	{
		$total_salary = 0;

		foreach($employees as $employee) {
			$total_salary += $employee->calculateSalary();
		}

		return $total_salary;
	}

}
