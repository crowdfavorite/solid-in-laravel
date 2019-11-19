<?php

namespace App\Http\Controllers;

use App\{Employee, Director};
use App\Service\SalaryCalculator;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        $employees_salary = (new SalaryCalculator())->calculateTotalSalaries($employees);
        $directors = Director::all();
        $directors_salary = (new SalaryCalculator())->calculateTotalSalaries($directors);

        return view('admin.salaries.index', compact('employees', 'employees_salary', 'directors', 'directors_salary'));
    }
}
