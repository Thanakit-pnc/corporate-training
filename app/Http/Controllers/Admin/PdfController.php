<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;

class PdfController extends Controller
{
    public function index(Company $company) {

        
        Excel::create($company->company_name, function($excel) use($company) {

            $excel->sheet('Sheetname', function($sheet) use($company) {
                
                $sheet->mergeCells('A1:E1');
                $sheet->cell('A1', function($cell) use($company) {

                    $cell->setValue($company->company_name);
                    $cell->setAlignment('center');
                    $cell->setValignment('center');
                    $cell->setFont(array(
                        'size'       => '20',
                        'bold'       =>  true
                    ));
                });

                $sheet->row(2, array(
                    'No', 'Name', 'Task 1', 'Task 2', 'Over all'
               ));

                $i = 3;
                foreach($company->company_students as $key => $student) {

                    $amount = $company->company_students->count();

                    if($student->student_results()->whereNotNull('score')->count() !== 0) {
                        $task1 = $student->student_results()->task1()->score;
                        $task2 = $student->student_results()->task2()->score;
                        $over_all = $student->student_results()->overall();
                    } else {
                        $task1 = '';
                        $task2 = '';
                        $over_all = '';
                    }

                    $sheet->rows(array(
                        array($key+1, $student->student->name, $task1, $task2, $over_all)
                    ));

                    $sheet->setHeight($i++, 20);
                }
                
                $sheet->setHeight(array(
                    1 => 40,
                    2 => 30,
                ));

                $sheet->setAutoSize(true);
                $sheet->setWidth('A', 5);

                $sheet->cells('A2:E2', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->cells('A3:A14', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->cells('B3:B14', function($cells) {
                    $cells->setValignment('center');
                });

                $sheet->cells('C3:E14', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
        
            });
        
        })->export('xls');

    }
}
